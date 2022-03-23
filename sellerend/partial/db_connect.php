<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "growmore";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
    die("not connect");
}
echo'conection successfully';

?>