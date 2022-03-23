<?php
include "include/db_connect.php";
include "include/header.php";
$uid=$_COOKIE['idRegister'];
?>




<br><br><br>
<section id="hero">
    <div class="container mt-5">
      
    <form class="row g-3" method="POST">
  
  <div class="col-lg-12">
    <label for="reason" class="form-label text-white">Enter your reason.</label>
    <input type="text" name="reason" placeholder="Enter here" class="form-control" id="reason" required>
  </div>
  <br><br><br><br>
  <center>
  <div class="col-12 mt-3">
    <button type="submit" class="">Cancel</button>
  </div></center>
</form>   </div>
</section>
<?php
include "include/db_connect.php";
$sid = $_GET['orderid'];
if (isset($_POST['reason'])) {
    $reason = $_POST['reason'];
    $sql = "UPDATE `sales_orders` SET `is_canceled`=1,`reason`='$reason' WHERE idsales_orders=$sid";
    $ress = mysqli_query($conn, $sql);
    if ($ress) {
        // echo "<script>alert('Order has been cancelled');</script>";
        echo "<script>window.location.href='order.php'</script>";
    }
}

?>
<br><br><br> 
<?php
include 'include/footer.php';
?>
<!-- jQuery Plugins -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/main.js"></script>

</body>

</html>