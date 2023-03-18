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
            <?php foreach ($post->getPosts() as $post) { ?>

                <div class="card mb-3 rounded-0" style="max-width: 740px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="images/<?php echo $post['image'] ?>" class="img-thumbnail rounded-0 h-100"
                                 alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $post['title'] ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars_decode($post['description']) ?></p>
                                <p class="card-text"><small
                                            class="text-muted">Created: <?php echo date("F jS, Y", strtotime($post['created_at'])) ?></small>
                                </p>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                    <a href="view.php?slug=<?php echo $post['slug'] ?>" type="submit"
                                       class="btn btn-sm btn-primary rounded-0">Read More</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php
            $sql = "SELECT count(id)from posts";
            $result = mysqli_query($db, $sql);
            $row = mysqli_fetch_row($result);
            $totalRecords = $row[0];
            $totalPages = ceil($totalRecords / 5);
            $pageLink = "<ul class='pagination'>";

            if (!isset($_GET['tag'])) {
                //if there is "tag" we don't show pagination
                if (!isset($_GET['page'])) {
                    //is there is no "page" we set $_GET=1
                    $_GET['page'] = 1;
                }

                $page = $_GET['page'];

                if ($page > 1) {

                    $pageLink .= "<a class='page-link' href='index.php?page=1'>First</a>";

                    $pageLink .= "<a class='page-link' href='index.php?page=" . ($page - 1) . "'><<<</a>";
                }

                for ($i = 1; $i <= $totalPages; $i++) {
                    $pageLink .= "<a class='page-link' href='index.php?page=" . $i . "'>" . $i . "</a>  ";
                }

                if ($page <= $totalPages) {

                    $pageLink .= "<a class='page-link' href='index.php?page=" . ($page + 1) . "'>>>></a>";

                    $pageLink .= "<a class='page-link' href='index.php?page=" . $totalPages . "'>Last</a>";
                }
                echo $pageLink . "</ul>";
            }
            ?>

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



