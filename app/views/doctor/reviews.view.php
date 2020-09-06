<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Reviews');
$db->hasAccess('doctor/reviews',1);
if(isset($_GET['d'])){
    $db->deleteReview($_GET['d']);
    $page->setPageError('Review deleted', 'Success', 'error');
}
$page->setPageContent('doctor/reviews.blade.php');
$page->makePage();