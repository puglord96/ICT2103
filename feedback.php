
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Feedback Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/feedback.css">
        <link href="css.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    

    <h1>*****</h1>
    
    <?php
    include "header.inc.php";
    ?>
    
    
    <body>

    <h1 class="text-center">Feedback page</h1>
    <div class="container">
    <form name="feedbackForm" method="post" action="process_feedback.php">
                        
    <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Your name..">
    </div>
                    
                    
    <div class="form-group">   
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email..." title="example: name@gmail.com" required pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$">
    </div>
                    
                    
                    
                    
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
    <input type="submit" value="Submit" class="btn btn-default">

    </form>
    </div>
            
    
    </body>
    
    <?php
    include "footer.inc.php";
    ?>

</html>