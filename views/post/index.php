<?php
use App\URL;
use App\Connection;
use App\Model\Post;
use App\Helpers\Text;
use App\PaginatedQuery;

$title = 'Mon Blog';
// Connection à la base de données
$pdo = Connection::getPDO();

$paginatedQuery = new PaginatedQuery(
    "SELECT * FROM post ORDER BY created_at DESC",
    "SELECT COUNT(id) FROM post"
);
$posts = $paginatedQuery->getItems(Post::class);
$link = $router->url('home');
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
        <?= $paginatedQuery->previousLink($link) ?>
        <?= $paginatedQuery->nextLink($link) ?>
</div>