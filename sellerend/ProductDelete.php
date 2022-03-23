<?php include "include/connection.php";?>

<script>
    if(confirm("Are you sure You Want to delete this product?")){
        console.log("if...");
<?php 

$id=$_GET['id'];
echo $id;
$DELETESQL="DELETE FROM `product` WHERE idproduct=$id";

$res=mysqli_query($conn,$DELETESQL);
    if($res){
    }
    else{
        echo "sw";
    }
?>
}
</script>

