<?php 
require_once("include/DB.php");
?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>

<?php 

if(isset($_POST["Submit"])){
    $Username =$_POST["UserName"];
    $Password =$_POST["Password"];
   
    
    if(empty($Username) || empty($Password)){
        $_SESSION["ErrorMessage"]="All Field Must be Filled Out !";
       Redirect_to("Login.php");

    }
    else{
       $Found_Account=Login_Attempt($Username,$Password);
       $_SESSION["User_ID"]=$Found_Account["id"];
       $_SESSION["Username"]=$Found_Account["username"];
       if($Found_Account){
        $_SESSION["successMessage"]="Welcome Back {$_SESSION["Username"]}";
        Redirect_to("dashboard.php");
       }else{
        $_SESSION["ErrorMessage"]="Invalid Username or Password";
        Redirect_to("Login.php");
 
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
    <title>Manage Admins</title>
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
<link href="https://fonts.googleapis.com/css2?family=Train+One&display=swap" rel="stylesheet">

</head>
<style>
.FeildInfo{
    color:#cfdac8;
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
    padding:10px;
    background-color: #39333b;
    border-top: 1px solid black;
    color: #eeeeee;
    text-align: center;

}
.main-heading{
    color: #cfdac8;
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

</style>
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




    <div class="container-fluid" style="min-height: calc(100vh - 4rem - 4rem);">
    <div class="row">

    
   
    
    <div class="col-sm-offset-4 col-sm-4">
    <br><br>

    <div><?php echo Message();
      echo successMessage();
    ?></div>

        <br><br>
    <h2 class="main-heading">Welcome Back !</h2> 
    <br><br>
    <div><?php echo Message();
      echo successMessage();
    ?></div>

    <div>
    <form action="Login.php" method="post">
    <fieldset>
    <div class="form-group">
        
    <label for="UserName"><span class="FeildInfo">User Name</span></label>
    <div class="input-group input-group-lg">
            <span class="input-group-addon">
            <i class="fas fa-user-tie"></i>
           </span>
    <input class="form-control" type="text" name="UserName" id="UserName" placeholder="User Name">
    </div>
    </div>
    <div class="form-group">
    <label for="Password"><span class="FeildInfo">Password</span></label>
    <div class="input-group input-group-lg">
    <span class="input-group-addon">
    <i class="fas fa-lock"></i>
           </span>
    <input class="form-control" type="password" name="Password" id="Password" placeholder="Password">
    </div>
    </div>
   
    <br>
    <input class="btn btn-info btn-block" type="submit" name="Submit" value="Login">
    <br>
    <br>
    </fieldset>
    </form>
    </div>
    
    </div><!--End of Main Area-->
    
    </div><!--End of Row-->
     </div><!--End of Container Fluid-->
     
    
</body>
</html>