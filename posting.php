



<?php
include "header.inc.php";


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



function showStudentPrevSelection(){
      global $findschool_idarray, $errorMsg, $success;
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
        $sqlfindschool_id = "SELECT  school_id 
                            FROM school_posting sp, ranking r
                            where sp.posting_id =r.posting_id 
                            and student_NRIC = '".$_SESSION["student_nric"]."'";
        $findschool_idresult = $conn->query($sqlfindschool_id);
        while($row = mysqli_fetch_assoc($findschool_idresult)) {
            $findschool_idarray[] = $row['school_id']; 
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
    <input type="number" class="form-control" id="firstchoice" 
           placeholder="<?php showStudentPrevSelection(); echo "Previously submitted for First Choice:". $findschool_idarray[0];?>" name="firstchoice">
    </div>
    
    <div class="form-group">
    <label for="secondchoice">Second Choice:</label>
    <input type="number" class="form-control" id="secondchoice" 
           placeholder="<?php showStudentPrevSelection(); echo "Previously submitted for First Choice:". $findschool_idarray[1];?>"name="secondchoice">
    </div>
    
    <div class="form-group">
    <label for="thirdchoice">Third Choice:</label>
    <input type="number" class="form-control" id="thirdchoice" 
           placeholder="<?php showStudentPrevSelection(); echo "Previously submitted for First Choice:". $findschool_idarray[2];?>" name="thirdchoice">
    </div>
    
    
    <div class="form-group">
    <label for="fourthchoice">Fourth Choice:</label>
    <input type="number" class="form-control" id="fourthchoice" 
           placeholder="<?php showStudentPrevSelection(); echo "Previously submitted for First Choice:". $findschool_idarray[3];?>" name="fourthchoice">
    </div>
    
    
    <div class="form-group">
    <label for="fifthchoice">Fifth Choice:</label>
    <input type="number" class="form-control" id="fifthchoice" 
           placeholder = "<?php showStudentPrevSelection(); echo "Previously submitted for First Choice:". $findschool_idarray[4];?>" name="fifthchoice">
    </div>
    
    <div class="form-group">
    <label for="sixthchoice">Sixth Choice:</label>
    <input type="number" class="form-control" id="sixthchoice" 
           placeholder="<?php showStudentPrevSelection(); echo "Previously submitted for First Choice:". $findschool_idarray[5];?>" name="sixthchoice">
    </div>
    
    
      
    <button type="submit" value = "Submit now" name="submitbutton" class="btn btn-default">Submit</button>
    <button type="submit" value = "Update now" name="updatebutton" class="btn btn-default">Update</button>
  </form>
  
 
    </div>
        
         <form name="viewresult" action="posting.php"  novalidate onsubmit="return validateForm()" method="post">
      <button type="submit" value = "Submit now" name = "resultbutton" class="btn btn-default">Check Submission</button>
         </form>
    </body>


</html>



<?php



if (isset($_POST["firstchoice"]) && (isset($_POST["secondchoice"])) && (isset($_POST["thirdchoice"])) && (isset($_POST["fourthchoice"]))
         && (isset($_POST["fifthchoice"])) && (isset($_POST["sixthchoice"])) && (isset($_POST["submitbutton"]))) 
{

    $firstchoice = $_POST["firstchoice"];
    $secondchoice = $_POST["secondchoice"];
    $thirdchoice = $_POST["thirdchoice"];
    $fourthchoice = $_POST["fourthchoice"];
    $fifthchoice = $_POST["fifthchoice"];
    $sixthchoice = $_POST["sixthchoice"];
    $submitbutton = $_POST["submitbutton"];
    submitposting();
  
    
   
}  
 elseif (isset($_POST["resultbutton"])) {
     $resultbutton = $_POST["resultbutton"];
     viewresult();
    
}
elseif(isset($_POST["firstchoice"]) && (isset($_POST["secondchoice"])) && (isset($_POST["thirdchoice"])) && (isset($_POST["fourthchoice"]))
         && (isset($_POST["fifthchoice"])) && (isset($_POST["sixthchoice"])) && (isset($_POST["updatebutton"]))) 
{

    $firstchoice = $_POST["firstchoice"];
    $secondchoice = $_POST["secondchoice"];
    $thirdchoice = $_POST["thirdchoice"];
    $fourthchoice = $_POST["fourthchoice"];
    $fifthchoice = $_POST["fifthchoice"];
    $sixthchoice = $_POST["sixthchoice"];
    $updatebutton = $_POST["updatebutton"];
    updateposting();
  
    
   
}  



    function submitposting(){
        
        global $firstchoice,$secondchoice,$thirdchoice, $fourthchoice,$fifthchoice, $sixthchoice,$clientid,$errorMsg, 
                $success, $school_id, $school_name, $resultbutton;
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
            echo "You have already submitted <br>";

        }

        
        else {
        
        $sql = "select posting_id from student_info si , school_posting sp where si.student_nric = sp.student_nric and name = '".$_SESSION["name"]."'";
        
        $result = $conn->query($sql);
        $rs = mysqli_fetch_array($result);
        $clientid = $rs[0];
        
        $cars = array($firstchoice,$secondchoice,$thirdchoice,$fourthchoice,$fifthchoice,$sixthchoice);
        $unique_colors = array_unique($cars);
        $duplicates = count($cars) - count($unique_colors); //if result more than 1, means there is duplicate
        
        
        $sql = "SELECT school_id FROM school_info;";
        $schoolIDresult = $conn->query($sql);
         while($row = mysqli_fetch_assoc($schoolIDresult)) {
            $players[] = $row['school_id']; 
         }
        //print_r($players);

        $cmpresult = array_diff($cars,$players);
        //print_r(count($cmpresult));
        
        if ($duplicates<1 ){
            if (((count($cmpresult))==0)){
            
        $sql1 = "insert into ranking (school_id, posting_id, choice_number) VALUES($cars[0], $clientid, 1)";
        $sql2 = "insert into ranking (school_id, posting_id, choice_number) VALUES($cars[1], $clientid, 2)";
        $sql3 = "insert into ranking (school_id, posting_id, choice_number) VALUES($cars[2], $clientid, 3)";
        $sql4 = "insert into ranking (school_id, posting_id, choice_number) VALUES($cars[3], $clientid, 4)";
        $sql5 = "insert into ranking (school_id, posting_id, choice_number) VALUES($cars[4], $clientid, 5)";
        $sql6 = "insert into ranking (school_id, posting_id, choice_number) VALUES($cars[5], $clientid, 6)";
        
        if (($conn->query($sql1) && $conn->query($sql2) && $conn->query($sql3) && $conn->query($sql4) && $conn->query($sql5)
                && $conn->query($sql6))=== TRUE) 
        {
            $sql = "select choice_number, r.school_id, school_name 
                    from school_info s, ranking r
                    where s.school_id= r.school_id
                    and posting_id = $clientid
                    order by choice_number";
            
            $result = $conn->query($sql);
            if (!empty($result) && $result->num_rows > 0) {
        // output data of each row
                    echo '<br><br><br>';
                    echo '<h2><u>Your Selection for 6 chosen schools</u></H2>';


                    echo '<table class= "table">';
                    echo '<tr>';
                    echo'<th>Choice</th>
                        <th>School ID You Have Selected:</th>
                        <th>School Name</th>';
                    echo'</tr>';
                    while($row = $result->fetch_assoc())  {
                        echo '<tr>';
                        echo '  <td><b>' . $row["choice_number"] . '<b></td>';
                        echo '  <td><b>' . $row["school_id"] . '<b></td>';
                        echo '  <td><b>' . $row["school_name"] . '<b></td>';
                        echo '  </tr> ';                
                    }
                echo'</table>';
        }

          
          
          
        } 
        
        else 
        {
          $message = "One of your School ID is invalid, please try again!";
            echo "<script type='text/javascript'>alert('$message'); "
            . "window.location.href='http://localhost/2103project/posting.php';</script>";
            
        }   
         }
        
        else{
            $message = "Invalid School ID!";
            echo "<script type='text/javascript'>alert('$message'); "
            . "window.location.href='http://localhost/2103project/posting.php';</script>";
        }
        }
         else{
             $message = "Duplicate School ID";
            echo "<script type='text/javascript'>alert('$message'); "
            . "window.location.href='http://localhost/2103project/posting.php';</script>";
         }
        }
        }
        else{
             $message = "Please fill up all 6 slots";
            echo "<script type='text/javascript'>alert('$message'); "
            . "window.location.href='http://localhost/2103project/posting.php';</script>";
        }
        
    }
    $conn->close();
}




