<?php
include 'includes/db.php';

header('Content-Type: application/json');

// Get news ID from request
$news_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($news_id > 0) {
    try {
        // Fetch the specific news item
        $stmt = $pdo->prepare('SELECT id, title, content, featured_image, created_at FROM news WHERE id = ?');
        $stmt->execute([$news_id]);
        $news = $stmt->fetch();
        
        if ($news) {
            // Format the date
            $news['created_at'] = date('F j, Y', strtotime($news['created_at']));
            
            // Fetch additional images
            $stmt = $pdo->prepare('SELECT image_path FROM news_images WHERE news_id = ? ORDER BY sort_order');
            $stmt->execute([$news_id]);
            $news['additional_images'] = $stmt->fetchAll();
            
            // Return success response
            echo json_encode([
                'success' => true,
                'data' => $news
            ]);
        } else {
            // News not found
            echo json_encode([
                'success' => false,
                'message' => 'News item not found'
            ]);
        }
    } catch (Exception $e) {
        // Database error
        echo json_encode([
            'success' => false,
            'message' => 'Database error occurred'
        ]);
    }
} else {
    // Invalid ID
    echo json_encode([
        'success' => false,
        'message' => 'Invalid news ID'
    ]);
}
?>