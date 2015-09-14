<div class="container-fluid">
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel-body">
			<div class="row">
				<div class="pull-right">
					<a href="<?php echo url();?>/job/add" data-toggle="tooltip" title="Add New" class="btn btn-default"><i class="fa fa-plus"></i> Add New</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Jobs</h3>
			</div>
			<div class="panel-body">
				<div class="well">
					<div class="row">
						<div class="col-sm-12">
							<form action="<?php echo url();?>/job/index">
								<div class="form-group">
									<label class="control-label" for="search">Job Name</label>
									<input type="text" name="search" value="" placeholder="Job Name" id="search" class="form-control" />
								</div>
								<button type="submit" id="button-filter" class="btn btn-primary pull-right">
									<i class="fa fa-search"></i> Filter
								</button>
							</form>
						</div>
					</div>
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
								<th>Job Name</th>
								<th>Max Salary</th>
								<th>Min Salary</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data as $row): ?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $row->name;?></td>
								<td><?php echo $row->max_salary;?></td>
								<td><?php echo $row->min_salary;?></td>
								<td>
									<a href="<?php echo url();?>/job/edit/<?php echo $row->id;?>"><i class="fa fa-pencil"></i></a>
									<a href="<?php echo url();?>/job/show/<?php echo $row->id;?>"><i class="fa fa-search"></i></a>
									<a href="<?php echo url();?>/job/delete/<?php echo $row->id;?>" onclick="return confirm('Are you sure ??');"><i class="fa fa-trash-o"></i></a>
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