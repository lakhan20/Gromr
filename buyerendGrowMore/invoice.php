<?php
include 'include/db_connect.php';
$uid = $_COOKIE["idRegister"];
$sid = $_GET["orderid"];
$sql = "SELECT * FROM `sales_orders` WHERE User_idRegister=$uid AND idsales_orders= $sid";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
$sql1 = "SELECT * FROM user JOIN sales_orders on user.idRegister = sales_orders.User_idRegister WHERE sales_orders.idsales_orders =$sid";
$result1 = mysqli_query($conn, $sql1);
$sql3 = "SELECT * FROM `sales_orders` NATURAL JOIN `sales_product_details` NATURAL JOIN `product` NATURAL JOIN `user` WHERE User_idRegister=$uid AND idsales_orders=$sid AND sales_orders.idsales_orders=sales_product_details.sales_orders_idsales_orders and sales_product_details.product_idproduct=product.idproduct and product.User_idRegister=user.idRegister";
$result3 = mysqli_query($conn,$sql3);
$row3 = mysqli_fetch_assoc($result3);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
   <!--  All snippets are MIT license http://bootdey.com/license -->
   <title>invoice</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
   <div class="container">
      <div class="col-md-12">
         <div class="invoice">
         
            <!-- begin invoice-company -->
            <div class="invoice-company text-inverse f-w-600">
               <span class="pull-right hidden-print">
                  <a href="javascript:;" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-file t-plus-1 text-danger fa-fw fa-lg"></i> Export as PDF</a>
                  <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
