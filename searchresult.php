<!DOCTYPE html>
<html>
<?php 
session_start(); 
require 'connection.php';
$conn = Connect();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentaru</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/fav.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
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
    

    <div id="sec2" style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
         <strong><h3 style="margin-bottom: 25px; text-align: center; font-size: 30px; margin-left:auto;margin-right:auto; padding:20px; color:white; background-color:#000F64;"> <strong>Filtered Results</strong></h3></strong>
<br>
        <?php
                if (isset($_SESSION['login_customer'])){
                    $user_check=$_SESSION['login_customer'];
            ?>
        <section class="menu-content">
            <?php 
            $city = $conn->real_escape_string($_POST['pro_city']);
            $cat = $conn->real_escape_string($_POST['pro_cat']);
            $sql1 = "SELECT * FROM products p, custpro c WHERE p.pro_availability='yes' AND p.pro_id=c.pro_id AND c.customer_username!='$user_check' AND p.pro_city = '$city' AND p.pro_cat='$cat' ";
            $result1 = mysqli_query($conn,$sql1);

            if(mysqli_num_rows($result1) > 0) {
                while($row1 = mysqli_fetch_assoc($result1)){
                    $pro_id = $row1["pro_id"];
                    $pro_name = $row1["pro_name"];
                    $pro_city = $row1["pro_city"];
                    $pro_cat = $row1["pro_cat"];
                    $pro_rent_per_month = $row1["pro_rent_per_month"];
                    $pro_rent_per_day = $row1["pro_rent_per_day"];
                    $pro_img = $row1["pro_img"];
               
                    ?>
            <a href="booking.php?id=<?php echo($pro_id) ?>">
            <div class="sub-menu">
            
            <img class="card-img-top" src="<?php echo $pro_img; ?>" alt="Card image cap"><br>
            <h5><strong> <?php echo $pro_name; ?> </strong></h5>
            <p style="background-color:Red; color: white; margin:10px; font-size:15px; padding:2px;border-radius:8px; width:100%; "><?php echo $pro_cat; ?></p>
            <h6> Rent Per month: <?php echo ("??? " . $pro_rent_per_month . "/month "); ?></h6>
            <h6> Rent Per Day: <?php echo ("??? " . $pro_rent_per_day . "/day "); ?></h6>
            <h5 style="background-color:Blue; color: white; margin:10px; font-size:20px; padding:8px;border-radius:8px; width:100%; "><strong> Loaction: <?php echo $pro_city; ?> </strong></h5>

            
            </div> 
            </a>
            <?php }}
            else {
                ?>
<h1> No products available :( </h1>
                <?php
            }
            ?>                                   
        </section>
        
        <?php
            }
                else {
            ?>
        
        <section class="menu-content">
            <?php
            $city = $conn->real_escape_string($_POST['pro_city']);
            $cat = $conn->real_escape_string($_POST['pro_cat']);
            $sql1 = "SELECT * FROM products p WHERE pro_availability='yes' AND p.pro_city = '$city' AND p.pro_cat='$cat' ";
            $result1 = mysqli_query($conn,$sql1);

            if(mysqli_num_rows($result1) > 0) {
                while($row1 = mysqli_fetch_assoc($result1)){
                    $pro_id = $row1["pro_id"];
                    $pro_name = $row1["pro_name"];
                    $pro_city = $row1["pro_city"];
                    $pro_cat = $row1["pro_cat"];
                    $pro_rent_per_month = $row1["pro_rent_per_month"];
                    $pro_rent_per_day = $row1["pro_rent_per_day"];
                    $pro_img = $row1["pro_img"];
               
                    ?>
            <a href="booking.php?id=<?php echo($pro_id) ?>">
            <div class="sub-menu">
            

                
            
            <img class="card-img-top" src="<?php echo $pro_img; ?>" alt="Card image cap"><br>
            <h5><strong> <?php echo $pro_name; ?> </strong></h5>
            <p style="background-color:Red; color: white; margin:10px; font-size:15px; padding:2px;border-radius:8px; width:100%; "><?php echo $pro_cat; ?></p>
            <h6> Rent Per month: <?php echo ("??? " . $pro_rent_per_month . "/month "); ?></h6>
            <h6> Rent Per Day: <?php echo ("??? " . $pro_rent_per_day . "/day "); ?></h6>
            <h5 style="background-color:Blue; color: white; margin:10px; font-size:20px; padding:8px;border-radius:8px; width:100%; "><strong> Loaction: <?php echo $pro_city; ?> </strong></h5>

            
            </div> 
            </a>
            <?php }}
            else {
                ?>
<h1> No products available :( </h1>
                <?php
            }
            ?>                                   
        </section>
        
        
        
        <?php   }
                ?>
        
        
                    
    </div>


    <div  style="position:relative;">
        <div class="site-footer" style="color:#ddd;background-color:#282E34;text-align:center;padding:20px 20px;text-align: justify;">
        <footer >
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h5>?? 2020 Rentaru</h5>
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
</body>

</html>