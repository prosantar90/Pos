<?php 
require_once 'includes/header.php'; 
require_once 'includes/sidebar.php';
$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'collection-date';
?>
<!-- Start Main content -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <!-- order-card start -->
                       
                       
                        <!-- order-card end -->

                        <!-- Customer overview start -->
                        <div class="col-lg-12 col-md-12">
                            <div class="card table-card">
                                <h1 class="text-center p-5"><img src="https://media.tenor.com/2DtKl6RaM8QAAAAi/dawaii-colorful.gif" alt="">Welcome <img src="https://media.tenor.com/2DtKl6RaM8QAAAAi/dawaii-colorful.gif" alt=""></h1>
                            </div>
                        </div>
        
                    </div>
                </div>
                <div id="styleSelector">
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center" id="footer">
        <a href="#" class="text-center">❤️ Powered By Prosanta ❤️</a>
    </footer>
</div>
<!-- End Main content -->
<?php include 'includes/footer.php';?>