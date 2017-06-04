<?php
require_once("session.php");
require_once("classuser.php");

$auth_user = new USER();
$database=new Database();
$dbh = $database->dbConnection();

$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM users WHERE id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);


$query = $dbh->prepare("SELECT count(*) FROM orderuser WHERE iduser=:user_id");
$query->execute(array(":user_id"=>$user_id));
$rslt = $query->fetchall();
foreach ($rslt as $row){
    $num=$row[0];
}


$qr=$dbh ->prepare("SELECT * FROM products JOIN orderuser ON orderuser.idp=products.idpdct WHERE iduser=:user_id");
$qr->execute(array(":user_id"=>$user_id));
$frslt = $qr ->fetchAll();


?>



<!DOCTYPE html>
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>Fst Product Center</title>
    <!-- META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fst Product Center">
    <meta name="author" content="Khalil_Nouili">

    <!-- ICON -->
    <link rel="shortcut icon" href="FSTLOGO.svg.svg.png">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!--  STYLE -->
    <link rel="stylesheet" href="css/style.css">
    <!-- ANIMATE -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- MAGNIFIC POPUP -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- FLEXSLIDER -->
    <link rel="stylesheet" href="plugins/FlexSlider/jquery.flexslider.css">
    <!--  OWL CAROUSEL -->
    <link rel="stylesheet" href="plugins/owl-carousel/owl.carousel.css">
    <!-- OWL CAROUSEL THEME -->
    <link rel="stylesheet" href="plugins/owl-carousel/owl.theme.css">
    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <!-- slick-theme -->
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css">

    <!-- WEB FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
    <link href="http://fonts.googleapis.com/css?family=Raleway:500,800" rel="stylesheet" property="stylesheet" type="text/css" media="all" />
</head>


<body>

<!-- Site Wraper -->
<div class="wrapper">


    <!-- Header -->
    <div class="header header-static">
        <!-- Topbar -->
        <div class="topbar">

            <div class="container">
                <div class="row">
                    <!-- left-side empty -->
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ul class="list-inline topbar-right pull-right">
                            <li><label><a href="logout.php?logout=true"><i class="glyphicon glyphicon-log-out"></i> logout</a></label>

                                | <a href="register.php">Register</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->

        <!-- Navbar -->
        <div class="navbar navbar-default mega-menu" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".cd-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="home.php">
                        <img  id="logo-header" src="img/FSTlogo.png" alt="Logo" height="41px" width="132px" style="position:absolute ; top:0px">
                    </a>
                </div>

                <div class="shop-badge badge-icons pull-right">
                    <a href="checkout.php"><i class="fa fa-shopping-bag"></i></a>
                    <span class="badge badge-sea rounded-x"><?php echo"$num" ?></span>
                </div>


                <div class="collapse navbar-collapse cd-navbar-collapse">
                    <!-- Nav Menu -->
                    <ul class="nav navbar-nav">

                        <!-- Pages -->
                        <li class="dropdown ">
                            <a href="home.php">
                                Home
                            </a>
                            <!-- End Pages -->
                            <!-- Pages -->
                            <!-- Pages -->
                        <li class="dropdown active">
                            <a href="shop-grid-left.php">
                                Shop
                            </a>
                        </li>
                        <!-- End Pages -->
                    </ul>
                    <!-- End Nav Menu -->
                </div>
            </div>
        </div>
        <!-- End Navbar -->
    </div>
      
            <!-- Start Breadcrumb -->
            <div class="page-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h1 class="title"><span>Checkout</span></h1>
                            <div class="breadcrumb">
                                <a href="index.html">Home</a>
                                <span class="delimeter">/</span> 
                                <span class="current">Checkout</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Breadcrumb -->
            
            <section class="main-contain bg-white">
                <div class="container">
                                <div class="shopping-cart-block">
                                    <ul class="title clearfix">
                                        <li class="col-md-2 col-sm-2 col-xs-6">Image</li>
                                        <li class="col-md-3 col-sm-3 col-xs-6">Product Name</li>
                                        <li class="col-md-2 col-sm-2 col-xs-6">Quantity</li>
                                        <li class="col-md-2 col-sm-2 col-xs-6">Unite Price</li>
                                        <li class="col-md-2 col-sm-2 col-xs-6">Sub Total</li>
                                        <li class="col-md-1 col-sm-1 col-xs-6">Action</li>
                                    </ul>
                                    <?php
                                    $i=0;
                                    $total=0;
                                    foreach ($frslt as $row) {
                                        $quan=$row['quantity'];
                                        $price=$row['price'];
                                        $fprice=$price * $quan;
                                        $i=$i+1;
                                        echo "
                                    <ul class='shopping-cart-cd clearfix'>
                                        <li class='col-md-2 col-sm-2 col-xs-2'><figure><img src='img/products/cart1.jpg' alt='' /></figure></li>
                                        <li class='col-md-3 col-sm-1 col-xs-6 cd-shopping'>
                                          <h6>".$row['namep']."</h6>
                                        </li>
                                        <li class='col-md-2 col-sm-2 col-xs-6'>
                                        <form method='post' action='applyc.php'>
                                     <button type='button' class='quantity-button' name='subtract' onclick='javascript: document.getElementById(\"qt".$i."\").value--;' value='-'>-</button>                                    
                                            <input type='text' class='quantity-field' name='qty[]' id='qt".$i."' value=".$row['quantity']." />
                                            <button type='button' class='quantity-button' name='add' onclick='javascript: document.getElementById(\"qt".$i."\").value++;' value='+'>+</button>
                                        
                                        </li>
                                        <li class='col-md-2 col-sm-2 col-xs-6'>".$row['price']."</li>
                                        <li class='col-md-2 col-sm-2 col-xs-6'>".$fprice."</li>
                                        <li class='col-md-1 col-sm-1 col-xs-6'><a href='deletecheckout.php?id=".$row['idor']."'>X</a></li>
                                    </ul> ";
                                        $total=$total+$fprice;
                                    }
