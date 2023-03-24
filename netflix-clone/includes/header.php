<?php
require_once("includes/config.php");
require_once("includes/classes/PreviewProvider.php");
require_once("includes/classes/CategoryContainers.php");
require_once("includes/classes/Entity.php");
require_once("includes/classes/ErrorMessage.php");
require_once("includes/classes/SeasonProvider.php");

if (!$_SESSION['registeredUser']) {
    header("Location: login.php");
}
$userLoggedIn = $_SESSION['registeredUser'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome to Reeceflix</title>
    <link rel="stylesheet"
          type="text/css"
          href="assets/styles/styles.css"/>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/06a651c8da.js"
            crossorigin="anonymous"></script>
    <script src="assets/js/scripts.js"></script>
</head>
<body>
<div class='wrapper'>

