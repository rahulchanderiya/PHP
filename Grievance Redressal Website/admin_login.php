<!--
	Author: W3layouts
	Author URL: http://w3layouts.com
	License: Creative Commons Attribution 3.0 Unported
	License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Admin Login</title>
    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Core Login Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta-Tags -->
    <!-- Index-Page-CSS -->
    <link rel="stylesheet" href="admin_login_assets/css/style.css" type="text/css" media="all">
    <!-- //Custom-Stylesheet-Links -->
    <!--fonts -->
    <link href="//fonts.googleapis.com/css?family=Mukta+Mahee:200,300,400,500,600,700,800" rel="stylesheet">
    <!-- //fonts -->
    <!-- Font-Awesome-File -->
    <link rel="stylesheet" href="admin_login_assets/css/font-awesome.css" type="text/css" media="all">
</head>

<body>
    <h1 class="title-agile text-center">Admin login</h1>
    <div class="content-w3ls">
        <div class="agileits-grid">
            <div class="content-top-agile">
                <h2>Welcome Back !!</h2>
            </div>
            <div class="content-bottom">
                <form action="admin_login.php" method="post">
                    <div class="field_w3ls">
                        <div class="field-group">
                            <input name="user_id" id="text1" type="text" value="" placeholder="username" required>
                        </div>
                        <div class="field-group">
                            <input id="password-field" type="password" class="form-control" name="pass" value="" placeholder="Password" required>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                    </div>
                    <div class="wthree-field">
                        <input id="saveForm" name="submit" type="submit" value="Login" />
                    </div>
                </form>
            </div>
            <!-- //content bottom -->
        </div>
    </div>
    <!--//copyright-->
    <script src="admin_login_assets/js/jquery-2.2.3.min.js"></script>
    <!-- script for show password -->
    <script>
        $(".toggle-password").click(function () {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
    <!-- /script for show password -->

</body>
<!-- //Body -->

</html>

<?php
    
    if(isset($_POST['submit'])) {
        if($_POST['user_id']=='admin'  and  $_POST['pass']=='admin') {
            session_start();
            $_SESSION['admin_id'] = $_POST['user_id'];
            header("Location: admin_homepage.php");
            exit;
        }
        else {
            echo "<script>alert('Please Re-check User-Id & Password');</script>";
        }
    }

?>