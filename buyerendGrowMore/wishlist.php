<?php
include'include/header.php';
include'include/db_connect.php';
$uid=$_COOKIE['idRegister'];
$sql = "SELECT * FROM wishlist JOIN product on wishlist.product_idproduct=product.idproduct JOIN subcategory ON product.subcategory_idsubcategory=subcategory.idsubcategory WHERE wishlist.User_idRegister=$uid";
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

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="website.php">Home</a></li>
							
							<li><a href="Wishlist.php">Wishlist</a></li>
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
					
					<!-- STORE -->
					<div id="store" class="col-md-12">
                    <div class="section-title">
                    <h3 class="title">Wishlist</h3>
                    <!-- <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Fabrics</a></li>
                            <li><a data-toggle="tab" href="kid.php">Kid's Wear</a></li>
                            <li><a data-toggle="tab" href="women.php">Women's Wear</a></li>
                            <li><a data-toggle="tab" href="men.php">Men's Wear</a></li>
                        </ul>
                    </div> -->
                </div>
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