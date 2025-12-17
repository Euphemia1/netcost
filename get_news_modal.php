<?php
include 'includes/db.php';

// Get news ID from request
$news_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($news_id > 0) {
    // Fetch the news item
    $stmt = $pdo->prepare('SELECT id, title, content, featured_image, created_at FROM news WHERE id = ? LIMIT 1');
    $stmt->execute([$news_id]);
    $news = $stmt->fetch();
    
    if ($news) {
        // Fetch additional images
        $stmt = $pdo->prepare('SELECT image_path FROM news_images WHERE news_id = ? ORDER BY sort_order');
        $stmt->execute([$news_id]);
        $additional_images = $stmt->fetchAll();
        
        // Return JSON response
        header('Content-Type: application/json');
        
        $response = [
            'success' => true,
            'data' => [
                'id' => $news['id'],
                'title' => $news['title'],
                'content' => $news['content'],
                'featured_image' => $news['featured_image'],
                'created_at' => date('F j, Y', strtotime($news['created_at'])),
                'additional_images' => $additional_images
            ]
        ];
        
        echo json_encode($response);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'News item not found']);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid news ID']);
}
?>