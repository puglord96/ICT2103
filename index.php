
    <?php
    // put your code here    
    include "header.inc.php";
//    echo '<script>$window.location.reload();</script>';
    
        echo $_SESSION["name"];
        echo $_SESSION["student_nric"];
    ?>
    
        
        
   <?php
    
    define("DBHOST", "localhost");
    define("DBNAME", "2103");
    define("DBUSER", "root");
    define("DBPASS", "");
    
    
    $name = $prevschool = $nric = $pwd = $cpwd = $errorMsg = "";
    $success = true;


    if (empty($_POST["nric"]))
    {
    $errorMsg .= "NRIC is required.<br>";
    $success = false;
    }
    else
    {
    $nric = sanitize_input($_POST["nric"]);
    // Additional check to make sure e-mail address is well-formed.
    if (!filter_var($nric, FILTER_VALIDATE_EMAIL))
    {
    $errorMsg .= "Invalid email format.";
    $success = false;
    }
    }



    if (empty($_POST["pwd"]))
    {
    $errorMsg .= "Password is required.<br>";
    $success = false;
    }
    else
    {
    $pwd = sanitize_input($_POST["pwd"]);
    // Additional check to make sure e-mail address is well-formed.
    if (!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $pwd))
    {
    $errorMsg .= "Invalid password format.<br>";
    $success = false;
    }
    }

   
    //Helper function that checks input for malicious or unwanted content.
    function sanitize_input($data)
    {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
     
     
     
     function userlogin()
{
    global $name, $prevschool, $nric,$pwd, $errorMsg, $success;
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    }
    else
    {
        
        $sql = "SELECT * FROM student_info WHERE ";
        $sql .= "student_NRIC='$nric' AND password='$pwd'";
        // Execute the query
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $_SESSION["name"] = $row["name"];
            $_SESSION["student_nric"] = $row["student_NRIC"];
            $_SESSION["student_email"] = $row["email"];

        // Note that email field is unique, so should only have
        // one row in the result set.
            
          
            $name = $row["name"];
            $prevschool = $row["previous_primary_school"];
            $success = true;
            
        }
        else
        {
            $errorMsg = "NRIC not found or password doesn't match...!";
            $success = false;
        }
        $result->free_result();
    }
    $conn->close();
}






 if (isset($_POST["nric"]) && (isset($_POST["pwd"])))
    {
    userlogin();
    
    

    if ($success)   
    {
        
        echo '<section class="container"><hr>';
        echo "<h1>Login successful!</h1>";

        echo "<p>Welcome Back, " .$name ."</p>";

        echo "<p>Previous School: " . $prevschool ."</p>";
        echo $_SESSION["name"];
        echo $_SESSION["student_nric"];
        
    }
    else            
    {
        $message = "Username or password is incorrect";
        echo "<script type='text/javascript'>alert('$message'); window.location.href='http://localhost/2103project/login.php';</script>";

        
    }


    }
    

   ?>
<html>
      
    <div class="container">
    <h2>Search for School Information</h2>
    <h4>Information such as School name | Cut Off Points | Academic Stream</h4>
    <form name="myForm" action="index.php"  novalidate onsubmit="return validateForm()" method="post">
      
    <h3>Based PSLE Score Aggregate</h3>     
    <div class="form-group">      
    <label for="psleScore">Search by PSLE score:</label>
    <input type="number"  action="process_highest" class="form-control" id="psleScore" placeholder="Please Enter your PSLE Score" name="psleScore">
    <button id="searchHighest" >Search for highest school within cut off point</button>
    </div>
    </form>
    
    
    
    <div id = "myDIV"> 
    
    <br>
    <h3>Based on School Name</h3>   
    <form name="genderAreaform" action="index.php"  novalidate onsubmit="return validateForm()" method="post">
    <div class="form-group" >
    <label for="search">Search by School Name:</label>
    <input list ="search" name ="search" class="form-control" id="browsers" placeholder="Search for basic school details" >
    <datalist id="search">
    <?php 
        schoollist();

     ?>
