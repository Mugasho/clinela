<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Doctors');
$page->setPageContent('public/search.blade.php');
$page->makePage();
