<div class="pcoded-main-container">
<div class="pcoded-wrapper">
<!-- Start Sidebar -->
<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation"></div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="active">
                <a href="index.php">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
 
      
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.other">Users</div>

        <ul class="pcoded-item pcoded-left-item">
         <li class="pcoded-hasmenu ">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-direction-alt"></i><b>U</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.main">Customers</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="customers.php">
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Customers List</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="">
                        <a href="customers-frm.php">
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Add New</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="pcoded-hasmenu ">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-direction-alt"></i><b>U</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.main">Attendance</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="attendance.php">
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Group Attendance</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="">
                        <a href="group_frm.php">
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Add New</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pcoded-hasmenu ">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-direction-alt"></i><b>U</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.main">Groups</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="group.php">
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Group List</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="">
                        <a href="group_frm.php">
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Add New</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>

            <?php if($urole === 'admin'){?>
            <li class="pcoded-hasmenu ">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-direction-alt"></i><b>U</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.main">Users</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                     <li class="">
                        <a href="users.php">
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">User List</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="">
                        <a href="user_frm.php">
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Add New</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>
            <?php }?>
            
            

        </ul>
          <ul class="pcoded-item pcoded-left-item">
           

             
        </ul>
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Reports</div>
         <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu ">
                <a href="#">
                    <span class="pcoded-micon"><i class="ti-bar-chart"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">All Reports</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                
                 <ul class="pcoded-submenu">
                     <li class="">
                        <a href="customers.php">
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Customer Report</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="">
                        <a href="salesmans.php">
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Sales Man report</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                     <li class="">
                        <a href="suplier-list.php">
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-21">Supplier report</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>

    </div>
</nav>
    <!-- End sidebar -->