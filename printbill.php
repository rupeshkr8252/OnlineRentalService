<!DOCTYPE html>
<html>
<?php 
session_start();
require 'connection.php';
$conn = Connect();
?>
<head>
<link rel="shortcut icon" type="image/png" href="assets/img/fav.png">
<title>Rentaru</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
<link rel="stylesheet" href="assets/w3css/w3.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/bookingconfirm.css" />
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

<?php 
$id = $_GET["id"];
$months = NULL;
$months_or_days = $conn->real_escape_string($_POST['months_or_days']);
$return_date = date('Y-m-d');
$fare = $conn->real_escape_string($_POST['hid_fare']);
$total_amount = $months_or_days * $fare;
$return_status = "R";
$login_customer = $_SESSION['login_customer'];

$sql0 = "SELECT rp.id, rp.rent_end_date, rp.charge_type, rp.rent_start_date, p.pro_name, p.pro_des FROM rentedpro rp, products p WHERE id = '$id' AND p.pro_id = rp.pro_id";
$result0 = $conn->query($sql0);

if(mysqli_num_rows($result0) > 0) {
    while($row0 = mysqli_fetch_assoc($result0)){
            $rent_end_date = $row0["rent_end_date"];  
            $rent_start_date = $row0["rent_start_date"];
            $pro_name = $row0["pro_name"];
            $pro_des = $row0["pro_des"];
            $charge_type = $row0["charge_type"];
    }
}


if($charge_type == "days"){
    $no_of_days = $months_or_days;
    $sql1 = "UPDATE rentedpro SET pro_return_date='$return_date', no_of_days='$no_of_days', total_amount='$total_amount', return_status='$return_status' WHERE id = '$id' ";
} else {
    $months = $months_or_days;
    $sql1 = "UPDATE rentedpro SET pro_return_date='$return_date', no_of_months='$months', total_amount='$total_amount', return_status='$return_status' WHERE id = '$id' ";
}

$result1 = $conn->query($sql1);

if ($result1){
     $sql2 = "UPDATE products p, rentedpro rp SET p.pro_availability='yes' 
     WHERE rp.pro_id=p.pro_id AND rp.customer_username = '$login_customer' AND rp.id = '$id'";
     $result2 = $conn->query($sql2);
}
else {
    echo $conn->error;
}
?>
    
    <div class="container" style="background-color:#F4FBA6;">
        <div class="jumbotron" style="background-color:#F4FBA6;">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Product Returned</h1>
        </div>
    </div>
    <br>

    <h2 class="text-center"> <strong>Thank you for visiting Rentaru! </strong></h2>

 

    <h3 class="text-center"> <strong>Your Order Number:</strong> <span style="color: blue;"><?php echo "$id"; ?></span> </h3>
            
    <div class="container">
        <h4 class="text-center">Please read the following information about your order.</h4><br>
        <div class="box" style="background-color:#F4FBA6;">
            <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
                <h3 style="color: green;"><strong>Your returned has been received and placed processing.</strong></h3>
                <h5>Please make a note of your <strong>order number</strong> now and keep in the event you need to communicate with us about your order.</h5>
                <hr>
                <strong><h3 style="margin-bottom: 25px; text-align: center; font-size: 30px; margin-left:auto;margin-right:auto; padding:20px; color:white; background-color:green;"> <strong>Invoice Details </strong></h3></strong>
                <br>
            </div>
            
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>Product Name: </strong> <?php echo $pro_name;?></h4>
                <br>
                <h4> <strong>Description:</strong> <?php echo $pro_des; ?></h4>
                <br>
                <h4> <strong>Fare:&nbsp;</strong>  ₹<?php 
            if($charge_type == "days"){
                    echo ($fare . "/day");
                } else {
                    echo ($fare . "/month");
                }
            ?></h4>
                <br>
                <h4> <strong>Booking Date: </strong> <?php echo date("Y-m-d"); ?> </h4>
                <br>
                <h4> <strong>Start Date: </strong> <?php echo $rent_start_date; ?></h4>
                <br>
                <h4> <strong>Rent End Date: </strong> <?php echo $rent_end_date; ?></h4>
                <br>
                <h4> <strong>Return Date: </strong> <?php echo $return_date; ?> </h4>
                <br>
                <?php if($charge_type == "days"){?>
                    <h4> <strong>Number of days:</strong> <?php echo $months_or_days; ?> day(s)</h4>
                <?php } else { ?>
                    <h4> <strong>Months Used:</strong> <?php echo $months_or_days; ?> month(s)</h4>
                <?php } ?>
                <br>
                
                <h4> <strong>Total Amount: </strong> ₹<?php echo $total_amount; ?>/-     </h4>
                <br>
            </div>
        </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h5>Warning! <strong>Do not reload this page</strong> or the above display will be lost. If you want a hardcopy of this page, please print it now.</h5>
            <br><br>
        </div>
    </div>
    
    <div >
        <div class="site-footer" style="color:#ddd;background-color:#282E34;text-align:center;padding:20px 20px;text-align: justify;">
            <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h5 style="color:white;">© 2020 Rentaru</h5>
                </div>
            </div>
        </div>
    </footer>
        </div>
    </div> 
    </body>
</html>