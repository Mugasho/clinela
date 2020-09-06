<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\admin\AdminPage('Edit post');
$db->hasAccess('admin/edit-post',3);
$id=$_SESSION['id'];
$post_id   = isset( $match['params']['id'] ) ? $match['params']['id'] : null;
$post=$db->getPostByID($post_id);
$page->setPageVars($post['id']);
if(isset($_POST['title'],$_POST['category'],$_POST['content'],$_POST['tags'])){

    $upload=new \clinela\utils\Upload(null,$_FILES['post_image']);
    $image=$upload->startUpload();
    $post_image=!empty($image['name'])?$image['name']:$post['post_image'];
    $db->updatePost($post_id,$_POST['category'],$_POST['title'],$_POST['content'],$_POST['tags'],$post_image);
    $page->setPageError('All changes saved','success','success');
}
$page->addStyle('bootstrap-tagsinput.css', CONTENT_PATH . 'public/plugins/bootstrap-tagsinput/css/');
$page->addScripts('bootstrap-tagsinput.js', CONTENT_PATH . 'public/plugins/bootstrap-tagsinput/js/');
$page->addStyle('summernote.css', CONTENT_PATH . 'admin/plugins/summernote/dist/');
$page->addScripts('summernote.js', CONTENT_PATH.'admin/plugins/summernote/dist/');
$page->setPageContent('admin/edit-post.blade.php');
$page->makePage();