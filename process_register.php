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


$fname = $dob = $nationality = $nric = $email = $gnric = $pwd = $cpwd = $mt = $pschool = $add1 = $add2 = $errorMsg = $gnric = $gname  = $relate = $gadd1 = $gadd2 = $occupy = $gnation= "";
$contact = $agg = $pyear = $gcontact = 0;
$success = true;

if (empty($_POST["gnric"]))
{
$errorMsg .= "Parent/Guardian NRIC is required.<br>";
$success = false;
}
else
{
$gnric = sanitize_input($_POST["gnric"]);

}


if (empty($_POST["gname"]))
{
$errorMsg .= "Parent/Guardian Name is required.<br>";
$success = false;
}
else
{
$gname = sanitize_input($_POST["gname"]);

}

if (empty($_POST["gcontact"]))
{
$errorMsg .= "Parent/Guardian Name is required.<br>";
$success = false;
}
else
{
$gcontact = sanitize_input($_POST["gcontact"]);

}


if (empty($_POST["relate"]))
{
$errorMsg .= "Parent/Guardian Name is required.<br>";
$success = false;
}
else
{
$relate = sanitize_input($_POST["relate"]);

}


if (empty($_POST["gadd1"]))
{
$errorMsg .= "Parent/Guardian Address is required.<br>";
$success = false;
}
else
{
$gadd1 = sanitize_input($_POST["gadd1"]);

}


if (empty($_POST["gadd2"]))
{
$errorMsg .= "Parent/Guardian Address is required.<br>";
$success = false;
}
else
{
$gadd1 = sanitize_input($_POST["gadd2"]);

}

if (empty($_POST["occupy"]))
{
$errorMsg .= "Parent/Guardian Occupation is required.<br>";
$success = false;
}
else
{
$occupy = sanitize_input($_POST["occupy"]);

}

if (empty($_POST["gnation"]))
{
$errorMsg .= "Parent/Guardian Nationality is required.<br>";
$success = false;
}
else
{
$gnation = sanitize_input($_POST["gnation"]);

}

if (empty($_POST["fname"]))
{
$errorMsg .= "First name is required.<br>";
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
$dob = date('Y-m-d',strtotime(sanitize_input($_POST["dob"])));
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
// Additional check to make sure e-mail address is well-formed.

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

if (empty($_POST["gnric"]))
{
$errorMsg .= "Your Parent's NRIC is required.<br>";
$success = false;
}
else
{
$gnric = sanitize_input($_POST["gnric"]);
// Additional check to make sure e-mail address is well-formed.

}

if (empty($_POST["agg"]))
{
$errorMsg .= "Your PSLE aggregate score is required.<br>";
$success = false;
}
else
{
$agg = sanitize_input($_POST["agg"]);
// Additional check to make sure e-mail address is well-formed.

}

if (empty($_POST["pyear"]))
{
$errorMsg .= "Please enter the year of completion for your PSLE.<br>";
$success = false;
}
else
{
$pyear = sanitize_input($_POST["pyear"]);
// Additional check to make sure e-mail address is well-formed.

}

if (empty($_POST["mt"]))
{
$errorMsg .= "Please enter the year of completion for your PSLE.<br>";
$success = false;
}
else
{
$mt = sanitize_input($_POST["mt"]);
// Additional check to make sure e-mail address is well-formed.

}

if (empty($_POST["pschool"]))
{
$errorMsg .= "Please enter the year of completion for your PSLE.<br>";
$success = false;
}
else
{
$pschool = sanitize_input($_POST["pschool"]);
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
    global $fname, $dob, $nationality , $nric , $email , $pwd , $mt , $gnric, $pschool , $add1 , $add2 , $contact , $agg , $pyear, $errorMsg ,$gnric , $gname  , $relate , $gadd1 , $gadd2, $occupy, $gcontact, $gnation;
    // Create connection
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    //Check connection
    if ($conn->connect_error)
    {$errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
    }
    else
    {
    $sql1 = "INSERT INTO student_info VALUES('$nric', '$fname', '$pwd','$email',$agg,'$dob',$pyear,'$mt','$nationality','$pschool','$add1','$add2','$contact')";
    $sql2 = "INSERT INTO guard_info VALUES('$gnric', '$nric','$gname','$gcontact','$relate','$gadd1','$gadd2','$occupy','$gnation')";
    
    echo $sql1."<br><br>";
    echo $sql2."<br><br>";
    
    // Execute the queryif (!$conn->query($sql))   
    if (!$conn->query($sql1))
    {
        $errorMsg = "Database error: " . $conn->error;
        $success = false;
        
    }   
    
    if (!$conn->query($sql2))
    {
        $errorMsg = "Database error: " . $conn->error;
        $success = false;
        
    }   
  }
  $conn->close();
}