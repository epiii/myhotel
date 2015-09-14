<div class="container-fluid">
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel-body">
			<div class="row">
				<div class="pull-right">
					<a href="<?php echo url();?>/bookings/add" data-toggle="tooltip" title="Add New" class="btn btn-default"><i class="fa fa-plus"></i> Add New</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Bookings List</h3>
			</div>
			<div class="panel-body">
				<div class="well">
					<form class="form-horizontal" method="GET" action="<?php echo url();?>/bookings/index">
					<div class="form-group">
						 <label class="col-sm-2 control-label">First Date</label>
						 <div class="col-sm-3">
							 <div class="input-group date">
		                    <input type="text" name="date_first"  placeholder="First Date" data-date-format="YYYY-MM-DD" id="input-date-start" class="form-control" />
		                    <span class="input-group-btn">
		                  	  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
		                    </span>
                    	</div>
						 </div>
					</div>
					<div class="form-group">
						 <label class="col-sm-2 control-label">Last Date</label>
						 <div class="col-sm-3">
							 <div class="input-group date">
		                    <input type="text" name="date_last"  placeholder="Last Date" data-date-format="YYYY-MM-DD" id="input-date-start" class="form-control" />
		                    <span class="input-group-btn">
		                  	  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
		                    </span>
                    	</div>
						 </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-3">
							 <button type="submit" id="button-filter" class="btn btn-primary"><i class="fa fa-search"></i> Filter</button>
						</div>
					</div>
				</form>
				</div>
				<?php 
					$no = 1; 
					if(isset($_GET['page'])){
						$no = ($_GET['page']*10)-9;
					}
				?>
				<?php if (Session::has('message')): ?>
				<div class="alert alert-success">
					<i class="fa fa-exclamation-circle"></i><small>  <?php echo Session::get('message'); ?> !!</small>
					<button type="button" class="close" data-dismiss="alert">
						×
					</button>
				</div>
				<?php endif; ?>
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
									<a href="<?php echo url();?>/bookings/show/<?php echo $row->id;?>"><i class="fa fa-search"></i></a>
									<a href="<?php echo url();?>/bookings/delete/<?php echo $row->id;?>" onclick="return confirm('Are you sure ??');"><i class="fa fa-trash-o"></i></a>
								</td>
							</tr>
							<?php $no++; EndForeach; ?>
						</tbody>
					</table>
				</div>
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
<script type="text/javascript">
	$(document).ready(function(){
		$('.date').datetimepicker({
			pickTime: false
		});
	});
</script>