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

$ido = $_GET['id'];


$query = $dbh->prepare("SELECT * FROM products  WHERE idpdct=$ido");
$query->execute();
$result = $query->fetchall();
foreach ($result as $row) {

    $namep = $row['namep'];
    $idf=$row['idf'];
    $descri=$row['descri'];
    $pic=$row['pic1'];
    $cate=$row['category'];
    $price=$row['price'];
    $quan=$row['quantity'];
    $maxp=$row['maxp'];
    $minp=$row['minp'];
}


if(isset($_POST['btn-updatep'])) {
    $idp = strip_tags($_POST['idp']);
    $namep = strip_tags($_POST['namep']);
    $idf = strip_tags($_POST['idf']);
    $desc = strip_tags($_POST['descr']);
    $pic = strip_tags($_POST['pic']);
    $price = strip_tags($_POST['price']);
    $categ = strip_tags($_POST['categ']);
    $quan = strip_tags($_POST['quan']);
    $max = strip_tags($_POST['max']);
    $min = strip_tags($_POST['min']);
    if ($auth_user->updatepdct($idp,$namep,$idf,$desc,$pic,$price,$categ,$quan,$max,$min,$ido)) {
        $auth_user->redirect('products.php');
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Update Product</title>
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
    <!-- # contaiwr-fluid -->
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
                    <h3 class="panel-title">Update Product</h3>
                </div>
                <div class="panel-body">
                    <form method="post">
                        <div class="field">
                            <input id="idp" name="idp" type="text" data-length="2,15" required="required" />
                            <label for="idp">ID Product:<?php echo $ido ?></label>
                        </div>
                        <div class="field">
                            <input id="namep" name="namep" type="text" data-length="3,15" required="required" />
                            <label for="namep">Product Name :<?php echo $namep ?></label>
                        </div>
                        <div class="field">
                            <input id="idf" name="idf" type="text" data-length="3,15" required="required" />
                            <label for="idf">ID Supplier :<?php echo $idf ?></label>
                        </div>
                        <div class="field">
                            <input id="desc" name="descr" type="text" data-length="5,15" required="required" />
                            <label for="desc">Description :<?php echo $descri ?></label>
                        </div>
                        <div class="field">
                            <input id="pic" name="pic" type="text" data-length="5,15" required="" />
                            <label for="pic">Picture :<?php echo $pic ?></label>
                        </div>
                        <div class="field">
                            <input id="cate" name="categ" type="text" required="required" />
                            <label for="cate">Category :<?php echo $cate ?></label>
                        </div>
                        <div class="field">
                            <input id="price" name="price" type="text" required="required" />
                            <label for="price">Price : <?php echo $price ?></label>
                        </div>
                        <div class="field ">
                            <input id="quan" name="quan" type="text" required="required" />
                            <label for="quan">Quantity :<?php echo $quan ?></label>
                        </div>
                        <div class="field ">
                            <input id="max" name="max" type="text" required="required" />
                            <label for="max">Maximum :<?php echo $maxp ?></label>
                        </div>
                        <div class="field ">
                            <input id="min" name="min" type="text" required="required" />
                            <label for="min">Minimum :<?php echo $minp ?></label>
                        </div>
                        <button name="btn-updatep" type="submit" class="center btn btn-success btn-lg btn-block" onsumbit=""> Submit</button>
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