<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Chat');
$uid=$_SESSION['id'];
$id=$match['params']['id'];
$page->setPageVars($id);
$db->hasAccess('chat/'.$id);
$page->setHasBreadcrumb(false);
$page->setHasFooter(false);
if(isset($_POST['chat_msg'])){
    $content=filter_input(INPUT_POST,'chat_msg',FILTER_SANITIZE_STRIPPED);
    $content_type=0;
    if(isset($_FILES['chat_image']) && !empty($_FILES['chat_image']['name'])) {
        $image = new \clinela\utils\Upload(null, $_FILES['chat_image']);
        $speciality_image = $image->startUpload();
        $content = !empty($speciality_image['name']) ? $speciality_image['name'] : $content;
        $content_type=1;
    }
$db->addChat($uid,$id,$content,$content_type);
}
$page->addStyle('daterangepicker.css', CONTENT_PATH.'public/plugins/daterangepicker/');
$page->addHeaderScripts('moment.min.js', CONTENT_PATH.'public/js/');
$page->addScripts('daterangepicker.js', CONTENT_PATH.'public/plugins/daterangepicker/');
$page->setPageContent('public/chat.blade.php');
$page->makePage();