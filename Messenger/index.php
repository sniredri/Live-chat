<?php
include_once('./db.php');
include_once('./session.php');
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <meta charset="UTF-8">
        <title>Whatsapp</title>
    </head>
    <body>

        <header>
            <div class="row rowHeader">

                <div class="col-md-2 offset-md-1">

                    <h2 style="color:green"><i style="color:green;" class="fab fa-whatsapp"></i>   Whatsapp</h2>

                </div>
                <div class="col-md-2 offset-md-7" style="padding:5px">
                    <button type="btn btn-btn-logout" class="btn btn-light" onclick="logout()">Logout</button>
                </div>
            </div>
        </header>

        <section>

            <div class="chatStyle">
                <div style="height:10px"></div>'
                <div id="chat">
                    <div><center><h1><u>Welcome to <span style="color:green;">whatsapp</span></u></h1> <br><br><h3>pleas choose friend to talk with</h3> </center></div>
                </div>
            </div>
            <div style="height:20px; background-color:silver"></div>
            <div class="row d-flex justify-content-around " style="background-color:silver;">
                <span>
                    <textarea id="textarea" style="border-radius: 10px;" rows="5" cols="150">
                    </textarea>
                </span>

                <span class="sendButton" >
                    <button onclick="insert()" style="border-radius: 5px;">Send</button>
                </span>
            </div>

            <div class="usersStyle" >
                <div><h2><u>Friends</u> :</h2></div>
                <div class="row d-flex justify-content-around" id="users"></div>
            </div>

        </section>

        <footer>
            <div class="row rowFooter">
                <div class="col-md-7 offset-md-5"><h2>Created by Snir</h2></div>
            </div>
        </footer>

    </body>
</html>
<script>
    var user2=0;

    $(document).ready(function(){
        loadUsers();
        window.setInterval(function(){if(user2){loadChat(user2);}},2000);

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
            url:"loadUsers.php",
        }).done(function(data){
            $('#users').html(data);
        })
    }
    function loadChat(user2Id){
        $.ajax({
            url:"loadChat.php",
            data:{user2:user2Id},
            method:'POST',
        }).done(function(data){
            $('#chat').html(data);
            user2=user2Id;
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