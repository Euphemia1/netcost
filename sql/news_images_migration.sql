-- Migration script to add support for multiple images in news articles
-- This creates a new table to store multiple images per news item

CREATE TABLE IF NOT EXISTS news_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    news_id INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    caption TEXT,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (news_id) REFERENCES news(id) ON DELETE CASCADE
);

-- Add index for performance
CREATE INDEX idx_news_images_news_id ON news_images(news_id);
CREATE INDEX idx_news_images_sort_order ON news_images(sort_order);

-- For existing installations, we can move the current featured_image to this new table
-- This would be run manually by the administrator when ready
-- INSERT INTO news_images (news_id, image_path, sort_order) 
-- SELECT id, featured_image, 0 FROM news WHERE featured_image IS NOT NULL AND featured_image != '';