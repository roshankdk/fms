<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Admin | Blog Site</title>
    <?php include('./header.php'); ?>
    <?php 
    session_start();
    if(isset($_SESSION['login_id']))
    header("location:index.php?page=home");
    ?>
    <style>
        body {
            width: 100%;
            height: 100vh; /* Use full viewport height */
            margin: 0; /* Remove default body margin */
            display: flex; /* Enable Flexbox on body */
            align-items: center; /* Center vertically */
            justify-content: center; /* Center horizontally */
            background-color: #f8f9fa; /* Light background color */
        }

        main#main {
            width: 100%;
            height: 100%;
            background: white;
            display: flex; /* Use Flexbox on main */
            align-items: center; /* Center vertically within main */
            justify-content: center; /* Center horizontally within main */
        }

        #login {
            border: 2px solid rgb(62, 57, 57);
            width: 60%;
            max-width: 500px; /* Limit max width for better design */
            padding: 20px; /* Add padding for some space around content */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.8); /* Subtle shadow for depth */
            background-color: white; /* Ensure background is white */
        }

        .logo {
            margin: auto;
            font-size: 8rem;
            padding: .5em 0.8em;
            color: #000000b3;
        }

        h4.dark.text-center {
            margin-bottom: 20px; /* Add some margin below heading */
        }

        .btn-success {
            background-color: #28a745; /* Custom green button */
            color: white; /* White text */
            border: none; /* Remove border */
        }
    </style>
</head>

<body>
    <main id="main" class="alert-info">
        <div id="login">
            <div class="">
                <h4 class="dark text-center"><b>File Management System</b></h4>
                <div class="card col-md-12">
                    <div class="card-body">
                        <form id="login-form">
                            <div class="form-group">
                                <label for="username" class="control-label dark">Username</label>
                                <input type="text" id="username" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label dark">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <center><button class="btn-sm btn-block btn-wave col-md-4 btn-success">Login</button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
</body>

<script>
    $('#login-form').submit(function (e) {
        e.preventDefault()
        $('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
        if ($(this).find('.alert-danger').length > 0)
            $(this).find('.alert-danger').remove();
        $.ajax({
            url: 'ajax.php?action=login',
            method: 'POST',
            data: $(this).serialize(),
            error: err => {
                console.log(err)
                $('#login-form button[type="button"]').removeAttr('disabled').html('Login');

            },
            success: function (resp) {
                if (resp == 1) {
                    location.reload('index.php?page=home');
                } else {
                    $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
                    $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
                }
            }
        })
    })
</script>

</html>
