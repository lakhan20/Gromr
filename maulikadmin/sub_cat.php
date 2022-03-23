<?php
include "include/header.php";
include "include/sidebar.php";
include "include/connection.php";
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            All Sub-Category

            <a href="add_subcat.php"><button class="btn btn-primary pull-right btn-sm" type="submit">Add
                    Sub-Category</button></a>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->

        <table class="table table-hover ">
            <thead>
                <th>Sub-category</th>
                <th>Action</th>
            </thead>
            <?php
                $sql = "SELECT * FROM `subcategory`";
                $result = mysqli_query($conn,$sql);
                $num = mysqli_num_rows($result);
            ?>
            <tbody>
                <?php
                if($num > 0){
                 foreach($result as $row) { ?>
                <tr>
                    <td><?php echo $row['subcategoryname']; ?></td>
                    <td>
                        <a href="edit_sub-cat.php?subid=<?php  echo $row['idsubcategory'];  ?>"><i
                                class="fa fa-edit"></i></a>

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