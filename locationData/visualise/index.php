<?php

function exists($url) {
	try {
		return @file_get_contents($url,0,null,0,1);
	} catch (Exception $e) {
	    return false;
	}
}

$servername = "";
$username = "";
$password = "";
$dbname = "";

$name = $_GET["id"];


$DSID;
$url;
$htmldescription;
$region;
$name;
$views;
$downloads;
$score;


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
		$name = $row["name"];
		$score = $row["score"];

        if ($region == "ACT"){

            $html = file_get_contents($url);

            $notRlyJSON = explode(";}", explode("var initialState = ", rtrim($html, " \t."))[1])[0];

            $views = explode("}", explode('"viewCount":', $notRlyJSON)[1])[0];
            $downloads = explode(",", explode('"downloadCount":', $notRlyJSON)[1])[0];
            $lastUpdated = explode('"', explode('"lastUpdatedAt":"', $notRlyJSON)[1])[0];

            $dateCreated = explode('"', explode('"createdAt":"', $notRlyJSON)[1])[0];
            $relatedJSON = explode(']', explode('relatedViews: ', $notRlyJSON)[1])[0]."]";
            $isTabular = explode(',', explode('"isTabular":', $notRlyJSON)[1])[0];


            // echo "$views $downloads";

            if ($isTabular) {

				preg_match('/.*?([a-z0-9]{4}.[a-z0-9]{4}).*?/', $url, $matches, PREG_OFFSET_CAPTURE);
				$shouldTableItUp = false;
				$magic = "";
				if (isset($matches) && count($matches) == 2) {
					$magic = $matches[1][0];
					if (exists("https://www.data.act.gov.au/api/views/" . $magic . "/rows.json?accessType=DOWNLOAD")) {
						$shouldTableItUp = true;
					}
				}

                $tagsJSON = explode(',"twitterShareUrl"', explode('"tags":', $notRlyJSON)[1])[0];

                $tagsArr = json_decode($tagsJSON, true);

                foreach ($tagsArr as $key => $tag) {
                    // print_r($tag);";
                }
            }
            else {
                //LINK TO DATASET
            }
        }
    }
} else {
    echo "Data set not found.";
	die();
}
$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


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
          <a class="navbar-brand" onclick="window.close()" href="#">&lt; Back to list</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/">Home</a></li>
            <li><a href="#"></a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 col-md-12 main">
          <h1 class="page-header"><?php echo $name; ?></h1>

		  <ul>
			  <?php
			  	function printLI($item) {
					echo "<li>".$item."</li>";
				}
				printLI("<a href=\"".$url."\">Link to data set</a>");
				printLI("Description: ".$htmldescription);
				printLI("Views: ".$views);
				printLI("Downloads: ".$downloads);
				printLI("Region: ".$region);
				printLI("<b>Rank:</b> ".$score);
			  ?>
		  </ul>

<?php if ($shouldTableItUp) { ?>
		  <h3>Data preview</h3>
		  <hr />
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr id="tablecolumns">

                </tr>
              </thead>
              <tbody id="tablebody">


              </tbody>
            </table>
          </div>
		  <?php } ?>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

	<script
	  src="https://code.jquery.com/jquery-3.2.1.min.js"
	  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
	  crossorigin="anonymous"></script>

<?php if ($shouldTableItUp) { ?>
<script>
var page_data = [];

function getPage(page) {
	var page = page || 0;
	return page_data.slice(100*page, 100*(page+1));
}

$(document).ready(function() {
	var url = "<?php echo("https://www.data.act.gov.au/api/views/" . $magic . "/rows.json?accessType=DOWNLOAD"); ?>";

	$.getJSON(url, function (data) {
		var real_columns = [];
		var data_columns = data["meta"]["view"]["columns"];
		for (var column of data_columns) {
			console.log(column);
			if (column.id > -1) {
				real_columns.push(column.name);
			} else {
				real_columns.push(null);
			}
		}
		console.log(real_columns);
		console.log(data.data);
		var real_data = [];
		for (var data of data.data) {
			var current_object = {}
			for (var idx in real_columns) {
				if (real_columns[idx] != null) {
					current_object[real_columns[idx]] = data[idx];
				}
			}
			real_data.push(current_object);
		}
		console.log(real_data);
		page_data = real_data;

		for (var column of real_columns) {
			if (column != null) {
				var str = "<th>"+column+"</th>";
				$("#tablecolumns").append(str);
			}
		}

		var s = getPage();
		for (var item of s) {
			var o = "<tr>";
			for (var col of real_columns) {
				if (col != null) {
					o += "<td>" + item[col] + "</td>"
				}
			}
			o += "</tr>";
			$("#tablebody").append(o);
		}
    });
})
</script>
<?php } ?>

  </body>
</html>
