<?php
@include("header.php");
@include("post.php");
@include("tag.php");
@include("db.php");
@include_once("alert.php");
@include("session.php");
@include_once("functions/function.php");
$alert = new Alert();
$post = new Post($db);
$tag = new Tag($db);

if (isset($_POST['postSubmit'])) {
    $date = date('Y-m-d]');
    if (!empty($_POST['title'] && !empty($_POST['description']))) {
        $title = strip_tags($_POST['title']);
        $description = $_POST['description'];
        $slug = $post->createSlug($title);
        $checkSlug = mysqli_query($db, "SELECT * FROM posts WHERE slug='$slug'");
        $result = mysqli_num_rows($checkSlug);
        if ($result > 0) {
            foreach ($checkSlug as $slug) {
                $newSlug = $slug . uniqid();
            }
            $records = $post->addPost($title, $description, uploadImage(), $date, $newSlug);
        } else {
            $records = $post->addPost($title, $description, uploadImage(), $date, $slug);
        }

        if ($records) {
            $alert->create_alert("success", "Your post added successful.");
        }

    } else {
        $alert->create_alert("danger", "All fields is required");
    }
}

?>

<div class="container mx-auto">
    <div class="row">
        <div class="col-md-8 mx-auto mt-5">
            <div class="card">
                <div class="card-header">
                    Add Post
                </div>
                <div class="card-body">
                    <form action="add.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" required class="form-control" id="title" name="title"
                                   placeholder="Title">
                        </div>
                        <div class="mb-3">
                            <label for="editor" class="form-label">Description</label>
                            <textarea class="form-control" id="editor" name="description" rows="" cols="30"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="Image" class="form-label">Image</label>
                            <input type="file" required class="form-control" id="Image" name="image"
                                   placeholder="Image">
                        </div>
                        <div class="form-group form-check-inline mb-3">
                            <label class="" for="inlineCheckbox1">Choose Tag: &nbsp;&nbsp;</label>
                            <?php foreach ($tag->getAllTags() as $tag) { ?>
                                <input class="form-check-input" name="tags[]" type="checkbox" id="inlineCheckbox1"
                                       value="<?php echo $tag['id'] ?>">
                                <?php echo $tag['tag'] ?>
                            <?php } ?>
                        </div>
                        <br>
                        <button type="submit" name="postSubmit" class="btn btn-primary rounded-0">Submit</button>
                    </form>
                </div>
            </div>
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