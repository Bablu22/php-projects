<?php
@include("header.php");
@include("post.php");
@include("db.php");
@include_once("alert.php");
$alert = new Alert();
$post = new Post($db);

if (isset($_POST['postUpdate'])) {
    $result = $post->updatePost($_POST['title'], $_POST['description'], $_GET['slug']);
    if ($result) {
        $alert->create_alert("success", "Your post update successful.");
    }
}

?>

<div class="container mx-auto">
    <div class="row">
        <div class="col-md-8 mx-auto mt-3">
            <?php foreach ($post->getSinglePost($_GET['slug']) as $post) { ?>
                <div class="card">
                    <div class="card-header">
                        Edit Post
                    </div>
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" value="<?php echo $post['title'] ?>" required class="form-control"
                                       id="title" name="title"
                                       placeholder="Title">
                            </div>
                            <div class="mb-3">
                                <label for="editor" class="form-label">Description</label>
                                <textarea class="form-control" id="editor" name="description" rows=""
                                          cols="30"><?php echo $post['description'] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="Image" class="form-label">Image</label>
                                <input type="file"  class="form-control" id="Image" name="image"
                                       placeholder="Image">
                                <img src="images/<?php echo $post['image'] ?>"
                                     class="rounded-0 d-block  w-25" alt="...">
                            </div>
                            <button type="submit" name="postUpdate" class="btn btn-primary rounded-0">Update</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>