?>

                                </div>
                    
                        <div class="shopping-cart-checkout">

                <div class="coupon-code">
                        <div class="row">
                            <div class="col-sm-4 sm-margin-bottom-30">
                            </div>
                            <div class="pull-right">
                                <ul class="list-inline total-result">
                                    <li>
                                        <h4>Subtotal:</h4>
                                        <div class="total-result-in">
                                            <span><?php echo $total  ?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <h4>Shipping:</h4>
                                        <div class="total-result-in">
                                            <span class="text-right">- - - -</span>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="total-price">
                                        <h4>Total:</h4>
                                        <div class="total-result-in">
                                            <span><?php echo $total  ?></span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="mb30"></div>
                                <div class="pull-right">
                                  <button type="submit" class="btn btn-product btn-group ">Apply Changes</button></a>
                                    </form>

                                    <a href="fcheckout.php" ><button class="btn btn-product btn-group " >Checkout</button></a>
                                </div>


                            </div>
                        </div>
                    </div>
            </div>
                </div>
            </section>

             
               
            <!-- Start Suvbscribe -->
    <div class="news-subscribe">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>subscribe to <strong>newsletter</strong></h3>
                </div>
                <div class="col-md-4 newsletter-form-block">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Email your email...">
                        <span class="input-group-btn">
                                    <button class="btn" type="button"><i class="fa fa-envelope-o"></i></button>
                                </span>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="social-footer">
                        <ul class="social-icons social-icons-simple">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Suvbscribe -->


    <!-- START FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- CONTACT WIDGET -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="widget">
                        <h6 class="text-uppercase bottom-line">Contact Us</h6>
                        <address>
                            <p>Compus Of Manar, Manar1,Tunis,
                                Tunisia,</p><br>
                            <p>Phone: (+216) 154213</p>
                            <p>Fax: (+216) 465482</p>
                            <p>E-mail: <a href="mailto:fst.rnu.tn@gmail.com">fst@gmail.com</a></p>
                        </address>
                    </div>
                </div>
                <!-- END CONTACT WIDGET -->
                <!-- CATEGORIES WIDGET -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="widget">
                        <h6 class="montserrat text-uppercase bottom-line">Categories</h6>
                        <ul class="icons-list">
                            <li><a href="#">Computers <span class="pull-right">12</span></a></li>
                            <li><a href="#">Keyboards <span class="pull-right">11</span></a></li>
                            <li><a href="#">Mouse <span class="pull-right">10</span></a></li>
                            <li><a href="#">Servers <span class="pull-right">14</span></a></li>
                            <li><a href="#"> Monitors<span class="pull-right">15</span></a></li>
                        </ul>
                    </div>
                </div>
                <!-- END CATEGORIES WIDGET -->
                <!-- CATEGORIES WIDGET -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="widget">
                        <h6 class="montserrat text-uppercase bottom-line">Quick Links</h6>
                        <ul class="icons-list">
                            <li><a href="home.php">Home</a></li>
                            <li><a href="shop-grid-left.php">Shop</a></li>
                        </ul>
                    </div>
                </div>
                <!-- END CATEGORIES WIDGET -->
            </div>
            <!-- CONTACT WIDGET -->
            <div class="copyright">
                <div class="text-center">
                    <p>© All Rights Reserved @  <a target="_blank" href="http://www.fst.rnu.tn/fr/">Faculty Of Sciences Tunis</a></p>
                </div>
            </div>

        </div>
    </footer>
    <!-- END FOOTER-->
</div>
<!-- JQUERY LIBS -->
<script type="text/javascript"  src="js/jquery.min.js"></script>
<!-- BOOTSTRAP -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- OWL CAROUSEL -->
<script type="text/javascript" src="plugins/owl-carousel/owl.carousel.min.js"></script>
<!-- FLEXSLIDER -->
<script type="text/javascript" src="plugins/FlexSlider/jquery.flexslider-min.js"></script>
<!-- MAGNIFIC POPUP-->
<script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
<!-- MAGNIFIC POPUP  -->
<script type="text/javascript" src="js/magnific-popup.min.js"></script>
<!-- slick-->
<script type="text/javascript" src="js/slick.js"></script>
<!-- slick-slider-->
<script type="text/javascript" src="js/slick-slider.js"></script>
<!-- plugins-->
<script type="text/javascript" src="js/plugins.min.js"></script>
<!-- CUSTOM-->
<script type="text/javascript" src="js/custom.js"></script>

<!--[if lt IE 9]>
<script src="respond.js"></script>
<script src="html5shiv.js"></script>
<![endif]-->

</body>
</html>
