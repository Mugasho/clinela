<?php
$page=new \clinela\template\Page('Register Success');
$page->setHasBreadcrumb(false);
$page->setPageContent('public/registered.blade.php');
$page->makePage();