<!--    <option value="ADMIRALTY SECONDARY SCHOOL">
    <option value="AHMAD IBRAHIM SECONDARY SCHOOL">
    <option value="ANDERSON SECONDARY SCHOOL">
    <option value="ANG MO KIO SECONDARY SCHOOL">
    <option value="ANGLICAN HIGH SCHOOL">
    <option value="ANGLO-CHINESE SCHOOL (BARKER ROAD)">
    <option value="ANGLO-CHINESE SCHOOL (INDEPENDENT) (Express)">
    <option value="ANGLO-CHINESE SCHOOL (INDEPENDENT) (IP)">
    <option value="ASSUMPTION ENGLISH SCHOOL">
    <option value="ASSUMPTION PATHWAY SCHOOL">
    <option value="BARTLEY SECONDARY SCHOOL">
    <option value="BEATTY SECONDARY SCHOOL">
    <option value="BEDOK GREEN SECONDARY SCHOOL">
    <option value="BEDOK SOUTH SECONDARY SCHOOL">
    <option value="BEDOK VIEW SECONDARY SCHOOL">
    <option value="BENDEMEER SECONDARY SCHOOL">
    <option value="BOON LAY SECONDARY SCHOOL">
    <option value="BOWEN SECONDARY SCHOOL">
    <option value="BROADRICK SECONDARY SCHOOL">
    <option value="BUKIT BATOK SECONDARY SCHOOL">
    <option value="BUKIT MERAH SECONDARY SCHOOL">
    <option value="BUKIT PANJANG GOVT. HIGH SCHOOL">
    <option value="BUKIT VIEW SECONDARY SCHOOL">
    <option value="CANBERRA SECONDARY SCHOOL">
    <option value="CATHOLIC HIGH SCHOOL (IP)">
    <option value="CATHOLIC HIGH SCHOOL (Special)">
    <option value="CEDAR GIRLS' SECONDARY SCHOOL (IP)">
    <option value="CEDAR GIRLS' SECONDARY SCHOOL (Express)">
    <option value="CHANGKAT CHANGI SECONDARY SCHOOL">
    <option value="CHIJ KATONG CONVENT (Secondary)">
    <option value="CHIJ SECONDARY (TOA PAYOH)">
    <option value="CHIJ ST. JOSEPH'S CONVENT">
    <option value="CHIJ ST. NICHOLAS GIRLS' SCHOOL (IP)">
    <option value="CHIJ ST. NICHOLAS GIRLS' SCHOOL (Special)">
    <option value="CHIJ ST. THERESA'S CONVENT">
    <option value="CHRIST CHURCH SECONDARY SCHOOL">
    <option value="CHUA CHU KANG SECONDARY SCHOOL">
    <option value="CHUNG CHENG HIGH SCHOOL (MAIN)">
    <option value="CHUNG CHENG HIGH SCHOOL (YISHUN)">
    <option value="CLEMENTI TOWN SECONDARY SCHOOL">
    <option value="COMMONWEALTH SECONDARY SCHOOL">
    <option value="COMPASSVALE SECONDARY SCHOOL">
    <option value="CRESCENT GIRLS' SCHOOL">
    <option value="CREST SECONDARY SCHOOL">
    <option value="DAMAI SECONDARY SCHOOL">
    <option value="DEYI SECONDARY SCHOOL">
    <option value="DUNEARN SECONDARY SCHOOL">
    <option value="DUNMAN HIGH SCHOOL">
    <option value="DUNMAN SECONDARY SCHOOL">
    <option value="EAST SPRING SECONDARY SCHOOL">
    <option value="EDGEFIELD SECONDARY SCHOOL">
    <option value="EVERGREEN SECONDARY SCHOOL">
    <option value="FAIRFIELD METHODIST SCHOOL (SECONDARY)">
    <option value="FAJAR SECONDARY SCHOOL">
    <option value="FUCHUN SECONDARY SCHOOL">
    <option value="FUHUA SECONDARY SCHOOL">
    <option value="GAN ENG SENG SCHOOL">
    <option value="GEYLANG METHODIST SCHOOL (SECONDARY)">
    <option value="GREENDALE SECONDARY SCHOOL">
    <option value="GREENRIDGE SECONDARY SCHOOL">
    <option value="GUANGYANG SECONDARY SCHOOL">
    <option value="HAI SING CATHOLIC SCHOOL">
    <option value="HILLGROVE SECONDARY SCHOOL">
    <option value="HOLY INNOCENTS' HIGH SCHOOL">
    <option value="HOUGANG SECONDARY SCHOOL">
    <option value="HUA YI SECONDARY SCHOOL">
    <option value="HWA CHONG INSTITUTION">
    <option value="JUNYUAN SECONDARY SCHOOL">
    <option value="JURONG SECONDARY SCHOOL">
    <option value="JURONG WEST SECONDARY SCHOOL">
    <option value="JURONGVILLE SECONDARY SCHOOL">
    <option value="JUYING SECONDARY SCHOOL">
    <option value="KENT RIDGE SECONDARY SCHOOL">
    <option value="KRANJI SECONDARY SCHOOL">
    <option value="KUO CHUAN PRESBYTERIAN SECONDARY SCHOOL">
    <option value="LOYANG VIEW SECONDARY SCHOOL">
    <option value="MANJUSRI SECONDARY SCHOOL">
    <option value="MARIS STELLA HIGH SCHOOL">
    <option value="MARSILING SECONDARY SCHOOL">
    <option value="MAYFLOWER SECONDARY SCHOOL">
    <option value="MERIDIAN SECONDARY SCHOOL">
    <option value="METHODIST GIRLS' SCHOOL (SECONDARY) (Express)">
    <option value="METHODIST GIRLS' SCHOOL (SECONDARY) (IP)">
    <option value="MONTFORT SECONDARY SCHOOL">
    <option value="NAN CHIAU HIGH SCHOOL">
    <option value="NAN HUA HIGH SCHOOL">
    <option value="NANYANG GIRLS' HIGH SCHOOL">
    <option value="NATIONAL JUNIOR COLLEGE">
    <option value="NAVAL BASE SECONDARY SCHOOL">
    <option value="NEW TOWN SECONDARY SCHOOL">
    <option value="NGEE ANN SECONDARY SCHOOL">
    <option value="NORTH VISTA SECONDARY SCHOOL">
    <option value="NORTHBROOKS SECONDARY SCHOOL">
    <option value="NORTHLAND SECONDARY SCHOOL">
    <option value="NUS HIGH SCHOOL OF MATHEMATICS AND SCIENCE">
    <option value="ORCHID PARK SECONDARY SCHOOL">
    <option value="OUTRAM SECONDARY SCHOOL">
    <option value="PASIR RIS CREST SECONDARY SCHOOL">
    <option value="PASIR RIS SECONDARY SCHOOL">
    <option value="PAYA LEBAR METHODIST GIRLS' SCHOOL (SECONDARY)">
    <option value="PEI HWA SECONDARY SCHOOL">
    <option value="PEICAI SECONDARY SCHOOL">
    <option value="PEIRCE SECONDARY SCHOOL">
    <option value="PING YI SECONDARY SCHOOL">
    <option value="PRESBYTERIAN HIGH SCHOOL">
    <option value="PUNGGOL SECONDARY SCHOOL">
    <option value="QUEENSTOWN SECONDARY SCHOOL">
    <option value="QUEENSWAY SECONDARY SCHOOL">
    <option value="RAFFLES GIRLS' SCHOOL (SECONDARY)">
    <option value="RAFFLES INSTITUTION">
    <option value="REGENT SECONDARY SCHOOL">
    <option value="RIVER VALLEY HIGH SCHOOL">
    <option value="RIVERSIDE SECONDARY SCHOOL">
    <option value="SCHOOL OF SCIENCE AND TECHNOLOGY, SINGAPORE">
    <option value="SCHOOL OF THE ARTS, SINGAPORE">
    <option value="SEMBAWANG SECONDARY SCHOOL">
    <option value="SENG KANG SECONDARY SCHOOL">
    <option value="SERANGOON GARDEN SECONDARY SCHOOL">
    <option value="SERANGOON SECONDARY SCHOOL">
    <option value="SINGAPORE CHINESE GIRLS' SCHOOL (Express)">
    <option value="SINGAPORE CHINESE GIRLS' SCHOOL (IP)">
    <option value="SINGAPORE SPORTS SCHOOL">
    <option value="SPECTRA SECONDARY SCHOOL">
    <option value="SPRINGFIELD SECONDARY SCHOOL">
    <option value="ST. ANDREW'S SECONDARY SCHOOL">
    <option value="ST. ANTHONY'S CANOSSIAN SECONDARY SCHOOL">
    <option value="ST. GABRIEL'S SECONDARY SCHOOL">
    <option value="ST. HILDA'S SECONDARY SCHOOL">
    <option value="ST. JOSEPH'S INSTITUTION (Express)">
    <option value="ST. JOSEPH'S INSTITUTION (IP)">
    <option value="ST. MARGARET'S SECONDARY SCHOOL">
    <option value="ST. PATRICK'S SCHOOL">
    <option value="SWISS COTTAGE SECONDARY SCHOOL">
    <option value="TAMPINES SECONDARY SCHOOL">
    <option value="TANGLIN SECONDARY SCHOOL">
    <option value="TANJONG KATONG GIRLS' SCHOOL">
    <option value="TANJONG KATONG SECONDARY SCHOOL">
    <option value="TECK WHYE SECONDARY SCHOOL">
    <option value="TEMASEK JUNIOR COLLEGE">
    <option value="TEMASEK SECONDARY SCHOOL">
    <option value="UNITY SECONDARY SCHOOL">
    <option value="VICTORIA SCHOOL (Express)">
    <option value="VICTORIA SCHOOL (IP)">
    <option value="WEST SPRING SECONDARY SCHOOL">
    <option value="WESTWOOD SECONDARY SCHOOL">
    <option value="WHITLEY SECONDARY SCHOOL">
    <option value="WOODGROVE SECONDARY SCHOOL">
    <option value="WOODLANDS RING SECONDARY SCHOOL">
    <option value="WOODLANDS SECONDARY SCHOOL">
    <option value="XINMIN SECONDARY SCHOOL">
    <option value="YIO CHU KANG SECONDARY SCHOOL">
    <option value="YISHUN SECONDARY SCHOOL">
    <option value="YISHUN TOWN SECONDARY SCHOOL">
    <option value="YUAN CHING SECONDARY SCHOOL">
    <option value="YUHUA SECONDARY SCHOOL">
    <option value="YUSOF ISHAK SECONDARY SCHOOL">
    <option value="YUYING SECONDARY SCHOOL">
    <option value="ZHENGHUA SECONDARY SCHOOL">
    <option value="ZHONGHUA SECONDARY SCHOOL">-->

    </datalist>
    </div>
    
    
    <h3>Based on Type of school & Area</h3>    
    <div class="form-group">
    <label for ="area" >Area:</label>
    <input type="checkbox" id="North" name="area[]" value="North"><label for="North"> North</label>    
    <input type="checkbox" id="South" name="area[]" value="South"><label for="South"> South</label>
    <input type="checkbox" id="East" name="area[]" value="East"><label for="East"> East</label>
    <input type="checkbox" id="West" name="area[]" value="West"><label for="West"> West</label>

    </select>
    </div>
    
    
    
  
    <div class="form-group">
    <label for ="schoolgender" >Please select school gender type:</label>
    
    <input type="radio" id="boysch" name="schoolgender" value="BOYS'' SCHOOL">
    <label for="boysch">boy school</label>
    
    <input type="radio" id="girlsch" name="schoolgender" value="GIRLS'' SCHOOL">
    <label for="girlsch">girl school</label>
    
    <input type="radio" id="cosch" name="schoolgender" value="CO-ED SCHOOL">
    <label for="cosch">CO-ED school</label><br>
    </div>
        
        
    <div class="form-group">
    <label for="NoOfSchool">Choose number of schools:</label>
    <select name="NoOfSchool" id="NoOfSchool">
    <option value="15">15</option>
    <option value="30">30</option>
    <option value="45">45</option>
    <option value="60">60</option>
    <option value="75">75</option>
    <option value="90">90</option>
    
    </select>
    </div>
    
    
    <input type="submit" value = "Search based on School name or Type of School & Area" name= "indexbutton" class="btn btn-default">     
    </form>
    
    
        
        
        
        
    <br>
    <br>
    
   

    <div class="form-group">
    <h3>Based on Transport</h3>
    <label for="mrt">Search by MRT Station:</label>
    <form name="transportform" action="index.php"  novalidate onsubmit="return validateForm()" method="post">
    <input type ="text" name ="mrt" class="form-control" id="mrt" placeholder="Search school by MRT" >
    <div class="form-group">
    <label for="bus">Search by Bus Numbers:</label>
    <input type ="text" name ="bus" class="form-control" id="bus" placeholder="Search school by Bus" >
    </div>
    <input type="submit" value = "Search school by Transportation MRT or BUS" name= "transportbutton" class="btn btn-default">   
    <br>
    </form>

    </div>
    
    
    
    <br>
    
    <div class="form-group">
    <h3>Based on CCA</h3>
    <label for="schoolnamecca">Search by School Name:</label>
    <form name="schoolnamecca" action="index.php"  novalidate onsubmit="return validateForm()" method="post">
    <input list ="search" name ="schoolnamecca" class="form-control" id="browsers" placeholder="Search for basic school details" >
    <datalist id="search">
    <?php 
        schoollist();

     ?>
    </datalist>
    
    <label for="typeofcca">Type of CCA:</label>
    <select name="typeofcca" id="typeofcca">
    <option value="'VISUAL AND PERFORMING ARTS'">VISUAL AND PERFORMING ARTS</option>
    <option value="UNIFORMED GROUPS">UNIFORMED GROUPS   </option>
    <option value="PHYSICAL SPORTS">PHYSICAL SPORTS</option>
    <option value="CLUBS AND SOCIETIES">CLUBS AND SOCIETIES</option>
    <option value="OTHERS">OTHERS</option>
    
    </select>
    <br>
    <input type="submit" value = "Search school by CCA" name= "ccabutton" class="btn btn-default"> 
    </form>
    </div>
      
    
    

    
    
    </div>  <!-- do not delete this -->
    
    
    
    
    
    
    
    <button onclick="myFunction()">Advanced Search</button>
    <br><br><br><br><br><br>
    
    
    <h2>Fast Search Based on Academic Stream COP</h2>
    <form name="fastsearchform" action="index.php"  novalidate onsubmit="return validateForm()" method="post">
    <div class="form-group">
        <p>Please select Stream:</p>
    
    <input type="radio" id="Express" name="stream" value="Express">
    <label for="Express">Express</label><br>
    
    <input type="radio" id="NA" name="stream" value="NA">
    <label for="NA">Normal Academic</label><br>
    
    <input type="radio" id="NT" name="stream" value="NT">
    <label for="NT">Normal Technical</label>
    </div>
        
        
        
    <div class="form-group">
    <label for="NoOfSchool_cop">Choose number of schools:</label>
    <select name="NoOfSchool_cop" id="NoOfSchool_cop">
    <option value="20">20</option>
    <option value="40">40</option>
    <option value="60">60</option>
    <option value="80">80</option>
    <option value="100">100</option>
    <option value="120">120</option>
    
    </select>
    </div>
        
        
    <div class="form-group">
    <p>Please select order:</p>
    
    <input type="radio" id="asc" name="order" value="asc">
    <label for="asc">Ascending Order Based on Latest COP</label><br>
    
    <input type="radio" id="desc" name="order" value="desc">
    <label for="desc">Descending Order Based on Latest COP</label><br>
    </div>
    <input type="submit" value = "Search for Stream" name= "streambutton" class="btn btn-default">
    </form>


    <div id="form-table"></div>
    </body>
    
 
