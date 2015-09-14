<div class="container-fluid">
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel-body">
			<div class="row">
				<div class="pull-right">
					<a href="<?php echo url();?>/bookings/index" data-toggle="tooltip" title="Back To Grid" class="btn btn-default"><i class="fa fa-refresh"></i> Back</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Bookings Rooms</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="<?php echo url();?>/bookings">
					<div class="form-group">
						 <label class="col-sm-2 control-label">Date of Bookings</label>
						 <div class="col-sm-3">
						 	 <input type="hidden" name="employee_id" value="<?php echo Session::get('employee_id');?>" readonly="true"/>
							 <input type="text"  value="<?php echo $data->date_booking;?>" name="date_booking" class="form-control" readonly="true" />
						 	 <input type="hidden" name="id" value="<?php echo $data->id;?>"/>
						 </div>
					</div>
					<?php
						$x = str_replace('-', '0', $data->date_booking);
						$y = str_replace('-', '0', $data->date_booking_to);
						$z = $y-$x;
					?>
					<div class="form-group">
						 <label class="col-sm-2 control-label">Number Of Days</label>
						 <div class="col-sm-3">
							 <input type="number" min="1" value="<?php echo $z;?>" max="7" id="number_of_days"  name="number_of_days" class="form-control" />
						 </div>
					</div>
					<div class="form-group">
						 <label class="col-sm-2 control-label">Date of Checkout</label>
						 <div class="col-sm-3">
							 <input type="text" id="date_booking_to" value="<?php echo $data->date_booking_to;?>" name="date_booking_to" class="form-control" readonly="true" />
						 </div>
					</div>
					<div class="form-group">
						 <label class="col-sm-2 control-label">Guest Name</label>
						 <div class="col-sm-4">
							 <input type="hidden" id="guest_id" name="guest_id" class="form-control"/>
						 </div>
					</div>
					<div class="form-group" id="service1">
						 <label class="col-sm-2 control-label">Service</label>
						 <div class="col-sm-4">
							 <input type="hidden" name="service_id[]" id="service_id1" class="form-control service"/>
						 </div>
						 <div class="col-sm-4">
							 <a href="javascript:void(0)" onclick="javascript:AddService()" title="Add New Room" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
						 </div>
					</div>
					<div id="data-service">
						<?php $i=2; foreach($service as $s): ?>
							<?php if($i>2): ?>
								<div class="form-group" id="service<?php echo ($i-1);?>">
									 <label class="col-sm-2 control-label"></label>
									 <div class="col-sm-4">
										 <input type="hidden" name="service_id[]" id="service_id<?php echo ($i-1);?>" class="form-control service"/>
									 </div>
									 <div class="col-sm-4">
									 	 <a href="javascript:void(0)" onclick="javascript:DeleteService(<?php echo ($i-1);?>)" title="Delete Service" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
									 </div>
								</div>
							<?php EndIf; ?>	
						<?php $i++; EndForeach; ?>	
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="TData">
							<thead>
								<tr>
									<td colspan="5">
										<label># Details Of Rooms</label>
										<a href="javascript:void(0)" onclick="AddRoom()" title="Add New Room" class="btn pull-right btn-sm btn-success"><i class="fa fa-plus"></i> Add Room</a>
									</td>
								</tr>
								<tr>
									<th>Type Of Rooms</th>
									<th>Rooms</th>
									<th>Number Of Rooms</th>
									<th>Price</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $v = 0; foreach($rooms as $room): ?>
									<tr class="index" id="<?php echo $v;?>">
										<td><input type="hidden" name="type_id[]"  id="type_id<?php echo $v;?>" onChange="javascript:room(this)" class="form-control" /></td>
										<td><select id="room_id<?php echo $v;?>" name="room_id[]" class="form-control"  onChange="javascript:price(this)" ><option></option></select></td>
										<td><input type="text" value="<?php echo $room->room->number;?>" id="number<?php echo $v;?>" class="form-control" readonly="true" /></td>
										<td><input type="text" value="<?php echo $room->room->type->price;?>" id="price<?php echo $v;?>" class="form-control" readonly="true" /></td>
										<td><a href="javascript:void(0)" onclick="javascript:deleteRow(this)" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Delete</a></td>
									</tr>
								<?php $v++; EndForeach; ?>
							</tbody>
						</table>
					</div>
					<div class="pull-right">
						<button type="reset" data-toggle="tooltip" title="Reset Form" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
						<button type="submit" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){

		$('#guest_id').select2({
            ajax: {
                placeholder: 'Type Guest Name',    
                url: '<?php echo url();?>/bookings/guest',
                dataType: 'json',
                quietMillis: 100,
                data: function (term) {
                    return {
                        q: term, // search term
                    };
                },
                results: function (data) {
                    var myResults = [];
                    $.each(data, function (index, item) {
                        myResults.push({
                            'id': item.id,
                            'text': item.text
                        });
                    });
                    return {
                        results: myResults
                    };
                },
                minimumInputLength: 3
            }
        });

		<?php $z=1; foreach($service as $s): ?>
        $('#service_id<?php echo $z;?>').select2({
            ajax: {
                placeholder: 'Type Service',    
                url: '<?php echo url();?>/bookings/service',
                dataType: 'json',
                quietMillis: 100,
                data: function (term) {
                    return {
                        q: term, // search term
                    };
                },
                results: function (data) {
                    var myResults = [];
                    $.each(data, function (index, item) {
                        myResults.push({
                            'id': item.id,
                            'text': item.text
                        });
                    });
                    return {
                        results: myResults
                    };
                },
                minimumInputLength: 3
            }
        });
        $("#service_id<?php echo $z;?>").select2("data", { id: <?php echo $s->service->id;?>, text: "<?php echo $s->service->name.' - $'.$s->service->price;?>" });
        <?php $z++; EndForeach; ?>

       

        $('#number_of_days').change(function(){
        	var value = $(this).val();
        	value = parseInt(value);
			var next = Date.today().add(value).days();
			$('#date_booking_to').val(next.toString('yyyy-MM-dd'));
        });


        $("#guest_id").select2("data", { id: <?php echo $data->guest->id;?>, text: "<?php echo $data->guest->full_name;?>" });

        <?php $r = 0; foreach($rooms as $room): ?>
        	$('#room_id<?php echo $r;?>').html(LoadRoom(<?php echo $room->room->type->id;?>));
        	$('#room_id<?php echo $r;?>').select2();
        	$("#room_id<?php echo $r;?>").select2("data", { id: <?php echo $room->room->id;?>, text: "<?php echo $room->room->name;?>" });
        	$('#type_id<?php echo $r;?>').select2({
          		ajax: {
                placeholder: 'Type Type Of Rooms',    
                url: '<?php echo url();?>/bookings/type',
                dataType: 'json',
                quietMillis: 100,
                data: function (term) {
                    return {
                        q: term, // search term
                    };
                },
                results: function (data) {
                    var myResults = [];
                    $.each(data, function (index, item) {
                        myResults.push({
                            'id': item.id,
                            'text': item.text
                        });
                    });
                    return {
                        results: myResults
                    };
                },
                minimumInputLength: 3
           	   }
      	    });
      	    $("#type_id<?php echo $r;?>").select2("data", { id: <?php echo $room->room->type->id;?>, text: "<?php echo $room->room->type->name;?>" });
        <?php $r++; EndForeach; ?>

	});

	
	function AddRoom(){
		var row = $('#TData tbody tr').length;
		if(row>0){
			var index = $('.index').last().attr('id');
			index = parseInt(index);
			row = parseInt(row);
			row = index+1;
		}
		var html = '<tr id="'+row+'" class="index">';
		html += '<td><input type="hidden" id="type_id'+row+'" onChange="javascript:room(this)" class="form-control" /></td>';
		html += '<td><select id="room_id'+row+'" name="room_id[]" class="form-control"  onChange="javascript:price(this)" ></select></td>';
		html += '<td><input type="text" id="number'+row+'" class="form-control" readonly="true" /></td>';
		html += '<td><input type="text" id="price'+row+'" class="form-control" readonly="true" /></td>';
		html += '<td><a href="javascript:void(0)" onclick="javascript:deleteRow(this)" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Delete</a></td>';
		html += '</tr>';
		$('#TData tbody').append(html);
		$('#type_id'+row).select2({
            ajax: {
                placeholder: 'Type Type Of Rooms',    
                url: '<?php echo url();?>/bookings/type',
                dataType: 'json',
                quietMillis: 100,
                data: function (term) {
                    return {
                        q: term, // search term
                    };
                },
                results: function (data) {
                    var myResults = [];
                    $.each(data, function (index, item) {
                        myResults.push({
                            'id': item.id,
                            'text': item.text
                        });
                    });
                    return {
                        results: myResults
                    };
                },
                minimumInputLength: 3
            }
        });
      
	}

	function room(x){
		var id = $(x).attr('id');
        var value = $('#'+id).val();
        id = id.substr(7);
        var room = LoadRoom(value);
        $('#room_id'+id).html(room);
        $('#room_id'+id).select2();
	}

	
	function price(x){
		var id = $(x).attr('id');
		var value = $('#'+id).val();
		var json = LoadPrice(value);
		var data = eval(json);
		var index = id.substr(7);
		$("#number"+index).val(data[0].number);
		$("#price"+index).val(data[0].price);
	}

	function LoadRoom(id){
		var value = '';
		$.ajax({
			url: '<?php echo url();?>/bookings/rooms/'+id,
			dataType: 'html',
			async: false,
			success:function(data){
				value = data;
			}
		});
		return value;
	}

	function LoadPrice(id){
		var value = '';
		$.ajax({
			url: '<?php echo url();?>/bookings/price/'+id,
			dataType: 'json',
			async: false,
			success:function(data){
				value = data;
			}
		});
		return value;
	}

	function AddService(){
		var row = $('.service').length;
		if(row>1){
			var index = $('.service').last().attr('id');
			index = index.substr(10);
			index = parseInt(index);
			row = parseInt(row);
			row = index+1;
		}
		var html = '<div class="form-group" id="service'+row+'">';
		html+= '<label class="col-sm-2 control-label"></label>';
		html+= '<div class="col-sm-4">';
		html+= '<input type="hidden"  name="service_id[]" id="service_id'+row+'" class="form-control service" />';
		html+= '</div>';
		html+= '<div class="col-sm-4">';
		html+= '<a href="javascript:void(0)" onclick="javascript:DeleteService('+row+')" title="Delete Service" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>';
		html+= '</div>';
		html+= '</div>';
		$('#data-service').append(html);
		$('#service_id'+row).select2({
            ajax: {
                placeholder: 'Type Service',    
                url: '<?php echo url();?>/bookings/service',
                dataType: 'json',
                quietMillis: 100,
                data: function (term) {
                    return {
                        q: term, // search term
                    };
                },
                results: function (data) {
                    var myResults = [];
                    $.each(data, function (index, item) {
                        myResults.push({
                            'id': item.id,
                            'text': item.text
                        });
                    });
                    return {
                        results: myResults
                    };
                },
                minimumInputLength: 3
            }
        });

	}

	function DeleteService(x){
		$('#service'+x).remove();
	}

	function deleteRow(btn) {
	  var row = btn.parentNode.parentNode;
	  row.parentNode.removeChild(row);
	}



</script>