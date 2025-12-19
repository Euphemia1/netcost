<?php
include 'includes/db.php';

// Set headers for SSE
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');
header('Access-Control-Allow-Origin: *');

// Disable output buffering
if (ob_get_level()) {
    ob_end_clean();
}

// Get last event ID if provided
$lastEventId = isset($_SERVER["HTTP_LAST_EVENT_ID"]) ? intval($_SERVER["HTTP_LAST_EVENT_ID"]) : 0;
if ($lastEventId <= 0) {
    $lastEventId = isset($_GET['lastEventId']) ? intval($_GET['lastEventId']) : 0;
}

// Send a heartbeat message to keep connection alive
echo "event: heartbeat\n";
echo "data: " . json_encode(['time' => date('Y-m-d H:i:s')]) . "\n\n";
flush();

// Function to send news update
function sendNewsUpdate($pdo, $eventId) {
    try {
        // Fetch the latest news item
        $stmt = $pdo->prepare('SELECT id, title, content, featured_image, created_at FROM news ORDER BY created_at DESC LIMIT 1');
        $stmt->execute();
        $latest_news = $stmt->fetch();
        
        if ($latest_news) {
            // Format the date
            $latest_news['formatted_date'] = date('F j, Y', strtotime($latest_news['created_at']));
            
            // Truncate content for preview
            $content = $latest_news['content'];
            $latest_news['truncated_content'] = strlen($content) > 300 ? substr($content, 0, 300) . '...' : $content;
            
            // Fetch additional images
            $stmt = $pdo->prepare('SELECT image_path FROM news_images WHERE news_id = ? ORDER BY sort_order');
            $stmt->execute([$latest_news['id']]);
            $latest_news['additional_images'] = $stmt->fetchAll();
            
            // Send the update
            echo "id: " . $eventId . "\n";
            echo "event: news_update\n";
            echo "data: " . json_encode($latest_news) . "\n\n";
            flush();
        }
    } catch (Exception $e) {
        // Send error event
        echo "event: error\n";
        echo "data: " . json_encode(['message' => 'Database error occurred']) . "\n\n";
        flush();
    }
}

// Send initial update
sendNewsUpdate($pdo, $lastEventId + 1);

// Keep the connection alive and check for updates periodically
$eventId = $lastEventId + 1;
$lastNotificationTime = 0;

while (true) {
    // Check for notification file
    $notification_file = 'news_update_notification.txt';
    if (file_exists($notification_file)) {
        $notificationTime = filemtime($notification_file);
        if ($notificationTime > $lastNotificationTime) {
            // Send news update
            $eventId++;
            sendNewsUpdate($pdo, $eventId);
            $lastNotificationTime = $notificationTime;
        }
    }
    
    // Send a heartbeat every 25 seconds to keep connection alive
    echo ": heartbeat\n\n";
    flush();
    
    // Wait for 5 seconds before checking again
    sleep(5);
    
    // Break the loop if connection is closed
    if (connection_aborted()) {
        break;
    }
}
?>