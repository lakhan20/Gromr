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
                        if($num>0){
                            while($row = mysqli_fetch_assoc($result))
                            {
                            $a = $row['idsales_orders'];
                            echo'

                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="active">
                                        <th><h4><b>ORDER No. : ODR00'.$row['idsales_orders'].'</b></h4></th>
                                        <th><b>Order Placed : ('.$row['order_date'].')</th>
                                        <th>';
                                        // include "track.php";
                                            echo'
                                    </th>
                                    </tr>';
                            $sql2 = "SELECT * FROM sales_product_details NATURAL JOIN sales_orders NATURAL JOIN product WHERE sales_orders.User_idRegister=$uid and sales_product_details.sales_orders_idsales_orders=$a AND sales_product_details.product_idproduct=product.idproduct and sales_product_details.sales_orders_idsales_orders=sales_orders.idsales_orders";
                            $result2 = mysqli_query($conn,$sql2);
                            while($row2 = mysqli_fetch_assoc($result2))
                            {
                                echo'
                                    <tr>
                                        <td>
                                            <img src="'.$row2['image'].'" alt="" width="100px" height="100px"/>
                                        </td>
                                        <td>
                                            <span><b>Product Name : </b>'.$row2['pname'].'</span><br/>
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
                        No Return Found.
                    </div>';}
                    ?>
                        
</div>
</div>
</div>
</div>
