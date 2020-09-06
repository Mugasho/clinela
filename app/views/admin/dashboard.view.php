<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\admin\AdminPage('Doctors');
$db->hasAccess('admin',3);
$page->setPageContent('admin/dashboard.blade.php');
$page->makePage();