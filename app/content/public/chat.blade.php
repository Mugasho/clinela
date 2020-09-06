<?php
$db = new \clinela\database\DB();
$id = $this->getPageVars();
$uid = $_SESSION['id'];
$chat_users = $db->getChatUsers($uid);
$chats = $db->getChatDetails($uid, $id);
$doctor = $db->getUserMeta($id);
$doctor_img = !empty($doctor['photo']) ? CONTENT_PATH . 'uploads/' . $doctor['photo'] : CONTENT_PATH . 'public/img/patients/patient1.jpg';
$links = $db->getSocialLinks($id);
$zoom = !empty($links['zoom']) ? $links['zoom'] : '#';
$me = $db->getUserMeta($uid);
?>
<style>
    .loader,
    .loader:before,
    .loader:after {
        border-radius: 50%;
        width: 2.5em;
        height: 2.5em;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
        -webkit-animation: load7 1.8s infinite ease-in-out;
        animation: load7 1.8s infinite ease-in-out;
    }

    .loader {
        color: #1c9c9c;
        font-size: 10px;
        margin: 80px auto;
        position: relative;
        text-indent: -9999em;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
        -webkit-animation-delay: -0.16s;
        animation-delay: -0.16s;
    }

    .loader:before,
    .loader:after {
        content: '';
        position: absolute;
        top: 0;
    }

    .loader:before {
        left: -3.5em;
        -webkit-animation-delay: -0.32s;
        animation-delay: -0.32s;
    }

    .loader:after {
        left: 3.5em;
    }

    @-webkit-keyframes load7 {
        0%,
        80%,
        100% {
            box-shadow: 0 2.5em 0 -1.3em;
        }
        40% {
            box-shadow: 0 2.5em 0 0;
        }
    }

    @keyframes load7 {
        0%,
        80%,
        100% {
            box-shadow: 0 2.5em 0 -1.3em;
        }
        40% {
            box-shadow: 0 2.5em 0 0;
        }
    }

