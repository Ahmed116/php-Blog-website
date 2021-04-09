<?php require_once("include/Sessions.php")?>
<?php require_once("include/Functions.php")?>
<?php require_once("include/DB.php")?>


<?php 
if(isset($_GET["id"])){
    $idFromURL = $_GET["id"];
    $Query="UPDATE comments SET status='OFF' WHERE id='$idFromURL'";
    $Execute =mysqli_query($GLOBALS["db"],$Query);
    if($Execute){
        $_SESSION["successMessage"]="Comment Dis-Approved Successfully";
        Redirect_to("Comments.php");
    }else{
        $_SESSION["errorMessage"]="Somthing went wrong Try Again !";
        Redirect_to("Comments.php");
}
}
?>