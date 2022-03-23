
    <?php
include "include/connection.php";
$orderid=$_GET['salesOrderId'];
$iscanceled=$_GET['isCanceled'];
?>

<?php
$acceptRequest="UPDATE sales_orders SET Is_canceled=$iscanceled WHERE idsales_orders='$orderid'";
// echo "<br>".$acceptRequest;

$res=mysqli_query($conn,$acceptRequest);
// echo "<br>". var_dump($res);
// $n=mysqli_num_rows($res);
// echo "----------".$n;
if($res){
    // echo "order done..";

    echo '<script> 
    window.location.href="orders.php"
 </script>';
}
else{
    
    echo "error..".error_get_last();
    echo "sw";
}                  


?>
