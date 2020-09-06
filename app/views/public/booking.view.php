<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Booking');
$id=$match['params']['id'];
$page->setPageVars($id);
$db->hasAccess('booking/'.$id);
$page->addStyle('main.css', CONTENT_PATH.'public/plugins/fullcalendar/');
$page->addScripts('main.js', CONTENT_PATH.'public/plugins/fullcalendar/');
//$page->addScripts('jquery.fullcalendar.js', CONTENT_PATH.'public/plugins/fullcalendar/');
$page->addStyle('daterangepicker.css', CONTENT_PATH.'public/plugins/daterangepicker/');
$page->addHeaderScripts('moment.min.js', CONTENT_PATH.'public/js/');
$page->addScripts('daterangepicker.js', CONTENT_PATH.'public/plugins/daterangepicker/');
$page->setPageContent('public/booking.blade.php');
$page->makePage();