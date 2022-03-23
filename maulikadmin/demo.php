<?php
include "include/header.php";
include "include/sidebar.php";
include "include/connection.php";
?>

<!DOCTYPE html>
<html>


<body>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="table-responsive" style="margin-top:30px">
                <table id="employee_data" class="table table-hover">
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
                    
                $result = mysqli_query($conn,$sql);

                while($rows = mysqli_fetch_assoc($result)){
                   echo" <tr>
                        <th>". $rows['idRegister'] ."</th>
                        <td>". $rows['email_id'] ."</td>
                        <td>". $rows['name'] ."</td>
                        <td>". $rows['bussiness_name'] ."</td>
                        <th>". $rows['gst_number'] ."</th>
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
        </div>
    </div>
</body>

</html>

<?php
include'include/footer.php';
?>