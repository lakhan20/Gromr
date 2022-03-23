<?php
include "include/header.php";

include "include/sidebar.php";

?>
<style>
 
 
    </style>
<div class="content-wrapper" >
<div class="content-header">
<h1>
    Update product
</h1>
<hr>

</div> 
<section class="content"> 
<?php
        $id=$_GET['id'];
        $sql = "SELECT * FROM `product` WHERE idproduct=$id";
        $res=mysqli_query($conn,$sql);
        $n=mysqli_num_rows($res);
        if($n==1){
          $productSelectRow=mysqli_fetch_assoc($res);
          ?>
<form method="post" enctype="multipart/form-data">
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Product Name : </label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="p" placeholder="" name="pname" value="<?php echo $productSelectRow['pname'];?>" required>
      
    </div>
    
    <!-- <button onclick="document.getElementById('p').readOnly=true; ">Edit</button> -->
           
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Brand : </label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="brand" placeholder="" name="bname" value="<?php echo $productSelectRow['brand'];?>" required>
    </div>
  </div>
  
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Minimum set : </label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="minset" placeholder="" name="minsetperqty" value= <?php echo $productSelectRow['minimum_set_qut-pur']  ?> required>
    </div>
  </div>
  
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Quantity of one set : </label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="minset" placeholder="" name="qtyperset" value= <?php echo $productSelectRow['quantity_of_1_set']  ?> required>
    </div>
  </div>
        
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">MRP (&#8377;) : </label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="minset" placeholder="" name="mrp" value= <?php echo $productSelectRow['MRP']  ?> required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">price (&#8377;) : </label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="price" placeholder="" name="price" value= <?php echo $productSelectRow['price']  ?> onClick="checkprice()"  required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">discount (&#8377;) : </label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="minset" placeholder="" name="discount" value= <?php echo $productSelectRow['discount_rs']  ?> >
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">description : </label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="minset" placeholder="" name="desc" value= "<?php echo $productSelectRow['description']?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Image : </label>
    <div class="col-sm-10">
    <img src=<?php echo $productSelectRow['image'];?> height='100' width='100'>
    <input type="file" class="form-control" id="img" name="image" value=<?php echo $productSelectRow['image']?>>    
    </div>
  </div>

  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Image-2 : </label>
    <div class="col-sm-10">
    <img src=<?php echo $productSelectRow['image2'];?> height='100' width='100'>
    <input type="file" class="form-control" id="img" name="image2" value=<?php echo $productSelectRow['image2']?>>    
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">HSN Number : </label>
    <div class="col-sm-10">
      <input pattern="[0-9]{4,6}" class="form-control" id="minset" placeholder="" name="hsn" value= <?php echo $productSelectRow['HSN_code']  ?>    required>
    </div>
  </div>

  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">GST number(%) : </label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="minset" placeholder="" name="gst" value= <?php echo $productSelectRow['GST_rate']  ?> required>
    </div>
  </div>
  
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-success" name="updateproduct">Update Product</button>
    </div>
  </div>
</form>
</section>
</div>
<?php
                  }

                  ?>



<?php

if(isset($_POST['updateproduct'])) {
   $target_dir = "uploads/";
   $target_file = $target_dir . basename($_FILES["image"]["name"]);
  //  echo $target_file;
   $uploadOk = 1;
   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  //  echo "<br><br>".$target_file;

   //image-2

   $target_dir2 = "image-2/";
   $target_file2 = $target_dir2 . basename($_FILES["image2"]["name"]);
  //  echo $target_file2;
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
  $discount=$_POST['discount'];
 //  $id=$_COOKIE["idRegister"];
 //  $subcatid=$_GET["subcategaryid"];
 //  $subcatid=$productSelectRow['subcategory_idsubcategory'];

 if($mrp <= $price)
 {
   ?>
   <script>
     alert("price is greater than or equal to mrp");
   
     document.getElementById("price").focus();

   </script>

   <?php
  //  include "include/header.php";
  //  include "include/sidebar.php";
   include "include/footer.php";


return;
  }
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
   `MRP`=$mrp,`price`=$price,`discount_rs`=$discount,`description`='$description',`image`='$target_file',
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
include "include/footer.php";
?>

<script>
  function edit() {
    // alert("alert box");
  var d= document.getElementById("p").disabled=true;
    alert(d);
  document.getElementById("p").disabled=true;
    
  }
</script>