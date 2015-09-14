<div class="container-fluid">
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel-body">
			<div class="row">
				<div class="pull-right">
					<a href="<?php echo url();?>/users/index" data-toggle="tooltip" title="Back To Grid" class="btn btn-default"><i class="fa fa-refresh"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Users</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="<?php echo url();?>/users">
					<div class="form-group">
						<label class="col-sm-2 control-label">Username</label>
						<div class="col-sm-6">
							<label class="control-label"> : <?php echo $data->username;?></label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Password</label>
						<div class="col-sm-6">
							<label class="control-label"> : ****************</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Employee Name</label>
						<div class="col-sm-6">
							<?php if(isset($data->employee->full_name)): ?>
								<label class="control-label"> : <?php echo $data->employee->full_name;?></label>
							<?php Else: ?>
								<label class="control-label">-</label>
							<?php Endif; ?>	
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>