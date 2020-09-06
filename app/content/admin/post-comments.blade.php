<?php
$db=new \clinela\database\DB();
$comments=$db->getAllPostComments();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-hover table-center mb-0">
                        <thead>
                        <tr>
                            <th>Author</th>
                            <th>comment</th>
                            <th>Date</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($comments)) {
                            foreach ($comments as $comment){
                                $img = CONTENT_PATH . 'public/img/blog/blog-01.jpg';
                                echo ' <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="profile.html" class="avatar avatar-sm mr-2"><img class="avatar-img" src="'.$img.'" alt="User Image"></a>
                                        <a href="'.BASE_PATH.'blog/'.$comment['post_id'].'/">'.$comment['username'].'<br> ('.$comment['email'].')</a>
                                    </h2>
                                </td>
                                <td>'.$comment['comment'].'</td>
                                <td>'.date("j - M Y",strtotime($comment['created_at'])).'</td>

                                <td class="text-right">
                                    <div class="actions">
                                        <a class="btn btn-sm bg-danger-light"  href="?d='.$comment['id'].'">
                                            <i class="fe fe-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>';
                            }
                        }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
