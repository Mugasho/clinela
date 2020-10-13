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
$appointments=$db->getPatientAppointments($id);
$records=$db->getMedicalRecords($id);
$prescriptions=$db->getPrescriptions($id);
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
                        <li class="active">
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
                        <li >
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
            <div class="card-body pt-0">

                <!-- Tab Menu -->
                <nav class="user-tabs mb-4">
                    <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" href="#pat_appointments" data-toggle="tab">Appointments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pat_prescriptions" data-toggle="tab">Prescriptions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pat_medical_records" data-toggle="tab"><span class="med-records">Medical Records</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pat_billing" data-toggle="tab">Billing</a>
                        </li>
                    </ul>
                </nav>
                <!-- /Tab Menu -->

                <!-- Tab Content -->
                <div class="tab-content pt-0">

                    <!-- Appointment Tab -->
                    <div id="pat_appointments" class="tab-pane fade show active">
                        <div class="card card-table mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <thead>
                                        <tr>
                                            <th>Doctor</th>
                                            <th>Appt Date</th>
                                            <th>Booking Date</th>
                                            <th>Amount</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($appointments)) {
                                            foreach ($appointments as $appointment) {
                                                $doctor=$db->getUserMeta($appointment['doctor_id']);
                                                $doctor_img=!empty($doctor['photo'])?CONTENT_PATH.'uploads/'.$doctor['photo']:CONTENT_PATH.'public/img/patients/patient.jpg';
                                                $slot=$db->getSlotByID($appointment['slot_id']);
                                                $hospital=!empty($slot)?$db->getClinicByID($slot['hospital_id']):'';
                                                $speciality=$db->getUserSpeciality($doctor['user_id']);
                                                $clinic=!empty($hospital)?$hospital['clinic']:'Default';
                                                $follow=!empty($appointment['follow_date'])? date('d M Y',strtotime($appointment['follow_date'])):'';
                                                $badge_bg=$appointment['status']==1?'bg-success':'bg-danger';
                                                $badge_text=$appointment['status']==1?'Confirmed':'Pending';
                                                echo '<tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="'.BASE_PATH.'doctors/'.$doctor['user_id'].'/" class="avatar avatar-sm mr-2">
                                                            <img class="avatar-img rounded-circle" src="'.$doctor_img.'" alt="User Image">
                                                        </a>
                                                        <a href="'.BASE_PATH.'doctors/'.$doctor['user_id'].'/">Dr. '.$doctor['first_name'].' ' .$doctor['last_name'].' <span>'.$speciality['speciality'].'</span></a>
                                                    </h2>
                                                </td>
                                                <td>'.date('d M Y',strtotime($appointment['book_date'])).' <span class="d-block text-info">'.date('h:i A',strtotime($slot['start_time'])).' - '.date('h:i A',strtotime($slot['end_time'])).'</span></td>
                                                <td>'.date('d M Y',strtotime($appointment['created_at'])).'</td>
                                                <td>Sh'.$appointment['total'].'</td>
                                                <td>'.$clinic.'</td>
                                                <td><span class="badge badge-pill '.$badge_bg.'-light">'.$badge_text.'</span></td>
                                                <td class="text-right">
                                                    <div class="table-action">
                                                        <a href="'.BASE_PATH.'invoices/'.$appointment['id'].'/" class="btn btn-sm bg-primary-light">
                                                            <i class="far fa-eye"></i> View
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>';
                                            }
                                        }else{
                                            echo '<tr><td>No Appointments Today</td></tr>';
                                        }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Appointment Tab -->

                    <!-- Prescription Tab -->
                    <div class="tab-pane fade" id="pat_prescriptions">
                        <div class="card card-table mb-0">
                            <div class="card-header">
                                <a href="<?php echo BASE_PATH?>patient/prescription/" class="btn btn-primary">Download</a>
                            </div>
                            <div class="card-body">
                                
                            </div>
                        </div>
                    </div>
                    <!-- /Prescription Tab -->

                    <!-- Medical Records Tab -->
                    <div id="pat_medical_records" class="tab-pane fade">
                        <div class="text-right">
                            <a href="#" class="add-new-btn" data-toggle="modal" data-target="#add_medical_records">Add Medical Records</a>
                        </div>
                        <div class="card card-table mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date </th>
                                            <th>Description</th>
                                            <th>Attachment</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($records)) {
                                            foreach ($records as $record) {
                                                echo '<tr>
                                                <td><a href="'.CONTENT_PATH.'uploads/'.$record['attachment'].'">#MR-'.$record['id'].'</a></td>
                                                <td>'.date('d M Y',strtotime($record['created_at'])).'</td>
                                                <td>'.$record['description'].'</td>
                                                <td><a href="'.CONTENT_PATH.'uploads/'.$record['attachment'].'" target="_blank">'.$record['attachment'].'</a></td>
                                                <td class="text-right">
                                                    <div class="table-action">
                                                        <a href="'.CONTENT_PATH.'uploads/'.$record['attachment'].'" TARGET="_blank" class="btn btn-sm bg-info-light">
                                                            <i class="far fa-eye"></i> View
                                                        </a>
                                                        <a href="?sub=trash&d='.$record['id'].'" class="btn btn-sm bg-danger-light">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>';
                                            }
                                        }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Medical Records Tab -->

                    <!-- Billing Tab -->
                    <div id="pat_billing" class="tab-pane fade">
                        <div class="card card-table mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <thead>
                                        <tr>
                                            <th>Invoice No</th>
                                            <th>Doctor</th>
                                            <th>Amount</th>
                                            <th>Paid On</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($appointments as $appointment) {
                                            $doctor=$db->getUserMeta($appointment['doctor_id']);
                                            $doctor_img=!empty($doctor['photo'])?CONTENT_PATH.'uploads/'.$doctor['photo']:CONTENT_PATH.'public/img/patients/patient.jpg';
                                            $slot=$db->getSlotByID($appointment['slot_id']);
                                            $hospital=$db->getClinicByID($slot['hospital_id']);
                                            $clinic=!empty($hospital)?$hospital['clinic']:'Default';
                                            $follow=!empty($appointment['follow_date'])? date('d M Y',strtotime($appointment['follow_date'])):'';
                                            $badge_bg=$appointment['status']==1?'bg-success':'bg-danger';
                                            $badge_text=$appointment['status']==1?'Confirmed':'Pending';
                                            $speciality=$db->getUserSpeciality($doctor['user_id']);

                                            echo '<tr>
                                            <td>
                                                <a href="invoice-view.html">#INV-'.$appointment['tx_id'].'</a>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="'.BASE_PATH.'doctors/'.$doctor['user_id'].'/" class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle" src="'.$doctor_img.'" alt="User Image">
                                                    </a>
                                                    <a href="'.BASE_PATH.'doctors/'.$doctor['user_id'].'/">'.$doctor['first_name'].' '.$doctor['last_name'].' <span>'.$speciality['speciality'].'</span></a>
                                                </h2>
                                            </td>
                                            <td>UGX'.$appointment['total'].'</td>
                                            <td>'.date('d M Y',strtotime($appointment['created_at'])).'</td>
                                            <td class="text-right">
                                                <div class="table-action">
                                                    <a href="'.BASE_PATH.'invoices/'.$appointment['id'].'/" class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                    <a href="'.BASE_PATH.'invoices/'.$appointment['id'].'/?print=auto" class="btn btn-sm bg-primary-light">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>';
                                        }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Billing Tab -->

                </div>
                <!-- Tab Content -->

            </div>
        </div>
    </div>
</div>

<div class="modal fade custom-modal" id="add_medical_records">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Medical Records</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Upload File</label>
                        <input type="file" class="form-control" name="attachment">
                    </div>
                    <div class="submit-section text-center">
                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        <button type="button" class="btn btn-secondary submit-btn" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

