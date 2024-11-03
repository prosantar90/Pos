<?php 
// ob_start("minifier");
// function minifier($code) {
// 	$search = array(
		
// 		// Remove whitespaces after tags
// 		'/\>[^\S ]+/s',
		
// 		// Remove whitespaces before tags
// 		'/[^\S ]+\</s',
		
// 		// Remove multiple whitespace sequences
// 		'/(\s)+/s',
		
// 		// Removes comments
// 		'/<!--(.|\s)*?-->/'
// 	);
// 	$replace = array('>', '<', '\\1');
// 	$code = preg_replace($search, $replace, $code);
// 	return $code;
// }
include 'config/config.php';
date_default_timezone_set('Asia/Kolkata');
require_once 'action.php';
// if (! session_start()) {
//     session_start();
// }
if (!isset($_SESSION['username'])) {
    header('location: login.php');
    exit('You are not login');
}
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?= $comName?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!-- Favicon icon -->
<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
<!-- Google font-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
<!-- Required Fremwork -->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
<!-- Datatable -->
 <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
<link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<!-- Select2 css -->
<link rel="stylesheet" href="assets/select2/css/select2.min.css">
<link rel="stylesheet" href="assets/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Sweet Alert -->
 <link rel="stylesheet" type="text/css" href="assets/sweetalert/sweetalert.min.css">
<!-- themify-icons line icon -->
<link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
<link rel="stylesheet" type="text/css" href="assets/icon/font-awesome/css/font-awesome.min.css">
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
<!-- Style.css -->
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
</head>
<body>
<!-- Pre-loader start -->
<div class="theme-loader">
<div class="loader-track">
    <div class="loader-bar"></div>
</div>
</div>
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
<div class="pcoded-overlay-box"></div>
<div class="pcoded-container navbar-wrapper">
<nav class="navbar header-navbar pcoded-header">
<div class="navbar-wrapper">
    <div class="navbar-logo">
        <a class="mobile-menu" id="mobile-collapse" href="#!">
            <i class="ti-menu"></i>
        </a>
        <div class="mobile-search">
            <div class="header-search">
                <div class="main-search morphsearch-search">
                    <div class="input-group">
                        <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                        <input type="text" class="form-control" placeholder="Enter Keyword">
                        <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <a href="index.php" class="text-center">
            <p><?= $comName;?></p>
        </a>
        <a class="mobile-options">
            <i class="ti-more"></i>
        </a>
    </div>

    <div class="navbar-container container-fluid">
        <ul class="nav-left">
            <li>
                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
            </li>
            <li class="header-search">
                <div class="main-search morphsearch-search">
                    <div class="input-group">
                        <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                        <input type="text" class="form-control">
                        <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                    </div>
                </div>
            </li>
            <li>
                <a href="#!" onclick="javascript:toggleFullScreen()">
                    <i class="ti-fullscreen"></i>
                </a>
            </li>
        </ul>
        <ul class="nav-right">
            <li class="user-profile header-notification">
                <a href="#!">
                    <img src="<?= $uphoto;?>" class="img-radius" alt="User-Profile-Image">
                    <span><?= $_SESSION['username'];?></span>
                    <i class="ti-angle-down"></i>
                </a>
                <ul class="show-notification profile-notification">
                    <li>
                        <a href="profile.php">
                            <i class="ti-user"></i> Profile
                        </a>
                    </li>
                      <li>
                        <a href="/pos/backup/">
                            <i class="ti-user"></i> Backup 
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">
                            <i class="ti-layout-sidebar-left"></i> Log Out
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
</nav>