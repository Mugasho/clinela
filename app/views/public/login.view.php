<?php
$db = new \clinela\database\DB();
$utils = new \clinela\utils\Utils();
$page = new \clinela\template\Page('Login');
$page->setHasBreadcrumb(false);
if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRIPPED);
    $user = $db->getUserByEmailAndPassword($email, $password);
    if ($user != null) {
        //save login to Logs
        $browser = $utils->getBrowser();
        $meta = $db->getUserMeta($user['id']);
        $db->addUserLoginActivity($user['id'], $browser['platform'], $browser['name'], $_SERVER['SERVER_ADDR']);
        if ($meta['role'] == 0) {
            $user_home = BASE_PATH . 'patient/dashboard/';
        }
        if ($meta['role'] > 0) {
            $user_home = BASE_PATH . 'doctor/dashboard/';
        }
        if ($meta['role'] > 1) {
            $user_home = BASE_PATH . 'admin/';
        }
        $return_path = isset($_GET['return']) ? BASE_PATH . str_replace(" ", "/", $_GET['return']) . '/' : $user_home;
        header('Location:' . $return_path);
    } else {
        $page->setPageError(' Wrong email or password', 'Login Failed', 'error');
    }
}
$page->setPageContent('public/login.blade.php');
$page->makePage();