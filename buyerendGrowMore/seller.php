<?php
include "include/db_connect.php";
include "include/header.php";
$uid=$_COOKIE['idRegister'];

?>

<style>
      body {
        text-align: center;
        /* padding: 40px 0; */
        background: #EBF0F5;
      }
        h1 {
          /* color: #88B04B; */
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      ia {
        /* color: red; */
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>
<?php
$is_seller=$_GET['is_seller'];
$is_request=$_GET['is_request'];

if($is_seller==0 && $is_request==1){

    echo'
<br>
    <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <ia class="checkmark" style="color: #4169E1;">!</ia>
      </div>
        <h1 style="color:#4169E1;">Pending</h1> 
        <p>Your Request is pending </p><br>
      
      </div>
    ';
}
else if($is_request==0 && $is_seller==1){
    echo'
    <br>
        <div class="card">
          <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <ia class="checkmark" style="color: #88B04B;">✓</ia>
          </div>
            <h1 style="color:#88B04B;">Success</h1> 
            <p>Your Request is Accepted.
            <br>
            You can sale on GrowMore</p><br>
          
          </div>
        ';
}
else if($is_request==0 && $is_seller==0){
    echo'
    <br>
        <div class="card">
          <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <ia class="checkmark" style="color: #FF0000;">&nbsp;X</ia>
          </div>
             <h1 style="color:#FF0000;">Rejected</h1> 
            <p>Your Request is Rejected.
            
          </div>
        ';
}
else if($is_request==NULL && $is_seller==0){
    echo'
    <br>
            <form method="post">
            <button type="submit" class="btn btn-primary" name="request" value="1">Apply for being a seller</button> 
            </post>
        ';
}
?>

<?php

if(isset($_POST['request']))
{
echo $_POST['request'];

$val=$_POST['request'];

$SendRequest="UPDATE user SET is_request=$val WHERE idRegister=$uid";

$res=mysqli_query($conn,$SendRequest);

if($res>0){
echo "
<script>
alert('request sent for being a seller');
window.location.href='website.php';
</script>
";
}
else{

    echo "else part";

}

}
?>


<br><br>



<?php
include 'include/footer.php';
?>
<!-- jQuery Plugins -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/main.js"></script>

</body>

</html>