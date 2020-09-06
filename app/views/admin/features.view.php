<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\admin\AdminPage('Features');
$db->hasAccess('admin/features',3);

if(isset($_POST['feature'])){
    $feature=$_POST['feature'];
    $image=new \clinela\utils\Upload(null,$_FILES['feature_image']);
    $feature_image=$image->startUpload();
    $name=!empty($feature_image['name'])?$feature_image['name']:'';
    $db->addFeatures($feature,$name);
    $page->setPageError('All changes have been Saved', 'Success', 'success');
}

if(isset($_GET['d'],$_GET['sub'])) {
    switch ($_GET['sub']) {
        case 'sp':
            $db->deleteFeature($_GET['d']);
            break;
    }
    $page->setPageError('All changes have been Saved', 'Success', 'success');
}
$page->setPageContent('admin/features.blade.php');
$page->makePage();