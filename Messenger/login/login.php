
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="login.css">
        <title>login</title>
    </head>
    <body>
        <div id="login">
            <h3 class="text-center text-white pt-5">Welcome</h3>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="" method="post">
                                <h3 class="text-center text-info">Login</h3>
                                <div class="form-group">
                                    <label for="UserId" class="text-info">User Id:</label><br>
                                    <input type="text" name="UserId" id="UserId" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Password:</label><br>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <br>
                                    <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                                </div>
                                <div id="register-link" class="text-right">
                                    <a href="http://localhost/whatsapp/register.php">Register here</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>

        $(document).ready(function(){
            $('form').on('submit',function(event){
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url:'../authentication/auth',
                    data: formData,
                    method: 'POST'
                }).done(function(data){
                    if(data=="Admin"){
                        window.location.href = "http://localhost/whatsapp/adminState.php";
                    }
                    if(data=="NoAdmin"){
                        window.location.href = "http://localhost/whatsapp/index.php";
                    }
                    if(data==0){
                        alert("please make sure your id or password are corract");
                    }


                })
            })
        }); 

    </script>
</html>