<?php
$db=new \clinela\database\DB();
$doctors=$db->getUsersByRole(1,5);
$doctors2=$db->getUsersByRole(1);
$patients=$db->getUsersByRole(0,5);
$patients2=$db->getUsersByRole(0);
$appointments=$db->getAllAppointments(1);
$total=$db->getTotalAmount()['total_amount'];
?>


<div class="row">
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
										<span class="dash-widget-icon text-primary border-primary">
											<i class="fe fe-users"></i>
										</span>
                    <div class="dash-count">
                        <h3><?php echo count($doctors2)?></h3>
                    </div>
                </div>
                <div class="dash-widget-info">
                    <h6 class="text-muted">Doctors</h6>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-primary w-50"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
										<span class="dash-widget-icon text-success">
											<i class="fe fe-credit-card"></i>
										</span>
                    <div class="dash-count">
                        <h3><?php echo count($patients)?></h3>
                    </div>
                </div>
                <div class="dash-widget-info">

                    <h6 class="text-muted">Patients</h6>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success w-50"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
										<span class="dash-widget-icon text-danger border-danger">
											<i class="fe fe-money"></i>
										</span>
                    <div class="dash-count">
                        <h3><?php echo count($appointments)?></h3>
                    </div>
                </div>
                <div class="dash-widget-info">

                    <h6 class="text-muted">Appointment</h6>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger w-50"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="dash-widget-header">
										<span class="dash-widget-icon text-warning border-warning">
											<i class="fe fe-folder"></i>
										</span>
                    <div class="dash-count">
                        <h3><small>ugx</small> <?php echo $total?></h3>
                    </div>
                </div>
                <div class="dash-widget-info">

                    <h6 class="text-muted">Revenue</h6>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-warning w-50"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-6">

        <!-- Sales Chart -->
        <div class="card card-chart">
            <div class="card-header">
                <h4 class="card-title">Revenue</h4>
            </div>
            <div class="card-body">
                <div id="morrisArea"></div>
            </div>
        </div>
        <!-- /Sales Chart -->

    </div>
    <div class="col-md-12 col-lg-6">

        <!-- Invoice Chart -->
        <div class="card card-chart">
            <div class="card-header">
                <h4 class="card-title">Status</h4>
            </div>
            <div class="card-body">
                <div id="morrisLine"></div>
            </div>
        </div>
        <!-- /Invoice Chart -->

    </div>
</div>
<div class="row">
    <div class="col-md-6 d-flex">

        <!-- Recent Orders -->
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h4 class="card-title">Doctors List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-center mb-0">
                        <thead>
                        <tr>
                            <th>Doctor Name</th>
                            <th>Speciality</th>
                            <th>Earned</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($doctors)) {
                            foreach ($doctors as $doctor){
                                $names=empty($doctor['first_name'])&& empty($doctor['last_name'])?$doctor['username']:$doctor['first_name'].' '.$doctor['last_name'];
                                $img=!empty($doctor['photo'])?CONTENT_PATH.'uploads/'.$doctor['photo']:CONTENT_PATH.'public/img/patients/patient1.jpg';
                                $city=!empty($doctor['city'])?$doctor['city'].', ':'';
                                $state=!empty($doctor['state'])?$doctor['state'].', ':'';
                                $country=!empty($doctor['country'])?$doctor['country']:'';
                                $services=$db->getServices($doctor['id']);
                                $speciality=$db->getUserSpeciality($doctor['id']);
                                $speciality['speciality']=!empty($speciality)?$speciality['speciality']:'General';
                                $total=!empty($db->getTotalAmountDoctor($doctor['id'])['total_amount'])?$db->getTotalAmountDoctor($doctor['id'])['total_amount']:0;
                                echo '<tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="'.BASE_PATH.'doctors/'.$doctor['id'].'/" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="'.$img.'" alt="User Image"></a>
                                        <a href="'.BASE_PATH.'doctors/'.$doctor['id'].'/">Dr. '.$names.'</a>
                                    </h2>
                                </td>
                                <td>'.$speciality['speciality'].'</td>
                                <td>UGX '.$total.'</td>
                                <td>
                                    <a href="'.BASE_PATH.'doctors/'.$doctor['id'].'/" class="btn btn-sm btn-primary">view</a>
                                </td>
                            </tr>';
                            }
                        }?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /Recent Orders -->

    </div>
    <div class="col-md-6 d-flex">

        <!-- Feed Activity -->
        <div class="card  card-table flex-fill">
            <div class="card-header">
                <h4 class="card-title">Patients List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-center mb-0">
                        <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>Phone</th>
                            <th>Joined</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($patients as $patient){
                            $names=empty($patient['first_name'])&& empty($patient['last_name'])?$patient['username']:$patient['first_name'].' '.$patient['last_name'];
                            $img=!empty($patient['photo'])?CONTENT_PATH.'uploads/'.$patient['photo']:CONTENT_PATH.'public/img/patients/patient1.jpg';
                            $city=!empty($patient['city'])?$patient['city'].', ':'';
                            $state=!empty($patient['state'])?$patient['state'].', ':'';
                            $country=!empty($patient['country'])?$patient['country']:'';
                            echo '<tr>
                            <td>
                                <h2 class="table-avatar">
                                    <a href="'.BASE_PATH.'doctor/patient/'.$patient['id'].'/" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="'.$img.'" alt="User Image"></a>
                                    <a href="'.BASE_PATH.'doctor/patient/'.$patient['id'].'/">'.$names.'</a>
                                </h2>
                            </td>
                            <td>'.$patient['phone'].'</td>
                            <td>'.date("d M Y",strtotime($patient['created_at'])).'</td>
                            <td class="text-right"><a href="'.BASE_PATH.'doctor/patient/'.$patient['id'].'/" class="btn btn-sm btn-primary">View</a></td>
                        </tr>';
                        }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /Feed Activity -->

    </div>
