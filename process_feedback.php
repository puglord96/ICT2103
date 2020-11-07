    
        <?php
            include 'header.inc.php';
            echo $_SESSION["name"];
            echo $_SESSION["student_nric"];
            define("DBHOST", "localhost");
            define("DBNAME", "2103");
            define("DBUSER", "root");
            define("DBPASS", "");

            $success = true;
            $errorMsg = "";
            $email = "";

            if (empty($_POST["email"]) || empty($_POST["nric"]) || empty($_POST["feedback"])) {
                    $errorMsg .= "You have some fields left blank, please fill the empty fields.";
                    $success = false;
                } 
            else {
                $email = sanitize_input($_POST["email"]);
                $nric = $_POST["nric"];                
                $fbType = $_POST["fbType"];
                $fb = $_POST["feedback"];

                $emailpattern = "/[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$/";

                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $errorMsg .= "Invalid email format";
                    $success = false;
                }
                else if (preg_match($emailpattern, $email) == False) {
                    $errorMsg .= "Invalid email format";
                    $success = false;
                }
                else{
                    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
                    // Check connection
                    if ($conn->connect_error) {
                        $errorMsg = "Connection failed: " . $conn->connect_error;
                        $success = false;
                    }else{
                            
                            $email = mysqli_real_escape_string($conn, $email);
                            
                            $stmt1 = "SELECT student_NRIC FROM student_info where student_NRIC = '". $nric ."'";
                            $stmt2 = "SELECT guard_NRIC FROM guard_info where guard_NRIC = '". $nric ."'";
                            
                            $stmt1Res = $conn->query($stmt1);
                            $stmt2Res = $conn->query($stmt2);
                            
                            if($stmt1Res->num_rows > 0){
                                
                            $stmt = $conn->prepare("INSERT INTO feedback (student_NRIC, email, type_of_feedback, feedback_text) VALUES (?, ?, ?, ?)");
                            $stmt->bind_param("ssss", $nric, $email, $fbType, $fb);

                            $stmt->execute();
                            $stmt->free_result();
                            
                            }else if($stmt2Res->num_rows > 0){
                                
                            $stmt = $conn->prepare("INSERT INTO feedback (guard_NRIC, email, type_of_feedback, feedback_text) VALUES (?, ?, ?, ?)");
                            $stmt->bind_param("ssss", $nric, $email, $fbType, $fb);

                            $stmt->execute();
                            $stmt->free_result();
                            }else{
                                
                                $errorMsg .= "NRIC does not exist";
                                $success = false;
                            }

                            
                            $stmt1Res->free_result();
                            $stmt2Res->free_result();
                    }
                    $conn->close();
                }
            }
            if ($success) {
                echo "<script>alert('feedback submitted successfully!');window.location.href='index.php';</script>";
                echo "<a href='index.php'>Go to Main Page</a>";
            } else {
                echo "<h1>There was an issue!</h1>";
                echo "<h4>The following input errors were detected:</h4>";
                echo "<p>" . $errorMsg . "</p>";
                echo "<form action=\"feedback.php\" method=\"post\"><button type=\"submit\">Return to feedback</button></form>";
            }

        ?>
        
    </body>
    
</html>
<?php
        function sanitize_input($data)
        {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }


?>