<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('My Patients');
$db->hasAccess('doctor/appointments',1);
$page->setPageContent('doctor/my-patients.blade.php');
$page->makePage();