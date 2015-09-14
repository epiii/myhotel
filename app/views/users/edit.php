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
		<?php if (Session::has('message')): ?>
			<div class="alert alert-danger">
				<i class="fa fa-exclamation-circle"></i><small>  <?php echo Session::get('message'); ?> !!</small>
				<button type="button" class="close" data-dismiss="alert">
					×
				</button>
			</div>
		<?php endif; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Users</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="<?php echo url();?>/users">
					<div class="form-group">
						<label class="col-sm-2 control-label">Employee Name</label>
						<div class="col-sm-6">
							<?php if(isset($data->employee->full_name)): ?>
								<label class="control-label"><?php echo $data->employee->full_name;?></label>
							<?php Else: ?>
								<label class="control-label">-</label>
							<?php EndIf; ?>	
							<input type="hidden" id="employee_id" name="employee_id" value="<?php echo $data->employee_id;?>" class="form-control" required/>
							<input type="hidden" name="id" value="<?php echo $data->id;?>"/>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Username</label>
						<div class="col-sm-6">
							<input type="text" name="username" value="<?php echo $data->username;?>" class="form-control" required/>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Password</label>
						<div class="col-sm-6">
							<input type="password" name="password1" class="form-control" required/>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Re-Type Password</label>
						<div class="col-sm-6">
							<input type="password" name="password2" class="form-control" required/>
						</div>
					</div>
					<div class="pull-right">
						<button type="reset" data-toggle="tooltip" title="Reset Form" class="btn btn-warning">
							<i class="fa fa-refresh"></i> Reset
						</button>
						<button type="submit" data-toggle="tooltip" title="Save" class="btn btn-primary">
							<i class="fa fa-save"></i> Save
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
