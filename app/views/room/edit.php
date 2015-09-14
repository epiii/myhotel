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
					<div class="form-group required">
						<label class="col-sm-2 control-label">Room Name</label>
						<div class="col-sm-6">
							<input type="text" name="name" value="<?php echo $data->name;?>" class="form-control" required/>
							<input type="hidden" name="id" value="<?php echo $data->id;?>"/>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Type Room</label>
						<div class="col-sm-6">
							<select name="type_id" class="form-control" required>
								<option></option>
								<?php foreach($type as $t): ?>
									<?php if($t->id==$data->type_id): ?>
										<option value="<?php echo $t->id;?>" selected><?php echo $t->name;?></option>
									<?php Else: ?>
										<option value="<?php echo $t->id;?>"><?php echo $t->name;?></option>
									<?php EndIf; ?>	
								<?php EndForeach; ?>	
							</select>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Number</label>
						<div class="col-sm-6">
							<input type="text" name="number" value="<?php echo $data->number;?>" class="form-control" required/>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Floor</label>
						<div class="col-sm-6">
							<input type="number" name="floor" value="<?php echo $data->floor;?>" class="form-control" required/>
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