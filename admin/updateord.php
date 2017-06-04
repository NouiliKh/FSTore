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
		<title>Form Validations | CSK - Admin Template | Zeasts</title>
		<!-- Icon -->
		<link rel="icon" href="datas/images/icon.ico">
		<!-- Bootstrap Core CSS -->
		<link href="datas/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Animate CSS -->
		<link rel="stylesheet" href="datas/assets/animate.css-master/animate.min.css">
		<!-- Theme  CSS -->
		<link rel="stylesheet" type="text/css" href="datas/min/csk.min.css">
		<!-- MediaQuery CSS -->
		<link rel="stylesheet" type="text/css" href="datas/css/media-query.css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
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
				<!-- row -->
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-body animated fadeInLeft">
							<div class="panel-heading">
								<h3 class="panel-title">Bootstrap validation form</h3>
							</div>
							<div class="panel-body">
								<form id="form">
									<div class="field">
										<input id="firstname" type="text" data-length="5,15" required="required" />
										<label for="firstname">First Name</label>
									</div>
									<div class="field">
										<input id="secondname" type="text" data-length="5,15" required="required" />
										<label for="secondname">Second Name</label>
									</div>
									<div class="field">
										<input id="userName" type="text" data-length="5,15" required="required" />
										<label for="userName">User Name</label>
									</div>
									<div class="field">
										<input id="password" type="password" required="required" />
										<label for="password">Password</label>
									</div>
									<div class="field ">
										<input id="confirm" type="password" required="required" />
										<label for="confirm">Confirm Password</label>
									</div>
									<div class="field">
										<input id="DOB" type="date" data-length="5,15" required="required" />
									</div>
									<div class="field">
										<input id="mobile" type="tel" data-length="5,15" required="required" />
										<label for="mobile">Mobile</label>
									</div>
									<div class="field">
										<div class="confirm">
										</div>
									</div>
									<button type="submit" class="center btn btn-success btn-lg btn-block"> Submit</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- #row -->
		</div>
		<!-- # page-content-wrapper -->
	</div>
	<!-- # Wrapper -->
	<!-- GoogleApi jQuery -->
	<script type="text/javascript" src="datas/assets/jquery-1.12.4/jquery-1.12.4.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="datas/bootstrap/js/bootstrap.min.js"></script>
	<!-- Metis menu min.JS -->
	<script type="text/javascript" src="datas/assets/metisMenu-master/dist/metisMenu.min.js"></script>
	<!-- Slim Scroll -->
	<script type="text/javascript" src="datas/assets/jQuery-slimScroll-1.3.8/jquery.slimscroll.js"></script>
	<!-- App JS  -->
	<script type="text/javascript" src="datas/js/app.js"></script>
	<!-- Page Level JS -->
	<!-- Validationform JS -->
	<script src="datas/js/validationform.js"></script>
	
</body>
</html>