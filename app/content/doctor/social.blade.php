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
$links=$db->getSocialLinks($id);
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
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/profile/">
                                <i class="fas fa-user-cog"></i>
                                <span>Profile Settings</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo BASE_PATH?>doctor/social-media/">
                                <i class="fas fa-share-alt"></i>
                                <span>Social Media</span>
                            </a>
                        </li>
                        <li >
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

                <!-- Social Form -->
                <form method="post">
                    <div class="row">
                        <div class="col-md-12 col-lg-8">
                            <div class="form-group">
                                <label>Whatsapp Phone</label>
                                <input type="text" class="form-control" name="whatsapp"
                                       value="<?php echo !empty($links['whatsapp'])?$links['whatsapp']:'';?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-lg-8">
                            <div class="form-group">
                                <label>Facebook URL</label>
                                <input type="text" class="form-control" name="facebook"
                                       value="<?php echo isset($links['facebook'])?$links['facebook']:'';?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-8">
                            <div class="form-group">
                                <label>Twitter URL</label>
                                <input type="text" class="form-control" name="twitter"
                                       value="<?php echo isset($links['twitter'])?$links['twitter']:'';?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-8">
                            <div class="form-group">
                                <label>Instagram URL</label>
                                <input type="text" class="form-control" name="instagram"
                                       value="<?php echo isset($links['instagram'])?$links['instagram']:'';?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-8">
                            <div class="form-group">
                                <label>Telegram URL</label>
                                <input type="text" class="form-control" name="telegram"
                                       value="<?php echo isset($links['telegram'])?$links['telegram']:'';?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-8">
                            <div class="form-group">
                                <label>Linkedin URL</label>
                                <input type="text" class="form-control" name="linkedin"
                                       value="<?php echo isset($links['linkedin'])?$links['linkedin']:'';?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-8">
                            <div class="form-group">
                                <label>Zoom Link</label>
                                <input type="text" class="form-control" name="zoom"
                                       value="<?php echo isset($links['zoom'])?$links['zoom']:'';?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-8">
                            <div class="form-group">
                                <label for >Skype Link</label>
                                <input type="text" class="form-control" name="skype"
                                       value="<?php echo isset($links['skype'])?$links['skype']:'';?>">
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                    </div>
                </form>
                <!-- /Social Form -->

            </div>
        </div>
    </div>
</div>


