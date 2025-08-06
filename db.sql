CREATE DATABASE dbtest;
USE dbtest;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY COMMENT "Cet id va s'auto incrémenter",
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    bio VARCHAR(255) NOT NULL DEFAULT "No bio found for this user.",
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT "La date sera par défaut la date actuelle."
);

-- to make the bio accept emojis
ALTER TABLE users MODIFY bio VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;