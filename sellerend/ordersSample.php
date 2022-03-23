<?php

include "include/header.php";
include "include/sidebar.php";
include "include/connection.php";
$id=$_COOKIE["idRegister"];

$salesOrderSQL="SELECT * FROM sales_orders WHERE User_idRegister=$id";


$res=mysqli_query($conn,$salesOrderSQL);

if(mysqli_num_rows($res) >0){

}

?>