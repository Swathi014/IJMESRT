<?php
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "article_site";
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
  die('Could not connect to the database.');
}