<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Checkout');
$id=$match['params']['id'];
$user_id=$_SESSION['id'];
$page->setPageVars($id);
$page->addScripts('ResizeSensor.js', CONTENT_PATH . 'public/plugins/theia-sticky-sidebar/');
$page->addScripts('theia-sticky-sidebar.js', CONTENT_PATH . 'public/plugins/theia-sticky-sidebar/');

$page->setPageContent('public/checkout.blade.php');
$page->makePage();