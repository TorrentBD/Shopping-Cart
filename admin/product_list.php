<?php
include("check_session.php");
include("db.php");
error_reporting(0);
if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete')
{
$product_id=$_GET['product_id'];
///////picture delete/////////
$result=mysqli_query($connection,"select product_image from products where product_id='$product_id'")
or die("query is incorrect...");

list($product_image)=mysqli_fetch_array($result);

$path="../product_images/$product_image";

if(file_exists($path)==true)
{
  unlink($path);
}
else
{}
/*this is delet query*/
mysqli_query($connection,"delete from products where product_id='$product_id'")or die("query is incorrect...");
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
	<h1>Product list / Page <?php echo $page;?> </h1></div><br>
<div class='table-responsive'>  
<div style="overflow-x:scroll;">
<table class="table  table-hover table-striped" style="font-size:18px">
<tr><th>Product Image</th><th>Product Name</th><th>Category</th><th>Price</th><th>
	<a class=" btn btn-primary" href="add_product.php">Add New</a></th></tr>
<?php 

$result=mysqli_query($connection,"select product_image, product_title,product_cat,product_price from products Limit $page1,10")or die ("query 1 incorrect.....");

while(list($product_image,$product_title,$product_cat,$product_price)=mysqli_fetch_array($result))
{
echo "<tr><td><img src='../product_images/$product_image' style='width:50px; height:50px; border:groove #000'></td><td>$product_title</td><td>$product_cat</td>
<td>$product_price</td>
<td>

<a class=' btn btn-success' href='product_list.php?product_id=$product_id&action=delete'>Delete</a>
</td></tr>";
}

?>
</table>
</div></div>

<nav align="center">
  

<?php 
//counting paging

$paging=mysqli_query($connection,"select product_id,product_image, product_title,product_price from products");
$count=mysqli_num_rows($paging);

$a=$count/10;
$a=ceil($a);
echo "<bt>";echo "<bt>";
for($b=1; $b<=$a;$b++)
{
?> 
<ul class="pagination" style="border:groove #666">
<li><a class="label-info" href="product_list.php?page=<?php echo $b;?>"><?php echo $b." ";?></a></li></ul>
<?php	
}
?>
</nav>
</div></div>
<?php include("include/js.php");?>
</body>
</html>