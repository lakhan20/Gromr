<?php
include "include/header.php";
include "include/sidebar.php";
include "include/connection.php";
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            All Category
            <a href="add_category.php"><button class="btn btn-primary pull-right btn-sm" type="submit">Add
                    Category</button></a>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->

        <table class="table table-hover " id="myTable">
            <thead>
                <tr>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <?php
                $sql = "SELECT * FROM `category`";
                $result = mysqli_query($conn,$sql);
                $num = mysqli_num_rows($result);
            ?>
            <tbody>

                <?php 
                if($num > 0){
                foreach($result as $row) { ?>
                <tr>
                    <td><?php echo $row['categoryname']; ?></td>
                    <td>
                        <a href="edit_cat.php?id=<?php echo $row['idcategory'];  ?>"><i class="fa fa-edit"></i></a>
                        <!-- <form action="update_code.php" method="POST">
                            <input type="hidden" name="cate_delete_id" value="<?php #echo $row['idcategory'];?>">
                            <button type="submit" name="cate_delete_btn" class="btn btn-danger">delete</button>

                        </form> -->
                    </td>
                </tr>
                <?php }} ?>
            </tbody>
        </table>
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
</div>
<?php

include 'include/footer.php';

?>