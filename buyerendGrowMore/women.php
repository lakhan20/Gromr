<?php

include'include/header.php';
include'include/db_connect.php';
$sql = "SELECT * FROM product JOIN subcategory on product.subcategory_idsubcategory=subcategory.idsubcategory JOIN category ON subcategory.category_idcategory=category.idcategory WHERE category.idcategory=2;";
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
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
                <li class="active"><a href="women.php">Women's Wear</a></li>
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

                    <li><a href="women.php">Women's Wear</a></li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->
<!-- section title -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Women's Wear</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Fabrics</a></li>
                            <li><a data-toggle="tab" href="#tab1">Kid's Wear</a></li>
                            <li><a data-toggle="tab" href="#tab1">Women's Wear</a></li>
                            <li><a data-toggle="tab" href="#tab1">Men's Wear</a></li>
                        </ul>
                    </div>
                </div>
            </div> -->
            <!-- /section title -->
            <!-- SECTION -->
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
										<h3 class="product-name"><a href="product.php?pid='.$row['idproduct'].'&sellerid='.$row['User_idRegister'].'">'.$row['pname'].'</a></h3>
										<h6 class="product-price">Price :- '.$row['price'].'</h6>
										<h3 class="product-mrp"> MRP :- ' .$row['MRP'].'</h3>
										<div class="product-btns">
											<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
										</div>
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
                                <span class="store-qty">Showing <?php echo "$num";?> products</span>
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

            <!-- NEWSLETTER -->
            <div id="newsletter" class="section">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="newsletter">
                                <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                                <form>
                                    <input class="input" type="email" placeholder="Enter Your Email">
                                    <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
                                </form>
                                <ul class="newsletter-follow">
                                    <li>
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-pinterest"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /NEWSLETTER -->

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