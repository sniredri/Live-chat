<?php include_once('../db.php');
session_start();

$allSet = 1;
if(isset($_POST["UserId"])){
    $userId = $_POST["UserId"];
}
else{
    $allSet = 0; 
}
if(isset($_POST["password"])){
    $password = $_POST["password"];
}
else{
    $allSet = 0; 
}

if($allSet){
    $query = "SELECT * FROM `users` WHERE user_id = $userId ";
    if($result = mysqli_query($mysqli,$query)){

        $row = mysqli_fetch_assoc($result);
        if($row["user_password"] == $password){
            $_SESSION["UserId"] = $userId;
            if($row["authorization"]==1){
                $_SESSION["Admin"]=true;
                echo "Admin";
            }
            else{
                $_SESSION["Admin"]=false;
                echo "NoAdmin";
            }
        }
        else{
            echo '0'; // wrong 
        }
    }
}
?>