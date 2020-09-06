<?php
$db = new \clinela\database\DB();
$specialities = $db->getSpecialities($db->getOptions('section_2_count'));
$doctors = $db->getApprovedUsers(1, $db->getOptions('section_3_count'));
$posts = $db->getPosts('',4);
$features = $db->getFeatures($db->getOptions('section_4_count'));
$can_edit = isset($_SESSION['role']) && $_SESSION['role'] > 1;
$section_1_banner = !empty($db->getOptions('section_1_banner')) ? CONTENT_PATH . 'uploads/' . $db->getOptions('section_1_banner') : CONTENT_PATH . "public/img/search-bg.png";
$section_4_banner = !empty($db->getOptions('section_4_banner')) ? CONTENT_PATH . 'uploads/' . $db->getOptions('section_4_banner') : CONTENT_PATH . "public/img/feature.png";
$section_1_color=!empty($db->getOptions('section_1_color'))?$db->getOptions('section_1_color'):'';
$section_2_color=!empty($db->getOptions('section_2_color'))?'style="background-color:'.$db->getOptions('section_2_color').';"':'';
$section_3_color=!empty($db->getOptions('section_3_color'))?'style="background-color:'.$db->getOptions('section_3_color').';"':'';
$section_4_color=!empty($db->getOptions('section_4_color'))?'style="background-color:'.$db->getOptions('section_4_color').';"':'';
$section_5_color=!empty($db->getOptions('section_5_color'))?'style="background-color:'.$db->getOptions('section_5_color').';"':'';
?>

<!-- Home Banner -->
<section class="section section-search"
         style="background: <?php echo $section_1_color?> url(<?php echo $section_1_banner?>) no-repeat bottom center;">
    <div class="container-fluid">
        <div class="banner-wrapper">
            <div class="banner-header text-center">
                <h1><?php echo $db->getOptions('section_1_title')?></h1>
                <p><?php echo $db->getOptions('section_1_subtitle')?></p>
            </div>

            <!-- Search -->
            <div class="search-box">
                <form action="doctors/">
                    <div class="form-group search-location">
                        <input type="text" class="form-control" placeholder="Search Location" name="location">
                        <span class="form-text">Based on your Location</span>
                    </div>
                    <div class="form-group search-info">
                        <input type="text" class="form-control"
                               placeholder="Search Doctors" name="s">
                        <span class="form-text">Ex : Dental or Sugar Check up etc</span>
                    </div>
                    <button type="submit" class="btn btn-primary search-btn"><i class="fas fa-search"></i>
                        <span>Search</span></button>
                </form>
            </div>
            <!-- /Search -->

        </div>
    </div>
</section>
<!-- /Home Banner -->

<!-- Clinic and Specialities -->
<section class="section section-specialities" <?php echo $section_2_color?>>
    <div class="container-fluid">
        <div class="section-header text-center">
            <h2><?php echo $db->getOptions('section_2_title')?></h2>
            <p class="sub-title"><?php echo $db->getOptions('section_2_title')?></p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-9">

                <!-- Slider -->
                <div class="specialities-slider slider">

                    <?php
                    if (!empty($specialities)) {
                        foreach ($specialities as $speciality) {
                            $img = !empty($speciality['speciality_image']) ? CONTENT_PATH . 'uploads/' . $speciality['speciality_image'] : CONTENT_PATH . 'admin/img/specialities/specialities-01.png';
                            echo '<!-- Slider Item -->
                    <div class="speicality-item text-center">
                        <div class="speicality-img">
                            <img src="' . $img . '" class="img-fluid" alt="Speciality">
                            <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                        </div>
                        <p>' . $speciality['speciality'] . '</p>
                    </div>
                    <!-- /Slider Item -->';
                        }
                    }
                    ?>


                </div>
                <!-- /Slider -->

            </div>
        </div>
    </div>
</section>
<!-- Clinic and Specialities -->

<!-- Popular Section -->
<section class="section section-doctor" <?php echo $section_3_color?>>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-header ">
                    <h2><?php echo $db->getOptions('section_3_title')?></h2>
                    <p><?php echo $db->getOptions('section_3_subtitle')?></p>
                </div>
                <div class="about-content">
                    <p><?php echo $db->getOptions('section_3_content')?></p>
                    <a href="javascript:;">Read More..</a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="doctor-slider slider">
                    <?php if (!empty($doctors)) {
                        foreach ($doctors as $doctor) {
                            $names = empty($doctor['first_name']) && empty($doctor['last_name']) ? $doctor['username'] : $doctor['first_name'] . ' ' . $doctor['last_name'];
                            $img = !empty($doctor['photo']) ? CONTENT_PATH . 'uploads/' . $doctor['photo'] : CONTENT_PATH . 'public/img/patients/patient1.jpg';
                            $city = !empty($doctor['city']) ? $doctor['city'] . ', ' : '';
                            $state = !empty($doctor['state']) ? $doctor['state'] . ', ' : '';
                            $country = !empty($doctor['country']) ? $doctor['country'] : '';
                            $services = $db->getServices($doctor['id']);
                            $speciality=$db->getUserSpeciality($doctor['id']);
                            $speciality_img = !empty($speciality['speciality_image']) ? CONTENT_PATH . 'uploads/' . $speciality['speciality_image'] : CONTENT_PATH . 'public/img/specialities/specialities-05.png';
                            echo '<!-- Doctor Widget -->
                    <div class="profile-widget">
                        <div class="doc-img">
                            <a href="' . BASE_PATH . 'doctors/' . $doctor['id'] . '/">
                                <img class="img-fluid" alt="User Image"
                                     src="' . $img . '">
                            </a>
                            <a href="javascript:setFavourite(' . $doctor['id'] . ')" class="fav-btn">
                                <i class="far fa-bookmark"></i>
                            </a>
                        </div>
                        <div class="pro-content">
                            <h3 class="title">
                                <a href="' . BASE_PATH . 'doctors/' . $doctor['id'] . '/">' . $names . '</a>
                                <i class="fas fa-check-circle verified"></i>
                            </h3>
                             <h5 class="doc-department"><img src="' . $speciality_img . '" class="img-fluid" alt="Speciality">' . $speciality['speciality'] . '</h5>
                            <span class="speciality">';
                            if (!empty($services)) {
                                foreach ($services as $service) {
                                    echo $service['services'] . ',';
                                }
                            }
                            echo '</span>
                            <div class="rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <span class="d-inline-block average-rating">(17)</span>
                            </div>
                            <ul class="available-info">
                                <li>
                                    <i class="fas fa-map-marker-alt"></i>' . $city . $country . '
                                </li>

                            </ul>
                            <div class="row row-sm">
                                <div class="col-6">
                                    <a href="doctors/' . $doctor['id'] . '/" class="btn view-btn">View Profile</a>
                                </div>
                                <div class="col-6">
                                    <a href="' . BASE_PATH . 'booking/' . $doctor['id'] . '/" class="btn book-btn">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Doctor Widget -->';
                        }
                    }?>


                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Popular Section -->

