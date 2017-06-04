<?php
session_start();
require_once('classuser.php');
$user = new USER();

if($user->is_loggedin()!="")
{
    $user->redirect('home.php');
}

if(isset($_POST['btn-signup']))
{
    $uname = strip_tags($_POST['name']);
    $umail = strip_tags($_POST['email']);
    $upass = strip_tags($_POST['password']);

    if($uname=="")	{
        $error[] = "provide username !";
    }
    else if($umail=="")	{
        $error[] = "provide email id !";
    }
    else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
        $error[] = 'Please enter a valid email address !';
    }
    else if($upass=="")	{
        $error[] = "provide password !";
    }
    else if(strlen($upass) < 2){
        $error[] = "Password must be atleast 2 characters";
    }
    else
    {
        try
        {
            $stmt = $user->runQuery("SELECT fullName, email FROM users WHERE fullName=:uname OR email=:umail");
            $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            if($row['user_name']==$uname) {
                $error[] = "sorry username already taken !";
            }
            else if($row['user_email']==$umail) {
                $error[] = "sorry email id already taken !";
            }
            else
            {
                if($user->register($uname,$umail,$upass)){
                    $user->redirect('login.php');
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}

?>

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


<section>

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
                            <li><a href="login.php">Login</a> | <a href="register.php">Register</a></li>
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
                    <a class="navbar-brand" href="index.php">
                        <img  id="logo-header" src="img/FSTlogo.png" alt="Logo" height="41px" width="132px" style="position:absolute ; top:0px">
                    </a>
                </div>


                <div class="collapse navbar-collapse cd-navbar-collapse">
                    <!-- Nav Menu -->
                    <ul class="nav navbar-nav">

                        <!-- Pages -->
                        <li class="dropdown active">
                            <a href="javascript:void(0);">
                                Home
                            </a>
                            <!-- End Pages -->
                            <!-- Pages -->
                            <!-- Pages -->
                        <li class="dropdown">
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
    <!-- End Header-->

    <!-- Start Breadcrumb -->
            <div class="page-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h1 class="title"><span>Login/Register</span></h1>
                            <div class="breadcrumb">
                                <a href="index.php">Home</a>
                                <span class="delimeter">/</span> 
                                <span class="current">Login/Register</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Breadcrumb -->
            
            
            <section class="main-contain bg-white">
                <div class="container">
    <div class="login-area">
                    <div class="login-header">
                                <div class="login-details">
                                    <ul class="nav nav-tabs navbar-right">
                                        <li class="active"><a data-toggle="tab" href="#register">Register</a></li>
                                        <li ><a  href="login.php">Login</a></li>
                                    </ul>
                                </div>
                        </div>
        <form method="post">
                    <div class="tab-content">
                        <div id="register" class="tab-pane fade in active">
                           <div class="login-inner">
                                <div class="title">
                                    <h1>Welcome to <span>Register</span></h1>
                                </div>
                                <div class="login-form">
                                    <?php
                                    if(isset($error))
                                    {
                                        ?>
                                        <div class="alert alert-danger">
                                            <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <n na>
                                        <div class="form-details">
                                            <label class="user">
                                                <input type="text" name="name" placeholder="Full Name" id="username">
                                            </label>
                                            <label class="mail">
                                                <input type="email" name="email" placeholder="Email Address" id="mail">
                                            </label>
                                            <label class="pass">
                                                <input type="password" name="password" placeholder="Password" id="password">
                                            </label>
                                            <label class="pass">
                                                <input type="password" name="password" placeholder="Confirm Password" id="password">
                                            </label>
                                        </div>
                                        <button name="btn-signup" type="submit" class="form-btn" onsubmit="">Register</button>
                                    </form>
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
                            <li><a href="index.php">Home</a></li>
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