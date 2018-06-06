<?php
$mysqli = new mysqli("localhost", "root", "123", "movielens");
if ($mysqli->connect_errno) {
  die("Failed to connect to MySQL: (".$mysqli->connect_errno.")");
}
$mysqli->set_charset("utf8")
?>
