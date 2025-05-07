CREATE DATABASE IF NOT EXISTS saipali_lost_and_found;
USE saipali_lost_and_found;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create items table
CREATE TABLE IF NOT EXISTS items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    date_lost_found DATE NOT NULL,
    location VARCHAR(255) NOT NULL,
    contact_info VARCHAR(255) NOT NULL,
    image_path VARCHAR(255),
    status ENUM('Lost', 'Found', 'Claimed', 'Pending') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create claims table
CREATE TABLE IF NOT EXISTS claims (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    claimant VARCHAR(100) NOT NULL,
    contact_info VARCHAR(255) NOT NULL,
    proof VARCHAR(255),
    message TEXT NOT NULL,
    status ENUM('Under Review', 'Approved', 'Rejected') DEFAULT 'Under Review',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (item_id) REFERENCES items(id) ON DELETE CASCADE
);

-- Create the admins table
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert example data into the admins table
INSERT INTO admins (username, password) VALUES
('admin', 'admin123'),
('john_doe', 'password1'),
('jane_smith', 'password2'),
('alice_jones', 'password3'),
('bob_brown', 'password4');

-- Create the categories table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

-- Insert example categories
INSERT IGNORE INTO categories (name) VALUES
('Electronics'),
('Clothing'),
('Accessories'),
('Books'),
('Others');