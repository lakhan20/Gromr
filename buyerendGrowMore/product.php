<?php
include "include/db_connect.php";
include "include/header.php";
$id=$_GET['pid'];
$sid=$_GET['sellerid'];
$sql="SELECT * FROM product INNER JOIN subcategory INNER JOIN category ON product.subcategory_idsubcategory=subcategory.idsubcategory where idproduct = 5 AND subcategory.category_idcategory=category.idcategory";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$uid=$_COOKIE['idRegister'];
$sql1="SELECT * FROM cart JOIN product ON cart.product_idproduct=product.idproduct WHERE cart.User_idRegister=$uid AND product.User_idRegister=$sid";
$result1 = mysqli_query($conn,$sql1);
$row1= mysqli_fetch_assoc($result1);    
$num1=mysqli_num_rows($result1);
$sql3 = "SELECT * FROM cart WHERE product_idproduct = '$id' AND User_idRegister = '$uid'";
$result3 = mysqli_query($conn,$sql3);
$row3= mysqli_fetch_assoc($result3);
$sql4 = "SELECT * FROM cart WHERE User_idRegister = '$uid'";
$result4 = mysqli_query($conn,$sql4);
$num4=mysqli_num_rows($result4);
$sql5 = "SELECT * FROM product NATURAL JOIN user WHERE product.User_idRegister=user.idRegister";
$result5 = mysqli_query($conn,$sql5);
$row5 = mysqli_fetch_assoc($result5);
if(isset($_POST['addtocart']))
{

$qty=$_POST['qty'];
if($num4==0 || mysqli_num_rows($result1)>0)
{
	//echo "----------------------hello";
	// echo "id : ".$uid;
	// echo "<br> qty :".$qty;
	// echo "<br> id :".$id;
			if($sid==$uid)
			{
               
				echo "
			<div class='alert alert-warning'>
			 		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			 		<b>You can't buy your own product..!</b>
		    </div>";
			}
			else if($row3>0)
			{	
              
			echo "
			<div class='alert alert-warning'>
			 		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			 		<b>Product is already added into the cart Continue Shopping..!</b>
		    </div>";
            //echo '<script> alert("Product is already added into the cart Continue Shopping..!") </script>';
			}
			else
			{
			$InsertCart = "INSERT INTO `cart` (`product_idproduct`,`User_idRegister`,`qty` ) VALUES ($id,$uid,$qty)";
			$res=mysqli_query($conn,$InsertCart);
				if($res>0){
                    
                    echo "<div class='alert alert-warning'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<b>Product added in your cart..!</b>
					 </div>";
				}
				else{
					echo "something wrong";
				}
				
			}
		}
else{
	echo "
			<div class='alert alert-warning'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<b>You have already another seller product in your cart ..!</b>
			 </div>";
}

}
if(isset($_POST['addtowishlist']))
{
    $sql6 = "SELECT * FROM wishlist WHERE User_idRegister=$uid and product_idproduct=$id";
    $result6 = mysqli_query($conn, $sql6);
    $num6 = mysqli_num_rows($result6);
 if($num6>0) { 
     echo "
     <div class='alert alert-warning'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
     <b>You have already added product continue shopping ..!</b>
      </div>";
 }
 else {
    $add="INSERT INTO `wishlist` VALUES ( '$uid', '$id')";
    $add_query=mysqli_query($conn,$add);
    echo "
     <div class='alert alert-warning'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
     <b>Your product added to wioshlist ..!</b>
      </div>";
 }
    
}
?>
<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li><a href="website.php">Home</a></li>
				<li><a href="fabric.php">Fabrics</a></li>
                <li><a href="kid.php">Kid's Wear</a></li>
                <li><a href="women.php">Women's Wear</a></li>
                <li><a href="men.php">Men's Wear</a></li>
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="website.php">Home</a></li>
                    <li><a href="#"><?php echo $row['subcategoryname'];?></a></li>
                    <li class="active"><?php echo $row['pname'];?></li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Product main img -->
            <div class="col-xs-4 col-sm-5 col-lg-5">
                <div id="product-main-img">
                    <div class="product-preview">
                        <img src="<?php echo $row['image']; ?>" alt="Sorry for the error" height=300px width=150px>
                    </div>
                    <div id="review-form">
                    <form class="review-form">
                        <textarea class="input" placeholder="Your Review"></textarea>
                        <div class="input-rating">
                            <span>Your Rating: </span>
                            <div class="stars">
                                <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                                <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                                <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                                <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                                <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
                            </div>
                        </div>
                        <button class="primary-btn">Submit</button>
                    </form>
                </div>
                </div>

            </div>
            <!-- /Product main img -->


            <!-- Product details -->
            <div class="col-xs-7 col-sm-6 col-lg-8">
                <div class="product-details">
                    <h2 class="product-name"> <?php echo $row["pname"];?> </h2>
                    <div>
                        <h3 class="product-price"><?php echo "₹" . $row['price'];?></h3>
                        <span class="product-available">In Stock</span>
                    </div>
                    <form method="post">
                        <div class="add-to-cart">
                            <div class="qty-label">
                                Qty
                                <div class="input-number">
                                    <input type="number" value=<?php echo $row['minimum_set_qut-pur'];?> name="qty">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>
                            <button class="add-to-cart-btn" name="addtocart"><i class="fa fa-shopping-cart"></i> add to
                                cart</button>
</div>
<div class="add-to-cart">
                            <button class="add-to-cart-btn" name="addtowishlist"><i class="fa fa-shopping-cart"></i> add to
                                wishlist</button>
                        </div>
                </div>
                </form>
                <form>
                    <table class="table table-striped table-hover table-bordered" id="myTable">
                        <?php echo'
							<tr>
							<th>Seller</th>
							<td><a href=user.php?id='.$row['User_idRegister'].'>'.$row5['bussiness_name'].'</td></a>
						</tr>
							<tr>
								<th>MRP</th>
								<td>₹'.$row['MRP'].'</td>
							</tr>
							<tr>
								<th>Description</th>
								<td>'.$row['description'].'</td>
							</tr>
							<tr>
								<th>Brand Name</li></th>
								<td><a href="#">'.$row['brand'].'</a>
							</tr>
							<tr>
								<th>Category Name</th>
								<td><a href="#">'.$row['categoryname'].'</a></td>
							</tr>
							<tr>
								<th>Subcategory Name</li></th>
								<td><a href="#">'.$row['subcategoryname'].'</a>
							</tr>
							<tr>
								<th>HSN Code</th>
								<td><a href="#">'.$row['HSN_code'].'</a>
							</tr>
							<tr>
								<th>Gst Rate</li></th>
								<td><a href="#">'.$row['GST_rate'].'%</a>
							</tr>
							<tr>
								<th>QTY of 1 set</li></th>
								<td><a href="#">'.$row['quantity_of_1_set'].'</a>
							</tr>
							<tr>
								<th>Minimum set of Purchase</li></th>
								<td><a href="#">'.$row['minimum_set_qut-pur'].'</a>
							</tr>
							';
							?>
                    </table>
                </form>
                
                
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->