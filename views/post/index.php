<?php
use App\Helpers\Text;
use App\Model\Post;
use App\Connection;

$title = 'Mon Blog';
// Connection à la base de données
$pdo = Connection::getPDO;

$page = $_GET['page'] ?? 1;
// Filtrer les url
if (!filter_var($page, FILTER_VALIDATE_INT)) {
    throw new Exception('Numéro de page invalide !');
}
// Page courrente
$currentPage = (int)$page;
if($currentPage <= 0) {
    throw new Exception('Numéro de page invalide !');
}
// Sauvegarde du nombre d'article dans la variable $count
$count = (int)$pdo->query('SELECT COUNT(id) FROM post')->fetch(PDO::FETCH_NUM)[0];
// Sauvegarde du nombre de page dans la variable $pages arrondi au chiffre supérieur
$perPage = 12;
$pages = ceil($count / $perPage);
if($currentPage > $pages) {
    throw new Exception('Cette page n\'existe pas !');
}
// Création de l'offset
$offset = $perPage * ($currentPage - 1);
$query = $pdo->query("SELECT * FROM post ORDER BY created_at DESC LIMIT $perPage OFFSET $offset");
$posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);
?>

<h1>Mon Blog</h1>

<div class="row">
    <?php foreach($posts as $post): ?>
    <div class="col-md-3">
        <?php require 'card.php' ?>
    </div>
    <?php endforeach ?>
</div>

<div class="d-flex justify-content-between my-4">
    <?php if($currentPage > 1): ?>
        <?php 
            $link = $router->url('home');
            if($currentPage > 2) $link .= '?page=' .( $currentPage -1);
        ?>
        <a href="<?= $link ?>" class="btn btn-primary">
            ❮ Page précédente
        </a>
    <?php endif ?>
    <?php if($currentPage < $pages): ?>
        <a href="<?= $router->url('home') ?>?page=<?= $currentPage + 1 ?>" class="btn btn-primary ml-auto">
            Page suivante ❯
        </a>
    <?php endif ?>
</div>