</html>

<?php




if (isset($_POST["indexbutton"]) && (isset($_POST["area"])) && (isset($_POST["schoolgender"])) && (isset($_POST["NoOfSchool"]))) 
{

    $area= $_POST["area"];
    $schoolgender= $_POST["schoolgender"];
    $NoOfSchool = $_POST["NoOfSchool"];
    foreach($area as $areas){
         echo "area selected: $areas<br>";
    }
    echo "school gender selected: $schoolgender<br>";
    echo "no.of.school selected: $NoOfSchool<br>";
    searchSchGenderbyArea();
}
elseif(isset($_POST["indexbutton"]) && isset($_POST["search"]) && isset($_POST["NoOfSchool"])) 
{
    $search = $_POST["search"];
    $NoOfSchool = $_POST["NoOfSchool"];
    search();
}
elseif(isset($_POST["streambutton"]) && isset($_POST["stream"]) && isset($_POST["NoOfSchool_cop"]) && isset($_POST["order"]) )
{
    $streambutton = $_POST["streambutton"];
    $stream = $_POST["stream"];
    $NoOfSchool_cop = $_POST["NoOfSchool_cop"];
    $order = $_POST["order"];
    cop();
    
}
elseif (isset($_POST["transportbutton"]) && isset($_POST["mrt"]) && isset($_POST["bus"])){
    $transportbutton = $_POST["transportbutton"];
    $mrt = $_POST["mrt"];
    $bus= $_POST["bus"];
    transport();
}


