<?php
session_start();
if(isset($_POST["logout"])){
    session_destroy();
    echo 1;
}
if(!isset($_SESSION["UserId"])){
    header("Location: login/login.php"); 
}


?>
