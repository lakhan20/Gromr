<?php
include "include/db_connect.php";
include "include/header.php";
$id=$_GET['pid'];
$sid=$_GET['sellerid'];
$sql="SELECT * FROM product INNER JOIN subcategory INNER JOIN category ON product.subcategory_idsubcategory=subcategory.idsubcategory where idproduct = $id AND subcategory.category_idcategory=category.idcategory";
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
$sql5 = "SELECT * FROM product NATURAL JOIN user WHERE product.User_idRegister=user.idRegister and product.idproduct=$id";
$result5 = mysqli_query($conn,$sql5);
$row5 = mysqli_fetch_assoc($result5);
$sql7 = "SELECT * FROM sales_orders JOIN sales_product_details on sales_orders.idsales_orders=sales_product_details.sales_orders_idsales_orders JOIN product ON sales_product_details.product_idproduct=product.idproduct JOIN user ON user.idRegister=sales_orders.User_idRegister JOIN rating ON rating.product_idproduct=product.idproduct where product.idproduct=$id";
$result7 = mysqli_query($conn,$sql7);
$row7 = mysqli_fetch_assoc($result7);
$sql8 = "SELECT * FROM `rating` JOIN product on rating.product_idproduct=product.idproduct JOIN `user` on rating.User_idRegister=user.idRegister WHERE product.idproduct=$id";
$result8 = mysqli_query($conn,$sql8);
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
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Hot Deals</a></li>
                <li><a href="#">Categories</a></li>
                <li><a href="#">Fabrics</a></li>
                <li><a href="#">Kid's Wear</a></li>
                <li><a href="#">Women's Wear</a></li>
                <li><a href="#">Men's Wear</a></li>
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->

<!-- BREADCRUMB -->
<!-- <div id="breadcrumb" class="section"> -->
<!-- container -->
<!-- <div class="container"> -->
<!-- row -->
<!-- <div class="row">
    <div class="col-md-12">
        <ul class="breadcrumb-tree">
            <li><a href="#">Home</a></li>
            <li><a href="#">All Categories</a></li>
            <li><a href="#">Men's Wear</a></li>
            <li><a href="#">Headphones</a></li>
            <li class="active">Product name goes here</li>
        </ul>
    </div>
