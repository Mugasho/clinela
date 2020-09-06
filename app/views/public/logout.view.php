<?php
$page =new \clinela\template\Page('Logout');
$db=new \clinela\database\DB();
$db->logout();