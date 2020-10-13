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
$slotsMonday=$db->getUserSlotsByDay($id,1);
$slotsTuesday=$db->getUserSlotsByDay($id,2);
$slotsWednesday=$db->getUserSlotsByDay($id,3);
$slotsThursday=$db->getUserSlotsByDay($id,4);
$slotsFriday=$db->getUserSlotsByDay($id,5);
$slotsSaturday=$db->getUserSlotsByDay($id,6);
$slotsSunday=$db->getUserSlotsByDay($id,7);
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
                        <li class="active">
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

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Schedule Timings</h4>
                        <div class="profile-box">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card schedule-widget mb-0">

                                        <!-- Schedule Header -->
                                        <div class="schedule-header">

                                            <!-- Schedule Nav -->
                                            <div class="schedule-nav">
                                                <ul class="nav nav-tabs nav-justified">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-toggle="tab" href="#slot_sunday">Sunday</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link " data-toggle="tab" href="#slot_monday">Monday</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#slot_tuesday">Tuesday</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#slot_wednesday">Wednesday</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#slot_thursday">Thursday</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#slot_friday">Friday</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#slot_saturday">Saturday</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /Schedule Nav -->

                                        </div>
                                        <!-- /Schedule Header -->

                                        <!-- Schedule Content -->
                                        <div class="tab-content schedule-cont">

                                            <!-- Sunday Slot -->
                                            <div id="slot_sunday" class="tab-pane fade show active">
                                                <h4 class="card-title d-flex justify-content-between">
                                                    <span>Time Slots</span>
                                                    <a class="edit-link" data-toggle="modal" href="#add_time_slot" onclick="setDay(7)"><i class="fa fa-plus-circle"></i> Add Slot</a>
                                                </h4>
                                                    <?php
                                                    if (!empty($slotsSunday)) {
                                                        echo '<div class="doc-times">';
                                                        foreach ($slotsSunday as $slot){
                                                            echo '<div class="doc-slot-list">
                                                        '.date("h:i a",strtotime($slot['start_time'])).' - '.date("h:i a",strtotime($slot['end_time'])).'
                                                        <a href="?d='.$slot['id'].'" class="delete_schedule">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>';
                                                        }
                                                        echo '</div>';
                                                    }else{
                                                        echo '<p class="text-muted mb-0">Not Available</p>';
                                                    }
                                                    ?>

                                            </div>
                                            <!-- /Sunday Slot -->

                                            <!-- Monday Slot -->
                                            <div id="slot_monday" class="tab-pane fade">
                                                <h4 class="card-title d-flex justify-content-between">
                                                    <span>Time Slots</span>
                                                    <a class="edit-link" data-toggle="modal" href="#add_time_slot" onclick="setDay(1)"><i class="fa fa-plus-circle"></i>Add Slot</a>
                                                </h4>

                                                <!-- Slot List -->
                                            <?php
                                            if (!empty($slotsMonday)) {
                                                echo '<div class="doc-times">';
                                                foreach ($slotsMonday as $slot){
                                                    echo '<div class="doc-slot-list">
                                                        '.date("h:i a",strtotime($slot['start_time'])).' - '.date("h:i a",strtotime($slot['end_time'])).'
                                                        <a href="?d='.$slot['id'].'" class="delete_schedule">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>';
                                                }
                                                echo '</div>';
                                            }else{
                                                echo '<p class="text-muted mb-0">Not Available</p>';
                                            }
                                            ?>
                                                <!-- /Slot List -->

                                            </div>
                                            <!-- /Monday Slot -->

                                            <!-- Tuesday Slot -->
                                            <div id="slot_tuesday" class="tab-pane fade">
                                                <h4 class="card-title d-flex justify-content-between">
                                                    <span>Time Slots</span>
                                                    <a class="edit-link" data-toggle="modal" href="#add_time_slot" onclick="setDay(2)"><i class="fa fa-plus-circle"></i> Add Slot</a>
                                                </h4>
                                                <?php
                                                if (!empty($slotsTuesday)) {
                                                    echo '<div class="doc-times">';
                                                    foreach ($slotsTuesday as $slot){
                                                        echo '<div class="doc-slot-list">
                                                        '.date("h:i a",strtotime($slot['start_time'])).' - '.date("h:i a",strtotime($slot['end_time'])).'
                                                        <a href="?d='.$slot['id'].'" class="delete_schedule">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>';
                                                    }
                                                    echo '</div>';
                                                }else{
                                                    echo '<p class="text-muted mb-0">Not Available</p>';
                                                }
                                                ?>
                                            </div>
                                            <!-- /Tuesday Slot -->

                                            <!-- Wednesday Slot -->
                                            <div id="slot_wednesday" class="tab-pane fade">
                                                <h4 class="card-title d-flex justify-content-between">
                                                    <span>Time Slots</span>
                                                    <a class="edit-link" data-toggle="modal" href="#add_time_slot" onclick="setDay(3)"><i class="fa fa-plus-circle"></i> Add Slot</a>
                                                </h4>
                                                <?php
                                                if (!empty($slotsWednesday)) {
                                                    echo '<div class="doc-times">';
                                                    foreach ($slotsWednesday as $slot){
                                                        echo '<div class="doc-slot-list">
                                                        '.date("h:i a",strtotime($slot['start_time'])).' - '.date("h:i a",strtotime($slot['end_time'])).'
                                                        <a href="?d='.$slot['id'].'" class="delete_schedule">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>';
                                                    }
                                                    echo '</div>';
                                                }else{
                                                    echo '<p class="text-muted mb-0">Not Available</p>';
                                                }
                                                ?>
                                            </div>
                                            <!-- /Wednesday Slot -->

                                            <!-- Thursday Slot -->
                                            <div id="slot_thursday" class="tab-pane fade">
                                                <h4 class="card-title d-flex justify-content-between">
                                                    <span>Time Slots</span>
                                                    <a class="edit-link" data-toggle="modal" href="#add_time_slot" onclick="setDay(4)"><i class="fa fa-plus-circle"></i> Add Slot</a>
                                                </h4>
                                                <?php
                                                if (!empty($slotsThursday)) {
                                                    echo '<div class="doc-times">';
                                                    foreach ($slotsThursday as $slot){
                                                        echo '<div class="doc-slot-list">
                                                        '.date("h:i a",strtotime($slot['start_time'])).' - '.date("h:i a",strtotime($slot['end_time'])).'
                                                        <a href="?d='.$slot['id'].'" class="delete_schedule">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>';
                                                    }
                                                    echo '</div>';
                                                }else{
                                                    echo '<p class="text-muted mb-0">Not Available</p>';
                                                }
                                                ?>
                                            </div>
                                            <!-- /Thursday Slot -->

                                            <!-- Friday Slot -->
                                            <div id="slot_friday" class="tab-pane fade">
                                                <h4 class="card-title d-flex justify-content-between">
                                                    <span>Time Slots</span>
                                                    <a class="edit-link" data-toggle="modal" href="#add_time_slot" onclick="setDay(5)"><i class="fa fa-plus-circle"></i> Add Slot</a>
                                                </h4>
                                                <?php
                                                if (!empty($slotsFriday)) {
                                                    echo '<div class="doc-times">';
                                                    foreach ($slotsFriday as $slot){
                                                        echo '<div class="doc-slot-list">
                                                        '.date("h:i a",strtotime($slot['start_time'])).' - '.date("h:i a",strtotime($slot['end_time'])).'
                                                        <a href="?d='.$slot['id'].'" class="delete_schedule">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>';
                                                    }
                                                    echo '</div>';
                                                }else{
                                                    echo '<p class="text-muted mb-0">Not Available</p>';
                                                }
                                                ?>
                                            </div>
                                            <!-- /Friday Slot -->

                                            <!-- Saturday Slot -->
                                            <div id="slot_saturday" class="tab-pane fade">
                                                <h4 class="card-title d-flex justify-content-between">
                                                    <span>Time Slots</span>
                                                    <a class="edit-link" data-toggle="modal" href="#add_time_slot" onclick="setDay(6)"><i class="fa fa-plus-circle"></i> Add Slot</a>
                                                </h4>
                                                <?php
                                                if (!empty($slotsSaturday)) {
                                                    echo '<div class="doc-times">';
                                                    foreach ($slotsSaturday as $slot){
                                                        echo '<div class="doc-slot-list">
                                                        '.date("h:i a",strtotime($slot['start_time'])).' - '.date("h:i a",strtotime($slot['end_time'])).'
                                                        <a href="?d='.$slot['id'].'" class="delete_schedule">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>';
                                                    }
                                                    echo '</div>';
                                                }else{
                                                    echo '<p class="text-muted mb-0">Not Available</p>';
                                                }
                                                ?>
                                            </div>
                                            <!-- /Saturday Slot -->

                                        </div>
                                        <!-- /Schedule Content -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Add Time Slot Modal -->
