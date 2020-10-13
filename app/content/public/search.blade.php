<?php
$db = new \clinela\database\DB();
$specialities = $db->getSpecialities(6);
$get=array();
$query=mb_split("&",parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY));
if(!empty($query)) foreach ($query as $qr){
    $vars=mb_split('=',$qr);
    $get[$vars[0]]=$vars[1];
}

$location = isset($get['location']) ? filter_var($get['location'],FILTER_SANITIZE_STRIPPED):null;
$search = isset($get['s']) ? filter_var($get['s'],FILTER_SANITIZE_STRIPPED):null;
$doctors = $db->getApprovedUsers(1, null, $location,$search);
?>

<div class="row">
    <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">

        <!-- Search Filter -->
        <form>
        <div class="card search-filter">
            <div class="card-header">
                <h4 class="card-title mb-0">Search Filter</h4>
            </div>
            <div class="card-body">
                <div class="filter-widget">
                    <div class="cal-icon">
                        <input type="text" class="form-control" placeholder="search" name="s">
                    </div>
                </div>
                <div class="filter-widget">
                    <div class="cal-icon">
                        <input type="text" class="form-control" placeholder="location" name="location">
                    </div>
                </div>
                <div class="filter-widget">
                    <h4>Select Specialist</h4>

                    <?php foreach ($specialities as $speciality) {
                        echo '<div><label class="custom_check">
                            <input type="checkbox" checked>
                            <span class="checkmark"></span> ' . $speciality['speciality'] . '
                        </label></div>';
                    }?>

                </div>
                <div class="btn-search">
                    <button type="submit" class="btn btn-block">Search</button>
                </div>
            </div>
        </div>
        </form>
        <!-- /Search Filter -->

    </div>

    <div class="col-md-12 col-lg-8 col-xl-9">

        <?php if (!empty($doctors)) {
            foreach ($doctors as $doctor) {
                $names = empty($doctor['first_name']) && empty($doctor['last_name']) ? $doctor['username'] : $doctor['first_name'] . ' ' . $doctor['last_name'];
                $img = !empty($doctor['photo']) ? CONTENT_PATH . 'uploads/' . $doctor['photo'] : CONTENT_PATH . 'public/img/patients/patient1.jpg';
                $city = !empty($doctor['city']) ? $doctor['city'] . ', ' : '';
                $state = !empty($doctor['state']) ? $doctor['state'] . ', ' : '';
                $country = !empty($doctor['country']) ? $doctor['country'] : '';
                $services = $db->getServices($doctor['id']);
                $speciality = $db->getUserSpeciality($doctor['id']);
                $speciality_img = !empty($speciality['speciality_image']) ? CONTENT_PATH . 'uploads/' . $speciality['speciality_image'] : CONTENT_PATH . 'public/img/specialities/specialities-05.png';
                echo '<!-- Doctor Widget -->
        <div class="card">
            <div class="card-body">
                <div class="doctor-widget">
                    <div class="doc-info-left">
                        <div class="doctor-img">
                            <a href="' . BASE_PATH . 'doctors/' . $doctor['id'] . '/">
                                <img src="' . $img . '" class="img-fluid" alt="User Image">
                            </a>
                        </div>
                        <div class="doc-info-cont">
                            <h4 class="doc-name"><a href="' . BASE_PATH . 'doctors/' . $doctor['id'] . '/">Dr. ' . $names . '</a></h4>
                            <p class="doc-speciality">';
                if (!empty($services)) {
                    foreach ($services as $service) {
                        echo $service['services'] . ',';}
                }
                echo '</p>
                            <h5 class="doc-department"><img src="' . $speciality_img . '" class="img-fluid" alt="Speciality">' . $speciality['speciality'] . '</h5>
                            <div class="rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>


                            </div>
                            <div class="clinic-details">
                                <p class="doc-location"><i class="fas fa-map-marker-alt"></i> ' . $city . $state . $country . '</p>

                            </div>
                            <div class="clinic-services">';
                if (!empty($_services)) {
                    foreach ($_services as $_service) {
                        echo '<span>' . $_service . '</span>';
                    }
                }
                echo '
                            </div>
                        </div>
                    </div>
                    <div class="doc-info-right">
                        <div class="clini-infos">
                            <ul>
                                <li><i class="far fa-thumbs-up"></i> 98%</li>
                                <li><i class="far fa-comment"></i> 17 Feedback</li>
                                <li><i class="fas fa-map-marker-alt"></i> ' . $city . $country . '</li>
                          </ul>
                        </div>
                        <div class="clinic-booking">
                            <a class="view-pro-btn" href="' . BASE_PATH . 'doctors/' . $doctor['id'] . '/">View Profile</a>
                            <a class="apt-btn" href="' . BASE_PATH . 'booking/' . $doctor['id'] . '/">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Doctor Widget -->';
            }
        }?>


        <div class="load-more text-center">
            <a class="btn btn-primary btn-sm" href="javascript:void(0);">Load More</a>
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
    }

    function setFavourite(id) {
        var oReq = new XMLHttpRequest();
        oReq.addEventListener("load", reqListener);
        oReq.open("GET", "<?php echo BASE_PATH?>request/" + id + "/?op=add");
        oReq.send();
    }

</script>