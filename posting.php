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
        <link rel= "stylesheet" href ="css.css" />
        <link rel= "stylesheet" href ="images/" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <!--<script defer src="js/main.js" type="text/javascript"></script>-->
    </head>
    
     <h1>   </h1>
<?php
include "header.inc.php";

define("DBHOST", "localhost");
define("DBNAME", "2103");
define("DBUSER", "root");
define("DBPASS", "");


$fname = $lname = $email = $pwd = $cpwd = $errorMsg = "";
    $photo = "moe.png";
    echo  '<img src="images/MOE.png" alt="moe" class = "center"> ';
    echo '<section class="container"><hr>';
    echo "<h1>S1 OPTION FORM </h1>";
    echo "<h2>Student's Particulars </h2>";
    echo "<p>Name of students: </p>";
    echo "<p>Primary School: </p>";
    echo "<p>Year of PSLE: </p>";
    echo "<p>PSLE Index No: </p>";
    echo "<p>Citizenship: </p>";
    echo "<p>PSLE Aggregate: </p>";
    echo "<p>Course Eligible </p>";
    saveMemberToDB();



function saveMemberToDB(){
    global $fname, $lname, $email, $pwd, $errorMsg, $success;
    // Create connection
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    //Check connection
    if ($conn->connect_error)
    {$errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
    }
    else
    {
    $sql = "INSERT INTO userlogin (firstname, lastname, email, password)";$sql .= " VALUES('$fname', '$lname', '$email', '$pwd')";
    // Execute the queryif (!$conn->query($sql))   
    if (!$conn->query($sql))
    {
        $errorMsg = "Database error: " . $conn->error;
        $success = false;
        
    }   
  }
  $conn->close();
}
?>
     
     
     
     
     
    <body>    
    <div class="container">
    <h2>Parent's/ Guardian's Local Contact Details</h2>
    <form name="myForm" action="process_login.php"  novalidate onsubmit="return validateForm()" method="post">
      
      
    <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
    </div>
      
    <div class="form-group">
    <label for="mobileNo">Mobile No:</label>
    <input type="text" class="form-control" id="mobileNo" placeholder="Enter Mobile Number" name="mobileNo">
    </div>
      
    <div class="form-group">
    <label for="contactNo">Contact No:</label>
    <input type="text" class="form-control" id="contactNo" placeholder="Enter Contact Number" name="contactNo">
    </div>
      
      
    <h2>Choices of Secondary Schools</h2>  
    <h4>Please Enter 4-Digit Option Code </h4>
    <div class="form-group">
    <label for="firstchoice">First Choice:</label>
    <input type="text" class="form-control" id="firstchoice" placeholder="Enter First Choice" name="firstchoice">
    </div>
    
    <div class="form-group">
    <label for="secondchoice">Second Choice:</label>
    <input type="text" class="form-control" id="secondchoice" placeholder="Enter Second Choice" name="secondchoice">
    </div>
    
    <div class="form-group">
    <label for="thirdchoice">Third Choice:</label>
    <input type="text" class="form-control" id="thirdchoice" placeholder="Enter Third Choice" name="thirdchoice">
    </div>
    
    
    <div class="form-group">
    <label for="fourthchoice">Fourth Choice:</label>
    <input type="text" class="form-control" id="fourthchoice" placeholder="Enter Fourth Choice" name="fourthchoice">
    </div>
    
    
    <div class="form-group">
    <label for="fifthchoice">Fifth Choice:</label>
    <input type="text" class="form-control" id="fifthchoice" placeholder="Enter Fifth Choice" name="fifthchoice">
    </div>
    
    <div class="form-group">
    <label for="sixthchoice">Sixth Choice:</label>
    <input type="text" class="form-control" id="sixthchoice" placeholder="Enter Sixth Choice" name="sixthchoice">
    </div>
    
    
      
    <button type="submit" value = "Submit now" class="btn btn-default">Submit</button>
  </form>
  
  
    </div>
    </body>
<?php
        include "footer.inc.php";
        ?>

</html>