<!-- Availabe Features -->
<section class="section section-features" <?php echo $section_4_color?>>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 features-img">
                <img src="<?php echo $section_4_banner?>" class="img-fluid" alt="Feature">
            </div>
            <div class="col-md-7">
                <div class="section-header">
                    <h2 class="mt-2"><?php echo $db->getOptions('section_4_title')?></h2>
                    <p><?php echo $db->getOptions('section_4_subtitle')?> </p>
                </div>
                <div class="features-slider slider">
                    <?php if (!empty($features)) {
                        foreach ($features as $feature) {
                            $feature_img = !empty($feature['feature_image']) ? CONTENT_PATH . 'uploads/' . $feature['feature_image'] : CONTENT_PATH . 'public/img/features/feature-02.jpg';
                            echo '<!-- Slider Item -->
                        <div class="feature-item text-center">
                            <img src="' . $feature_img . '" class="img-fluid"
                                 alt="Feature">
                            <p>' . $feature['feature'] . '</p>
                        </div>
                        <!-- /Slider Item -->';
                        }
                    }?>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Availabe Features -->

<!-- Blog Section -->
<section class="section section-blogs" <?php echo $section_5_color?>>
    <div class="container-fluid">

        <!-- Section Header -->
        <div class="section-header text-center">
            <h2>Blogs and News</h2>
            <p class="sub-title">News and updates from clinela doctors</p>
        </div>
        <!-- /Section Header -->

        <div class="row blog-grid-row">
            <?php if (!empty($posts)) {
                foreach ($posts as $post) {
                    $user = $db->getUserByID($post['user_id']);
                    $img = !empty($post['post_image']) ? CONTENT_PATH . 'uploads/' . $post['post_image'] : CONTENT_PATH . 'public/img/blog/blog-01.jpg';
                    $category = $post['category_id'] == 0 ? 'Uncategorized' : '';

                    echo '<div class="col-md-6 col-lg-3 col-sm-12">

							<!-- Blog Post -->
							<div class="blog grid-blog">
								<div class="blog-image">
									<a href="'.BASE_PATH.'blog/'.$post['id'].'/"><img class="img-fluid" src="'.$img.'" alt="Post Image"></a>
								</div>
								<div class="blog-content">
									<ul class="entry-meta meta-item">
										<li>
											<div class="post-author">
												<a href="#"><img src="'.CONTENT_PATH.'public/img/doctors/doctor-thumb-01.jpg" alt="Post Author"> <span>By '.$user['username'].'</span></a>
											</div>
										</li>
										<li><i class="far fa-clock"></i>'.date("j M Y",strtotime($post['created_at'])).'</li>
									</ul>
									<h3 class="blog-title"><a href="'.BASE_PATH.'blog/'.$post['id'].'/">'.$post['title'].'</a></h3>
									<p class="mb-0">'.$db->limit(strip_tags($post['content'],100)).'</p>
								</div>';
                    if($can_edit){
                        echo '<a href="admin/edit-post/'.$post['id'].'/" class="btn btn-link"><i class="far fa-edit"></i> edit</a>';
                        echo '<a href="admin/posts/?d='.$post['id'].'" class="btn btn-link"><i class="far fa-trash-alt"></i> Delete</a>';
                    }
							echo '</div>
							<!-- /Blog Post -->

						</div>';
                }
            }
            ?>
        </div>
    </div>
    <div class="view-all text-center">
        <a href="blog/" class="btn btn-primary">View All</a>
    </div>
    </div>
</section>
<!-- /Blog Section -->
<script>
    function reqListener() {
        console.log(this.responseText);
        Swal.fire({
            title: "Success",
            text: this.responseText,
            icon: "success",
        });
    }

    function setFavourite(id) {
        var oReq = new XMLHttpRequest();
        oReq.addEventListener("load", reqListener);
        oReq.open("GET", "<?php echo BASE_PATH?>request/" + id + "/?op=add");
        oReq.send();
    }

</script>

