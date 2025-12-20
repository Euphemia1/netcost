<?php
include 'includes/db.php';

header('Content-Type: application/json');

// Get last timestamp if provided
$last_timestamp = isset($_GET['last_timestamp']) ? $_GET['last_timestamp'] : null;

try {
    if ($last_timestamp) {
        // Fetch news items newer than the provided timestamp
        $stmt = $pdo->prepare('SELECT id, title, content, featured_image, created_at FROM news WHERE created_at > ? ORDER BY created_at DESC');
        $stmt->execute([$last_timestamp]);
    } else {
        // Fetch the latest news items
        $stmt = $pdo->prepare('SELECT id, title, content, featured_image, created_at FROM news ORDER BY created_at DESC LIMIT 5');
        $stmt->execute();
    }
    
    $news_items = $stmt->fetchAll();
    
    // Process each news item
    foreach ($news_items as &$news) {
        // Format the date
        $news['formatted_date'] = date('F j, Y', strtotime($news['created_at']));
        
        // Truncate content for preview
        $content = $news['content'];
        $news['truncated_content'] = strlen($content) > 300 ? substr($content, 0, 300) . '...' : $content;
        
        // Fetch additional images
        $stmt = $pdo->prepare('SELECT image_path FROM news_images WHERE news_id = ? ORDER BY sort_order');
        $stmt->execute([$news['id']]);
        $news['additional_images'] = $stmt->fetchAll();
        
        // Fetch videos
        $stmt = $pdo->prepare('SELECT video_path FROM news_videos WHERE news_id = ? ORDER BY sort_order');
        $stmt->execute([$news['id']]);
        $news['videos'] = $stmt->fetchAll();
    }
    
    // Get the latest timestamp for future requests
    $latest_timestamp = null;
    if (!empty($news_items)) {
        $latest_timestamp = $news_items[0]['created_at'];
    }
    
    // Return success response
    echo json_encode([
        'success' => true,
        'data' => $news_items,
        'latest_timestamp' => $latest_timestamp
    ]);
} catch (Exception $e) {
    // Database error
    echo json_encode([
        'success' => false,
        'message' => 'Database error occurred'
    ]);
}
?>