elseif (isset($_POST["ccabutton"]) && isset($_POST["schoolnamecca"]) && isset($_POST["typeofcca"])){
    $ccabutton = $_POST["ccabutton"];
    $schoolnamecca = $_POST["schoolnamecca"];
    $typeofcca= $_POST["typeofcca"];
    
    cca();
    
}
else
{
    
    echo"Remember to choose an area";
}

//schoollist(); //run schoollist function whenever page loaded

function searchSchGenderbyArea()
{
    global $area,$schoolgender,$NoOfSchool, $url_address,$mrt, $bus,$errorMsg, $success;
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    }
    else
    {
    if(isset($_POST["area"]) && (isset($_POST["schoolgender"])) && (isset($_POST["NoOfSchool"]))){
        for ($i=0; $i<sizeof ($area);$i++) {  
            $sql = "Create view SchoolGenderView AS select school_id, school_name, url_address,mrt,bus, zone_code, school_gender_code 
                    from school_info";
            
            
            $sql = " select *
                     from SchoolGenderView 
                     where zone_code = ('".$area[$i]. "') 
                     and school_gender_code = '$schoolgender'
                     limit $NoOfSchool";
    
        
        // Execute the query
        $result = $conn->query($sql);
        if (!empty($result) && $result->num_rows > 0) {
        // output data of each row
                    echo '<br><br><br>';
                    echo '<h2><u>RESULT FROM SEARCH BY GENDER</u></H2>';
                    echo '<h3>Area: '.$area[$i].'<br>Gender Selected: ' ."$schoolgender".'<br>Filter by: ' ."$NoOfSchool" . '</h3>';

                    echo '<br><br><br>';
                    echo '<table class= "table">';
                    echo '<tr>';
                    echo'<th>School ID</th>
                        <th>School Name</th>
                        <th>School URL1</th>
                        <th>MRT</th>
                        <th>BUS</th>';
                    echo'</tr>';
                    while($row = $result->fetch_assoc())  {
                        echo '<tr>';
                        echo '  <td><b>' . $row["school_id"] . '<b></td>';
                        echo '  <td><b>' . $row["school_name"] . '<b></td>';
                        echo "<td><u><a href='" . $row["url_address"] .  "'><u>$row[url_address]</td>";
                        echo '  <td><b>' . $row["mrt"] . '<b></td>';
                        echo '  <td><b>' . $row["bus"] . '<b></td>';
                        echo '  </tr> ';                
                    }
                echo'</table>';
        }
        }
    }
    
        else
        {
            $errorMsg = "Please select area, gender, and number of school";
            $success = false;
        }
//        $result->free_result();
    }
    
    
   
    $conn->close();
}







