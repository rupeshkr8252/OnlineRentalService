<!DOCTYPE html>
<html>

<?php 
include('session_customer.php'); ?> 
<head>
<link rel="shortcut icon" type="image/png" href="assets/img/fav.png">
<title>Rentaru</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
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

        <div class="col-md-12" style="float: none; margin: 0 auto; background-color:#F4FBA6; padding:60px;margin-bottom:20px;">
    <div class="form-area" style="padding: 10px 10px 10px 10px;">
        <form action="" method="POST">
        <br style="clear: both">
            <strong><h3 style="margin-bottom: 25px; text-align: center; font-size: 30px; padding:20px; color:white; background-color:green;"> <strong> Your Products </strong></h3></strong>
<?php
// Storing Session
$user_check=$_SESSION['login_customer'];
$sql = "SELECT * FROM products WHERE pro_id IN (SELECT pro_id FROM custpro WHERE customer_username='$user_check');";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  ?>
            
            
<div style="overflow-x:auto; background-color:#F4FBA6;">
  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th></th>
        <th width="10%"> Name</th>
        <th width="30%"> Description </th>
        <th width="10%"> Loaction </th>
        <th width="10%"> Rent/month</th>
        <th width="10%"> Rent/Day</th>
        <th width="10%"> Category</th>
        <th width="10%"> Availability </th>
        <th width="10%"> Delete</th>
      </tr>
    </thead>

    <?PHP
      //OUTPUT DATA OF EACH ROW
      while($row = mysqli_fetch_assoc($result)){
          $pro_id = $row["pro_id"];
    ?>

  <tbody>
    <tr>
      
      <td> <span class="glyphicon glyphicon-menu-right"></span> </td>
      <td><?php echo $row["pro_name"]; ?></td>
      <td><?php echo $row["pro_des"]; ?></td>
      <td><?php echo $row["pro_city"]; ?></td>
      <td><?php echo $row["pro_rent_per_month"]; ?></td>
      <td><?php echo $row["pro_rent_per_day"]; ?></td>
      <td><?php echo $row["pro_cat"]; ?></td>
      <td><?php echo $row["pro_availability"]; ?></td>
      <td><a href="deleteproduct.php?id=<?php echo($pro_id) ?>"  style="color:white; background-color:red;padding:5px;"><strong>Delete</strong></a></td>
      <td></td>
      
    </tr>
  </tbody>
  <?php } ?>
  </table>
  </div>
    <br>
  <?php } else { ?>
  <h4><center>0 Products available</center> </h4>
  <?php } ?>
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