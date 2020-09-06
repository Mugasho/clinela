<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\admin\AdminPage('Patients');
$db->hasAccess('admin/patient',3);

if(isset($_GET['d'],$_GET['sub'])){
    $id=filter_input(INPUT_GET,'d',FILTER_SANITIZE_NUMBER_INT);
    switch ($_GET['sub']) {
        case 'sp':
            $db->deleteUserByID($id);
            $page->setPageError('User deleted', 'Success', 'error');
            break;
        case 'dr':
            $user=$db->getUserMeta($id);
            $role=$user['role']==1?0:1;
            $db->upgradeUser($user['user_id'],$role);
            $page->setPageError('User upgraded', 'Success', 'success');
            break;
    }


}
$page->setPageContent('admin/patient.blade.php');
$page->makePage();