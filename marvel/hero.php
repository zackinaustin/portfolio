<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Search Heros by Category and Gender</title>

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
                <h1 class="page-header">Select a Justice or Villain</h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Group</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <img class="img-responsive center-block" src="image/category-gender-banner-01.jpg">
        <div class="row">


                    <!-- Get the creator names -->
    <form action="hero.php" method="GET" aligh="middle">
        <h2>Find the good or bad guy!</h2>
<!-- Create a drop-down menu for country selection -->
<select class="form-control input-lg" name = "category" align="middle" id="form1">
    <option value = "none">Please select</option>
    <option value = "Justice">Justice</option>
    <option value = "Villain">Villain</option>
</select>

<select class="form-control input-lg" name = "gender" align="middle" id="form2">
    <option value = "none">Please select</option>
    <option value = "Male">Male</option>
    <option value = "Female">Female</option>
</select>
<!-- Add the submit button -->
        <button type="submit" class="btn btn-primary btn-block">Let's go!</button>
</form>


        </div>



        <hr>
<?php

// Setting up database
$host = "localhost";
$user = "marvel";
$password = "blackwidowloki";
$database = "marvel";
$link = mysqli_connect($host, $user, $password, $database);

// Get the category and gender
if (isset($_GET['category']) && isset($_GET['gender'])){
    
    // search id for hero category
    $search_id1 = $_GET['category'];
    $search_id1 = preg_replace("/[^ 0-9a-zA-Z]+/", "", $search_id1);

    // search id for hero gender
    $search_id2 = $_GET['gender'];
    $search_id2 = preg_replace("/[^ 0-9a-zA-Z]+/", "", $search_id2);

    // when user doesn't select anything
    if ($search_id1 == "none" && $search_id2 == "none"){
        print "Please make at least one selection.<br />";

      // when user only selects gender
    } elseif ($search_id1 == "none") {
        $search_query = "SELECT name, hero_id FROM heros 
                         WHERE gender = '$search_id2'";
        $listresult = mysqli_query($link, $search_query);
        while ($row = mysqli_fetch_array($listresult)){
            $image = "image/hero-thumbnails/$row[hero_id].png";
            print "<div class='col-md-3 img-portfolio'>";
            print "<a class='thumbnail' href='one_hero.php?hero=$row[hero_id]'>";
            print "<img class='img-responsive img-hover img-circle' src='$image'>";
            print "<h4 style='text-align: center'>$row[name]</h4>";
            print "</a>";
            print "</div>";
        }
        mysqli_close($link);

        // when user only selects category
    } elseif ($search_id2 == "none") {
        $search_query = "SELECT name, hero_id FROM heros 
                         WHERE category = '$search_id1'";
        $listresult = mysqli_query($link, $search_query);
        while ($row = mysqli_fetch_array($listresult)){
            $image = "image/hero-thumbnails/$row[hero_id].png";
            print "<div class='col-md-3 img-portfolio'>";
            print "<a class='thumbnail' href='one_hero.php?hero=$row[hero_id]'>";
            print "<img class='img-responsive img-hover img-circle' src='$image'>";
            print "<h4 style='text-align: center'>$row[name]</h4>";
            print "</a>";
            print "</div>";
        }
        mysqli_close($link);

        // when user selects both gender and category
    } else{
        $search_query = "SELECT name,hero_id FROM heros 
                         WHERE gender = '$search_id2' AND category = '$search_id1'";
        $listresult = mysqli_query($link, $search_query);
        while ($row = mysqli_fetch_array($listresult)){
            $image = "image/hero-thumbnails/$row[hero_id].png";
            print "<div class='col-md-3 img-portfolio'>";
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
