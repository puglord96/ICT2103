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
define("DBNAME", "school");
define("DBUSER", "root");
define("DBPASS", "sceptile101");



$fname = $dob = $nationality = $nric = $email = $pwd = $cpwd = $cname = $cnric = $relate = $occupy = $add1 = $add2 = $errorMsg = "";
$contact = 0;
$success = true;

if (empty($_POST["fname"]))
{
$errorMsg .= "Full is required.<br>";
$success = false;
}
else
{
$fname = sanitize_input($_POST["fname"]);

}

if (empty($_POST["dob"]))
{
$errorMsg .= "Date of Birth is required.<br>";
$success = false;
}
else
{
$dob = sanitize_input($_POST["dob"]);
// Additional check to make sure e-mail address is well-formed.

}


if (empty($_POST["nationality"]))
{
$errorMsg .= "Nationality is required.<br>";
$success = false;
}
else
{
$nationality = sanitize_input($_POST["nationality"]);
// Additional check to make sure e-mail address is well-formed.

}

if (empty($_POST["nric"]))
{
$errorMsg .= "Your NRIC is required.<br>";
$success = false;
}
else
{
$nric = sanitize_input($_POST["nric"]);
// Additional check to make sure e-mail address is well-formed.

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
if ($cpwd != $pwd)
{
$errorMsg .= "Password Mismatch";
$success = false;
}
}

if (empty($_POST["contact"]))
{
$errorMsg .= "Your contact number is required.<br>";
$success = false;
}
else
{
$contact = sanitize_input($_POST["contact"]);
// Additional check to make sure e-mail address is well-formed.

}

if (empty($_POST["cname"]))
{
$errorMsg .= "Please enter your child's name.<br>";
$success = false;
}
else
{
$cname = sanitize_input($_POST["cname"]);
// Additional check to make sure e-mail address is well-formed.

}



if (empty($_POST["relate"]))
{
$errorMsg .= "Please enter the year of completion for your PSLE.<br>";
$success = false;
}
else
{
$relate = sanitize_input($_POST["relate"]);
// Additional check to make sure e-mail address is well-formed.

}

if (empty($_POST["occupy"]))
{
$errorMsg .= "Please enter the year of completion for your PSLE.<br>";
$success = false;
}
else
{
$occupy = sanitize_input($_POST["occupy"]);
// Additional check to make sure e-mail address is well-formed.

}

if (empty($_POST["add1"]))
{
$errorMsg .= "Please enter the year of completion for your PSLE.<br>";
$success = false;
}
else
{
$add1 = sanitize_input($_POST["add1"]);
// Additional check to make sure e-mail address is well-formed.

}

if (empty($_POST["add2"]))
{
$errorMsg .= "Please enter the year of completion for your PSLE.<br>";
$success = false;
}
else
{
$add2 = sanitize_input($_POST["add2"]);
// Additional check to make sure e-mail address is well-formed.

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
    global $fname, $dob, $nationality , $nric , $email , $pwd , $cpwd , $cname , $cnric , $add1 , $add2 , $contact , $relate , $occupy, $errorMsg;
    // Create connection
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    //Check connection
    if ($conn->connect_error)
    {$errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
    }
    else
    {
    $sql = "INSERT INTO guard_info  VALUES('$nric', '$fname', '$pwd', '$contact', '$cname', '$relate', '$add1', '$add2', '$occupy')";
    // Execute the queryif (!$conn->query($sql))   
    if (!$conn->query($sql))
    {
        $errorMsg = "Database error: " . $conn->error;
        $success = false;
        
    }   
  }
  $conn->close();
}