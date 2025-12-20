-- Migration script to add support for videos in news articles
-- This creates a new table to store videos per news item

CREATE TABLE IF NOT EXISTS news_videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    news_id INT NOT NULL,
    video_path VARCHAR(255) NOT NULL,
    caption TEXT,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (news_id) REFERENCES news(id) ON DELETE CASCADE
);

-- Add index for performance
CREATE INDEX idx_news_videos_news_id ON news_videos(news_id);
CREATE INDEX idx_news_videos_sort_order ON news_videos(sort_order);