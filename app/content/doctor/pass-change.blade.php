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

$services=$db->getServices($id);
$profile_info = $db->getUserSpeciality($id);
$profile_speciality = !empty($profile_info) ? $profile_info['speciality'] : 'No Speciality';
?>
<div class="row">
    <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

        <!-- Profile Sidebar -->
        <div class="profile-sidebar">
            <div class="widget-profile pro-widget-content">
                <div class="profile-info-widget">
                    <a href="#" class="booking-doc-img">
                        <img src="<?php echo CONTENT_PATH.$img?>" alt="User Image">
                    </a>
                    <div class="profile-det-info">
                        <h3>Dr. <?php echo $first_name.' '.$meta['last_name']?></h3>

                        <div class="patient-details">
                            <h5 class="mb-0"><?php echo $profile_speciality?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-widget">
                <nav class="dashboard-menu">
                    <ul>
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/dashboard/">
                                <i class="fas fa-columns"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/appointments/">
                                <i class="fas fa-calendar-check"></i>
                                <span>Appointments</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/my-patients/">
                                <i class="fas fa-user-injured"></i>
                                <span>My Patients</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/schedule/">
                                <i class="fas fa-hourglass-start"></i>
                                <span>Schedule Timings</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/invoices/">
                                <i class="fas fa-file-invoice"></i>
                                <span>Invoices</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/reviews/">
                                <i class="fas fa-star"></i>
                                <span>Reviews</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH.'chat/'.$id.'/'?>">
                                <i class="fas fa-comments"></i>
                                <span>Message</span>
                                <small class="unread-msg">23</small>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/profile/">
                                <i class="fas fa-user-cog"></i>
                                <span>Profile Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/social-media/">
                                <i class="fas fa-share-alt"></i>
                                <span>Social Media</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo BASE_PATH?>doctor/change-password/">
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
        <!-- /Profile Sidebar -->

    </div>
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-lg-6">

                        <!-- Change Password Form -->
                        <form>
                            <div class="form-group">
                                <label>Old Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control">
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
