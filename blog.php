<?php
require_once "include/DB.php";
?>
<?php require_once "include/Sessions.php";?>
<?php require_once "include/Functions.php";?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY Blog</title>
    <!-- Latest compiled and minified CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="css/publicstyles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Train+One&display=swap" rel="stylesheet">

    <style>
    body {

        background-image: url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS9BBKlijBk8Mm5klWrkVe-v9m6lVyoOiEBNB5gSEYdiHER6KY0ypyWIPj2U1h4cD0gxMM&usqp=CAU");

        


    }

    .imageicon {
        max-width: 150px;
        margin: 0 auto;
        display: block;
    }

    .description {
        color: #868686;
        font-weight: bold;
        margin-top: -2px;
    }

    .background {
        background-color: #f6f7f9;
    }

    .navbar-heading {
        font-family: 'Train One', cursive;
        font-size: 3.5rem;
        color: #fff;
        text-shadow:
            0 0 5px #fff,
            0 0 10px #fff,
            0 0 20px #fff,
            0 0 40px #0ff,
            0 0 80px #0ff,
            0 0 90px #0ff,
            0 0 100px #0ff,
            0 0 150px #0ff;

    }

    @import url(https://fonts.googleapis.com/css?family=Khula:700);

    .hidden {
        opacity: 0;
    }

    .console-container {

        font-family: Khula;
        font-size: 4em;
        height: 100px;
        width: 600px;
        display: block;
        position: relative;
        color: white;
        margin: 20px;
    }

    .console-underscore {
        display: inline-block;
        position: relative;
        top: -0.14em;
        left: 10px;
    }


    footer {
        background-image: url("https://i.pinimg.com/564x/9f/9f/e6/9f9fe69eebcd03462913b049c3082767.jpg");
    }
    </style>
</head>

<body>
    <!--navbar-->
    <div style="height:1px; background-color:paleturquoise"></div>
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="blog.php">
                    <p class="navbar-heading">MY Blog</p>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">Home</a></li>
                    <li class="active"><a href="#blog.php?page=1">Blog</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Sevices</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Features</a></li>
                </ul>
                <form action="blog.php" class="navbar-form navbar-right">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" name="Search">
                    </div>
                    <button class="btn btn-default" name="searchButton">Go</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="line" style="height:2px; background-color:paleturquoise"></div>
    <!--End navbar-->

    <!--Container-->
    <div class="container" style="min-height: calc(100vh - 4rem - 4rem);">

        <!--MAin Header-->
        <div class='console-container'><span id='text'></span>
            <div class='console-underscore' id='console'>&#95;</div>
        </div>

        <!--Script for styiling main header-->
        <script>
        consoleText(['Read Our Blogs', 'Share Your Thoughts'], 'text', ['tomato', 'rebeccapurple', 'SteelBlue']);

        function consoleText(words, id, colors) {
            if (colors === undefined) colors = ['#fff'];
            var visible = true;
            var con = document.getElementById('console');
            var letterCount = 1;
            var x = 1;
            var waiting = false;
            var target = document.getElementById(id)
            target.setAttribute('style', 'color:' + colors[0])
            window.setInterval(function() {

                if (letterCount === 0 && waiting === false) {
                    waiting = true;
                    target.innerHTML = words[0].substring(0, letterCount)
                    window.setTimeout(function() {
                        var usedColor = colors.shift();
                        colors.push(usedColor);
                        var usedWord = words.shift();
                        words.push(usedWord);
                        x = 1;
                        target.setAttribute('style', 'color:' + colors[0])
                        letterCount += x;
                        waiting = false;
                    }, 1000)
                } else if (letterCount === words[0].length + 1 && waiting === false) {
                    waiting = true;
                    window.setTimeout(function() {
                        x = -1;
                        letterCount += x;
                        waiting = false;
                    }, 1000)
                } else if (waiting === false) {
                    target.innerHTML = words[0].substring(0, letterCount)
                    letterCount += x;
                }
            }, 120)
            window.setInterval(function() {
                if (visible === true) {
                    con.className = 'console-underscore hidden'
                    visible = false;

                } else {
                    con.className = 'console-underscore'

                    visible = true;
                }
            }, 400)
        }
        </script>



        <div class="row">
            <!--Row-->
            <div class="col-sm-8">
                <!-- Main Blog area -->
                <?php
if (isset($_GET["searchButton"])) {
    $Search = $_GET["Search"];
    // Query when Search Button is Active

    $ViewQuery = "SELECT * FROM admin_panal
    WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%' ORDER BY id desc";

// Query when Category Search is Active

} elseif (isset($_GET["Category"])) {
    $Category = $_GET["Category"];
    $ViewQuery = "SELECT * FROM admin_panal WHERE category='$Category' ORDER BY id desc";
}

// Query when pagination is Active .. example -> Blog.php?page=1

elseif (isset($_GET["page"])) {
    $Page = $_GET["page"];
    if ($Page == 0 || $Page < 1) {
        $ShowPageFrom = 0;
    } else {
        $ShowPageFrom = ($Page * 5) - 5;}

    $ViewQuery = "SELECT * FROM admin_panal ORDER BY id desc LIMIT $ShowPageFrom,5";

} else {
    // Default Query for Blog Page
    $ViewQuery = "SELECT * FROM admin_panal ORDER BY id desc LIMIT 0,5";}
$Execute = mysqli_query($GLOBALS["db"], $ViewQuery);
while ($DataRows = mysqli_fetch_array($Execute)) {
    $PostId = $DataRows["id"];
    $DateTime = $DataRows["datetime"];
    $Title = $DataRows["title"];
    $Category = $DataRows["category"];
    $Admin = $DataRows["auther"];
    $Image = $DataRows["image"];
    $Post = $DataRows["post"];
    ?>
                <div class="blogPost thumbnail">
                    <img class="img-responsive img-rounded" src="Upload/<?php echo $Image; ?>">
                    <div class="caption">
                        <h1 class="heading"><?php echo htmlentities($Title); ?></h1>
                        <p>Category: <?php echo htmlentities($Category) . "  " . "-"; ?> published on
                            <?php echo htmlentities($DateTime); ?>

                            <?php
$QueryApproved = "SELECT COUNT(*) FROM comments WHERE admin_panal_id='$PostId' AND status='ON'";
    $ExecuteApproved = mysqli_query($GLOBALS["db"], $QueryApproved);
    $RowsApproved = mysqli_fetch_array($ExecuteApproved);
    $TotalApproved = array_shift($RowsApproved);
    if ($TotalApproved > 0) {
        ?>
                            <span class="badge pull-right">
                                Comments <?php echo $TotalApproved;
        ?></span>
                            <?php }?>




                        </p>
                        <p class="post"><?php
if (strlen($Post) > 150) {$Post = substr($Post, 0, 150) . '....';}
    echo htmlentities($Post);?></p>
                    </div>
                    <a href="fullPost.php?id=<?php echo $PostId; ?>"><span class="btn btn-info">Read More
                            &rsaquo;&rsaquo;</span></a>
                </div>
                <?php }?>
                <!-- Pagination Part -->
                <nav>
                    <ul class="pagination pull-left pagination-lg">
                        <?php
// Creating Backward Button
if (isset($Page)) {
    if ($Page > 1) {
        ?>
                        <li><a href="blog.php?page=<?php echo $Page - 1; ?>">&laquo;</a></li>
                        <?php
}
}
?>

                        <?php
$QueryPagination = "SELECT COUNT(*) FROM admin_panal";
$ExecutePagination = mysqli_query($GLOBALS["db"], $QueryPagination);
$RowPagination = mysqli_fetch_array($ExecutePagination);
$TotalPosts = array_shift($RowPagination);
$PostPerPage = $TotalPosts / 5;
$PostPerPage = ceil($PostPerPage);

for ($i = 1; $i <= $PostPerPage; $i++) {
    if (isset($Page)) {
        if ($i == $Page) {

            ?>

                        <li class="active"><a href="blog.php?page=<?php echo $i; ?>"> <?php echo $i; ?> </a></li>
                        <?php } else {?>
                        <li><a href="blog.php?page=<?php echo $i; ?>"> <?php echo $i; ?> </a></li>
                        <?php
}
    }
}?>
                        <?php
// Creating forward Button
if (isset($Page)) {
    if ($Page + 1 <= $PostPerPage) {
        ?>
                        <li><a href="blog.php?page=<?php echo $Page + 1; ?>">&raquo;</a></li>
                        <?php
}
}
?>
                    </ul>
                </nav>

            </div>
            <!--Ending of Main Area-->

            <!-- Side Area -->
            <div class="col-sm-offset-1 col-sm-3" style="background-color:#f6f7f9">
                <h2 class="text-center">About Us</h2>
                <br>
                <img class="img-responsive img-circle imageicon" src="images/about.jpg">
                <br>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, quam fuga fugit reprehenderit
                    exercitationem odit nobis voluptatibus facilis tenetur non ratione molestias minus maxime sed
                    veritatis optio a quibusdam rerum, illo dicta consequuntur, neque sint placeat. Error veritatis
                    earum, vel delectus recusandae rem magni non deleniti molestiae, facilis architecto porro.</p>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title">Categories</h2>
                    </div>
                    <div class="panel-body background">
                        <?php
$ViewQuery = "SELECT * FROM category ORDER BY id desc";
$Execute = mysqli_query($GLOBALS["db"], $ViewQuery);
while ($DataRows = mysqli_fetch_array($Execute)) {
    $ID = $DataRows["id"];
    $Category = $DataRows["name"];

    ?>
                        <a href="blog.php?Category=<?php echo $Category; ?>">
                            <span class="heading"><?php echo $Category . "<br>"; ?></span>
                        </a>
                        <?php }?>
                    </div>
                    <div class="panel-footer">

                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title">Recent Posts</h2>
                    </div>
                    <div class="panel-body background">
                        <?php
$ViewQuery = "SELECT * FROM admin_panal ORDER BY id desc LIMIT 0,5";
$Execute = mysqli_query($GLOBALS["db"], $ViewQuery);
while ($DataRows = mysqli_fetch_array($Execute)) {
    $ID = $DataRows["id"];
    $Title = $DataRows["title"];
    $DateTime = $DataRows["datetime"];
    $Image = $DataRows["image"];
    if (strlen($DateTime > 25)) {$DateTime = substr($DateTime, 0, 25);}
    ?>
                        <div>
                            <img class="pull-left" style="margin-top:10px; margin-left:10px"
                                src="Upload/<?php echo htmlentities($Image); ?>" width="70px" ; height="70px">
                            <a href="fullPost.php?id=<?php echo $ID; ?>">
                                <p class="heading" style="margin-left:90px"><?php echo htmlentities($Title); ?></p>
                            </a>
                            <p class="description" style="margin-left:90px">
                                <?php echo htmlentities($DateTime) . "<hr>"; ?></p>
                        </div>

                        <?php }?>
                    </div>
                    <div class="panel-footer">

                    </div>
                </div>
            </div><!-- End of side Area -->


        </div><!-- End of Row -->
    </div><!-- end of Container -->


    <!-- Footer -->
    <footer class="page-footer font-small cyan darken-3">

        <!-- Footer Elements -->
        <div class="container">

            <!-- Grid row-->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-12 py-5">
                    <div class="mb-5 flex-center">

                        <!-- Facebook -->
                        <a href="https://www.facebook.com/ahmed.helles.7" class="fb-ic" style="margin:20px">
                            <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                        </a>

                        <!--Linkedin -->
                        <a href="https://www.linkedin.com/in/ahmed-hilles-3495961b5/" class="li-ic" style="margin:20px">
                            <i class="fab fa-linkedin-in fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                        </a>

                        <!--Github-->
                        <a href="https://github.com/Ahmed116" class="pin-ic" style="margin:20px">
                            <i class="fab fa-github fa-lg white-text fa-2x"> </i>
                        </a>
                    </div>
                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row-->

        </div>
        <!-- Footer Elements -->
        <br>

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2021 Copyright:
            <a href="https://github.com/Ahmed116"> Ahmed Hilles</a>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->

</body>

</html>