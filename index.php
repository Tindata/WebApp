<?php

error_reporting(0);

$servername = "";
$username = "";
$password = "";
$dbname = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT COUNT(name) FROM datasetList WHERE region = 'ACT'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$DSCountACT = $row["COUNT(name)"];

$sql = "SELECT COUNT(name) FROM datasetList WHERE region = 'NSW'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$DSCountNSW = $row["COUNT(name)"];

$sql = "SELECT COUNT(name) FROM datasetList WHERE region = 'NT'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$DSCountNT = $row["COUNT(name)"];

$sql = "SELECT COUNT(name) FROM datasetList WHERE region = 'Queensland'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$DSCountQLD = $row["COUNT(name)"];

$sql = "SELECT COUNT(name) FROM datasetList WHERE region = 'SA'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$DSCountSA = $row["COUNT(name)"];

$sql = "SELECT COUNT(name) FROM datasetList WHERE region = 'Tasmania'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$DSCountTAS = $row["COUNT(name)"];

$sql = "SELECT COUNT(name) FROM datasetList WHERE score > 0";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$DSCountAll = $row["COUNT(name)"];
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tindata | Welcome</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <link href="css/creative.min.css" rel="stylesheet">


</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Tindata</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#getstarted">Get Started</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">Plot, compare or sort anything.</h1>
                <hr>
                <p>The world is full of data and it's incredibly valuable. But not all data is created equal. It can be like finding the needle in the haystack. So, we present you with Tindata, it's like tinder for data. Time to match data to you.</p>
                <a href="#about" class="btn btn-primary btn-xl page-scroll">Ready to get started?</a>
            </div>
        </div>
    </header>

    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">At Your Service</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-bar-chart text-primary sr-icons"></i>
                        <h3>Plot</h3>
                        <p class="text-muted">Display any dataset on a graph natively in our site.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-star text-primary sr-icons"></i>
                        <h3>Quality over Quantity</h3>
                        <p class="text-muted">Our algorithm finds which datasets are the most reliable and up to date for you.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-filter text-primary sr-icons"></i>
                        <h3>Sort</h3>
                        <p class="text-muted">Find exactly what you want, up to date and quality assured.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-primary" id="getstarted">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">How to use Tindata</h2>
                    <hr class="light">
                    <p class="text-faded">Start by chosing a location below. We have data from ACT, NSW, NT, TAS, SA and QLD. Our algorithms will rank all datasets and give you the most hightly scored data for what you need.
                    </p>
                    <a href="#choselocation" class="page-scroll btn btn-default btn-xl sr-button">Get Started!</a>
                </div>
            </div>
        </div>
    </section>

    

    <section class="no-padding" id="choselocation">
        <div class="container-fluid">
            <div class="row no-gutter popup-gallery">
                <div class="col-lg-4 col-sm-6">
                    <a href="locationData?state=ACT" class="portfolio-box">
                        <img src="img/locations/thumbnails/ACT.jpeg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    ACT
                                </div>
                                <div class="project-name">
                                    <?php echo $DSCountACT ?> datasets ranked
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="locationData?state=NSW" class="portfolio-box">
                        <img src="img/locations/thumbnails/NSW.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    NSW
                                </div>
                                <div class="project-name">
                                    <?php echo $DSCountNSW ?> datasets ranked
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="locationData?state=NT" class="portfolio-box">
                        <img src="img/locations/thumbnails/NT.jpeg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    NT
                                </div>
                                <div class="project-name">
                                    <?php echo $DSCountNT ?> datasets ranked
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="locationData?state=TAS" class="portfolio-box">
                        <img src="img/locations/thumbnails/TAS.jpeg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    TAS
                                </div>
                                <div class="project-name">
                                    <?php echo $DSCountTAS ?> datasets ranked
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="locationData?state=" class="portfolio-box">
                        <img src="img/locations/thumbnails/SA.jpeg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    SA
                                </div>
                                <div class="project-name">
                                    <?php echo $DSCountSA ?> datasets ranked
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="locationData?state=" class="portfolio-box">
                        <img src="img/locations/thumbnails/QLD.jpeg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    QLD
                                </div>
                                <div class="project-name">
                                    <?php echo $DSCountQLD ?> datasets ranked
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>Looking nationwide?</h2>
                <!-- <a href="#" class="btn btn-default btn-xl sr-button">Browse national data</a><br/><br/> -->
                <a href="locationData" class="btn btn-default btn-xl sr-button">Browse all scored data</a><br/><br/>
                <p class="text-faded"><?php echo $DSCountAll ?> datasets scored.</p>
            </div>
        </div>
    </aside>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>

    <script src="js/creative.min.js"></script>

</body>

</html>
