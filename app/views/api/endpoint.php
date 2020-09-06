<?php
$db = new \clinela\database\DB();
$page = new \clinela\template\admin\AdminPage('Endpoint');
if(isset($_GET['d'],$_GET['sub'])){
    $id=filter_input(INPUT_GET,'d',FILTER_SANITIZE_NUMBER_INT);
    switch ($_GET['sub']) {
        case 'sp':
            $db->deleteUserByID($id);
            echo 'User Deleted';
            break;
        case 'st':
            $user=$db->getUserByID($id);
            $status=$user['status']==1?0:1;
            $db->updateStatus($user['unique_id'],$status);
            echo 'user updated';
            break;
        case 'dr':
            $user=$db->getUserMeta($id);
            $role=$user['role']==1?0:1;
            $db->approveDoctor($user['user_id'],$role);
            echo 'user activated';
            break;
    }

}