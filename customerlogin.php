<?php
include('login_customer.php'); // Includes Login Script

if(isset($_SESSION['login_customer'])){
header("location: index.php"); //Redirecting
}
?><!DOCTYPE html>
    <html>

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
    <br>
     
<div class="container">
            <div style="background-color:#F4FBA6;">
                <strong><h3 style="margin-bottom: 25px; text-align: center; font-size: 30px; margin-left:auto;margin-right:auto; padding:20px; color:white; background-color:green;"> <strong>Welcome to Rentaru </strong></h3></strong>
                <br>
                
            <div class="container" style="margin-top: -2%; margin-bottom: 2%; margin-left: -4%;" >
            <div class="col-md-5 col-md-offset-4">
                <label style="margin-left: 5px;color: red;"><span> <?php echo $error;  ?> </span></label>
                <div class="panel panel-primary" >
                    <div class="panel-heading" style="background-color:green;"> <strong>Login</strong> </div>
                    <div class="panel-body">

                        <form action="" method="POST">

                            <div class="row">
                                <div class="form-group col-xs-12" >
                                    <label for="customer_username"><span class="text-danger" style="margin-right: 5px;">*</span><strong> Username:</strong> </label>
                                    <div class="input-group">
                                        <strong><input class="form-control" id="customer_username" type="text" name="customer_username" placeholder="Username" required="" autofocus=""></strong>
                                        <span class="input-group-btn" style="background-color:green;">
                <label class="btn " style="background-color:green;"><span class="glyphicon glyphicon-user" style="color:white;" aria-hidden="true">
                    </span></label>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="customer_password"><span class="text-danger" style="margin-right: 5px;">*</span><strong> Password:</strong> </label>
                                    <div class="input-group">
                                        <strong><input class="form-control" id="customer_password" type="password" name="customer_password" placeholder="Password" required=""></strong>
                                        <span class="input-group-btn" style="background-color:green;">
                <label class="btn" style="background-color:green;"><span class="glyphicon glyphicon-lock" style="color:white;" aria-hidden="true"></span></label>
                                        </span>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-xs-4">
                                    <button class="btn" style="color:white; background-color:green;" name="submit" type="submit" value=" Login "><strong>Submit</strong></button>
                                    

                                </div>

                            </div>
                            <label style="margin-left: 5px;">or</label> <br>
                            <label style="margin-left: 5px;"><a href="customersignup.php">Create a new account.</a></label>
                        </form>
                    </div>
                </div>
            </div>
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
</body>

</html>