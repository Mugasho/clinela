<?php
$id = $_SESSION['id'];
$db = new \clinela\database\DB();
$user = $db->getUserByID($id);
$meta = $db->getUserMeta($id);
$utils = new \clinela\utils\Utils();
$blood_group = $utils->get_blood_group();
$first_name = !empty($meta['first_name']) ? $meta['first_name'] : 'My Name';
$dob = !empty($meta['dob']) ? $meta['dob'] : '01/01/2020';
$img = !empty($meta['photo']) ? 'uploads/' . $meta['photo'] : 'public/img/patients/patient.jpg';
$educs = $db->getEducation($id);
$xp=$db->getExperience($id);
$awards=$db->getAwards($id);
$memberships=$db->getMembership($id);
$regs=$db->getRegistration($id);
$specialities=$db->getSpecialities();
$services=$db->getServices($id);
$profile_info = $db->getUserSpeciality($id);
$profile_speciality = !empty($profile_info) ? $profile_info['speciality'] : 'No Speciality';


?>
<div class="row">
    <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

        <!-- Profile Sidebar -->
        <div class="profile-sidebar">
            <div class="widget-profile pro-widget-content">
                <div class="profile-info-widget">
                    <a href="#" class="booking-doc-img">
                        <img src="<?php echo CONTENT_PATH . $img?>" alt="User Image">
                    </a>
                    <div class="profile-det-info">
                        <h3>Dr. <?php echo $first_name . ' ' . $meta['last_name']?></h3>

                        <div class="patient-details">
                            <h5 class="mb-0"><?php echo $profile_speciality?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-widget">
                <nav class="dashboard-menu">
                    <ul>
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/dashboard/">
                                <i class="fas fa-columns"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/appointments/">
                                <i class="fas fa-calendar-check"></i>
                                <span>Appointments</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/my-patients/">
                                <i class="fas fa-user-injured"></i>
                                <span>My Patients</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/schedule/">
                                <i class="fas fa-hourglass-start"></i>
                                <span>Schedule Timings</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/invoices/">
                                <i class="fas fa-file-invoice"></i>
                                <span>Invoices</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/reviews/">
                                <i class="fas fa-star"></i>
                                <span>Reviews</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH.'chat/'.$id.'/'?>">
                                <i class="fas fa-comments"></i>
                                <span>Message</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo BASE_PATH?>doctor/profile/">
                                <i class="fas fa-user-cog"></i>
                                <span>Profile Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/social-media/">
                                <i class="fas fa-share-alt"></i>
                                <span>Social Media</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_PATH?>doctor/change-password/">
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
        <!-- /Profile Sidebar -->

    </div>

    <div class="col-md-7 col-lg-8 col-xl-9">

        <!-- Basic Information -->
        <form method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic Information</h4>
                    <div class="row form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="change-avatar">
                                    <div class="profile-img">
                                        <img src="<?php echo CONTENT_PATH . $img?>" alt="User Image">
                                    </div>
                                    <div class="upload-img">
                                        <div class="change-photo-btn">
                                            <span><i class="fa fa-upload"></i> Upload Photo</span>
                                            <input type="file" class="upload" name="profile">
                                        </div>
                                        <small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of
                                            2MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="<?php echo $user['username']?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" value="<?php echo $user['email']?>" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" value="<?php echo $meta['first_name']?>"
                                       name="first_name">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" value="<?php echo $meta['last_name']?>"
                                       name="last_name">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" value="<?php echo $meta['phone']?>" class="form-control"
                                       name="phone">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker"
                                           value="<?php echo $meta['dob']?>" name="dob">
                                </div>
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
                                <label>Blood Group</label>
                                <select class="form-control select" name="blood">
                                    <?php

                                    foreach ($blood_group as $key => $value) {
                                        $selected = $meta['blood'] == $key ? ' selected' : '';
                                        echo '<option value="' . $value . '" ' . $selected . '>' . $key . '</option>';
                                    }?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Account No</label>
                                <input type="text" class="form-control" value="<?php echo $meta['account_no']?>"
                                       name="account_no">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Bank Name</label>
                                <input type="text" class="form-control" value="<?php echo $meta['bank_name']?>"
                                       name="bank_name">
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- /Basic Information -->

            <!-- Contact Details -->
            <div class="card contact-card">
                <div class="card-body">
                    <h4 class="card-title">Address Details</h4>
                    <div class="row form-row">

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" value="<?php echo $meta['address']?>"
                                       name="address">
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
                                <input type="text" class="form-control" value="<?php echo $meta['state']?>"
                                       name="state">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" class="form-control" value="<?php echo $meta['country']?>"
                                       name="country">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success float-right" type="submit">Save Changes</button>
                </div>
            </div>
        </form>
        <!-- /Contact Details -->

        <!-- Clinic Info
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Clinic Info</h4>
                <div class="row form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Clinic Name</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Clinic Address</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        Clinic Info -->

        <!-- Services and Specialization -->
        <form method="post">
        <div class="card services-card">
            <div class="card-body">
                <h4 class="card-title">Specialization</h4>
                <div class="form-group">
                    <label>Specialization </label>
                    <select class="form-control select" name="specialization">
                        <?php if (!empty($specialities)) {
                            foreach ($specialities as $speciality){
                                $selected=$speciality['id']==$profile_info['speciality_id']?'selected':'';
                                echo '<option value="'.$speciality['id'].'" '.$selected.'>'.$speciality['speciality'].'</option>';
                            }
                        }?>
                    </select>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Save Changes</button>
            </div>
        </div>
        </form>
        <!-- /Services and Specialization -->

        <!-- Services and Specialization -->
        <form method="post">
            <div class="card services-card">
                <div class="card-body">
                    <h4 class="card-title">Services</h4>
                    <div class="services-info">
                        <?php if (!empty($services)){
                            foreach ($services as $service){
                                echo '<div class="row form-row services-cont"><div class="col-12 col-md-5">
                                    <div class="form-group"><label>Service</label><input type="text" class="form-control" value="' . $service['services'] . '" id="services[' . $service['id'] . ']"></div></div><div class="col-12 col-md-5">
                                    <div class="form-group"><label>Amount</label><input type="text" class="form-control" value="' . $service['amount'] . '" id="amount[' . $service['id'] . ']"></div></div><div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                    <a href="?d=' . $service['id'] . '&sub=sv" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div></div>';
                            }
                        }?>
                        <div class="row form-row awards-cont">
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <label>Service</label>
                                    <input type="text" class="form-control" name="services[0][services]" id="services[0]">
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <label>amount</label>
                                    <input type="number" class="form-control" name="services[0][amount]" id="[amount][0]">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add-more">
                        <a href="javascript:void(0);" class="add-services"><i class="fa fa-plus-circle"></i> Add More</a>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Save Changes</button>
                </div>
            </div>
        </form>
        <!-- /Services and Specialization -->

        <!-- Education -->
        <form method="post">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Education</h4>
                    <div class="education-info">
                        <?php if (!empty($educs)) {
                            foreach ($educs as $educ) {
                                echo '<div class="row form-row education-cont">
                                    <div class="col-12 col-md-10 col-lg-11">
<div class="row form-row"><div class="col-12 col-md-6 col-lg-4">
<div class="form-group"><label>Degree</label><input type="text" class="form-control"  id="degree[' . $educ['id'] . ']" value="' . $educ['degree'] . '" disabled="disabled"></div>
</div><div class="col-12 col-md-6 col-lg-4">
<div class="form-group"><label>College/Institute</label><input type="text" class="form-control" " id="college[' . $educ['id'] . ']" value="' . $educ['college'] . '" disabled="disabled"></div>
</div><div class="col-12 col-md-6 col-lg-4"><div class="form-group"><label>Year of Completion</label><input type="text" class="form-control"  id="completion[' . $educ['id'] . ']" value="' . $educ['completion'] . '" disabled="disabled"></div></div></div></div><div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label>
<a href="?d=' . $educ['id'] . '&sub=ed" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>
</div>';
                            }
                        }?>
                        <div class="row form-row education-cont">
                            <div class="col-12 col-md-10 col-lg-11">
                                <div class="row form-row">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Degree</label>
                                            <input type="text" class="form-control" name="education[0][degree]"
                                                   id="degree[]">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>College/Institute</label>
                                            <input type="text" class="form-control" name="education[0][college]"
                                                   id="college[]">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Year of Completion</label>
                                            <input type="text" class="form-control" name="education[0][completion]"
                                                   id="completion[]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add-more">
                        <a href="javascript:void(0);" class="add-education"><i class="fa fa-plus-circle"></i> Add
                            More</a>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Save Changes</button>
                </div>

            </div>
        </form>
        <!-- /Education -->

        <!-- Experience -->
        <form method="post">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Experience</h4>
                <div class="experience-info">
                    <?php if (!empty($xp)){
                        foreach ($xp as $_xp){
                            echo '<div class="row form-row experience-cont">
                                  <div class="col-12 col-md-10 col-lg-11">
                                     <div class="row form-row">
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="form-group"><label>Hospital Name</label><input type="text" class="form-control" value="' . $_xp['hospital'] . '" id="hospital[' . $_xp['id'] . ']" disabled="disabled"></div></div>
                                        <div class="col-12 col-md-6 col-lg-2">
                                            <div class="form-group"><label>From</label><input type="text" class="form-control" value="' . $_xp['date_from'] . '" id="from[' . $_xp['id'] . ']" disabled="disabled"></div></div>
                                        <div class="col-12 col-md-6 col-lg-2">
                                            <div class="form-group"><label>To</label><input type="text" class="form-control" value="' . $_xp['date_to'] . '" id="to[' . $_xp['id'] . ']" disabled="disabled"></div></div>
                                        <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group"><label>Designation</label><input type="text" class="form-control" value="' . $_xp['designation'] . '" id="designation[' . $_xp['id'] . ']" disabled="disabled"></div></div></div></div><div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                    <a href="?d=' . $_xp['id'] . '&sub=xp" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div></div>';
                        }
                    }?>
                    <div class="row form-row experience-cont">
                        <div class="col-12 col-md-10 col-lg-11">
                            <div class="row form-row">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label>Hospital Name</label>
                                        <input type="text" class="form-control" name="experience[0][hospital]" id="hospital[0]">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label>From</label>
                                        <input type="text" class="form-control" name="experience[0][from]" id="from[0]">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label>To</label>
                                        <input type="text" class="form-control" name="experience[0][to]" id="to[0]">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <input type="text" class="form-control" name="experience[0][designation]" id="designation[0]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="add-more">
                    <a href="javascript:void(0);" class="add-experience"><i class="fa fa-plus-circle"></i> Add More</a>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Save Changes</button>
            </div>
        </div>
        </form>
        <!-- /Experience -->

        <!-- Awards -->
        <form method="post">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Awards</h4>
                <div class="awards-info">
                    <?php if (!empty($awards)){
                        foreach ($awards as $award){
                            echo '<div class="row form-row awards-cont"><div class="col-12 col-md-5">
                                    <div class="form-group"><label>Awards</label><input type="text" class="form-control" value="' . $award['award'] . '" id="awards[' . $award['id'] . ']" disabled="disabled"></div></div><div class="col-12 col-md-5">
                                    <div class="form-group"><label>Year</label><input type="text" class="form-control" value="' . $award['award_date'] . '" id="award_date[' . $award['id'] . ']" disabled="disabled"></div></div><div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                    <a href="?d=' . $award['id'] . '&sub=aw" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div></div>';
                        }
                    }?>
                    <div class="row form-row awards-cont">
                        <div class="col-12 col-md-5">
                            <div class="form-group">
                                <label>Awards</label>
                                <input type="text" class="form-control" name="awards[0][award]" id="award[0]">
                            </div>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="form-group">
                                <label>Year</label>
                                <input type="text" class="form-control" name="awards[0][award_date]" id="[award_date][0]">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="add-more">
                    <a href="javascript:void(0);" class="add-award"><i class="fa fa-plus-circle"></i> Add More</a>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Save Changes</button>
            </div>
        </div>
        </form>
        <!-- /Awards -->

        <!-- Memberships -->
        <form method="post">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Memberships</h4>
                <div class="membership-info">
                    <?php if (!empty($memberships)){
                        foreach ($memberships as $membership){
                            echo '<div class="row form-row membership-cont"><div class="col-12 col-md-10 col-lg-5">
                                    <div class="form-group"><label>Memberships</label><input type="text" class="form-control"  id="memberships[' . $membership['membership'] . ']" value="' . $membership['membership'] . '" disabled="disabled"></div></div><div class="col-12 col-md-2 col-lg-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                     <a href="?d=' . $membership['id'] . '&sub=mb" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div></div>';
                        }
                    }?>
                    <div class="row form-row membership-cont">
                        <div class="col-12 col-md-10 col-lg-5">
                            <div class="form-group">
                                <label>Memberships</label>
                                <input type="text" class="form-control" name="memberships[0][membership]" id="membership[0]">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="add-more">
                    <a href="javascript:void(0);" class="add-membership"><i class="fa fa-plus-circle"></i> Add More</a>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Save Changes</button>
            </div>
        </div>
        </form>
        <!-- /Memberships -->

        <!-- Registrations -->
        <form method="post">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Registrations</h4>
                <div class="registrations-info">
                    <?php if (!empty($regs)){
                        foreach ($regs as $reg){
                            echo '<div class="row form-row reg-cont"><div class="col-12 col-md-5">
                                    <div class="form-group"><label>Registrations</label><input type="text" class="form-control" id="registration['.$reg['id'].']" value="'.$reg['registration'].'" disabled="disabled"></div></div><div class="col-12 col-md-5">
                                    <div class="form-group"><label>Year</label><input type="text" class="form-control"  id="reg_date['.$reg['id'].']" value="'.$reg['reg_date'].'" disabled="disabled"></div></div><div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                    <a href="?d='.$reg['id'].'&sub=rg" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div></div>';
                        }
                    }?>
                    <div class="row form-row reg-cont">
                        <div class="col-12 col-md-5">
                            <div class="form-group">
                                <label>Registrations</label>
                                <input type="text" class="form-control" name="registrations[0][registration]" id="registration[0]">
                            </div>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="form-group">
                                <label>Year</label>
                                <input type="text" class="form-control" name="registrations[0][reg_date]" id="reg_date[0]">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="add-more">
                    <a href="javascript:void(0);" class="add-reg"><i class="fa fa-plus-circle"></i> Add More</a>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Save Changes</button>
            </div>
        </div>
        </form>
        <!-- /Registrations -->


    </div>
</div>
