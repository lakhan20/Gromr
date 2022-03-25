<?php
include "include/header.php";
include "include/sidebar.php";
include "include/connection.php";
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            All Request

            <a href="acceptrequest.php"><button style="margin-left: 10px !important;"
                    class="btn btn-primary pull-right btn-sm  mr-1" type="submit" name="seller">Accepted</button></a>
            <a href="rejectrequest.php"><button class="btn btn-primary pull-right btn-sm  mr-2" type="submit"
                    name="buyer">Rejected</button></a>

        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->

        <table class="table table-hover table-bordered" id="employee_data">
            <thead>
                <tr>
                    <th scope="col">SRNO.</th>
                    <th scope="col">BUSINESS NAME</th>
                    <th scope="col">MO. NO.</th>
                    <th scope="col">GST NO.</th>
                    <th scope="col">ADDRESS</th>
                    <th scope="col">EMAIL ID</th>
                    <th scope="col">ACCEPT</th>
                    <th scope="col">DECLINE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM user WHERE is_request=1 AND is_seller=0;
                ";
                $result = mysqli_query($conn,$sql);
                $cnt=1; 
                while($rows = mysqli_fetch_assoc($result)){
                   echo" <tr>
                        <th>". $cnt ."</th>
                        <td>". $rows['bussiness_name'] ."</td>
                        <td>". $rows['mobile_number'] ."</td>
                        <td>". $rows['gst_number'] ."</td>
                        <td>". $rows['address'] ."</td>
                        <td>". $rows['email_id'] ."</td>
                        <td> <a onClick=\"javascript: return confirm('Are you sure you want to accept this request?');\" href='update_code.php?isseller=1&isrequest=0&idregister=".$rows['idRegister']."' class='btn btn-primary'>Accept</a> </td>
                        <td> <a onClick=\"javascript: return confirm('Are you sure you want to decline this request?');\" href='update_code.php?isseller=0&isrequest=0&idregister=".$rows['idRegister']."' class='btn btn-danger'>Decline</a> </td>
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
<script>
// function confirmbox() {
//     if (confirm("Are you sure You want to accept this order ?")) {
//         return 1;
//     } else {
//         return 0;
//         console.log("elsee...");
//         window.location.href = "orders.php";
//     }
// }
// 
</script>
<?php

include 'include/footer.php';

?>