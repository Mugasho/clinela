<?php

$db = new \clinela\database\DB();
//$page = new \clinela\template\admin\AdminPage('Settings');
//$db->hasAccess('request');
if(isset($_GET['id'],$_GET['op'])){
    $doctor=$match['params']['id'];
    $id=$_GET['id'];
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
    $search=isset($_GET['search'])?$_GET['search']:'';
    $clinics=$db->getAllClinics(true,$search);
    echo json_encode(mb_convert_encoding($clinics, "UTF-8", "UTF-8"));
}else{
    echo 'Please login first';
}

