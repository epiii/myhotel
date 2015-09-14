<div class="container-fluid">
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel-body">
			<div class="row">
				<div class="pull-right">
					<a href="<?php echo url();?>/employee/index" data-toggle="tooltip" title="Back To Grid" class="btn btn-default"><i class="fa fa-refresh"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Employee</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="<?php echo url();?>/employee">
					<div class="form-group required">
						<label class="col-sm-2 control-label">Employee Name</label>
						<div class="col-sm-6">
							<input type="text" name="name" class="form-control" required/>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Position</label>
						<div class="col-sm-6">
							<select name="position" class="form-control">
								<option></option>
								<?php foreach($position as $p): ?>
									<option value="<?php echo $p;?>"><?php echo $p;?></option>
								<?php EndForeach; ?>	
							</select>
						</div>
					</div>
					<div class="form-group required">
						 <label class="col-sm-2 control-label">Gender</label>
						 <div class="col-sm-10">
							<label class="radio-inline">
								 <input type="radio" name="gender" value="Male" required/> Male
							</label>
							<label class="radio-inline">
								 <input type="radio" name="gender" value="Female" required/> Female
							</label>
						 </div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Phone</label>
						<div class="col-sm-6">
							<input type="text" name="phone" class="form-control" required/>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-6">
							<input type="email" name="email" class="form-control" required/>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Address</label>
						<div class="col-sm-6">
							<textarea class="form-control" name="address" rows="5"></textarea>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Regions</label>
						<div class="col-sm-6">
							<select name="region_id" id="region_id" class="form-control">
								<option></option>
								<?php foreach($regions as $r): ?>
									<option value="<?php echo $r->id;?>"><?php echo $r->name;?></option>	
								<?php EndForeach; ?>	
							</select>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Country</label>
						<div class="col-sm-6">
							<select name="country_id" id="country_id" class="form-control">
								<option></option>
							</select>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Province</label>
						<div class="col-sm-6">
							<select name="province_id" id="province_id" class="form-control">
								<option></option>
							</select>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">City</label>
						<div class="col-sm-6">
							<select name="city_id" id="city_id" class="form-control">
								<option></option>
							</select>
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
<script type="text/javascript">
	$(document).ready(function(){

		 $('#region_id').change(function(){
            $('#country_id').html(empty('country'));
            $('#province_id').html(empty('province'));
            $('#city_id').html(empty('city'));
            var value = $(this).val();
            var country = LoadHTML('employee/country/'+value);
            $('#country_id').html(country);
        });

		 $('#country_id').change(function(){
            $('#province_id').html(empty('province'));
            $('#city_id').html(empty('city'));
            var value = $(this).val();
            var province = LoadHTML('employee/province/'+value);
            $('#province_id').html(province);
        });
		
		 $('#province_id').change(function(){
		 	$('#city_id').html(empty('city'));
		 	var value = $(this).val();
		 	var city = LoadHTML('employee/city/'+value);
		 	$('#city_id').html(city);
		 });

	});
</script>