<?php
$db = new \clinela\database\DB();
$id=$this->getPageVars();
$doctor = $this->getPageVars2();
$names = empty($doctor['first_name']) && empty($doctor['last_name']) ? $doctor['username'] : $doctor['first_name'] . ' ' . $doctor['last_name'];
$img = !empty($doctor['photo']) ? CONTENT_PATH . 'uploads/' . $doctor['photo'] : CONTENT_PATH . 'public/img/patients/patient1.jpg';
$city = !empty($doctor['city']) ? $doctor['city'] . ', ' : '';
$state = !empty($doctor['state']) ? $doctor['state'] . ', ' : '';
$country = !empty($doctor['country']) ? $doctor['country'] : '';
$services = $db->getServices($id);
$speciality = $db->getUserSpeciality($id);
$speciality_img = !empty($speciality['speciality_image']) ? CONTENT_PATH . 'uploads/' . $speciality['speciality_image'] : CONTENT_PATH . 'public/img/specialities/specialities-05.png';
$studies = $db->getEducation($id);
$experiences = $db->getExperience($id);
$awards = $db->getAwards($id);
$reviews = $db->getReviews($id);
$slotsMonday=$db->getUserSlotsByDay($id,1);
$slotsTuesday=$db->getUserSlotsByDay($id,2);
$slotsWednesday=$db->getUserSlotsByDay($id,3);
$slotsThursday=$db->getUserSlotsByDay($id,4);
$slotsFriday=$db->getUserSlotsByDay($id,5);
$slotsSaturday=$db->getUserSlotsByDay($id,6);
$slotsSunday=$db->getUserSlotsByDay($id,7);
$links=$db->getSocialLinks($id);
$slots=$db->getUserSlots($id);
?>
<div class="container">
<div class="card">
    <div class="card-body">
        <div class="doctor-widget">
            <div class="doc-info-left">
                <div class="doctor-img">
                    <img src="<?php echo $img?>" class="img-fluid"
                         alt="User Image">
                </div>
                <div class="doc-info-cont">
                    <h4 class="doc-name">Dr. <?php echo $names?></h4>
                    <p class="doc-department"><img
                                src="<?php echo $speciality_img?>"
                                class="img-fluid" alt="Speciality"> <?php echo $speciality['speciality']?></p>
                    <div class="rating">
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star filled"></i>
                        <i class="fas fa-star"></i>
                        <span class="d-inline-block average-rating">(<?php echo count($reviews)?>)</span>
                    </div>
                    <div class="clinic-details">
                        <p class="doc-location"><i class="fas fa-map-marker-alt"></i> <?echo $city . $state . $country?>
                            <a
                                    href="javascript:void(0);">Get Directions</a></p>
                    </div>
                    <div class="clinic-services">
                        <?php
                        if (!empty($services)) {
                            foreach ($services as $service) {
                                echo '<span>' . $service['services'] . '</span>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="doc-info-right">
                <div class="clini-infos">
                    <ul>
                        <li><i class="far fa-thumbs-up"></i> 99%</li>
                        <li><i class="far fa-comment"></i> 0 Feedback</li>
                        <li><i class="fas fa-map-marker-alt"></i> <?echo $city . $country?></li>

                    </ul>
                </div>
                <div class="doctor-action">
                    <a href="javascript:setFavourite(<?php echo $doctor['id']?>)" class="btn btn-white fav-btn">
                        <i class="far fa-bookmark"></i>
                    </a>
                    <a href="<?php echo BASE_PATH.'chat/'.$doctor['id'].'/'?>" class="btn btn-white msg-btn">
                        <i class="far fa-comment-alt"></i>
                    </a>
                    <a href="<?php echo !empty($doctor['phone'])?"tel:".$doctor['phone']:"#"?>" class="btn btn-white call-btn">
                        <i class="fas fa-phone"></i>
                    </a>
                    <a href="<?php echo !empty($links['zoom'])?$links['zoom']:'#'?>" class="btn btn-white call-btn" >
                        <i class="fas fa-video"></i>
                    </a>
                </div>
                <div class="clinic-booking">
                    <a class="apt-btn" href="<?php echo BASE_PATH . 'booking/' . $doctor['user_id'] . '/';?>">Book Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--doctor details-->

<div class="card">
    <div class="card-body pt-0">

        <!-- Tab Menu -->
        <nav class="user-tabs mb-4">
            <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                <li class="nav-item">
                    <a class="nav-link active" href="#doc_overview" data-toggle="tab">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#doc_locations" data-toggle="tab">Locations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#doc_reviews" data-toggle="tab">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#doc_business_hours" data-toggle="tab">Business Hours</a>
                </li>
            </ul>
        </nav>
        <!-- /Tab Menu -->

        <!-- Tab Content -->
        <div class="tab-content pt-0">

            <!-- Overview Content -->
            <div role="tabpanel" id="doc_overview" class="tab-pane fade active show">
                <div class="row">
                    <div class="col-md-12 col-lg-9">

                        <!-- Specializations List -->
                        <div class="service-list">
                            <h4>Specialization</h4>
                            <ul class="clearfix">
                                <?php echo $speciality['speciality']?>

                            </ul>
                        </div>
                        <!-- /Specializations List -->


                    </div>
                    <div class="col-lg-6">
                    <?php if(!empty($studies)){?>
                    <!-- Education Details -->
                        <div class="widget education-widget">
                            <h4 class="widget-title">Education</h4>
                            <div class="experience-box">
                                <ul class="experience-list">
                                    <?php foreach ($studies as $study) {
                                        echo '<li>
                                        <div class="experience-user">
                                            <div class="before-circle"></div>
                                        </div>
                                        <div class="experience-content">
                                            <div class="timeline-content">
                                                <a href="#/" class="name">' . $study['college'] . '</a>
                                                <div>' . $study['degree'] . '</div>
                                                <span class="time">' . $study['completion'] . '</span>
                                            </div>
                                        </div>
                                    </li>';
                                    }?>
                                </ul>
                            </div>
                        </div>
                        <!-- /Education Details -->
                        <?php }?>
                    </div>
                    <div class="col-lg-6">
                    <?php if (!empty($experiences)){?>
                    <!-- Experience Details -->
                        <div class="widget experience-widget">
                            <h4 class="widget-title">Work &amp; Experience</h4>
                            <div class="experience-box">
                                <ul class="experience-list">
                                    <?php foreach ($experiences as $experience) {
                                        echo '<li>
                                        <div class="experience-user">
                                            <div class="before-circle"></div>
                                        </div>
                                        <div class="experience-content">
                                            <div class="timeline-content">
                                                <a href="#/" class="name">' . $experience['hospital'] . '</a>
                                                <span class="time">' . $experience['date_from'] . ' - ' . $experience['date_to'] . ' (' . $experience['designation'] . ')</span>
                                            </div>
                                        </div>
                                    </li>';
                                    }?>

                                </ul>
                            </div>
                        </div>
                        <!-- /Experience Details -->
                        <?php }?>
                    </div>
                    <div class="col-lg-6">
                    <?php if (!empty($awards)){?>
                    <!-- Awards Details -->
                        <div class="widget awards-widget">
                            <h4 class="widget-title">Awards</h4>
                            <div class="experience-box">
                                <ul class="experience-list">
                                    <?php foreach ($awards as $award) {
                                        echo '<li>
                                        <div class="experience-user">
                                            <div class="before-circle"></div>
                                        </div>
                                        <div class="experience-content">
                                            <div class="timeline-content">

                                                <h4 class="exp-title">' . $award['award'] . '</h4>
                                                <p>(' . $award['award_date'] . ')</p>
                                        </div>
                                    </li>';
                                    }?>

                                </ul>
                            </div>
                        </div>
                        <!-- /Awards Details -->
                        <?php }?>
                    </div>
                    <div class="col-lg-12">
                    <?php  if (!empty($_services)) {?>
                    <!-- Services List -->
                        <div class="service-list">
                            <h4>Services</h4>
                            <ul class="clearfix">
                                <?php
                                foreach ($_services as $_service) {
                                    echo '<li>' . $_service . '</li>';
                                }
                                ?>

                            </ul>
                        </div>
                        <!-- /Services List -->
                        <?php }?>
                    </div>

                </div>
            </div>
            <!-- /Overview Content -->

            <!-- Locations Content -->
            <div role="tabpanel" id="doc_locations" class="tab-pane fade">

                        <?php if (!empty($slots)) {
                            foreach ($slots as $slot) {
                                $clinic=$db->getClinicByID($slot['hospital_id']);
                                $day=\clinela\utils\Utils::getDayOfWeek($slot['week_day']);

                                echo ' <!-- Location List -->
                <div class="location-list">
                    <div class="row">

                        <!-- Clinic Content -->
                        <div class="col-md-6">
                            <div class="clinic-content">
                                <h4 class="clinic-name"><a href="#">'.$clinic['clinic'].'</a></h4>
                                <div class="clinic-details mb-0">
                                    <p class="clinic-direction"><i class="fas fa-map-marker-alt"></i> '.$clinic['address'].' <br><a href="javascript:void(0);">Get
                                            Directions</a></p>

                                </div>

                            </div>
                        </div>
                        <!-- /Clinic Content -->

                        <!-- Clinic Timing -->
                        <div class="col-md-4">
                            <div class="clinic-timing">
                                <div>
                                    <p class="timings-days">
                                        <span>'.$day.'</span>
                                    </p>
                                    <p class="timings-times">
                                        <span>'.date("h:i a",strtotime($slot['start_time'])).' - '.date("h:i a",strtotime($slot['end_time'])).'</span>

                                    </p>
                                </div>

                            </div>
                        </div>
                        <!-- /Clinic Timing -->

                        <div class="col-md-2">
                            <div class="clinic-booking">
                                <a href="'.BASE_PATH.'booking/'.$doctor['user_id'].'/?slot='.$slot['id'].'" class="apt-btn">Book</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Location List -->';

                            }
                        }?>

            </div>
            <!-- /Locations Content -->

            <!-- Reviews Content -->
            <div role="tabpanel" id="doc_reviews" class="tab-pane fade">

                <!-- Review Listing -->
                <div class="widget review-listing">
                    <ul class="comments-list">

                    <?php
                    if (!empty($reviews)) {
                        foreach ($reviews as $review) {
                            $author = $db->getUserByID($review['user_id']);
                            $author_meta=$db->getUserMeta($author['id']);
                            $author_img = !empty($author_meta['photo']) ? CONTENT_PATH . 'uploads/' . $author_meta['photo'] : CONTENT_PATH . 'public/img/patients/patient1.jpg';
                            echo '
                                <!-- Comment List -->
                        <li>
                            <div class="comment">
                                <img class="avatar avatar-sm rounded-circle" alt="User Image"
                                     src="'.$author_img.'">
                                <div class="comment-body">
                                    <div class="meta-data">
                                        <span class="comment-author">' . $author['username'] . '</span>
                                        <span class="comment-date">Reviewed ' . $review['created_at'] . '</span>
                                        <div class="review-count rating">
                                            <i class="fas fa-star ' . $db->is_filled(1, $review['rating']) . '"></i>
                                            <i class="fas fa-star ' . $db->is_filled(2, $review['rating']) . '"></i>
                                            <i class="fas fa-star ' . $db->is_filled(3, $review['rating']) . '"></i>
                                            <i class="fas fa-star ' . $db->is_filled(4, $review['rating']) . '"></i>
                                            <i class="fas fa-star ' . $db->is_filled(5, $review['rating']) . '"></i>
                                        </div>
                                    </div>
                                    <p class="comment-content">
                                        ' . $review['review'] . '
                                    </p>

                                </div>
                            </div>
                        </li>
                        <!-- /Comment List -->
                                ';
                        }
                    }?>

                    </ul>


                </div>
                <!-- /Review Listing -->

                <!-- Write Review -->
                <div class="write-review">
                    <h4>Write a review for <strong>Dr. <?php echo $names?></strong></h4>

                <?php if(isset($_SESSION['id'])){?>
                <!-- Write Review Form -->
                    <form method="post">
                        <div class="form-group">
                            <label>Review</label>
                            <div class="star-rating">
                                <input id="star-5" type="radio" name="rating" value="star-5">
                                <label for="star-5" title="5 stars">
                                    <i class="active fa fa-star"></i>
                                </label>
                                <input id="star-4" type="radio" name="rating" value="star-4">
                                <label for="star-4" title="4 stars">
                                    <i class="active fa fa-star"></i>
                                </label>
                                <input id="star-3" type="radio" name="rating" value="star-3">
                                <label for="star-3" title="3 stars">
                                    <i class="active fa fa-star"></i>
                                </label>
                                <input id="star-2" type="radio" name="rating" value="star-2">
                                <label for="star-2" title="2 stars">
                                    <i class="active fa fa-star"></i>
                                </label>
                                <input id="star-1" type="radio" name="rating" value="star-1">
                                <label for="star-1" title="1 star">
                                    <i class="active fa fa-star"></i>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Title of your review</label>
                            <input class="form-control" type="text" name="title"
                                   placeholder="If you could say it in one sentence, what would you say?">
                        </div>
                        <div class="form-group">
                            <label>Your review</label>
                            <textarea id="review_desc" maxlength="100" name="review" class="form-control"></textarea>

                            <div class="d-flex justify-content-between mt-3"><small class="text-muted"><span id="chars">100</span>
                                    characters remaining</small></div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="terms-accept">
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="terms_accept">
                                    <label for="terms_accept">I have read and accept <a href="#">Terms &amp;
                                            Conditions</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Add Review</button>
                        </div>
                    </form>
                    <!-- /Write Review Form -->
                    <?php }else {
                        echo '<a href="' . BASE_PATH . 'login/?return=doctors/'.$doctor['id'].'"class="btn btn-primary submit-btn">Login to add a review</a>';
                    }?>
                </div>
                <!-- /Write Review -->

            </div>
            <!-- /Reviews Content -->

            <!-- Business Hours Content -->
            <div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-8 offset-md-4">

                        <!-- Business Hours Widget -->
                        <div class="widget business-widget">
                            <div class="widget-content">
                                <div class="listing-hours">
                                    <div class="listing-day current">
                                        <div class="day">Monday</div>
                                        <div class="doc-times">
                                            <?php if (!empty($slotsMonday)) {
                                                foreach ($slotsMonday as $slot) {
                                                    echo '<div class=" doc-slot-list">'.date("h:i A",strtotime($slot['start_time'])).' - '.date("h:i A",strtotime($slot['end_time'])).'</div>';
                                                }
                                            }else{
                                                echo ' <span class="time"><span class="badge bg-danger-light">Closed</span></span>';
                                            }?>
                                        </div>
                                    </div>
                                    <div class="listing-day current">
                                        <div class="day">Tuesday</div>
                                        <div class="doc-times">
                                            <?php if (!empty($slotsTuesday)) {
                                                foreach ($slotsTuesday as $slot) {
                                                    echo '<div class="time doc-slot-list">'.date("h:i A",strtotime($slot['start_time'])).' - '.date("h:i A",strtotime($slot['end_time'])).'</div>';
                                                }
                                            }else{
                                                echo ' <span class="time"><span class="badge bg-danger-light">Closed</span></span>';
                                            }?>
                                        </div>
                                    </div>
                                    <div class="listing-day current">
                                        <div class="day">Wednesday</div>
                                        <div class="doc-times">
                                            <?php if (!empty($slotsWednesday)) {
                                                foreach ($slotsWednesday as $slot) {
                                                    echo '<div class="time doc-slot-list">'.date("h:i A",strtotime($slot['start_time'])).' - '.date("h:i A",strtotime($slot['end_time'])).'</div>';
                                                }
                                            }else{
                                                echo ' <span class="time"><span class="badge bg-danger-light">Closed</span></span>';
                                            }?>
                                        </div>
                                    </div>
                                    <div class="listing-day current">
                                        <div class="day">Thursday</div>
                                        <div class="doc-times">
                                            <?php if (!empty($slotsThursday)) {
                                                foreach ($slotsThursday as $slot) {
                                                    echo '<div class="time doc-slot-list">'.date("h:i A",strtotime($slot['start_time'])).' - '.date("h:i A",strtotime($slot['end_time'])).'</div>';
                                                }
                                            }else{
                                                echo ' <span class="time"><span class="badge bg-danger-light">Closed</span></span>';
                                            }?>
                                        </div>
                                    </div>
                                    <div class="listing-day current">
                                        <div class="day">Friday</div>
                                        <div class="doc-times">
                                            <?php if (!empty($slotsFriday)) {
                                                foreach ($slotsFriday as $slot) {
                                                    echo '<div class="time doc-slot-list">'.date("h:i A",strtotime($slot['start_time'])).' - '.date("h:i A",strtotime($slot['end_time'])).'</div>';
                                                }
                                            }else{
                                                echo ' <span class="time"><span class="badge bg-danger-light">Closed</span></span>';
                                            }?>
                                        </div>
                                    </div>
                                    <div class="listing-day current">
                                        <div class="day">Saturday</div>
                                        <div class="doc-times">
                                            <?php if (!empty($slotsSaturday)) {
                                                foreach ($slotsSaturday as $slot) {
                                                    echo '<div class="time doc-slot-list">'.date("h:i A",strtotime($slot['start_time'])).' - '.date("h:i A",strtotime($slot['end_time'])).'</div>';
                                                }
                                            }else{
                                                echo ' <span class="time"><span class="badge bg-danger-light">Closed</span></span>';
                                            }?>
                                        </div>
                                    </div>
                                    <div class="listing-day closed">
                                        <div class="day">Sunday</div>
                                        <div class="doc-times">
                                            <?php if (!empty($slotsSunday)) {
                                                foreach ($slotsSunday as $slot) {
                                                    echo '<div class="time doc-slot-list">'.date("h:i A",strtotime($slot['start_time'])).' - '.date("h:i A",strtotime($slot['end_time'])).'</div>';
                                                }
                                            }else{
                                                echo ' <span class="time"><span class="badge bg-danger-light">Closed</span></span>';
                                            }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Business Hours Widget -->

                    </div>
                </div>
            </div>
            <!-- /Business Hours Content -->

        </div>
    </div>
</div>
</div>
<script>
    function reqListener () {
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
        oReq.open("GET", "<?php echo BASE_PATH?>request/"+id+"/?op=add");
        oReq.send();
    }

</script>