<?php
$logo=!empty($db->getOptions('footer_logo'))?CONTENT_PATH.'uploads/'.$db->getOptions('footer_logo'):CONTENT_PATH.'public/img/clinela-logo-red.jpg';
$footer_color=!empty($db->getOptions('footer_color'))?'style="background-color:'.$db->getOptions('footer_color').';"':'';
?>
<footer class="footer d-print-none" <?php echo $footer_color?>

    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6">

                    <!-- Footer Widget -->
                    <div class="footer-widget footer-about">
                        <div class="footer-logo">
                            <img src="<?php echo $logo ?>" alt="logo">
                        </div>
                        <div class="footer-about-content">
                            <p><?php echo $db->getOptions('footer_text')?></p>
                            <div class="social-icon">
                                <ul>
                                    <li>
                                        <a href="<?php echo $db->getOptions('social_facebook')?>" target="_blank"><i class="fab fa-facebook-f"></i> </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $db->getOptions('social_twitter')?>" target="_blank"><i class="fab fa-twitter"></i> </a>
                                    </li>
                                    <li>
                                        <a href="https://api.whatsapp.com/send?phone=<?php echo $db->getOptions('social_whatsapp')?>&text=I%20want%20to%20book%20an%20appointment%20from%20ClinelaDoctors" target="_blank"><i class="fab fa-whatsapp"></i> </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $db->getOptions('social_instagram')?>" target="_blank"><i class="fab fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $db->getOptions('social_linkedin')?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                    </li>

                                    <li>
                                        <a href="<?php echo $db->getOptions('social_telegram')?>" target="_blank"><i class="fab fa-telegram"></i> </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Footer Widget -->

                </div>

                <div class="col-lg-3 col-md-6">

                    <!-- Footer Widget -->
                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">For Patients</h2>
                        <ul>
                            <li><a href="<?php echo BASE_PATH?>doctors/">Search for Doctors</a></li>
                            <li><a href="<?php echo BASE_PATH?>login/">Login</a></li>
                            <li><a href="<?php echo BASE_PATH?>patient/dashboard/">Patient Dashboard</a></li>
                        </ul>
                    </div>
                    <!-- /Footer Widget -->

                </div>

                <div class="col-lg-3 col-md-6">

                    <!-- Footer Widget -->
                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">For Doctors</h2>
                        <ul>
                            <li><a href="<?php echo BASE_PATH?>doctor/appointments/">Appointments</a></li>
                            <li><a href="<?php echo BASE_PATH?>login/">Login</a></li>
                            <li><a href="<?php echo BASE_PATH?>doctor/dashboard/">Doctor Dashboard</a></li>
                        </ul>
                    </div>
                    <!-- /Footer Widget -->

                </div>

                <div class="col-lg-3 col-md-6">

                    <!-- Footer Widget -->
                    <div class="footer-widget footer-contact">
                        <h2 class="footer-title">Contact Us</h2>
                        <div class="footer-contact-info">
                            <div class="footer-address">
                                <span><i class="fas fa-map-marker-alt"></i></span>
                                <p> <?php echo $db->getOptions('site_support_address')?> </p>
                            </div>
                            <p>
                                <i class="fas fa-phone-alt"></i>
                                <?php echo $db->getOptions('site_support_phone')?>
                            </p>
                            <p class="mb-0">
                                <i class="fas fa-envelope"></i>
                                <?php echo $db->getOptions('site_support_email')?>
                            </p>
                        </div>
                    </div>
                    <!-- /Footer Widget -->

                </div>

            </div>
        </div>
    </div>
    <!-- /Footer Top -->

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container-fluid">

            <!-- Copyright -->
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="copyright-text">
                            <p class="mb-0">© <?php echo date("Y").' '.$this->getCopyright()?></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">

                        <!-- Copyright Menu -->
                        <div class="copyright-menu">
                            <ul class="policy-menu">
                                <li><a href="#">Terms and Conditions</a></li>
                                <li><a href="#">Policy</a></li>
                            </ul>
                        </div>
                        <!-- /Copyright Menu -->

                    </div>
                </div>
            </div>
            <!-- /Copyright -->

        </div>
    </div>
    <!-- /Footer Bottom -->

</footer>
