<?php
@include_once("alert.php");
$alert = new Alert();

function uploadImage()
{
    global $alert;
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $alert->create_alert("danger", 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                return $_FILES["image"]["name"];
            } else {

                $alert->create_alert("danger", 'Sorry, there was an error uploading your file.');
            }
        }
    } else {
        $alert->create_alert("danger", 'File is not an image.');
    }
}

