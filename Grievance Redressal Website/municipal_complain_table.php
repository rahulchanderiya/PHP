<?php
include 'database.php';
session_start();
?>

<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<a href="#" class="show-sidebar">
			<i class="fa fa-bars"></i>
		</a>
		<ol class="breadcrumb pull-left">
			<li><a href="user_homepage.php">Home</a></li>
			<li><a href="#">Complains</a></li>
			<li><a href="#">My Complains</a></li>
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
<h2>All My Complains</h2>
<br>
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
					<thead>
						<tr>
							<th>Complain No.</th>
							<th>Complain</th>
							<th>Activity Report</th>
							<th>Feed Back</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$user_id = $_SESSION['municipal_id'];
						$d = new database();
						$arr = $d->municipal_complaint->fetch_complain_no($user_id);
						$length = count($arr);
					?>

	  				<?php for($i=0; $i<$length; $i++) {  
		  					$comp = $d->complaint->fetch_complaint($arr[$i]);
	   				?>
            
      	 			<tr>
       	 			<td><?php echo $comp->getComplain_no() ?></td>
         			<td><?php echo $comp->getComplain() ?></td>
         			<td><?php echo $comp->getActivity_report() ?></td>
         			<td><?php echo $comp->getFeedback() ?></td>
         			</tr>
      
      				<?php } ?>
					<!-- End: list_row -->
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
