<div class="container-fluid">
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel-body">
			<div class="row">
				<div class="pull-right">
					<a href="<?php echo url();?>/rooms/index" data-toggle="tooltip" title="Back To Grid" class="btn btn-default"><i class="fa fa-refresh"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Room</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="<?php echo url();?>/rooms">
					<div class="form-group">
						<label class="col-sm-2 control-label">Room Name</label>
						<div class="col-sm-6">
							<label class="control-label">:</label>
							<label class="control-label"><?php echo $data->name;?></label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Type Room</label>
						<div class="col-sm-6">
							<label class="control-label">:</label>
							<label class="control-label"><?php echo $data->type->name;?></label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Number</label>
						<div class="col-sm-6">
							<label class="control-label">:</label>
							<label class="control-label"><?php echo $data->number;?></label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Floor</label>
						<div class="col-sm-6">
							<label class="control-label">:</label>
							<label class="control-label"><?php echo $data->floor;?></label>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>