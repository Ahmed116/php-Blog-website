<?php 
require_once("include/DB.php");
?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php Confirm_Login();?>


<?php 

if(isset($_POST["Submit"])){
    $Title =$_POST["Title"];
    $Category =$_POST["Category"];
    $Post =$_POST["Post"];
    date_default_timezone_set("Asia/Gaza");
    $CurrentTime=date("F j, Y, g:i a"); 
    $CurrentTime;
    $Admin=$_SESSION["Username"];
    $Image=$_FILES["Image"]["name"];
    $Target="Upload/".basename($_FILES["Image"]["name"]);
    if(empty($Title)){
        $_SESSION["ErrorMessage"]="Title Cannot be empty !";
       Redirect_to("addNewPost.php");

    }elseif(strlen($Title)<2){
        $_SESSION["ErrorMessage"]="Title Should be at least 2 characters";
        Redirect_to("addNewPost.php");

    }else{
        $Query ="INSERT INTO admin_panal(datetime,title,category,auther,image,post)
         VALUES('$CurrentTime','$Title','$Category','$Admin','$Image','$Post')";
        $Execute =mysqli_query($GLOBALS["db"],$Query);
        move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
        if($Execute){
            $_SESSION["successMessage"]="Post Added Successfully";
            Redirect_to("addNewPost.php");
        }else{
            $_SESSION["errorMessage"]="Something Went Wrong Try Again !";
            Redirect_to("addNewPost.php");
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
    <title>Add New Post</title>
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
    <li  class="active"><a href="addNewPost.php"><i class="far fa-plus-square"></i> Add New Post</a></li>
    <li><a href="categories.php"><i class="fas fa-tags"></i> Categories</a></li>
    <li><a href="Admins.php"><i class="fas fa-users-cog"></i> Manage Admins</a></li>
    <li><a href="Comments.php"><i class="fas fa-comments"></i> Comments</a></li>
    <li><a href="#"><i class="fas fa-cubes"></i> Live Blog</a></li>
    <li><a href="Logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    
    
    
    
    </ul>

    </div>
    <!--End of Side Area-->
    <div class="col-sm-10">
    <h1>Add New Post</h1>
    <div><?php echo Message();
      echo successMessage();
    ?></div>

    <div>
    <form action="addNewPost.php" method="post" enctype="multipart/form-data">
    <fieldset>
    <div class="form-group">
    <label for="title"><span class="FeildInfo">Title</span></label>
    <input class="form-control" type="text" name="Title" id="title" placeholder="Title">
    </div>
    <div class="form-group">
    <label for="categoryselect"><span class="FeildInfo">Category</span></label>
    <select class="form-control" id="categoryselect" name="Category">
    
    <?php 
    $ViewQuery = "SELECT * FROM category ORDER BY datetime desc";
    $Execute = mysqli_query($GLOBALS["db"], $ViewQuery);
    while($DataRows=mysqli_fetch_array($Execute)){
        $id=$DataRows["id"];
        $CategoryName=$DataRows["name"];
    
    ?>
    <option><?php echo $CategoryName?></option>
    <?php }?>
    
    
    
    </select>
    </div>
    <div class="form-group">
    <label for="imageselect"><span class="FeildInfo">Select Image</span></label>
    <input type="File" class="form-control" name="Image" id="imageselect">
    </div>
    <div class="form-group">
    <label for="postarea"><span class="FeildInfo">Post</span></label>
    <textarea class="form-control" name="Post" id="postarea"></textarea>
    </div>
    <br>
    <input class="btn btn-info btn-block" type="submit" name="Submit" value="Add New Post">
    <br>
    <br>
    </fieldset>
    </form>
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