<?php
include "include/connection.php";
$isseller = $_GET['isseller'];
    $isrequest = $_GET['isrequest'];
    $idregister = $_GET['idregister'];


    $sqlis = "UPDATE `user` SET `is_seller`='$isseller',`is_request`='$isrequest' WHERE idRegister = $idregister";
    $resultis=mysqli_query($conn,$sqlis);

    if($resultis){
        header("location:requests.php");
    }
    ?>