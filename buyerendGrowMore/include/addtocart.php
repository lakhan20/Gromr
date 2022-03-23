<?php
include "include/db_connect.php";
$idReg=$_COOKIE['idRegister'];
$uid=$_COOKIE['idRegister'];
$sql2 = "SELECT * FROM cart JOIN product ON cart.product_idproduct=product.idproduct WHERE cart.User_idRegister=$idReg";
$result2 = mysqli_query($conn,$sql2);
$num2 = mysqli_num_rows($result2);
if(isset($_POST['del']))
{
    $id = $_POST['pid'];
    $sql="DELETE FROM `cart` WHERE cart.product_idproduct=$id and cart.User_idRegister=$uid";
    $result = mysqli_query($conn,$sql);
    if($result)
    {
        header ("Refresh:0");
    }
}
?>
<div class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <i class="fa fa-shopping-cart"></i>
        <span>Your Cart</span>
        <div class="qty"><?php echo $num2;?></div>
    </a>
    <div class="cart-dropdown">
        <div class="cart-list">
            <?php
                                    $total = 0;
                                    while($row2 = mysqli_fetch_assoc($result2))
                                    {
									$taxable = $row2['price']*$row2['qty'];
									$tax = ($taxable*$row2['GST_rate'])/100;
                                    $pprice= $taxable+$tax;
									$total=$total+$pprice;
									echo '
                                    <div class="product-widget">
									
												
									<div class="product-img">
	
										<img src="'.$row2['image'].'"alt="Sorry " width="50px" height="50px">
									</div>
                                            <form method="post">
												<div class="product-body">
													<h3 class="product-name"><a href="product.php?pid='.$row2['idproduct'].'&sellerid='.$row2['User_idRegister'].'">'.$row2['pname'].'</a></h3>
													<h4 class="product-price"><span class="qty">'.$row2['qty'].' x</span>₹ '.$row2['price'].'</h4>
                                                    <input type="hidden" name="pid" value='.$row2['idproduct'].'>
                                                   <button name="del"><i class="fa fa-close"> Delete </i></button>

												</div>
                                            </form>
											</div>
                                    		';}
                                        ?>
        </div>


        <div class="cart-summary">
            <small> <?php echo $num2;?> Item(s) selected</small>
            <h5>SUBTOTAL: <?php echo $total;?></h5>
        </div>
        <div class="cart-btns">
            <a href="checkout.php">Checkout <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<!-- <a href = delete.php?pid='.$row['product_idproduct'].'><button><i class="fa fa-close"> Delete </i></button></a> -->