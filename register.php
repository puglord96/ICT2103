<html>
    
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <head>
        <title>Jackson</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel= "stylesheet" href ="css/main.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <!--<script defer src="js/main.js" type="text/javascript"></script>-->
    </head>
    
    <h1>*****</h1>
<?php
        include "header.inc.php";
        ?>

    <body>
    <div class="container">
  <h2>Member Registration</h2>
  <h4>For existing members, Please go to the login page</h4>
  <form name="myForm" action="process_register.php" novalidate onsubmit="return validateForm()" method="post">
      
    <div class="form-group">
      <label for="firstname">First Name:</label>
      <input type="text" class="form-control" id="fname" placeholder="Enter first name" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" name="fname" required>
      <!--//pattern for name only accept 1 space but not 2 or more and doesn't include number-->
    </div>
      
    <div class="form-group">
      <label for="lastname">Last Name:</label>
      <input type="text" class="form-control" id="lname" placeholder="Enter last name" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" name="lname" required>
    </div>
      
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" name="email" required>
    </div>
      
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,50}$" name="pwd" required>
      <!--//pattern is for one uppercase, lowercase, symbol, min 8 max 50 characters-->
    </div>
      
     <div class="form-group">
      <label for="cpwd">Confirm Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,50}$" name="cpwd" required>
    </div>
      
    <div class="checkbox">
      <label><input type="checkbox" required name="remember"> Remember me</label>
    </div>
    <button type="submit" value = "Submit now" class="btn btn-default">Submit</button>
  </form>
  
  
    </div>
    </body>
<?php
        include "footer.inc.php";
        ?>

</html>