</span>
<div class="addre">
         <img src="./img/logo.png" alt="GrowMore" title="GrowMore" width=100px/><br>
                     <strong class="text-inverse">GrowMore</strong><br>
                     Shop 66, Anand Shopping Center,<br>
                     Ratanpole, Ahmedabad-380001<br>
                     Phone : +91-7226007694<br>
                     E-mail : info.growmoreb2b@gmail.com<br>
                     GST No. : 24CARPP2468N1ZW
                  </div>
               
                  <!-- <address class="m-t-5 m-b-5"> -->
                 
                  <!-- </address> -->
            </div>
            <!-- end invoice-company -->
            <!-- begin invoice-header -->
            <div class="invoice-header">
               <div class="invoice-from">
                  <small>From</small>
                  <address class="m-t-5 m-b-5">
                     <?php
                     echo'
                  <strong class="text-inverse">' . $row3["bussiness_name"] . '</strong><br>
                    ' . $row3["address"] . '<br>
                     Phone : ' . $row3["mobile_number"] . '<br>
                     E-mail : ' . $row3["email_id"] . '<br>
                     GST No. : ' . $row3["gst_number"] . '<br>
                     ';?>
                  </address>
               </div><?php
                     while ($row1 = mysqli_fetch_assoc($result1)) {
                        echo '
               <div class="invoice-to">
                  <small>To</small>
                  <address class="m-t-5 m-b-5">
                     <strong class="text-inverse">' . $row1["bussiness_name"] . '</strong><br>
                    ' . $row1["address"] . '<br>
                     Phone : ' . $row1["mobile_number"] . '<br>
                     E-mail : ' . $row1["email_id"] . '<br>
                     GST No. : ' . $row1["gst_number"] . '<br>
                  </address>
               </div>
              ';
                     } ?>
               <?php
               while ($row = mysqli_fetch_assoc($result)) {
                  $date = date_create($row["order_date"]);
                  date_add($date, date_interval_create_from_date_string("30 days"));

                  echo '  <div class="invoice-date">
                  <div class="invoice-detail"><b> Invoice - ODR00' . $row['idsales_orders'] . '</b></div>
                  <div class="date text-inverse m-t-5">Order date : ' . $row["order_date"] . '</div>
               </div>';
               } ?>
            </div>
            <!-- end invoice-header -->
            <!-- begin invoice-content -->
            <div class="invoice-content">
               <!-- begin table-responsive -->
               <div class="table-responsive">
                  <table class="table table-invoice">
                     <thead>
                        <tr>
                           <th>PRODUCT DETAILS</th>
                           <th class="text-center" width="10%">QTY</th>
                           <th class="text-right" width="10%"></th>
                           <th class="text-center" width="10%">PRICE</th>
                           <th class="text-center" width="10%">GST</th>
                           <th class="text-right" width="20%">TOTAL</th>
                        </tr>
                     </thead>
                     <?php
                     $sql2 = "SELECT * FROM sales_product_details NATURAL JOIN sales_orders NATURAL JOIN product WHERE sales_orders.User_idRegister=$uid and sales_product_details.sales_orders_idsales_orders=$sid AND sales_product_details.product_idproduct=product.idproduct and sales_product_details.sales_orders_idsales_orders=sales_orders.idsales_orders";
                     $result2 = mysqli_query($conn, $sql2);
                     $summ = 0;
                     $total = 0;
                     // $total1 = 0;
                     $subtotal = 0;
                     while ($row2 = mysqli_fetch_assoc($result2)) {

                        $proid = $row2['idproduct'];
                        $qty = $row2['Qty'];
                        $taxable = $row2['Price'];
                        $total1 = $qty * $taxable;
                        
                        $summ = ($total1 * 12) / 100;
                        $total2 = $total1 + $summ;
                        $subtotal = $subtotal + $total2;

                        echo '
                     <tbody>
                        <tr>
                           <td>
                              <span class="text-inverse">' . $row2['pname'] . '</span><br>
                              <small>' . $row2['description'] . '</small>
                           </td>
                           <td class="text-center">' . $row2['Qty'] . '</td>
                           <td class="text-center">*</td>
                           <td class="text-center">₹ ' . $row2['Price'] . '</td>
                           <td class="text-center">₹' . $summ . '</td>
                           <td class="text-right">₹ ' . $total2 . '</td>
                        </tr>';
                     } ?>


                     </tbody>
                  </table>
               </div>

               <!-- end table-responsive -->
               <!-- begin invoice-price -->
               <div class="invoice-price">
                  <div class="invoice-price-left">
                     <div class="invoice-price-row">
                        <!-- <div class="sub-price">
                           <small>SUBTOTAL</small>
                           <span class="text-inverse">₹ <?php echo $subtotal ?></span>
                        </div> -->
                        <!-- <div class="sub-price">
                           <i class="fa fa-plus text-muted"></i>
                        </div>
                        <div class="sub-price">
                           <small>PAYPAL FEE (5.4%)</small>
                           <span class="text-inverse">$108.00</span>
                        </div> -->
                     </div>
                  </div>
                  <div class="invoice-price-right">
                     <small>TOTAL</small> <span class="f-w-600">₹ <?php echo $subtotal ?></span>
                  </div>
               </div>
               <!-- end invoice-price -->
            </div>
            <!-- end invoice-content -->
            <!-- begin invoice-note -->
            <div class="invoice-note"><b>
                  * Make all cheques payable to GrowMore <br>
                  * If you have any questions concerning this invoice, contact below number</b>
            </div>
            <!-- end invoice-note -->
            <!-- begin invoice-footer -->
            <div class="invoice-footer">
               <p class="text-center m-b-5 f-w-600">
                  <b> THANK YOU FOR YOUR BUSINESS HAVE A NICE DAY..!!</b>
               </p>
               <p class="text-center">
                  <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> www.growmore.com</span>
                  <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i>Phone :+91-7226007694</span> &nbsp;
                  <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i>info.growmoreb2b@gmail.com</span>
               </p>
            </div>
            <!-- end invoice-footer -->
         </div>
      </div>
   </div>

   <style type="text/css">
      body {
         margin-top: 20px;
         background: #eee;
      }

      .invoice {
         background: #fff;
         padding: 20px
      }

      .invoice-company {
         font-size: 20px
      }

      .invoice-header {
         margin: 0 -20px;
         background: #f0f3f4;
         padding: 20px
      }

      .invoice-date,
      .invoice-from,
      .invoice-to {
         display: table-cell;
         width: 1%
      }

      .invoice-from,
      .invoice-to {
         padding-right: 20px
      }

      .invoice-date .date,
      .invoice-from strong,
      .invoice-to strong {
         font-size: 16px;
         font-weight: 600
      }

      .invoice-date {
         text-align: right;
         padding-left: 20px
      }

      .invoice-price {
         background: #f0f3f4;
         display: table;
         width: 100%
      }

      .invoice-price .invoice-price-left,
      .invoice-price .invoice-price-right {
         display: table-cell;
         padding: 20px;
         font-size: 20px;
         font-weight: 600;
         width: 75%;
         position: relative;
         vertical-align: middle
      }

      .invoice-price .invoice-price-left .sub-price {
         display: table-cell;
         vertical-align: middle;
         padding: 0 20px
      }

      .invoice-price small {
         font-size: 12px;
         font-weight: 400;
         display: block
      }

      .invoice-price .invoice-price-row {
         display: table;
         float: left
      }

      .invoice-price .invoice-price-right {
         width: 25%;
         background: #2d353c;
         color: #fff;
         font-size: 28px;
         text-align: right;
         vertical-align: bottom;
         font-weight: 300
      }

      .invoice-price .invoice-price-right small {
         display: block;
         opacity: .6;
         position: absolute;
         top: 10px;
         left: 10px;
         font-size: 12px
      }

      .invoice-footer {
         border-top: 1px solid #ddd;
         padding-top: 10px;
         font-size: 10px
      }

      .invoice-note {
         color: #999;
         margin-top: 80px;
         font-size: 85%
      }

      .invoice>div:not(.invoice-footer) {
         margin-bottom: 20px
      }

      .btn.btn-white,
      .btn.btn-white.disabled,
      .btn.btn-white.disabled:focus,
      .btn.btn-white.disabled:hover,
      .btn.btn-white[disabled],
      .btn.btn-white[disabled]:focus,
      .btn.btn-white[disabled]:hover {
         color: #2d353c;
         background: #fff;
         border-color: #d9dfe3;
      }
   </style>

   <script type="text/javascript">

   </script>
</body>

</html>