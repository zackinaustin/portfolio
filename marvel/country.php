<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Find Hero in your Favorite Country</title>

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
                <h1 class="page-header">Find the Country
                    
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Country</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        <img class="img-responsive center-block" src="image/country-banner-01.jpg">

        <!-- Get the creator names -->
    <form action="country.php" method="GET" aligh="middle">
                <h2>Find a hero in your favorite country!</h2>

<!-- Create a drop-down menu for country selection -->
<select class="form-control input-lg" name = "citizenship" align="middle" id="form1">
    <option value = "none">Please select</option>
    <option value = "Asgard">Asgard</option>
    <option value = "Austrian">Austrian</option>
    <option value = "Canada">Canada</option>
    <option value = "China">China</option>
    <option value = "Floral Colossus">Floral Colossus</option>
    <option value = "Halfworld">Halfworld</option>
    <option value = "Other">Other</option>
    <option value = "Robots">Robots</option>
    <option value = "Russian">Russian</option>
    <option value = "Titan">Titan</option>
    <option value = "U.S.A">U.S.A</option>
    <option value = "Zen-Whoberian">Zen-Whoberian</option>
</select>
<!-- Add the submit button -->
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

if (isset($_GET['citizenship'])){
    $search_id = $_GET['citizenship'];
    // except for U.S.A and Zen-Whoberian since they have punctuation
    if ($search_id != "U.S.A" && $search_id != "Zen-Whoberian"){
        $search_id = preg_replace("/[^ 0-9a-zA-Z]+/", "", $search_id);
    }
    // when user doesn't select anything
    if ($search_id == "none"){
        print "Please select your hero's citizenship.<br />";
    }else{
        $search_query = "SELECT name,hero_id FROM heros 
                         WHERE citizenship LIKE '%$search_id%'";
        $listresult = mysqli_query($link, $search_query);
        while ($row = mysqli_fetch_array($listresult)){
            // print out image for this hero
            $image = "image/hero-thumbnails/$row[hero_id].png";
            print "<div class='col-md-3 img-portfolio'>";
            // hyperlink to the individual hero page
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
