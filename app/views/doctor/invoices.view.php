<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Invoices');
$db->hasAccess('doctor/invoices',1);
$page->setPageContent('doctor/invoices.blade.php');
$page->makePage();