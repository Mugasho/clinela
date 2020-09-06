<?php
$db=new \clinela\database\DB();
$logo=!empty($db->getOptions('header_logo'))?CONTENT_PATH.'uploads/'.$db->getOptions('header_logo'):CONTENT_PATH.'public/img/clinela-logo-red.jpg';
?>

<!-- Logo -->
<div class="header-left">
    <a href="<?php echo BASE_PATH?>" class="logo">
        <img src="<?php echo $logo?>" alt="Logo">
    </a>
    <a href="<?php echo BASE_PATH?>" class="logo logo-small">
        <img src="<?php echo $logo?>" alt="Logo" height="40">
    </a>
</div>
<!-- /Logo -->

<a href="javascript:void(0);" id="toggle_btn">
    <i class="fe fe-text-align-left"></i>
</a>

<div class="top-nav-search">
    <form>
        <input type="text" class="form-control" placeholder="Search here" name="s">
        <button class="btn" type="submit"><i class="fa fa-search"></i></button>
    </form>
</div>

<!-- Mobile Menu Toggle -->
<a class="mobile_btn" id="mobile_btn">
    <i class="fa fa-bars"></i>
</a>
<!-- /Mobile Menu Toggle -->

<?php if (isset($_SESSION['id'])) {
$meta=$db->getUserMeta($_SESSION['id']);
$user=$db->getUserByID($_SESSION['id']);
$img=!empty($meta['photo'])?'uploads/'.$meta['photo']:'public/img/patients/patient.jpg';
?>
<!-- Header Right Menu -->
<ul class="nav user-menu">

    <!-- Notifications -->
    <li class="nav-item dropdown noti-dropdown">
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
            <i class="fe fe-bell"></i> <span class="badge badge-pill">3</span>
        </a>
        <div class="dropdown-menu notifications">
            <div class="topnav-dropdown-header">
                <span class="notification-title">Notifications</span>
                <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
            </div>
            <div class="noti-content">
                <ul class="notification-list">
                    <li class="notification-message">
                        <a href="#">
                            <div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="<?php echo CONTENT_PATH?>admin/img/doctors/doctor-thumb-01.jpg">
												</span>
                                <div class="media-body">
                                    <p class="noti-details"><span class="noti-title">Dr. Ruby Perrin</span> Schedule <span class="noti-title">her appointment</span></p>
                                    <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="notification-message">
                        <a href="#">
                            <div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="<?php echo CONTENT_PATH?>admin/img/patients/patient1.jpg">
												</span>
                                <div class="media-body">
                                    <p class="noti-details"><span class="noti-title">Charlene Reed</span> has booked her appointment to <span class="noti-title">Dr. Ruby Perrin</span></p>
                                    <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="notification-message">
                        <a href="#">
                            <div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="<?php echo CONTENT_PATH?>admin/img/patients/patient2.jpg">
												</span>
                                <div class="media-body">
                                    <p class="noti-details"><span class="noti-title">Travis Trimble</span> sent a amount of $210 for his <span class="noti-title">appointment</span></p>
                                    <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="notification-message">
                        <a href="#">
                            <div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="<?php echo CONTENT_PATH?>admin/img/patients/patient3.jpg">
												</span>
                                <div class="media-body">
                                    <p class="noti-details"><span class="noti-title">Carl Kelly</span> send a message <span class="noti-title"> to his doctor</span></p>
                                    <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="topnav-dropdown-footer">
                <a href="#">View all Notifications</a>
            </div>
        </div>
    </li>
    <!-- /Notifications -->

    <!-- User Menu -->
    <li class="nav-item dropdown has-arrow">
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
            <span class="user-img"><img class="rounded-circle" src="<?php echo CONTENT_PATH.$img?>" height="31" width="31" alt="<?php echo $user['username']?>"></span>
        </a>
        <div class="dropdown-menu">
            <div class="user-header">
                <div class="avatar avatar-sm">
                    <img src="<?php echo CONTENT_PATH.$img?>" alt="User Image" width="31" height="31" class="avatar-img rounded-circle">
                </div>
                <div class="user-text">
                    <h6><?php echo $user['username']?></h6>
                    <p class="text-muted mb-0">Administrator</p>
                </div>
            </div>
            <a class="dropdown-item" href="<?php echo BASE_PATH?>">Visit Site</a>
            <a class="dropdown-item" href="<?php echo BASE_PATH?>doctor/profile/">My Profile</a>
            <a class="dropdown-item" href="<?php echo BASE_PATH?>admin/settings/">Settings</a>
            <a class="dropdown-item" href="<?php echo BASE_PATH?>logout/">Logout</a>
        </div>
    </li>
    <!-- /User Menu -->

</ul>
<!-- /Header Right Menu -->
<?php }?>