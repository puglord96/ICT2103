               <?php
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

$cop_2019 = "SELECT cop2019.express, SI.school_name FROM school_cop_2019 cop2019 , school_info SI WHERE cop2019.school_id = SI.school_id ORDER BY cop2019.express DESC LIMIT 10";
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

$cop_2020 = "SELECT cop2020.express, SI.school_name FROM school_cop_2020 cop2020 , school_info SI WHERE cop2020.school_id = SI.school_id ORDER BY cop2020.express DESC LIMIT 10";
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

$mostsubject = "SELECT count(SS.subject_desc) AS totalsub,SI.school_name FROM school_subject SS, school_info SI WHERE SS.school_id = SI.school_id AND SS.subject_desc NOT LIKE 'H1%' OR 'H2%' OR 'H3%' GROUP BY SI.school_name ORDER BY totalsub ASC LIMIT 10";
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




$conn->close();
echo "Connected successfully";




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
		text: "Top 5 most improved cop school  from 2019 to 2020"
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
</script>
        <title></title>
    </head>

        <head>
        <title>Jackson</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel= "stylesheet" href ="js/2103.js" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script defer src="js/2103.js" type="text/javascript"></script>
    </head>
  <h1 style="margin-top:-10px;">*****</h1>
    <body>
        <?php
        // put your code here
        include "header.inc.php";
        ?>


    <div class="container">
    <h2>Data Analysis</h2>
    <button onclick="COP_2019()"> Top 5 School in 2019</button>
    <button onclick="COP_2020()"> Top 5 School in  2020 </button>
        <button onclick="Improved_COP()"> Top 5 most improved COP school from 2019-2020 </button>
         <button onclick="Most_Subject()"> Most subjects offering </button>

 <div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    </body>

            <?php
        // put your code here
        include "footer.inc.php";
        ?>
</html>