<div class="modal fade custom-modal" id="add_time_slot">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Time Slots</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <input type="number" name="day" id="day" value="7" hidden>
                    <div class="hours-info">
                        <div class="row form-row hours-cont">
                            <div class="col-12 col-md-10">
                                <div class="row form-row">
                                    <div class="col-12 col-md-12">
                                        <label>Location</label>
                                        <div class="form-group">
                                            <select class="form-control select2" name="hospital_id">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <input class="form-control" name="slots[0][start-time]" data-clocklet>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <input class="form-control" name="slots[0][end-time]" data-clocklet>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="add-more mb-3">
                        <a href="?d='.$slot['id'].';" class="add-hours"><i class="fa fa-plus-circle"></i> Add More</a>
                    </div>
                    <div class="submit-section text-center">
                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Time Slot Modal -->

<!-- Edit Time Slot Modal -->
<div class="modal fade custom-modal" id="edit_time_slot">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Time Slots</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="hours-info">
                        <div class="row form-row hours-cont">
                            <div class="col-12 col-md-10">
                                <div class="row form-row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <select class="form-control">
                                                <option>-</option>
                                                <option selected>12.00 am</option>
                                                <option>12.30 am</option>
                                                <option>1.00 am</option>
                                                <option>1.30 am</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <select class="form-control">
                                                <option>-</option>
                                                <option>12.00 am</option>
                                                <option selected>12.30 am</option>
                                                <option>1.00 am</option>
                                                <option>1.30 am</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-row hours-cont">
                            <div class="col-12 col-md-10">
                                <div class="row form-row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <select class="form-control">
                                                <option>-</option>
                                                <option>12.00 am</option>
                                                <option selected>12.30 am</option>
                                                <option>1.00 am</option>
                                                <option>1.30 am</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <select class="form-control">
                                                <option>-</option>
                                                <option>12.00 am</option>
                                                <option>12.30 am</option>
                                                <option selected>1.00 am</option>
                                                <option>1.30 am</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>
                        </div>

                        <div class="row form-row hours-cont">
                            <div class="col-12 col-md-10">
                                <div class="row form-row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Start Time</label>
                                            <select class="form-control">
                                                <option>-</option>
                                                <option>12.00 am</option>
                                                <option>12.30 am</option>
                                                <option selected>1.00 am</option>
                                                <option>1.30 am</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>End Time</label>
                                            <select class="form-control">
                                                <option>-</option>
                                                <option>12.00 am</option>
                                                <option>12.30 am</option>
                                                <option>1.00 am</option>
                                                <option selected>1.30 am</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>
                        </div>

                    </div>

                    <div class="add-more mb-3">
                        <a href="?d='.$slot['id'].';" class="add-hours"><i class="fa fa-plus-circle"></i> Add More</a>
                    </div>
                    <div class="submit-section text-center">
                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Time Slot Modal -->
<style>
    .clocklet-container{
        z-index: 1500 !important;
    }
    .select2-container {
        width: 100% !important;
    }
</style>
<script>
    function setDay(day) {
        document.getElementById('day').value=day;
    }

    document.addEventListener("DOMContentLoaded", function(event) {
        $('.select2').select2({
            ajax: {
                url: "<?php echo BASE_PATH?>request/1/",
                data: function (params) {
                    var query = {
                        clinics: 'yes',
                        search: params.term,
                        limit: '20'
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function (data) {
                    var ob=JSON.parse(data);
                    return {
                        results: ob
                    };
                }
            }
        });
    });

</script>