</div>
<div class="row">
    <div class="col-md-12">

        <!-- Recent Orders -->
        <div class="card card-table">
            <div class="card-header">
                <h4 class="card-title">Appointment List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-center mb-0">
                        <thead>
                        <tr>
                            <th>Doctor Name</th>
                            <th>Speciality</th>
                            <th>Patient Name</th>
                            <th>Apointment Time</th>
                            <th>Status</th>
                            <th class="text-right">Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($appointments)) {
                            foreach ($appointments as $appointment) {
                                $doctor=$db->getUserMeta($appointment['doctor_id']);
                                $patient=$db->getUserMeta($appointment['user_id']);
                                $slot=$db->getSlotByID($appointment['slot_id']);
                                $patient_img=!empty($patient['photo'])?CONTENT_PATH.'uploads/'.$patient['photo']:CONTENT_PATH.'public/img/patients/patient.jpg';
                                $doctor_img=!empty($doctor['photo'])?CONTENT_PATH.'uploads/'.$doctor['photo']:CONTENT_PATH.'public/img/patients/patient.jpg';
                                $speciality=$db->getUserSpeciality($appointment['doctor_id']);
                                $speciality['speciality']=!empty($speciality)?$speciality['speciality']:'General';
                                echo '<tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="'.BASE_PATH.'doctors/'.$doctor['user_id'].'/" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="'.$doctor_img.'" alt="User Image"></a>
                                        <a href="'.BASE_PATH.'doctors/'.$doctor['user_id'].'/">Dr. '.$doctor['first_name'].' '.$doctor['last_name'].'</a>
                                    </h2>
                                </td>
                                <td>'.$speciality['speciality'].'</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="'.BASE_PATH.'doctor/patient/'.$patient['user_id'].'/" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="'.$patient_img.'" alt="User Image"></a>
                                        <a href="'.BASE_PATH.'doctor/patient/'.$patient['user_id'].'/">'.$patient['first_name'].' '.$patient['first_name'].' </a>
                                    </h2>
                                </td>
                                <td>9'.date('d M Y',strtotime($appointment['book_date'])).' <span class="text-primary d-block">'.date('h:i A',strtotime($slot['start_time'])).' - '.date('h:i A',strtotime($slot['end_time'])).'</span></td>
                                <td>
                                    <div class="status-toggle">
                                        <input type="checkbox" id="status_1" class="check" checked>
                                        <label for="status_1" class="checktoggle">checkbox</label>
                                    </div>
                                </td>
                                <td class="text-right">
                                    UGX '.$appointment['amount'].'
                                </td>
                            </tr>';
                            }
                        }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /Recent Orders -->

    </div>
</div>

