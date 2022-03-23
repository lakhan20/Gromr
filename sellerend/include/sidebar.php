 <!-- Left side column. contains the logo and sidebar -->
 <!-- Icon Font Stylesheet -->
<style>
   /* .a{
        position: fixed;
    } */
    </style>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

 <aside class="main-sidebar" >
     <!-- sidebar: style can be found in sidebar.less -->
     <section class="sidebar" >
         <!-- Sidebar user panel -->
         <div class="user-panel" >
            
             <div class="pull-left info">
                 <h5><?php echo $name; ?></h5>
             </div>
         </div>


         <ul class="sidebar-menu">
             <li class="">
                 <a href="addProduct.php">
                     <i class="ion-tshirt"></i>&nbsp;&nbsp;&nbsp; <span>Add Product</span>
                 </a>
             </li>
         </ul>
         <ul class="sidebar-menu">
             <li>
                 <a href="orders.php">
                     <i class="."></i> <span>Orders</span>
                 </a>
             </li>
         </ul>
         <ul class="sidebar-menu">
             <li>
                 <a href="sub_cat.php">
                     <i class="glyphicon glyphicon-th"></i> <span>SUBCATEGORIES</span>
                 </a>
             </li>
         </ul>
         <ul class="sidebar-menu">
             <li>
                 <a href="order.php">
                     <i class="ion-locked"></i>&nbsp;&nbsp;&nbsp;&nbsp; <span>ODERS</span>
                 </a>
             </li>
         </ul>
         <ul class="sidebar-menu">
             <li>
                 <a href="user.php">
                     <i class="fa fa-user"></i> <span>USERS</span>
                 </a>
             </li>
         </ul>
         <ul class="sidebar-menu">
             <li>
                 <a href="requests.php">
                     <i class="ion-person-add"></i>&nbsp;&nbsp;&nbsp; <span>REQUESTS</span>
                 </a>
             </li>
         </ul>
         <ul class="sidebar-menu">
             <li>
                 <a href="/admin/aa/view2rpt.php">
                     <i class="fa fa-chart-bar me-2"></i>&nbsp;
                     <span>Report</span>
                 </a>
             </li>
         </ul>

         
        

     </section>
     <!-- /.sidebar -->
 </aside>