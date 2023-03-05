<!DOCTYPE html>
<html>
<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?> 
<title>Rentaru</title>
<head>
    <script type="text/javascript" src="assets/ajs/angular.min.js"> </script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="shortcut icon" type="image/png" href="assets/img/fav.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>  
  <script type="text/javascript" src="assets/js/custom.js"></script> 
 <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body ng-app=""> 

 <!-- Navigation -->
    <nav class="navbar navbar-custom navbar" role="navigation" style="color: White; background-color:#000F64;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php">
                   <strong>Rentaru </strong></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
                if (isset($_SESSION['login_customer'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
              <li><a href=""> <strong>Welcome <?php echo $_SESSION['login_customer']; ?></strong></a></li>
              <li><a href="index.php"> <strong>Home</strong></a></li>
              <li><a href="prereturnpro.php"><strong>Return</strong></a></li>
              <li><a href="mybookings.php"> <strong>Bookings</strong></a></li>
              <li><a href="enterproduct.php"><strong>Add Product</strong></a></li><li><a href="myproduct.php"><strong>My Product</strong></a></li>
              <li><a href="customerview.php"><strong>View History</strong></a></li>
                    <li><a href="logout.php"><strong>Logout</strong></a></li>
                </ul>
            </div>

            <?php
            }
                else {
            ?>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php"><strong>Home</strong></a>
                    </li>
                    <li>
                        <a href="customerlogin.php"><strong>Login</strong></a>
                    </li>
                    <li>
                        <a href="about.php"> <strong>About </strong></a>
                    </li>
                    <li>
                        <a href="contact.php"> <strong>Contact</strong> </a>
                    </li>
                </ul>
            </div>
                <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
<div class="container" style="margin-top: 20px;" >
    <div class="col-md-" style="float: none; margin: 0 auto;">
      <div class="form-area">
        <form role="form" action="bookingconfirm.php" method="POST">
        <br style="clear: both">
          <strong><h3 style="margin-bottom: 25px; text-align: center; font-size: 30px; margin-left:auto;margin-right:auto; padding:20px; color:white; background-color:green;"><strong> Get this product on Rent </strong></h3></strong>
        <?php
        $pro_id = $_GET["id"];
        $sql1 = "SELECT * FROM  products p, customers c, custpro cp WHERE p.pro_id = '$pro_id' AND p.pro_id=cp.pro_id AND cp.customer_username = c.customer_username";
            
            
        $result1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($result1)){
            while($row1 = mysqli_fetch_assoc($result1)){
                $pro_name = $row1["pro_name"];
                $pro_des = $row1["pro_des"];
                $pro_city = $row1["pro_city"];
                $pro_cat = $row1["pro_cat"];
                $pro_img = $row1["pro_img"];
                $pro_rent_per_month = $row1["pro_rent_per_month"];
                $pro_rent_per_day = $row1["pro_rent_per_day"];
                $customer_name = $row1["customer_name"];
                $customer_phone = $row1["customer_phone"];
            }
        }

        ?>
            
        
            
        <div class="container" style="padding:30px; background-color:#F4FBA6;text-align:justify;">    
         <img class="card-img-top,center" src="<?php echo $pro_img; ?>" alt="Card image cap">
           <hr>
          <!-- <div class="form-group"> -->
              <h5> <strong>Product : </strong>&nbsp;  <?php echo($pro_name);?></h5><br>
         <!-- </div> -->
         
          <!-- <div class="form-group"> -->
            <h5> <strong> Description : </strong>&nbsp; <?php echo($pro_des);?></h5><br>
            <h5> <strong> Location : </strong>&nbsp; <?php echo($pro_city);?></h5><br>
            <h5> <strong> Category : </strong>&nbsp; <?php echo($pro_cat);?></h5>
            <hr>
            <h4> <strong>Owner Name:</strong>  <?php echo $customer_name; ?></h4><br>
            <h4> <strong>Owner Contact: </strong> <?php echo $customer_phone; ?></h4>
            <hr>
          <!-- </div>      -->
        <!-- <div class="form-group"> -->
        <?php $today = date("Y-m-d") ?>
            <label><h5> <strong>Start Date: </strong></h5></label>
            <input type="date" name="rent_start_date" min="<?php echo($today);?>" required="">
            &nbsp;
            <label><h5> <strong>End Date: </strong></h5></label>
          <input type="date" name="rent_end_date" min="<?php echo($today);?>" required="">
        <!-- </div>      -->
        <br>
            <h5><strong> Choose charge type: </strong> &nbsp;
            <input onclick="reveal()" type="radio" name="radio" value="months" required> per month(s) &nbsp;
            <input onclick="reveal()" type="radio" name="radio" value="days"> per day(s)
            </h5>
            
            <input type="hidden" name="hidden_carid" value="<?php echo $pro_id; ?>">
            <hr>
           <input type="submit"name="submit" value="Book Now" class="btn btn-success pull-right">
            </div> 
        </form>
        
      </div>
      <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
          <br>
            <h5><strong>Kindly Note:</strong> You will be charged <span class="text-danger">Actual Rent + 20%/-</span> after the time.</h5><br>
        </div>
    </div>
    </div>
    
     <div  style="position:relative;">
        <div class="site-footer" style="color:#ddd;background-color:#282E34;text-align:center;padding:20px 20px;text-align: justify;">
        <footer >
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h5>© 2020 Rentaru</h5>
                </div>
                <div class="col-sm-6 social-icons">
                    <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/theme.js"></script>
</html>