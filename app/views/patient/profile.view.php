<?php
$db = new \clinela\database\DB();
$page = new \clinela\template\Page('Profile');
$db->hasAccess('patient/profile');
if (isset($_POST['first_name'], $_POST['last_name'], $_POST['dob'])) {
    $id=$_SESSION['id'];
    $meta=$db->getUserMeta($id);
    $user_meta['user_id'] =$id;
    $user_meta['first_name'] = $_POST['first_name'];
    $user_meta['last_name'] = $_POST['last_name'];
    $user_meta['phone'] = $_POST['phone'];
    $user_meta['dob'] = $_POST['dob'];
    $user_meta['blood'] = $_POST['blood'];
    $user_meta['city'] = $_POST['city'];
    $user_meta['state'] = $_POST['state'];
    $user_meta['country'] = $_POST['country'];
    $user_meta['gender'] = $_POST['gender'];
    $user_meta['address'] = $_POST['address'];
    $photo=new \clinela\utils\Upload(null,$_FILES['profile']);
    $p=$photo->startUpload();
    $user_meta['photo']=!empty($p['name'])?$p['name']:$meta['photo'];
    $db->updateUserMeta($user_meta);
    $page->setPageError('All changes have been Saved','Success','success');
}
$page->addStyle('bootstrap-datetimepicker.min.css',CONTENT_PATH.'public/css/');
$page->addScripts('moment.min.js',CONTENT_PATH.'public/js/');
$page->addScripts('bootstrap-datetimepicker.min.js',CONTENT_PATH.'public/js/');
$page->addScripts('ResizeSensor.js', CONTENT_PATH . 'public/plugins/theia-sticky-sidebar/');
$page->addScripts('theia-sticky-sidebar.js', CONTENT_PATH . 'public/plugins/theia-sticky-sidebar/');
$page->setPageContent('patient/profile.blade.php');
$page->makePage();