<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Favourites');
$db->hasAccess('patient/favourites');
$page->setPageContent('patient/favourites.blade.php');
$page->makePage();