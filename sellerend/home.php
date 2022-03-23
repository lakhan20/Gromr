<?php

// echo $_COOKIE["idRegister"];
include "include/header.php";
include "include/sidebar.php";
include "include/connection.php";
//
?> 




<!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
   
<!-- <h1>all your products</h1> -->
    <div class="content-wrapper">
    <section class="content-header">
        <h1>
            Products

        </h1>

    </section>
  <?php  include "productView.php";?>
</div>
  <?php
  include "include/footer.php" ;
  ?>