<?php
// Database connection credentials
$hostname = 'localhost';
$database = 'oop_blog';
$db_user = 'root';
$db_pass = '';


$db = mysqli_connect("$hostname", "$db_user", "$db_pass", "$database");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