</div> -->
<!-- /row -->
<!-- </div> -->
<!-- /container -->
<!-- </div> -->
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Product main img -->
            <div class="col-md-5 col-md-push-2">
                <div id="product-main-img">
                    <div class="product-preview">
                        <img src="../sellerend/<?php echo $row['image']; ?>" alt="" style="width:400px;height:400px;">
                    </div>

                    <div class=" product-preview">
                        <img src="../sellerend/<?php echo $row['image2']; ?>" alt="" style="width:400px;height:400px;">
                    </div>

                    <!-- <div class=" product-preview">
                        <img src="./img/product06.png" alt="">
                    </div>

                    <div class="product-preview">
                        <img src="./img/product08.png" alt="">
                    </div> -->
                </div>
            </div>
            <!-- /Product main img -->

            <!-- Product thumb imgs -->
            <div class="col-md-2  col-md-pull-5">
                <div id="product-imgs">
                    <div class="product-preview">
                        <img src="../sellerend/<?php echo $row['image']; ?>" alt="" style="height:150px;">
                    </div>

                    <div class=" product-preview">
                        <img src="../sellerend/<?php echo $row['image2']; ?>" alt="" style="height:150px;">
                    </div>

                    <!-- <div class="product-preview">
                        <img src="./img/product06.png" alt="">
                    </div>

                    <div class="product-preview">
                        <img src="./img/product08.png" alt="">
                    </div> -->
                </div>
            </div>
            <!-- /Product thumb imgs -->

            <!-- Product details -->
            <div class="col-md-5">
                <div class="product-details">
                    <h2 class="product-name"><?php echo $row["pname"];?></h2>
                    <div>
                        <div class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <a class="review-link" href="#">10 Review(s) | Add your review</a>
                    </div>
                    <div>
                        <h3 class="product-price">₹<?php echo $row["price"];?></h3>
                        <span class="product-available">In Stock</span>
                    </div>
                    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat.</p> -->

                    <!-- <div class="product-options">
                        <label>
                            Size
                            <select class="input-select">
                                <option value="0">X</option>
                            </select>
                        </label>
                        <label>
                            Color
                            <select class="input-select">
                                <option value="0">Red</option>
                            </select>
                        </label>
                    </div> -->
                    <form method="post">
                        <div class="add-to-cart">
                            <div class="qty-label">
                                Qty
                                <div class="input-number">
                                    <input type="number" value=<?php echo $row['minimum_set_qut-pur'];?> id="qty" name="qty">
                                    <span class=" qty-up">+</span>
                                    <span class="qty-down" onClick="qtym(<?php echo $row['minimum_set_qut-pur'];?>)"  id="qty" name="qty">-</span>
                                </div>
                            </div>
                            <button name="addtocart" class=" add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                                cart</button>
                        </div>

                        <ul class="product-btns">
                            <li>
                                <button name="addtowishlist"><i class="fa fa-heart-o"></i> add to wishlist</button>
                            </li>
                            <!-- <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li> -->
                        </ul>
                    </form>
                    <ul class="product-links">
                        <li>Category:</li>
                        <li><a href="#"></a></li>
                        <li><a href="#">Men's Wear</a></li>
                    </ul>

                    <!-- <ul class="product-links">
                        <li>Share:</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                    </ul> -->

                </div>
            </div>
            <!-- /Product details -->

            <!-- Product tab -->
            <div class="col-md-12">
                <div id="product-tab">
                    <!-- product tab nav -->
                    <ul class="tab-nav">
                        <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                        <li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
                    </ul>
                    <!-- /product tab nav -->

                    <!-- product tab content -->
                    <div class="tab-content">
                        <!-- tab1  -->
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
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
                        </div>
                        <!-- /tab1  -->


                        <!-- tab3  -->
                        <div id="tab3" class="tab-pane fade in">
                            <div class="row">
                                <!-- Rating -->
                                <div class="col-md-3">
                                    <div id="rating">
                                        <div class="rating-avg">
                                            <span>4.5</span>
                                            <div class="rating-stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <ul class="rating">
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 80%;"></div>
                                                </div>
                                                <span class="sum">3</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 60%;"></div>
                                                </div>
                                                <span class="sum">2</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Rating -->

                                <!-- Reviews -->
                                <div class="col-md-6">
                                    <div id="reviews">
                                        <ul class="reviews">
                                            <?php
                                        if($row8=mysqli_fetch_assoc($result8))
                                        {
                                            echo'
                                            <li>
                                                <div class="review-heading">
                                                    <h5 class="name">'.$row8["name"].'</h5>
                                                    <p class="bussiness name">'.$row8["bussiness_name"].'</p>
                                                    <div class="review-rating">';
                                                    $p = $row8["rating"];
                                                    for($i=0;$i<$p;$i++)
                                                    {   
                                                        echo'
                                                        <i class="fa fa-star"></i>';
                                                        
                                                    }
                                                    $q = 5 - $p;
                                                    for($j=0;$j<$q;$j++)
                                                    {   
                                                        echo'
                                                        <i class="fa fa-star-o empty"></i>';
                                                    }
                                                    echo'
                                                    </div>
                                                </div>
                                                <div class="review-body">
                                                    <p>'.$row8["Feedback"].'</p>
                                                </div>
                                            </li>';
                                        }
                                        ?>
                                            <!-- <li>
                                                <div class="review-heading">
                                                    <h5 class="name">John</h5>
                                                    <p class="date">27 DEC 2018, 8:0 PM</p>
                                                    <div class="review-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o empty"></i>
                                                    </div>
                                                </div>
                                                <div class="review-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                                        do eiusmod tempor incididunt ut labore et dolore magna
                                                        aliqua</p>
                                                </div>
                                            </li>-->
                                            <!-- <li>
                                                <div class="review-heading">
                                                    <h5 class="name">John</h5>
                                                    <p class="date">27 DEC 2018, 8:0 PM</p>
                                                    <div class="review-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o empty"></i>
                                                    </div>
                                                </div>
                                                <div class="review-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                                        do eiusmod tempor incididunt ut labore et dolore magna
                                                        aliqua</p>
                                                </div>
                                            </li> -->
                                        </ul>
                                        <ul class="reviews-pagination">
                                            <li class="active">1</li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Reviews -->

                                <!-- Review Form -->
                                <div class="col-md-3">
                                    <div id="review-form">
                                        <?php
                                        $num7 = mysqli_num_rows($result7);
                                        if($num7>0)
                                        {
                                            echo'
                                        <form class="review-form">
                                            <input class="input" type="text" value='.$row7["name"].' disabled>
                                            <input class="input" type="email" value='.$row7["email_id"].' disabled>
                                            <textarea class="input" placeholder="Your Review"></textarea>
                                            <div class="input-rating">
                                                <span>Your Rating: </span>
                                                <div class="stars">
                                                    <input id="star5" name="rating" value="5" type="radio"><label
                                                        for="star5"></label>
                                                    <input id="star4" name="rating" value="4" type="radio"><label
                                                        for="star4"></label>
                                                    <input id="star3" name="rating" value="3" type="radio"><label
                                                        for="star3"></label>
                                                    <input id="star2" name="rating" value="2" type="radio"><label
                                                        for="star2"></label>
                                                    <input id="star1" name="rating" value="1" type="radio"><label
                                                        for="star1"></label>
                                                </div>
                                            </div>
                                            <button class="primary-btn">Submit</button>
                                        </form>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- /Review Form -->
                            </div>
                        </div>
                        <!-- /tab3  -->
                    </div>
                    <!-- /product tab content  -->
                </div>
            </div>
            <!-- /product tab -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->

<?php

include 'include/footer.php';
?>


<!-- jQuery Plugins -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/main.js"></script>

</body>

<script>
function qtym(val) {
        

let v=parseInt(val)
let num=parseInt(document.getElementById('qty').value);
alert(val+"...."+"...."+num);
    if(num==v){

    }
    else
{
    document.getElementById('qty').value= parseInt(document.getElementById('qty').value) - 1;
}


    
    
   
    }
</script>
</html>