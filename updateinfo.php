
    
    <?php
    include "header.inc.php";
    
    //check session ensure user must login
    if (empty($_SESSION["name"])) {
    $message = "Unauthorized access, please login or create account";
    echo "<script type='text/javascript'>alert('$message'); "
            . "window.location.href='http://localhost/2103project/login.php';</script>";
    }
    else if (empty($_SESSION["student_nric"])) {
    $message = "Unauthorized access, please login or create account";
    echo "<script type='text/javascript'>alert('$message'); "
        . "window.location.href='http://localhost/2103project/login.php';</script>";
    }

    
    ?>
    
<html>
    
    <body>

    <h1 class="text-center">Update personal information</h1>
    <div class="container">
    <form name="myForm" action="updateinfo.php"  novalidate onsubmit="return validateForm()" method="post">
      


   <?php     
    echo "<h3>Student Information </h3>";
    echo "Student Name: ". $_SESSION["name"] . "<br>";
    echo "Student NRIC: ". $_SESSION["student_nric"] . "<br>";
    echo "Current email: ".$_SESSION["student_email"]."<br>"; 
    ?>
        
    <h3>Update your information here </h3>    
    <div class="form-group">
    <label for="updatemail">Update Email:</label>
    <input type="text" class="form-control" id="updatemail" 
           placeholder= "Please enter new email" name="updatemail">
    </div>
    
    <div class="form-group">
    <label for="updatepw">Update Password:</label>
    <input type="text" class="form-control" id="updatepw" 
           placeholder="Please enter new password"name="updatepw">
    </div>
            
    <button type="submit" name="updateinfobutton" class="btn btn-default">Update</button>
    </form>
    </body>
    

</html>

<?php

    define("DBHOST", "localhost");
    define("DBNAME", "2103");
    define("DBUSER", "root");
    define("DBPASS", "");
        
if (isset($_POST["updatemail"]) && (isset($_POST["updatepw"])) && (isset($_POST["updateinfobutton"])) && ((!empty($_POST["updatemail"])) || (!empty($_POST["updatepw"]))) )
{

    $updatemail = $_POST["updatemail"];
    $updatepw = $_POST["updatepw"];
    $updateinfobutton = $_POST["updateinfobutton"];
    updateEmailPw();

    
    
}
elseif((empty($_POST["updatemail"])) || (empty($_POST["updatepw"]))){
    echo "please enter either email or password";
}
else
{
    
    echo"Remember to enter email or password in order to update";
}

    
function updateEmailPw(){
        
    global $updatemail,$updatepw,$updateinfobutton, $errorMsg, $success;
     $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
     // Check connection
     if ($conn->connect_error)
     {
         $errorMsg = "Connection failed: " . $conn->connect_error;
         $success = false;
     }
     else
     {
        
     if (isset($_POST["updatemail"]) && (isset($_POST["updatepw"])))
    {
     unset($_SESSION['student_email']); 
     $_SESSION['student_email'] = $updatemail;
//    unset($_SESSION["student_email"]);
    $sql = "update student_info 
            set password = $updatepw, email = '".$_SESSION["student_email"]."'
            where student_NRIC = '".$_SESSION["student_nric"]."' "; 
    // update student_info table password and student email field based on student_nric
    
    $result = $conn->query($sql);
//    echo '<script> window.location.reload(); </script>';
    
//    $sql1 = "SELECT email FROM student_info where student_NRIC = '".$_SESSION["student_nric"]."'";
//    $result1 = $conn->query($sql1);
//    if ($result1->num_rows > 0)
//        {
//            $row = $result1->fetch_assoc();
//            $_SESSION["student_email"] = $row["email"];
    if ($result) {
         
        echo "New password updated: $updatepw <br>";
        echo "New email updated: $updatemail";
        $message = "New password updated:". $updatepw." and New email updated: $updatemail";
            echo "<script type='text/javascript'>alert('$message'); "
            . "window.location.href='http://localhost/2103project/updateinfo.php';</script>";
    }
//        }
    else{
        echo"Please try again";
    }

        
    }
         }
    $conn->close();
}

    include "footer.inc.php";
    ?>
