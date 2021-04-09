<?php 
session_start();

function Message(){
    if(isset($_SESSION["ErrorMessage"])){
        $result="<div class=\"alert alert-warning\">".htmlentities($_SESSION["ErrorMessage"])."</div>";
        $_SESSION["ErrorMessage"]=null;
        return $result;
    }
}

function successMessage(){
    if(isset($_SESSION["successMessage"])){
        $result="<div class=\"alert alert-success\">".htmlentities($_SESSION["successMessage"])."</div>";
        $_SESSION["successMessage"]=null;
        return $result;
    }
}


?>