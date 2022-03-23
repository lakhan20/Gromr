<?php
// C:\xampp\htdocs\admin\admin\include\connection.php
 include "../include/connection.php";

 
//  echo "hii";
 $categoryid=$_GET["categaryid"];
// echo"<br> <br><br><br>...............????????????????".$categoryid;
 $res=mysqli_query($conn,"select * from subcategory where category_idcategory=$categoryid" );

?>
<select class="form-control" name="subcategoryname" id="subcategoryname"  onchange="select_subcategory(this.value)">
<option value="" disabled selected>Select Sub category</option>
<?php
 while($row=mysqli_fetch_array($res)){

    echo '<option value='.$row["idsubcategory"].'>';
    echo $row["subcategoryname"];
    echo "</option>";
}
echo "</select>";

?>
