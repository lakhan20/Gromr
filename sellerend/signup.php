<?php

include 'partial/header.php';
include 'include/connection.php';
 

echo $_SERVER['REQUEST_METHOD'];

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $b_name = $_POST['b_name'];
    $mobile_no = $_POST['mobile_no'];
    $gst_no = $_POST['gst_no'];
    $pan_no = $_POST['pan_no'];
    $adhar_no = $_POST['adhar_no'];
    // $bank_a_no = $_POST['bank_a_no'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    $sql="INSERT INTO `user` (`email_id`, `password`, `name`, `bussiness_name`, `is_request`, `gst_number`, `mobile_number`, `pancard`, `addhar_card`, `address`, `is_seller`, `commissionn_rate`, `admin_idadmin`, `Bank_idBank`, `area_area_pincode`) VALUES ( '$email', '$password', '$name', '$b_name', NULL, '$gst_no', '$mobile_no', '$pan_no', '$adhar_no', '$address', NULL, NULL, NULL, NULL, NULL)
    ";

    $result=mysqli_query($conn,$sql);

    if($result){
      //echo'success';
      header("location:login.php");
    }else{
      echo'mysqli_error($conn)';
    }
    
}

?>
<!-- ======= Hero Section ======= -->
<section id="hero">
    <div class="container mt-5">
      
    <form class="row g-3" method="post">
  <div class="col-md-6">
    <label for="name" class="form-label text-white">Name</label>
    <input type="text" name="name" class="form-control" id="name">
  </div>
  <div class="col-md-6">
    <label for="b_name" class="form-label text-white">Business Name</label>
    <input type="text" name="b_name" class="form-control" id="b_name">
  </div>
  <div class="col-md-6">
    <label for="mobile number" class="form-label text-white">Mobile No.</label>
    <input type="number" name="mobile_no" class="form-control" id="mobile number">
  </div>
  <div class="col-md-6">
    <label for="gst number" class="form-label text-white">GST No.</label>
    <input type="number" name="gst_no" class="form-control" id="gst number">
  </div>
  <div class="col-md-6">
    <label for="pan number" class="form-label text-white">Pan No.</label>
    <input type="number" name="pan_no" class="form-control" id="pan number">
  </div>
  <div class="col-md-6">
    <label for="adhar number" class="form-label text-white">Adhar no.</label>
    <input type="number" name="adhar_no" class="form-control" id="adhar number">
  </div>
  <div class="col-md-6">
    <label for="bank acoount number" class="form-label text-white">Bank Accountant No.</label>
    <input type="number" name="bank_a_no" class="form-control" id="bank account number">
  </div>
  <div class="col-md-6">
    <label for="e_mail" class="form-label text-white">E-mail</label>
    <input type="email" name="email" class="form-control" id="email">
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label text-white">Address</label>
    <input type="text" name="address" class="form-control" id="inputAddress" >
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label text-white">Password</label>
    <input type="password" name="password" class="form-control" id="inputPassword4">
  </div>
  
  <div class="col-12 mt-3">
    <button type="submit" class="btn btn-light">Sign in</button>
  </div>
</form>   </div>
</section><!-- End Hero -->
 
