<?php
$db=new \clinela\database\DB();
$search=isset($_GET['s'])?filter_input(INPUT_GET,'s',FILTER_SANITIZE_STRING):'';
$main_posts=$db->getPosts($search);
$side_posts=$db->getPosts('',5);
$can_edit= isset($_SESSION['role'])&& $_SESSION['role']>1;
?>
<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="row blog-grid-row">
            <?php
            if (!empty($main_posts)) {
                foreach ($main_posts as $main_post){
                    $user=$db->getUserByID($main_post['user_id']);
                    $img = !empty($main_post['post_image']) ? CONTENT_PATH . 'uploads/' . $main_post['post_image'] : CONTENT_PATH . 'public/img/blog/blog-01.jpg';
                    echo '<div class="col-md-6 col-sm-12">

                <!-- Blog Post -->
                <div class="blog grid-blog">
                    <div class="blog-image" style="height:300px;">
                        <a href="'.$main_post['id'].'/"><img class="img-fluid" src="'.$img.'" alt="Post Image"></a>
                    </div>
                    <div class="blog-content">
                        <ul class="entry-meta meta-item">
                            <li>
                                <div class="post-author">
                                    <a href="#"><img src="'.CONTENT_PATH . 'public/img/doctors/doctor-thumb-01.jpg" alt="Post Author"> <span>Dr. '.$user['username'].'</span></a>
                                </div>
                            </li>
                            <li><i class="far fa-clock"></i>'.date("j M Y",strtotime($main_post['created_at'])).'</li>
                        </ul>
                        <h3 class="blog-title"><a href="'.$main_post['id'].'/">'.$main_post['title'].'</a></h3>
                        <p class="mb-0">'.$db->limit(strip_tags($main_post['content']),200).'</p>
                    </div>';
                    if($can_edit){
                        echo '<a href="'.BASE_PATH.'admin/edit-post/'.$main_post['id'].'/" class="btn btn-link"><i class="far fa-edit"></i> edit</a>';
                        echo '<a href="admin/posts/?d='.$main_post['id'].'" class="btn btn-link"><i class="far fa-trash-alt"></i> Delete</a>';
                    }
                    echo '
                </div>
                <!-- /Blog Post -->

            </div>';

                }
            }
            ?>
        </div>

        <!-- Blog Pagination -->
        <div class="row">
            <div class="col-md-12">
                <div class="blog-pagination">
                    <nav>
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-double-left"></i></a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- /Blog Pagination -->

    </div>

    <!-- Blog Sidebar -->
    <div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">

        <!-- Search -->
        <div class="card search-widget">
            <div class="card-body">
                <form class="search-form">
                    <div class="input-group">
                        <input type="text" placeholder="Search..." class="form-control" name="s">
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
                                <a href="'.BASE_PATH.'blog/'.$side_post['id'].'/">
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
                    <li><a href="#">Cardiology <span>(62)</span></a></li>
                    <li><a href="#">Health Care <span>(27)</span></a></li>
                    <li><a href="#">Nutritions <span>(41)</span></a></li>
                    <li><a href="#">Health Tips <span>(16)</span></a></li>
                    <li><a href="#">Medical Research <span>(55)</span></a></li>
                    <li><a href="#">Health Treatment <span>(07)</span></a></li>
                </ul>
            </div>
        </div>
        <!-- /Categories -->


    </div>
    <!-- /Blog Sidebar -->

</div>
