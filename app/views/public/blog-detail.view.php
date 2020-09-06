<?php
$db=new \clinela\database\DB();
$post_id   = isset( $match['params']['id'] ) ? $match['params']['id'] : null;
$post=$db->getPostByID($post_id);
$title=$post['title'];
$page=new \clinela\template\Page($title);
$page->setPageVars($post);
if (isset($_POST['username'],$_POST['email'],$_POST['comment'])){
    $username=$_POST['username'];
    $email=$_POST['email'];
    $comment=filter_input(INPUT_POST,'comment',FILTER_SANITIZE_STRIPPED);
    $db->addPostComment($post_id,$username,$email,$comment);
}
$can_edit= isset($_SESSION['role'])&& $_SESSION['role']>1;
if($can_edit){
    if(isset($_GET['d'],$_GET['sub'])){
        if($_GET['sub']=='comment'){
            $db->deletePostComment($_GET['d']);
        }
    }
}
$page->setPageContent('public/blog-detail.blade.php');
$page->makePage();