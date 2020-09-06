<?php
$id=$_SESSION['id'];
$db=new \clinela\database\DB();
$user=$db->getUserByID($id);
$meta=$db->getUserMeta($id);
$utils=new \clinela\utils\Utils();
$blood_group=$utils->get_blood_group();
$first_name=!empty($meta['first_name'])?$meta['first_name']:'My Name';
$dob=!empty($meta['dob'])?$meta['dob']:'01/01/2020';
$img=!empty($meta['photo'])?'uploads/'.$meta['photo']:'public/img/patients/patient.jpg';
        ?>
<div class="row">
    <!-- Profile Sidebar -->
    <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
        <div class="profile-sidebar">
            <div class="widget-profile pro-widget-content">
                <div class="profile-info-widget">
                    <a href="#" class="booking-doc-img">
                        <img src="<?php echo CONTENT_PATH.$img?>" alt="User Image">
                    </a>
                    <div class="profile-det-info">
                        <h3><?php echo $first_name.' '.$meta['last_name']?></h3>
                        <div class="patient-details">
                            <h5><i class="fas fa-birthday-cake"></i> <?php echo $dob?></h5>
                            <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i>  <?php echo $meta['city'].', '. $meta['country']?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-widget">
                <nav class="dashboard-menu">
                    <ul>
                        <li>
                            <a href="<?php echo BASE_PATH?>patient/dashboard/">
                                <i class="fas fa-columns"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>patient/favourites/">
                                <i class="fas fa-bookmark"></i>
                                <span>Favourites</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH.'chat/'.$id.'/'?>">
                                <i class="fas fa-comments"></i>
                                <span>Message</span>
                                <small class="unread-msg">23</small>
                            </a>
                        </li>
                        <li >
                            <a href="<?php echo BASE_PATH?>patient/profile/">
                                <i class="fas fa-user-cog"></i>
                                <span>Profile Settings</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo BASE_PATH?>patient/change-password/">
                                <i class="fas fa-lock"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>logout/">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
    <!-- /Profile Sidebar -->

    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-lg-6">

                        <!-- Change Password Form -->
                        <form method="post">
                            <div class="form-group">
                                <label>Old Password</label>
                                <input type="password" class="form-control" name="old-pass">
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="new-pass">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="confirm-pass">
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                            </div>
                        </form>
                        <!-- /Change Password Form -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