function search(){
    global $search,$NoOfSchool, $errorMsg, $success;
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    }
    else
    {

    if ((isset($_POST["search"])) &&  (isset($_POST["NoOfSchool"])) && (!empty($_POST["search"])))
        {
        
            $sql = "create view BasicSchoolDetails AS SELECT school_id, school_name, url_address, address, postal_code, contact, email, mrt, bus
                    from school_info";
                    
                    
            $sql = "SELECT * from BasicSchoolDetails where school_name like '%$search%' limit $NoOfSchool";
            $result = $conn->query($sql);
                    if (!empty($result) && $result->num_rows > 0) {
        // output data of each row
                    echo '<table class = "table">';
                    echo '<br><br><br><br>';
                    echo '<h3><u>RESULT FROM SEARCH BY SCHOOL NAME</u></H3>';
                    echo '<tr>';
                    echo'<th>School ID</th>
                        <th>School Name</th>
                        <th>School URL2s</th>
                        <th>Address</th>
                        <th>Postal_code</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>MRT</th>
                        <th>Bus</th>';
                 
                    echo'<tr>';
                    while($row = $result->fetch_assoc())  {
                        echo '<tr>';
                        echo '  <td><b>' . $row["school_id"] . '<b></td>';
                        echo '  <td><b>' . $row["school_name"] . '<b></td>';
                        echo "<td><u><a href='" . $row['url_address'] .  "'>Website</a><u></td>";
                        echo '  <td><b>' . $row["address"] . '<b></td>';
                        echo '  <td><b>' . $row["postal_code"] . '<b></td>';
                        echo '  <td><b>' . $row["contact"] . '<b></td>';
                        echo '  <td><b>' . $row["email"] . '<b></td>';
                        echo '  <td><b>' . $row["mrt"] . '<b></td>';
                        echo '  <td><b>' . $row["bus"] . '<b></td>';
                        echo '  </tr> ';                
                    }
                echo'</table>';
        }
        
                    }
        
        else
        {
            $errorMsg = "Please enter the name of the school you wish to find";
            $success = false;
        }
        $conn->close();
        
}
}



