<?php
include "include/header.php";
include "include/sidebar.php";
include "include/connection.php";
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->

    <!-- Form -->
    <form action="update_code.php" class="add-post-form col-md-6" method="POST">
        <?php
            $cat_id = $_GET['id'];
            $sql = "SELECT * FROM `category` where idcategory=$cat_id";
            $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                foreach($result as $row){
            ?>
        <input type="hidden" name="cat_id" value="<?php echo $row['idcategory']; ?>">
        <div class="form-group">
            <label>
                <h4>Category Name : </h4>
            </label>
            <input type="text" name="cat_name" class="form-control" value="<?php echo $row['categoryname']; ?>"
                placeholder="Category Name" required />
        </div>
        <input type="submit" name="update" class="btn btn-primary" value="Update Category" />
    </form>
    <!-- /Form -->

    <!-- /.content -->
    <?php
                }
            } else { ?>
    <div class="not-found">!!! Result Not Found !!!</div>
    <?php  } ?>
</div>
<?php




?>
<?php

include 'include/footer.php';

?>