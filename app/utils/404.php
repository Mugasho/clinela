<?php
$db=new \clinela\database\DB();
$logo=!empty($db->getOptions('header_logo'))?CONTENT_PATH.'uploads/'.$db->getOptions('header_logo'):CONTENT_PATH.'public/img/clinela-logo-red.jpg';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title><?php echo $db->getOptions('site_name')?> - Error 404</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $logo?>">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo CONTENT_PATH ?>admin/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo CONTENT_PATH ?>admin/css/font-awesome.min.css">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="<?php echo CONTENT_PATH ?>admin/css/feathericon.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo CONTENT_PATH ?>admin/css/style.css">

    <!--[if lt IE 9]>
    <script src="<?php echo CONTENT_PATH ?>admin/js/html5shiv.min.js"></script>
    <script src="<?php echo CONTENT_PATH ?>admin/js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="error-page">

<!-- Main Wrapper -->
<div class="main-wrapper">

    <div class="error-box">
        <h1>404</h1>
        <h3 class="h2 mb-3"><i class="fa fa-warning"></i> Oops! Page not found!</h3>
        <p class="h4 font-weight-normal">The page you requested was not found.</p>
        <a href="<?php echo BASE_PATH ?>" class="btn btn-primary">Back to Home</a>
    </div>

</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="<?php echo CONTENT_PATH ?>admin/js/jquery-3.2.1.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="<?php echo CONTENT_PATH ?>admin/js/popper.min.js"></script>
<script src="<?php echo CONTENT_PATH ?>admin/js/bootstrap.min.js"></script>

<!-- Custom JS -->
<script  src="<?php echo CONTENT_PATH ?>admin/js/script.js"></script>

</body>
</html>
