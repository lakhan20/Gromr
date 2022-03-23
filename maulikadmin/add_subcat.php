<?php
// include header file
include 'include/header.php'; 
include 'include/sidebar.php'; 
include 'include/connection.php'; 

?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2 class="admin-heading">Add New Sub-Category</h2>
        <form id="createCategory needs-validation" class="" method="POST">
            <label style="margin-top: 10px !important;">
                <h4>Sub-Category Name : </h4>
            </label>

            <input type="text" class="form-control" name="catname" placeholder="Enter Sub-Category Name" required>



            <div class="form-group">
                <label style="margin-top: 10px !important;">
                    <h4>Select Category : </h4>
                </label>
                <select name="sid" class="form-control" required>
                    <option selected disabled value="">Please Select Category
                        <?php
                  $selectcategory="SELECT * FROM category";
                  $res=mysqli_query($conn,$selectcategory);
                  $num=mysqli_num_rows($res);
                    if($num>0){
                        while($row=mysqli_fetch_array($res)){ 
                            echo '<option  value='.$row["idcategory"].'>'.$row["categoryname"].'</option>';
                            $value= $row["idcategory"];
                            }      
                   }
                   ?></option>
                </select>
            </div>
            <div style="margin-top: 13px !important;margin-bottom: 13px !important;">
                <input type="submit" name="save" class="btn add-new btn-primary" value="Add">
            </div>
        </form>



    </section>
</div>

<?php

    if(isset($_POST['save'])){
        $add_cat = $_POST['catname'];
        $sid=$_POST['sid'];
        
        $sql = "INSERT INTO `subcategory` (subcategoryname,category_idcategory) VALUES ('$add_cat','$sid')";
        $result = mysqli_query($conn,$sql);
        if($result){
            echo "<script>
            window.location.href='sub_cat.php' </script>";
        }else{
            echo '<script>alert("Sub-Category already added ");</script>';
           }
        
    }

    include "include/footer.php";
?>
<!-- 
<div class="form-group">
    <label for="inputName" class="col-sm-2 control-label">Select category :</label>


    <div class="col-sm-10">

        <?php

                //   $selectcategory="SELECT * FROM category";

                //   if($res=mysqli_query($conn,$selectcategory)){
                //     if(mysqli_num_rows($res)>0){
                //    echo' <select class="form-control" name="cat">
                //         <option disabled selected>Select category </option>
                //    ';
                   
                //       while($row=mysqli_fetch_array($res)){

                //         echo '<option  value='.$row["idcategory"].'>'.$row["categoryname"].'</option>';
                //         //$value= $row['idcategory'];
                //       }
                //    echo '</select>
                //    </div>
                //    </div>';

                //     }
                //   }
              
                ?> -->