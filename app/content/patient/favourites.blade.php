<?php
$db = new \clinela\database\DB();
$id = $_SESSION['id'];
$favourites = $db->getFavourites($id);
$user = $db->getUserByID($id);
$meta = $db->getUserMeta($id);
$utils = new \clinela\utils\Utils();
$blood_group = $utils->get_blood_group();
$first_name = !empty($meta['first_name']) ? $meta['first_name'] : 'My Name';
$dob = !empty($meta['dob']) ? $meta['dob'] : '01/01/2020';
$img = !empty($meta['photo']) ? 'uploads/' . $meta['photo'] : 'public/img/patients/patient.jpg';

?>
<div class="row">
    <!-- Profile Sidebar -->
    <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
        <div class="profile-sidebar">
            <div class="widget-profile pro-widget-content">
                <div class="profile-info-widget">
                    <a href="#" class="booking-doc-img">
                        <img src="<?php echo CONTENT_PATH . $img?>" alt="User Image">
                    </a>
                    <div class="profile-det-info">
                        <h3><?php echo $first_name . ' ' . $meta['last_name']?></h3>
                        <div class="patient-details">
                            <h5><i class="fas fa-birthday-cake"></i> <?php echo $dob?></h5>
                            <h5 class="mb-0"><i
                                        class="fas fa-map-marker-alt"></i> <?php echo $meta['city'] . ', ' . $meta['country']?>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-widget">
                <nav class="dashboard-menu">
                    <ul>
                        <li>
                            <a href="<?php echo BASE_PATH?>patient/dashboard/">
                                <i class="fas fa-columns"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo BASE_PATH?>patient/favourites/">
                                <i class="fas fa-bookmark"></i>
                                <span>Favourites</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH.'chat/'.$id.'/'?>">
                                <i class="fas fa-comments"></i>
                                <span>Message</span>
                                <small class="unread-msg">23</small>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>patient/profile/">
                                <i class="fas fa-user-cog"></i>
                                <span>Profile Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>patient/change-password/">
                                <i class="fas fa-lock"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>logout/">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
    <!-- /Profile Sidebar -->
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="row row-grid">
            <?php if(!empty($favourites)){
                foreach ($favourites as $favourite) {
                    $doctor = $db->getUserMeta($favourite['doctor_id']);
                    $names = empty($doctor['first_name']) && empty($doctor['last_name']) ? 'No Name' : $doctor['first_name'] . ' ' . $doctor['last_name'];
                    $fav_img = !empty($doctor['photo']) ? CONTENT_PATH . 'uploads/' . $doctor['photo'] : CONTENT_PATH . 'public/img/doctors/doctor-01.jpg';
                    $city = !empty($doctor['city']) ? $doctor['city'] . ', ' : '';
                    $state = !empty($doctor['state']) ? $doctor['state'] . ', ' : '';
                    $country = !empty($doctor['country']) ? $doctor['country'] : '';
                    $services = $db->getServices($doctor['user_id']);

                    echo '<!-- Doctor Widget -->
                    <div class="col-md-6 col-lg-4 col-xl-3">
									<div class="profile-widget">
										<div class="doc-img">
											<a href="' . BASE_PATH . 'doctors/' . $doctor['id'] . '/">
												<img class="img-fluid" alt="User Image" src="' . $fav_img . '">
											</a>
											<a href="javascript:setFavourite(' . $favourite['id'] . ')" class="fav-btn">
												<i class="far fa-bookmark"></i>
											</a>
										</div>
										<div class="pro-content">
											<h3 class="title">
												<a href="' . BASE_PATH . 'doctors/' . $doctor['id'] . '/">Dr. ' . $names . '</a>
												<i class="fas fa-check-circle verified"></i>
											</h3>
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
													<i class="fas fa-map-marker-alt"></i> ' . $city . $country . '
												</li>


											</ul>
											<div class="row row-sm">
												<div class="col-6">
													<a href="' . BASE_PATH . 'doctors/' . $doctor['id'] . '/" class="btn view-btn">View Profile</a>
												</div>
												<div class="col-6">
													<a href="' . BASE_PATH . 'booking/' . $doctor['id'] . '/" class="btn book-btn">Book Now</a>
												</div>
											</div>
										</div>
									</div>
								</div>

                    <!-- /Doctor Widget -->';
                }
            }else{?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p class="text-center">Your favourites appear here</p>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>

<script>
    function reqListener() {
        console.log(this.responseText);
        Swal.fire({
            title: "Success",
            text: this.responseText,
            icon: "success",
        });
        location.reload();
    }

    function setFavourite(id) {
        var oReq = new XMLHttpRequest();
        oReq.addEventListener("load", reqListener);
        oReq.open("GET", "<?php echo BASE_PATH?>request/" + id + "/?op=del");
        oReq.send();
    }

</script>
