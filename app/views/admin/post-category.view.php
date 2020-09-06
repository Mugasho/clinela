<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\admin\AdminPage('Post Category');
$db->hasAccess('admin/post/category',3);

if(isset($_POST['category'])){
    $category=$_POST['category'];
    $image=new \clinela\utils\Upload(null,$_FILES['category_image']);
    $category_image=$image->startUpload();
    $name=!empty($category_image['name'])?$category_image['name']:'';
    $db->addPostCategory($category,$name);
    $page->setPageError('All changes have been Saved', 'Success', 'success');
}

if(isset($_GET['d'],$_GET['sub'])) {
    switch ($_GET['sub']) {
        case 'sp':
            $db->deletePostCategory($_GET['d']);
            break;
    }
    $page->setPageError('All changes have been Saved', 'Success', 'success');
}
$page->setPageContent('admin/post-category.blade.php');
$page->makePage();