function viewresult(){
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
     if(isset($_POST["resultbutton"]))
    {
         
    $sql =  "select choice_number, r.school_id, school_name 
            from school_info s, ranking r
            where s.school_id= r.school_id
            and posting_id = ( SELECT posting_id FROM school_posting where student_name = '".$_SESSION["name"]."')
            order by choice_number
            ";    
    $result = $conn->query($sql);
    
    $result = $conn->query($sql);
            if (!empty($result) && $result->num_rows > 0) {
        // output data of each row
                    echo '<br><br><br>';
                    echo '<h2><u>Your Selection for 6 chosen schools</u></H2>';


                    echo '<table class= "table">';
                    echo '<tr>';
                    echo'<th>Choice</th>
                        <th>School ID You Have Selected:</th>
                        <th>School Name</th>';
                    echo'</tr>';
                    while($row = $result->fetch_assoc())  {
                        echo '<tr>';
                        echo '  <td><b>' . $row["choice_number"] . '<b></td>';
                        echo '  <td><b>' . $row["school_id"] . '<b></td>';
                        echo '  <td><b>' . $row["school_name"] . '<b></td>';
                        echo '  </tr> ';                
                    }
                echo'</table>';
        }
        else{
            $message = "Please fill up all 6 slots and submit a form in order to view submission!";
            echo "<script type='text/javascript'>alert('$message'); "
            . "window.location.href='http://localhost/2103project/posting.php';</script>";
        }
   

        
    }
         }
    $conn->close();
    
}



