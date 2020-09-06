<?php
$db = new \clinela\database\DB();
$id=$match['params']['id'];
$uid = $_GET['uid'];
if(isset($_GET['q']) && $_GET['q']=='users'){
    $chat_users = $db->getChatUsers($uid);
    $users=array();
    foreach ($chat_users as $chat_user) {
        $last_msg = $db->getLastChat($uid, $chat_user['doc_id']);
        $user = $db->getUserMeta($chat_user['doc_id']);
        $img = !empty($user['photo']) ? CONTENT_PATH . 'uploads/' . $user['photo'] : CONTENT_PATH . 'public/img/patients/patient1.jpg';
        $chat_count = !empty($db->countChats($uid, $chat_user['doc_id'])['chat_count']) ? $db->countChats($uid, $chat_user['doc_id'])['chat_count'] : 0;

        $user['url']=BASE_PATH . 'chat/' . $chat_user['doc_id'] . '/';
        $user['icon']=$img;
        $user['names']='Dr. ' . $user['first_name'] . ' ' . $user['last_name'];
        $user['count']=$chat_count;
        $user['last_chat']=!empty($last_msg['content'])?$last_msg['content']:'';
        $users[]=$user;
    }

    echo json_encode($users);
}

if(isset($_GET['q']) && $_GET['q']=='details'){
    $_chats = $db->getChatDetails($uid, $id);
    $chats=array();
    foreach ($_chats as $chat){
        $doc = $db->getUserMeta($chat['user_id']);
        $chat['doc_image'] = !empty($doc['photo']) ? CONTENT_PATH . 'uploads/' . $doc['photo'] : CONTENT_PATH . 'public/img/patients/patient1.jpg';
        $chat['image'] = $chat['content_type']==1 ? CONTENT_PATH . 'uploads/' . $chat['content'] : '';
        $chat['time']=date('h:i A',strtotime($chat['created_at']));
        $chats[]=$chat;
    }
    echo json_encode($chats);
}

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
    echo 'saved';
}

if(isset($_GET['q']) && $_GET['q']=='meta'){
    $doc=$db->getUserMeta($id);
    $links=$db->getSocialLinks($uid);
    $doc['avatar']=!empty($doc['photo']) ? CONTENT_PATH . 'uploads/' . $doc['photo'] : CONTENT_PATH . 'public/img/patients/patient1.jpg';
    echo json_encode($doc);
}