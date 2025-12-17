CREATE DATABASE digital_garden;

USE digital_garden;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE,
  password_hash VARCHAR(255),
  date_created DATE
);

CREATE TABLE themes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  name VARCHAR(100) UNIQUE,
  color VARCHAR(20),
  tags VARCHAR(255),
  date_created DATE,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE notes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  theme_id INT,
  title VARCHAR(150) UNIQUE,
  importance INT,
  content TEXT,
  date_created DATE,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (theme_id) REFERENCES themes(id)
);