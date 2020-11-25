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
     $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $cop_2019 = "SELECT cop2019.express, SI.school_name FROM school_cop_2019 cop2019 , school_info SI WHERE cop2019.school_id = SI.school_id ORDER BY cop2019.express DESC LIMIT 5";
    $result = $conn->query($cop_2019);
        $dataPoints = array();
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
            array_push($dataPoints,array("label"=> $row["school_name"], "y"=> $row["express"],"index"=> $row["express"]));       
        }

    } else {
      echo "0 results";
    }

    $cop_2020 = "SELECT cop2020.express, SI.school_name FROM school_cop_2020 cop2020 , school_info SI WHERE cop2020.school_id = SI.school_id ORDER BY cop2020.express DESC LIMIT 5";
    $result2020 = $conn->query($cop_2020);
        $dataPoints2020 = array();
    if ($result2020->num_rows > 0) {
      // output data of each row
      while($row2020 = $result2020->fetch_assoc()) {
            array_push($dataPoints2020,array("label"=> $row2020["school_name"], "y"=> $row2020["express"],"index"=> $row2020["express"]));       
        }

    } else {
      echo "0 results";
    }

    $improvedcop = "SELECT (cop2020.express- cop2019.express) AS COP, SI.school_name FROM school_cop_2019 cop2019, school_cop_2020 cop2020, school_info SI WHERE cop2019.school_id = SI.school_id AND cop2020.school_id = SI.school_id ORDER BY cop2020.express-cop2019.express DESC LIMIT 5";
    $improvedresult = $conn->query($improvedcop);
        $improveddataPoints = array();
    if ($improvedresult->num_rows > 0) {
      // output data of each row
      while($improvedrow = $improvedresult->fetch_assoc()) {
            array_push($improveddataPoints,array("label"=> $improvedrow["school_name"], "y"=> $improvedrow["COP"],"index"=> $improvedrow["COP"]));       
        }

    } else {
      echo "0 results";
    }

    $mostsubject = "SELECT count(SS.subject_desc) AS totalsub,SI.school_name FROM school_subject SS, school_info SI WHERE SS.school_id = SI.school_id AND SS.subject_desc NOT LIKE 'H1%' OR 'H2%' OR 'H3%' GROUP BY SI.school_name ORDER BY totalsub DESC LIMIT 5";
    $mostsubjectresult = $conn->query($mostsubject);
        $mostsubjectdataPoints = array();
    if ($mostsubjectresult->num_rows > 0) {
      // output data of each row
      while($mostsubjectrow = $mostsubjectresult->fetch_assoc()) {
            array_push($mostsubjectdataPoints,array("label"=> $mostsubjectrow["school_name"], "y"=> $mostsubjectrow["totalsub"],"index"=> $mostsubjectrow["totalsub"]));       
        }

    } else {
      echo "0 results";
    }



    $MostNumberOfCCA = "select si.school_name , count(*) As totalNoOfCCA
                    from school_info si, school_cca sc
                    where si.school_id = sc.school_id
                    group by school_name
                    having count(*) >1
                    order by count(*) desc
                    limit 5";
    $MostNumberOfCCAresult = $conn->query($MostNumberOfCCA);
        $MostNumberOfCCAarray = array();
    if ($MostNumberOfCCAresult->num_rows > 0) {
      // output data of each row
      while($MostNumberOfCCArow = $MostNumberOfCCAresult->fetch_assoc()) {
            array_push($MostNumberOfCCAarray,array("label"=> $MostNumberOfCCArow["school_name"], "y"=> $MostNumberOfCCArow["totalNoOfCCA"],"index"=> $MostNumberOfCCArow["totalNoOfCCA"]));       
        }

    } else {
      echo "0 results";
    }



    $SchoolinZone = "SELECT zone_code , count(*) as NoOfSchool
    FROM school_info
    group by zone_code
    having count(*) >1 ;";
    $SchoolinZoneResult = $conn->query($SchoolinZone);
        $SchoolinZoneArray = array();
    if ($SchoolinZoneResult->num_rows > 0) {
      // output data of each row
      while($SchoolinZonerow = $SchoolinZoneResult->fetch_assoc()) {
            array_push($SchoolinZoneArray,array("label"=> $SchoolinZonerow["zone_code"], "y"=> $SchoolinZonerow["NoOfSchool"],"index"=> $SchoolinZonerow["NoOfSchool"]));       
        }

    } else {
      echo "0 results";
    }


    
    $SchoolinArea = "SELECT dgp_code , count(*) as NoOfSchool
