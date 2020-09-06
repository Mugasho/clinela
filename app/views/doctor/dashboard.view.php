<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Dashboard');
$db->hasAccess('doctor/dashboard',1);
if(isset($_GET['d'],$_GET['app']) ){
    $status=!empty($_GET['d'])?$_GET['d']:0;
    if(!empty($_GET['app'])){
        $db->approveAppointment($_GET['app'],$status);
    }

}
$page->setPageContent('doctor/dashboard.blade.php');
$page->makePage();