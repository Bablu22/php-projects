<?php
@include('header.php');
@include("post.php");
@include("tag.php");
@include("db.php");
$post = new Post($db);
$tag = new Tag($db);
?>

<div class="container mx-auto text-left mt-4">
    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
    <div class="row">
        <div class="col-md-8">
            <?php foreach ($post->getSinglePost($_GET['slug']) as $post) { ?>
                <div class="card mb-3 border-0">
                    <img src="images/<?php echo $post['image'] ?>" class="card-img-top" alt="...">
                    <div class="card-body px-0">
                        <h5 class="card-title"><?php echo $post['title'] ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars_decode($post['description']) ?></p>
                    </div>
                </div>
            <?php } ?>


        </div>


        <div class="col-md-4">
            <h5>BROWSE BY TAGS</h5>
            <div class="d-grid gap-2 d-md-block">
                <?php foreach ($tag->getAllTags() as $tag) { ?>
                    <a href="index.php?tag=<?php echo $tag['tag'] ?>" class="text-decoration-none">
                        <button class="btn btn-outline-warning rounded-0 mb-2 text-dark"
                                type="button"><?php echo $tag['tag'] ?></button>
                    </a>
                <?php } ?>
            </div>
            <h5 class="pt-3">SEARCH</h5>
            <form class="form-group" method="GET" action="">
                <input class="form-control rounded-0 border-dark border-1 mr-sm-2" name="keyword" type="search"
                       placeholder="Search" aria-label="Search">
            </form>
        </div>
    </div>
</div>



