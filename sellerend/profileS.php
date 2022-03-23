<?php
include "include/header.php";
include "include/sidebar.php";
include "include/connection.php";
?> 

<head>
<style>
  /* #x{
    float:right;
  }
  #x{
    float:right;
  } */
</style>
 
</head>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

              <h3 class="profile-username text-center"><?php echo $row['bussiness_name']; ?></h3>

              <p class="text-muted text-center"><?php echo $row['name'];  ?></p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <!-- <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            /.box-header -->
            <!-- <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.C.A from the Gujrat University
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Navrangpura,Ahmedabad</p>

            </div> -->
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <?php
         if(isset($_POST['update'])) {
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
         
              <!-- <script>
                    function enabledisable(){
                    document.getElementById("inpt").disabled = true;
                    }
                </script> -->
        <!-- //  $sql = "UPDATE employee ". "SET emp_salary = $emp_salary ". 
        //        "WHERE emp_id = $emp_id" ; -->
        <div class="col-md-9" >
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><b><h1>&nbsp;&nbsp;<u>Update Your Details</h1></b></u></li>
            </ul>
            <div class="tab-content" >
              <div class="active tab-pane" id="activity">

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" method ="post">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <!-- <input type="text" class="form-control" id="inpt" value=<?php echo $row['name'];  ?> name="name" >    
                    -->
                    <input type="text" class="form-control" id="inpt"  name="name" value="<?php echo $row['name']; ?>" >    

                    </div>
                    
                    
                  </div>
                  
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" value=<?php echo $row['email_id'];  ?> name="email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Gst_number</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" value=<?php echo $row['gst_number'];  ?> name="gstnumber"> 
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Pan_number</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" value=<?php echo $row['pancard'];  ?> name="pannumber"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Aadhar_number</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" value=<?php echo $row['addhar_card'];  ?> name="aadharnumber"> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" name="address"><?php echo $row['address'];  ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Mobile_number</label>

                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inputSkills" value=<?php echo $row['mobile_number'];?>  name="mobilenumber" >
                    </div>
                  </div>
      
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success" name="update">Update</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
   
                  </div>
  </div>
  <!-- /.content-wrapper -->
  <?php
  include "include/footer.php"
  ?>
