
<!-- 
<form method="">
<select class="form-control">
<option value="brand">brand</option>
<option value="category">subcategory</option>

</select>

</form> -->
<?php
include "include/connection.php";
$id=$_COOKIE['idRegister'];
$productSelectQuery="SELECT * FROM product WHERE User_idRegister=$id ORDER BY idproduct DESC ";
$res=mysqli_query($conn,$productSelectQuery);
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
 <div class="container">
<?php

if(mysqli_num_rows($res) >0){

$str=" <div class='table-responsive'>  <table id='employee_data' class='table table-striped table-bordered'>
<thead>
<tr><th>sr no</th><th>ProductName<th>description<th>brand<th>Price<th>Image<th>Update</tr></thead>";
 $cnt=1; 
 while($productRow=mysqli_fetch_assoc($res)){
  
    $str.="<tbody><tr><td>".$cnt."</td><td>".$productRow["pname"]."</td><td>".$productRow["description"]."</td><td>"
	.$productRow["brand"]."</td><td>".$productRow["price"]."</td><td>
	<img src='".$productRow["image"]."' height='100' width='100'>"."</td><td>
    <a href='ProductUpdate.php?id=".$productRow["idproduct"]."' class='btn btn-xs btn-info'><i class='ace-icon fa fa-check bigger-120'></i></a>"."</td>

    </tr>
    ";
    $cnt++;

}
    $str.="</tbody></table> </div>";
    echo $str;
}
    
?>

</div>
</body>
