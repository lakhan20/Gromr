<?php
include "include/db_connect.php";
include "include/header.php";
$sql="SELECT * FROM product INNER JOIN subcategory ON product.subcategory_idsubcategory=subcategory.idsubcategory";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$num = mysqli_num_rows($result);
// echo var_dump($row);
// echo $row['description'];
//echo $_GET['pid'];
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
<!-- SECTION -->
<div class="section">
		
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">New Products</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab1">Fabrics</a></li>
									<li><a data-toggle="tab" href="#tab1">Kid's Wear</a></li>
									<li><a data-toggle="tab" href="#tab1">Women's Wear</a></li>
									<li><a data-toggle="tab" href="#tab1">Men's Wear</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

		<!-- /SECTION -->
							<!-- Products tab & slick -->
<div class="col-md-12" id="p">
	<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
										<!-- product -->
										<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

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
										<h3 class="product-name"><a href="#">'.$row['pname'].'</a></h3>
										<h6 class="product-price">Price :- '.$row['price'].'</h6>
										<h3 class="product-mrp"> MRP :- ' .$row['MRP'].'</h3>
										<div class="product-btns">
											<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
										</div>
									</div>
									<div class="add-to-cart">
										<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
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
