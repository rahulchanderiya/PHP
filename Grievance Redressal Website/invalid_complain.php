<?php
include 'database.php';
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>municipal Homepage</title>
    <link rel="stylesheet" href="textbox_button_assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="textbox_button_assets/css/styles.css">
    <meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="municipal_homepage_assets/plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="municipal_homepage_assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="municipal_homepage_assets/plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
		<link href="municipal_homepage_assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="municipal_homepage_assets/plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="municipal_homepage_assets/plugins/select2/select2.css" rel="stylesheet">
		<link href="municipal_homepage_assets/plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">
		<link href="municipal_homepage_assets/css/style_v1.css" rel="stylesheet">
		<link href="municipal_homepage_assets/plugins/chartist/chartist.min.css" rel="stylesheet">
    
</head>

<body>

<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<a href="#" class="show-sidebar">
			<i class="fa fa-bars"></i>
		</a>
		<ol class="breadcrumb pull-left">
			<li><a href="municipal_homepage.php">Home</a></li>
			<li><a href="#">Complains</a></li>
			<li><a href="#">Redirect Invalid Complain</a></li>
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
            <form class="bootstrap-form-with-validation" action="invalid_complain.php" method="post">
                <h2 class="text-center text-primary"><strong><span style="text-decoration: underline;">Redirect Invalid Complains</span></strong> </h2>
                <br>
                <div class="form-group"></div>
                <div class="form-group">
                    <!--<label class="control-label" for="textarea-input">Enter Complain</label>-->
                    <textarea class="form-control input-lg" rows="2" wrap="hard" name="complain_no" placeholder="Enter Complain No." id="textarea-input" required></textarea>
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
    	$municipal_id = $_SESSION['municipal_id'];
    	$d = new database();

    	if($d->complaint->check_complain_no($complain_no) == 0  OR  $d->municipal_complaint->fetch_municipal_id($complain_no) != 'municipal_id') {
    		$_SESSION['message'] = "Please Re-Check Complain No.";
			$_SESSION['link'] = "municipal_homepage.php";
			header("Location: error.php");
        	exit;
		}

    	$d->municipal_complaint->delete_data_by_complain_no($complain_no);
		$d->complaint->insert_activity_report($complain_no, "Invalid Complain");

		$_SESSION['message'] = "Invalid Complain Successfully Redirected to Admin";
		$_SESSION['link'] = "municipal_homepage.php";
		header("Location: error.php");
        exit;
	}

?>