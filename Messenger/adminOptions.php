<?php include_once('./db.php');
if(isset($_POST["UserId"])){
    $userId=$_POST["UserId"];
}
$query="SELECT * FROM `users`WHERE user_id =$userId";
if($result= mysqli_query($mysqli,$query)){
    while($row=mysqli_fetch_assoc($result)){
        echo "<p class=font-weight-bold> User id: ".$row["user_id"]."</p>";
        echo "<p class=font-weight-bold> User Name: ".$row["user_name"]."</p>";
        echo "<p class=font-weight-bold> User password: ".$row["user_password"]."</p>";
        echo "<div class=deleteBtn>To delete This User Click Here: <button onclick=deleteFun(".$row["user_id"].")>delete</button></div><br><br>";
        echo "<u>change user name: </u>  <input onchange=ChangeFun(event,'userName') />";
        echo "<br>";
        echo "<br>";
        echo "<u>change password:</u>  <input onchange=ChangeFun(event,'password') /><br><br>";
        echo "<form>
            <input type=radio name=Admin value=0 onchange=ChangeFun(event,'Admin')> not admin <br>
            <input type=radio name=Admin value=1 onchange=ChangeFun(event,'Admin')> make user admin <br>
          </form>";

        echo "<button onclick=submitFun(".$row["user_id"].")>submit</button><br><br>";
    }
}

?>