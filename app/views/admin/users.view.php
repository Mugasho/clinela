<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\admin\AdminPage('Users');
$utils=new \clinela\utils\Utils();
$db->hasAccess('admin/users',3);

if(isset($_GET['d'],$_GET['sub'])){
    $id=filter_input(INPUT_GET,'d',FILTER_SANITIZE_NUMBER_INT);
    switch ($_GET['sub']) {
        case 'sp':
            $db->deleteUserByID($id);
            $page->setPageError('User deleted', 'Success', 'error');
            break;
        case 'st':
            $user=$db->getUserByID($id);
            $status=$user['status']==1?0:1;
            $db->updateStatus($user['unique_id'],$status);
            break;
    }

}

if(isset($_POST['subject'],$_POST['role'],$_POST['message'])){
    $role=filter_input(INPUT_POST,'role',FILTER_SANITIZE_NUMBER_INT);
    $subject=filter_input(INPUT_POST,'subject',FILTER_SANITIZE_STRING);
    $message=$_POST['message'];
    $users=$db->getAllUserMeta();

    foreach ($users as $user){
        $to                  = $user['email'];
        $subject             = $subject;
        $from                = $db->getOptions( 'site_support_email' );
        $content             = $user;
        $content['msg']      = $message;
        $content['btn_text'] = 'View details';
        $content['btn_link'] = 'login/';
        $utils->sendEmail( $from, $to, $subject, $utils->getHtmlMessage( $content ) );
        if($role==$user['role']){
            $utils->sendEmail( $from, $to, $subject, $utils->getHtmlMessage( $content ) );
        }
        if($role==3){
            $utils->sendEmail( $from, $to, $subject, $utils->getHtmlMessage( $content ) );
        }
    }
    $page->setPageError('Emails Sent to users', 'Success', 'success');

}
$page->addStyle('summernote.css', CONTENT_PATH . 'admin/plugins/summernote/dist/');
$page->addScripts('summernote.js', CONTENT_PATH.'admin/plugins/summernote/dist/');
$page->setPageContent('admin/users.blade.php');
$page->makePage();