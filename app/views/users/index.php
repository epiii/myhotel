<div class="container-fluid">
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel-body">
			<div class="row">
				<div class="pull-right">
					<a href="<?php echo url();?>/users/add" data-toggle="tooltip" title="Add New" class="btn btn-default"><i class="fa fa-plus"></i> Add New</a>
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
				<div class="well">
					<div class="row">
						<div class="col-sm-12">
							<form action="<?php echo url();?>/users/index">
								<div class="form-group">
									<label class="control-label" for="search">Users Name</label>
									<input type="text" name="search" value="" placeholder="User Name" id="search" class="form-control" />
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
								<th>Username</th>
								<th>Employee Name</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data as $row): ?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $row->username;?></td>
								<?php if(isset($row->employee->full_name)): ?>
									<td><?php echo $row->employee->full_name;?></td>
								<?php Else: ?>
									<td>-</td>
								<?php EndIf; ?>	
								<td>
									<a href="<?php echo url();?>/users/edit/<?php echo $row->id;?>"><i class="fa fa-pencil"></i></a>
									<a href="<?php echo url();?>/users/show/<?php echo $row->id;?>"><i class="fa fa-search"></i></a>
									<a href="<?php echo url();?>/users/delete/<?php echo $row->id;?>" onclick="return confirm('Are you sure ??');"><i class="fa fa-trash-o"></i></a>
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