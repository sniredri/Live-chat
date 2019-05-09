<?php
include_once('./db.php');
include_once('./session.php');
if(!isset($_SESSION["Admin"])){
    header("Location: login/login.php"); 
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <head>
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
            <link rel="stylesheet" href="adminState.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


            <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

            <!-- Popper JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

            <!-- Latest compiled JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

        </head>
        <meta charset="UTF-8">
        <title>Admin-State</title>
    </head>
    <body>
        <header>
            <div class="row rowHeader">
                <div class="col-md-2 offset-md-1">
                    <h1 style="color:white">Admin State</h1>
                </div>
                <div class="col-md-2 offset-md-7" style="padding:5px">
                    <button type="btn btn-btn-logout" class="btn btn-light" onclick="logout()">Logout</button>
                </div>
            </div>
        </header>
        <br>
        <section>
            <div class="adminNameStyle">
                <center>
                    <p id="adminName" class="adminName"> 
                    </p>
                </center>
            </div>
            <div class="addUserStyle">
                <h3><u>To add User click here :</u></h3><button onclick=addUserFun()> Add User</button><br><br>
                <div id="AddUser">

                </div>
            </div>
            <div class="usersStyle" >
                <center><h2><u>Users to Edit</u> :</h2></center>
                <br>
                <div class="row d-flex justify-content-around" id="users"></div>
            </div>
            <center id="UserOptions">
            </center>
            <div> <h2>admin Chat:</h2>
                <div id="adminChat">
                    <div><center><h1><u>Welcome to <span style="color:green;">admin Chat</span></u></h1> <br><br><h3>pleas choose user to talk with</h3> </center></div>

                </div>
                <div class="row d-flex justify-content-around" style="background-color:silver;">
                    <span><textarea class="textBorder" placeholder="Write something down here....."id="textarea" style="border-radius: 10px;" rows="5" cols="50"></textarea>
                    </span>
                    <span class="sendButton" >
                        <button onclick="insert()" style="border-radius: 5px;">Send</button>
                    </span>
                </div>
            </div>
            <br>
            <div id="users2"></div>

        </section>

        <footer>
            <div class="row rowFooter">
                <div style="color:white" class="col-md-7 offset-md-5"><h2>Created by Snir</h2></div>
            </div>
        </footer>
    </body>
</html>
<script>
    var user2=0;
    var admin=0;
    var newUserName;
    var newPassword;
    var userName;
    var password;
    var showuser=1;
    var showAddUser=1;
    $(document).ready(function(){
        window.setInterval(function(){if(user2){loadChat(user2);}},2000);
        loadUsers2();
        adminName();
        loadUsers();
        $('#UserOptions').hide();
    });
    function logout(){
        $.ajax({
            url:'session.php',
            data:{logout:"logout"},
            method:'POST'
        }).done(function(data){
            if(data == 1){
                window.location.href="http://localhost/whatsapp/login/login.php";
            }
        })
    }
    function loadUsers(){
        $.ajax({
            url:"loadUsersForAdmin.php",
        }).done(function(data){
            $('#users').html(data);
        })
    }
    function Options(UserId){
        if(showuser){
            $('#UserOptions').show();
            showuser=!showuser;
        }
        else{
            $('#UserOptions').hide();
            showuser=!showuser;
        }

        $.ajax({
            url:"adminOptions.php",
            data:{UserId:UserId},
            method:"POST",
        }).done(function(data){
            $('#UserOptions').html(data);
        })
    }
    function deleteFun(UserId){
        $.ajax({
            url:"adminDelete.php",
            data:{UserId:UserId},
            method:"POST",
        }).done(function(data){
            if(data==1){
                alert("SUCCES!! :)");
                loadUsers();
                loadUsers2();
                $('#UserOptions').hide();
                showuser=!showuser;
            }
            if(data==2){
                alert("Not SUCCES!! :(");
            }
        })
    }
    function ChangeFun(event,eNum){
        if(eNum=="password"){
            password=event.target.value
        }
        if(eNum=="userName"){
            userName=event.target.value;
        }
        if(eNum=="Admin"){
            admin=event.target.value;
        }
    }

    function submitFun(userId){
        if(userName && password&& (admin!=null)){
            $.ajax({
                url:"adminChange.php",
                data:{userName:userName,password:password,admin:admin,userId:userId},
                method:"POST"
            }).done(function(data){
                if(data==0){
                    alert("SUCCES!! User name and password Changed ")
                    loadUsers();
                    $('#UserOptions').hide();
                    userName=null;
                    password=null;
                    admin=null;
                    showuser=!showuser;

                }

            })
        }

        else if(userName)
        {
            $.ajax({
                url:"adminChange.php",
                data:{userName:userName,userId:userId},
                method:"POST"
            }).done(function(data){
                if(data==1){ 
                    alert("SUCCES!! User name Changed ")
                    loadUsers();
                    $('#UserOptions').hide();
                    userName=null;
                    showuser=!showuser;

                }
            })
        }
        else if(password){
            $.ajax({
                url:"adminChange.php",
                data:{password:password,userId:userId},
                method:"POST"
            }).done(function(data){
                if(data==2){
                    alert("SUCCES!! password Changed")
                    loadUsers();
                    $('#UserOptions').hide();
                    password=null;
                    showuser=!showuser;

                }
            })
        }
        else if(admin){
            $.ajax({
                url:"adminChange.php",
                data:{admin:admin,userId:userId},
                method:"POST"
            }).done(function(data){
                if(data==3){
                    alert("SUCCES!! admin Changed")
                    loadUsers();
                    $('#UserOptions').hide();
                    admin=0;
                    showuser=!showuser;

                }
            })
        }
        else alert(Error);
    }
    function addUserFun(){
        if(showAddUser){
            $('#AddUser').show();
            showAddUser=!showAddUser;
        }
        else{
            $('#AddUser').hide();
            showAddUser=!showAddUser;
        }
        $.ajax({
            url:"adminAddUser.php",
            method:"POST"
        }).done(function(data){
            $('#AddUser').html(data);
            loadUsers2();
        })
    }

    function newUserData(event,eNum){
        if(eNum=="userName"){
            newUserName=event.target.value;
        }
        if(eNum=="password"){
            newPassword=event.target.value;
        }
    }
    function addnewUserFun(){
        if(!newUserName){
            alert("please insert user name");
            return;
        }
        else if(!newPassword){
            alert("please insert password ");
            return
        }
        else{
            $.ajax({
                url:"addNewUser.php",
                data:{newUserName:newUserName,newPassword:newPassword},
                method:"POST",
            }).done(function(data){
                if(data==1){
                    alert("SUCCES Your User Was added");
                    loadUsers();
                    loadUsers2();
                    $('#AddUser').hide();
                    showAddUser=!showAddUser;

                }
                else{
                    alert("Not SUCCES");
                }
            })

        }
    }
    function adminName(){
        $.ajax({
            url:"adminName.php",
        }).done(function(data){
            $('#adminName').html(data);
        })
    }

    function loadChat(user2Id){
        $.ajax({
            url:"loadChat.php",
            data:{user2:user2Id},
            method:'POST',
        }).done(function(data){
            $('#adminChat').html(data);
            user2=user2Id;
        })
    }
    function loadUsers2(){
        $.ajax({
            url:"loadUsers.php",
        }).done(function(data){
            $('#users2').html(data);
        })
    }
    function insert(){
        var textData=document.getElementById("textarea").value;
        $.ajax({
            url:'insert.php',
            method:"POST",
            data:{textData:textData,user2:user2},
        }).done(function(data){
            $('#textarea').val('');
        })

    }



</script>