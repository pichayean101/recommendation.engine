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
    #recommended .col {
      cursor: wait;
    }
  </style>
</head>
<body>
  <div class="w-100 bg-dark text-white text-right py-2">
    <div class="container">
      ยินดีต้อนรับ คุณ<?php echo $_SESSION['user']['name'];?>
      <a class="btn btn-info btn-sm ml-3" href="all_movies.php">รายการหนังทั้งหมด</a>
      <a class="btn btn-primary btn-sm ml-3" href="login.php">ออกจากระบบ</a>
    </div>
  </div>
  <div class="container">
    <div class="card w-100 rounded border-primary my-2">
      <div class="card-header bg-primary text-white">หนังแนะนำสำหรับคุณ</div>
      <div class="container">
        <div class="row mov-area" id="recommended">
          <div class="col bg-secondary text-white text-center py-5">โปรดรอสักครู่ เรากำลังจะแนะนำหนังที่เหมาะสมกับคุณ ...</div>
        </div>
      </div>
    </div>
    <div class="card w-100 rounded border-primary my-2">
      <div class="card-header bg-primary text-white">ประวัติการดูหนังของคุณ</div>
        <div class="container">
          <div class="row mov-area">
<?php
$sql = "SELECT * FROM movies JOIN scores ON mov_id=scr_mov_id WHERE scr_usr_id={$_SESSION['user']['id']}";
$rs = $mysqli->query($sql);
while($row = $rs->fetch_assoc()) {
?>
          <div class="card mx-1 my-1 text-center">
            <a href="<?php echo $row['mov_url'];?>" target="_blank">
              <img class="card-img-top mx-auto" src="<?php echo $row['mov_poster'];?>">
            </a>
            <div class="card-body">
              <b class="card-title text-primary"><?php echo $row['mov_title'];?></b>
              <div class="card-text"><b>ID:</b> <?php echo $row['mov_id'];?></div>
              <div class="card-text"><b>Average rating:</b> <?php echo $row['mov_rating'];?></div>
              <div class="card-text alert alert-success p-0"><b>Your rating:</b> <?php echo $row['scr_rating'];?></div>
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
