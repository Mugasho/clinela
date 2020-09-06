<?php
        $id=$_SESSION['id'];
        $db=new \clinela\database\DB();
        $user=$db->getUserByID($id);
        $meta=$db->getUserMeta($id);
        $utils=new \clinela\utils\Utils();
        $blood_group=$utils->get_blood_group();
        $first_name=!empty($meta['first_name'])?$meta['first_name']:'My Name';
        $dob=!empty($meta['dob'])?$meta['dob']:'01/01/2020';
        $img=!empty($meta['photo'])?'uploads/'.$meta['photo']:'public/img/patients/patient.jpg';
?>

<div class="row">

    <!-- Profile Sidebar -->
    <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
        <div class="profile-sidebar">
            <div class="widget-profile pro-widget-content">
                <div class="profile-info-widget">
                    <a href="#" class="booking-doc-img">
                        <img src="<?php echo CONTENT_PATH.$img?>" alt="User Image">
                    </a>
                    <div class="profile-det-info">
                        <h3><?php echo $first_name.' '.$meta['last_name']?></h3>
                        <div class="patient-details">
                            <h5><i class="fas fa-birthday-cake"></i> <?php echo $dob?></h5>
                            <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i>  <?php echo $meta['city'].', '. $meta['country']?></h5>
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
                        <li>
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
                        <li class="active">
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
        <div class="card">
            <div class="card-body">

                <!-- Profile Settings Form -->
                <form method="post" enctype="multipart/form-data">
                    <div class="row form-row">
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <div class="change-avatar">
                                    <div class="profile-img">
                                        <img src="<?php echo CONTENT_PATH.$img?>" alt="User Image">
                                    </div>
                                    <div class="upload-img">
                                        <div class="change-photo-btn">
                                            <span><i class="fa fa-upload"></i> Upload Photo</span>
                                            <input type="file" class="upload" name="profile">
                                        </div>
                                        <small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" value="<?php echo $meta['first_name']?>" name="first_name">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" value="<?php echo $meta['last_name']?>" name="last_name">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker" value="<?php echo $meta['dob']?>" name="dob">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Blood Group</label>
                                <select class="form-control select" name="blood">
                                    <?php
                                    foreach($blood_group as $key=>$value){
                                        $selected=$meta['blood']==$key?' selected':'';
                                        echo '<option value="'.$value.'" '.$selected.'>'.$key.'</option>';
                                    }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" value="<?php echo $user['email']?>" name="email" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" value="<?php echo $meta['phone']?>" class="form-control" name="phone">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" value="<?php echo $meta['address']?>" name="address">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" class="form-control" value="<?php echo $meta['city']?>" name="city">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>State</label>
                                <input type="text" class="form-control" value="<?php echo $meta['state']?>" name="state">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control" name="gender">
                                    <?php
                                    foreach($utils->get_gender() as $key=>$value){
                                        $selected=$meta['gender']==$key?' selected="selected" ':'';
                                        echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" class="form-control" value="<?php echo $meta['country']?>" name="country">
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                    </div>
                </form>
                <!-- /Profile Settings Form -->

            </div>
        </div>
    </div>
</div>
				
