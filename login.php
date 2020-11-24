
<?php
    include "header.inc_nonuser.php";
    if (isset($_POST['submit'])) {
        $_SESSION['name'] = $_POST['name'];
    }
    ?>
<!--<style>
    .collapse navbar-collapse{
        display:none;
    }
</style>-->
    <body>
    <div class="container">
  <h2>Member Login</h2>
  <h4>For new members, please go to the sign-up page</h4>
  <form name="myForm" action="process_login.php"  novalidate onsubmit="return validateForm()" method="post">
      
      
    <div class="form-group">
      <label for="nric">NRIC:</label>
      <input type="nric" class="form-control" id="nric" placeholder="Enter NRIC" value="s9181818H" name="nric">
    </div>
      
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" value="123" name="pwd">
    </div>
      
    <button type="submit" value = "Submit now" class="btn btn-default">Submit</button>
  </form>
  
  
    </div>
    </body>
    
    
<?php
    include "footer.inc.php";
    ?>

</html>