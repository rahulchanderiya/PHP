<?php
include 'database.php';
session_start();

if(!isset($_SESSION['municipal_id'])) {
	header("Location: homepage.php");
    exit;
}

$municipal_id = $_SESSION['municipal_id'];
$d = new database();
$municipal_name = $d->municipal->get_municipal_name($municipal_id);

?>

<!--Start Breadcrumb-->
<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<a href="#" class="show-sidebar">
			<i class="fa fa-bars"></i>
		</a>
		<ol class="breadcrumb pull-left">
			<li><a href="municipal_homepage.php">Home</a></li>
			<li><a href="#">Dashboard</a></li>
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
<!--End Breadcrumb-->
<!--Start Dashboard 1-->
<div id="dashboard-header" class="row">
	<div class="col-xs-12 col-sm-4 col-md-5">
		<h1>Welcome <?php echo $municipal_name ?> !!</h1>
	</div>
</div>
<script type="text/javascript">
// Array for random data for Sparkline
var sparkline_arr_1 = SparklineTestData();
var sparkline_arr_2 = SparklineTestData();
var sparkline_arr_3 = SparklineTestData();
$(document).ready(function() {
	// Make all JS-activity for dashboard
	DashboardTabChecker();
	// Load Knob plugin and run callback for draw Knob charts for dashboard(tab-servers)
	LoadKnobScripts(DrawKnobDashboard);
	// Load Sparkline plugin and run callback for draw Sparkline charts for dashboard(top of dashboard + plot in tables)
	LoadSparkLineScript(DrawSparklineDashboard);
	// Load Morris plugin and run callback for draw Morris charts for dashboard
	LoadMorrisScripts(MorrisDashboard);
	// Load Springy plugin and run callback for draw network map for dashboard
	LoadSpringyScripts(SpringyNetmap);
	// Make beauty hover in table
	$("#ticker-table").beautyHover();
	// Run script for stock block
	CreateStockPage();
});