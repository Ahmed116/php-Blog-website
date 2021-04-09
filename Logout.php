<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>

<?php 

$_SESSION["User_ID"]=null;
session_destroy();
Redirect_to("Login.php");

?>