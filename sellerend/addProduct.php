<?php
include "include/header.php";
include "include/sidebar.php";
include "include/connection.php";
?>

<head>
    <style>
    #x {
        float: right;
    }

    #x {
        float: right;
    }
    </style>

</head>

<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
<!-- Content Header (Page header) -->
<!-- <section class="content-header"> -->

<!-- <ol class="breadcrumb"> -->
<!-- <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li> -->

<!-- <li class="active">User profile</li> -->
<!-- </ol> -->
<!-- </section> -->

<!-- Main content -->
<!-- <section class="content"> -->

<!-- <div class="row"> -->
<!-- <div class="col-md-3"> -->

<!-- /.box-body -->
<!-- </div> -->
<!-- /.box -->
<!-- </div> -->
<!-- /.col -->
<?php

         if(isset($_POST['addproduct'])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            echo $target_file;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    

          //image2
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
           $id=$_COOKIE["idRegister"];
          //  $subcatid=$_GET["subcategaryid"];
           $subcatid=$_POST["subcategoryname"];
           $discount=$_POST['discount'];

        if($mrp <= $price)
        {
        
?>
<script> 
alert("price is greater than or equal to mrp");

//  document.getElementById("price").focus();
 window.location.href="addProduct.php";
 </script>
<?php
  return;
 
}
// include "include/footer.php";

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

//image2

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


$sql="INSERT INTO
`product`(`pname`,`brand`,`minimum_set_qut-pur`,`quantity_of_1_set`,`MRP`,`price`,`discount_rs`,`description`,`image`,`image2`,`HSN_code`,`GST_rate`,`subcategory_idsubcategory`,
`User_idRegister` ) VALUES
('$pname','$bname',$min_set_per_qty,$qty_per_set,$mrp,$price,$discount,'$description','$target_file','$target_file2',$hsn,$gst,$subcatid,$id)";
echo "<br>". $sql;
$result=mysqli_query($conn,$sql);

// echo "---------------------------------".$result;
if($result>0){
echo'<div class="alert alert-success">
    <strong>Success!</strong> product successfully added!
</div>';

echo '<script>
window.location.href = "home.php"
</script>';
// header("location:home.php");
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
<!-- //  $sql = "UPDATE employee ". "SET emp_salary = $emp_salary ". 
        //        "WHERE emp_id = $emp_id" ; -->
<!-- <div class="col-md-9" >
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><b><h1>&nbsp;&nbsp;<u>Add product</h1></b></u></li>
            </ul>
            <div class="tab-content" >
              <div class="active tab-pane" id="activity">

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" method ="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Product name :</label>

                    
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inpt"  name="pname" <?php  ?> >    
                    
                    
                    </div>
                    
                  </div>
                  
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">brand name :</label>

                    
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inpt"  name="bname" <?php  ?> >    
                    
                    
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Min Set per Qty :</label>

                    
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inpt" name="minsetperqty">    
                    
                    
                    </div>
                    </div>    
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Qty of 1 set :</label>

                    
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inpt" name="qtyperset">    
                    
                    
                    </div>
                    
                  </div>
                    
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">MRP :</label>

                    
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inpt" name="mrp">    
                    
                    
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">price :</label>

                    
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inpt" name="price">    
                    </div>
                    
                  </div>
                
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">discount :</label>

                    
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inpt" name="discount">    
                    </div>
                    
                  </div>
                
                  
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Description : </label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" name="desc"></textarea>
                    </div>
                  </div>
                  

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label" >Image :</label>

                    
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="img" name="image">    
                    </div>
                    
                  </div>
                  
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label" >Image2 :</label>

                    
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="img" name="image2">    
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">HSN number :</label>

                    
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inpt" name="hsn">    
                    </div>
                    
                  </div>
                
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">GST (%) :</label>

                    
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inpt" name="gst">    
                    </div>
                    
                  </div>
                  
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Select category :</label>

                    
                    <div class="col-sm-10">    -->


<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Add product
        </h1>
        <hr>

</section>
    <section class="content">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Product Name : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pname" placeholder="" name="pname" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Brand : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="brand" placeholder="" name="bname" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Minimum set : </label>
                <div class="col-sm-10">
                    <input pattern="[0-9]" class="form-control" id="minset" placeholder="" name="minsetperqty" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Quantity of one set : </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="minset" placeholder="" name="qtyperset" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">MRP (&#8377;) : </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="mrp" placeholder="" name="mrp" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">price (&#8377;) : </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="price" placeholder="" name="price" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">discount (&#8377;) : </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="minset" placeholder="" name="discount">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">description : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="minset" placeholder="" name="desc" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Image : </label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="img" name="image">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Image-2 : </label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="img" name="image2">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">HSN Number : </label>
                <div class="col-sm-10">
                    <input pattern="[0-9]{4,6}" class="form-control" id="minset" placeholder="" name="hsn" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">GST number(%) : </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="minset" placeholder="" name="gst" required>
                </div>
            </div>

            <?php

$selectcategory="SELECT * FROM category";

if($res=mysqli_query($conn,$selectcategory)){
  if(mysqli_num_rows($res)>0){
 echo'
 <div class="form-group row">
 <label for="inputEmail3" class="col-sm-2 col-form-label">Select Category : </label>
 <div class="col-sm-10">
 <select class="form-control" name="cat" onchange="select_category(this.value)">
      <option disabled selected>Select category </option>
 ';
 
    while($row=mysqli_fetch_array($res)){

      echo '<option  value='.$row["idcategory"].'>'.$row["categoryname"].'</option>';
      //$value= $row['idcategory'];
    }
 echo '</select>
 </div>
 </div>';

  }
}

?>



            <div class="form-group row">
                <label for="inputName" class="col-sm-2 control-label">Select sub-category :</label>
                <div class="col-sm-10" id="subcatid">
                    <select class="form-control">
                        <!-- <option value="" disabled selected>Select Sub category</option> -->
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-success" name="addproduct" onClick="comp()">Update
                        Product</button>
                </div>
            </div>


        </form>
    </section>
</div>
<script>
function select_category(cat) {
    // alert(cat);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("subcatid").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "forajax/loadsubcateory.php?categaryid=" + cat, true);
    xmlhttp.send();
}

function select_subcategory(subcat) {

    // alert(subcat);

}
</script>
<?php
  include "include/footer.php";
         
  ?>
<script>
</script>