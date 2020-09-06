<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\admin\AdminPage('Comments');
$db->hasAccess('admin/posts/comments',3);
if(isset($_GET['d'])){
    $db->deletePostComment($_GET['d']);
    $page->setPageError('Comment deleted', 'Success', 'error');
}
$page->setPageContent('admin/post-comments.blade.php');
$page->makePage();