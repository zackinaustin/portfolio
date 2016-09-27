<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<title>View Hero Details</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style>
        body{
            background-image: url("image/wallpaper.png");
        }
        img.wallpaper{
            border-style: solid;
            border-width: 20px;
            border-color: white;
        }
        .description{
            color: white;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            line-height: 1.5;
        }
        .capitalize{
            font-size: 80px;
            text-transform: uppercase;
            color: white;
            font-family: impact;

        }
    </style>
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"><img src="image/Marvel-logo.png" style="width:132px;height:52px;"></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="character.html">Character</a>
                </li>

                <li>
                    <a href="hero.php">Hero</a>
                </li>
                <li>
                    <a href="country.php">Country</a>
                </li>
                <li>
                    <a href="creator.php">Creator</a>
                </li>
                <li>
                    <a href="group.php">Group</a>
                </li>
                <li>
                    <a href="about.html">About Us</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<?php

$host = "localhost";
$user = "marvel";
$password = "blackwidowloki";
$database = "marvel";
$link = mysqli_connect($host, $user, $password, $database);

// Get the hero name

if (isset($_GET['hero'])){
    $search_id = $_GET['hero'];
    $search_id = preg_replace("/[^ 0-9a-zA-Z]+/", "", $search_id);
    if ($search_id == "none"){
        print "Please select a hero.<br />";
    } else {
        $search_query = "SELECT * FROM heros WHERE hero_id = $search_id";
        $listresult = mysqli_query($link, $search_query);
        $item_array = array( "category", "name", "real_name", "citizenship", "gender", "marital_status", "occupation", "birth_place", "height", "weight", "ability", "powers", "introduction", "INTELLIGENCE", "STRENGTH", "SPEED", "DURABILITY", "ENERGY_PROJECTION", "FIGHING_SKILL");
        $i_count = count($item_array);
        while ($row = mysqli_fetch_array($listresult)){
            $img_path = "image/hero-images/$row[hero_id].jpg";
            // print "Path is $img_path<br />";
            print'<div style="text-align:center">';
            print "<img class='wallpaper' src=$img_path><br />";
            print'</div>';
            print'<div class="capitalize container">';
            print"$row[name]";
            print'</div>';
            for ($i = 0; $i < $i_count; $i++) {
                $item = $item_array[$i];
                print'<div class="description container">';
                print "$item:&nbsp;&nbsp;&nbsp;&nbsp; $row[$item]<br />";
                print'</div>';

            }
        }
        mysqli_close($link);
    }
}
?>
</body>
</html>
