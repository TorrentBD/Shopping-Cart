<?php
include("check_session.php"); 
include("db.php");

if(isset($_POST['btn_save']))
{
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];

mysqli_query($connection,"insert into admin (name,email,password) values ('$name','$email','$password')") or die ("query incorrect inserting ");

header("location: manage_users.php"); 
mysqli_close($connection);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Admin Panel</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="style/css/bootstrap.min.css" rel="stylesheet">
<link href="style/css/k.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</head>
<body>
<?php include("include/header.php"); ?>

<div class="container-fluid">
<?php include("include/side_bar.php"); ?>

  <div class="col-md-8" style="margin-left:100px"> 
  <div class="panel-heading" style="background-color:#c4e17f">
	<h1>Add User  </h1></div><br>
	
<form action="add_user.php" name="form" method="post">
	<input name="name" class="input-lg" type="text"  id="name" style="font-size:18px; width:200px" placeholder="User-Name" autofocus required><br><br>

	<input name="email" class="input-lg" type="email"  id="email" style="font-size:18px; width:200px" placeholder="User-Email" autofocus required><br><br>

	<input name="password" class="input-lg" type="text"  id="password" style="font-size:18px; width:200px"  placeholder="Password" required>
	<hr>

	 <button type="submit" class="btn btn-success" name="btn_save" id="btn_save" style="font-size:18px">Submit</button>
</form>
</div></div>
<?php include("include/js.php"); ?>
</body>
</html>