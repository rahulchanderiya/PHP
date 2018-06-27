<?php
include 'database.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Municipal Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="municipal_login_assets/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="municipal_login_assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="municipal_login_assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="municipal_login_assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="municipal_login_assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="municipal_login_assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="municipal_login_assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="municipal_login_assets/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="municipal_login_assets/images/img-01.png" alt="IMG">
				</div>

				<form action="municipal_login.php" action="database" method = "post" class="login100-form validate-form">
					<span class="login100-form-title">
						Municipal Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="municipal_id" placeholder="User-ID" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="login">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	<script src="municipal_login_assets/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="municipal_login_assets/vendor/bootstrap/js/popper.js"></script>
	<script src="municipal_login_assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="municipal_login_assets/vendor/select2/select2.min.js"></script>
	<script src="municipal_login_assets/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="municipal_login_assets/js/main.js"></script>

</body>
</html>

<?php

    if(isset($_POST['login'])) {
      //echo "<script>alert('Please Re-check User-Id & Password');</script>";
      $id = $_POST["municipal_id"];
      $pass = $_POST["pass"];

      $d = new database();
      $n = $d->municipal->verify_login($id, $pass);

      if($n==0) {
        echo "<script>alert('Please Re-check municipal-Id & Password');</script>";
        
      }
      else {
        $_SESSION['municipal_id'] = $id;
        header("Location: municipal_homepage.php");
        exit;
      }

    }

?>