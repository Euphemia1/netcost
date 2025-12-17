<?php
include 'includes/db.php';

header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Get timestamp parameter if provided
$last_timestamp = isset($_GET['last_timestamp']) ? $_GET['last_timestamp'] : null;

try {
    if ($last_timestamp) {
        // Fetch news items created after the given timestamp
        $stmt = $pdo->prepare('SELECT id, title, content, featured_image, created_at FROM news WHERE created_at > ? ORDER BY created_at DESC');
        $stmt->execute([$last_timestamp]);
    } else {
        // Fetch all news items
        $stmt = $pdo->prepare('SELECT id, title, content, featured_image, created_at FROM news ORDER BY created_at DESC');
        $stmt->execute();
    }
    
    $news_items = $stmt->fetchAll();
    
    // Fetch additional images for each news item
    foreach ($news_items as &$news_item) {
        $stmt = $pdo->prepare('SELECT image_path FROM news_images WHERE news_id = ? ORDER BY sort_order');
        $stmt->execute([$news_item['id']]);
        $news_item['additional_images'] = $stmt->fetchAll();
        
        // Format the date
        $news_item['formatted_date'] = date('F j, Y', strtotime($news_item['created_at']));
        
        // Truncate content for preview
        $content = $news_item['content'];
        $news_item['truncated_content'] = strlen($content) > 300 ? substr($content, 0, 300) . '...' : $content;
    }
    unset($news_item); // Break the reference
    
    // Get the latest timestamp from the results
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