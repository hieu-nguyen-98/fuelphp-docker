CREATE DATABASE IF NOT EXISTS database_moi;
CREATE TABLE IF NOT EXISTS database_moi.users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL
);
INSERT INTO database_moi.users (name, email) VALUES ('User1', 'user1@example.com');