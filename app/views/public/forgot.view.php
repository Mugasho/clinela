<?php
$page=new \clinela\template\Page('Forgot Password');
$page->setHasBreadcrumb(false);
$page->setPageContent('public/forgot.blade.php');
$page->makePage();