<?php
session_start();
//session_regenerate_id(true);
include("db.php");
$check=0;

if(isset($_POST['submit']))
{
$username = $_POST['name'];
$password = $_POST['password'];

$query=mysqli_query($connection,"select user_id from admin where name='$username' and password='$password'")or die ("query 1 incorrect.......");

list($user_id)=mysqli_fetch_array($query);

$_SESSION['user_id']=$user_id;
header("location: index.php");

$check=1;

if($check==0)
{
$check=2;
}

mysqli_close($connection);
}
?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../layout/css/bootstrap.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js"></script>
<title>Admin | Shopping </title>
</head>
<body>
	<div class="container page-header well" align="center">
	<img src="../product_images/logo.png" width="100px" height="100px">
	<h1 align="center">Welcome &nbsp;<i class="fas fa-lock-open"></i>
	Admin Login</h1>
		<div align="center">
			<form action="login.php" method="post" id="login" name="login" enctype="multipart/form-data">
				<div class="form-group">
				<input type="text" style="font-size:18px; width:200px" class="input-lg" name="name" id="name" placeholder="User-Name" required autofocus>
				</div>
				<div class="form-group">
				<input type="password" class="input-lg" name="password" style="font-size:18px; width:200px" id="password" placeholder="Password" required>
				 </div>
				 <div class="form-group">
				<button class="btn btn-large btn-lg btn-success" type="submit" name="submit" id="submit">Log in</button>
				</div>

			</form>
		</div>
	</div>
</body>
</html>