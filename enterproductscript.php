<html>

  <head>
  <title>Rentaru</title>
  </head>
  <?php session_start(); ?>
  <link rel="shortcut icon" type="image/png" href="assets/img/fav.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">

    <link rel="stylesheet" href="assets/w3css/w3.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

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

require 'connection.php';
$conn = Connect();

function GetImageExtension($imagetype) {
    if(empty($imagetype)) return false;
    
    switch($imagetype) {
        case 'assets/img/products/bmp': return '.bmp';
        case 'assets/img/products/gif': return '.gif';
        case 'assets/img/products/jpeg': return '.jpg';
        case 'assets/img/products/png': return '.png';
        default: return false;
    }
}

$pro_name = $conn->real_escape_string($_POST['pro_name']);
$pro_des = $conn->real_escape_string($_POST['pro_des']);
$pro_city = $conn->real_escape_string($_POST['pro_city']);
$pro_rent_per_month = $conn->real_escape_string($_POST['pro_rent_per_month']);
$pro_rent_per_day = $conn->real_escape_string($_POST['pro_rent_per_day']);
$pro_cat = $conn->real_escape_string($_POST['pro_cat']);
$pro_availability = "yes";
      
     /*echo "<h2>" . $pro_city . "</h2>";
      echo "<h2>" . $pro_cat . "</h2>";*/
      

//$query = "INSERT into products(car_name,car_nameplate,ac_price,non_ac_price,car_availability) VALUES('" . $car_name . "','" . $car_nameplate . "','" . $ac_price . "','" . $non_ac_price . "','" . $car_availability ."')";
//$success = $conn->query($query);


if (!empty($_FILES["uploadedimage"]["name"])) {
    $file_name=$_FILES["uploadedimage"]["name"];
    $temp_name=$_FILES["uploadedimage"]["tmp_name"];
    $imgtype=$_FILES["uploadedimage"]["type"];
    $ext= GetImageExtension($imgtype);
    $imagename=$_FILES["uploadedimage"]["name"];
    $target_path = "assets/img/products/".$imagename;

    if(move_uploaded_file($temp_name, $target_path)) {
        //$query0="INSERT into products (car_img) VALUES ('".$target_path."')";
      //  $query0 = "UPDATE products SET car_img = '$target_path' WHERE ";
        //$success0 = $conn->query($query0);

        $query = "INSERT into products(pro_name,pro_des,pro_city,pro_img,pro_rent_per_month,pro_rent_per_day,pro_cat,pro_availability) VALUES('" . $pro_name . "','" . $pro_des . "','" . $pro_city . "','".$target_path."','" . $pro_rent_per_month . "','" . $pro_rent_per_day . "','" . $pro_cat . "','" . $pro_availability ."')";
        $success = $conn->query($query);

        
    } 

}


// Taking car_id from products

$query1 = "SELECT pro_id from products where pro_des = '$pro_des'";

$result = mysqli_query($conn, $query1);
$rs = mysqli_fetch_array($result, MYSQLI_BOTH);
$pro_id = $rs['pro_id'];
 

$query2 = "INSERT into custpro(pro_id,customer_username) values('" . $pro_id ."','" . $_SESSION['login_customer'] . "')";
$success2 = $conn->query($query2);

if (!$success){ ?>
    <div class="container">
	<div class="jumbotron" style="text-align: center;">
        <?php echo $conn->error; ?>
        <br><br>
        <a href="enterproductscript.php" class="btn btn-default"> Go Back </a>
</div>
<?php	
}
else {
    header("location: enterproduct.php"); //Redirecting 
}

$conn->close();

?>

      </div>
    </body>
</html>