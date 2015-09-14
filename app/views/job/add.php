<div class="container-fluid">
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel-body">
			<div class="row">
				<div class="pull-right">
					<a href="<?php echo url();?>/job/index" data-toggle="tooltip" title="Back To Grid" class="btn btn-default"><i class="fa fa-refresh"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Job</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="<?php echo url();?>/job">
					<div class="form-group required">
						<label class="col-sm-2 control-label">Job Name</label>
						<div class="col-sm-6">
							<input type="text" name="name" class="form-control" required/>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Max Salary</label>
						<div class="col-sm-6">
							<input type="number" name="max_salary" class="form-control" required/>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Min Salary</label>
						<div class="col-sm-6">
							<input type="number" name="min_salary" class="form-control" required/>
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