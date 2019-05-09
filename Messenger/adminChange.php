<?php include_once('./db.php');
if(isset($_POST["admin"])){
    $admin=$_POST["admin"];
}

if(isset($_POST["userName"])){
    $userName=$_POST["userName"];
}
if(isset($_POST["password"])){
    $password=$_POST["password"];
}
if(isset($_POST["userId"])){
    $userId=$_POST["userId"];
}
if(!empty($userName)&&!empty($password)&&$admin!=null){
    $query ="UPDATE `users` SET `user_name`='$userName',`user_password`='$password',`authorization`=$admin WHERE user_id=$userId";
    mysqli_query($mysqli,$query);
    echo 0;
}
else if(!empty($userName)){
    $query ="UPDATE `users` SET `user_name`='$userName' WHERE user_id=$userId";
    mysqli_query($mysqli,$query);
    echo 1;
}
else if(!empty($password)){
    $query= "UPDATE `users` SET `user_password`='$password' WHERE user_id=$userId";
    mysqli_query($mysqli,$query);
    echo 2;
}else if(!empty('$admin')){
    $query= "UPDATE `users` SET `authorization`=$admin WHERE user_id=$userId";
    mysqli_query($mysqli,$query);
    echo 3;
}
else{
    echo 4;
}


?>