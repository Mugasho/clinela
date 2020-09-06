<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Blog');
$page->setPageContent('public/blog.blade.php');
$page->makePage();