<?php
$servername = "";
$username = "";
$password = "";
$dbname = "";

$name;


$DSID;
$url;
$htmldescription;
$region;
//error_reporting(0);
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM datasetList WHERE score = 0";

$result = $conn->query($sql);

$array = get_object_vars($result);


if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {

        //var_dump($row);

        // echo "<br>";
        $DSID = $row["DSID"];
        $url = $row["url"];
        $htmldescription = $row["htmldescription"];
        $region = $row["region"];
        $name = $row["name"];


        if ($region == "ACT"){


            // if ($name == "Traffic camera offences and fines") {

                $html = file_get_contents($url);

                if (!isset(explode("};", explode("var initialState = ", rtrim($html, " \t."))[1])[0])) {
                    
                    $notRlyJSON = explode("};", explode("var initialState = ", rtrim($html, " \t."))[1])[0];

                    // print_r(explode('"viewCount":', $notRlyJSON));

                    $views = explode("}", explode('"viewCount":', $notRlyJSON)[1])[0];
                    $downloads = explode(",", explode('"downloadCount":', $notRlyJSON)[1])[0];
                    $lastUpdated = explode('"', explode('"lastUpdatedAt":"', $notRlyJSON)[1])[0];

                    $dateCreated = explode('"', explode('"createdAt":"', $notRlyJSON)[1])[0];
                    $relatedJSON = explode(']', explode('relatedViews: ', $notRlyJSON)[1])[0]."]";


                    $isTabular = explode(',', explode('"isTabular":', $notRlyJSON)[1])[0];


                    // echo $views;

                    $datetime1 = new DateTime($lastUpdated);
                    $datetime2 = new DateTime();
                    $interval = $datetime1->diff($datetime2);

                    $daysSinceUpdate = $interval->format('%r%a');

                    $datetime3 = new DateTime($dateCreated);
                    $datetime4 = new DateTime();
                    $interval = $datetime3->diff($datetime4);

                    $daysSinceCreation = $interval->format('%r%a');

                    //Calculate Score

                    $finalScore = round(10 * ((10 * $downloads + $views)/($daysSinceCreation+1))/(1+($daysSinceUpdate/100)));

                    echo "<br><br><br><br><br>".$name.":".$finalScore."<br><br><br><br>";

                    $sql1 = "UPDATE datasetList SET score = $finalScore WHERE DSID = $DSID;";

                    $result1 = $conn->query($sql1);
                
                }

                else {
                    echo "NOT TABULAR";
                }

                

            // }





        //     if ($isTabular) {

        //         // echo "IS A TABLE";

        //         $columnsJSON = explode(',"commentUrl"', explode('columns":', $notRlyJSON)[1])[0];

        //         $columnsArr = json_decode($columnsJSON, true);


        //         foreach ($columnsArr as $key => $column) {

        //             // echo $column["name"];


        //             // print_r($column);
        //             // foreach ($column as $key1 => $value) {
        //             //     print_r($key1);
        //             //     echo ":";
        //             //     print_r($value);
        //             //     echo "<br>";
        //             // }
        //             // echo "<br><br>";


        //         }

        //         //SHOW TABLE








        //     }
        //     else {
        //         //LINK TO DATASET
        //     }


        //     // print_r(explode('columns":', $notRlyJSON));




        //     // foreach ($relatedArr as $key => $relatedSet) {

        //     //     foreach ($relatedSet as $key1 => $value) {
        //     //         print_r($key1);
        //     //         echo ":";
        //     //         print_r($value);
        //     //         echo "<br>";
        //     //     }


        //     // }




        //     // $relatedArr = json_decode($relatedJSON, true);


        //     // foreach ($relatedArr as $key => $relatedSet) {

        //     //     foreach ($relatedSet as $key1 => $value) {
        //     //         print_r($key1);
        //     //         echo ":";
        //     //         print_r($value);
        //     //         echo "<br>";
        //     //     }


        //     // }

        //     // echo $relatedJSON;

        //     // echo "<br>".$views."<br>".$downloads."<br>".$lastUpdated."<br>".$dateCreated;
        //     // lastUpdatedAt

        }



    }
} else {
    echo "Data set not found.";
}
$conn->close();

?>
