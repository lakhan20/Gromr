<?php
include "include/header.php";
include "include/sidebar.php";
include "include/connection.php";
?>
<div class="content-wrapper">
    <section class="content">
        <?php
$orderid = $_GET['idSales'];
$sql = "SELECT * FROM `sales_orders` WHERE idsales_orders=$orderid ";
$ress = mysqli_query($conn, $sql);
$num4 = mysqli_num_rows($ress);

// $sql11="SELECT * FROM sales_order_detail JOIN product_master ON sales_order_detail.Product_Master_idProduct_Master = product_master.idProduct_Master WHERE sales_order_detail.Sales_Order_idSales_Order =$orderid";
$sql11 = "SELECT * FROM sales_product_details LEFT OUTER JOIN sales_orders ON sales_product_details.sales_orders_idsales_orders =idsales_orders LEFT OUTER JOIN product on product_idproduct =product.idproduct WHERE  sales_orders.idsales_orders = $orderid";
$res11 = mysqli_query($conn, $sql11);
$row111 = mysqli_fetch_assoc($ress);
echo'
<table class="table table-bordered 
">
<tbody >
    <tr class="">
        <th><h4><b>ORDER No. : ODR00' . $orderid . '</b></h4>
      </th>
       ';
// include "track.php";


$summ = 0;
$total = 0;
$final = 0;
while ($row11 = mysqli_fetch_assoc($res11)) {
// echo $row11['Product_Name'] . "<br>";
// echo $row11['Product_qty'] . "<br>";
// echo "<br>".$row11['Product_Price'] . "<br>";
// echo "<br>".$row11['Total_Amount'] . "<br>";
$proid = $row11['product_idproduct'];
$qty = $row11['Qty'];
$taxable = $row11['Price'];
$total1 = $qty * $taxable;
$total = $total + $total1;
$summ = ($total * 12) / 100;
$final = $total + $summ;
echo '
    <tr>
        <td>
            <img src="../sellerend/' . $row11['image'] . '" alt="" width="100px" height="100px"/>
        </td>
        <td>
            <span><b>Product Name : </b>' . $row11['pname'] . '</span><br/>
             <span><b>Details :</b>' . $row11['description'] . '</span><br/>
            </td>
        <td>
        <span><b>Quantity : </b>' . $row11['Qty'] . '</span><br/>
        <span><b>Product Price : </b>₹ ' . $row11['Price'] . '</span><br/>
       
        </td>
       
    </tr>';
}


echo '
<tr>
<td colspan="2" align="right"><b>Taxable Amount :</b></td>
<td><b>₹ ' . $total . '</b><b>.00</b></td>   

</tr>
<tr>
        <td colspan="2" align="right"><b>Gst Amount :</b></td>
        <td><b>₹ ' . $summ . '</b><small><b></b></small></td>
    </tr>
    <tr>
        <td colspan="2" align="right"><b>Total Amount :</b></td>
        <td><b>₹ ' . $final . '</b><small><b></b></small></td>
    </tr>
</tbody>
</table>';

?>
    </section>
</div>
<?php

include 'include/footer.php';

?>