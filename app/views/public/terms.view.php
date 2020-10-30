<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Terms');
$page->setPageContent('public/terms.blade.php');
$page->makePage();