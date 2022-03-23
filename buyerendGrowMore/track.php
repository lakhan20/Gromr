<?php
include "include/db_connect.php";
$sql = "SELECT * FROM `sales_orders`";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
if($row['status']==NULL)
{
    echo'
      <button class="cancel" type="button">Cancel Order</button>';
}
