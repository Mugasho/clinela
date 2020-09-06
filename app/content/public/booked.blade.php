<?php
$db = new \clinela\database\DB();
$id = $this->getPageVars();
$doctor = $db->getUserMeta($id);
$names = empty($doctor['first_name']) && empty($doctor['last_name']) ? $doctor['username'] : $doctor['first_name'] . ' ' . $doctor['last_name'];
$img = !empty($doctor['photo']) ? CONTENT_PATH . 'uploads/' . $doctor['photo'] : CONTENT_PATH . 'public/img/patients/patient1.jpg';
$city = !empty($doctor['city']) ? $doctor['city'] . ', ' : '';
$state = !empty($doctor['state']) ? $doctor['state'] . ', ' : '';
$country = !empty($doctor['country']) ? $doctor['country'] : '';
$appointment=$db->getAppointmentByTID($_GET['tx']);
$slot=$db->getSlotByID($appointment['slot_id']);
?>
<div class="content success-page-cont">
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-lg-6">

                <!-- Success Card -->
                <div class="card success-card">
                    <div class="card-body">
                        <div class="success-cont">
                            <i class="fas fa-check"></i>
                            <h3>Appointment booked Successfully!</h3>
                            <p>Appointment booked with <strong>Dr. <?php echo $names?></strong><br> on <strong><?php echo date('d M Y',strtotime($appointment['book_date']))?> <?php echo date('h:i A',strtotime($slot['start_time'])).' to '.date('h:i A',strtotime($slot['end_time']))?></strong></p>
                            <a href="<?php echo BASE_PATH.'invoices/'.$appointment['id'].'/'?>" class="btn btn-primary view-inv-btn">View Invoice</a>
                        </div>
                    </div>
                </div>
                <!-- /Success Card -->

            </div>
        </div>

    </div>
</div>
