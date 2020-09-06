<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Schedule');
$db->hasAccess('doctor/schedule',1);
$id=$_SESSION['id'];
if(isset($_POST['slots'])){
    $slots=$_POST['slots'];
    $day=filter_input(INPUT_POST,'day',FILTER_SANITIZE_NUMBER_INT);
    $hospitaL_id=filter_input(INPUT_POST,'hospital_id',FILTER_SANITIZE_NUMBER_INT);
    foreach ($slots as $slot){
        $db->addSlot($id,$hospitaL_id,$day,$slot['start-time'],$slot['end-time']);
    }
    $page->setPageError('Slots added','success','success');
}
if(isset($_GET['d'])){
    $db->deleteSlot($_GET['d']);
}
$page->addScripts('bootstrap-tagsinput.js', CONTENT_PATH . 'public/plugins/bootstrap-tagsinput/js/');
$page->addScripts('ResizeSensor.js', CONTENT_PATH . 'public/plugins/theia-sticky-sidebar/');
$page->addScripts('theia-sticky-sidebar.js', CONTENT_PATH . 'public/plugins/theia-sticky-sidebar/');
$page->setPageContent('doctor/schedule.blade.php');
$page->makePage();