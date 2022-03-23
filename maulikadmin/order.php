<?php
include "include/header.php";
include "include/sidebar.php";
include "include/connection.php";

?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            All Order

        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->

        <table class="table table-hover " id="employee_data">
            <thead>
                <tr>
                    <th scope="col">Order No.</th>
                    <th scope="col">Address</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Last Shipping Date</th>
                    <th scope="col">More Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = $query ="SELECT * FROM `sales_orders` NATURAL JOIN user WHERE sales_orders.User_idRegister=user.idRegister";
                // $sql2 = $query ="SELECT * FROM user  where idsales_orders= ";
                $result = mysqli_query($conn,$sql);
                
                while($row=mysqli_fetch_array($result)){
                echo "<tr>
                    <th>". $row['idsales_orders'] ."</th>
                    <td>". $row['address'] ."</td>
                    <td>". $row['order_date'] ."</td>
                    <td>". $row['last_shipping_date'] ."</td>
                    <td><a href='seemore_order.php?idSales=".$row['idsales_orders']."' type='button' class='btn btn-primary'>See More</a></td>
                </tr>";
                    
            }
            ?>
            </tbody>
        </table>
    </section>
</div>
<?php

include 'include/footer.php';

?>