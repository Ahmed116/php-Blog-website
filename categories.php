<?php
require_once "include/DB.php";
?>
<?php require_once "include/Sessions.php";?>
<?php require_once "include/Functions.php";?>
<?php Confirm_Login();?>


<?php

if (isset($_POST["Submit"])) {
    $Category = $_POST["Category"];
    date_default_timezone_set("Asia/Gaza");
    $CurrentTime = date("F j, Y, g:i a");
    $CurrentTime;
    $Admin = $_SESSION["Username"];
    if (empty($Category)) {
        $_SESSION["ErrorMessage"] = "All Field Must be Filled Out !";
        Redirect_to("categories.php");

    } elseif (strlen($Category) > 99) {
        $_SESSION["ErrorMessage"] = "Too Long Name for Category";
        Redirect_to("categories.php");

    } else {
        $Query = "INSERT INTO category(datetime,name,creatorname) VALUES('$CurrentTime','$Category','$Admin')";
        $Execute = mysqli_query($GLOBALS["db"], $Query);
        if ($Execute) {
            $_SESSION["successMessage"] = "Category Added Successfully";
            Redirect_to("categories.php");
        } else {
            $_SESSION["errorMessage"] = "Category Filled to Add";
            Redirect_to("categories.php");
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
    <title>Manage Categories</title>
   <!-- Latest compiled and minified CSS -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<link rel="stylesheet" href="css/adminstyles.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

</head>
<style>
.FeildInfo{
    color: #294987;
    font-family:Bitter,Georgia, 'Times New Roman', Times, serif;
    font-size: 1.2em;
}

.navbar-nav li{
    font-weight: bold;
    font-family:bitter,Georgia, 'Times New Roman', Times, serif;
    font-size:1.1em;
}
.line{
    margin-top:-20px;
}


body{
    background-color:#042C30;
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

footer{
    padding:10px;
    background-color: #39333b;
    border-top: 1px solid black;
    color: #eeeeee;
    text-align: center;

}

</style>
<body>
    <div class="container-fluid" style="min-height: calc(100vh - 4rem - 4rem);">
    <div class="row">


    <div class="col-sm-2">
    <ul id="side-menu" class="nav nav-pills nav-stacked">
    <li ><a href="dashboard.php"><i class="fas fa-th"></i> Dashboard</a></li>
    <li><a href="addNewPost.php"><i class="far fa-plus-square"></i> Add New Post</a></li>
    <li class="active"><a href="categories.php"><i class="fas fa-tags"></i> Categories</a></li>
    <li><a href="Admins.php"><i class="fas fa-users-cog"></i> Manage Admins</a></li>
    <li><a href="Comments.php"><i class="fas fa-comments"></i> Comments</a></li>
    <li><a href="#"><i class="fas fa-cubes"></i> Live Blog</a></li>
    <li><a href="Logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>




    </ul>

    </div>
    <!--End of Side Area-->
    <div class="col-sm-10">
    <h1>Manage Categories</h1>
    <div><?php echo Message();
echo successMessage();
?></div>

    <div>
    <form action="categories.php" method="post">
    <fieldset>
    <div class="form-group">
    <label for="categoryname"><span class="FeildInfo">Name</span></label>
    <input class="form-control" type="text" name="Category" id="categoryname" placeholder="Name">
    </div>
    <br>
    <input class="btn btn-info btn-block" type="submit" name="Submit" value="Add New Category">
    <br>
    <br>
    </fieldset>
    </form>
    </div>
    <div class="table table-responsive">
     <table class="table table-striped table-hover">
      <tr>
       <th>Sr No.</th>
       <th>Date & Time</th>
       <th>Category Name</th>
       <th>Creator Name</th>
       <th>Action</th>
    </tr>
    <?php
$ViewQuery = "SELECT * FROM category ORDER BY id desc";
$Execute = mysqli_query($GLOBALS["db"], $ViewQuery);
$SrNo = 0;
while ($DataRows = mysqli_fetch_array($Execute)) {
    $id = $DataRows["id"];
    $DateTime = $DataRows["datetime"];
    $CategoryName = $DataRows["name"];
    $CreatorName = $DataRows["creatorname"];
    $SrNo++;

    ?>
    <tr>
    <td><?php echo $SrNo; ?></td>
    <td><?php echo $DateTime; ?></td>
    <td><?php echo $CategoryName; ?></td>
    <td><?php echo $CreatorName; ?></td>
    <td><a href="DeleteCategory.php?id=<?php echo $id; ?>"><span class="btn btn-danger">Delete</span></a></td>
    </tr>
    <?php }?>
    </table>
    </div>
    </div><!--End of Main Area-->

    </div><!--End of Row-->
     </div><!--End of Container Fluid-->

     <footer id="footer">
    <hr><p>  | Ahmed Hilles | &copy;2021 ---- All rights reserved</p>
     </footer>
     <div style="height:5px; background:#27aae1"></div>
</body>
</html>