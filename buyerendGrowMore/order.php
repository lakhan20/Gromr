<?php
include 'include/header.php';
include 'include/db_connect.php';
$uid=$_COOKIE['idRegister'];
$sql="SELECT * FROM `sales_orders` WHERE User_idRegister=$uid ORDER by idsales_orders DESC;";
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
?>
<div class="product-cart-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-head">My Orders</h2>

                <?php
 
                            if ($num > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $date = date_create($row["order_date"]);
                                    date_add($date, date_interval_create_from_date_string("30 days"));
                                    $a = $row['idsales_orders'];
                                    if ($row['Is_canceled'] == null) {
                                        $status = "Pending";
                                    } else if ($row['Is_canceled'] == 1) {
                                        $status = 'Canceled <br>Cancel Reason : ' . $row['reason'] . '<br>Cancel Date : ' . $row['cancel_date'] . '</b>';
                                    } else if ($row['Is_canceled'] == 0) {
                                        $status = "Accepted" . "<br>
                                        &nbsp  &nbsp  &nbsp <a href='invoice.php?orderid=" . $row['idsales_orders'] . "'><button type='submit'><b>Download Invoice</b></button></a>";
                                    }
                            echo'

                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="active">
                                        <th><h4><b>ORDER No. : ODR00'.$row['idsales_orders'].'</b></h4>
                                        <b>Order Placed : ('.$row['order_date'].')</b></th>
                                        <th>Order Status : '.$status.' </th>';
                                        if ($row['Is_canceled'] == null) {
                                          echo "  <th><a href='cancel_order.php?orderid=" . $row['idsales_orders'] . "'><button type='button' name='cancel'>
                                                                      Cancel</button></a><br> 
                                                                       </th>";
                                                                       
                                        } else if ($row['Is_canceled'] == 1) {
                                            echo'<th></th>';
                                        } else if ($row['Is_canceled'] == 0) {
            
                                            echo '
                                            <th><button type="button" name="cancel" data-toggle="modal" data-target="#exampleModalCenter">
                                                                      Return</button></a><br> 
                                                                       </th>';
                                                                       }
                                        
                                        echo'
                                    </tr>';
                            $sql2 = "SELECT * FROM sales_product_details NATURAL JOIN sales_orders NATURAL JOIN product WHERE sales_orders.User_idRegister=$uid and sales_product_details.sales_orders_idsales_orders=$a AND sales_product_details.product_idproduct=product.idproduct and sales_product_details.sales_orders_idsales_orders=sales_orders.idsales_orders";
                            $result2 = mysqli_query($conn,$sql2);
                            while($row2 = mysqli_fetch_assoc($result2))
                            {
                                echo'
                                    <tr>
                                        <td>
                                        <a href=product.php?pid='.$row2['idproduct'].'&sellerid='.$row2['User_idRegister'].'><img src="'.$row2['image'].'" alt="" width="100px" height="100px"/></a>
                                        </td>
                                        <td>
                                            <span><b>Product Name : </b><a href=product.php?pid='.$row2['idproduct'].'&sellerid='.$row2['User_idRegister'].'>'.$row2['pname'].'</a></span><br/>
                                            <span><b>Product Brand : </b>'.$row2['brand'].'</span><br/>
                                            <span><b>HSN Code : </b>'.$row2['HSN_code'].'</span><br/>
                                        </td>
                                        <td>
                                        <span><b>Quantity : </b>'.$row2['Qty'].'</span><br/>
                                        <span><b>Product Price : </b>'.$row2['Price'].'</span><br/>
                                        <span><b>Product Discount : </b>'.$row2['discount_rs'].'</span><br/>
                                        </td>
                                       
                                    </tr>';
                                    }
                                
                                echo'
                                <tr>
                                <td colspan="2" align="right"><b>Taxable Amount</b></td>
                                <td><b>'.$row['taxable_amount'].'</b></td>
                            </tr>
                            <tr>
                                        <td colspan="2" align="right"><b>Gst Amount</b></td>
                                        <td><b>'.$row['tax_amount'].'</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="right"><b>Total Amount</b></td>
                                        <td><b>'.$row['total_amount'].'</b></td>
                                    </tr>
                                </tbody>
                            </table>';
                                }
                                     }
                        else{
                            echo'
                                <div class="empty-result">
                        No Orders Found.
                    </div>';}
                    ?>

            </div>
        </div>
    </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/main.js"></script>