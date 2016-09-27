<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Search Heros by Group</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Select a Group</h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Group</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <img class="img-responsive center-block" src="image/group-banner-01.jpg">
        <div class="row">


                    <!-- Get the creator names -->
    <form action="group.php" method="GET" aligh="middle">
                <h2>Select a group you're interested in!</h2>

<select class="form-control input-lg" name = "group" align="middle" id="form1">
    <option value = "none">Please select</option>
    <option value = 1>Avengers</option>
    <option value = 2>Defenders</option>
    <option value = 3>Fantastic Four</option>
    <option value = 4>Gods of Asgard</option>
    <option value = 5>Guardians of the Galaxy</option>
    <option value = 6>S.H.I.E.L.D.</option>
    <option value = 7>U.S Army</option>
    <option value = 8>X-Factor</option>
    <option value = 9>X-Men</option>
    <option value = 10>Others</option>
</select>
        <button type="submit" class="btn btn-primary btn-block">Let's go!</button>
</form>


        </div>



        <hr>
<?php

// Setting up the database
$host = "localhost";
$user = "marvel";
$password = "blackwidowloki";
$database = "marvel";
$link = mysqli_connect($host, $user, $password, $database);

// Get hero's group name
if (isset($_GET['group'])){
    $search_id = $_GET['group'];
    $search_id = preg_replace("/[^ 0-9a-zA-Z]+/", "", $search_id);
    if ($search_id == "none"){
        print "Please select a group.<br />";
    } else {
        $search_query = "SELECT groups.group_name, heros.name, heros.hero_id
                         FROM heros, hero_group, groups
                         WHERE groups.group_id = $search_id
                         AND groups.group_id = hero_group.group_id
                         AND heros.hero_id = hero_group.hero_id";
        $listresult = mysqli_query($link, $search_query);
        while ($row = mysqli_fetch_array($listresult)){
            // get the hero image
            $image = "image/hero-thumbnails/$row[hero_id].png";
            print "<div class='col-md-3 img-portfolio'>";
            // link to hero page
            print "<a class='thumbnail' href='one_hero.php?hero=$row[hero_id]'>";
            print "<img class='img-responsive img-hover img-circle' src='$image'>";
            print "<h4 style='text-align: center'>$row[name]</h4>";
            print "</a>";
            print "</div>";
        }
        mysqli_close($link);
    }
}
?>
        
    </div>
    <!-- /.container -->
<!-- Footer -->
           <footer>
           
                <div style= "background-color:#696969;padding:70px;">
                    <p style="color:#ffffff; text-align: center;">© 2015 Designed and Developed by Marvel Group for Database Management Course</p>
                </div>
           
        </footer>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
