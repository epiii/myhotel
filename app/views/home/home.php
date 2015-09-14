<div class="container-fluid">
	<?php if (Session::has('message')): ?>
	<div class="alert alert-success">
		<i class="fa fa-exclamation-circle"></i><small> <?php echo Session::get('message'); ?>.</small>
		<button type="button" class="close" data-dismiss="alert">
			×
		</button>
	</div>
	<?php EndIf; ?>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-6">
			<div class="tile">
				<div class="tile-heading">
					Total Guest
				</div>
				<div class="tile-body">
					<i class="fa fa-users"></i>
					<h2 class="pull-right"><?php echo $guest;?></h2>
				</div>
				<div class="tile-footer">
					<a href="<?php echo url();?>/guest/index">View more..</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6">
			<div class="tile">
				<div class="tile-heading">
					Total Bookings
				</div>
				<div class="tile-body">
					<i class="fa fa-credit-card"></i>
					<h2 class="pull-right"><?php echo $bookings;?></h2>
				</div>
				<div class="tile-footer">
					<a href="<?php echo url();?>/bookings/index">View more...</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6">
			<div class="tile">
				<div class="tile-heading">
					Total Rooms
				</div>
				<div class="tile-body">
					<i class="fa fa-home"></i>
					<h2 class="pull-right"><?php echo $rooms;?></h2>
				</div>
				<div class="tile-footer">
					<a href="<?php echo url();?>/rooms/index">View more...</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6">
			<div class="tile">
				<div class="tile-heading">
					Total Services
				</div>
				<div class="tile-body">
					<i class="fa fa-bell"></i>
					<h2 class="pull-right"><?php echo $service;?></h2>
				</div>
				<div class="tile-footer">
					<a href="<?php echo url();?>/services/index">View more...</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
			<script language="javascript" type="text/javascript" src="assets/js/jquery/flot/jquery.flot.js"></script>
			<script language="javascript" type="text/javascript" src="assets/js/jquery/flot/jquery.flot.categories.js"></script>
			<script language="javascript" type="text/javascript" src="assets/js/jquery/flot/jquery.flot.resize.min.js"></script>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart"></i> Charts Of <?php echo date('Y');?></h3>
				</div>
				<div class="panel-body">
					<div id="placeholder" class="demo-placeholder" style="height:300px;"></div>
				</div>

				<script type="text/javascript">
					$(function() {
					
						var data = [
							["January", <?php echo CountDate('01-01','01-31');?>],
							["February", <?php echo CountDate('02-01','02-28');?>],
							["March", <?php echo CountDate('03-01','03-31');?>],
							["April",<?php echo CountDate('04-01','04-30');?>],
							["May",<?php echo CountDate('05-01','05-31');?>],
							["June", <?php echo CountDate('06-01','06-30');?>],
							["July", <?php echo CountDate('07-01','07-31');?>],
							["August", <?php echo CountDate('08-01','08-31');?>],
							["September", <?php echo CountDate('09-01','09-30');?>],
							["October", <?php echo CountDate('10-01','10-31');?>],
							["November", <?php echo CountDate('11-01','11-30');?>],
							["December", <?php echo CountDate('12-01','12-31');?>],
						];
						
						$.plot("#placeholder", [ data ], {
							series: {
								bars: {
									show: true,
									barWidth: 0.6,
									align: "center"
								}
							},
							xaxis: {
								mode: "categories",
								tickLength: 0
							}
						});
						
					});

				</script>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
			<div class="panel panel-default">
				<link type="text/css" href="assets/js/jquery/jqvmap/jqvmap.css" rel="stylesheet" media="screen" />
				<script type="text/javascript" src="assets/js/jquery/jqvmap/jquery.vmap.js"></script>
				<script type="text/javascript" src="assets/js/jquery/jqvmap/maps/jquery.vmap.world.js"></script>
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-road"></i> Locations</h3>
				</div>
				<div class="panel-body">
					<div id="vmap" style="width: 100%; height: 300px;"></div>
				</div>
				<script type="text/javascript">
					$(document).ready(function() {
						jQuery('#vmap').vectorMap({
							map : 'world_en',
							backgroundColor : '#a5bfdd',
							borderColor : '#818181',
							borderOpacity : 0.25,
							borderWidth : 1,
							color : '#f4f3f0',
							enableZoom : true,
							hoverColor : '#c9dfaf',
							hoverOpacity : null,
							normalizeFunction : 'linear',
							scaleColors : ['#b6d6ff', '#005ace'],
							selectedColor : '#c9dfaf',
							selectedRegion : null,
							showTooltip : true,
							onRegionClick : function(element, code, region) {
								var message = 'You clicked "' + region + '" which has the code: ' + code.toUpperCase();

								alert(message);
							}
						});
					});
				</script>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-external-link"></i> Latest Bookings</h3>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Booking Code</th>
								<th>Date Booking</th>
								<th>Date Expired</th>
								<th>Guest Name</th>
								<th>Receptionist Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<?php 
							$no = 1; 
							if(isset($_GET['page'])){
								$no = ($_GET['page']*10)-9;
							}
						?>
						<tbody>
							<?php foreach($data as $row): ?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $row->booking_code;?></td>
								<td><?php echo $row->date_booking;?></td>
								<td><?php echo $row->date_booking_to;?></td>
								<td><?php echo $row->guest->full_name;?></td>
								<?php if(isset($row->employee->full_name)): ?>
									<td><?php echo $row->employee->full_name;?></td>
								<?php Else: ?>
									<td>Administrator</td>
								<?php EndIf; ?>	
								<td>
									<a href="<?php echo url();?>/bookings/edit/<?php echo $row->id;?>"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
							<?php $no++; EndForeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="pagination">
				<?php 
					if(isset($_GET['search'])){
						echo $data->appends(array('search' => $_GET['search']))->links();	
					}else{
						echo $data->links();
					}	
				?>
			</div>
		</div>
	</div>
</div>