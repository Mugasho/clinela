<?php
$db=new \clinela\database\DB();
$utils=new \clinela\utils\Utils();
$page=new \clinela\template\Page('Register');
$page->setHasBreadcrumb(false);
if ( isset( $_POST['username'], $_POST['email'], $_POST['password'], $_POST['phone'],$_POST['rpt-password'] ) ) {
    $name       = $_POST['username'];
    $email      = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_EMAIL );
    $password   = filter_input( INPUT_POST, 'password', FILTER_DEFAULT );
    $phone   = filter_input( INPUT_POST, 'phone', FILTER_DEFAULT );
    $repeat     = filter_input( INPUT_POST, 'rpt-password', FILTER_DEFAULT );
    $is_doctor=isset($_POST['is_doctor'])?1:0;
    if ( $password != $repeat ) {
        $page->setPageError( 'Sorry, passwords do not match', 'Error', 'error' );
    } elseif ( empty( $name ) ) {
        $page->setPageError( ' Username is required ', 'Error', 'error' );
    }
    else {
        if ( $db->isUserExisted( $email ) ) {
            $page->setPageError( ' User already exists with ' . $email, 'Error', 'error' );
        } else {
            $user = $db->storeUser( $name, $email, $password );
            if ( ! is_null( $user ) ) {

                $user_meta['user_id']        = $user['id'];
                $user_meta['first_name']      = '';
                $user_meta['last_name']      = '';
                $user_meta['phone']          = $phone;
                $user_meta['dob']            = null;
                $user_meta['country']        = 'UG';
                $user_meta['role']=$is_doctor;
                $db->addUserMeta($user_meta);


                $to                  = $email;
                $subject             = 'Clinela account';
                $from                = $db->getOptions( 'site_email' );
                $content             = $user;
                $content['msg']      = 'Thank you for creating an account on our website, there is one
                more step before you can use it, you need to activate your account by clicking the link below. Once you
                click the button, just login to your account and you are set to go.';
                $content['btn_text'] = 'Activate my Account';
                $content['btn_link'] = 'user/verify/' . $user['unique_id'] . '/';
                $utils->sendEmail( $from, $to, $subject, $utils->getHtmlMessage( $content ) );
                //$db->addNotification( $user['id'], 'New User', $user['username'].' has signed up', 'success' );

                $to                  = $db->getOptions( 'site_support_email' );
                $subject             = 'User Registration';
                $from                = $db->getOptions( 'site_email' );
                $content             = $user;
                $content['username']             = 'Admin';
                $content['msg']      = 'A new user has signed up on clinela doctors';
                $content['btn_text'] = 'view user';
                $content['btn_link'] = 'admin/users/';
                $utils->sendEmail( $from, $to, $subject, $utils->getHtmlMessage( $content ) );

                header( 'Location:' . BASE_PATH . 'registered/' );
            }
            else {
                $page->setPageError( ' Please retry later', 'Failed', 'error' );

            }
        }
    }

}
$page->setPageContent('patient/register.blade.php');
$page->makePage();