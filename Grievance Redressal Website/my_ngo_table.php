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
			<li><a href="#">NGO</a></li>
			<li><a href="#">My NGO</a></li>
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
<h2>My NGO List</h2>
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
							<th>NGO Name</th>
							<th>Mission</th>
							<th>No. of User Connected</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$user_id = $_SESSION['user_id'];
						$d = new database();
						$ngo = $d->ngo_user->fetch_ngo_list($user_id);
						$length = count($ngo);
					?>

	  				<?php for($i=0; $i<$length; $i++) {
	  					$mission = $d->ngo->fetch_ngo_mission($ngo[$i]);
	  					$no_of_user = count($d->ngo_user->fetch_user_list($ngo[$i]));
	   				?>
            
      	 			<tr>
       	 			<td><?php echo $ngo[$i]?></td>
         			<td><?php echo $mission?></td>
         			<td><?php echo $no_of_user?></td>
         			</tr>
      
      				<?php } ?>
					<!-- End: list_row -->
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
