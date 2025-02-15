CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('chat', 'event', 'command') NOT NULL,
    message TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
