<?php

require_once("../session.php");
require_once("../classuser.php");

$auth_user = new USER();


$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM users WHERE id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>FSTore</title>
		<!-- Text Editor CSS -->
		<link rel="stylesheet" type="text/css" href="datas/assets/simple-wysiwyg-editor/css/style.css">
		<!-- Bootstrap Core CSS -->
		<link href="datas/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- MetisMenu CSS -->
		<!-- lineicons-gh-pages -->
		<link rel="stylesheet" type="text/css" href="datas/assets/lineicons-gh-pages/styles.css">
		<!-- Animate CSS -->
		<link rel="stylesheet" href="datas/assets/animate.css-master/animate.min.css">
		<!-- Sparkline CSS -->
		<link rel="stylesheet" type="text/css" href="datas/assets/chartist-js-develop/dist/chartist.min.css">
		<!-- Chartist Tool Tip CSS -->
		<link rel="stylesheet" type="text/css" href="datas/assets/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css">
		<!-- Morris Chart CSS -->
		<link href="datas/assets/morris.js-master/morris.css" rel="stylesheet" />
		<!-- Sweet alert CSS -->
		<link rel="stylesheet" type="text/css" href="datas/min/csk.min.css">
		<!-- MediaQuery CSS -->
		<link rel="stylesheet" type="text/css" href="datas/css/media-query.css">
		<!-- Dashboard 3 CSS -->
		<link rel="stylesheet" type="text/css" href="datas/css/dashboard-3.css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body style="min-height: 100%;">
		<!-- Fixed navbar -->
		<nav class="navbar navbar-fixed-top notification navbar-default">

				<div class="navbar-header">
				</div>
				<a href="#menu-toggle" class="" id="menu-toggle">
					<i class="fa fa-bars" aria-hidden="true">
					</i>
				</a>
				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown messages-menu">				
						<!-- User Account Menu -->
						<li class="dropdown user user-menu">
							<!-- Menu Toggle Button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<!-- The user image in the navbar-->
                                
								<img src="datas/images/avatars/captain-avatar.png" class="user-image" alt="User Image">
								<!-- hidden-xs hides the username on small devices so only the image appears. -->
							</a>
							<ul class="dropdown-menu">
								<!-- The user image in the menu -->
								<li class="user-header">
									<img src="datas/images/avatars/captain-avatar.png" class="user-image" alt="User Image">
									<p>
										admin
										<small>Admin
										</small>
									</p>
								</li>
								<!-- Menu Body -->
									<div class="pull-right">
										<a href="../logout.php?logout=true" class="btn btn-danger">Sign out
										</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				<!-- # navbar-custom-menu -->
			<!-- # container-fluid -->
		</nav>
		<!-- Main Body content starts here -->
		<div id="wrapper">
			<!-- Sidebar -->
			<div id="sidebar-wrapper">
				<aside class="sidebar">
					<nav class="sidebar-nav" id="sidebarscroll">
						<ul class="metismenu ripple" id="menu">
							<li>
								<li>
										<a href="users.php">
											<span class="sidebar-nav-item-icon fa fa-database fa-fw"></span>
											<span class="aText">Users</span>
										</a>
									</li>
                            <li>
										<a href="products.php">
											<span class="sidebar-nav-item-icon fa fa-database fa-fw"></span>
											<span class="aText">Products</span>
										</a>
									</li>
									<li>
										<a href="suppliers.php">
											<span class="sidebar-nav-item-icon ion-ios-paper fa-fw"></span>
											<span class="aText">Suppliers</span>
										</a>
									</li>
									<li>
										<a href="orders.php">
											<span class="sidebar-nav-item-icon fa fa-database fa-fw"></span>
											<span class="aText">Orders</span>
										</a>
									</li>
								</ul>
							</li>
							
						</ul>
					</nav>
				</aside>
			</div>
			<!-- # Sidebar-wrapper -->

					<!-- Calendar -->

					<div class="col-md-12 container   dashboard3date" style="height: 100%;">
						<div class="datepicker">
							<div class="datepicker-header"></div>
						</div>
					</div>




		<!-- # Wrapper -->
		<!-- GoogleApi jQuery -->
		<script type="text/javascript " src="datas/assets/jquery-1.12.4/jquery-1.12.4.js "></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="datas/bootstrap/js/bootstrap.min.js "></script>
		<!-- Metis menu min.JS -->
		<script type="text/javascript " src="datas/assets/metisMenu-master/dist/metisMenu.min.js "></script>
		<!-- Slim Scroll -->
		<script type="text/javascript" src="datas/assets/jQuery-slimScroll-1.3.8/jquery.slimscroll.js"></script>
		<!-- App JS -->
		<script type="text/javascript" src="datas/js/app.js"></script>
		<!-- Calendar -->
		<script src="datas/js/jquery-ui.js"></script>
		
		<!-- High Chats JS -->
		<script type="text/javascript " src="datas/assets/Highcharts-4.2.5/js/highcharts.js "></script>
		<script src="datas/assets/Highcharts-4.2.5/js/highcharts-more.js "></script>
		<!-- Highchart-data JS -->
		<script type="text/javascript " src="datas/js/highcharts-data.js "></script>
		<!-- 3D chart JS -->
		<script src="datas/assets/Highcharts-4.2.5/js/highcharts-3d.js"></script>
		<script type="text/javascript" src="datas/assets/chartist-js-develop/dist/chartist.js"></script>
		<!-- Area chart & Donut & Activity JS  -->
		<script src="datas/js/raphael-min.js"></script>
		<script src="datas/assets/morris.js-master/morris.min.js"></script>
		<!-- Project Dahsboard JS -->
		<script type="text/javascript" src="datas/js/project-dashboard.js"></script>
		<!-- dashboard-3 JS -->
		<script type="text/javascript" src="datas/js/dashboard-3.js"></script>
		<!-- jQuery Sparklines -->
		<script src="datas/js/jquery.sparkline.min.js"></script>
		
	</body>
</html>