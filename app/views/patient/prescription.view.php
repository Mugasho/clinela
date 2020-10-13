<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Prescription');
$db->hasAccess('patient/prescription');
$page->setPageContent('patient/prescription.blade.php');
$page->makePage();