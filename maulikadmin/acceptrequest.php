<?php
include "include/header.php";
include "include/sidebar.php";
include "include/connection.php";
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            All Accepted Request

            <a href="acceptrequest.php"><button style="margin-left: 10px !important;"
                    class="btn btn-primary pull-right btn-sm  mr-1" type="submit" name="seller">Accepted</button></a>
            <a href="rejectrequest.php"><button class="btn btn-primary pull-right btn-sm  mr-2" type="submit"
                    name="buyer">Rejected</button></a>

        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->

        <table class="table table-hover" id="employee_data">
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
                    <th scope="col">BANK ACC. NO.</th>
                    <th scope="col">ADDRESS</th>
                    <th scope="col">COMMISSION RATE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `user` join bank on bank.idBank = user.Bank_idBank  WHERE is_seller = 1";
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
                        <td>". $rows['Account_number'] ."</td>
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
<?php

include 'include/footer.php';

?>