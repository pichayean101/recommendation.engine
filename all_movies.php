<?php
session_start();
if(!isset($_SESSION['user'])) {
  header('location: login.php');
}
require('db_connect.php');
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <title>MovieLens Recommendation System</title>
  <style>
    body {
			font-family: “Trebuchet MS”, Helvetica, sans-serif;
      font-size: 12pt;
      cursor: wait;
    }
    .card-header {
      font-size: 1.2rem;
      font-weight: bold;
    }
    .card {
      width: 154px;
    }
    .card-text {
      font-size: 0.75rem;
    }
    .mov-area {
      justify-content: center;
    }
  </style>
</head>
<body>
<div class="w-100 bg-dark text-white text-right py-2">
    <div class="container">
      ยินดีต้อนรับ คุณ<?php echo $_SESSION['user']['name'];?>
      <a class="btn btn-info btn-sm ml-3" href="index.php">รายการหนังของคุณ</a>
      <a class="btn btn-primary btn-sm ml-3" href="login.php">ออกจากระบบ</a>
    </div>
  </div>
  <div class="container">
    <div class="card w-100 rounded border-primary my-2">
      <div class="card-header bg-primary text-white">รายการหนังทั้งหมด</div>
        <div class="container">
          <div class="row mov-area">
<?php
$sql = "SELECT * FROM movies";
$rs = $mysqli->query($sql);
while($row = $rs->fetch_assoc()) {
?>
          <div class="card mx-1 my-1 text-center">
            <img class="card-img-top mx-auto" src="<?php echo $row['mov_poster'];?>">
            <div class="card-body">
              <b class="card-title text-primary"><?php echo $row['mov_title'];?></b>
              <p class="card-text"><b>Average rating:</b> <?php echo $row['mov_rating'];?></p>
            </div>
          </div>
<?php
}
$mysqli->close();  
?>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>
