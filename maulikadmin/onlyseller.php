<?php
include "include/header.php";
include "include/sidebar.php";
include "include/connection.php";
?>


<!DOCTYPE html>
<html>

<!-- <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
</head> -->

<body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                All Seller

                <a href="onlybuyer.php"><button style="margin-left: 10px !important;"
                        class="btn btn-primary pull-right btn-sm ml-3" type="submit" name="buyer">Buyer</button></a>
                <a href="onlyseller.php"><button class="btn btn-primary pull-right btn-sm"
                        type="submit">Seller</button></a>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="table-responsive">
                <table class="table  table-hover " id="employee_data">
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
                $sql = "SELECT * FROM `user` join bank on bank.idBank = user.Bank_idBank  WHERE is_seller = 1 ORDER BY `idRegister` DESC";
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
            </div>
            <!-- /.row (main row) -->
        </section>
        <!-- /.content -->
    </div>
</body>

</html>

<!-- <script>
$(document).ready(function() {
    $('#employee_data').DataTable();
});
</script> -->
<?php

include'include/footer.php';

?>
<!--  -->