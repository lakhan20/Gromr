<?php
include 'include/header.php';
include 'include/db_connect.php';
$JoinSQL="SELECT * FROM product INNER JOIN subcategory ON product.subcategory_idsubcategory=subcategory.idsubcategory order by idproduct desc limit 10";
$result = mysqli_query($conn,$JoinSQL);
?>


<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="active"><a href="website.php">Home</a></li>

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
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="./image/fabric.jpg" alt="" height=300px width=150px>
                    </div>
                    <div class="shop-body">
                        <h3>Fabrics<br>Collection</h3>
                        <a href="fabric.php" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="./image/menswear.jfif" alt="" height=300px width=150px>
                    </div>
                    <div class="shop-body">
                        <h3>Men's Wear<br>Collection</h3>
                        <a href="men.php" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="./image/women.jpg" alt="" height=300px width=150px>
                    </div>
                    <div class="shop-body">
                        <h3>Women's Wear<br>Collection</h3>
                        <a href="women.php" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">New Products</h3>
                    <!-- <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Fabrics</a></li>
                            <li><a data-toggle="tab" href="kid.php">Kid's Wear</a></li>
                            <li><a data-toggle="tab" href="women.php">Women's Wear</a></li>
                            <li><a data-toggle="tab" href="men.php">Men's Wear</a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
            <!-- STORE -->
            <div id="store" class="col-md-13">
                <!-- store products -->
                <div class="row">
                    <?php
                        while($row=mysqli_fetch_assoc($result)){
							//<!-- product -->
                            echo'
                            
							<div class="col-md-3 col-xs-8">
								<div class="product">
									<div class="product-img">
										<img src='.$row['image'].' alt="Sorry , for the error" height=200px width=150px>
									</div>
									<div class="product-body">
										<p class="product-category">'.$row['subcategoryname'].'</p>
										<h3 class="product-name"><a href=product.php?pid='.$row['idproduct'].'&sellerid='.$row['User_idRegister'].'>'.$row['pname'].'</a></h3>
										<h6 class="product-price">Price :- '.$row['price'].'</h6>
										<h3 class="product-mrp"> MRP :- ' .$row['MRP'].'</h3>
									</div>
								</div>
							</div>
							<!-- /product -->';
                        }
                        ?>

                </div>
                <!-- /store products -->

                <!-- store bottom filter -->
                <div class="store-filter clearfix">
                    <!-- <span class="store-qty">Showing <?php //echo "$num";?> products</span> -->
                </div>
                <!-- /store bottom filter -->
            </div>
            <!-- /STORE -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->



<?php

include'include/footer.php';
?>
<!-- jQuery Plugins -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/main.js"></script>

</body>

</html>