<?php
$db=new \clinela\database\DB();
$page_no                = isset( $_GET['p'] ) ? $_GET['p'] : 1;
$limit               = isset( $_GET['l'] ) ? intval(filter_input(INPUT_GET,'l',FILTER_SANITIZE_NUMBER_INT)) : 10;
$sort              = isset( $_GET['sort'] ) ? filter_input(INPUT_GET,'sort',FILTER_SANITIZE_STRIPPED) : '';
$search              = isset( $_GET['s'] ) ?filter_input(INPUT_GET,'s',FILTER_SANITIZE_STRIPPED)  : '';
$location              = isset( $_GET['location'] ) ?filter_input(INPUT_GET,'location',FILTER_SANITIZE_STRIPPED)  : '';
$no_of_records_per_page = 10;
$total_rows             = $db->getClinicsCount($sort,$search,$location  );
$offset                 = ( $page_no - 1 ) * $no_of_records_per_page;
$total_pages            = ceil( $total_rows / $no_of_records_per_page );
$clinics=$db->getPagedClinics($limit,$offset,$search,$location);
?>

<div class="row" >
    <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">

        <!-- Search Filter -->

        <!-- /Search Filter -->

        <div class="theiaStickySidebar">
            <form>
            <div class="card search-filter">
                <div class="card-header">
                    <h4 class="card-title mb-0">Search Filter</h4>
                </div>
                <div class="card-body">
                    <div class="filter-widget">
                        <label>Location</label>
                        <input type="text" class="form-control" placeholder="Select Location" name="location">
                    </div>
                    <div class="filter-widget">
                        <label>Clinic Name</label>
                        <input type="text" class="form-control" placeholder="Select name" name="s">
                    </div>


                    <div class="btn-search">
                        <button type="submit" class="btn btn-block">Search</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    <div class="col-md-12 col-lg-8 col-xl-9">

        <?php if (isset($clinics)) {
            foreach ($clinics as $clinic) {
                $tel=!empty($clinic['phone'])?'<a class="apt-btn" href="tel:'.$clinic['phone'].'">Call Now</a>':'';
                $img = !empty($clinic['clinic_image']) ? CONTENT_PATH . 'uploads/' . $clinic['clinic_image'] : CONTENT_PATH . 'public/img/blog/blog-01.jpg';
                echo ' <!-- Doctor Widget -->
            <div class="card">
                <div class="card-body">
                    <div class="doctor-widget">
                        <div class="doc-info-left">
                            <div class="doctor-img">
                                <a href="'.BASE_PATH.'clinics/">
                                    <img src="'.$img.'" class="img img-fluid" alt="User Image">
                                </a>
                            </div>
                            <div class="doc-info-cont">
                                <h4 class="doc-name mb-2"><a href="'.BASE_PATH.'clinics/">'.$clinic['clinic'].'</a></h4>
                                <div class="rating mb-2">
                                    <span class="badge badge-primary">4.0</span>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star"></i>
                                    <span class="d-inline-block average-rating">(17)</span>
                                </div>
                                <div class="clinic-details">
                                    <div class="clini-infos pt-3">

                                        <p class="doc-location mb-2"><i class="fas fa-phone-volume mr-1"></i> '.$clinic['phone'].'</p>
                                        <p class="doc-location mb-2 text-ellipse"><i class="fas fa-map-marker-alt mr-1"></i> '.$clinic['address'].' </p>
                                        <p class="doc-location mb-2"><i class="fas fa-chevron-right mr-1"></i> '.$clinic['details'].'</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="doc-info-right">
                            <div class="clinic-booking">
                                '.$tel.'
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Doctor Widget -->';
            }
        }?>



        <?php if($total_pages>1){?>
        <div class="load-more text-center">
            <div>
                <ul class="pagination">
                    <li class="page-item <?php echo $page_no == $total_pages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?p=1&l=<?php echo $limit.'&sort='.$sort?>" tabindex="-1">Previous</a>
                    </li>

                    <?php for ( $i = $page_no - 4; $i < $page_no; $i ++ ) {
                        if($i>0){
                            echo '<li class="page-item"><a class="page-link" href="?p=' . $i . '&l='.$limit.'&sort='.$sort.'">' . $i . '</a></li>';
                        }

                    }

                    echo '<li class="page-item active" aria-current="page"><a class="page-link" href="?p=' . $page_no . '&l='.$limit.'&sort='.$sort.'">' . $page_no . '</a></li>';

                    for ( $j = $page_no+1; $j < $page_no+4; $j ++ ) {
                        if($j<=$total_pages){
                            echo '<li class="page-item"><a class="page-link" href="?p=' . $j . '&l='.$limit.'&sort='.$sort.'">' . $j . '</a></li>';
                        }

                    }?>

                    <li class="page-item <?php echo $page_no == $total_pages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?p=<?php echo $total_pages.'&l='.$limit.'&sort='.$sort ?>">Next</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php }?>
    </div>
</div>
