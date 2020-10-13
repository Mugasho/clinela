<?php
use clinela\database\DB;
use clinela\utils\Utils;

if (isset($_GET['email'], $_GET['password'])) {
    $response['status']= 200;
    $response['error']= false;
    $db=new DB();
    $utils=new Utils();
    $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_STRIPPED);
    $user = $db->getUserByEmailAndPassword($email, $password);
    if ($user != null) {
        $response['status']= 200;
        $response['error']= false;
        $response['user']=$user;
        //save login to Logs
        $browser = $utils->getBrowser();
        $meta = $db->getUserMeta($user['id']);
    } else {
        $response['status']= 304;
        $response['error']= true;
        $response['message']= 'Wrong email or password';
    }

    echo json_encode($response);
}