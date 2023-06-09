<?php
include_once("includes/header.php");

if (!isset($_GET['id'])) {
    ErrorMessage::show("No ID passed into page");
}
$entityId = $_GET['id'];
$entity = new Entity($con, $entityId);

$preview = new PreviewProvider($con, $userLoggedIn);
echo $preview->createPreviewVideo($entity);

$season = new SeasonProvider($con, $userLoggedIn);
echo $season->create($entity);
