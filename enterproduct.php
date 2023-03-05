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

    <div class="container" style="margin-top: 25px;" >
    <div class="col-md-10" style="float: none; margin: 0 auto; background-color:#F4FBA6;; padding:60px;margin-bottom:20px;">
      <div class="form-area">
        <form role="form" action="enterproductscript.php" enctype="multipart/form-data" method="POST">
        <br style="clear: both">
          <strong><h3 style="margin-bottom: 25px; text-align: center; font-size: 30px; padding:20px; color:white; background-color:green;"> <strong> Want to rent your Product? Add Now! </strong></h3></strong>
          <div class="form-group">
              <label for="products"><strong>Product Name:</strong></label>
            <input type="text" class="form-control" id="pro_name" name="pro_name" placeholder="Enter Product Name " required autofocus="">
          </div>

          <div class="form-group">
              <label for="products"><strong>Product Description:</strong></label>
            <input type="text" class="form-control" id="pro_des" name="pro_des" placeholder="Enter Product Description" required>
          </div> 
            
          <div class="form-group">
            <label for="pro_city"><strong>Location:</strong></label><br>
            <select id="pro_city" name="pro_city" required>
              <option selected disabled value="">Choose City</option>
              <option value="Udupi" >Udupi</option>
              <option value="Manglore">Manglore</option>
              <option value="Banglore">Banglore</option>
              <option value="Mysore" >Mysore</option>
            </select>
            </div>
            

          <div class="form-group">
              <label for="products"><strong>Rent per month:</strong></label>
            <input type="text" class="form-control" id="pro_rent_per_month" name="pro_rent_per_month" placeholder="Enter  Rent per month (in rupees)" required>
          </div>

          <div class="form-group">
              <label for="products"><strong>Rent per Day:</strong></label>
            <input type="text" class="form-control" id="pro_rent_per_day" name="pro_rent_per_day" placeholder="Enter Rent Per Day (in rupees)" required>
          </div>
            
            <div class="form-group">
            <label for="pro_cat"><strong>Category:</strong></label><br>
            <select id="pro_cat" name="pro_cat" required>
              <option selected disabled value="">Choose Category</option>
              <option value="Electronics & Appliances">Electronics & Appliances</option>
              <option value="Mobiles" >Mobiles</option>
              <option value="Furniture">Furniture</option>
              <option value="Vehicle" >Vehicle</option>
              <option value="Books" >Books</option>
            </select>
            </div>

          <div class="form-group">
            <label for="products"><strong>Product Image:</strong></label>
            <input name="uploadedimage" type="file">
          </div>
            
           <button type="submit" id="submit" name="submit" class="btn btn-success pull-right"> Add Product</button>  
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