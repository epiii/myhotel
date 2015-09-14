<!DOCTYPE html>
<html dir="ltr" lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>My Hotel</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
		 <script type="text/javascript">
  			  var base_url = '<?php echo url();?>/';
  		</script>
		<script type="text/javascript" src="<?php echo url();?>/assets/js/jquery/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="<?php echo url();?>/assets/js/bootstrap/js/bootstrap.min.js"></script>
		<link href="<?php echo url();?>/assets/js/bootstrap/less/bootstrap.less" rel="stylesheet/less" />
		<script src="<?php echo url();?>/assets/js/bootstrap/less-1.7.4.min.js"></script>
		<link href="<?php echo url();?>/assets/js/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo url();?>/assets/js/summernote/summernote.css" rel="stylesheet" />
		<script type="text/javascript" src="<?php echo url();?>/assets/js/summernote/summernote.js"></script>
		<script src="<?php echo url();?>/assets/js/jquery/datetimepicker/moment.js" type="text/javascript"></script>
		<script src="<?php echo url();?>/assets/js/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
		<link href="<?php echo url();?>/assets/js/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
		<link type="text/css" href="<?php echo url();?>/assets/css/stylesheet.css" rel="stylesheet" media="screen" />
		<link type="text/css" href="<?php echo url();?>/assets/css/select2.css" rel="stylesheet" media="screen" />
		<link type="text/css" href="<?php echo url();?>/assets/css/select2-bootstrap.css" rel="stylesheet" media="screen" />
		<script src="<?php echo url();?>/assets/js/jquery/select2.js" type="text/javascript"></script>
		<script src="<?php echo url();?>/assets/js/jquery/date.js" type="text/javascript"></script>
		<script src="<?php echo url();?>/assets/js/common.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="container">
			<header id="header" class="navbar navbar-static-top">
				<div class="navbar-header">
					<a type="button" id="button-menu" class="pull-left"><i class="fa fa-indent fa-lg"></i></a>
				</div>
				<ul class="nav pull-right">
					<li>
						<a href="<?php echo url();?>/logout"><span class="hidden-xs hidden-sm hidden-md">Logout</span> <i class="fa fa-sign-out fa-lg"></i></a>
					</li>
				</ul>
			</header>
			<nav id="column-left">
				<div id="profile">
					<div>
						<a class="dropdown-toggle" data-toggle="dropdown"></a>
					</div>
					<div>
						<h4><?php echo strtoupper(Session::get('username')); ?></h4>
						<small>Administrator</small>
					</div>
				</div>
				<ul id="menu">
					<li id="dashboard">
						<a href="<?php echo url();?>/dashboard"><i class="fa fa-dashboard fa-fw"></i> <span>Dashboard</span></a>
					</li>
					<li>
						<a class="parent"><i class="fa fa fa-folder-o fa-fw"></i> <span>Catalog</span></a>
						<ul>
							<li>
								<a href="<?php echo url();?>/cities/index">Cities</a>
							</li>
							<li>
								<a href="<?php echo url();?>/countries/index">Countries</a>
							</li>
							<li>
								<a href="<?php echo url();?>/employee/index">Employee</a>
							</li>
							<li>
								<a href="<?php echo url();?>/guest/index">Guest</a>
							</li>
							<li>
								<a href="<?php echo url();?>/hotel/index">Hotel Profile</a>
							</li>
							<li>
								<a href="<?php echo url();?>/identity/index">Identity Type</a>
							</li>
							<li>
								<a href="<?php echo url();?>/job/index">Job Of Employee</a>
							</li>
							<li>
								<a href="<?php echo url();?>/provinces/index">Provinces</a>
							</li>
							<li>
								<a href="<?php echo url();?>/regions/index">Regions</a>
							</li>
							<li>
								<a href="<?php echo url();?>/rooms/index">Rooms</a>
							</li>
							<li>
								<a href="<?php echo url();?>/services/index">Services</a>
							</li>
							<li>
								<a href="<?php echo url();?>/type/index">Type Of Rooms</a>
							</li>
							<li>
								<a href="<?php echo url();?>/users/index">Users</a>
							</li>
						</ul>
					</li>
					<li>
						<a class="parent"><i class="fa fa-tasks fa-fw"></i> <span>Tasks</span></a>
						<ul>
							<li>
								<a href="<?php echo url();?>/bookings/index">Booking Rooms</a>
							</li>
							<li>
								<a href="<?php echo url();?>/payments/index">Payments</a>
							</li>
						</ul>
					</li>
					<li>
						<a class="parent"><i class="fa fa-line-chart fa-fw"></i> <span>Reports</span></a>
						<ul>
							<li>
								<a href="<?php echo url();?>/bookings/report">Booking Rooms</a>
							</li>
							<li>
								<a href="<?php echo url();?>/bookings/payments">Financial</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
			<div id="content">
				<div class="page-header">
					<div class="container-fluid">
						<h1>My Hotel</h1>
						<ul class="breadcrumb">
							<li>
								<a href="#">Hotel Management System Information</a>
							</li>
							<li>
								<a href="#">&copy; 2015</a>
							</li>
						</ul>
					</div>
				</div>
				<?php if(isset($content)): echo $content; EndIf; ?>
			</div>
			<footer id="footer">
				<a href="#">Libro</a> &copy; <?php echo date('Y');?> All Rights Reserved.
				<br />
				Version 1.01
			</footer>
		</div>
		<div class="modal fade" id="loading">
            <div class='modal-dialog'>
               <div class='modal-body'>
                    <div class="sk-wave">
                      <div class="sk-rect sk-rect1"></div>
                      <div class="sk-rect sk-rect2"></div>
                      <div class="sk-rect sk-rect3"></div>
                      <div class="sk-rect sk-rect4"></div>
                      <div class="sk-rect sk-rect5"></div>
                    </div>
               </div>
            </div>
        </div>
	</body>
</html>