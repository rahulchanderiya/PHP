<?php
include 'database.php';
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homepage</title>
    <link rel="stylesheet" href="textbox_button_assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="textbox_button_assets/css/styles.css">
    <meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="admin_homepage_assets/plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="admin_homepage_assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="admin_homepage_assets/plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
		<link href="admin_homepage_assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="admin_homepage_assets/plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="admin_homepage_assets/plugins/select2/select2.css" rel="stylesheet">
		<link href="admin_homepage_assets/plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">
		<link href="admin_homepage_assets/css/style_v1.css" rel="stylesheet">
		<link href="admin_homepage_assets/plugins/chartist/chartist.min.css" rel="stylesheet">
    
</head>

<body>

<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<a href="#" class="show-sidebar">
			<i class="fa fa-bars"></i>
		</a>
		<ol class="breadcrumb pull-left">
			<li><a href="admin_homepage.php">Home</a></li>
			<li><a href="#">Create Municipal Accounts</a></li>
			<li><a href="#">Mail to Employee</a></li>
		</ol>
		<div id="social" class="pull-right">
			<a href="#"><i class="fa fa-google-plus"></i></a>
			<a href="#"><i class="fa fa-facebook"></i></a>
			<a href="#"><i class="fa fa-twitter"></i></a>
			<a href="#"><i class="fa fa-linkedin"></i></a>
			<a href="#"><i class="fa fa-youtube"></i></a>
		</div>
	</div>
</div>
    <div class="row">
        <div class="col-md-12">
            <form class="bootstrap-form-with-validation" action="mailer.php" method="post">
                <h2 class="text-center text-primary"><strong><span style="text-decoration: underline;">Create Employee Account</span></strong> </h2>
                <br>
                <br>
                <div class="form-group">
                    <!--<label class="control-label" for="textarea-input">Enter Complain</label>-->
                    <textarea class="form-control input-lg" rows="1" wrap="hard" name="name" placeholder="Employee Name" id="textarea-input" required></textarea>
                </div>
                <div class="form-group">
                    <!--<label class="control-label" for="textarea-input">Enter Complain</label>-->
                    <textarea class="form-control input-lg" rows="1" wrap="hard" name="email" placeholder="Employee E-mail Address" id="textarea-input" required></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-lg" type="submit" name="submit">Submit </button>
                </div>
            </form>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

<?php
    require 'PHPMailer/src/send_mail.php';

    if(isset($_POST['submit'])) {
      
      $name = $_POST['name'];
      $email = $_POST['email'];
      
      $d = new database();
      $count = $d->count->municipal_count() + 1000;
      $municipal_id = 'mun-'.$count;
      $municipal_pass = $name.'@'.$count;
      $message = "Your Account Successfully created,   Login Id = ".$municipal_id." ,  Pass = ".$municipal_pass;
      
      $d->municipal->insert_data($name, $municipal_id, $municipal_pass);
      
      $mail = new mailer();
      $n = $mail->send_mail($email, $message);

      if($n==0) {
        $_SESSION['message'] = 'Mail Could not sent but '.$message;
      }
      else if($n==1) {
        $_SESSION['message'] = 'Mail sent '.$message;
      }
	  
	  $_SESSION['link'] = "admin_homepage.php";
	  header("Location: error.php");
      exit;

    }

?>