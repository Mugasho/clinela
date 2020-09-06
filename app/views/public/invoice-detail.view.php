<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Invoice Detail');
$id=$match['params']['id'];
$page->setPageVars($id);
$page->setPageContent('public/invoice-detail.blade.php');
$page->makePage();