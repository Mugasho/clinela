<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\admin\AdminPage('Add new post');
$db->hasAccess('admin/add-post',3);
$id=$_SESSION['id'];
if(isset($_POST['title'],$_POST['category'],$_POST['content'],$_POST['tags'])){
    $up=new \clinela\utils\Upload(null,$_FILES['post_image']);
    $image=$up->startUpload();
    $post_image=!empty($image['name'])?$image['name']:'';
    $db->addPost($id,$_POST['category'],$_POST['title'],$_POST['content'],$_POST['tags'],$post_image);
    header('location:'.BASE_PATH.'admin/posts/');
    $page->setPageError('All changes saved','success','success');
}
$page->addStyle('bootstrap-tagsinput.css', CONTENT_PATH . 'public/plugins/bootstrap-tagsinput/css/');
$page->addScripts('bootstrap-tagsinput.js', CONTENT_PATH . 'public/plugins/bootstrap-tagsinput/js/');
$page->addStyle('summernote.css', CONTENT_PATH . 'admin/plugins/summernote/dist/');
$page->addScripts('summernote.js', CONTENT_PATH.'admin/plugins/summernote/dist/');
$page->setPageContent('admin/add-post.blade.php');
$page->makePage();