function cop()
{
    global $streambutton,$stream,$NoOfSchool_cop,$school_cop_2019_, $school_cop_2020_,$difference, $order, $errorMsg, $success;
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    }
    else
    {
    if(isset($_POST["streambutton"]) && isset($_POST["stream"]) && isset($_POST["NoOfSchool_cop"]) && isset($_POST["order"])){
        
            
        $sql = "select school_info.school_id, school_name, 
                school_cop_2020.$stream AS '2020-cop' , 
                school_cop_2019.$stream AS '2019-cop',
                (school_cop_2020.$stream -  school_cop_2019.$stream) as difference
                from school_info
                inner join school_cop_2020 ON school_info.school_id = school_cop_2020.school_id 
                inner join school_cop_2019 ON school_info.school_id = school_cop_2019.school_id
                and school_cop_2019.$stream  is not null and school_cop_2020.$stream is not null
                order by school_cop_2020.$stream $order
                limit $NoOfSchool_cop;";
                
        // Execute the query
        $result = $conn->query($sql);
        if (!empty($result) && $result->num_rows > 0) {
        // output data of each row
                    echo '<br><br><br>';
                    echo '<h2><u>RESULT FROM FAST SEARCH</u></H2>';
                    echo '<br><br><br>';
                    echo '<h3>You have selected:' ."$stream". '</h3>';
                    echo '<table class="table table-bordered">';
                    echo '<tr>';
                    echo'<th>School ID</th>
                        <th>School Name</th>
                        <th>COP-2020</th>
                        <th>COP-2019</th>
                        <th>Difference in COP</th>';
                    echo'<tr>';
                    while($row = $result->fetch_assoc())  {
                        echo '<tr>';
                        echo '  <td><b>' . $row["school_id"] . '<b></td>';
                        echo '  <td><b>' . $row["school_name"] . '<b></td>';
                        echo '  <td><b>' . $row["2020-cop"] .  '<b></td>';
                        echo '  <td><b>' . $row["2019-cop"] .  '<b></td>';
                        echo '  <td><b>' . $row["difference"] .  '<b></td>';
                        echo '  </tr> ';                
                    }
                echo'</table>';
        }
        
    }
    
        else
        {
            $errorMsg = "Please select the stream and the number of school!";
            $success = false;
        }
//        $result->free_result();
    }
    
    
   
    $conn->close();
    
}




