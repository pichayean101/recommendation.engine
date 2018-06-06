<?php
	session_start();
	unset($_SESSION['user']);
	require('db_connect.php');
	if(isset($_POST['submit'])) {
    $uname = $_POST['uname'];
		$pass = $_POST['pass'];
		$strSQL = "SELECT usr_id, usr_name, usr_pass from users where usr_email='$uname'";
	 	$rs = $mysqli->query($strSQL);
    if($row = $rs->fetch_assoc()) {
			if(password_verify($pass, $row['usr_pass'])) {
				$_SESSION['user'] = ['id'=>$row['usr_id'],'name'=>$row['usr_name']];
				header('location: index.php');
			}
			else {
				$error = 'รหัสผ่านไม่ถูกต้อง';
			}
		}
		else {
			$error = 'ไม่มีชื่อผู้ใช้นี้';
		}
	}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <title>MovieLens Recommendation System</title>
	<style>
		html, body {
			height: 100%;
			font-family: "Times New Roman", Times, serif;
			font-size: 12pt;
		}
		div {
			height: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		form {
			width: 480px;
			box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.7);
			color: #333;
			border-radius: 10px;
		}
		form header {
			background: rgb(18, 2, 248);
			padding: 10px;
			color: white;
			font-size: 1.5em;
			font-weight: bold;
			border-radius: 10px 10px 0 0;
			text-align: center;
		}
		form section {
			padding: 15px;
		}
	</style>
</head>
<body>
  <div>
		<form method="post">
			<header>MovieLens Recommendation System: Login</header>
			<section>
				<?php if (isset($error)) echo '<div class="alert alert-danger mb-1">'.$error.'! ... โปรดลองอีกครั้ง</div>';?>
				<label class="mb-0" for="uname">UserID</label>
				<input id="uname" class="form-control mb-1" type="text" name="uname" placeholder="email" required>
				<label class="mb-0" for="pass">Password</label>
				<input id="pass" class="form-control mb-3" type="password" name="pass" placeholder="หมายเลขโทรศัพท์" required>
				<input class="form-control btn btn-primary" type='submit' name="submit" value='Login'>
			</section>
		</form>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>
