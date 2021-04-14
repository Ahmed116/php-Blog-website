<?php
require_once "include/DB.php";
?>
<?php require_once "include/Sessions.php";?>
<?php require_once "include/Functions.php";?>

<?php

if (isset($_POST["Submit"])) {
    $Name = $_POST["Name"];
    $Email = $_POST["Email"];
    $Comment = $_POST["Comment"];
    date_default_timezone_set("Asia/Gaza");
    $CurrentTime = date("F j, Y, g:i a");
    $CurrentTime;
    $PostId = $_GET["id"];

    if (empty($Name) || empty($Email) || empty($Comment)) {
        $_SESSION["ErrorMessage"] = "All Feild Required !";

    } elseif (strlen($Comment) > 500) {
        $_SESSION["ErrorMessage"] = "Only 500 characters Are Allowed In Comments";

    } else {
        $PostIdFromURL = $_GET["id"];
        $Query = "INSERT INTO comments (datetime,name,email,comment,approvedby,status,admin_panal_id)
       VALUES ('$CurrentTime','$Name','$Email','$Comment','Pending','OFF','$PostIdFromURL')";
        $Execute = mysqli_query($GLOBALS["db"], $Query);
        if ($Execute) {
            $_SESSION["successMessage"] = "Your Comment Added Successfully";
            Redirect_to("fullPost.php?id={$PostId}");
        } else {
            $_SESSION["errorMessage"] = "Something Went Wrong Try Again !";
            Redirect_to("fullPost.php?id={$PostId}");
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Blog Post</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Train+One&display=swap" rel="stylesheet">

    <style>
    .FeildInfo {
        color: #294987;
        font-family: Bitter, Georgia, 'Times New Roman', Times, serif;
        font-size: 1.2em;
    }

    .CommentsBlock {
        background-color: #f6f7f9;
    }

    .Comment-info {
        color: #365899;
        font-family: sans-serif;
        font-size: 1.1em;
        font-weight: bold;
        padding-top: 10px;
    }

    .description {
        color: #868686;
        font-weight: bold;
        margin-top: -2px;
    }

    .comment {
        margin-top: -2px;
        padding-bottom: 10px;
        font-size: 1.1em;

    }

    .imageicon {
        max-width: 150px;
        margin: 0 auto;
        display: block;
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

    footer {
        background-image: url("https://i.pinimg.com/564x/9f/9f/e6/9f9fe69eebcd03462913b049c3082767.jpg");
    }
    </style>
</head>

<body>
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
                    <li class="active"><a href="blog.php?page=1">Blog</a></li>
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

    <div class="container" style="min-height: calc(100vh - 4rem - 4rem);">
        <!--Container-->
        <div class="blog-header">
            <h1>MY Blog</h1>
            <p class="lead">The Complete Blog Using PHP By Ahmed Hilles</p>
        </div>
        <div class="row">
            <!--Row-->
            <div class="col-sm-8">
                <!-- Main Blog area -->
                <?php echo Message();
echo successMessage();
?>
                <?php
if (isset($_GET["searchButton"])) {
    $Search = $_GET["Search"];
    $ViewQuery = "SELECT * FROM admin_panal
    WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
} else {
    $PostIDFromURL = $_GET["id"];
    $ViewQuery = "SELECT * FROM admin_panal WHERE id = '$PostIDFromURL' ORDER BY datetime desc";}
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
                        <p class="description">Category: <?php echo htmlentities($Category) . "  " . "-"; ?> published
                            on <?php echo htmlentities($DateTime); ?></p>
                        <p class="post"><?php
echo nl2br($Post); ?></p>
                    </div>
                </div>
                <?php }?>
                <br><br>
                <br><br>
                <span class="FeildInfo" style="font-weight: bold; color:brown">Comments</span>
                <br><br>
                <?php
$PostIdForComment = $_GET["id"];
$ExtractingCommentsQuery = "SELECT * FROM comments WHERE admin_panal_id='$PostIdForComment' AND status='ON'";
$Execute = mysqli_query($GLOBALS["db"], $ExtractingCommentsQuery);
while ($DataRows = mysqli_fetch_array($Execute)) {
    $CommentDate = $DataRows["datetime"];
    $CommenterName = $DataRows["name"];
    $Comments = $DataRows["comment"];

    ?>
                <div class="CommentsBlock">
                    <img style="margin-top:15px; margin-right:15px;" class="pull-left" src="images/image.jpg"
                        width=70px; height=70px;>
                    <p class="Comment-info"><?php echo $CommenterName; ?></p>
                    <p class="description"><?php echo $CommentDate; ?></p>
                    <p class="comment"><?php echo nl2br($Comments); ?></p>
                </div>
                <hr>
                <?php }?>
                <br><br>
                <br><br>
                <span class="FeildInfo" style="font-weight: bold; color:brown">Share your Thoughts About This
                    Post</span>
                <br><br>
                <br><br>
                <div>
                    <form action="fullPost.php?id=<?php echo $PostId; ?>" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <label for="name"><span class="FeildInfo">Name</span></label>
                                <input class="form-control" type="text" name="Name" id="name" placeholder="Name">
                            </div>

                            <div class="form-group">
                                <label for="email"><span class="FeildInfo">Email</span></label>
                                <input class="form-control" type="email" name="Email" id="email" placeholder="Email">
                            </div>


                            <div class="form-group">
                                <label for="commentarea"><span class="FeildInfo">Comment</span></label>
                                <textarea class="form-control" name="Comment" id="commentarea"></textarea>
                            </div>
                            <br>
                            <input class="btn btn-primary" type="submit" name="Submit" value="Add Comment">
                            <br>
                            <br>
                        </fieldset>
                    </form>
                </div>

            </div>
            <div class="col-sm-offset-1 col-sm-3">
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
$ViewQuery = "SELECT * FROM category ORDER BY datetime desc";
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
$ViewQuery = "SELECT * FROM admin_panal ORDER BY datetime desc LIMIT 0,5";
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