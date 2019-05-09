<?php include_once('./db.php');
session_start();
$myId=$_SESSION["UserId"];

if(isset($_POST["user2"])){
    $user2=$_POST["user2"];
}
if(isset($_POST["textData"])){
    $textData=$_POST["textData"];
}
$sql="SELECT conversation_id from `conversations` where user1_id = $myId and user2_id = $user2 OR user1_id = $user2 AND user2_id = $myId";
if($result=mysqli_query($mysqli,$sql)){
    if($row=mysqli_fetch_assoc($result)){
        $conv_id = $row['conversation_id'];
        $query = "INSERT INTO `messages`(messages_body, user_id, conversion_id) VALUES ('$textData',$myId,$conv_id)";
        mysqli_query($mysqli,$query);
    }
    else{
        $query = "INSERT INTO `conversations` (user1_id, user2_id) VALUES ($myId,$user2)";
        mysqli_query($mysqli,$query);
        $sql="SELECT conversation_id from `conversations` where user1_id = $myId and user2_id = $user2 OR user1_id = $user2 AND user2_id = $myId";
        if($result=mysqli_query($mysqli,$sql)){
            if($row=mysqli_fetch_assoc($result)){
                $conv_id = $row['conversation_id'];
                $query = "INSERT INTO `messages`(messages_body, user_id, conversion_id) VALUES ('$textData',$myId,$conv_id)";
                mysqli_query($mysqli,$query);
            }
            else{
                echo "ERROR";
            }
        }
    }
}

?>