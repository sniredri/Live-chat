<?php include_once('./db.php');
session_start();
$query="SELECT * FROM `users`";
$myId=$_SESSION["UserId"];

if($result= mysqli_query($mysqli,$query)){
    while($row=mysqli_fetch_assoc($result)){
        if($row['user_id']==$myId){
            continue;
        }
        echo "<div class='user text-center' onclick='Options(".$row['user_id'].")'>
    <p class='font-weight-bold userName text-capitalize'>".$row['user_name']."</p>
</div>";

    }
}
?>


