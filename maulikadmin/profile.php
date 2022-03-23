<?php
include "include/header.php";
 include "include/sidebar.php";
include "include/connection.php";
?>

<?php

if(isset($_POST['updatep'])){
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];

    $sql = "UPDATE `admin` SET `first_name` = '$name', `last_name` = '$surname', `email_id` = '$email' WHERE `idadmin` = '$id'";
    $result = mysqli_query($conn,$sql);
    if($result>0){
      //  echo "updated";
      
      echo "<script>
       window.location.href='home.php' </script>";
        
    }else{
        echo "fail";
    }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

        <div class="row">

            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><b>
                                <h1>&nbsp;&nbsp;Update Profile</h1>
                            </b></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal needs-validation" action="" method="POST">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                                        <div class="col-sm-10">
                                            <input type="name" class="form-control" id="inputName"
                                                placeholder="Please Enter Your Name" name="name"
                                                value="<?php echo $name; ?>" required>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Surname</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName"
                                                placeholder="Please Enter Your surname" name="surname"
                                                value="<?php  echo $surname;  ?>" required>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail"
                                                value="<?php  echo $emailid;  ?>" name="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger" name="updatep">Update</button>

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
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
   
  include "include/footer.php"
?>