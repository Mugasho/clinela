<?php
$id = $_SESSION['id'];
$db = new \clinela\database\DB();
$user = $db->getUserByID($id);
$meta = $db->getUserMeta($id);
$utils = new \clinela\utils\Utils();
$blood_group = $utils->get_blood_group();
$first_name = !empty($meta['first_name']) ? $meta['first_name'] : 'My Name';
$dob = !empty($meta['dob']) ? $meta['dob'] : '01/01/2020';
$img = !empty($meta['photo']) ? 'uploads/' . $meta['photo'] : 'public/img/patients/patient.jpg';

$services = $db->getServices($id);
$profile_info = $db->getUserSpeciality($id);
$profile_speciality = !empty($profile_info) ? $profile_info['speciality'] : 'No Speciality';
$appointments = $db->getDoctorAppointments($id);
$today_appointments = $db->getTodayAppointments($id);
$coming_appointments = $db->getUpcomingAppointments($id);
?>

<div class="row">
    <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

        <!-- Profile Sidebar -->
        <div class="profile-sidebar">
            <div class="widget-profile pro-widget-content">
                <div class="profile-info-widget">
                    <a href="#" class="booking-doc-img">
                        <img src="<?php echo CONTENT_PATH . $img?>" alt="User Image">
                    </a>
                    <div class="profile-det-info">
                        <h3>Dr. <?php echo $first_name . ' ' . $meta['last_name']?></h3>

                        <div class="patient-details">
                            <h5 class="mb-0"><?php echo $profile_speciality?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-widget">
                <nav class="dashboard-menu">
                    <ul>
                        <li class="active">
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
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/social-media/">
                                <i class="fas fa-share-alt"></i>
                                <span>Social Media</span>
                            </a>
                        </li>
                        <li>
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

        <div class="row">
            <div class="col-md-12">
                <div class="card dash-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-4">
                                <div class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar1">
                                        <div class="circle-graph1" data-percent="75">
                                            <img src="<?php echo CONTENT_PATH?>public/img/icon-01.png" class="img-fluid"
                                                 alt="patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Patient</h6>
                                        <h3><?php echo count($appointments)?></h3>
                                        <p class="text-muted">Till Today</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4">
                                <div class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar2">
                                        <div class="circle-graph2" data-percent="65">
                                            <img src="<?php echo CONTENT_PATH?>public/img/icon-02.png" class="img-fluid"
                                                 alt="Patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Today Patient</h6>
                                        <h3><?php echo count($today_appointments)?></h3>
                                        <p class="text-muted"><?php echo date('d, M Y')?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4">
                                <div class="dash-widget">
                                    <div class="circle-bar circle-bar3">
                                        <div class="circle-graph3" data-percent="50">
                                            <img src="<?php echo CONTENT_PATH?>public/img/icon-03.png" class="img-fluid"
                                                 alt="Patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Appointments</h6>
                                        <h3><?php echo count($today_appointments)?></h3>
                                        <p class="text-muted"><?php echo date('d, M Y')?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Patient Appoinment</h4>
                <div class="appointment-tab">

                    <!-- Appointment Tab -->
                    <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                        <li class="nav-item">
                            <a class="nav-link active" href="#upcoming-appointments" data-toggle="tab">Upcoming</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#today-appointments" data-toggle="tab">Today</a>
                        </li>
                    </ul>
                    <!-- /Appointment Tab -->

                    <div class="tab-content">

                        <!-- Upcoming Appointment Tab -->
                        <div class="tab-pane show active" id="upcoming-appointments">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                            <tr>
                                                <th>Patient Name</th>
                                                <th>Appt Date</th>
                                                <th>Purpose</th>
                                                <th>Type</th>
                                                <th class="text-center">Paid Amount</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (!empty($coming_appointments)) {
                                                foreach ($coming_appointments as $appointment) {
                                                    $patient = $db->getUserMeta($appointment['user_id']);
                                                    $patient_img = !empty($patient['photo']) ? CONTENT_PATH . 'uploads/' . $patient['photo'] : CONTENT_PATH . 'public/img/patients/patient.jpg';
                                                    $slot = $db->getSlotByID($appointment['slot_id']);
                                                    $service=$db->getServiceByID($appointment['service_id']);
                                                    $service_name=!empty($service)?$service['services']:'Consultation';
                                                    echo '<tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="'.BASE_PATH.'doctor/patient/'.$patient['user_id'].'/" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="' . $patient_img . '" alt="User Image"></a>
                                                            <a href="'.BASE_PATH.'doctor/patient/'.$patient['user_id'].'/">' . $patient['first_name'] . ' ' . $patient['last_name'] . ' <span>#PT0' . $appointment['user_id'] . '</span></a>
                                                        </h2>
                                                    </td>
                                                    <td>' . date('d M Y', strtotime($appointment['book_date'])) . '<span class="d-block text-info"' . $slot['start_time'] . ' ' . $slot['end_time'] . '</span></td>
                                                    <td>'.$service_name.'</td>
                                                    <td>New Patient</td>
                                                    <td class="text-center">Sh' . $appointment['total'] . '</td>
                                                    <td class="text-right">
                                                        <div class="table-action">
                                                            <a href="'.BASE_PATH.'invoices/'.$appointment['id'].'/" class="btn btn-sm bg-primary-light">
                                                                <i class="far fa-eye"></i> View
                                                            </a> ';

                                                    if ($appointment['status'] == 0) {
                                                        echo '<a href="?d=1&app=' . $appointment['id'] . '" class="btn btn-sm bg-success-light">
                                                                    <i class="fas fa-check"></i> Accept
                                                                </a>';
                                                    } else {
                                                        echo ' <a href="?d=0&app=' . $appointment['id'] . '" class="btn btn-sm bg-danger-light">
                                                                    <i class="fas fa-times"></i> Cancel
                                                                </a>';
                                                    }
                                                    echo '
                                                        </div>
                                                    </td>
                                                </tr>';
                                                }
                                            } else {
                                                echo '<tr><td>No Upcoming Appointments</td></tr>';
                                            }?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Upcoming Appointment Tab -->

                        <!-- Today Appointment Tab -->
                        <div class="tab-pane" id="today-appointments">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                            <tr>
                                                <th>Patient Name</th>
                                                <th>Appt Date</th>
                                                <th>Purpose</th>
                                                <th>Type</th>
                                                <th class="text-center">Paid Amount</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (!empty($today_appointments)) {
                                                foreach ($today_appointments as $appointment) {
                                                    $patient = $db->getUserMeta($appointment['user_id']);
                                                    $patient_img = !empty($patient['photo']) ? CONTENT_PATH . 'uploads/' . $patient['photo'] : CONTENT_PATH . 'public/img/patients/patient.jpg';
                                                    $slot = $db->getSlotByID($appointment['slot_id']);
                                                    $service=$db->getServiceByID($appointment['service_id']);
                                                    $service_name=!empty($service)?$service['services']:'Consultation';
                                                    echo '<tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="'.BASE_PATH.'doctor/patient/'.$patient['user_id'].'/" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="' . $patient_img . '" alt="User Image"></a>
                                                            <a href="'.BASE_PATH.'doctor/patient/'.$patient['user_id'].'/">' . $patient['first_name'] . ' ' . $patient['last_name'] . ' <span>#PT0' . $appointment['user_id'] . '</span></a>
                                                        </h2>
                                                    </td>
                                                    <td>' . date("d M Y",strtotime($appointment['book_date'])) . '<span class="d-block text-info"' . $slot['start_time'] . ' ' . $slot['end_time'] . '</span></td>
                                                    <td>'.$service_name.'</td>
                                                    <td>New Patient</td>
                                                    <td class="text-center">Sh' . $appointment['total'] . '</td>
                                                    <td class="text-right">
                                                        <div class="table-action">
                                                            <a href="'.BASE_PATH.'invoices/'.$appointment['id'].'/" class="btn btn-sm bg-primary-light">
                                                                <i class="far fa-eye"></i> View
                                                            </a> ';

                                                    if ($appointment['status'] == 0) {
                                                        echo '<a href="?d=1&app=' . $appointment['id'] . '" class="btn btn-sm bg-success-light">
                                                                    <i class="fas fa-check"></i> Accept
                                                                </a>';
                                                    } else {
                                                        echo ' <a href="?d=0&app=' . $appointment['id'] . '" class="btn btn-sm bg-danger-light">
                                                                    <i class="fas fa-times"></i> Cancel
                                                                </a>';
                                                    }
                                                    echo '
                                                        </div>
                                                    </td>
                                                </tr>';
                                                }
                                            } else {
                                                echo '<tr><td>No Appointments Today</td></tr>';
                                            }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Today Appointment Tab -->

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

