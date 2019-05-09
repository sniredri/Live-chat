<?php include_once('./db.php');
session_start();
$id=$_SESSION["UserId"];
$query="SELECT * FROM `users` WHERE user_id=$id";

if($result= mysqli_query($mysqli,$query)){
    while($row=mysqli_fetch_assoc($result)){
        echo "<u>Welcome ".$row["user_name"]."</u> ";
    }
}
?>