<?php
$page=new \clinela\template\Page('Clinela Doctors');
$page->setHasBreadcrumb(false);
//$page->setHasHeader(false);
//$page->setHasFooter(false);
$page->setPageContent('public/home.blade.php');
$page->makePage();
