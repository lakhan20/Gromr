<?php
include "include/header.php";
include "include/sidebar.php";
// include "include/connecion.php";

?>

<?php

if(isset($_POST['updatedeliverystatus'])){
   $deliverystatus=$_POST['deliverystatus'];
   echo $deliverystatus;
   $updatedeliverystatus="UPDATE sales_orders SET delivery_status=$deliverystatus";
   $res=mysqli_query($conn,$updatedeliverystatus);
   if($res>0){
       ?>
<script>
// alert("Delivery status updated...");
window.location.href = "orders.php";
</script>
<?php
   } 
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="content-wrapper">
        <section class="content">
            <?php
$oid=$_GET['oid'];
echo '
<table class="table table-bordered">
    <tbody>
        <tr class="active">
            <th><h4><b>ORDER No. : ODR00' . $oid . '</b></h4>
          </th>
</tbody>
</table>
          ';

          
?>
            <?php
            $sql1="SELECT * FROM sales_orders JOIN sales_product_details on 
            sales_orders.idsales_orders=sales_product_details.sales_orders_idsales_orders 
            JOIN product on sales_product_details.product_idproduct=product.idproduct
            JOIN user on sales_orders.User_idRegister=user.idRegister 
            WHERE sales_product_details.sales_orders_idsales_orders='$oid'
            ";
            $result22 = mysqli_query($conn,$sql1);  
            $rowss = mysqli_fetch_assoc($result22);
            
            ?>
            <?php
            // $c=var_dump($rowss['Is_canceled']);
           
            if($rowss['Is_canceled']==0 && $rowss['Is_canceled']!=NULL  ){
//   echo $rowss['delivery_status'];
?>

            <form method="post">
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 control-label">Update Delivery status :</label>
                    <div class="col-sm-10" id="subcatid">
                        <select class="form-control" name="deliverystatus">
                            <?php
                        if($rowss['delivery_status']==NULL){
                            $delivery="Packing";
                        }
                        else if($rowss['delivery_status']==0){
                            $delivery="Dispatched";
                            
                        }
                        else{
                            $delivery="Delivered";
                            
                        }
                        ?>
                            <option value="<?php echo $rowss['delivery_status']; ?>" disabled selected>

                                <?php echo  $delivery;?>
                            </option>
                            <option value="NULL">Packing </option>
                            <option value="0">Dispatched</option>
                            <option value="1">Delivered</option>


                        </select>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button onClick='javascript: return confirm("Are you sure you want to Update Delivery Status?");' type="submit" class="btn btn-primary" name="updatedeliverystatus">Update Delivery
                            Status</button>
                    </div>
                </div>
            </form>
            <hr>
            <?php
            
$summ = 0;
$total = 0;
$final = 0;
while ($row11 = mysqli_fetch_assoc($result22)) {
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
            <img src="' . $row11['image'] . '" alt="" width="100px" height="100px"/>
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
<td><b>₹ ' . $total . '</b><small><b>.00</b></small></td>
</tr>
<tr>
        <td colspan="2" align="right"><b>Gst Amount :</b></td>
        <td><b>₹ ' . $summ . '</b><small><b>.00</b></small></td>
    </tr>
    <tr>
        <td colspan="2" align="right"><b>Total Amount :</b></td>
        <td><b>₹ ' . $final . '</b><small><b>.00</b></small></td>
    </tr>
</tbody>
</table>';

?>
            ?>
            <?php
            }
            ?>
        </section>
    </div>
    <?php
include "include/footer.php";
?>

</html>