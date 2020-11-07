
    
    <?php
    include "header.inc.php";
    ?>
    
    
    <body>

    <h1 class="text-center">Feedback page</h1>
    <div class="container">
    <form name="feedbackForm" method="post" action="process_feedback.php">
                        
    <div class="form-group">
    <label for="nric">NRIC</label>
    <input type="text" class="form-control" id="nric" name="nric" placeholder="Your NRIC..">
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