</style>
<div class="row">
    <div class="col-xl-12">
        <div class="chat-window">

            <!-- Chat Left -->
            <div class="chat-cont-left">
                <div class="chat-header">
                    <span>Chats</span>
                    <a href="javascript:void(0)" class="chat-compose">
                        <i class="material-icons">control_point</i>
                    </a>
                </div>
                <form class="chat-search">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <i class="fas fa-search"></i>
                        </div>
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                </form>
                <div class="chat-users-list">
                    <div class="chat-scroll" id="chat-users-list">
                        <div class="loader">Loading...</div>
                    </div>
                </div>
            </div>
            <!-- /Chat Left -->

            <!-- Chat Right -->
            <div class="chat-cont-right">
                <div class="chat-header">
                    <a id="back_user_list" href="javascript:void(0)" class="back-user-list">
                        <i class="material-icons">chevron_left</i>
                    </a>
                    <div class="media">
                        <div class="media-img-wrap">
                            <div class="avatar avatar-online">
                                <img src="<?php echo $doctor_img?>" alt="User Image"
                                     class="avatar-img rounded-circle" id="user_image" name="user_image">
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="user-name" id="username" name="username">
                                Dr. <?php echo $doctor['first_name'] . ' ' . $doctor['last_name']?></div>
                            <div class="user-status">online</div>
                        </div>
                    </div>
                    <div class="chat-options">
                        <a href="tel:<?php echo $doctor['phone']?>" id="tel" name="tel">
                            <i class="material-icons">local_phone</i>
                        </a>
                        <a href="<?php echo $zoom?>">
                            <i class="material-icons">videocam</i>
                        </a>
                        <?php if($me['role'] > 0){?>
                        <a href="<?php echo BASE_PATH . 'doctor/patient/' . $doctor['user_id'] . '/'?>">
                            <i class="material-icons">person</i>
                        </a>
                        <?php }?>
                    </div>
                </div>
                <div class="chat-body" id="chat-body">
                    <div class="chat-scroll" id="chat-scroll">
                        <ul class="list-unstyled" id="chat-details">
                            <?php if (!empty($chats)) {
                                foreach ($chats as $chat) {
                                    if ($chat['user_id'] == $uid && $chat['content_type'] == 0) {
                                        echo '<li class="media sent">
                                    <div class="media-body">
                                        <div class="msg-box">
                                            <div>
                                                <p>' . $chat['content'] . '</p>
                                                <ul class="chat-msg-info">
                                                    <li>
                                                        <div class="chat-time">
                                                            <span>' . date("h:i A", strtotime($chat['created_at'])) . '</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>';
                                    }
                                    if ($chat['user_id'] == $uid && $chat['content_type'] == 1) {
                                        echo '<li class="media sent">
                                    <div class="media-body">
                                        <div class="msg-box">
                                        <div>
                                            <div class="chat-msg-attachments">
                                                <div class="chat-attachment">
                                                    <img src="' . CONTENT_PATH . 'uploads/' . $chat['content'] . '" alt="Attachment">
                                                    <div class="chat-attach-caption">' . $chat['content'] . '</div>
                                                    <a href="' . CONTENT_PATH . 'uploads/' . $chat['content'] . '" class="chat-attach-download">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                </div>

                                            </div>
                                            <ul class="chat-msg-info">
                                                <li>
                                                    <div class="chat-time">
                                                        <span>' . date("h:i A", strtotime($chat['created_at'])) . '</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    </div>
                                </li>';
                                    }
                                    if ($chat['doctor_id'] == $uid && $chat['content_type'] == 0) {
                                        $doc = $db->getUserMeta($chat['user_id']);
                                        $doc_img = !empty($doc['photo']) ? CONTENT_PATH . 'uploads/' . $doc['photo'] : CONTENT_PATH . 'public/img/patients/patient1.jpg';
                                        echo '<li class="media received">
                                <div class="avatar">
                                    <img src="' . $doc_img . '" alt="User Image"
                                         class="avatar-img rounded-circle">
                                </div>
                                <div class="media-body">
                                    <div class="msg-box">
                                        <div>
                                            <p>' . $chat['content'] . '</p>
                                            <ul class="chat-msg-info">
                                                <li>
                                                    <div class="chat-time">
                                                        <span>' . date("h:i A", strtotime($chat['created_at'])) . '</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>';
                                    }
                                    if ($chat['doctor_id'] == $uid && $chat['content_type'] == 1) {
                                        $doc = $db->getUserMeta($chat['user_id']);
                                        $doc_img = !empty($doc['photo']) ? CONTENT_PATH . 'uploads/' . $doc['photo'] : CONTENT_PATH . 'public/img/patients/patient1.jpg';
                                        echo '<li class="media received">
                                <div class="avatar">
                                    <img src="' . $doc_img . '" alt="User Image"
                                         class="avatar-img rounded-circle">
                                </div>
                                <div class="media-body">
                                    <div class="msg-box">
                                        <div>
                                            <div class="chat-msg-attachments">
                                                <div class="chat-attachment">
                                                    <img src="' . CONTENT_PATH . 'uploads/' . $chat['content'] . '" alt="Attachment">
                                                    <div class="chat-attach-caption">' . $chat['content'] . '</div>
                                                    <a href="' . CONTENT_PATH . 'uploads/' . $chat['content'] . '" class="chat-attach-download">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                </div>

                                            </div>
                                            <ul class="chat-msg-info">
                                                <li>
                                                    <div class="chat-time">
                                                        <span>' . date("h:i A", strtotime($chat['created_at'])) . '</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>';
                                    }
                                }
                            } ?>
                        </ul>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" name="chat-form">
                    <div class="chat-footer">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="btn-file btn">
                                    <i class="fa fa-paperclip"></i>
                                    <input type="file" name="chat_image">
                                </div>
                            </div>

                            <input type="text" class="input-msg-send form-control" name="chat_msg" id="chat_msg"
                                   placeholder="Type something">
                            <div class="input-group-append">
                                <button type="submit" class="btn msg-send-btn"><i class="fab fa-telegram-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /Chat Right -->

        </div>
    </div>
</div>
<script>
    function navigate(location) {
        window.location = location;
    }
</script>
<script language="javascript">
    window.onload = function () {
        var objDiv = document.getElementById("chat-scroll");
        objDiv.scrollTop = objDiv.scrollHeight;
    }

</script>

