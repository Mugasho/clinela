<?php
$is_admin = $_SESSION['role'] > 1;
$id = $this->getPageVars();
$db = new \clinela\database\DB();
$prescriptions = $db->getPrescriptions($id);
$records = $db->getMedicalRecords($id);
$patient = $db->getUserMeta($id);
$patient_img = !empty($patient['photo']) ? CONTENT_PATH . 'uploads/' . $patient['photo'] : CONTENT_PATH . 'public/img/patients/patient.jpg';
$appointments=$db->getPatientAppointments($id);
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar dct-dashbd-lft">

            <!-- Profile Widget -->
            <div class="card widget-profile pat-widget-profile">
                <div class="card-body">
                    <div class="pro-widget-content">
                        <div class="profile-info-widget">
                            <a href="#" class="booking-doc-img">
                                <img src="<?php echo $patient_img?>" alt="User Image">
                            </a>
                            <div class="profile-det-info">
                                <h3><?php echo $patient['first_name']?> <?php echo $patient['last_name']?></h3>

                                <div class="patient-details">
                                    <h5><b>Patient ID :</b> PT<?php echo $patient['user_id']?></h5>
                                    <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> <?php echo $patient['city']?>
                                        , <?php echo $patient['country']?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="patient-info">
                        <ul>
                            <li>
                                <div class="text-center">
                                    <a href="<?php echo BASE_PATH.'chat/'.$id.'/';?>" class="add-new-btn" ><i class="fab fa-facebook-messenger"></i> Chat with Patient</a>
                                </div>
                            </li>
                            <li>Phone <span><?php echo $patient['phone']?></span></li>
                            <li>Age
                                <span><?php echo (date("Y") - date("Y", strtotime(str_replace("/", "-", $patient['dob'])))) . ' Years, ' . $patient['gender']?></span>
                            </li>
                            <li>Blood Group <span><?php echo $patient['blood']?></span></li>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Profile Widget -->


        </div>

        <div class="col-md-7 col-lg-8 col-xl-9 dct-appoinment">
            <div class="card">
                <div class="card-body pt-0">
                    <div class="user-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified flex-wrap">
                            <?php if($is_admin){?>
                            <li class="nav-item">
                                <a class="nav-link active" href="#pat_appointments" data-toggle="tab">Appointments</a>
                            </li>
                            <?php }?>
                            <li class="nav-item">
                                <a class="nav-link <?php if (!$is_admin) {
                                    echo 'active';
                                }?>" href="#pres" data-toggle="tab"><span>Prescription</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#medical" data-toggle="tab"><span class="med-records">Medical Records</span></a>
                            </li>
                            <?php if($is_admin){?>
                            <li class="nav-item">
                                <a class="nav-link" href="#billing" data-toggle="tab"><span>Billing</span></a>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
                    <div class="tab-content">
                    <?php if($is_admin){?>
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
                                                    $hospital=$db->getClinicByID($slot['hospital_id']);
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
                    <?php }?>
                    <!-- Prescription Tab -->
                        <div class="tab-pane fade <?php if (!$is_admin) {
                            echo 'show active';
                        }?>" id="pres">
                            <div class="text-right">
                                <a href="#" class="add-new-btn" data-toggle="modal" data-target="#add_prescription">Add
                                    Prescription</a>
                            </div>
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Frequency</th>
                                                <th>Period</th>
                                                <th>Total</th>
                                                <th>Advice</th>
                                                <th>Created by</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (!empty($prescriptions)) {
                                                foreach ($prescriptions as $prescription) {
                                                    $doctor = $db->getUserMeta($prescription['doctor_id']);
                                                    $doctor_img = !empty($doctor['photo']) ? CONTENT_PATH . 'uploads/' . $doctor['photo'] : CONTENT_PATH . 'public/img/patients/patient.jpg';
                                                    $speciality = $db->getUserSpeciality($doctor['user_id']);
                                                    echo '<tr>
                                                <td>' . date('d M Y', strtotime($prescription['created_at'])) . '</td>
                                                <td>' . $prescription['drug_name'] . '</td>
                                                <td>' . $prescription['frequency'] . '</td>
                                                <td>' . $prescription['days'] . '</td>
                                                <td>' . $prescription['total'] . ' </td>
                                                <td>' . $prescription['advice'] . '</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="' . BASE_PATH . 'doctors/' . $doctor['user_id'] . '" class="avatar avatar-sm mr-2">
                                                            <img class="avatar-img rounded-circle" src="' . $doctor_img . '" alt="User Image">
                                                        </a>
                                                        <a href="' . BASE_PATH . 'doctors/' . $doctor['user_id'] . '/">Dr. ' . $doctor['first_name'] . ' ' . $doctor['last_name'] . ' <span>' . $speciality['speciality'] . '</span></a>
                                                    </h2>
                                                </td>
                                                <td class="text-right">
                                                    <div class="table-action">
                                                        <a href="?sub=trash&d=' . $prescription['id'] . '" class="btn btn-sm bg-danger-light">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </a>

                                                    </div>
                                                </td>
                                            </tr>';
                                                }
                                            } else {
                                                echo '<tr>
                                            <td>No Prescriptions</td>

                                        </tr>';
                                            }?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Prescription Tab -->

                        <!-- Medical Records Tab -->
                        <div class="tab-pane fade" id="medical">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Attachment</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (!empty($records)) {
                                                foreach ($records as $record) {
                                                    echo '<tr>
                                                <td><a href="' . CONTENT_PATH . 'uploads/' . $record['attachment'] . '">#MR-' . $record['id'] . '</a></td>
                                                <td>' . date('d M Y', strtotime($record['created_at'])) . '</td>
                                                <td>' . $record['description'] . '</td>
                                                <td><a href="' . CONTENT_PATH . 'uploads/' . $record['attachment'] . '" target="_blank">' . $record['attachment'] . '</a></td>
                                                <td class="text-right">
                                                    <div class="table-action">
                                                        <a href="' . CONTENT_PATH . 'uploads/' . $record['attachment'] . '" TARGET="_blank" class="btn btn-sm bg-info-light">
                                                            <i class="far fa-eye"></i> View
                                                        </a>';
                                                    if ($is_admin) {
                                                        echo '<a href="?sub=trash&d=' . $record['id'] . '" class="btn btn-sm bg-danger-light">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </a>';
                                                    }
                                                    echo '
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
                    <?php if($is_admin){?>
                    <!-- Billing Tab -->
                        <div class="tab-pane" id="billing">
                            <div class="text-right">
                                <a class="add-new-btn" href="#">Add Billing</a>
                            </div>
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
                        <!-- Billing Tab -->
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade custom-modal" id="add_prescription">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Prescriptions</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
            </div>
            <form method="post">
                <div class="modal-body">

                    <div class="prescription-info">
                        <div class="row form-row prescription-cont">
                            <div class="col-12 col-md-10 col-lg-10">
                                <div class="row" id="prescription-row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Drug Name</label>
                                            <input class="form-control" name="prescriptions[0][drug_name]">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Frequency</label>
                                            <input class="form-control" name="prescriptions[0][frequency]">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Period</label>
                                            <input class="form-control" name="prescriptions[0][days]" type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Total</label>
                                            <input class="form-control" name="prescriptions[0][total]" type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Advice</label>
                                            <input class="form-control" name="prescriptions[0][advice]" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>
                            </div>
                        </div><hr>
                    </div>
                    <div class="add-more">
                        <a href="javascript:void(0);" class="add-prescription"><i class="fa fa-plus-circle"></i> Add
                            More</a>
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

