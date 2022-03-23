<?php  
include "include/header.php";
include "include/sidebar.php";
 include "include/connection.php";
$id=$_COOKIE['idRegister'];
  
 $query ="SELECT DISTINCT  sales_orders.idsales_orders,sales_orders.*  FROM sales_orders  JOIN sales_product_details
      ON sales_orders.idsales_orders=sales_product_details.sales_orders_idsales_orders JOIN product 
      ON sales_product_details.product_idproduct=product.idproduct WHERE product.User_idRegister=$i";  
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
    <style>
         #d{
              /* right-margin:"10px",
              /* padding-left:"50px", */
              /* padding-left:"50px";  */
              padding: 10px 100px 100px 90px;
          }
          #a{
               height:30px;
          }
    </style>
          </head>  
      <body>  
           <br /><br />  

           <div class="container">  
                <!-- <h3 align="center">Datatables Jquery Plugin with Php MySql and Bootstrap</h3>   -->
                <br />  
                <div id="d" class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>order id</td>  
                                    <td>order date</td>  
                                    <td>buyer address</td>  
                                    <td>last shipping date</td>  
                                    <td>taxable amount</td>  
                                    <td>tax amount</td>  
                                   <td>total amount</td>
                                   <td>cancel date</td>
                                   <td>See More Details</td>
                                   <td>Accept order</td>
                                   <td>Cancel order</td>

                               </tr>  
                          </thead>  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>
                              
                                    <td>'.$row["idsales_orders"].'</td>  
                                    <td>'.$row["order_date"].'</td>  
                                    <td>'.$row["buyer_address"].'</td>  
                                    <td>'.$row["last_shipping_date"].'</td> 
                                    <td>'.$row["taxable_amount"].'</td> 
                                    <td>'.$row["tax_amount"].'</td> 
                                    <td>'.$row["total_amount"].'</td> 
                                    <td>'.$row["cancel_date"].'</td> 
                                    <th scope="row"><a href="showOrderDetail.php">See More</th>

                                ';
                                    if($row['Is_canceled']==NULL){
                                        echo '<th scope="row"><a href="AcceptCancel.php?salesOrderId='.$row['idsales_orders'].'&isCanceled=0" class="btn btn-success" >Accept</a></th>
                                        <th scope="row"><a href="AcceptCancel.php?salesOrderId='.$row['idsales_orders'].'&isCanceled=1" class="btn btn-danger" >Cancel Order</a></th>';    
                                        }    
                                        elseif($row['Is_canceled']==1){
                                         echo '
                                         <th scope="row"></th>
                                         <th scope="row"><button type="button" class="btn btn-danger" disabled> Order Cancelled</button></th>  
                                         ';
                                        }
                                        
                                        
                                        elseif($row['Is_canceled']==0){
                                            echo '
                                         <th scope="row"><button type="button" class="btn btn-success" disabled>Order Accepted</button></th>
                                         <th scope="row"></th>
                                         ';
                                        }
                                
                                    echo'</tr>';  
                                
                              
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable();  
 });  
 </script>  