<script>
    let old_list = '';
    let old_detail = '';
    let content_path = '<?php echo CONTENT_PATH?>';
    let uid =<?php echo $uid?>;
    let doc_id =<?php echo $id?>;
    let doctor_image='';

    function get_avatar(id){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // Typical action to be performed when the document is ready:
                let user = JSON.parse(xhttp.responseText);
                document.getElementById("user_image").src=user.avatar;
                document.getElementById("username").innerText="Dr. "+ user.first_name +" "+user.last_name;
                document.getElementById("tel").setAttribute('href', "tel:"+user.phone);

            }
        };
        xhttp.open("GET", "<?php echo BASE_PATH?>chat-api/" + id + "/?q=meta&uid=<?php echo $uid?>");
        xhttp.send();
    }

    function getDetails(response) {
        if (old_detail !== response) {
            old_detail = response;
            let obj = JSON.parse(response);
            $("#chat-details").empty();
            obj.forEach(function (item) {
                created_at = new Date(item.created_at);
                doctor_image=item.doc_image;
                var chat_item = '';
                if (item.user_id == uid && item.content_type == 0) {
                    chat_item = '<li class="media sent">\n' +
                        '                                    <div class="media-body">\n' +
                        '                                        <div class="msg-box">\n' +
                        '                                            <div>\n' +
                        '                                                <p>' + item.content + '</p>\n' +
                        '                                                <ul class="chat-msg-info">\n' +
                        '                                                    <li>\n' +
                        '                                                        <div class="chat-time">\n' +
                        '                                                            <span>' + item.time + '</span>\n' +
                        '                                                        </div>\n' +
                        '                                                    </li>\n' +
                        '                                                </ul>\n' +
                        '                                            </div>\n' +
                        '                                        </div>\n' +
                        '                                    </div>\n' +
                        '                                </li>';
                }

                if (item.user_id == uid && item.content_type == 1) {
                    chat_item = '<li class="media sent">\n' +
                        '                                    <div class="media-body">\n' +
                        '                                        <div class="msg-box">\n' +
                        '                                        <div>\n' +
                        '                                            <div class="chat-msg-attachments">\n' +
                        '                                                <div class="chat-attachment">\n' +
                        '                                                    <img src="' + item.image + '" alt="Attachment">\n' +
                        '                                                    <div class="chat-attach-caption">' + item.content + '</div>\n' +
                        '                                                    <a href="' + item.image + '" class="chat-attach-download">\n' +
                        '                                                        <i class="fas fa-download"></i>\n' +
                        '                                                    </a>\n' +
                        '                                                </div>\n' +
                        '\n' +
                        '                                            </div>\n' +
                        '                                            <ul class="chat-msg-info">\n' +
                        '                                                <li>\n' +
                        '                                                    <div class="chat-time">\n' +
                        '                                                        <span>' + item.time + '</span>\n' +
                        '                                                    </div>\n' +
                        '                                                </li>\n' +
                        '                                            </ul>\n' +
                        '                                        </div>\n' +
                        '                                    </div>\n' +
                        '                                    </div>\n' +
                        '                                </li>';
                }
                if (item.doctor_id == uid && item.content_type == 0) {
                    chat_item = '<li class="media received">\n' +
                        '                                <div class="avatar">\n' +
                        '                                    <img src="' + item.doc_image + '" alt="User Image"\n' +
                        '                                         class="avatar-img rounded-circle">\n' +
                        '                                </div>\n' +
                        '                                <div class="media-body">\n' +
                        '                                    <div class="msg-box">\n' +
                        '                                        <div>\n' +
                        '                                            <p>' + item.content + '</p>\n' +
                        '                                            <ul class="chat-msg-info">\n' +
                        '                                                <li>\n' +
                        '                                                    <div class="chat-time">\n' +
                        '                                                        <span>' + item.time + '</span>\n' +
                        '                                                    </div>\n' +
                        '                                                </li>\n' +
                        '                                            </ul>\n' +
                        '                                        </div>\n' +
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '                            </li>';
                }

                if (item.doctor_id == uid && item.content_type == 1) {
                    chat_item = '<li class="media received">\n' +
                        '                                <div class="avatar">\n' +
                        '                                    <img src="' + item.doc_image + '" alt="User Image"\n' +
                        '                                         class="avatar-img rounded-circle">\n' +
                        '                                </div>\n' +
                        '                                <div class="media-body">\n' +
                        '                                    <div class="msg-box">\n' +
                        '                                        <div>\n' +
                        '                                            <div class="chat-msg-attachments">\n' +
                        '                                                <div class="chat-attachment">\n' +
                        '                                                    <img src="' + item.image + '" alt="Attachment">\n' +
                        '                                                    <div class="chat-attach-caption">' + item.content + '</div>\n' +
                        '                                                    <a href="' + item.image + '" class="chat-attach-download">\n' +
                        '                                                        <i class="fas fa-download"></i>\n' +
                        '                                                    </a>\n' +
                        '                                                </div>\n' +
                        '\n' +
                        '                                            </div>\n' +
                        '                                            <ul class="chat-msg-info">\n' +
                        '                                                <li>\n' +
                        '                                                    <div class="chat-time">\n' +
                        '                                                        <span>' + item.time + '</span>\n' +
                        '                                                    </div>\n' +
                        '                                                </li>\n' +
                        '                                            </ul>\n' +
                        '                                        </div>\n' +
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '                            </li>';
                }
                $("#chat-details").append(chat_item);
            });

            let objDiv = document.getElementById("chat-scroll");
            objDiv.scrollTop = objDiv.scrollHeight;

            let audio = new Audio("<?php echo CONTENT_PATH.'audio/point-blank.ogg'?>");
            audio.play();
        }
    }

    function get_chat_details(st, id) {
        doc_id = id;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // Typical action to be performed when the document is ready:
                get_avatar(id);
                get_chat_users("users", uid);
                getDetails(xhttp.responseText);

            }
        };
        xhttp.open("GET", "<?php echo BASE_PATH?>chat-api/" + id + "/?q=" + st+"&uid=<?php echo $uid?>");
        xhttp.send();
    }

    function reqListener() {
        old_list = this.response.text;
        let obj = JSON.parse(this.responseText);
        $("#chat-users-list").empty();
        obj.forEach(function (item) {
            //console.log(item.names);

            var list_item = '<a href="javascript:void(0);" onclick="get_chat_details(\'details\',' + item.user_id + ')" class="media">\n' +
                '                                <div class="media-img-wrap">\n' +
                '                                    <div class="avatar avatar-away">\n' +
                '                                        <img src="' + item.icon + '" alt="User Image" class="avatar-img rounded-circle">\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                                <div class="media-body">\n' +
                '                                    <div>\n' +
                '                                        <div class="user-name">' + item.names + '</div>\n' +
                '                                        <div class="user-last-chat">' + item.last_chat + '</div>\n' +
                '                                    </div>\n' +
                '                                    <div>\n' +
                '                                        <div class="last-chat-time block">2 min</div>\n' +
                '                                        <div class="badge badge-success badge-pill">' + item.count + '</div>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                            </a>';
            $("#chat-users-list").append(list_item);
        })

    }


    function get_chat_users(st, id) {
        var oReq = new XMLHttpRequest();
        oReq.addEventListener("load", reqListener);
        oReq.open("GET", "<?php echo BASE_PATH?>chat-api/" + id + "/?q=" + st+"&uid=<?php echo $uid?>");
        oReq.send();
    }

    setInterval(function () {
        //$("#chat-details").load(location.href + " #chat-details");
        //window.location.assign(document.URL);
        get_chat_users("users", uid);
        get_chat_details("details", doc_id);
    }, 5000);


    var form = document.forms.namedItem("chat-form");
    form.addEventListener('submit', function (ev) {

        oData = new FormData(form);
        oData.append("CustomField", "This is some extra data");

        var oReq = new XMLHttpRequest();
        oReq.open("POST", "<?php echo BASE_PATH?>chat-api/" + doc_id + "/?uid=<?php echo $uid?>");
        oReq.onload = function (oEvent) {
            if (oReq.status == 200) {
                $("#chat_msg").val(null);
                get_chat_details('details', doc_id);
            } else {

            }
        };

        oReq.send(oData);
        ev.preventDefault();
    }, false);
</script>