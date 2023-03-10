<!DOCTYPE html>
<html>
<?php 
session_start();
require 'connection.php';
$conn = Connect();
?>
<head>
<title>Rentaru</title>
<link rel="shortcut icon" type="image/png" href="assets/img/fav.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
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
<?php $login_customer = $_SESSION['login_customer']; 

    $sql1 = "SELECT * FROM rentedpro rc, products p
    WHERE rc.customer_username='$login_customer' AND p.pro_id=rc.pro_id AND rc.return_status='R'";
    $result1 = $conn->query($sql1);

    if (mysqli_num_rows($result1) > 0) {
?>
    
    <strong><h3 style="margin-bottom: 25px; text-align: center; font-size: 30px; margin-left:40px; margin-right:40px; padding:20px; color:white; background-color:green;"> <strong>Your Bookings </strong></h3></strong>
<div style="background-color:#F4FBA6; margin-left:40px; margin-right:40px; padding:20px;">
    <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;"  >
<table class="table table-striped" >
  <thead class="thead-dark">
<tr>

<tr>
<th width="15%">Product</th>
<th width="15%">Rent Start Date</th>
<th width="15%">Rent End Date</th>
<th width="10%">Fare</th>
<th width="18%">Numbers of months</th>
<th width="15%">Number of Days</th>
<th width="12%">Total Amount</th>
</tr>
</thead>
<?php
        while($row = mysqli_fetch_assoc($result1)) {
?>
<tr>
<td><?php echo $row["pro_name"]; ?></td>
<td><?php echo $row["rent_start_date"] ?></td>
<td><?php echo $row["rent_end_date"]; ?></td>
<td>&#8377; <?php 
            if($row["charge_type"] == "days"){
                    echo ($row["fare"] . "/day");
                } else {
                    echo ($row["fare"] . "/months");
                }
            ?></td>
<td><?php  if($row["charge_type"] == "days"){
                    echo ("-");
                } else {
                    echo ($row["no_of_months"]);
                } ?></td>
<td><?php echo $row["no_of_days"]; ?> </td>
<td>&#8377; <?php echo $row["total_amount"]; ?></td>
</tr>
<?php        } ?>
                </table>
                </div> 
        <?php } else {
            ?>
    
    <div class="container" style="background-color:white; padding:10px;margin-bottom:20px;">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 40px;"> No booked products </h3>
        <p style="margin-bottom: 25px; text-align: center; font-size: 20px;"> Wait for someone to take your product on rent. </p>
    </div>

            <?php
        } ?> 
    </div>
    <div >
        <div class="site-footer" style="color:#ddd;background-color:#282E34;text-align:center;padding:20px 20px;text-align: justify;">
            <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h5 style="color:white;">?? 2020 Rentaru</h5>
                </div>
            </div>
        </div>
    </footer>
        </div>
    </div>     

</body>
</html>