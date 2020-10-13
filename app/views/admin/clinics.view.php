<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\admin\AdminPage('Clinics');
$db->hasAccess('admin/clinics',3);
$id=$_SESSION['id'];
if(isset($_POST['clinic'],$_POST['phone'],$_POST['address'])){
    $clinic=filter_input(INPUT_POST,'clinic',FILTER_SANITIZE_STRIPPED);
    $phone=filter_input(INPUT_POST,'phone',FILTER_SANITIZE_STRIPPED);
    $district=filter_input(INPUT_POST,'district',FILTER_SANITIZE_STRIPPED);
    $county=filter_input(INPUT_POST,'county',FILTER_SANITIZE_STRIPPED);
    $subcounty=filter_input(INPUT_POST,'subcounty',FILTER_SANITIZE_STRIPPED);
    $level=filter_input(INPUT_POST,'level',FILTER_SANITIZE_STRIPPED);
    $authority=filter_input(INPUT_POST,'authority',FILTER_SANITIZE_STRIPPED);
    $ownership=filter_input(INPUT_POST,'ownership',FILTER_SANITIZE_STRIPPED);
    $details=filter_input(INPUT_POST,'details',FILTER_SANITIZE_STRING);
    $image=new \clinela\utils\Upload(null,$_FILES['clinic_image']);
    $clinic_image=$image->startUpload();
    $name=!empty($clinic_image['name'])?$clinic_image['name']:'';
    $db->addClinic($id,$clinic,$district,$county,$subcounty,$level,$authority,$ownership,$phone,$details,$name);
    $page->setPageError('All changes have been Saved', 'Success', 'success');
}

if(isset($_GET['d'],$_GET['sub'])) {
    switch ($_GET['sub']) {
        case 'cl':
            $db->deleteClinic($_GET['d']);
            break;
    }
    $page->setPageError('Clinic Deleted', 'Success', 'error');
}

$page->setPageContent('admin/clinics.blade.php');
$page->makePage();