<?php
        $db=new \clinela\database\DB();
$post=$this->getPageVars();
$user=$db->getUserMeta($post['user_id']);
$side_posts=$db->getPosts('',5);
$user_img=!empty($user['photo'])?CONTENT_PATH.'uploads/'.$user['photo']:CONTENT_PATH.'public/img/patients/patient1.jpg';
$blog_img=!empty($post['post_image'])?CONTENT_PATH.'uploads/'.$post['post_image']:CONTENT_PATH.'public/img/blog/blog-01.jpg';
$postCategory=$db->getPostCategoryByID($post['category_id']);
$category=$post['category_id']==0?'Uncategorized':$postCategory['category'];
$can_edit= isset($_SESSION['role'])&& $_SESSION['role']>1;
$sideCategories=$db->getPostCategories(10);
$tags=explode(",",$post['tags']);
$comments=$db->getPostComments($post['id']);
?>

<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="blog-view">
            <div class="blog blog-single-post">
                <div class="blog-image">
                    <a href="javascript:void(0);"><img alt="" src="<?php echo $blog_img?>" class="img-fluid"></a>
                </div>
                <h3 class="blog-title"><?php echo $post['title']?></h3>
                <div class="blog-info clearfix">
                    <div class="post-left">
                        <ul>
                            <li>
                                <div class="post-author">
                                    <a href="doctor-profile.html"><img src="<?php echo $user_img?>" alt="Post Author"> <span> <?php echo $user['username']?></span></a>
                                </div>
                            </li>
                            <li><i class="far fa-calendar"></i><?php echo date("j M Y",strtotime($post['created_at']))?></li>
                            <li><i class="far fa-comments"></i><?php echo count($comments)?> Comments</li>
                            <li><i class="fa fa-tags"></i><?php echo $category?></li>
                            <?php
                            if($can_edit){
                                echo '<li><a href="'.BASE_PATH.'admin/edit-post/'.$post['id'].'/" class="btn btn-link"><i class="far fa-edit"></i> edit</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="blog-content">
                    <p><?php echo $post['content']?></p>
                </div>
            </div>

            <div class="card blog-share clearfix">
                <div class="card-header">
                    <h4 class="card-title">Share the post</h4>
                </div>
                <div class="card-body">
                    <ul class="social-share">
                        <li><a href="#" title="Facebook"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="#" title="Google Plus"><i class="fab fa-google-plus"></i></a></li>
                        <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card blog-comments clearfix">
                <div class="card-header">
                    <h4 class="card-title">Comments (<?php echo count($comments)?>)</h4>
                </div>
                <div class="card-body pb-0">
                    <ul class="comments-list">
                        <?php if (!empty($comments)) {
                            foreach ($comments as $comment) {
                                echo '<li>
                                <div class="comment">
                                    <div class="comment-author">
                                        <img class="avatar" alt="" src="'.CONTENT_PATH.'public/img/patients/patient7.jpg">
                                    </div>
                                    <div class="comment-block">
                                                        <span class="comment-by">
                                                            <span class="blog-author-name">'.$comment['username'].'</span>
                                                        </span>
                                        <p>'.$comment['comment'].'</p>
                                        <p class="blog-date">'.date("j Y M",strtotime($comment['created_at'])).'</p>
                                        <a class="comment-btn" href="#">
                                            <i class="fas fa-reply"></i> Reply
                                        </a> ';
                                if($can_edit){
                                    echo '<a class="comment-btn" href="?d='.$comment['id'].'&sub=comment">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </a>';
                                }
                                        echo '
                                    </div>
                                </div>
                            </li>';
                            }
                        }?>
                    </ul>
                </div>
            </div>

            <div class="card new-comment clearfix">
                <div class="card-header">
                    <h4 class="card-title">Leave Comment</h4>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="form-group">
                            <label>Your Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Comments</label>
                            <textarea rows="4" class="form-control" name="comment" required></textarea>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Blog Sidebar -->
    <div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">

        <!-- Search -->
        <div class="card search-widget">
            <div class="card-body">
                <form class="search-form">
                    <div class="input-group">
                        <input type="text" placeholder="Search..." class="form-control">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Search -->

        <!-- Latest Posts -->
        <div class="card post-widget">
            <div class="card-header">
                <h4 class="card-title">Latest Posts</h4>
            </div>
            <div class="card-body">
                <ul class="latest-posts">
                    <?php if (!empty($side_posts)) {
                        foreach ($side_posts as $side_post){
                            $user=$db->getUserByID($side_post['user_id']);
                            $img = !empty($side_post['post_image']) ? CONTENT_PATH . 'uploads/' . $side_post['post_image'] : CONTENT_PATH . 'public/img/blog/blog-01.jpg';
                            echo '<li>
                            <div class="post-thumb">
                                <a href="'.$side_post['id'].'/">
                                    <img class="img-fluid" src="'.$img.'" alt="">
                                </a>
                            </div>
                            <div class="post-info">
                                <h4>
                                    <a href="'.BASE_PATH.'blog/'.$side_post['id'].'/">'.$side_post['title'].'</a>
                                </h4>
                                <p>'.date("j M Y",strtotime($side_post['created_at'])).'</p>
                            </div>
                        </li>';
                        }
                    }?>

                </ul>
            </div>
        </div>
        <!-- /Latest Posts -->

        <!-- Categories -->
        <div class="card category-widget">
            <div class="card-header">
                <h4 class="card-title">Blog Categories</h4>
            </div>
            <div class="card-body">
                <ul class="categories">
                    <?php if (!empty($sideCategories)) {
                        foreach ($sideCategories as $sideCategory){
                            echo '<li><a href="#">'.$sideCategory['category'].' <span>(0)</span></a></li>';
                        }
                    }?>

                </ul>
            </div>
        </div>
        <!-- /Categories -->

        <!-- Tags -->
        <div class="card tags-widget">
            <div class="card-header">
                <h4 class="card-title">Tags</h4>
            </div>
            <div class="card-body">
                <ul class="tags">
                    <?php if (!empty($tags)) {
                        foreach ($tags as $key=>$value){
                            echo '<li><a href="#" class="tag">'.$value.'</a></li>';
                        }
                    }?>

                </ul>
            </div>
        </div>
        <!-- /Tags -->

    </div>
    <!-- /Blog Sidebar -->

</div>

