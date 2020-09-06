<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\admin\AdminPage('All posts');
$id=$match['params']['id'];
$db->hasAccess('admin/profile/'.$id,3);
$user=$db->getUserMeta($id);
$page->setPageVars($user);

if ( isset( $_POST['password'], $_POST['confirm-password'] ) ) {
    $user               = $db->getUserByID( $id );
    $password           = $_POST['password'];
    $confirm            = $_POST['confirm-password'];
    $salt               = $user['salt'];
    $encrypted_password = $user['encrypted_password'];
    if ( $password != $confirm ) {
        $page->setPageError( 'Passwords do not match', '', 'warning' );
    } else {
        $hash = $db->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        $db->updateUserPassword($encrypted_password, $salt, $user['id']);
        $page->setPageError('Passwords changed', '', 'success');
    }
}
$page->setPageContent('admin/profile.blade.php');
$page->makePage();