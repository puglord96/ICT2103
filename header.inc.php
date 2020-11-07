
<?php
session_start();
?>





<html>
    
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
        <script defer src="js/2103.js" type="text/javascript"></script>
        <script defer src="js/highest.js" type="text/javascript"></script>
    </head>
    
    <h1>*****</h1>
    <nav class="navbar navbar-inverse navbar-fixed-top" id="nav">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="index.php" class="home">Home</a></li>
                <li><a href="posting.php"class="posting">Posting</a></li>
                <li><a href="feedback.php"class="feedback">Feedback</a></li>
                <li><a href="DataAnalytics.php"class="datanalytics">Data Analytics</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="register.php"class="register"><span class="glyphicon glyphicon-pencil"></span> Sign-up</a></li>
                <li><a href="login.php"class="login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <li><a href="session_destroy.php"class="logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                
            </ul>
        </div> 
    </nav>
</html>