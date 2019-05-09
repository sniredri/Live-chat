<?php include_once('./db.php');
if(isset($_POST["UserId"])){
    $userId=$_POST["UserId"];
    $query="DELETE FROM `users` WHERE  user_id =$userId";
    mysqli_query($mysqli,$query);
    $qurey2="DELETE FROM `conversations` WHERE user2_id =$userId OR user1_id=$userId";
    mysqli_query($mysqli,$qurey2);
    $qurey3 = "DELETE FROM `messages` WHERE user_id =$userId";
    mysqli_query($mysqli,$qurey3);
    echo 1;
}
else{
    echo 2; 
}



?>