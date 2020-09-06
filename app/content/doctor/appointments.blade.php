<?php
$id=$_SESSION['id'];
$db=new \clinela\database\DB();
$user=$db->getUserMeta($id);
$utils=new \clinela\utils\Utils();
$blood_group=$utils->get_blood_group();
$first_name=!empty($user['first_name'])?$user['first_name']:'My Name';
$dob=!empty($user['dob'])?$user['dob']:'01/01/2020';
$img=!empty($user['photo'])?'uploads/'.$user['photo']:'public/img/patients/patient.jpg';

$services=$db->getServices($id);
$profile_info = $db->getUserSpeciality($id);
$profile_speciality = !empty($profile_info) ? $profile_info['speciality'] : 'No Speciality';
$appointments=$db->getDoctorAppointments($id,0);
?>
<div class="container-fluid">

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
                            <h3>Dr. <?php echo $first_name.' '.$user['last_name']?></h3>

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
                            <li class="active">
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
            <div class="appointments">
                <?php if (!empty($appointments)) {
                    foreach ($appointments as $appointment) {
                        $patient=$db->getUserMeta($appointment['user_id']);
                        $patient_info=$db->getUserByID($appointment['user_id']);
                        $slot=$db->getSlotByID($appointment['slot_id']);
                        $patient_img=!empty($patient['photo'])?CONTENT_PATH.'uploads/'.$patient['photo']:CONTENT_PATH.'public/img/patients/patient.jpg';
                        echo '<!-- Appointment List -->
                    <div class="appointment-list">
                        <div class="profile-info-widget">
                            <a href="'.BASE_PATH.'doctor/patient/'.$patient['user_id'].'/" class="booking-doc-img">
                                <img src="'.$patient_img.'" alt="User Image">
                            </a>
                            <div class="profile-det-info">
                                <h3><a href="patient-profile.html">'.$patient['first_name'].' '.$patient['last_name'].'</a></h3>
                                <div class="patient-details">
                                    <h5><i class="far fa-clock"></i> '.date('d M Y',strtotime($appointment['book_date'])).', '.date('h:i A',strtotime($slot['start_time'])).' - '.date('h:i A',strtotime($slot['end_time'])).'</h5>
                                    <h5><i class="fas fa-map-marker-alt"></i> '.$patient['city'].', '.$patient['country'].'</h5>
                                    <h5><i class="fas fa-envelope"></i> '.$patient_info['email'].'</h5>
                                    <h5 class="mb-0"><i class="fas fa-phone"></i> '.$patient['phone'].'</h5>
                                </div>
                            </div>
                        </div>
                        <div class="appointment-action">
                            <a href="'.BASE_PATH.'doctor/patient/'.$patient['user_id'].'/" class="btn btn-sm bg-info-light">
                                <i class="far fa-eye"></i> View
                            </a>';
                        if($appointment['status']==0){
                            echo '<a href="?d=1&app='.$appointment['id'].'" class="btn btn-sm bg-success-light">
                                <i class="fas fa-check"></i> Accept
                            </a>';
                        }else{
                            echo ' <a href="?d=0&app='.$appointment['id'].'" class="btn btn-sm bg-danger-light">
                                <i class="fas fa-times"></i> Cancel
                            </a>';
                        }
                        echo '
                        </div>
                    </div>
                    <!-- /Appointment List -->';
                    }
                }else{
                    echo '                <!-- Appointment List -->
                <div class="appointment-list">
                    <h4><i class="far fa-clock"></i> No new appointments now</h4>
                </div>
                <!-- /Appointment List -->';
                }?>

            </div>
        </div>
    </div>

</div>


