<div class="container-fluid">
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel-body">
			<div class="row">
				<div class="pull-right">
					<a href="<?php echo url();?>/guest/index" data-toggle="tooltip" title="Back To Grid" class="btn btn-default"><i class="fa fa-refresh"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Guest</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="<?php echo url();?>/guest">
					<div class="form-group ">
						<label class="col-sm-2 control-label">Guest Name</label>
						<div class="col-sm-6">
							<label class="control-label">:</label>
							<label class="control-label"><?php echo $data->full_name;?></label>
						</div>
					</div>
					<div class="form-group ">
						<label class="col-sm-2 control-label">Identity Type</label>
						<div class="col-sm-6">
							<label class="control-label">:</label>
							<label class="control-label"><?php echo $data->identity->name;?></label>
						</div>
					</div>
					<div class="form-group ">
						<label class="col-sm-2 control-label">Identity Number</label>
						<div class="col-sm-6">
							<label class="control-label">:</label>
							<label class="control-label"><?php echo $data->identity_number;?></label>
						</div>
					</div>
					<div class="form-group ">
						<label class="col-sm-2 control-label">Job</label>
						<div class="col-sm-6">
							<label class="control-label">:</label>
							<label class="control-label"><?php echo $data->job->name;?></label>
						</div>
					</div>
					<div class="form-group ">
						 <label class="col-sm-2 control-label">Gender</label>
						 <div class="col-sm-10">
							<label class="control-label">:</label>
							<label class="control-label"><?php echo $data->gender;?></label>
						 </div>
					</div>
					<div class="form-group ">
						<label class="col-sm-2 control-label">Phone</label>
						<div class="col-sm-6">
							<label class="control-label">:</label>
							<label class="control-label"><?php echo $data->phone;?></label>
						</div>
					</div>
					<div class="form-group ">
						<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-6">
							<label class="control-label">:</label>
							<label class="control-label"><?php echo $data->email;?></label>
						</div>
					</div>
					<div class="form-group ">
						<label class="col-sm-2 control-label">Address</label>
						<div class="col-sm-6">
							<label class="control-label">:</label>
							<label class="control-label"><?php echo $data->address;?></label>
						</div>
					</div>
					<div class="form-group ">
						<label class="col-sm-2 control-label">Regions</label>
						<div class="col-sm-6">
							<label class="control-label">:</label>
							<label class="control-label"><?php echo $data->city->province->country->region->name;?></label>
						</div>
					</div>
					<div class="form-group ">
						<label class="col-sm-2 control-label">Country</label>
						<div class="col-sm-6">
							<label class="control-label">:</label>
							<label class="control-label"><?php echo $data->city->province->country->name;?></label>
						</div>
					</div>
					<div class="form-group ">
						<label class="col-sm-2 control-label">Province</label>
						<div class="col-sm-6">
							<label class="control-label">:</label>
							<label class="control-label"><?php echo $data->city->province->name;?></label>
						</div>
					</div>
					<div class="form-group ">
						<label class="col-sm-2 control-label">City</label>
						<div class="col-sm-6">
							<label class="control-label">:</label>
							<label class="control-label"><?php echo $data->city->name;?></label>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
