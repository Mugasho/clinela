<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\admin\AdminPage('All posts');
$db->hasAccess('admin/posts',3);
if(isset($_GET['d'])){
    $db->deletePost($_GET['d']);
    $page->setPageError('Post deleted', 'Success', 'error');
}
$page->setPageContent('admin/posts.blade.php');
$page->makePage();