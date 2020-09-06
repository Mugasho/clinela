<?php
$db=new \clinela\database\DB();
$post_id   = isset( $match['params']['id'] ) ? $match['params']['id'] : null;
$meta=$db->getUserMeta($post_id);
$title=empty($meta['first_name']) && empty($meta['last_name'])?$meta['username']:$meta['first_name'].' '.$meta['last_name'];
$page=new \clinela\template\Page($title);
$page->setPageVars($post_id);
$page->setPageVars2($meta);

if (isset($_POST['title'],$_POST['review'])){
    if (isset($_POST['rating'])) {
        $rating = str_split($_POST['rating'], 5)[1];
    } else {
        $rating = '0';
    }
    $db->addReview($post_id,$rating,$_POST['title'],$_POST['review']);
}
$page->setPageContent('public/doctor-detail.blade.php');
$page->makePage();