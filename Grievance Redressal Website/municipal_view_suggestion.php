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
			<li><a href="#">Suggestion</a></li>
			<li><a href="#">View Suggestion</a></li>
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
<h2>Suggestion List</h2>
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
							<th>Suggestion No.</th>
							<th>Suggestion</th>
							<th>Given By</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$d = new database();
						$arr = $d->suggestion->fetch_all_suggestion_no();
						$length = count($arr);
					?>

	  				<?php for($i=0; $i<$length; $i++) {
	  					$suggestion_no = $arr[$i];
	  					$suggestion = $d->suggestion->fetch_suggestion($arr[$i]);
	  					$user_name = $d->user->get_user_name( $d->user_suggestion->fetch_user_id($arr[$i]) );
	   				?>
            
      	 			<tr>
       	 			<td><?php echo $suggestion_no?></td>
         			<td><?php echo $suggestion?></td>
         			<td><?php echo $user_name ?></td>
         			</tr>
      
      				<?php } ?>
					<!-- End: list_row -->
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
