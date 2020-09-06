<?php
$db   = new \clinela\database\DB();
$page = new \clinela\template\Page( 'Verify' );
$id   = isset( $match['params']['id'] ) ? $match['params']['id'] : null;
$user = $db->getUserByUID( $id );
if ( $id == $user['unique_id'] ) {
    $db->updateStatus( $id, '1' );
    $users = $db->getUserByUID( $id );
    if ( $users['status'] == 1 ) {
        header( 'location:' . BASE_PATH . 'user/verified/' );
    }
}else{
    header( 'location:' . BASE_PATH . 'register/' );
}
$page->setPageContent( '' );
