<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Creator</title>

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
                <h1 class="page-header">Select a Creator</h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Creators</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <img class="img-responsive center-block" src="image/creatorbanner-01.jpg">
        <div class="row">


                    <!-- Get the creator names -->
    <form action="creator.php" method="GET" aligh="middle">
        <h2>Select a creator you're interested in!</h2>

<!-- Create a drop-down menu for creator selection -->
        <select class="form-control input-lg" name = "creator" align="middle" id="form1">
            <option value = "none">Please select</option>
            <option value = 1>Bill Mantlo</option>
            <option value = 2>Chris Claremont</option>
            <option value = 3>Dave Cockrum</option>
            <option value = 4>Dick Ayers</option>
            <option value = 5>Don Heck</option>
            <option value = 6>Don Rico</option>
            <option value = 7>Herb Trimpe</option>
            <option value = 8>Jack Kirby</option>
            <option value = 9>Jim Mooney</option>
            <option value = 10>Jim Starlin</option>
            <option value = 11>Joe Simon</option>
            <option value = 12>John Buscema</option>
            <option value = 13>Keith Giffen</option>
            <option value = 14>Larry Lieber</option>
            <option value = 15>Len Wein</option>
            <option value = 16>Mike Friedrich</option>
            <option value = 17>Roy Thomas</option>
            <option value = 18>Stan Lee</option>
            <option value = 19>Steve Ditko</option>
            <option value = 20>Steve Englehart</option>
            <option value = 21>Steve Gan</option>
        </select>
<!-- Add the submit button -->
        <button type="submit" class="btn btn-primary btn-block">Let's go!</button>

        <!--<input type = "submit" value = "Let's go!" id = button>-->
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

// Get the creator name
if (isset($_GET['creator'])){
    $search_id = $_GET['creator'];
    $search_id = preg_replace("/[^ 0-9a-zA-Z]+/", "", $search_id);
    if ($search_id == "none"){
        print "Please select a creator.<br />";
    }else{
        // return sql results
        $search_query = "SELECT creators.creator_name, heros.name, heros.hero_id
                         FROM heros, hero_creator, creators 
                         WHERE creators.creator_id = $search_id 
                         AND creators.creator_id = hero_creator.creator_id 
                         AND heros.hero_id = hero_creator.hero_id";
        $listresult = mysqli_query($link, $search_query);
        while ($row = mysqli_fetch_array($listresult)){
            // get the image for the hero
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
