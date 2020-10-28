<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Feedback Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/feedback.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
            include 'header.inc.php';

            define("DBHOST", "localhost");
            define("DBNAME", "travel_photo");
            define("DBUSER", "root");
            define("DBPASS", "");

            $success = true;
            $errorMsg = "";
            $email = "";

            if (empty($_POST["email"]) || empty($_POST["name"]) || empty($_POST["feedback"])) {
                    $errorMsg .= "You have some fields left blank, please fill the empty fields.";
                    $success = false;
                } 
            else {
                $email = sanitize_input($_POST["email"]);
                $name = $_POST["name"];                
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

                            $stmt = $conn->prepare("INSERT INTO feedback (name, email, type_of_feedback, feedback_text) VALUES (?, ?, ?, ?)");
                            $stmt->bind_param("ssss", $name, $email, $fbType, $fb);

                            $stmt->execute();
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
