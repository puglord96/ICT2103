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
        <script defer src="js/main.js" type="text/javascript"></script>
    </head>
<h1>*****</h1>
<?php
include "header.inc.php";

define("DBHOST", "localhost");
define("DBNAME", "2103");
define("DBUSER", "root");
define("DBPASS", "");


$fname = $lname = $email = $pwd = $cpwd = $errorMsg = "";
$success = true;
if (empty($_POST["fname"]))
{
$errorMsg .= "First name is required.<br>";
$success = false;
}
else
{
$fname = sanitize_input($_POST["fname"]);
// Additional check to make sure e-mail address is well-formed.
if (!preg_match("/^[a-zA-Z]+\s?[a-zA-Z]+$/", $fname))
{
$errorMsg .= "Invalid first name.<br>";
$success = false;
}
}



if (empty($_POST["lname"]))
{
$errorMsg .= "Last name is required.<br>";
$success = false;
}
else
{
$lname = sanitize_input($_POST["lname"]);
// Additional check to make sure e-mail address is well-formed.
if (!preg_match("/^[a-zA-Z]{2,50}$/", $lname))
{
$errorMsg .= "Invalid last name.<br>";
$success = false;
}
}




if (empty($_POST["email"]))
{
$errorMsg .= "Email is required.<br>";
$success = false;
}
else
{
$email = sanitize_input($_POST["email"]);
// Additional check to make sure e-mail address is well-formed.
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
$errorMsg .= "Invalid email format.";
$success = false;
}
}



if (empty($_POST["pwd"]))
{
$errorMsg .= "Password is required.<br>";
$success = false;
}
else
{
$pwd = sanitize_input($_POST["pwd"]);
// Additional check to make sure e-mail address is well-formed.
if (!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $pwd))
{
$errorMsg .= "Invalid password format.<br>";
$success = false;
}
}



if (empty($_POST["cpwd"]))
{
$errorMsg .= "Password is required.<br>";
$success = false;
}
else
{
$cpwd = sanitize_input($_POST["cpwd"]);
// Additional check to make sure e-mail address is well-formed.
if (!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $cpwd))
{
$errorMsg .= "Invalid Password format.";
$success = false;
}
}





if ($success)   
{
    echo '<section class="container"><hr>';
    echo "<h1>Your registration is successful!</h1>";
    echo "<p>Thank you for signing up.</p>";
    echo '<a href="login.php" class="btn btn-default" role="button">Login</a>  <a href="login.php" class="btn btn-default" role="button">Return to Home</a></section><hr>';
    saveMemberToDB();
}
else            
{
    echo '<section class="container"><hr>';
    echo '<h1>Oops!</h1>';
    echo '<h2>The following errors were detected:</h2>';
    echo '<p>' . $errorMsg . '</p>';
    echo '<a href="register.php" class="btn btn-default" role="button">Return to Sign Up</a></section><hr>';
}



//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data)
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

include "footer.inc.php";


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