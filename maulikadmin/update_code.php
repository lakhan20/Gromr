<?php
include 'include/connection.php';

    if(isset($_POST['update'])){
        $cat_id = $_POST['cat_id'];
        $cat_name = $_POST['cat_name'];

        $sql = "UPDATE `category` SET `categoryname` = '$cat_name' WHERE `idcategory` = '$cat_id'";
        echo $sql;
        $result = mysqli_query($conn,$sql);
        echo var_dump($result);
        if($result){
            echo "updated";
            header("location:category.php");
        }else{
            echo "fail";
        }
    }

    if(isset($_POST['updatesubcat'])){
        $sub_cat_id = $_POST['sub_cat_id'];
        $sub_cat_name = $_POST['sub_cat_name'];
        $id_cat = $_POST['subid'];

        $sql_subcat="UPDATE `subcategory` SET subcategoryname ='$sub_cat_name', category_idcategory = '$id_cat' WHERE idsubcategory = '$sub_cat_id'";
        $res_subcat=mysqli_query($conn,$sql_subcat);
        if($res_subcat){
            header("location:sub_cat.php");
        }
    }

    // if(isset($_POST['cate_delete_btn'])){
    //     $cat_id = $_POST['cate_delete_id'];

    //     echo $cat_id;

        
    //     $sql3 = "DELETE FROM `subcategory` WHERE category_idcategory= $cat_id ";
    //     $result3 = mysqli_query($conn,$sql3);
       
    //     if($result3){
    //         echo "done";
    //     }
    //     else{
    //         echo "not";
    //     }
    //     // $sql2 = "DELETE FROM `category` WHERE idcategory = '$cat_id' ";
    //     // // $sql3
    //     // $result2 = mysqli_query($conn,$sql2);
    //     // if($result2){
    //     //     echo "success";
    //     // }else{
    //     //     echo "fail";
    //     // }
    // }

    
    // // session_start();
    // // echo $u_surname; 
    // // if(isset($_POST['updatep'])){
        
         
    // }
?>
