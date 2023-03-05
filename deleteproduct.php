<html>

  <head>
  <title>Pixel Bay</title>
  </head>
  <link rel="shortcut icon" type="image/png" href="assets/img/fav.png">
  <link rel="stylesheet" type = "text/css" href ="assets/css/manager_registered_success.css">
  <link rel="stylesheet" type = "text/css" href ="assets/bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

  <body>

<?php

require 'connection.php';
$conn = Connect();
$pro_id = $_GET["id"];
$query = "DELETE FROM custpro WHERE pro_id='$pro_id'";
$success = $conn->query($query);   
      
$query = "DELETE FROM products WHERE pro_id='$pro_id'";
$success = $conn->query($query);    
      
if (!$success){ 
    die("Couldnt delete data: ".$conn->error);	
}
else {
    header("location: index.php"); //Redirecting 
}
$conn->close();
?>
    </body>
</html>