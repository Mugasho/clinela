<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\admin\AdminPage('Specialities');
$db->hasAccess('admin/speciality',3);

if(isset($_POST['speciality'])){
    $speciality=$_POST['speciality'];
    $image=new \clinela\utils\Upload(null,$_FILES['speciality_image']);
    $speciality_image=$image->startUpload();
    $name=!empty($speciality_image['name'])?$speciality_image['name']:'';
    $db->addSpecialities($speciality,$name);
    $page->setPageError('All changes have been Saved', 'Success', 'success');
}

if(isset($_GET['d'],$_GET['sub'])) {
    switch ($_GET['sub']) {
        case 'sp':
            $db->deleteSpeciality($_GET['d']);
            break;
    }
    $page->setPageError('All changes have been Saved', 'Success', 'success');
}
$page->setPageContent('admin/speciality.blade.php');
$page->makePage();