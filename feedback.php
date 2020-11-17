
    
    <?php
    include "header.inc.php";
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
    
    echo"Remember to choose an area";
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
    $result = $conn->query($sql);

    if ($conn->query($sql) == true) {
        echo "You have already submitted";
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
