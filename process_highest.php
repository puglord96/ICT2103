
<?php

    define("DBHOST", "localhost");
    define("DBNAME", "2103");
    define("DBUSER", "root");
    define("DBPASS", "");

//            include 'header.inc.php';

    $success = true;
    $errorMsg = "";
    $minExpress = $minNa = "";
    $stream = "";
    $highestSchInfTbl = '';
    $schoolIDs = '';
    $schoolInfoSql = $schoolInfoRes =  '';
    $cop = array();

    if (empty($_POST["psleScore"])) {
            $errorMsg .= "you need to fill up PSLE Score";
            $success = false;
        } 
    else {
            $psle = sanitize_input($_POST["psleScore"]);


            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
            // Check connection
            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
            }else{
                    $psle = mysqli_real_escape_string($conn, $psle);

                    $minExpressResult = $conn->query("SELECT MIN(express) FROM school_cop_2019 where express > 0"); //gets the minimum cut off point for 
                    $minNaResult = $conn->query("SELECT MIN(na) FROM school_cop_2019 where na > 0");

                    if($minExpressResult->num_rows > 0){
                        $rowMinExpress = $minExpressResult->fetch_assoc();
                        $minExpress = $rowMinExpress["MIN(express)"];
                    }else if($minExpressResult->num_rows == 0){
                        echo" there is no value in express min <br>";
                    }

                    if($minNaResult->num_rows > 0){
                        $rowMinNa = $minNaResult->fetch_assoc();
                        $minNa = $rowMinNa["MIN(na)"];
                    }else if($minNaResult->num_rows == 0){
                            echo" there is no value in na min <br>";
                    }

                    $minExpressResult->free_result();
                    $minNaResult->free_result();



    //-----------------------------------------------------------------------------------------------------------------------express
                    if(($psle >= $minExpress) && ($minExpress != NULL)){
                        echo '<h3>YOU ARE ELIGIBLE FOR: Express Stream</h3>';
                        $stream = "express";
                        echo "<br>";
                        $expsql = $conn->query("SELECT school_id,express FROM school_cop_2019 WHERE express = (SELECT MAX(express) FROM school_cop_2019 WHERE ('$psle' >= express) AND express != 0 )"
                        ."UNION SELECT school_id,express_affiliated FROM school_cop_2019 WHERE express_affiliated = (SELECT MAX(express_affiliated) FROM school_cop_2019 WHERE ('$psle' >= express_affiliated) AND express_affiliated != 0 )");
                        while($row = mysqli_fetch_array($expsql))
                        {
                            $schoolIDs .= $row['school_id'] . ',';
                            array_push($cop,$row['express']);
                        }

                        $schoolIDs = rtrim($schoolIDs, ",");
                        $schoolInfoSql = "SELECT * FROM school_info where school_id in (". $schoolIDs .")";
                        $schoolInfoRes = $conn->query($schoolInfoSql);


                        $highestSchInfTbl = create_table($schoolInfoRes,$cop);
                        $expsql->free_result();
                        $schoolInfoRes->free_result();

    //-----------------------------------------------------------------------------------------------------------------------na
                    }else if(($psle >= $minNa) && ($minNa != NULL)){
                        echo '<h3>YOU ARE ELIGIBLE FOR: NA</h3>';
                        $stream = "na";
                        $nasql = $conn->query("SELECT school_id,na FROM school_cop_2019 WHERE na = (SELECT MAX(na) FROM school_cop_2019 WHERE ('$psle' >= na) AND (na!= 0) )"
                        ."UNION SELECT school_id,na_affiliated FROM school_cop_2019 WHERE na_affiliated = (SELECT MAX(na_affiliated) FROM school_cop_2019 WHERE ('$psle' >= na_affiliated) AND (na_affiliated != 0) )");
                        while($row = mysqli_fetch_array($nasql))
                        {
                            $schoolIDs .= $row['school_id'] . ',';
                            array_push($cop,$row['na']);
                        }

                        $schoolIDs = rtrim($schoolIDs, ",");
                        $schoolInfoSql = "SELECT * FROM school_info where school_id in (". $schoolIDs .")";
                        $schoolInfoRes = $conn->query($schoolInfoSql);


                        $highestSchInfTbl = create_table($schoolInfoRes,$cop);
                        $nasql->free_result();
                        $schoolInfoRes->free_result();

    //-----------------------------------------------------------------------------------------------------------------------nt
                    } else {
                        echo '<h3>YOU ARE ELIGIBLE FOR: NT</h3>';
                        $stream = "nt";
                        $ntsql = $conn->query("SELECT school_id,nt FROM school_cop_2019 WHERE nt = (SELECT MAX(nt) FROM school_cop_2019 WHERE '$psle' >= nt )"
                        ."UNION SELECT school_id,nt_affiliated FROM school_cop_2019 WHERE nt_affiliated = (SELECT MAX(nt_affiliated) FROM school_cop_2019 WHERE '$psle' >= nt_affiliated )");
                        while($row = mysqli_fetch_array($ntsql))
                        {
                            $schoolIDs .= $row['school_id'] . ',';
                            array_push($cop,$row['nt']);
                        }

                        $schoolIDs = rtrim($schoolIDs, ",");
                        $schoolInfoSql = "SELECT * FROM school_info where school_id in (". $schoolIDs .")";
                        $schoolInfoRes = $conn->query($schoolInfoSql);


                        $highestSchInfTbl = create_table($schoolInfoRes,$cop);
                        $ntsql->free_result();
                        $schoolInfoRes->free_result();


                    }


            }
            $conn->close();

        }
        if ($success) {
            echo $highestSchInfTbl;

        } else {
            echo "<h1>There was an issue!</h1>";
            echo "<h4>The following input errors were detected:</h4>";
            echo "<p>" . $errorMsg . "</p>";
        }
    
        
    
        function sanitize_input($data)
        {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }

        function create_table($data,$cop)
        {
            $highestSchInfTbl = '<table border="1" class = "table">';
            $highestSchInfTbl .= '<tr><td class ="block">school name</td> <td class ="block">school\'s website</td>'
                    .'<td class ="block">school\'s address</td> <td class ="block">school\'s cut off point</td> </tr>';

            $i = 0;
            while($row = mysqli_fetch_array($data)){
                $highestSchInfTbl .= '<tr>';
                $highestSchInfTbl .= 
                '<td class ="block">'. $row['school_name'] .'</td> '
                .'<td class ="block">'. $row['url_address'] .'</td>'
                .'<td class ="block">'. $row['address'] .'</td> '
                .'<td class ="block">'. $cop[$i] .'</td> '
                .'</tr>';
                $i++;
            }
            $highestSchInfTbl .= '</table>';
            return $highestSchInfTbl;
        }
        
    

?>

