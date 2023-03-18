<?php
@include("header.php");
@include("post.php");
@include("db.php");
$post = new Post($db);

$post->deletePost($_GET['slug']);
header('Location:dashboard.php');

