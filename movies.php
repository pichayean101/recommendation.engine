<?php
require('db_connect.php');
$ids = explode(',', $_GET['id']);
$movies = [];
foreach($ids as $id) {
  $sql = "SELECT * FROM movies WHERE mov_id=$id";
  $rs = $mysqli->query($sql);
  $movies[] = $rs->fetch_assoc();
}
echo json_encode($movies);
?>