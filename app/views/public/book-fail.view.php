<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Booking Failed');
$page->setPageContent('public/book-fail.blade.php');
$page->makePage();