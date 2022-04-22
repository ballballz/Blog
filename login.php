<?php
$PROFILE = null;
session_start(); 
require_once("dbconnect.php");

if(isset($_SESSION['profile'])){
    header("Location: index.php");
}


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
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/header.css">

    <title>login</title>
</head>
<body>
<?php include("header.php") ?>
<div class="container">
    <div class="control">
    	<div class="login">
    		<div class="control-login">
                <h2>Login</h2>
                <p>See your growth and get consulting support!</p>
                <div class="gg-btn">
                    <i><img src="img/google_icon.png" width="15px" heigth="15px"></i>
                    <a href="#">Sign in with Google</a>
                </div>
                <div class="l-text"><span>or Sign in with Email</span></div>
                <div class="msg"></div>
    			<div id="form-login">
    				<div class="form-group log">
                        <label>Email*</label>
    					<input type="email" data-type="email_login" placeholder="mail@website.com">
                        <div class="login-error"></div>
    				</div>
    				<div class="form-group log">
                        <label>Password*</label>
    					<input type="password" data-type="pass_login" placeholder="Min. 8 character">
                        <div class="login-error"></div>
    				</div>
    				<div class="form-group btn">
    					<input id="btn-login" type="submit" value="Login">
    				</div>
                    <div class="sign-up">
                        <p>Not registered yet?<a href="register.php"> Create An account</a></p>
                    </div>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="control-img">
        <img src="img/login-img.png" width="100%" heigth="100%">
    </div>
</div>
<script src="js/login.js"></script>
<script src="js/header.js"></script>

</body>
</html>



