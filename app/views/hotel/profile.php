<div class="container-fluid">
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<?php if (Session::has('message')): ?>
			<div class="alert alert-success">
				<i class="fa fa-exclamation-circle"></i><small>  <?php echo Session::get('message'); ?> !!</small>
				<button type="button" class="close" data-dismiss="alert">
					×
				</button>
			</div>
		<?php endif; ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Hotel</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="<?php echo url();?>/hotel">
					<div class="form-group required">
						<label class="col-sm-2 control-label">Hotel Name</label>
						<div class="col-sm-6">
							<input type="text" name="name" value="<?php echo $hotel->name;?>" class="form-control" required/>
							<input type="hidden" name="id" value="<?php echo $hotel->id;?>"/>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Phone</label>
						<div class="col-sm-6">
							<input type="text" name="phone" value="<?php echo $hotel->phone;?>" class="form-control" required/>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-6">
							<input type="email" name="email" value="<?php echo $hotel->email;?>" class="form-control" required/>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Address</label>
						<div class="col-sm-6">
							<textarea class="form-control" name="address" rows="5"><?php echo $hotel->address;?></textarea>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Regions</label>
						<div class="col-sm-6">
							<select name="region_id" id="region_id" class="form-control">
								<option></option>
								<?php foreach($regions as $r): ?>
									<?php if($r->id==$hotel->city->province->country->region->id): ?>
										<option value="<?php echo $r->id;?>" selected><?php echo $r->name;?></option>
									<?php Else: ?>
										<option value="<?php echo $r->id;?>"><?php echo $r->name;?></option>
									<?php EndIf; ?>		
								<?php EndForeach; ?>		
							</select>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Country</label>
						<div class="col-sm-6">
							<select name="country_id" id="country_id" class="form-control">
								<option></option>
								<?php foreach($country as $c): ?>
									<?php if($c->id==$hotel->city->province->country->id): ?>
										<option value="<?php echo $c->id;?>" selected><?php echo $c->name;?></option>
									<?php Else: ?>
										<option value="<?php echo $c->id;?>"><?php echo $c->name;?></option>
									<?php EndIf; ?>		
								<?php EndForeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">Province</label>
						<div class="col-sm-6">
							<select name="province_id" id="province_id" class="form-control">
								<option></option>
								<?php foreach($province as $p): ?>
									<?php if($p->id==$hotel->city->province->id): ?>
										<option value="<?php echo $p->id;?>" selected><?php echo $p->name;?></option>
									<?php Else: ?>
										<option value="<?php echo $p->id;?>"><?php echo $p->name;?></option>
									<?php EndIf; ?>		
								<?php EndForeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">City</label>
						<div class="col-sm-6">
							<select name="city_id" id="city_id" class="form-control">
								<option></option>
								<?php foreach($city as $ct): ?>
									<?php if($ct->id==$hotel->city->id): ?>
										<option value="<?php echo $ct->id;?>" selected><?php echo $ct->name;?></option>
									<?php Else: ?>
										<option value="<?php echo $ct->id;?>"><?php echo $ct->name;?></option>
									<?php EndIf; ?>		
								<?php EndForeach; ?>
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