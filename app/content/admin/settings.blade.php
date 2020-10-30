<?php
$db = new \clinela\database\DB();
?>
<div class="row">

    <div class="col-12">

        <!-- General -->
        <form method="post" enctype="multipart/form-data">
            <input name="type" value="site_info" hidden>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">General</h4>
            </div>
            <div class="card-body">


                    <div class="form-group">
                        <label>Website Name</label>
                        <input type="text" class="form-control" value="<?php echo $db->getOptions('site_name')?>" name="site_name" >
                    </div>
                    <div class="form-group">
                        <label>Admin Email</label>
                        <input type="email" class="form-control" value="<?php echo $db->getOptions('site_email')?>" name="site_email">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" value="<?php echo $db->getOptions('site_support_phone')?>" name="site_support_phone">
                    </div>

                <div class="form-group">
                    <label>Support Email</label>
                    <input type="email" class="form-control" value="<?php echo $db->getOptions('site_support_email')?>" name="site_support_email">
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Booking Fee</label>
                            <input type="number" class="form-control" value="<?php echo $db->getOptions('booking_fee')?>" name="booking_fee">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Tax</label>
                            <input type="number" class="form-control" value="<?php echo $db->getOptions('tax')?>" name="tax">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>FlutterWave Public key</label>
                            <input type="text" class="form-control" value="<?php echo $db->getOptions('flutterwave_public_key')?>" name="flutterwave_public_key">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>FlutterWave Secret key</label>
                            <input type="text" class="form-control" value="<?php echo $db->getOptions('flutterwave_secret_key')?>" name="flutterwave_secret_key">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>FlutterWave Encryption key</label>
                            <input type="text" class="form-control" value="<?php echo $db->getOptions('flutterwave_encryption_key')?>" name="flutterwave_encryption_key">
                        </div>
                    </div>
                </div>


                    <div class="form-group">
                        <div class="row">
                            <div class="col-8">
                                <label>Website Logo</label>
                                <input type="file" class="form-control" name="header_logo">
                                <small class="text-secondary">Recommended image size is <b>200px x 50px</b></small>
                            </div>
                            <div class="col-2">
                                <img src="<?php echo !empty($db->getOptions('header_logo'))?CONTENT_PATH.'uploads/'.$db->getOptions('header_logo'):CONTENT_PATH."public/img/clinela-logo-red.jpg" ?>" height="80px">
                            </div>
                        </div>

                    </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Header Background</label>
                            <input type="color" class="form-control row" name="header_color" value="<?php echo $db->getOptions('header_color')?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Page Color</label>
                            <input type="color" class="form-control row" name="page_color" value="<?php echo $db->getOptions('page_color')?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>User Menu Background</label>
                            <input type="color" class="form-control row" name="sidebar_color" value="<?php echo $db->getOptions('sidebar_color')?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Admin Menu Color</label>
                            <input type="color" class="form-control row" name="admin_sidebar_color" value="<?php echo $db->getOptions('admin_sidebar_color')?>">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Blog section Color</label>
                            <input type="color" class="form-control row" name="section_5_color" value="<?php echo $db->getOptions('section_5_color')?>">
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <!-- /General -->

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Footer</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-8">
                            <label>Footer Logo</label>
                            <input type="file" class="form-control" name="footer_logo">
                            <small class="text-secondary">Recommended image size is <b>200px x 50px</b></small>
                        </div>
                        <div class="col-2">
                            <img height="80px"
                                 src="<?php echo !empty($db->getOptions('footer_logo'))?CONTENT_PATH.'uploads/'.$db->getOptions('footer_logo'):CONTENT_PATH."public/img/clinela-logo-red.jpg" ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Footer Address</label>
                    <input type="text" class="form-control" value="<?php echo $db->getOptions('site_support_address')?>" name="site_support_address">
                </div>
                <div class="form-group">
                    <label>Footer copyright</label>
                    <input type="text" class="form-control" value="<?php echo $db->getOptions('site_copyright')?>" name="site_copyright">
                </div>
                <div class="form-group">
                    <label>Footer Text</label>
                    <input type="text" class="form-control" value="<?php echo $db->getOptions('footer_text')?>" name="footer_text">
                </div>
                <div class="form-group">
                    <label>Footer Background</label>
                    <input type="color" class="form-control row" name="footer_color" value="<?php echo $db->getOptions('footer_color')?>">
                </div>
            </div>
        </div>
        <div class="row">

            <!-- Section 1-->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">HomePage Search</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Section Title</label>
                            <input type="text" class="form-control" value="<?php echo $db->getOptions('section_1_title')?>" name="section_1_title">
                        </div>
                        <div class="form-group">
                            <label>Section Subtitle</label>
                            <input type="text" class="form-control" value="<?php echo $db->getOptions('section_1_subtitle')?>" name="section_1_subtitle">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label>Background image</label>
                                    <input type="file" class="form-control" name="section_1_banner">
                                </div>
                                <div class="col-6"><img width="200px" 
                                                        src="<?php echo !empty($db->getOptions('section_1_banner'))?CONTENT_PATH.'uploads/'.$db->getOptions('section_1_banner'):CONTENT_PATH."public/img/search-bg.png" ?>"></div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label>Section Background</label>
                            <input type="color" class="form-control row" name="section_1_color" value="<?php echo $db->getOptions('section_1_color')?>">
                        </div>
                        <div class="form-group">
                            <label>Show this section</label>
                            <input type="checkbox" class="form-control" name="section_1_show" <?php if($db->getOptions('section_1_show')){echo 'checked';}?>>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Section 1-->

            <!-- Section 2-->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Specialities section</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Section Title</label>
                            <input type="text" class="form-control" value="<?php echo $db->getOptions('section_2_title')?>" name="section_2_title">
                        </div>
                        <div class="form-group">
                            <label>Section Subtitle</label>
                            <input type="text" class="form-control" value="<?php echo $db->getOptions('section_2_subtitle')?>" name="section_2_subtitle">
                        </div>
                        <div class="form-group">
                            <label>Number of items to display</label>
                            <input type="number" class="form-control" value="<?php echo $db->getOptions('section_2_count')?>" name="section_2_count">
                        </div>
                        <div class="form-group">
                            <label>Section Background</label>
                            <input type="color" class="form-control row" name="section_2_color" value="<?php echo $db->getOptions('section_2_color')?>">
                        </div>
                        <div class="form-group">
                            <label>Show this section</label>
                            <input type="checkbox" class="form-control row" name="section_2_show"  <?php if($db->getOptions('section_2_show')){echo 'checked';}?>>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Section 2-->

            <!-- Section 3-->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Book our doctor</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Section Title</label>
                            <input type="text" class="form-control" value="<?php echo $db->getOptions('section_3_title')?>" name="section_3_title">
                        </div>
                        <div class="form-group">
                            <label>Section Subtitle</label>
                            <input type="text" class="form-control" value="<?php echo $db->getOptions('section_3_subtitle')?>" name="section_3_subtitle">
                        </div>
                        <div class="form-group">
                            <label>Section Content</label>
                            <textarea class="form-control" name="section_3_content" rows="2"><?php echo $db->getOptions('section_3_content')?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Number of items to display</label>
                            <input type="number" class="form-control" value="<?php echo $db->getOptions('section_3_count')?>" name="section_3_count">
                        </div>
                        <div class="form-group">
                            <label>Section Background</label>
                            <input type="color" class="form-control row" name="section_3_color" value="<?php echo $db->getOptions('section_3_color')?>">
                        </div>
                        <div class="form-group">
                            <label>Show this section</label>
                            <input type="checkbox" class="form-control row" name="section_3_show"  <?php if($db->getOptions('section_3_show')){echo 'checked';}?>>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Section 3-->

            <!-- Section 4-->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Features Section</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Section Title</label>
                            <input type="text" class="form-control" value="<?php echo $db->getOptions('section_4_title')?>" name="section_4_title">
                        </div>
                        <div class="form-group">
                            <label>Section Subtitle</label>
                            <input type="text" class="form-control" value="<?php echo $db->getOptions('section_4_subtitle')?>" name="section_4_subtitle">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-8"> <label>Banner image</label>
                                    <input type="file" class="form-control" name="section_4_banner">
                                    <small class="text-secondary">Recommended image size is <b>420px x 375px</b></small></div>
                                <div class="col-2"><img height="80px"
                                            src="<?php echo !empty($db->getOptions('section_4_banner'))?CONTENT_PATH.'uploads/'.$db->getOptions('section_4_banner'):CONTENT_PATH."public/img/feature.png" ?>"></div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label>Number of items to display</label>
                            <input type="number" class="form-control" value="<?php echo $db->getOptions('section_4_count')?>" name="section_4_count">
                        </div>
                        <div class="form-group">
                            <label>Section Background</label>
                            <input type="color" class="form-control row" name="section_4_color" value="<?php echo $db->getOptions('section_4_color')?>">
                        </div>
                        <div class="form-group">
                            <label>Show this section</label>
                            <input type="checkbox" class="form-control row" name="section_4_show"  <?php if($db->getOptions('section_4_show')){echo 'checked';}?>>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Section 4-->

        </div>
        <!--Social Links section-->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Social Links</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Facebook</label>
                    <input type="text" class="form-control" value="<?php echo $db->getOptions('social_facebook')?>" name="social_facebook">
                </div>
                <div class="form-group">
                    <label>Twitter</label>
                    <input type="text" class="form-control" value="<?php echo $db->getOptions('social_twitter')?>" name="social_twitter">
                </div>
                <div class="form-group">
                    <label>Linkedin</label>
                    <input type="text" class="form-control" value="<?php echo $db->getOptions('social_linkedin')?>" name="social_linkedin">
                </div>
                <div class="form-group">
                    <label>Instagram</label>
                    <input type="text" class="form-control" value="<?php echo $db->getOptions('social_instagram')?>" name="social_instagram">
                </div>
                <div class="form-group">
                    <label>Telegram</label>
                    <input type="text" class="form-control" value="<?php echo $db->getOptions('social_telegram')?>" name="social_telegram">
                </div>
                <div class="form-group">
                    <label>Whatsapp</label>
                    <input type="text" class="form-control" value="<?php echo $db->getOptions('social_whatsapp')?>" name="social_whatsapp">
                </div>
                <div class="form-group">
                    <label>SMS API email</label>
                    <input type="text" class="form-control" value="<?php echo $db->getOptions('sms_api_email')?>" name="sms_api_email">
                </div>
                <div class="form-group">
                    <label>SMS API password</label>
                    <input type="password" class="form-control" value="<?php echo $db->getOptions('sms_api_password')?>" name="sms_api_password">
                </div>
            </div>
        </div>
        <!--Social Links section-->

            <!--Header-Footer Codes-->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Header and Footer Codes</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Header code</label>
                        <textarea type="text" class="form-control"  name="site_header_code" rows="5"><?php echo $db->getOptions('site_header_code')?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Above Footer code</label>

                        <textarea type="text" class="form-control"   name="site_above_footer_code" rows="5"><?php echo $db->getOptions('site_above_footer_code')?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Footer code</label>
                        <textarea type="text" class="form-control"  name="site_footer_code" rows="5"><?php echo $db->getOptions('site_footer_code')?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Terms & Conditions</label>
                        <textarea type="text" class="form-control summernote"  name="terms" rows="5"><?php echo $db->getOptions('terms')?></textarea>
                    </div>
                </div>
            </div>
            <!--Header-Footer Codes-->
            <button type="submit" class="btn btn-primary btn-lg">Save changes</button>
        </form>
    </div>
</div>
<script>
    $('.summernote').summernote();
</script>