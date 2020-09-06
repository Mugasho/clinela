<?php
$db = new \clinela\database\DB();
$page = new \clinela\template\Page('Profile');
$db->hasAccess('doctor/profile',1);
$id = $_SESSION['id'];
if (isset($_POST['first_name'], $_POST['last_name'], $_POST['dob'])) {
    $meta = $db->getUserMeta($id);
    $user_meta['user_id'] = $id;
    $user_meta['user_id'] = $_SESSION['id'];
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
    $user_meta['account_no'] = $_POST['account_no'];
    $user_meta['bank_name'] = $_POST['bank_name'];
    $photo = new \clinela\utils\Upload(null, $_FILES['profile']);
    $p = $photo->startUpload();
    $user_meta['photo'] = !empty($p['name']) ? $p['name'] : $meta['photo'];
    $db->updateUserMeta($user_meta);
    //$page->setPageError('All changes have been Saved', 'Success', 'success');
}

if (isset($_POST['education'])) {
    $education = $_POST['education'];
    foreach ($education as $educ) {
        $db->addEducation($id, $educ['degree'], $educ['college'], $educ['completion']);
    }
    //$page->setPageError('All changes have been Saved', 'Success', 'success');
}
if(isset($_POST['experience'])){
    $experience=$_POST['experience'];
    foreach ($experience as $xp){
        $db->addExperience($id,$xp['hospital'],$xp['from'],$xp['to'],$xp['designation']);
    }
    //$page->setPageError('All changes have been Saved', 'Success', 'success');
}

if(isset($_POST['awards'])){
    $awards=$_POST['awards'];
    foreach ($awards as $award){
        $db->addAward($id,$award['award'],$award['award_date']);
    }
    //$page->setPageError('All changes have been Saved', 'Success', 'success');
}

if(isset($_POST['memberships'])){
    $memberships=$_POST['memberships'];
    foreach ($memberships as $membership){
        $db->addMembership($id,$membership['membership']);
    }
    //$page->setPageError('All changes have been Saved', 'Success', 'success');
}

if(isset($_POST['specialization'])){
    $speciality_id=$_POST['specialization'];
    $db->deleteUserSpeciality($id);
    $db->addUserSpeciality($id,$speciality_id);
    //$page->setPageError('All changes have been Saved', 'Success', 'success');
}

if(isset($_POST['services'])){
    $services=$_POST['services'];
    foreach ($services as $service){
        $db->addServices($id,$service['services'],$service['amount']);
    }
    //$page->setPageError('All changes have been Saved', 'Success', 'success');
}

if(isset($_POST['registrations'])){
    $registrations=$_POST['registrations'];
    foreach ($registrations as $registration){
        $db->addRegistration($id,$registration['registration'],$registration['reg_date']);
    }
    //$page->setPageError('All changes have been Saved', 'Success', 'success');
}

if(isset($_GET['d'],$_GET['sub'])){
    switch ($_GET['sub']) {
        case 'ed':
            $db->deleteEducation($_GET['d']);
            break;
        case 'xp':
            $db->deleteExperience($_GET['d']);
            break;
        case 'aw':
            $db->deleteAward($_GET['d']);
            break;
        case 'mb':
            $db->deleteMembership($_GET['d']);
            break;
        case 'rg':
            $db->deleteRegistration($_GET['d']);
            break;
        case 'sv':
            $db->deleteServices($_GET['d']);
            break;
    }

    //$page->setPageError('Item deleted', 'Success', 'error');

}


$page->addStyle('bootstrap-tagsinput.css', CONTENT_PATH . 'public/plugins/bootstrap-tagsinput/css/');
$page->addScripts('dropzone.min.js', CONTENT_PATH . 'public/plugins/dropzone/');
$page->addScripts('bootstrap-tagsinput.js', CONTENT_PATH . 'public/plugins/bootstrap-tagsinput/js/');
$page->addStyle('bootstrap-datetimepicker.min.css',CONTENT_PATH.'public/css/');
$page->addScripts('moment.min.js',CONTENT_PATH.'public/js/');
$page->addScripts('bootstrap-datetimepicker.min.js',CONTENT_PATH.'public/js/');
$page->addScripts('ResizeSensor.js', CONTENT_PATH . 'public/plugins/theia-sticky-sidebar/');
$page->addScripts('theia-sticky-sidebar.js', CONTENT_PATH . 'public/plugins/theia-sticky-sidebar/');
$page->addScripts('profile-settings.js', CONTENT_PATH . 'public/js/');
$page->setPageContent('doctor/profile.blade.php');
$page->makePage();