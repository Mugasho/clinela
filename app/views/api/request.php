<?php

$db = new \clinela\database\DB();
$page = new \clinela\template\admin\AdminPage('Settings');
//$db->hasAccess('request');
if(isset($_SESSION['id'],$_GET['op'])){
    $doctor=$match['params']['id'];
    $id=$_SESSION['id'];
    if($_GET['op']=='add'){
        $db->addFavourite($id,$doctor);
        echo 'Favourite Added';
    }elseif($_GET['op']=='del'){
        $db->deleteFavourite($doctor);
        echo 'Favourite Removed';
    }else{
        echo 'Login to add Favourite';
    }
}elseif(isset($_GET['clinics'])){
    $clinics=$db->getAllClinics(true);
    echo json_encode($clinics);
}else{
    echo 'Please login first';
}