function updateposting(){
    global $firstchoice,$secondchoice,$thirdchoice, $fourthchoice,$fifthchoice, $sixthchoice,$clientid,$errorMsg, 
                $success, $school_id, $school_name, $resultbutton;
     $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
     // Check connection
     if ($conn->connect_error)
     {
         $errorMsg = "Connection failed: " . $conn->connect_error;
         $success = false;
     }
     else
    {
          if(isset($_POST["updatebutton"]))
            {
         
            $sql =  "SELECT posting_id FROM school_posting where student_NRIC = '".$_SESSION["student_nric"]."' ";    
            $result = $conn->query($sql);
            while($row = mysqli_fetch_assoc($result)) {
                    $posting_idForUpdate[] = $row['posting_id']; 
            }
        $cars = array($firstchoice,$secondchoice,$thirdchoice,$fourthchoice,$fifthchoice,$sixthchoice);
        $unique_colors = array_unique($cars);
        $duplicates = count($cars) - count($unique_colors); //if result more than 1, means there is duplicate
        
        
        $sql = "SELECT school_id FROM school_info;";
        $schoolIDresult = $conn->query($sql);
         while($row = mysqli_fetch_assoc($schoolIDresult)) {
            $players[] = $row['school_id']; 
         }
        //print_r($players);

        $cmpresult = array_diff($cars,$players);
        //print_r(count($cmpresult));
        
        if ($duplicates<1 ){
            if (((count($cmpresult))==0)){    
    
    $sql1 = "update ranking set school_id = $firstchoice where posting_id = $posting_idForUpdate[0] and choice_number = '1' ";
    $sql2 = "update ranking set school_id = $secondchoice where posting_id = $posting_idForUpdate[0] and choice_number = '2' ";
    $sql3 = "update ranking set school_id = $thirdchoice where posting_id = $posting_idForUpdate[0] and choice_number = '3' ";
    $sql4 = "update ranking set school_id = $fourthchoice where posting_id = $posting_idForUpdate[0] and choice_number = '4' ";
    $sql5 = "update ranking set school_id = $fifthchoice where posting_id = $posting_idForUpdate[0] and choice_number = '5' ";
    $sql6 = "update ranking set school_id = $sixthchoice where posting_id = $posting_idForUpdate[0] and choice_number = '6' ";

    if (($conn->query($sql1) && $conn->query($sql2) && $conn->query($sql3) && $conn->query($sql4) && $conn->query($sql5)
                && $conn->query($sql6))=== TRUE) 
        {
        $message = "All slots updated";
            echo "<script type='text/javascript'>alert('$message'); "
            . "window.location.href='http://localhost/2103project/posting.php';</script>";
        }
        
    }
    else{
            $message = "Invalid School ID!";
            echo "<script type='text/javascript'>alert('$message'); "
            . "window.location.href='http://localhost/2103project/posting.php';</script>";
        }
    }
        else{
             $message = "Duplicate School ID";
            echo "<script type='text/javascript'>alert('$message'); "
            . "window.location.href='http://localhost/2103project/posting.php';</script>";
         }
         
            }   
    }
}
        include "footer.inc.php";
        ?>