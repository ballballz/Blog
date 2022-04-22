<?php 
$PROFILE = null;
require_once("dbconnect.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/header.css">

    <title>Register</title>
</head>
<body>
    <?php include("header.php"); ?>
    <div class="container">
        <div class="control">
            <div class="register">
                <div class="control-register">
                    <h2>Sign up</h2>
                    <div class="alert">
                    <p>See your growth and get consulting support!</p>
                    <div class="gg-btn">
                        <i><img src="img/google_icon.png" width="15px" heigth="15px"></i>
                        <a href="#">Sign in with Google</a>
                    </div>
                    <div class="l-text"><span class="span-l">or Sign in with Email</span></div>
                    <div class="msg"></div>
                    <div id="form-register" >
                        <div class="form-group reg">
                            <label>Name*</label>
                            <input type="text" data-type="firstname" placeholder="Name">
                            <div class="regis-error"></div>
                        </div>
                        <div class="form-group reg">
                            <label>Email*</label>
                            <input type="email" data-type="email" placeholder="mail@website.com">
                            <div class="regis-error"></div>
                        </div>
                        <div class="form-group reg">
                            <label>Password*</label>
                            <input type="password" data-type="password" placeholder="Min. 8 character">
                            <div class="regis-error"></div>
                        </div>
                        <div class="form-group btn">
                            <input id="btn-register" type="submit" value="Register">
                        </div>
                        <div class="sign-in">
                            <p>Already have an Account? <a href="login.php">Sign in</a></p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="control-img">
            <img src="img/register-img.png" width="100%" heigth="100%">
        </div>
    </div>
<script src="js/register.js"></script>
<script src="js/header.js"></script>

</body>
</html>



