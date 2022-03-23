<?php  
 include "include/connection.php";
$id=$_COOKIE['idRegister'];
  
 $query ="SELECT * FROM product WHERE User_idRegister=$id ORDER BY idproduct DESC";  
 $result = mysqli_query($conn, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | Datatables Jquery Plugin with Php MySql and Bootstrap</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
   
          </head>  
      <body>  
           <br /><br />  

           <section class="content">

           <!-- <div class="container">   -->
                <!-- <h3 align="center">Datatables Jquery Plugin with Php MySql and Bootstrap</h3>   -->
                <br />  
                <div id="d" class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                               <td>srNo</td>  
                                    <td>ProductName</td>  
                                    <td>description</td>  
                                    <td>brand</td>  
                                    <td>Price</td>  
                                    <td>Image</td>  
                                   <td>Update</td>
                               </tr>  
                          </thead>  
                          <?php  
                          $cnt=1;
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>
                                   <td>'.$cnt.'</td>  
                                    <td>'.$row["pname"].'</td>  
                                    <td>'.$row["brand"].'</td>  
                                    <td>'.$row["description"].'</td>  
                                    <td>'.$row["price"].'</td> 
                                    <td><img src="'.$row["image"].'" height="100" width="100">'.'</td></td>
                                    <td><a href="ProductUpdate.php?id='.$row["idproduct"].'"  class=""><i  class="glyphicon glyphicon-pencil"></i></a>'.'</td>

                                    </tr>  
                               ';  
                               $cnt++;
                          }  
                          ?>  
                     </table>  
                </div>  
           <!-- </div>   -->
           </section>

          </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable();  
 });  
 </script>  
