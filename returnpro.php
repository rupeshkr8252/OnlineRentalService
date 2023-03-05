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

function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}

 $id = $_GET["id"];
 $sql1 = "SELECT p.pro_name, p.pro_des, p.pro_city, p.pro_img, p.pro_cat, rp.rent_start_date, rp.rent_end_date, rp.fare, rp.alt_fare, rp.charge_type
 FROM rentedpro rp, products p
 WHERE id = '$id' AND p.pro_id=rp.pro_id";
 $result1 = $conn->query($sql1);
 if (mysqli_num_rows($result1) > 0) {
    while($row = mysqli_fetch_assoc($result1)) {
        $pro_name = $row["pro_name"];
        $pro_des = $row["pro_des"];
        $pro_cat = $row["pro_cat"];
        $pro_city = $row["pro_city"];
        $pro_img = $row["pro_img"];
        $rent_start_date = $row["rent_start_date"];
        $rent_end_date = $row["rent_end_date"];
        $fare = $row["fare"];
        $alt_fare = $row["alt_fare"];
        $charge_type = $row["charge_type"];
        
        $return_date = date('Y-m-d');
        $days_actual = dateDiff("$rent_start_date", "$return_date");
        if($days_actual<0)
        {
            $days_actual = 0;
        }
        $days_proposed = dateDiff("$rent_start_date", "$rent_end_date");
        
        if ($days_proposed >= $days_actual) 
        {
          $no_of_days = $days_actual+1;
            $days_proposed +=1;
            $days_actual +=1;
        }
        else
        {
            $extra = $days_actual - $days_proposed;
            $change = $extra*1.2;
            $added = $change - $extra;
            $no_of_days = $days_actual+$change+1;
            $days_proposed +=1;
            $days_actual +=1;
        }
        
        $no_of_month = $no_of_days/30;
    }
}
?>
    <div class="container">
        <strong><h3 style="margin-bottom: 25px; text-align: center; font-size: 30px; margin-left:40px; margin-right:40px; padding:20px; color:white; background-color:green;"> <strong> Product Details </strong></h3></strong>
    <div class="col-md-10" style="float: none; margin: 0 auto;  background-color:#F4FBA6; padding:60px;margin-bottom:20px;">
      <div class="form-area" >
        <form role="form" action="printbill.php?id=<?php echo $id ?>" method="POST" >
        <br style="clear: both">
            
            
           <img class="card-img-top,center" src="<?php echo $pro_img; ?>" alt="Card image cap"><hr>

           <h5> <strong>Product:&nbsp; </strong>  <?php echo($pro_name);?></h5>
            
           <h5> <strong> Description : </strong>&nbsp; <?php echo($pro_des);?></h5>
            
           <h5> <strong> Location : &nbsp; </strong> <?php echo($pro_city);?></h5>

           <h5> <strong> Rent date:&nbsp; </strong>  <?php echo($rent_start_date);?></h5>

           <h5> <strong> End Date:&nbsp; </strong>  <?php echo($rent_end_date);?></h5>

            
            <?php
            if($charge_type == 'months')
            {
                if($days_actual<30)
                {
                    $fare = $alt_fare;
                    $charge_type == 'days'
            ?>
                    <h5 style="color:red;"><strong>You had choose a monthly option but used for less than a month so applying daily rent.</strong></h5>
            <?php
                }
            }
            ?>
            
           <h5> <strong>Fare:&nbsp; </strong>  ₹<?php 
            if($charge_type == "days"){
                    echo ($fare . "/day");
                } else if ($charge_type == "months" && $days_actual<30){
                    echo ($alt_fare . "/day");
                } else {
                    echo ($fare . "/month");
            }
            ?>
            </h5>
            <hr>
            
            
            
            
            <?php
            if ($days_proposed >= $days_actual) 
            { ?>
            <strong><p style="color:green;">Wow, You are returning on time.</p></strong>
            
            <h5> <strong> Proposed Days : </strong>&nbsp; <?php echo($days_proposed);?></h5>
            <h5> <strong> Your Days : </strong>&nbsp; <?php echo($days_actual);?></h5>
            <?php }
            else
            { ?>
            <strong><p style="color:red;">Sorry, You took <?php echo($extra);?> extra days.</p></strong>
            
            <h5> <strong> Proposed Days : </strong>&nbsp; <?php echo($days_proposed);?></h5>
            <h5> <strong> Your Days : </strong>&nbsp; <?php echo($days_actual);?></h5>
            <h5> <strong> Extra Days : </strong>&nbsp; <?php echo($extra);?></h5>
            <h5> <strong> Days as fine : </strong>&nbsp; <?php echo($added);?></h5>
            
            <strong><p style="color:red;">So 20% fine of <?php echo($extra);?> days will increase extra days by <?php echo($added);?> days.</p></strong>
                
            <?php } ?>
  
            <?php
            if($charge_type == "days"){ ?>  
                    <hr><h5> <strong>Number of Day(s):&nbsp; </strong> <?php echo($no_of_days);?></h5>
            <input type="hidden" name="months_or_days" value="<?php echo $no_of_days; ?>">
               <?php } else if ($charge_type == "months" && $days_actual<30){ ?>  
                    <hr><h5> <strong>Number of Day(s):&nbsp; </strong> <?php echo($no_of_days);?></h5>
            <input type="hidden" name="months_or_days" value="<?php echo $no_of_days; ?>">
               <?php } else { ?>  
                    <h5> <strong>Number of Month(s):&nbsp; </strong> <?php echo($no_of_month);?></h5>
            <input type="hidden" name="months_or_days" value="<?php echo $no_of_month; ?>">
            <?php } ?>
            
            
          <input type="hidden" name="hid_fare" value="<?php echo $fare; ?>">

           <input type="submit" name="submit" value="submit" class="btn btn-success pull-right">    
        </form>
      </div>
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