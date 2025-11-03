-- Seed simple, indépendant du test.php (qui gère sa table "compteur")
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name  VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE
);

INSERT INTO users (name, email) VALUES
('Alice','alice@example.com'),
('Bob','bob@example.com')
ON DUPLICATE KEY UPDATE email=VALUES(email);
