<?php
@include("functions/function.php");

class Post
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addPost($title, $description, $image, $date, $slug)
    {
        $sql = "INSERT INTO posts(title,description,image,created_at,slug)VALUES('$title','$description','$image','$date','$slug')";
        $result = mysqli_query($this->db, $sql);

        if ($result) {
            if ($_POST['tags']) {
                $tags = $_POST['tags'];
                $lastInsertedId = mysqli_insert_id($this->db);
                foreach ($tags as $tag) {
                    $sql = "INSERT INTO post_tags(post_id,tag_id) VALUES ('$lastInsertedId','$tag')";
                    $result = mysqli_query($this->db, $sql);
                }
            }
        }
        return $result;
    }

    public function getPosts()
    {
        #for search
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            return $this->search($keyword);
        }

        #for tags
        if (isset($_GET['tag'])) {
            $tag = $_GET['tag'];
            $sql = "SELECT * FROM posts INNER JOIN post_tags  ON posts.id = post_id INNER JOIN tags  ON tags.id= post_tags.tag_id WHERE tags.tag='$tag'";
            return mysqli_query($this->db, $sql);
        }

        $limit = 5;
        if(isset($_GET["page"])){
            $page = $_GET["page"];
        }else{
            $page =1;
        }
        $start = ($page-1)*$limit ;

        #all posts
        $sql = "SELECT * FROM posts LIMIT $start,$limit";
        return mysqli_query($this->db, $sql);
    }

    public function createSlug($string)
    {
        return preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    }

    public function getSinglePost($slug)
    {
        $sql = "SELECT * FROM posts WHERE slug='$slug'";
        return mysqli_query($this->db, $sql);
    }

    public function updatePost($title, $description, $slug)
    {
        $newImage = $_FILES['image']['name'];
        if (!empty($newImage)) {
            $image = uploadImage();
            $sql = "UPDATE posts SET title='$title',description='$description',image='$image' WHERE slug='$slug'";
            return mysqli_query($this->db, $sql);
        } else {
            $sql = "UPDATE posts SET title='$title',description='$description' WHERE slug='$slug'";
            return mysqli_query($this->db, $sql);
        }
    }

    public function deletePost($slug)
    {
        $sql = "DELETE FROM posts WHERE slug='$slug'";
        return mysqli_query($this->db, $sql);
    }

    public function search($keyword)
    {
        $sql = "SELECT * FROM posts WHERE title LIKE '%{$keyword}%' OR description LIKE '%{$keyword}%'";
        return mysqli_query($this->db, $sql);
    }
}





