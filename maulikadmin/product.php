<?php
include "include/header.php";
include "include/sidebar.php";
include "include/connection.php";
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            All Product
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->

        <table class="table table-hover" id="employee_data">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">BRAND</th>
                    <th scope="col">QTY</th>
                    <th scope="col">QTY_PER SET</th>
                    <th scope="col">MRP</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">DESCRIPTION</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">HSN_CODE</th>
                    <th scope="col">GST_NO.</th>
                    <th scope="col">Seller</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `product`";
                $result = mysqli_query($conn,$sql);
                $sql2 = "SELECT * FROM user join product on user.idRegister=product.User_idRegister";
                $result2 =mysqli_query($conn,$sql2);
                $cnt=1; 
                while(($rows = mysqli_fetch_assoc($result)) && ($rows2 = mysqli_fetch_assoc($result2))){
                   echo" <tr>
                        <th>".$rows['idproduct'] ."</th>
                        <td>". $rows['pname'] ."</td>
                        <td>". $rows['brand'] ."</td>
                        <td>". $rows['minimum_set_qut-pur'] ."</td>
                        <td>". $rows['quantity_of_1_set'] ."</td>
                        <td>". $rows['MRP'] ."</td>
                        <td>". $rows['price'] ."</td>
                        <td>". $rows['description'] ."</td>
                        <td><img src='../sellerend/".$rows['image']."' height='100' width='100'>"."</td>
                        <td>". $rows['HSN_code'] ."</td>
                        <td>". $rows['GST_rate'] ."</td>
                        <td>". $rows2['bussiness_name'] ."</td>
                    </tr>";
                    $cnt++;   
                }
            ?>
            </tbody>
        </table>
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
</div>
<?php

include 'include/footer.php';

?>