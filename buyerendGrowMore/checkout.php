<?php
include 'include/header.php';
include 'include/db_connect.php';
$uid = $_COOKIE['idRegister'];
$sql = "SELECT * FROM `cart` NATURAL join product WHERE cart.User_idRegister=$uid AND product.idproduct=cart.product_idproduct";
$result = mysqli_query($conn,$sql);

//$row = mysqli_fetch_assoc($result);
if(isset($_POST['placeorder']))
{
    $gst = $_POST['tax'];
    $taxable = $_POST['taxable'];
    $subtotal = $_POST['subtotal'];
    // $sql1 = "SELECT * FROM sales_orders";
    // $result1 = mysqli_query($conn,$sql1);
    $sql2 = "INSERT INTO `sales_orders`(`taxable_amount`,`tax_amount`, `total_amount` , `User_idRegister`, `is_payment`) VALUES ('$taxable','$gst','$subtotal','$uid','1')";
    $result2 = mysqli_query($conn,$sql2);
    if($result2)
    {
        $sql3="SELECT * FROM `sales_orders` WHERE User_idRegister = $uid ORDER BY idsales_orders DESC LIMIT 1";
        $result3 = mysqli_query($conn,$sql3);
        $row3= mysqli_fetch_assoc($result3);
        $a = $row3['idsales_orders'];
        // $sql4 ="SELECT * FROM cart Where User_idRegister=$uid";
        // $result4 = mysqli_query($conn,$sql4);
        while($row4 = mysqli_fetch_assoc($result))
        {
            $sql5 = "INSERT INTO `sales_product_details`(`sales_orders_idsales_orders`, `product_idproduct`, `Qty`, `Price`, `discount`) VALUES ('$a','$row4[product_idproduct]','$row4[qty]','$row4[price]','$row4[discount_rs]')";
            $result5 = mysqli_query($conn,$sql5);
            if($result5)
            {
                $sql6 = "DELETE FROM `cart` WHERE User_idRegister=$uid";
                $result6 = mysqli_query($conn,$sql6);
                if($result6)
                {
                    // header("Location:success.php");
                }
            }
        }
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
                <h3 class="breadcrumb-header">Checkout</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="website.php">Home</a></li>
                    <li class="active">Checkout</li>
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

            <!-- <div class="col-md-7"> -->
            <!-- Billing Details -->
            <!-- <div class="billing-details">
							<div class="section-title">
								<h3 class="title">Billing address</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="first-name" placeholder="First Name">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="last-name" placeholder="Last Name">
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" placeholder="City">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip-code" placeholder="ZIP Code">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="tel" placeholder="Telephone">
							</div>
							<div class="form-group">
								<div class="input-checkbox">
									<input type="checkbox" id="create-account">
									<label for="create-account">
										<span></span>
										Create Account?
									</label>
									<div class="caption">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
										<input class="input" type="password" name="password" placeholder="Enter Your Password">
									</div>
								</div>
							</div>
						</div> -->
            <!-- /Billing Details -->

            <!-- </div> -->

            <!-- Order Details -->
            <div class="col-md-8 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Your Order</h3>
                </div>
                <div class="order-summary">
                    <div class="order-col">
                        <table class="table table-striped table-hover table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">SR NO.</th>
                                    <th scope="col">PRODUCT</th>
                                    <th scope="col">QTY</th>
                                    <th scope="col">RATE</th>
                                    <th scope="col">TAXABLE AMOUNT</th>
                                    <th scope="col">GST RATE</th>
                                    <th scope="col">GST AMOUNT</th>
                                    <th scope="col">TOTAL AMOUNT</th>
                                </tr>
                            </thead>
                    </div>
                    <div class="order-products">
                        <div class="order-col">
                            <tbody>
                                <?php
									$a=1;
									$subtotal=0;
									while($row=mysqli_fetch_assoc($result))
									{
									$b=0;
									$b=$row['qty'];
									$c=0;
									$c=$row['price'];
									$taxable=0;
									$taxable=$b*$c;
                                    $d=$row['GST_rate'];
                                    $gst=0;
                                    $gst=($taxable*$d)/100;
                                    $total = $taxable+$gst;
									$subtotal=$subtotal+$total;
									echo' <tr>
											<th>'.$a.'</th>
											<td>'.$row['pname'].'</td>
											<td>'.$row['qty'].'</td>
											<td>'.$row['price'].'</td>
                                            <th style="text-align:right">'.$taxable.'</th>
                                            <td>'.$row['GST_rate'].'%</td>
                                            <td style="text-align:right">'.$gst.'</td>
											<th style="text-align:right">'.$total.'</th>
										</tr>'; 
										$a++;
												
									}
                                    echo '';
								?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="order-summary">
                <div class="order-col">
                    <div><strong>SR NO.</strong></div>
                    <div><strong>PRODUCT</strong></div>
                    <div><strong>QTY</strong></div>
                    <div><strong>RATE</strong></div>
                    <div><strong>TOTAL</strong></div>
                </div>
                
							
							echo'
							<div class="order-products">
								<div class="order-col">
									<div></div>
									<div></div>
									<div></div>
									<div></div>
									<div></div>
								</div>
							</div>';
							
						 -->
                    <!-- <div class="order-col">
                        <div>Shiping</div>
                        <div><strong>FREE</strong></div>
                    </div> -->
                    <div class="order-col">
                        <div style="text-align:left"><strong>Total Amount = <?php echo $subtotal;?></strong></div>
                        <div><strong class="order-total"></strong></div>
                    </div>
                    <!-- </div> -->
                    <!-- <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-1">
                            <label for="payment-1">
                                <span></span>
                                Direct Bank Transfer
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut
                                    labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-2">
                            <label for="payment-2">
                                <span></span>
                                Cheque Payment
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut
                                    labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-3">
                            <label for="payment-3">
                                <span></span>
                                Paypal System
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut
                                    labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                    <div class="input-checkbox">
                        <input type="checkbox" id="terms">
                        <label for="terms">
                            <span></span>
                            I've read and accept the <a href="#">terms & conditions</a>
                        </label>
                    </div> -->
                    <!-- <a href="success.php" class="primary-btn order-submit">Place order</a> -->
                    <?php 
                    echo'
                    <form method="post">
                    <button class="primary-btn order-submit" name="placeorder"><i class="fa fa-shopping-cart"></i> place order</button>
                    <input type="hidden" name="taxable" value='.$taxable.'>
                                        
                                        <input type="hidden" name="subtotal" value='.$subtotal.'>
                    </form>';?>
                </div>
                <!-- /Order Details -->
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