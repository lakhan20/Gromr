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
                    <th scope="col">Product Details</th>
                    <th scope="col">QTY</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Customer Details</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">SELLER</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM sales_product_details LEFT OUTER JOIN sales_orders ON sales_product_details.sales_orders_idsales_orders=idsales_orders LEFT OUTER JOIN product on product_idproduct=product.idproduct JOIN user ON sales_orders.User_idRegister=user.idRegister JOIN area ON user.area_area_pincode = area.area_pincode JOIN city ON area.city_idcity=city.idcity JOIN state ON city.state_idstate=state.idstate";
                $result = mysqli_query($conn,$sql);
                $cnt=1;
                $sql2 = "SELECT * FROM `user` left outer join product on user.idRegister = product.User_idRegister";
                $result2 = mysqli_query($conn,$sql2);
                
                while(($rows = mysqli_fetch_assoc($result)) && ($rows2 = mysqli_fetch_assoc($result2))){

                   echo" <tr>
                        <th>ODR00". $rows['idsales_orders']."</th>
                        <td><b>Product Code:</b> PDR00". $rows['idproduct'] ."
                            <b>Quantity:</b> ".$rows['Qty']."</td>
                        <td>". $rows['Qty'] ."</td>
                        <td>". $rows['net_amount'] ."</td>
                        <td><b>Name: </b>" . $rows['name'] ."<br>
                            <b>Address: </b>" . $rows['address'] ."<br>
                            <b>City: </b>" . $rows['city_name'] ."</td>
                        <td>". $rows['order_date'] ."</td>
                        <td><img src='".$rows['image']."' height='100' width='100'>"."</td>
                        <td>". $rows2['bussiness_name'] ."</td>
                    </tr>";   
                    $cnt++;
                }
                

                // while($row2=mysqli_fetch_assoc($result2)){
                //     echo"<tr>
                //     <td>". $row2['bussiness_name'] ."</td>   
                //     </tr>";
                // }
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