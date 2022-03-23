<?php

echo $_GET['id'];
?>



<?php
include "include/header.php";
include "include/sidebar.php";
include "include/connection.php";
?> 

<head>
<style>
  
</style>
 
</head>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- <section class="content-header"> -->
      <h1>
        <!-- User Profile -->
      </h1>
     <!-- Main content -->
    <!-- <section class="content"> -->

      <div class="row">
        <div class="col-md-3">

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
       
                 <!-- //  $sql = "UPDATE employee ". "SET emp_salary = $emp_salary ". 
        //        "WHERE emp_id = $emp_id" ; -->

        <!-- <div class="col-md-9" >
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><b><h1>&nbsp;&nbsp;<u>Update product</h1></b></u></li>
            </ul>
            <div class="tab-content" >
              <div class="active tab-pane" id="activity">

              <div class="tab-pane" id="settings">
               -->
              
        <?php
        $id=$_GET['id'];
        $sql = "SELECT * FROM `product` WHERE idproduct=$id";
        $res=mysqli_query($conn,$sql);
        $n=mysqli_num_rows($res);
        if($n==1){
          $productSelectRow=mysqli_fetch_assoc($res);
          ?>
          
              <form class="form-horizontal" method ="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Product name :</label>

                    
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inpt"  name="pname" value="<?php echo $productSelectRow['pname']; ?>" >    
                    
                    
                    </div>
                    
                  </div>
                  
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">brand name :</label>

                    
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inpt"  name="bname" value=" <?php echo $productSelectRow['brand']  ?>" >    
                    
                    
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Min Set per Qty :</label>

                    
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inpt" name="minsetperqty" value= <?php echo $productSelectRow['minimum_set_qut-pur']  ?> >    
                    
                    
                    </div>
                    </div>    
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Qty of 1 set :</label>

                    
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inpt" name="qtyperset" value= <?php echo $productSelectRow['quantity_of_1_set']  ?>  >    
                    
                    </div>
                    
                  </div>
                    
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">MRP (&#8377;) :</label>

                    
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inpt" name="mrp" value= <?php echo $productSelectRow['MRP']  ?>>    
                    
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">price :</label>

                    
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inpt" name="price" value= <?php echo $productSelectRow['price']  ?>>    
                    </div>
                    
                  </div>
                
                  
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Description : </label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" name="desc" ><?php echo $productSelectRow['description']  ?></textarea>
                    </div>
                  </div>
                  

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Image :</label>

                    
                    <div class="col-sm-10">
                    <img src=<?php echo $productSelectRow['image'];?> height='100' width='100'>
                      <input type="file" class="form-control" id="img" name="image" value=<?php echo $productSelectRow['image']?>>    
                    </div>
                    
                  </div>
                  
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Image-2 :</label>

                    
                    <div class="col-sm-10">
                    <img src=<?php echo $productSelectRow['image2'];?> height='100' width='100'>
                      <input type="file" class="form-control" id="img" name="image2" value=<?php echo $productSelectRow['image2']?>>    
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label" >HSN number :</label>

                    
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inpt" name="hsn" value= <?php echo $productSelectRow['HSN_code']  ?>>    
                    </div>
                    
                  </div>
                
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">GST (%) :</label>

                    
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inpt" name="gst" value= <?php echo $productSelectRow['GST_rate']  ?>>    
                    </div>
                    
                  </div>
    
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button href="home.php"  type="submit" class="btn btn-success" name="updateproduct">Update Product</button>
                    </div>
                  </div>
                </form>
                <?php
                  }
                  ?>
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
  </div>
  <!-- /.content-wrapper -->
  
  <?php

if(isset($_POST['updateproduct'])) {
   $target_dir = "uploads/";
   $target_file = $target_dir . basename($_FILES["image"]["name"]);
   echo $target_file;
   $uploadOk = 1;
   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   // echo "<br><br>".$target_file;

   //image-2

   $target_dir2 = "image-2/";
   $target_file2 = $target_dir2 . basename($_FILES["image2"]["name"]);
   echo $target_file2;
   $uploadOk2 = 1;
   $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
 
   //    echo "updating...";
  $pname=$_POST['pname'];
  $bname=$_POST['bname'];
  $min_set_per_qty=$_POST['minsetperqty'];
  $qty_per_set=$_POST['qtyperset'];
  $mrp=$_POST['mrp'];
  $price=$_POST['price'];
  $description=$_POST['desc'];
  $hsn=$_POST['hsn'];
  $gst=$_POST['gst'];
 //  $id=$_COOKIE["idRegister"];
 //  $subcatid=$_GET["subcategaryid"];
 //  $subcatid=$productSelectRow['subcategory_idsubcategory'];

 $productid=$_GET['id'];
 if($target_file=="uploads/"){
     $target_file=$productSelectRow['image'];
}else{
 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
   && $imageFileType != "gif" ) {
   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
   $uploadOk = 0;
   }
   if($uploadOk==0){
       echo "file uploading failed...";
   }
   else{
       if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
           echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
         } else {
           echo "Sorry, there was an error uploading your file.";
         }
   }

}


//image-2

if($target_file2=="image-2/"){
  $target_file2=$productSelectRow['image2'];
}else{
if($imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg"
&& $imageFileType2 != "gif" ) {
echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
$uploadOk2 = 0;
}
if($uploadOk2==0){
    echo "file uploading failed...";
}
else{
    if (move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file2)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["image2"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
}

}
 


  $sql="UPDATE `product` SET `pname`='$pname' , `brand`='$bname' ,
   `minimum_set_qut-pur`=$min_set_per_qty , `quantity_of_1_set`=$qty_per_set,
   `MRP`=$mrp,`price`=$price,`description`='$description',`image`='$target_file',
   `image2`='$target_file2', `HSN_code`=$hsn,`GST_rate`=$gst WHERE `idproduct`=$productid";
// echo "<br>". $sql;
      $result=mysqli_query($conn,$sql);

//   echo "---------------------------------".$result;
  if($result>0){
   echo'<div class="alert alert-success">
   <strong>Success!</strong> product successfully added!
 </div>';

 echo '<script> 
    window.location.href="home.php"
 </script>';
//  header("location:home.php");
// exit();
         }
  else{
   echo'<div class="alert alert-danger">
   <strong>Success!</strong> Something went wrong while adding product...!!
 </div>
 '
 ;
  }
 }
?>

  <?php
  // include "include/footer.php";
  
  ?>
  <script>
  toastr.info("user  registerd")
  </script>