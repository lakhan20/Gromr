<!DOCTYPE html>
<html class="no-js" lang="en">

<!-- add to wishlist -->
<?php
  include "backend/header.php";
   include 'backend/db_connect.php';
    if(isset($_GET['idRetailer'])){
        $idRetailer = $_GET ['idRetailer'];
        // echo $idRetailer;
         $idProduct =  $_GET ['idProduct'];
        //  echo $idProduct;
   $sql1 = "SELECT * FROM `wishlist` WHERE wishlist.Retailer_idRetailer = $idRetailer AND wishlist.Product_Master_idProduct_Master = $idProduct";
   $result1 = mysqli_query($conn, $sql1);
   $num1 = mysqli_num_rows($result1);
   
   
    if($num1>0) { 

     echo '<script>alert("Product already added to wishlist");</script>';
    //   header('location:index.php');
 }
 else {
    $add="INSERT INTO  `wishlist` VALUES ( '$idRetailer', '$idProduct')";
    $add_query=mysqli_query($conn,$add);
    // echo $num1;
     //echo '<script>alert("Product not added to wishlist '.$num1.'");</script>';
    //  header('location:index.php');

}}
   ?>
<!-- end add to wishlist -->










<!--Body Content-->
<div id="page-content">
    <!--Home slider-->
    <div class="slideshow slideshow-wrapper pb-section sliderFull">
        <div class="home-slideshow">
            <div class="slide">
                <div class="blur-up lazyload bg-size">
                    <img class="blur-up lazyload bg-img" data-src="assets/images/slideshow-banners/banner.jpg"
                        src="assets/images/slideshow-banners/banner.jpg" alt="Shop Our New Collection"
                        title="Shop Our New Collection" />
                    <div class="slideshow__text-wrap slideshow__overlay classic bottom">
                        <div class="slideshow__text-content bottom">
                            <div class="wrap-caption center">
                                <!-- <h2 class="h1 mega-title slideshow__title">Shop Our New Collection</h2> -->
                                <!-- <span class="mega-subtitle slideshow__subtitle">From Hight to low, classic or modern. We have you covered</span> -->
                                <!-- <span class="btn">Shop now</span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Home slider-->
    <!--Collection Tab slider-->
    <div class="tab-slider-product section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-header text-center">
                        <h2 class="h2" id="main">New Arrivals</h2>
                        <p>Browse the huge variety of our products</p>
                    </div>
                    <div class="tabs-listing">

                        <?php

                                        
                                       $sql = "SELECT * FROM `product_master`;";
                                    
                                       $result = mysqli_query($conn,$sql);
                                                    
                                     //  $num = mysqli_num_rows($result);
                               
                                    

                                        ?>

                        <!-- --------------------------------------------------------------------------------- -->
                        <div class="tab_container">
                            <div id="tab1" class="tab_content grid-products">
                                <div class="productSlider">

                                    <!-- start product image -->

                                    <!-- start product image -->
                                    <?php
                                                      
                       while($row=mysqli_fetch_assoc($result)){
                       
                           
							//<!-- product -->
                            echo'
                           
							<div class="col-12 item">
								<div class="product-image">
                              
                                          
                                               
                                         
									<div class="product-image" >
                                 
										<a href="productlayout.php?idRetailer='.$rows["idRetailer"].''.'&idProduct='.$row["idProduct_Master"].'"><img src="admin/'.$row['image_url'].'" alt="image not found" width="100px" height="400px">
									  </a> </div>
                                      <div class="product-form__item--submit">
                                           <a  href="index.php?idRetailer='.$rows["idRetailer"].''.'&idProduct='.$row["idProduct_Master"].'">
                                             <button  type="button" name="idRetailer"> Add To Wishlist</button>
                                             </a>
                                            </div> 
                                      <div class="product-body"  >
										
										<h2 class="product-name"><b> '.$row['Product_Name'].'</b></a></h2>
										<h3 class="price">Color :- '.$row['Product_colors'].'</h3>
										<h3 class="product-size"> Size :- ' .$row['Product_Size'].'</h3>
                                        <h3 class="price"><b>Price :- ₹ '.$row['Product_Price'].'<small>.00</small></b></h3>
										
									</div>
                                   
                                    <a href="productlayout.php?idRetailer='.$rows["idRetailer"].''.'&idProduct='.$row["idProduct_Master"].'">
								       <button class="btn btn-addto-cart" type="button" tabindex="0">Add To Cart</button>
                                            </a>
                                                     
								</div>
							</div>
							<!-- product -->
                          
                       
                      ';
                          
                             
                       }
                       
                       
                        ?>







                                    <!-- end product image -->


                                </div>
                                <!-- end product image -->


                            </div>
                        </div>

                    </div>

                    <!-- -------------------------------------------------------------------------------- -->
                </div>
            </div>
        </div>
    </div>
    <!--Collection Tab slider-->






    <!--Store Feature-->
    <div class="store-feature section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="display-table store-info">



                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--End Store Feature-->
</div>
<!--End Body Content-->
<?php
           include "backend/footer.php";
           ?>
</body>


</html>