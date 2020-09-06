<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Appointments');
$db->hasAccess('doctor/appointments',1);
if(isset($_GET['d'],$_GET['app']) ){
    $status=!empty($_GET['d'])?$_GET['d']:0;
    if(!empty($_GET['app'])){
        $app_id=filter_input(INPUT_GET,'app',FILTER_SANITIZE_NUMBER_INT);
        $db->approveAppointment($app_id,$status);
        $appointment=$db->getAppointmentByID($app_id);
        $user=$db->getUserByID($appointment['user_id']);
        $doctor=$db->getUserMeta($appointment['doctor_id']);
        $slot=$db->getSlotByID($appointment['slot_id']);
        $to                  = $user['email'];
        $subject             = 'Appointment Booked successfully';
        $from                = $db->getOptions( 'site_email' );
        $from                = 'info@clineladoctors.com';
        $content             = $user;
        $content['msg']      = 'Appointment booked with Dr. '.$doctor['first_name'].' '
            .$doctor['last_name'].' on '.$appointment['book_date'].' '.$slot['start_time'].' to '.$slot['end_time'].'';
        $content['btn_text'] = 'View Appointment';
        $content['btn_link'] = 'patient/dashboard/';
        $utils->sendEmail( $from, $to, $subject, $utils->getHtmlMessage( $content ) );
    }

}
$page->setPageContent('doctor/appointments.blade.php');
$page->makePage();