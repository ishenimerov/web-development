-- -- Create a database if not exists
-- CREATE DATABASE IF NOT EXISTS your_database_name;

-- -- Switch to the created database
-- USE your_database_name;

-- -- Create a table for posts
-- CREATE TABLE IF NOT EXISTS posts (
--     post_id INT AUTO_INCREMENT PRIMARY KEY,
--     post_title VARCHAR(255) NOT NULL,
--     post_description TEXT,
--     author_id INT NOT NULL,
--     FOREIGN KEY (author_id) REFERENCES users(user_id)
-- );

-- -- Create a table for users if not exists (assuming you already have a users table)
-- CREATE TABLE IF NOT EXISTS users (
--     user_id INT AUTO_INCREMENT PRIMARY KEY,
--     username VARCHAR(50) NOT NULL,
--     -- Add other user-related columns as needed
-- );
