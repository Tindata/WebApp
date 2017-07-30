
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tindata | Ranked Data Sets</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="datatable.css" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Tindata</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../">Home</a></li>
            <li><a href="#"></a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li <?php
            error_reporting(0);

            if(!isset($_GET['tag'])){
              echo 'class="active"';
            }


            ?>><a href="?">All Data <span class="sr-only">(current)</span></a></li>


            <?php

            $servername = "";
            $username = "";
            $password = "";
            $dbname = "";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed.");
            }



            $tagArray = "";

            $sql = "SELECT * FROM datasetList WHERE score > 0 ORDER BY score DESC";
            $result = $conn->query($sql);


            if ($result->num_rows > 0) {

              // output data of each row
              while($row = $result->fetch_assoc()) {


                $tagName = $row["tags"];

                $tagArray = $tagArray.$tagName.",";

              }

              }
              else {
                echo "Please select a different tag";
              }

              $tagArray = rtrim($tagArray,',');
              $tagArray = explode(",", $tagArray);

              $tagArray = array_unique($tagArray);
              // $tagArray = sort($tagArray);

              // print_r($tagArray);
              foreach ($tagArray as $key1 => $tagNameABC) {

                if(isset($_GET['tag'])){

                  $tagNameXD = $_GET["tag"];

                  if ($tagNameABC == $tagNameXD){
                    echo '<li class="active"><a href="?tag='.$tagNameABC.'">'.$tagNameABC.'</a></li>';
                  }
                  else{
                    echo '<li><a href="?tag='.$tagNameABC.'">'.$tagNameABC.'</a></li>';
                  }
                }
                else{
                  echo '<li><a href="?tag='.$tagNameABC.'">'.$tagNameABC.'</a></li>';
                }


              }


            $conn->close();

            ?>



          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Ranked Datasets</h1>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Score</th>
                  <th>Dataset Title</th>
                  <th>Date Created</th>
                  <th>Last Updated</th>
                  <th>Downloads</th>
                  <th>Views</th>
                  <th>Community Rating</th>
                </tr>
              </thead>
              <tbody>


<?php

$servername = "localhost";
$username = "damoflam_citnainadmin";
$password = "u%RQq?yTsp@E";
$dbname = "damoflam_citnain";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed.");
}





if(isset($_GET['tag'])){
  $tagToFilter = $_GET["tag"];

  $sql = "SELECT * FROM datasetList WHERE score > 0 and tags like '%$tagToFilter%' ORDER BY score DESC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $url = $row["url"];
        echo "<tr>";
        echo "<td>".$row["score"]."</td>";
        echo "<td><a href=\"visualise?id=".urlencode($row["name"])."\" target=\"_blank\">".$row["name"]."</a></td>";
        echo "<td>".date("d/m/Y", strtotime($row["dateCreated"]))."</td>";
        echo "<td>".date("d/m/Y", strtotime($row["dateUpdated"]))."</td>";
        echo "<td>".$row["downloads"]."</td>";
        echo "<td>".$row["views"]."</td>";
        echo "<td><center><i class=\"fa fa-thumbs-up\" aria-hidden=\"true\" onclick=\"alert('Your feedback has been received')\"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class=\"fa fa-thumbs-down\" aria-hidden=\"true\" onclick=\"alert('Your feedback has been received')\"></i></center></td>";
        echo "</tr>";
      }

    }
    else {
      echo "0 Results";
    }

}
else{

  $sql = "SELECT * FROM datasetList WHERE score > 0 ORDER BY score DESC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $url = $row["url"];
        echo "<tr>";
        echo "<td>".$row["score"]."</td>";
        echo "<td><a href=\"visualise?id=".urlencode($row["name"])."\" target=\"_blank\">".$row["name"]."</a></td>";
        echo "<td>".date("d/m/Y", strtotime($row["dateCreated"]))."</td>";
        echo "<td>".date("d/m/Y", strtotime($row["dateUpdated"]))."</td>";
        echo "<td>".$row["downloads"]."</td>";
        echo "<td>".$row["views"]."</td>";
        echo "<td><center><i class=\"fa fa-thumbs-up\" aria-hidden=\"true\" onclick=\"alert('Your feedback has been received')\"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class=\"fa fa-thumbs-down\" aria-hidden=\"true\" onclick=\"alert('Your feedback has been received')\"></i></center></td>";
        echo "</tr>";
      }

    }
    else {
      echo "0 Results";
    }

}




$conn->close();

?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
