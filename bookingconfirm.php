        <?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?>
<!DOCTYPE html>
<html>



<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <title>Rentaru</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="assets/img/fav.png">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bookingconfirm.css" />
</head>

<body>
    
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

    $charge_type = $_POST['radio'];
    $customer_username = $_SESSION["login_customer"];
    $pro_id  = $car_id = $conn->real_escape_string($_POST['hidden_carid']);
    $rent_start_date = date('Y-m-d', strtotime($_POST['rent_start_date']));
    $rent_end_date = date('Y-m-d', strtotime($_POST['rent_end_date']));
    $return_status = "NR"; // not returned
    $fare = "NA";


    function dateDiff($start, $end) {
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400);
    }
    
    $err_date = dateDiff("$rent_start_date", "$rent_end_date");

    $sql0 = "SELECT * FROM products WHERE pro_id = '$pro_id'";
    $result0 = $conn->query($sql0);

    if (mysqli_num_rows($result0) > 0) {
        while($row0 = mysqli_fetch_assoc($result0)) {

            if($charge_type == "months"){
                $fare = $row0["pro_rent_per_month"];
                $alt_fare = $row0["pro_rent_per_day"];
            } else if ($charge_type == "days"){
                $fare = $row0["pro_rent_per_day"];
                $alt_fare = $row0["pro_rent_per_month"];
            } else {
                $fare = "NA";
            }
        }
    }
    if($err_date >= 0) { 
    $sql1 = "INSERT into rentedpro(customer_username,pro_id,booking_date,rent_start_date,rent_end_date,fare, alt_fare,charge_type,return_status) 
    VALUES('" . $customer_username . "','" . $pro_id . "','" . date("Y-m-d") ."','" . $rent_start_date ."','" . $rent_end_date . "','" . $fare . "','" . $alt_fare . "','" . $charge_type . "','" . $return_status . "')";
    $result1 = $conn->query($sql1);

    $sql2 = "UPDATE products SET pro_availability = 'no' WHERE pro_id = '$pro_id'";
    $result2 = $conn->query($sql2);

    

    $sql4 = "SELECT * FROM  products p, customers c, rentedpro rp, custpro cp WHERE p.pro_id = '$pro_id' AND p.pro_id=cp.pro_id AND cp.customer_username = c.customer_username";
    $result4 = $conn->query($sql4);


    if (mysqli_num_rows($result4) > 0) {
        while($row = mysqli_fetch_assoc($result4)) {
            $id = $row["id"];
            $pro_name = $row["pro_name"];
            $pro_des = $row["pro_des"];
            $pro_cat = $row["pro_cat"];
            $pro_city = $row["pro_city"];
            $customer_name = $row["customer_name"];
            $customer_phone = $row["customer_phone"];
        }
    }

    if (!$result1 | !$result2 ){
        die("Couldnt enter data: ".$conn->error);
    }

?>


    <div class="container" style="background-color:#F4FBA6;">
        <div class="jumbotron" style="background-color:#F4FBA6;">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Booking Confirmed</h1>
        </div>
    </div>
    <br>

    <h2 class="text-center"> <strong>Thank you for visiting Rentaru! </strong></h2>

 

    <h3 class="text-center"> <strong>Your Order Number:</strong> <span style="color: blue;"><?php echo "$id"; ?></span> </h3>


    <div class="container">
        <h4 class="text-center">Please read the following information about your order.</h4><br>
        <div class="box" style="background-color:#F4FBA6;">
            <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
                <h3 style="color: green;"><strong>Your booking has been received and placed into out order processing system.</strong></h3>
                <h5>Please make a note of your <strong>order number</strong> now and keep in the event you need to communicate with us about your order.</h5>
                <hr>
                <strong><h3 style="margin-bottom: 25px; text-align: center; font-size: 30px; margin-left:auto;margin-right:auto; padding:20px; color:white; background-color:green;"> <strong>Invoice Details </strong></h3></strong>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>Product Name: </strong> <?php echo $pro_name; ?></h4>
                <br>
                <h4> <strong>Product Description:</strong> <?php echo $pro_des; ?></h4>
                <br>
                <h4> <strong>Product Location:</strong> <?php echo $pro_city; ?></h4>
                <br>
                <h4> <strong>Product Category:</strong> <?php echo $pro_cat; ?></h4>
                <br>
                <hr>
                
                <?php     
                if($charge_type == "days"){
                ?>
                     <h4> <strong>Fare:</strong> ₹<?php echo $fare; ?>/day</h4>
                <?php } else {
                    ?>
                    <h4> <strong>Fare:</strong> ₹<?php echo $fare; ?>/months</h4>

                <?php } ?>

                <br>
                <h4> <strong>Booking Date: </strong> <?php echo date("Y-m-d"); ?> </h4>
                <br>
                <h4> <strong>Start Date: </strong> <?php echo $rent_start_date; ?></h4>
                <br>
                <h4> <strong>Return Date: </strong> <?php echo $rent_end_date; ?></h4>
                <br>
                <hr>
                <h4> <strong>Owner Name:</strong>  <?php echo $customer_name; ?></h4>
                <br>
                <h4> <strong>Owner Contact: </strong> <?php echo $customer_phone; ?></h4>
                <br>
            </div>
        </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h5>Warning! <strong>Do not reload this page</strong> or the above display will be lost. If you want a hardcopy of this page, please print it now.</h5>
            <br><br>
        </div>
    </div>
<?php } else { ?>
    <div class="container">
	<div class="jumbotron" style="text-align: center;">
        You have selected an incorrect date.
        <br><br>
        </div>
</div>
                <?php } ?>
    
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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/theme.js"></script>
    
        </body>
</html>