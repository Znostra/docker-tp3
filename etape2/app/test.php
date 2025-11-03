<?php
$host = 'data';
$user = 'tp3';
$pass = 'tp3pwd';
$db   = 'tp3';

$link = mysqli_connect($host, $user, $pass, $db);
if (!$link) {
    die('❌ Connection error: ' . mysqli_connect_error());
}
mysqli_set_charset($link, 'utf8mb4');

# table (créée si absente)
mysqli_query($link, "
  CREATE TABLE IF NOT EXISTS compteur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cnt INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  )
");

# écriture + lecture
mysqli_query($link, "INSERT INTO compteur (cnt) VALUES (1)");
$res   = mysqli_query($link, "SELECT COUNT(*) AS total FROM compteur");
$row   = $res ? mysqli_fetch_assoc($res) : ['total' => 0];
$count = $row['total'] ?? 0;

echo "<h2>Compteur mis à jour ✅</h2>";
echo "<p><strong>Nombre actuel :</strong> {$count}</p>";

mysqli_close($link);
