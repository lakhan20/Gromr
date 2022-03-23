<?php
    include 'include/db_connect.php';
    $id=$_GET['pid'];
    $uid=$_COOKIE['idRegister'];
    $sql="DELETE FROM `cart` WHERE product_idproduct=$id and User_idRegister=$uid";
    $result = mysqli_query($conn,$sql);
    if($result)
    {
    
    }
?>