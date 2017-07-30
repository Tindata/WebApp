<?php
$servername = "";
$username = "";
$password = "";
$dbname = "";

$name = $_GET["name"];


$DSID;
$url;
$htmldescription;
$region;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM datasetList WHERE name = '$name'";

$result = $conn->query($sql);

$array = get_object_vars($result);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        
        $DSID = $row["DSID"];
        $url = $row["url"];
        $htmldescription = $row["htmldescription"];
        $region = $row["region"];
        

        if ($region == "ACT"){

            $html = file_get_contents($url);
            
            $notRlyJSON = explode(";}", explode("var initialState = ", rtrim($html, " \t."))[1])[0];

            $views = explode("}", explode('"viewCount":', $notRlyJSON)[1])[0];
            $downloads = explode(",", explode('"downloadCount":', $notRlyJSON)[1])[0];
            $lastUpdated = explode('"', explode('"lastUpdatedAt":"', $notRlyJSON)[1])[0];

            $dateCreated = explode('"', explode('"createdAt":"', $notRlyJSON)[1])[0];
            $relatedJSON = explode(']', explode('relatedViews: ', $notRlyJSON)[1])[0]."]";
            $isTabular = explode(',', explode('"isTabular":', $notRlyJSON)[1])[0];

            echo "$views $downloads";



            if ($isTabular) {

                // "tags":



                $tagsJSON = explode(',"twitterShareUrl"', explode('"tags":', $notRlyJSON)[1])[0];

                $tagsArr = json_decode($tagsJSON, true);


                foreach ($tagsArr as $key => $tag) {

                    // echo $column["name"];


                    print_r($tag);
                    // foreach ($column as $key1 => $value) {
                    //     print_r($key1);
                    //     echo ":";
                    //     print_r($value);
                    //     echo "<br>";
                    // }
                    // echo "<br><br>";


                }

                // $columnsJSON = explode(',"commentUrl"', explode('columns":', $notRlyJSON)[1])[0];

                // $columnsArr = json_decode($columnsJSON, true);


                // foreach ($columnsArr as $key => $column) {

                //     // echo $column["name"];


                //     // print_r($column);
                //     // foreach ($column as $key1 => $value) {
                //     //     print_r($key1);
                //     //     echo ":";
                //     //     print_r($value);
                //     //     echo "<br>";
                //     // }
                //     // echo "<br><br>";


                // }

                //SHOW TABLE








            }
            else {
                //LINK TO DATASET
            }


            // print_r(explode('columns":', $notRlyJSON));

            


            // foreach ($relatedArr as $key => $relatedSet) {

            //     foreach ($relatedSet as $key1 => $value) {
            //         print_r($key1);
            //         echo ":";
            //         print_r($value);
            //         echo "<br>";
            //     }


            // }




            // $relatedArr = json_decode($relatedJSON, true);


            // foreach ($relatedArr as $key => $relatedSet) {

            //     foreach ($relatedSet as $key1 => $value) {
            //         print_r($key1);
            //         echo ":";
            //         print_r($value);
            //         echo "<br>";
            //     }


            // }

            // echo $relatedJSON;

            // echo "<br>".$views."<br>".$downloads."<br>".$lastUpdated."<br>".$dateCreated;
            // lastUpdatedAt

        }

        

    }
} else {
    echo "Data set not found.";
}
$conn->close();

?>