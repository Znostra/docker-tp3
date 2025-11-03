<?php
// Étape 3 – page d'accueil + lien phpinfo
if (isset($_GET['phpinfo'])) { phpinfo(); exit; }
?><!doctype html>
<html lang="fr">
<meta charset="utf-8"><title>TP3 – Étape 3</title>
<body style="font-family:system-ui,Arial;margin:2rem">
<h2>NGINX ↔ PHP-FPM ↔ MariaDB (Compose)</h2>
<p><a href="?phpinfo=1">Voir phpinfo()</a></p>
<p><a href="/test.php">Tester écriture/lecture DB</a></p>
</body>
</html>
