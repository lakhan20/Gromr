<?php
include "include/header.php";
include "include/sidebar.php";

?>

<?php
         if(isset($_POST['updateprofile'])) {
           echo "updating...";
           $name=$_POST['name'];
           $email=$_POST['email'];
           $gst_number=$_POST['gstnumber'];
           $pan_number=$_POST['pannumber'];
           $aadhar_number=$_POST['aadharnumber'];
           $address=$_POST['address'];
           $mobile_number=$_POST['mobilenumber'];
           $id=$_COOKIE["idRegister"];

           $sql="UPDATE user SET name='$name' , email_id='$email' , gst_number='$gst_number' , pancard='$pan_number' , addhar_card=$aadhar_number , address='$address' , mobile_number=$mobile_number where idRegister= $id";
          $result=mysqli_query($conn,$sql);
          // echo "---------------------------------".$result;
           if($result>0){
           echo'<div class="alert alert-success">
           <strong>Success!</strong> Data successfully updated!
         </div>';
         echo '<script> 
            window.location.href="home.php"
          </script>';

         // header("location:home.php");
                  }
           else{
            echo'<div class="alert alert-danger">
            <strong>Success!</strong> Something went wrong while updating...!!
          </div>';
           }

          }
         ?>
<body>
    
<div class="content-wrapper">
<section class="content-header">
    <h1>Manage Profile</h1>
    <hr>
</section>
<section class="content">

<form method="post">
<div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Name : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="" name="name" required value="<?php echo $row['name']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email : </label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="name" placeholder="" name="email" required value="<?php echo $row['email_id']; ?>" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">GST Number : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="" name="gstnumber" required value="<?php echo $row['gst_number']; ?>" >
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Pan Number : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="" name="pannumber" required value="<?php echo $row['pancard']; ?>" >
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Adhar Number : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="" name="aadharnumber" required value="<?php echo $row['addhar_card']; ?>" >
                </div>
            </div>
            <div class="form-group row">
                    <label for="inputExperience" class="col-sm-2 col-form-label">Address :</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" name="address"><?php echo $row['address'];  ?></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Mobile Number : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="" name="mobilenumber" required value="<?php echo $row['addhar_card']; ?>" >
                </div>
            </div>

            <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-success" name="updateprofile">Update Profile</button>
    </div>
  </div>
</form>

</section>
</div>
</body>

<?php
include "include/footer.php";

?>