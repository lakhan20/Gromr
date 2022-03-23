
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<?php
include "include/connection.php";

$oid= $_GET['orderid'];

$OrderDetailSQL="SELECT * FROM sales_product_details JOIN product ON sales_product_details.product_idproduct=product.idproduct  WHERE sales_product_details.sales_orders_idsales_orders=$oid";

$res=mysqli_query($conn,$OrderDetailSQL);

$num=mysqli_num_rows($res);
if($num>0){

echo '
<center> <h1>Order Detail</h1></center>';
    while($row=mysqli_fetch_assoc($res))
    {
        
    // echo $row['pname'];
?>

<!-- Scrollable modal -->
<div class="modal-dialog modal-dialog-scrollable">
  ...
</div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col"> #</th>
      <th scope="col">First</th>
    </tr>
    </thead>
  <tbody>
  <tr>
      <th scope="row">Product id :</th>
      <td><?php echo $row['idproduct']; ?></td>
    </tr>

    <tr>
      <th scope="row">Product Name</th>
      <td><?php echo $row['pname']; ?></td>
    </tr>

    <tr>
    <th scope="row">Product Brand</th>
      <td><?php echo $row['brand']; ?></td>
    </tr>
    <tr>
    <th scope="row">Minimum set per quantity:</th>
      <td><?php echo $row['minimum_set_qut-pur']; ?></td>
    </tr>
<tr>
    <th scope="row">quantity of one set:</th>
      <td><?php echo $row['quantity_of_1_set']; ?></td>
    </tr>
<tr>
    <!-- <th scope="row">MRP:</th>
      <td><?php echo $row['MRP']; ?></td>
    </tr>
    <tr>
    <th scope="row">price of product:</th>
      <td><?php echo $row['price']; ?></td>
    </tr> -->
    <tr>
    <th scope="row">discount:</th>
      <td><?php echo $row['discount_rs']; ?></td>
    </tr>
    <tr>
    <th scope="row">Description:</th>
      <td><?php echo $row['description']; ?></td>
    </tr>
    
    <tr>
    <th scope="row">Images:</th>
      <td><img src="<?php echo $row['image'] ?>" alt="" height="150px" width="150px">
      <img src="<?php echo $row['image2'] ?>" alt="" height="150px" width="150px">
    </td>
    </tr>

    <tr>
    <th scope="row">HSN code:</th>
      <td><?php echo $row['HSN_code'] ?></td>
    </tr>
    
    <tr>
    <th scope="row">GST rate:</th>
      <td><?php echo $row['GST_rate'] ?></td>
    </tr>
    
    <tr>
    <th scope="row">quantity:</th>
      <td><?php echo $row['Qty'] ?></td>
    </tr>
    
    <tr>
    <th scope="row">Price:</th>
      <td><?php echo $row['Price'] ?></td>
    </tr>

    <tr>
    <th scope="row">discount:</th>
      <td><?php echo $row['discount']  ?></td>
    </tr>
<br><br><br>
</tbody>
<hr>
<?php
}
}
else{

}

?>