FROM school_info
group by dgp_code
having count(*) >1 
order by NoofSchool desc
limit 10;";
    $SchoolinAreaResult = $conn->query($SchoolinArea);
        $SchoolinAreaArray = array();
    if ($SchoolinAreaResult->num_rows > 0) {
      // output data of each row
      while($SchoolinArearow = $SchoolinAreaResult->fetch_assoc()) {
            array_push($SchoolinAreaArray,array("label"=> $SchoolinArearow["dgp_code"], "y"=> $SchoolinArearow["NoOfSchool"],"index"=> $SchoolinArearow["NoOfSchool"]));       
        }

    } else {
      echo "0 results";
    }
    
    
    
    
    
    
    $Ccagrouping = "SELECT cca_grouping , count(*) as NoOfCCA
    FROM school_cca
    group by cca_grouping
    having count(*) >1 
    order by NoOfCCA desc
    limit 10;";
    $CcagroupingResult = $conn->query($Ccagrouping);
        $CcagroupingArray = array();
    if ($CcagroupingResult->num_rows > 0) {
      // output data of each row
      while($Ccagroupingrow = $CcagroupingResult->fetch_assoc()) {
            array_push($CcagroupingArray,array("label"=> $Ccagroupingrow["cca_grouping"], "y"=> $Ccagroupingrow["NoOfCCA"],"index"=> $Ccagroupingrow["NoOfCCA"]));       
        }

    } else {
      echo "0 results";
    }

    $conn->close();





    ?>


    <html>

        <head>
            <meta charset="UTF-8">
        <script>
    function COP_2019 () {
    var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title:{
                    text: "Top 5 school in 2019"
            },
            axisY:{
                    includeZero: true
            },
            data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
    });
    chart.render();

    }

    function COP_2020 () {

    var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title:{
                    text: "Top 5 school in 2020"
            },
            axisY:{
                    includeZero: true
            },
            data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($dataPoints2020, JSON_NUMERIC_CHECK); ?>
            }]
    });
    chart.render();

    }

    function Improved_COP () {

    var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title:{
                    text: "Top 5 most improved cop school  from 2019 to 2020"
            },
            axisY:{
                    includeZero: true
            },
            data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($improveddataPoints, JSON_NUMERIC_CHECK); ?>
            }]
    });
    chart.render();

    }

    function Most_Subject () {

    var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title:{
                    text: "Top 5 most subject school"
            },
            axisY:{
                    includeZero: true
            },
            data: [{
                    click: onClick,
                    type: "column", //change type to bar, line, area, pie, etc
                    indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($mostsubjectdataPoints, JSON_NUMERIC_CHECK); ?>
            }]
    });
    chart.render();
            function onClick(e) {
                    alert(  e.dataSeries.type + ", dataPoint { x:" + e.dataPoint.x + ", y: "+ e.dataPoint.y + " }" );
            }
    }





    function MOST_CCA () {

    var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title:{
                    text: "Top 10 school provide the most CCA in 2020"
            },
            axisY:{
                    includeZero: true
            },
            data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($MostNumberOfCCAarray, JSON_NUMERIC_CHECK); ?>
            }]
    });
    chart.render();

    }




    function SchoolByZone () {
    var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title:{
                    text: "Total number of schools in each Zone"
            },
            axisY:{
                    includeZero: true
            },
            data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($SchoolinZoneArray, JSON_NUMERIC_CHECK); ?>
            }]
    });
    chart.render();

    }





function SchoolByArea() {
    var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title:{
                    text: "Total number of schools in each Area"
            },
            axisY:{
                    includeZero: true
            },
            data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($SchoolinAreaArray, JSON_NUMERIC_CHECK); ?>
            }]
    });
    chart.render();

    }
    
    
    
    
    
    
    
    function ccagrouping() {
    var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title:{
                    text: "Total number of CCAs for each category"
            },
            axisY:{
                    includeZero: true
            },
            data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($CcagroupingArray, JSON_NUMERIC_CHECK); ?>
            }]
    });
    chart.render();

    }

    </script>


        <body>
        <div class="container">
        <h2>Data Analysis</h2>
        <button onclick="COP_2019()"> Top 5 School in 2019</button>
        <button onclick="COP_2020()"> Top 5 School in  2020 </button>
        <button onclick="Improved_COP()"> Top 5 most improved COP school from 2019-2020 </button>
        <button onclick="Most_Subject()"> Most subjects offering </button>
        <button onclick="MOST_CCA()"> Most CCA offering </button>
        <button onclick="SchoolByZone()"> Total No.Of.School by Zone </button>
        <button onclick="SchoolByArea()"> Total No.Of.School by Area </button>
        <button onclick="ccagrouping()"> Total No.Of.CCAs based on category </button>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        </body>

        <?php
        // put your code here
        include "footer.inc.php";
        ?>
    </html>