function transport()
{
    global $transportbutton,$mrt,$bus,$errorMsg, $success;
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    }
    else
    {
    if(isset($_POST["transportbutton"]) && (isset($_POST["mrt"])) && (isset($_POST["bus"])) && (!empty($_POST["mrt"])) ||    (!empty($_POST["bus"]))){
            $sql = "create view transportView AS select school_id, school_name, mrt, bus from school_info";
        
        
            $sql = "select * from transportView
                    where mrt like '%$mrt%'
                    union 
                    select * from transportView
                    where mrt like '%$bus%'";
    
        
        // Execute the query
        $result = $conn->query($sql);
        if (!empty($result) && $result->num_rows > 0) {
        // output data of each row
                    echo '<br><br><br>';
                    echo '<h2><u>RESULT FROM MRT and BUS</u></H2>';
                    echo '<h3>MRT Selected:' .$mrt. ' <br>Bus Selected: '. $bus .'</h3>';

                    echo '<br><br><br>';
                    echo '<table class= "table">';
                    echo '<tr>';
                    echo'<th>School ID</th>
                        <th>School Name</th>
                        <th>School mrt</th>
                        <th>bus</th>';
                    echo'</tr>';
                    while($row = $result->fetch_assoc())  {
                        echo '<tr>';
                        echo '  <td><b>' . $row["school_id"] . '<b></td>';
                        echo '  <td><b>' . $row["school_name"] . '<b></td>';
                        echo '  <td><b>' . $row["mrt"] . '<b></td>';
                        echo '  <td><b>' . $row["bus"] . '<b></td>';
                        echo '  </tr> ';                
                    }
                echo'</table>';
        }
        
    }
    
        else
        {
            $errorMsg = "Please select area, gender, and number of school";
            $success = false;
        }
//        $result->free_result();
    }
    
    
   
    $conn->close();
}

