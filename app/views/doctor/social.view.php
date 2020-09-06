<?php
$db=new \clinela\database\DB();
$page=new \clinela\template\Page('Social Links');
$db->hasAccess('doctor/social-media',1);
if(isset($_POST['facebook'],$_POST['whatsapp'],$_POST['twitter'],$_POST['instagram'])){
    $user_id=$_SESSION['id'];
    $links['whatsapp']=filter_input(INPUT_POST,'whatsapp',FILTER_SANITIZE_URL);
    $links['twitter']=filter_input(INPUT_POST,'twitter',FILTER_SANITIZE_URL);
    $links['facebook']=filter_input(INPUT_POST,'facebook',FILTER_SANITIZE_URL);
    $links['instagram']=filter_input(INPUT_POST,'instagram',FILTER_SANITIZE_URL);
    $links['telegram']=filter_input(INPUT_POST,'telegram',FILTER_SANITIZE_URL);
    $links['linkedin']=filter_input(INPUT_POST,'linkedin',FILTER_SANITIZE_URL);
    $links['skype']=filter_input(INPUT_POST,'skype',FILTER_SANITIZE_URL);
    $links['zoom']=filter_input(INPUT_POST,'zoom',FILTER_SANITIZE_URL);


    if(empty($db->getSocialLinks($user_id))){
        $db->addSocialLinks($user_id,$links);
    }else{
        $db->updateSocialLinks($user_id,$links);
    }
    $page->setPageError('All changes Saved','Success','success');
}


$page->setPageContent('doctor/social.blade.php');
$page->makePage();