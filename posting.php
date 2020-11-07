



<?php
include "header.inc.php";
echo $_SESSION["name"];
echo $_SESSION["student_nric"];


define("DBHOST", "localhost");
define("DBNAME", "2103");
define("DBUSER", "root");
define("DBPASS", "");
saveMemberToDB();






function saveMemberToDB(){
    global $name, $nric, $errorMsg, $success;
    // Create connection
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    //Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    }
    else
    {
    $sql = "SELECT * FROM school_posting where student_nric = '".$_SESSION["student_nric"]."'";    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0){
      
    }
    else{
        $sql = "insert into school_posting (student_NRIC, student_Name) values('".$_SESSION["student_nric"]."', '".$_SESSION["name"]."')";
        $result = $conn->query($sql);
    }
    $sql1 = "select name, previous_primary_school, year_of_PSLE,  nationality, psle_agg 
            from student_info
            where name = '".$_SESSION["name"]."'";
    $result = $conn->query($sql1);
    
    if (!empty($result) && $result->num_rows > 0) {
        while($row = $result->fetch_assoc())  {
        $photo = "moe.png";
        echo  '<img src="images/MOE.png" alt="moe" class = "center"> ';
        echo '<section class="container"><hr>';
        echo '<h1>S1 OPTION FORM </h1>';
        echo '<h2>Students Particulars </h2>';
        echo '<p>Name of students: '.$row["name"].'</p>';
        echo '<p>Primary School:'.$row["previous_primary_school"].'</p>';
        echo '<p>Year of PSLE: '.$row["year_of_PSLE"].'</p>';
    //    echo "<p>PSLE Index No: </p>";
        echo '<p>Citizenship: '.$row["nationality"].'</p>';
        echo '<p>PSLE Aggregate: '.$row["psle_agg"].'</p>';
        
        
        
    }
    }
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
    <form name="myForm" action="posting.php"  novalidate onsubmit="return validateForm()" method="post">
      

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



<?php



if (isset($_POST["firstchoice"]) && (isset($_POST["secondchoice"])) && (isset($_POST["thirdchoice"])) && (isset($_POST["fourthchoice"]))
         && (isset($_POST["fifthchoice"])) && (isset($_POST["sixthchoice"]))) 
{

    $firstchoice= $_POST["firstchoice"];
    $secondchoice= $_POST["secondchoice"];
    $thirdchoice= $_POST["thirdchoice"];
    $fourthchoice= $_POST["fourthchoice"];
    $fifthchoice= $_POST["fifthchoice"];
    $sixthchoice= $_POST["sixthchoice"];
    submitposting();
    
    
   
}  
    
    function submitposting(){
        
        global $firstchoice,$secondchoice,$thirdchoice, $fourthchoice,$fifthchoice, $sixthchoice,$clientid,$errorMsg, $success;
         $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
         // Check connection
         if ($conn->connect_error)
         {
             $errorMsg = "Connection failed: " . $conn->connect_error;
             $success = false;
         }
         else
         {
         if(!empty($_POST["firstchoice"]) && (!empty($_POST["secondchoice"])) && (!empty($_POST["thirdchoice"]))
                 && (!empty($_POST["fourthchoice"]))
                 && (!empty($_POST["fifthchoice"]))
                 && (!empty($_POST["sixthchoice"])))
         
        {
             
        $sql = "select r.posting_id
                from ranking r, school_posting sp
                where r.posting_id = sp.posting_id 
                having posting_id = (select posting_id from school_posting where student_nric = '".$_SESSION["student_nric"]."') ;";    
        $result = $conn->query($sql);

        if ($result->num_rows > 0){
            echo "You have already submitted";
        }
        else {
        
        $sql = "select posting_id from student_info si , school_posting sp where si.student_nric = sp.student_nric and name = '".$_SESSION["name"]."'";
        $result = $conn->query($sql);
        
        $rs = mysqli_fetch_array($result);
        $clientid = $rs[0];
        
        $sql1 = "insert into ranking (school_id, posting_id, choice_number) VALUES($firstchoice, $clientid, 1)";
        $sql2 = "insert into ranking (school_id, posting_id, choice_number) VALUES($secondchoice, $clientid, 2)";
        $sql3 = "insert into ranking (school_id, posting_id, choice_number) VALUES($thirdchoice, $clientid, 3)";
        $sql4 = "insert into ranking (school_id, posting_id, choice_number) VALUES($fourthchoice, $clientid, 4)";
        $sql5 = "insert into ranking (school_id, posting_id, choice_number) VALUES($fifthchoice, $clientid, 5)";
        $sql6 = "insert into ranking (school_id, posting_id, choice_number) VALUES($sixthchoice, $clientid, 6)";
        
        if (($conn->query($sql1) && $conn->query($sql2) && $conn->query($sql3) && $conn->query($sql4) && $conn->query($sql5)
                && $conn->query($sql6))=== TRUE) 
        {
          echo "New record created successfully";
          echo $firstchoice;
          echo $secondchoice;
          echo $thirdchoice;
          echo $fourthchoice;
          echo $fifthchoice;
          echo $sixthchoice;
          
        } 
        
        else 
        {
          echo "Please no not submit again" . $conn->error;
        }   
         }
         
        }
        else{
            echo "Please fill up all 6 slots";
        }
        
    }
    $conn->close();
}
?>