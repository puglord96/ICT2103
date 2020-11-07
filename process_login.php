<?php

// Constants for accessing our DB:
define("DBHOST", "localhost");
define("DBNAME", "2103");
define("DBUSER", "root");
define("DBPASS", "");


include "header.inc.php";

$name = $prevschool = $nric = $pwd = $cpwd = $errorMsg = "";
$success = true;


if (empty($_POST["nric"]))
{
$errorMsg .= "NRIC is required.<br>";
$success = false;
}
else
{
$nric = sanitize_input($_POST["nric"]);
// Additional check to make sure e-mail address is well-formed.
if (!filter_var($nric, FILTER_VALIDATE_EMAIL))
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
    
    echo "<p>Welcome Back!</p>";
    echo "<p>Name: ". $name ."</p>";
    echo "<p>Previous School: " . $prevschool ."</p>";
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
    global $name, $prevschool, $nric,$pwd, $errorMsg, $success;
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    }
    else
    {
        
        $sql = "SELECT * FROM student_info WHERE ";
        $sql .= "student_NRIC='$nric' AND password='$pwd'";
        // Execute the query
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            
        // Note that email field is unique, so should only have
        // one row in the result set.
          $row = $result->fetch_assoc();

            $success = true;
        
        }
        else
        {
            $errorMsg = "NRIC not found or password doesn't match...!";
            $success = false;
        }
        $result->free_result();
    }
    $conn->close();
}

include "footer.inc.php";
