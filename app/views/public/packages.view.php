<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Packages');
$page->setPageContent('public/packages.blade.php');
$page->makePage();