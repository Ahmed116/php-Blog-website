<?php require_once("include/DB.php");?>
<?php require_once("include/Sessions.php");?>


<?php 
function Redirect_to($New_Location) {
    header("Location:".$New_Location);
    exit();
}
    

function Login_Attempt($Username, $Password){
    $Query ="SELECT * FROM registration WHERE 
    username ='$Username' AND password ='$Password'";
    $Execute = mysqli_query($GLOBALS["db"], $Query);
    if($admin=mysqli_fetch_assoc($Execute)){
        return $admin;
    }else{
        return null;
    }
}

function Login(){
    if(isset($_SESSION["User_ID"])){
        return true;
    }
  }

  function Confirm_Login(){
      if(!Login()){
        $_SESSION["ErrorMessage"]="Login Required !";

          Redirect_to("Login.php");
      }
  }





?>