<?php
include_once('./db.php');
session_start();
$myId=intval($_SESSION["UserId"]);
if(isset($_POST["user2"])){
    $user2=intval($_POST["user2"]);
    if($user2==$myId){
        die();
    }
}
$query="SELECT * FROM `conversations` WHERE (user1_id=$myId OR user2_id=$myId)";
$cov_id;
$right="text-align-right";
$left="text-align-left";
if($result=mysqli_query($mysqli,$query)){
    while($row=mysqli_fetch_assoc($result)){
        if(($row["user1_id"]==$myId||$row["user1_id"]==$user2)&&($row["user2_id"]==$myId||$row["user2_id"]==$user2)){
            $cov_id=$row["conversation_id"];
            $query="SELECT messages.*,users.* FROM `messages` JOIN `users` WHERE conversion_id=$cov_id AND users.user_id=messages.user_id ORDER BY messages_id";
            if($result=mysqli_query($mysqli,$query)){

                while($row=mysqli_fetch_assoc($result)){
                    if($myId==$row["user_id"]){
                        $style=$left;
                        $class="myUser col-md-2 offset-md-1";
                    }
                    else{
                        $style=$right;
                        $class="user2  col-md-2 offset-md-9";
                    }
                    $img=base64_encode($row["user_img"]);
                    echo '<div class="'.$class.'" style="'.$style.'">
                    <p class="text-capitalize font-weight-bold">'.$row["user_name"].'</p>
                    <p>'.$row["messages_body"].'</p>
                    <p style="font-size:13px">'.$row["messages_time"].'</p>
                    </div>
                    <div style="height:10px"></div>';
                }
            }
        }
    }
}

?>
