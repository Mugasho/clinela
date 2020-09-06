<?php
$user = $this->getPageVars();
$img = !empty($user['photo']) ? CONTENT_PATH . 'uploads/' . $user['photo'] : CONTENT_PATH . 'public/img/patients/patient1.jpg';
$role='Patient';
if($user['role']==1){$role='Doctor';}
if($user['role']==3){$role='Admin';}
?>
<div class="row">
    <div class="col-md-12">
        <div class="profile-header">
            <div class="row align-items-center">
                <div class="col-auto profile-image">
                    <a href="#">
                        <img class="rounded-circle" alt="User Image" src="<?php echo $img?>">
                    </a>
                </div>
                <div class="col ml-md-n2 profile-user-info">
                    <h4 class="user-name mb-0"><?php echo $user['first_name'] . ' ' . $user['last_name'];?></h4>
                    <h6 class="text-muted"><?php echo $user['email'];?></h6>
                    <div class="user-Location"><i
                                class="fa fa-map-marker"></i> <?php echo $user['address'].' '.$user['city'] . ' ' . $user['country'];?></div>
                    <div class="about-text"><?php echo $role;?>
                    </div>
                </div>
                <div class="col-auto profile-btn">

                    <a href="" class="btn btn-primary">
                        Edit
                    </a>
                </div>
            </div>
        </div>
        <div class="profile-menu">
            <ul class="nav nav-tabs nav-tabs-solid">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#bank_tab">Bank Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#password_tab">Password</a>
                </li>
            </ul>
        </div>
        <div class="tab-content profile-tab-cont">

            <!-- Personal Details Tab -->
            <div class="tab-pane fade active show" id="per_details_tab">

                <!-- Personal Details -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between">
                                    <span>Personal Details</span>
                                    <a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i
                                                class="fa fa-edit mr-1"></i>Edit</a>
                                </h5>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                            <p class="col-sm-10"><?php echo $user['first_name'] . ' ' . $user['last_name'];?></p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Birthdate</p>
                                            <p class="col-sm-10"><?php echo $user['dob'];?></p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                                            <p class="col-sm-10"><?php echo $user['email'];?></p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
                                            <p class="col-sm-10"><?php echo $user['phone'];?></p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-2 text-muted text-sm-right mb-0">Address</p>
                                            <p class="col-sm-10 mb-0"><?php echo$user['address'].' '. $user['state'];?>,
                                                <?php echo $user['city'] . ' ' . $user['country'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <p>
                                            <span class="text-muted">Account No:</span>
                                            <span class="text-monospace"><?php echo $user['account_no'];?></span>
                                        </p>

                                        <p>
                                            <span class="text-muted">Bank Branch:</span>
                                            <span class="text-monospace"><?php echo $user['bank_name'];?></span>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Edit Details Modal -->
                        <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Personal Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="row form-row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" value="<?php echo $user['first_name'];?>">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" value="<?php echo $user['last_name'];?>">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Date of Birth</label>
                                                        <div class="cal-icon">
                                                            <input type="text" class="form-control" value="<?php echo $user['dob'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Email ID</label>
                                                        <input type="email" class="form-control"
                                                               value="<?php echo $user['email'];?>">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Mobile</label>
                                                        <input type="text" value="<?php echo $user['phone'];?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <h5 class="form-title"><span>Address</span></h5>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control"
                                                               value="<?php echo $user['address'];?>">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input type="text" class="form-control" value="<?php echo $user['city'];?>">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>State</label>
                                                        <input type="text" class="form-control" value="<?php echo $user['state'];?>">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Zip Code</label>
                                                        <input type="text" class="form-control" value="22434">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <input type="text" class="form-control" value="<?php echo $user['country'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Save Changes
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Edit Details Modal -->

                    </div>


                </div>
                <!-- /Personal Details -->

            </div>
            <!-- /Personal Details Tab -->

            <!-- Bank details Tab -->
            <div id="bank_tab" class="tab-pane fade">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Bank Details</h5>
                        <div class="row">
                            <div class="col-md-10 col-lg-6">
                                <form>
                                    <div class="form-group">
                                        <label>Account No</label>
                                        <input type="text" class="form-control" name="account_no" value="<?php echo $user['account_no']?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <input type="text" class="form-control" name="bank_name" value="<?php echo $user['bank_name']?>">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Bank details Tab -->

            <!-- Change Password Tab -->
            <div id="password_tab" class="tab-pane fade">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Change Password</h5>
                        <div class="row">
                            <div class="col-md-10 col-lg-6">
                                <form method="post">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm-password">
                                    </div>
                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Change Password Tab -->

        </div>
    </div>
</div>
