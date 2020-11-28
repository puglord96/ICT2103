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
        include "header.inc_nonuser_1.php";
        ?>

    <body>
    <div class="container" id="RegForm">
  <h2>Student Sign Up</h2>
  <h4>For students who already got account, Please go to the login page</h4>
  <form name="myForm" id="myForm" action="process_register.php" novalidate onsubmit="return validateForm()" method="post">
      
    <div class="form-group">
      <label for="fname">Full Name:</label>
      <input type="text" class="form-control" id="fname" placeholder="Enter full name" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" name="fname" required>
      <!--//pattern for name only accept 1 space but not 2 or more and doesn't include number-->
    </div>
      
   <div class="form-group">
      <label for="dob">Date of Birth:</label>
      <input type="date" class="form-control" id="dob" placeholder="Enter your Date of Birth" name="dob" required>
    </div>
      
     <div class="form-group">
      <label for="nationality">Nationality:</label>
      <input type="text" class="form-control" id="nationality" placeholder="Enter your Nationality" name="nationality" required>
    </div>
      
     <div class="form-group">
      <label for="nric">NRIC: (Login ID)</label>
      <input type="text" class="form-control" id="nric" placeholder="Enter email" pattern="(?i)^[STFG]\d{7}[A-Z]$" name="nric" required>
    </div> 
      
      
       <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,50}$" name="pwd" required>
      <!--//pattern is for one uppercase, lowercase, symbol, min 8 max 50 characters-->
    </div>
      
           <div class="form-group">
      <label for="cpwd">Confirm Password:</label>
      <input type="password" class="form-control" id="cpwd" placeholder="Confirm password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,50}$" name="cpwd" required>
    </div>
      
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" name="email" required>
    </div>
      
      <div class="form-group">
      <label for="contact">Contact No:</label>
      <input type="number" class="form-control" id="contact" placeholder="Enter email" name="contact" required>
    </div>
      
      
      <div class="form-group">
      <label for="agg">PSLE Aggregate Score:</label>
      <input type="number" class="form-control" id="agg" placeholder="Enter your PSLE Aggregate Score" pattern="^\d{2,3}$" name="agg" required>
    </div>
     
      
      <div class="form-group">
      <label for="pyear">Year Completed PSLE:</label>
      <input type="number" class="form-control" id="pyear" placeholder="Enter your year completed PSLE" pattern="^\d{4}$" name="pyear" required>
    </div>
      
      <div class="form-group">
      <label for="mt">Mother Tongue:</label>
      <input type="text" class="form-control" id="mt" placeholder="Enter your Mother Tongue" name="mt" required>
    </div>
      
      
      <div class="form-group">
      <label for="pschool">Previous Primary School:</label>
      <input type="text" class="form-control" id="pyear" placeholder="Enter your Previous Primary School" name="pschool" required>
    </div>
      
      <div class="form-group">
      <label for="add1">Address Line 1:</label>
      <input type="text" class="form-control" id="add1" placeholder="Enter your address" name="add1" required>
    </div>
      
      <div class="form-group">
      <label for="add2">Address Line 2:</label>
      <input type="text" class="form-control" id="add1" placeholder="Enter your address" name="add2" required>
    </div>
      

      
      <div class="form-group">
      <label for="gnric">Parent/Guardian's NRIC:</label>
      <input type="text" class="form-control" id="gnric" placeholder="Enter NRIC of your Parent/Guardian" pattern="(?i)^[STFG]\d{7}[A-Z]$" name="gnric" required>
    </div> 
      
      <div class="form-group">
      <label for="gname">Parent/Guardian's Name:</label>
      <input type="text" class="form-control" id="gname" placeholder="Enter your Parent's/Guardian's Name" pattern="(?i)^[STFG]\d{7}[A-Z]$" name="gname" required>
    </div> 
      
      <div class="form-group">
      <label for="gcontact">Contact No:</label>
      <input type="number" class="form-control" id="gcontact" placeholder="Enter contact number" name="gcontact" required>
    </div>
      
      <div class="form-group">
      <label for="relate">Relationship to Child/Ward: </label>
      <input type="text" class="form-control" id="relate" placeholder="" name="relate" required>
    </div> 
      
      <div class="form-group">
      <label for="gnation">Nationality</label>
      <input type="text" class="form-control" id="gnation" placeholder="" name="gnation" required>
    </div> 
      
      
      <div class="form-group">
      <label for="gadd1">Address Line 1:</label>
      <input type="text" class="form-control" id="gadd1" placeholder="Enter your address" name="gadd1" required>
    </div>
      
      <div class="form-group">
      <label for="gadd2">Address Line 2:</label>
      <input type="text" class="form-control" id="gadd1" placeholder="Enter your address" name="gadd2" required>
    </div>
      
      <div class="form-group">
      <label for="occupy">Occupation:</label>
      <input type="text" class="form-control" id="occupy" placeholder="Enter your occupation" name="occupy" required>
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