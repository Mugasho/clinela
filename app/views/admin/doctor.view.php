<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\admin\AdminPage('Doctors');
$db->hasAccess('admin/doctor',3);

if(isset($_GET['d'],$_GET['sub'])){
    $id=filter_input(INPUT_GET,'d',FILTER_SANITIZE_NUMBER_INT);
    switch ($_GET['sub']) {
        case 'dr':
            $user=$db->getUserMeta($id);
            $role=$user['approved']==1?0:1;
            $db->approveDoctor($user['user_id'],$role);
            $page->setPageError('User updated', 'Success', 'success');
            break;
        case 'up':
            $user=$db->getUserMeta($id);
            $role=$user['role']==1?0:1;
            $db->upgradeUser($user['user_id'],$role);
            $page->setPageError('Role changed to Patient', 'Success', 'success');
            break;
    }

}
$page->setPageContent('admin/doctor.blade.php');
$page->makePage();
