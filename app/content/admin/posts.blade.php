<?php
$db=new \clinela\database\DB();
$search=isset($_GET['s'])?filter_input(INPUT_GET,'s',FILTER_SANITIZE_STRING):'';
$posts=$db->getPosts($search);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <a href="<?php echo BASE_PATH?>admin/add-post/" class="btn btn-primary">Add New post</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-hover table-center mb-0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Created Date</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($posts)) {
                            foreach ($posts as $post){
                                $user=$db->getUserMeta($post['user_id']);
                                $img = !empty($post['post_image']) ? CONTENT_PATH . 'uploads/' . $post['post_image'] : CONTENT_PATH . 'public/img/blog/blog-01.jpg';
                                echo ' <tr>
                                <td><a href="'.BASE_PATH.'blog/'.$post['id'].'/">#'.$post['id'].'</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar avatar-sm mr-2"><img class="avatar-img" src="'.$img.'" alt="User Image"></a>
                                        <a href="'.BASE_PATH.'blog/'.$post['id'].'/">'.$post['title'].'</a>
                                    </h2>
                                </td>
                                <td>'.$user['username'].'</td>
                                <td>'.date("j - M Y",strtotime($post['created_at'])).'</td>

                                <td class="text-right">
                                    <div class="actions">

                                        <a  href="'.BASE_PATH.'admin/edit-post/'.$post['id'].'/" class="btn btn-sm bg-success-light mr-2">
                                            <i class="fe fe-pencil"></i> Edit
                                        </a>
                                        <a class="btn btn-sm bg-danger-light"  href="?d='.$post['id'].'">
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
