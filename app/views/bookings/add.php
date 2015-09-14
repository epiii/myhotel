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
							 <input type="text"  value="<?php echo date('Y-m-d');?>" name="date_booking" class="form-control" readonly="true" required/>
						 </div>
					</div>
					<div class="form-group">
						 <label class="col-sm-2 control-label">Number Of Days</label>
						 <div class="col-sm-3">
							 <input type="number" min="1" max="7" id="number_of_days"  name="number_of_days" class="form-control" required/>
						 </div>
					</div>
					<div class="form-group">
						 <label class="col-sm-2 control-label">Date of Checkout</label>
						 <div class="col-sm-3">
							 <input type="text" id="date_booking_to" name="date_booking_to" class="form-control" readonly="true" required/>
						 </div>
					</div>
					<div class="form-group">
						 <label class="col-sm-2 control-label">Guest Name</label>
						 <div class="col-sm-4">
							 <input type="hidden" id="guest_id" name="guest_id" class="form-control"  required/>
						 </div>
					</div>
					<div class="form-group" id="service1">
						 <label class="col-sm-2 control-label">Service</label>
						 <div class="col-sm-4">
							 <input type="hidden" name="service_id[]" id="service_id1" class="form-control service"required/>
						 </div>
						 <div class="col-sm-4">
							 <a href="javascript:void(0)" onclick="javascript:AddService()" title="Add New Room" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
						 </div>
					</div>
					<div id="data-service"></div>
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

        $('#service_id1').select2({
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

       

        $('#number_of_days').change(function(){
        	var value = $(this).val();
        	value = parseInt(value);
			var next = Date.today().add(value).days();
			$('#date_booking_to').val(next.toString('yyyy-MM-dd'));
        });

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
		html += '<td><input type="hidden" id="type_id'+row+'" onChange="javascript:room(this)" class="form-control" required/></td>';
		html += '<td><select id="room_id'+row+'" name="room_id[]" class="form-control"  onChange="javascript:price(this)" required></select></td>';
		html += '<td><input type="text" id="number'+row+'" class="form-control" readonly="true" required/></td>';
		html += '<td><input type="text" id="price'+row+'" class="form-control" readonly="true" required/></td>';
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
		html+= '<input type="hidden"  name="service_id[]" id="service_id'+row+'" class="form-control service"required required/>';
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

	AddRoom();

</script>