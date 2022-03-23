<?php
include "include/header.php";
include "include/sidebar.php";
include "include/connection.php";
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            All Buyer

            <a href="onlybuyer.php"><button style="margin-left: 10px !important;"
                    class="btn btn-primary pull-right btn-sm ml-3" type="submit">Buyer</button></a>
            <a href="onlyseller.php"><button class="btn btn-primary pull-right btn-sm" type="submit">Seller</button></a>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->

        <table class="table table-hover " id="employee_data">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">EMAIL ID</th>
                    <th scope="col">NAME</th>
                    <th scope="col">BUSINESS NAME</th>
                    <th scope="col">GST NO.</th>
                    <th scope="col">MOBILE NO.</th>
                    <th scope="col">PAN NO.</th>
                    <th scope="col">AADHAR NO.</th>
                    <!-- <th scope="col">BANK ACC. NO.</th> -->
                    <th scope="col">ADDRESS</th>
                    <th scope="col">COMMISSION RATE</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `user` WHERE is_seller = 0 ORDER BY `idRegister` ASC";
                $result = mysqli_query($conn,$sql);

                while($rows = mysqli_fetch_assoc($result)){
                   echo" <tr>
                        <th>". $rows['idRegister'] ."</th>
                        <td>". $rows['email_id'] ."</td>
                        <td>". $rows['name'] ."</td>
                        <td>". $rows['bussiness_name'] ."</td>
                        <td>". $rows['gst_number'] ."</td>
                        <td>". $rows['mobile_number'] ."</td>
                        <td>". $rows['pancard'] ."</td>
                        <td>". $rows['addhar_card'] ."</td>
                        <td>". $rows['address'] ."</td>
                        <td>". $rows['commissionn_rate'] ." %</td>
                        
                    </tr>";   
                }
            ?>
            </tbody>
        </table>
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
</div>
<script>
$(document).ready(function() {
    $('#employee_data').DataTable();
});
</script>
<?php

include 'include/footer.php';

?>
<!-- <td>"ccount_number'] ."</td> -->