<?php
$db=new \clinela\database\DB();
$utils=new \clinela\utils\Utils();
$page=new \clinela\template\Page('Payment');
$id=$match['params']['id'];
$db->hasAccess('payment/'.$id);
$user_id=$_SESSION['id'];
if(isset($_GET['book_date'],$_GET['service_id'],$_GET['amount'],$_GET['slot_id'],$_GET['status'],
    $_GET['tx_ref'],$_GET['transaction_id'])){
    if($_GET['transaction_id']!='null'){
        $pay_method=isset($_GET['credit'])?1:2;
        $book_date=$_GET['book_date'];
        $service_id=$_GET['service_id'];
        $slot_id=$_GET['slot_id'];
        $data['doctor_id']=$id;
        $data['service_id']=$service_id;
        $data['book_date']=date('Y-m-d',strtotime($book_date));
        $data['slot_id']=$slot_id;
        $data['amount']=$_GET['amount'];
        $data['fee']=$_GET['fee'];
        $data['tax']=$_GET['tax'];
        $data['total']=$_GET['total'];
        $data['pay_method']=$pay_method;
        $data['tx_id']=$_GET['transaction_id'];
        $data['status']=0;
        if($db->addAppointment($user_id,$data)){
            $slot=$db->getSlotByID($slot_id);
            $user=$db->getUserMeta($user_id);
			$user2=$db->getUserMeta($id);
			

            //for patient
            $to                  = $user['email'];
            $subject             = 'Appointment Booked successfully';
            $from                = $db->getOptions( 'site_email' );
            $from                = 'info@clineladoctors.com';
            $content             = $user;
            $content['msg']      = 'Appointment booked with Dr. '.$user2['first_name'].' '
                .$user2['last_name'].' on '.date('h:i a',strtotime($slot['start_time'])).' to '.date('h:i a',strtotime($slot['end_time'])).'';
            $content['btn_text'] = 'View Appointment';
            $content['btn_link'] = 'patient/dashboard/';
            $utils->sendEmail( $from, $to, $subject, $utils->getHtmlMessage( $content ) );
            $utils->sendSMS( 'ClineDoctors', $user['phone'], $content['msg']);

            //for doctor
           
            $to                  = $user2['email'];
            $subject             = 'New Appointment';
            $from                = $db->getOptions( 'site_email' );
            $from                = 'info@clineladoctors.com';
            $content             = $user2;
            $content['msg']      = 'You have a new Appointment booked by . '.$user['username'].' on 
                '.date('h:i a',strtotime($slot['start_time'])).' to '.date('h:i a',strtotime($slot['end_time'])).'';
            $content['btn_text'] = 'View Appointment';
            $content['btn_link'] = 'doctor/dashboard/';
            $utils->sendEmail( $from, $to, $subject, $utils->getHtmlMessage( $content ) );
            $utils->sendSMS( 'ClineDoctors', $user2['phone'], $content['msg'] );
            header('Location:'.BASE_PATH.'booked/'.$id.'/?tx='.$data['tx_id']);
        }
    }else{
       header('Location:'.BASE_PATH.'book-fail/');
    }

}