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

// Constants for accessing our DB:
define("DBHOST", "localhost");
define("DBNAME", "travel_photo");
define("DBUSER", "root");
define("DBPASS", "");


include "header.inc.php";

$fname = $lname = $email = $pwd = $cpwd = $errorMsg = "";
$success = true;


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

userlogin();


if ($success)   
{
    
    echo '<section class="container"><hr>';
    echo "<h1>Login successful!</h1>";
    
    echo "<p>welcome back, " . $fname ." " . $lname ."</p>";
    echo '<a href="#login" class="btn btn-default" role="button">Login</a>  <a href="index.php" class="btn btn-default" role="button">Return to Home</a></section><hr>';
}
else            
{
    echo '<section class="container"><hr>';
    echo '<h1>Oops!</h1>';
    echo '<h2>The following errors were detected:</h2>';
    echo '<p> Email not found or password doesnt match </p>';
    echo '<a href="login.php" class="btn btn-default" role="button">Return to Sign Up</a></section><hr>';
}



//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data)
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}


function userlogin()
{
    global $fname,$lname,$email,$pwd, $errorMsg, $success;
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    }
    else
    {
        
        $sql = "SELECT * FROM travel_photo_members WHERE ";
        $sql .= "email='$email' AND password='$pwd'";
        // Execute the query
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            
        // Note that email field is unique, so should only have
        // one row in the result set.
          $row = $result->fetch_assoc();
            $fname = $row["fname"];
            $lname = $row["lname"];
            $success = true;
        
        }
        else
        {
            $errorMsg = "Email not found or password doesn't match...!";
            $success = false;
        }
        $result->free_result();
    }
    $conn->close();
}

include "footer.inc.php";
