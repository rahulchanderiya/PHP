<?php
include 'database.php';
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Homepage</title>
    <link rel="stylesheet" href="textbox_button_assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="textbox_button_assets/css/styles.css">
    <meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="user_homepage_assets/plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="user_homepage_assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="user_homepage_assets/plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
		<link href="user_homepage_assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="user_homepage_assets/plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="user_homepage_assets/plugins/select2/select2.css" rel="stylesheet">
		<link href="user_homepage_assets/plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">
		<link href="user_homepage_assets/css/style_v1.css" rel="stylesheet">
		<link href="user_homepage_assets/plugins/chartist/chartist.min.css" rel="stylesheet">
    
</head>

<body>

<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<a href="#" class="show-sidebar">
			<i class="fa fa-bars"></i>
		</a>
		<ol class="breadcrumb pull-left">
			<li><a href="user_homepage.php">Home</a></li>
			<li><a href="#">Complains</a></li>
			<li><a href="#">FeedBack</a></li>
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
            <form class="bootstrap-form-with-validation" action="give_feedback.php" method="post">
                <h2 class="text-center text-primary"><strong><span style="text-decoration: underline;">FeedBack</span></strong> </h2>
                <br>
                <br>
                <div class="form-group">
                    <!--<label class="control-label" for="textarea-input">Enter Complain</label>-->
                    <textarea class="form-control input-lg" rows="2" wrap="hard" name="complain_no" placeholder="Enter Complain Number" id="textarea-input" required></textarea>
                </div>
                <div class="form-group">
                    <!--<label class="control-label" for="textarea-input">Enter Complain</label>-->
                    <textarea class="form-control input-lg" rows="5" wrap="hard" name="feedback" placeholder="Enter Your Feedback" id="textarea-input" required></textarea>
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
    
    if(isset($_POST['submit'])) {
    		
    	$complain_no = $_POST['complain_no'];
    	$user_id = $_SESSION['user_id'];
    	$d = new database();

    	if($d->complaint->check_complain_no($complain_no) == 0 OR $d->user_complaint->fetch_user_id($complain_no) != $user_id) {
    		
    		$_SESSION['message'] = "Please Re-Check Complain No.";
			$_SESSION['link'] = "user_homepage.php";
			header("Location: error.php");
        	exit;
		}

    	$feedback = $_POST['feedback'];
    	$d->complaint->insert_feedback($complain_no, $feedback);

		$_SESSION['message'] = "FeedBack Registered";
		$_SESSION['link'] = "user_homepage.php";
		header("Location: error.php");
        exit;
	}

?>