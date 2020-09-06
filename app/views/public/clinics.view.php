<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Clinics');
$page->setPageContent('public/clinics.blade.php');
$page->makePage();