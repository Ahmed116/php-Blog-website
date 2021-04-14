<?php
require_once "include/DB.php";
?>
<?php require_once "include/Sessions.php";?>
<?php require_once "include/Functions.php";?>
<?php Confirm_Login();?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
   <!-- Latest compiled and minified CSS -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/adminstyles.css">
<link href="https://fonts.googleapis.com/css2?family=Train+One&display=swap" rel="stylesheet">

<style>

.navbar-nav li{
    font-weight: bold;
    font-family:bitter,Georgia, 'Times New Roman', Times, serif;
    font-size:1.1em;
}
body{
    background-image: url("https://i.pinimg.com/564x/9f/9f/e6/9f9fe69eebcd03462913b049c3082767.jpg");
}

.col-sm-10{
    background-color:#cfdac8;
}
#side-menu a{
color:#c1c78f ;
}

#side-menu .active a{
    color: antiquewhite;
    background-color:#78c5b6;
    font-weight:bold;
}
#side-menu a:hover{
    color: #ffffff;
    background-color: #78c5b6;
    font-weight: bold;
    display: block;
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

footer{
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


    <div class="container-fluid" style="min-height: calc(100vh - 4rem - 4rem);">
    <div class="row">


    <div class="col-sm-2">
        <br><br>

    <ul id="side-menu" class="nav nav-pills nav-stacked">
    <li><a href="dashboard.php"><i class="fas fa-th"></i> Dashboard</a></li>
    <li><a href="addNewPost.php"><i class="far fa-plus-square"></i> Add New Post</a></li>
    <li><a href="categories.php"><i class="fas fa-tags"></i> Categories</a></li>
    <li><a href="Admins.php"><i class="fas fa-users-cog"></i> Manage Admins</a></li>
    <li class="active"><a href="Comments.php"><i class="fas fa-comments"></i> Comments</a></li>
    <li><a href="#"><i class="fas fa-cubes"></i> Live Blog</a></li>
    <li><a href="Logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>




    </ul>

    </div>
    <!--End of Side Area-->
    <div class="col-sm-10"><!-- Main Area -->
    <div><?php echo Message();
echo successMessage();
?></div>
    <h1>Un-Approved Comments</h1>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr>
                <th>NO.</th>
                <th>Name</th>
                <th>Date</th>
                <th>Comment</th>
                <th>Approve</th>
                <th>Delete Comment</th>
                <th>Details</th>
            </tr>
            <?php
$SrNO = 0;
$Query = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
$Execute = mysqli_query($GLOBALS["db"], $Query);
while ($DataRows = mysqli_fetch_array($Execute)) {
    $CommentId = $DataRows['id'];
    $DateTimeOfComment = $DataRows['datetime'];
    $PersonName = $DataRows['name'];
    $PersonComment = $DataRows['comment'];
    $ComentedPostID = $DataRows['admin_panal_id'];
    $SrNO++;
    if (strlen($PersonName) > 10) {$PersonName = substr($PersonName, 0, 10) . "...";}
    ?>

            <tr>
                <td><?php echo $SrNO; ?></td>
                <td style="color:darkblue; font-weight: bold"><?php echo $PersonName; ?></td>
                <td><?php echo $DateTimeOfComment; ?></td>
                <td><?php echo $PersonComment; ?></td>
                <td><a href="ApproveComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-success">Approve</span></a></td>
                <td><a href="DeleteCommments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-danger">Delete</span></a></td>
                <td><a href="fullPost.php?id=<?php echo $ComentedPostID; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
            </tr>
                <?php }?>
        </table>
    </div>

    <h1>Approved Comments</h1>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr>
                <th>NO.</th>
                <th>Name</th>
                <th>Date</th>
                <th>Comment</th>
                <th>Approved BY</th>
                <th>Approved BY</th>
                <th>Revert Approve</th>
                <th>Delete Comment</th>
                <th>Details</th>
            </tr>
            <?php
$SrNO = 0;
$Query = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
$Execute = mysqli_query($GLOBALS["db"], $Query);
while ($DataRows = mysqli_fetch_array($Execute)) {
    $CommentId = $DataRows['id'];
    $DateTimeOfComment = $DataRows['datetime'];
    $PersonName = $DataRows['name'];
    $PersonComment = $DataRows['comment'];
    $ApprovedBY = $DataRows['approvedby'];
    $ComentedPostID = $DataRows['admin_panal_id'];
    $SrNO++;
    if (strlen($PersonName) > 10) {$PersonName = substr($PersonName, 0, 10) . "...";}
    ?>

            <tr>
                <td><?php echo $SrNO; ?></td>
                <td style="color:darkblue; font-weight: bold"><?php echo $PersonName; ?></td>
                <td><?php echo $DateTimeOfComment; ?></td>
                <td><?php echo $PersonComment; ?></td>
                <td><?php echo $ApprovedBY; ?></td>
                <td><a href="DisApproveComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-warning">Dis-Approve</span></a></td>
                <td><a href="DeleteCommments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-danger">Delete</span></a></td>
                <td><a href="fullPost.php?id=<?php echo $ComentedPostID; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
            </tr>
                <?php }?>
        </table>
    </div>


    </div><!--End of Main Area-->

    </div><!--End of Row-->
     </div><!--End of Container Fluid-->

      <!-- Footer -->
  <footer class="page-footer font-small cyan darken-3">

<!-- Footer Elements -->
<div class="container">

  <!-- Grid row-->
  <div class="row">

    <!-- Grid column -->
    <div class="col-md-12 py-5" >
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