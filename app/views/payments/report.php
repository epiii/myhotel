<div class="container-fluid">
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Report Of Financial</h3>
			</div>
			<div class="panel-body">
				<div class="well">
					<form class="form-horizontal" method="GET" action="<?php echo url();?>/bookings/payments">
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
							 <button type="submit" name="submit" value="submit" id="button-filter" class="btn btn-primary"><i class="fa fa-search"></i> Filter</button>
							 <button type="submit" name="submit" value="print" id="button-filter" class="btn btn-success"><i class="fa fa-print"></i> Print</button>	
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
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Booking Code</th>
								<th>Date Booking</th>
								<th>Number Of Days</th>
								<th>Date Expired</th>
								<th>Service & Room Count</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data as $row): ?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $row->booking_code;?></td>
								<td><?php echo $row->date_booking;?></td>
								<td><?php echo $row->number_of_days;?> Days</td>
								<td><?php echo $row->date_booking_to;?></td>
								<td><?php echo CountService($row->id)+CountRoom($row->id);?></td>
								<td><?php echo Total($row->id);?></td>
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