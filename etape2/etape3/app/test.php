<?php
$dsn  = 'mysql:host=data;dbname=tp3;charset=utf8mb4';
$user = 'tp3';
$pass = 'tp3pwd';

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (Throwable $e) {
    exit('❌ DB connect error: ' . $e->getMessage());
}

$pdo->exec("
  CREATE TABLE IF NOT EXISTS compteur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cnt INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  )
");

$pdo->exec("INSERT INTO compteur (cnt) VALUES (1)");
$total = (int)$pdo->query("SELECT COUNT(*) AS t FROM compteur")->fetch()['t'];

echo "<h2>Test DB (PDO) ✅</h2>";
echo "<p><strong>Compteur total :</strong> {$total}</p>";
