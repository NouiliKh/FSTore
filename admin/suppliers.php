<?php
require_once("../session.php");
require_once("../classuser.php");

$auth_user = new USER();
$database=new Database();
$dbh = $database->dbConnection();


$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM users WHERE id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$query = $dbh->prepare("SELECT * FROM suppliers ");
$query->execute();
$result = $query->fetchall();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Data Tables | CSK - Admin Template | Zeasts</title>
		<!-- Icon -->
		<link rel="icon" href="datas/images/icon.ico">
		<!-- Bootstrap Core CSS -->
		<link href="datas/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Animate CSS -->
		<link rel="stylesheet" href="datas/assets/animate.css-master/animate.min.css">
		<!-- Page Level css -->
		<link rel="stylesheet" type="text/css" href="datas/assets/DataTables-1.10.12/media/css/dataTables.bootstrap.css">
		<!-- Bootstrap-table CSS -->
		<link rel="stylesheet" type="text/css" href="datas/assets/bootstrap-table-develop/src/bootstrap-table.css">
		<!-- Table CSS -->
		<link rel="stylesheet" type="text/css" href="datas/css/tables.css">
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
			<!-- # Sidebar-wrapper -->
			<!-- Page Content -->
			<div id="page-content-wrapper">
				<!-- breadcrumb starts here -->
				<div class="row csk-breadcrumb">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h4 class="page-title">Data Tables</h4>
					</div>
					<div class="col-lg-9 col-md-8 col-sm-8 hidden-xs">
						<ol class="breadcrumb">
							<li><a href="admin.php">Home</a></li>
                            <li><a href="suppliers.php">Suppliers</a></li>
						</ol>
					</div>
				</div>
				<!-- # Breadcrumb Ends Here -->
				<!-- Main content -->
				<!-- row starts -->
				<!-- #row ends -->
				<!-- row starts -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="panel panel-default box">
                            <div class="panel-heading">
                                <h3 class="panel-title"> Suppliers</h3>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <table id="clicktoedit" class="table table-bordered table-striped">
										<thead class="bg-inverse">
											<tr class="text-center">
												<th class="text-center">Supplier ID</th>
												<th class="text-center">Supplier Name</th>
												<th class="text-center">Adress</th>
												<th class="text-center">Fax</th>
												<th class="text-center">Tel</th>
												<th class="text-center">Options</th>
											</tr>
										</thead>
<?php

foreach($result as $row) {
    $idf = $row['idf'];
                                        echo "<tbody >
											<tr >
												<td tabindex = '1' class='text-center' >".$row['idf']."</td >
												<td tabindex = '1' class='text-center' >".$row['namesup']."</td >
												<td tabindex = '1' class='text-center' >".$row['adress']."</td >
												<td tabindex = '1' class='text-center' >".$row['fax']."</td >
												<td tabindex = '1' class='text-center' >".$row['tel']."</td >
												<td class='text-center' >
													<div class='dropdown'>
														<button class='btn btn-default dropdown-toggle circle-btn ' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
														<i class='fa fa-gear setting-icon'></i>
														</button>
														<ul class='dropdown-menu panel-settings'>
															<li>
																<a  href='./updatesupp.php?idf=".$idf."' class='reloadBar'>
																	Update
																</a>
															</li>
															<li role='separator' class='divider'></li>
															<li>
																<a  href='./deletesupp.php?idf=".$idf."' class='reloadBar'>
																	Delete
																</a>
															</li>
														</ul>
													</div>
												</td >
											</tr >
                                        </tbody >";
    }

?>
                                    </table>
                                </div>
                                <div class="panel-footer">
                                    <a class="btn btn-info add-row" href="newsupp.php">
                                        <button  type="button" class="btn btn-info add-row" data-sort="true"> Add Suppliers  </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

				<!-- #row ends -->
				<!-- # Main content Ends -->
			</div>
			<!-- # page-content-wrapper -->
		</div>
		<!-- # wrapper -->
		<!-- GoogleApi jQuery -->
		<script type="text/javascript" src="datas/assets/jquery-1.12.4/jquery-1.12.4.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="datas/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="datas/assets/metisMenu-master/dist/metisMenu.min.js"></script>
		<!-- SlimScroll -->
		<script type="text/javascript" src="datas/assets/jQuery-slimScroll-1.3.8/jquery.slimscroll.js"></script>
		<!-- App JS  -->
		<script type="text/javascript" src="datas/js/app.js"></script>
		<!-- Page Level JS -->
		<script type="text/javascript" src="datas/assets/bootstrap-table-develop/dist/bootstrap-table.min.js"></script>
		<script type="text/javascript" src="datas/assets/DataTables-1.10.12/media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" src="datas/assets/DataTables-1.10.12/media/js/dataTables.bootstrap.js"></script>
		<script>
			$(function() {
				var $table = $('#table-transform');
				$('#transform').click(function() {
						$table.bootstrapTable();
				});
				$('#destroy').click(function() {
						$table.bootstrapTable('destroy');
				});
			});
		</script>
		<script type="text/javascript" class="init">
			$(document).ready(function() {
				$('.datatable').DataTable();
			});
		</script>

          <script>
            $('#clicktoedit').editableTableWidget().focus();
		</script>
	</body>
</html>