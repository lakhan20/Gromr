<?php
require "include/db_connect.php";
if (isset($_POST['query'])) {
    $queryy = $_POST['query'];
    $query = "SELECT * FROM `product` WHERE  `pname` LIKE '%$queryy%' OR `pname` LIKE '%$queryy%' LIMIT 10";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($res = mysqli_fetch_array($result)) {
            echo '  
                              <tr>
                       
                          <th><img src="' . $res["image"] . '" height="100" width="100">' . '</td>
                                   </a> </th>
                                     <th><a href="product.php">' . $res["pname"] . '</a></th>  
                                   
                              </tr>  
                               ';
        }
    } else {
        echo "
      <div class='alert alert-danger mt-3 text-center' role='alert'>
          product not found
      </div>
      ";
    }
}