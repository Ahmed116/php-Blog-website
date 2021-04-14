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
    $Admin="Ahmed Hilles";
    $Image=$_FILES["Image"]["name"];
    $Target="Upload/".basename($_FILES["Image"]["name"]);
 
        $DeleteFromURL=$_GET['Delete'];
        $Query ="DELETE FROM admin_panal WHERE id='$DeleteFromURL'";
        $Execute =mysqli_query($GLOBALS["db"],$Query);
        move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
        if($Execute){
            $_SESSION["successMessage"]="Post Deleted Successfully";
            Redirect_to("dashboard.php");
        }else{
            $_SESSION["errorMessage"]="Something Went Wrong Try Again !";
            Redirect_to("dashboard.php");
        }
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Post</title>
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

footer{
   background-image: url("https://i.pinimg.com/564x/9f/9f/e6/9f9fe69eebcd03462913b049c3082767.jpg");

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
    <li><a href="#"><i class="fas fa-users-cog"></i> Manage Admins</a></li>
    <li><a href="#"><i class="fas fa-comments"></i> Comments</a></li>
    <li><a href="#"><i class="fas fa-cubes"></i> Live Blog</a></li>
    <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    
    
    
    
    </ul>

    </div>
    <!--End of Side Area-->
    <div class="col-sm-10">
    <h1>Delete Post</h1>
    <div><?php echo Message();
      echo successMessage();
    ?></div>

    <div>
        <?php 
        $SearchQuery =$_GET['Delete'];
        $Query = "SELECT * FROM admin_panal WHERE id='$SearchQuery'";
        $ExecuteQuery = mysqli_query($GLOBALS["db"], $Query);
        while($DataRows=mysqli_fetch_array($ExecuteQuery)){
            $TitleToBeUpdated=$DataRows['title'];
            $CategoryToBeUpdated=$DataRows['category'];
            $ImageToBeUpdated=$DataRows['image'];
            $PostToBeUpdated=$DataRows['post'];
        }

        ?>
    <form action="DeletePost.php?Delete=<?php echo $SearchQuery ;?>" method="post" enctype="multipart/form-data">
    <fieldset>
    <div class="form-group">
    <label for="title"><span class="FeildInfo">Title</span></label>
    <input disabled value="<?php echo $TitleToBeUpdated;?>"class="form-control" type="text" name="Title" id="title" placeholder="Title">
    </div>
    <div class="form-group">
        <span class="FeildInfo">Existing Category</span>
        <?php echo $CategoryToBeUpdated;?>
        <br>
    <label for="categoryselect"><span class="FeildInfo">Category</span></label>
    <select disabled class="form-control" id="categoryselect" name="Category">
    
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
    <span class="FeildInfo">Existing Image</span>
      <img src="Upload/<?php echo  $ImageToBeUpdated;?>" width="170px"; height="70px">
        <br>
    <label for="imageselect"><span class="FeildInfo">Select Image</span></label>
    <input disabled type="File" class="form-control" name="Image" id="imageselect">
    </div>
    <div class="form-group">
    <label for="postarea"><span class="FeildInfo">Post</span></label>
    <textarea disabled class="form-control" name="Post" id="postarea"><?php echo $PostToBeUpdated; ?></textarea>
    </div>
    <br>
    <input class="btn btn-danger btn-block" type="submit" name="Submit" value="Delete Post">
    <br>
    <br>
    </fieldset>
    </form>
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