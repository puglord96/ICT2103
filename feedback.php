
    
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

    <h1 class="text-center">Feedback page</h1>
    <div class="container">
    <form name="feedbackForm" method="post" action="feedback.php">
        
                        
        <p>Name: <?php echo $_SESSION["name"]?></p>
        <p>Email: <?php echo $_SESSION["student_nric"]?></p>
        <p>Email: <?php echo $_SESSION["student_email"]?></p>

                    
    <div class="form-group">          
    <label for="fbType">Feedback Type</label>
    <select  class="form-control" id="fbType" name="fbType">
    <option value="general feedback">General feedback</option>
    <option value="bags">Bugs</option>
    <option value="question">Questions</option>
    </select>
    </div>
                 
                    
                    
    <div class="form-group">   
    <label for="feedback">Feedback</label>
    <textarea class="form-control" id="feedback" name="feedback" placeholder="Write feedback.." spellcheck="true"></textarea>
    </div>
    <input type="submit" value="Submit" name = "feedbackbutton" class="btn btn-default">

    </form>
    </div>
            
    
    </body>
    

</html>

<?php

    define("DBHOST", "localhost");
    define("DBNAME", "2103");
    define("DBUSER", "root");
    define("DBPASS", "");
        
if (isset($_POST["feedbackbutton"]) && (isset($_POST["fbType"])) && (!empty($_POST["feedback"])) )
{

    $feedbackbutton= $_POST["feedbackbutton"];
    $fbType= $_POST["fbType"];
    $feedback = $_POST["feedback"];
    postfeedback();
    
    
}
else
{
    
    echo"Remember to submit";
}

    
function postfeedback(){
        
    global $feedbackbutton,$fbType,$feedback, $errorMsg, $success;
     $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
     // Check connection
     if ($conn->connect_error)
     {
         $errorMsg = "Connection failed: " . $conn->connect_error;
         $success = false;
     }
     else
     {
     if(isset($_POST["feedbackbutton"]) && (isset($_POST["fbType"])) && (!empty($_POST["feedback"])))
    {

    $sql = "insert into feedback (student_NRIC, type_of_feedback, feedback_text)
            VALUES ('".$_SESSION["student_nric"]."', '$fbType', '$feedback')";   
    //insert into feedback table
    // with type of posting and the content of the feedback
    $result = $conn->query($sql);

    if ($result) {
        echo "You have already submitted: $feedback";
    }
    else{
        echo"Please try again";
    }

        
    }
         }
    $conn->close();
}

    include "footer.inc.php";
    ?>
