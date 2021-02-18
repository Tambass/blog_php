<?php
// Connection à la base de données
$pdo = new PDO('mysql:dbname=tutoblog;host=127.0.0.1', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

// Vider les tables
$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

for ($i = 0; $i < 50; $i++){
    $pdo->exec("INSERT INTO post SET name='Article #$i', slug='article-$i', created_at='2021-02-11 14:00:00', content='lorem ipsum'");
}

// Exécuter la commande : php commands/fill.php (dans le terminal)