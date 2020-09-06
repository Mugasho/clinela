<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Booking Success');
$id=$match['params']['id'];
$page->setPageVars($id);
$page->setPageContent('public/booked.blade.php');
$page->makePage();