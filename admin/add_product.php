<?php
include("check_session.php");
include("db.php");
error_reporting(0);
if(isset($_POST['submit']))
{
    $product_key=$_POST['product_key'];
    $product_name=$_POST['product_title'];
    $details=$_POST['product_desc'];
    $price=$_POST['product_price'];
    $product_type=$_POST['product_cat'];
    $brand=$_POST['product_brand'];

    //picture coding
    $picture_name=$_FILES['picture']['name'];
    $picture_type=$_FILES['picture']['type'];
    $picture_tmp_name=$_FILES['picture']['tmp_name'];
    $picture_size=$_FILES['picture']['size'];

    if($picture_type=="image/jpeg" || $picture_type=="image/jpg" || $picture_type=="image/png" || $picture_type=="image/gif")
    {
    	if($picture_size<=50000000)
    	{
    		$pic_name=time()."_".$picture_name;
    		move_uploaded_file($picture_tmp_name,"../product_images/".$pic_name);
    		
    mysqli_query($connection,"insert into products (product_cat, product_brand,product_title, product_price,product_desc, product_image,product_keywords) values ('$product_type','$brand','$product_name','$price','$details','$pic_name','$product_key')") or die ("query incorrect");

     header("location: sumit_form.php?success=1");
    }else
    {}
    }else
    {}
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Admin | Shopping </title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="style/css/bootstrap.min.css" rel="stylesheet">
<link href="style/css/k.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

</head>
<body>
 
   	 <?php include("include/header.php");?>
   	<div class="container-fluid">
	<?php include("include/side_bar.php");?>
    <div class="col-md-8 content" style="margin-left:100px">
  	<div class="panel panel-default">
	<div class="panel-heading" style="background-color:#c4e17f">
	<h1><span class="glyphicon glyphicon-tag"></span> Product / Add Product  </h1></div><br>
	<div class="panel-body" style="background-color:#E6EEEE;">
		<div class="col-lg-7">
      <div class="well">
        <form action="add_product.php" method="post" name="form" enctype="multipart/form-data">
          <p>Product Key</p>
          <input class="input-lg thumbnail form-control" type="text" name="product_key" id="product_key" autofocus style="width:100%" placeholder="Product id" required>

          <p>Title</p>
          <input class="input-lg thumbnail form-control" type="text" name="product_title" id="product_title" autofocus style="width:100%" placeholder="Product Title" required>

          <p>Description</p>
          <textarea class="thumbnail form-control" name="product_desc" id="details" style="width:100%; height:100px" placeholder="Description write here..." required></textarea>

          <p>Add Image</p>
          <div style="background-color:#CCC">
            <input type="file" style="width:100%" name="picture" class="btn thumbnail" id="picture" >
          </div>
      </div>

    <div class="well">
      <h3>Pricing</h3>
      <p>Price</p>
      <div class="input-group">
          <div class="input-group-addon">BDT</div>
          <input type="text" class="form-control" name="product_price" id="product_price"  placeholder="0.00" required>
      </div><br>
    </div>

        </div>  
        <div class="col-lg-5">
        <div class="well">

          <h3>Category</h3>  
          <p>Product type</p>
          <input type="text" name="product_cat" id="product_cat" class="form-control" placeholder="Shirt, T-Shirt,electronics,.....">
          <br>
          <p>Vendor / Brand</p>
          <input type="text" name="product_brand" id="product_brand" class="form-control" placeholder="Polo, Nike,HP,Dell....">
          <br>
</div>          
</div>

<div align="center">
    <button type="submit" name="submit" id="submit" class="btn btn-default" style="width:100px; height:60px"> Cancel</button>
    <button type="submit" name="submit" id="submit" class="btn btn-success" style="width:150px; height:60px""> Add Product</button>
    </div>
        </form>
 
	</div>
</div></div></div>
<?php include("include/js.php"); ?>
</body>
</html>