global $sentToList;

function schoollist()
{
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    }
    else
    {
    
            $sql = "SELECT school_name FROM school_info order by school_name;";

    
        
        // Execute the query
        $result = $conn->query($sql);
        if (!empty($result) && $result->num_rows > 0) {
        // output data of each row
                    while($row = $result->fetch_assoc())  {
                        $sentToList = array();
                        $sentToList[] = $row['school_name']; 
                        $i = 0;
                        //echo $sentToList[$i];
                        echo '<option value=\'' .$sentToList[$i].'\'>';
                        $i ++;
                        
                    }
 
        }

        else
        {
            $errorMsg = "Please select area, gender, and number of school";
            $success = false;
        }
//        $result->free_result();
    }
    
    
   
    $conn->close();
}


function cca(){
    
    
    global $ccabutton,$schoolnamecca,$typeofcca,$errorMsg, $success;
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    }
    else
    {
    if(isset($_POST["ccabutton"]) && (isset($_POST["schoolnamecca"])) && (isset($_POST["typeofcca"])) && (!empty($_POST["schoolnamecca"])))
    {
        
        
            $sql = "select sc.cca_name
                    from school_cca sc
                    where exists 
                    (select si.school_id from school_info si where sc.school_id = si.school_id and si.school_name like '%$schoolnamecca%')
                    and 
                    (select si.school_id from school_info si where sc.school_id = si.school_id and sc.cca_grouping = '$typeofcca')";
    
        
        // Execute the query
        $result = $conn->query($sql);
        if (!empty($result) && $result->num_rows > 0) {
        // output data of each row
                    echo '<br><br><br>';
                    echo '<h2><u>RESULT FROM CCA</u></H2>';
                    echo '<h3>School Selected:' .$schoolnamecca. ' <br>Type of CCA Selected: '. $typeofcca .'</h3>';

                    echo '<br><br><br>';
                    echo '<table class= "table">';
                    echo '<tr>';
                    echo'<th>CCA Available</th>';
                    echo'</tr>';
                    while($row = $result->fetch_assoc())  {
                        echo '<tr>';
                        echo '  <td>' . $row["cca_name"] . '</td>';
                        echo '  </tr> ';                
                    }
                echo'</table>';
        }
        else {
            echo "<script type='text/javascript'>alert('CCA is not available');</script>";
        }
        
    }
    
        else
        {
            $errorMsg = "Please select area, gender, and number of school";
            $success = false;
        }
//        $result->free_result();
    }
    
    
   
    $conn->close();
    
    
}


?>








    <?php
    // put your code here
    include "footer.inc.php";
    ?>  