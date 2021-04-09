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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" href="css/publicstyles.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Train+One&display=swap" rel="stylesheet">

<style>
 body{
     background-color:#39333b;
    }
.imageicon{
    max-width: 150px;
    margin: 0 auto;
    display: block;
}

.description{
    color: #868686;
    font-weight: bold;
    margin-top:-2px;
}

.background{
    background-color:#f6f7f9;
}

.navbar-heading{
    font-family: 'Train One', cursive;
    font-size:3.5rem;
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
.blog-header{
    font-family:'Ultra', serif;
    font-weight: bold;

}

.blog-header h1{
    background-image: url(https://media.giphy.com/media/26BROrSHlmyzzHf3i/giphy.gif);
	background-size: cover;
	color: transparent;
	-moz-background-clip: text;
	-webkit-background-clip: text;
	text-transform: uppercase;

}

.test:hover {
  font-size: 0;
}

.test:hover:before {
  font-size: 35px;
  content: attr(data-hover);

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

<div class="container" style="min-height: calc(100vh - 4rem - 4rem);"><!--Container-->
<div class="blog-header text-center">
    <br><br>
<h1 class="test" data-hover="Share Your Thoughts" >Read Our Blogs</h1>
<br>
</div>
<br>
<div class="row"><!--Row-->
<div class="col-sm-8"><!-- Main Blog area -->
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
<p>Category: <?php echo htmlentities($Category) . "  " . "-"; ?> published on <?php echo htmlentities($DateTime); ?>

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
<a href="fullPost.php?id=<?php echo $PostId; ?>"><span class="btn btn-info" >Read More &rsaquo;&rsaquo;</span></a>
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

</div> <!--Ending of Main Area-->

<!-- Side Area -->
<div class="col-sm-offset-1 col-sm-3" style="background-color:#f6f7f9">
<h2 class="text-center">About Us</h2>
<br>
<img class="img-responsive img-circle imageicon" src="images/about.jpg">
<br>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, quam fuga fugit reprehenderit exercitationem odit nobis voluptatibus facilis tenetur non ratione molestias minus maxime sed veritatis optio a quibusdam rerum, illo dicta consequuntur, neque sint placeat. Error veritatis earum, vel delectus recusandae rem magni non deleniti molestiae, facilis architecto porro.</p>
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
    if(strlen($DateTime>25)){$DateTime=substr($DateTime,0,25);}
    ?>
    <div>
        <img class="pull-left" style="margin-top:10px; margin-left:10px" src="Upload/<?php echo htmlentities($Image);?>" width="70px"; height="70px">
       <a href="fullPost.php?id=<?php echo $ID;?>"><p class="heading" style="margin-left:90px"><?php echo htmlentities($Title);?></p></a>
        <p class="description" style="margin-left:90px"><?php echo htmlentities($DateTime)."<hr>";?></p>
    </div>

        <?php }?>
    </div>
    <div class="panel-footer">

    </div>
</div>
</div><!-- End of side Area -->


</div><!-- End of Row -->
</div><!-- end of Container -->


<footer id="footer" style="padding:10px;
    background-color: #39333b;
    border-top: 1px solid black;
    color: #eeeeee;
    text-align: center;">
<hr><p>  | Ahmed Hilles | &copy;2021 ---- All rights reserved</p>
</footer>
     <div style="height:5px; background:#27aae1"></div>

</body>
</html>