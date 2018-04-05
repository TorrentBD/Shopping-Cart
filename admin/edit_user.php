<?php
include("check_session.php");
include("db.php");
$user_id=$_REQUEST['user_id'];

$result=mysqli_query($connection,"select user_id,name,email,password from admin where user_id='$user_id'")or die ("query 1 incorrect.......");

list($user_id,$name,$email,$password)=mysqli_fetch_array($result);

if(isset($_POST['btn_save'])) 
{
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];

mysqli_query($connection,"update admin set name ='$name',email='$email',password='$password' where user_id ='$user_id'") or die ("query incorrect updating ");

header("location: manage_user.php");
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
   	<div class="container-fluid main-container">
	<?php include("include/side_bar.php");?>
    
	<div class="col-md-8" style="margin-left:100px">   
<div class="panel-heading" style="background-color:#c4e17f">
	<h1>Edit User Details </h1></div><br>
<form action="edit_user.php" name="form" method="post" enctype="multipart/form-data">
<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>" />
<label style="font-size:18px;">User-name</label>
<br>
<input class="input-lg" style="font-size:18px; width:200px" name="name" type="text"  id="name" value="<?php echo $name; ?>" autofocus><br><br>
<label style="font-size:18px;">User-Email</label>
<br>
<input class="input-lg" style="font-size:18px; width:200px" name="email" type="email"  id="email" value="<?php echo $email; ?>" autofocus><br><br>
<label style="font-size:18px;">Password</label>
<br>
<input class="input-lg" style="font-size:18px; width:200px" name="password" type="text"  id="password" value="<?php echo $password; ?>">
<br><br>
 <button type="submit" class="btn btn-success" name="btn_save" id="btn_save" style="font-size:18px">Submit</button>
</form>
</div></div>
<?php include("include/js.php");?>
</body>
</html>