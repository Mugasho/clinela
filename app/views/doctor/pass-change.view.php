<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Change Password');
$db->hasAccess('doctor/change-password',1);
$id   = isset( $_SESSION['id'] ) ? $_SESSION['id'] : null;
$page->setPageVars( $id );
if ( isset( $_POST['old-pass'], $_POST['new-pass'], $_POST['confirm-pass'] ) ) {
    $user               = $db->getUserByID( $id );
    $old_pass           = $_POST['old-pass'];
    $password           = $_POST['new-pass'];
    $confirm            = $_POST['confirm-pass'];
    $salt               = $user['salt'];
    $encrypted_password = $user['encrypted_password'];
    $hash               = $db->checkHashSSHA( $salt, $old_pass );
    // check for password equality
    if ( $encrypted_password == $hash ) {
        if ( $password != $confirm ) {
            $page->setPageError( 'Passwords do not match', '', 'warning' );
        } else {
            $hash               = $db->hashSSHA( $password );
            $encrypted_password = $hash["encrypted"]; // encrypted password
            $salt               = $hash["salt"]; // salt
            $db->updateUserPassword( $encrypted_password, $salt, $user['id'] );
            $page->setPageError( 'Passwords changed', '', 'success' );
        }

    } else {
        $page->setPageError( 'Old Password incorrect', '', 'warning' );
    }
}
$page->setPageContent('doctor/pass-change.blade.php');
$page->makePage();
