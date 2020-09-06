<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Dashboard');
$db->hasAccess('patient/dashboard');
if(isset($_POST['description'])){
    $id=$_SESSION['id'];
    $description=$_POST['description'];
    $image=new \clinela\utils\Upload(null,$_FILES['attachment']);
    $attachment_image=$image->startUpload();
    $name=!empty($attachment_image['name'])?$attachment_image['name']:'';
    $db->addRecords($id,$description,$name);
    $page->setPageError('All changes have been Saved', 'Success', 'success');
}

if(isset($_GET['d'],$_GET['sub'])) {
    switch ($_GET['sub']) {
        case 'trash':
            $db->deleteMedicalRecord($_GET['d']);
            break;
    }
    $page->setPageError('Record Deleted', 'Success', 'error');
}
$page->setPageContent('patient/dashboard.blade.php');
$page->makePage();