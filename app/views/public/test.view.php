<?php
$page=new \clinela\template\Page('Test');
$page->setHasHeader(false);
$utils=new \clinela\utils\Utils();
/*
$utils->sendSMS('clinela','0781712043','with zero');*/
$db=new \clinela\database\DB();
$appt=$db->getAppointmentByID(1);
$appointments=$db->getAllAppointments();

foreach ($appointments as $appointment){
    $pt=$db->getUserMeta($appointment['doctor_id']);

    $first  = new DateTime( date('d-m-y h:i',strtotime($appointment['book_date'])) );
    $second = new DateTime( date('d-m-y') );

    $diff = $first->diff( $second );

    $day= $diff->format( '%H' ); // -> 00:25:25
    if($day==1){
        $utils->sendSMS('');
    }

}

//var_dump($appt);
//$page->makePage();