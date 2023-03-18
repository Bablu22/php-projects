<?php
@include('header.php');
@include("post.php");
@include("tag.php");
@include("db.php");
@include("session.php");
$post = new Post($db);
$tag = new Tag($db);
?>

<div class="container mx-auto mt-5">
    <h1>All Posts</h1>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>Title</th>
            <th>Image</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($post->getPosts() as $post) { ?>
            <tr>
                <td><?php echo $post['title'] ?></td>
                <td class="w-25">
                    <img src="images/<?php echo $post['image'] ?>" class="w-25" alt="">
                </td>
                <td><?php echo $post['created_at'] ?></td>
                <td>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="view.php?slug=<?php echo $post['slug'] ?>" type="submit"
                           class="btn btn-sm btn-primary rounded-0">View</a>
                        <a href="edit.php?slug=<?php echo $post['slug'] ?>" type="submit"
                           class="btn btn-warning btn-sm rounded-0">Update</a>
                        <a href="delete.php?slug=<?php echo $post['slug'] ?>" type="submit"
                           class="btn btn-danger btn-sm rounded-0">Delete</a>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
