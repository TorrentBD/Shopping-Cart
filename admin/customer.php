<?php
include("check_session.php");
include("db.php");
error_reporting(0);
if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete')
{
$cust_id=$_GET['user_id'];

/*this is delet query*/
mysqli_query($connection,"delete from user_info where user_id='$cust_id'")or die("delete query is incorrect...");
} 

///pagination
$page=$_GET['page'];

if($page=="" || $page=="1")
{
$page1=0;	
}
else
{
$page1=($page*10)-10;	
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
  <?php include("include/header.php");?>
   	<div class="container-fluid main-container">
	<?php include("include/side_bar.php");?>
    <div class="col-md-8 content" style="margin-left:100px">
    <div class="panel-heading" style="background-color:#c4e17f">
	<h1>Customers  / Page <?php echo $page;?> </h1></div><br>
<div class='table-responsive'>  
<div style="overflow-x:scroll;">
<table class="table  table-hover table-striped" style="font-size:18px">
<tr><th>Customer ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Mobile</th><th>Address 1</th><th>Address 2</th></tr>
<?php 
$result=mysqli_query($connection,"select user_id, first_name, last_name,email,mobile,address1,address2 from user_info")or die ("query 1 incorrect.....");

while(list($user_id, $first_name, $last_name,$email,$mobile,$address1,$address2)=mysqli_fetch_array($result))
{	
echo "<tr><td>$user_id</td><td>$first_name</td><td>$last_name</td><td>$email</td><td>$mobile</td><td>$address1</td> <td>$address2</td>

<td>
<a class=' btn btn-success' href='orders.php?order_id=$order_id&action=delete'>Delete</a>
</td></tr>";
}
?>
</table>
</div></div>
<nav align="center"> 
<?php 
//counting paging

$paging=mysqli_query($connection,"select product_id,image, product_name,price from products");
$count=mysqli_num_rows($paging);

$a=$count/5;
$a=ceil($a);
echo "<bt>";echo "<bt>";
for($b=1; $b<=$a;$b++)
{
?> 
<ul class="pagination " style="border:groove #666">
<li><a class="label-info" href="orders.php?page=<?php echo $b;?>"><?php echo $b." ";?></a></li></ul>
<?php	
}
?>
</nav>
</div></div>
<?php include("include/js.php");?>
</body>
</html>