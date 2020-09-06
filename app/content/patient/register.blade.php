<?php
?>
<div class="row">
    <div class="col-md-8 offset-md-2">

        <!-- Register Content -->
        <div class="account-content">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7 col-lg-6 login-left">
                    <img src="<?php echo CONTENT_PATH?>public/img/login-banner.png" class="img-fluid" alt="Doccure Register">
                </div>
                <div class="col-md-12 col-lg-6 login-right">
                    <div class="login-header">
                        <h3>Register </h3>
                    </div>

                    <!-- Register Form -->
                    <form action="" method="post">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="username" required>
                            <label class="focus-label">Username</label>
                        </div>
                        <div class="form-group form-focus">
                            <input type="email" class="form-control floating" name="email" required>
                            <label class="focus-label">Email</label>
                        </div>
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="phone">
                            <label class="focus-label">Mobile Number</label>
                        </div>
                        <div class="form-group form-focus">
                            <input type="password" class="form-control floating" name="password" required>
                            <label class="focus-label">Create Password</label>
                        </div>
                        <div class="form-group form-focus">
                            <input type="password" class="form-control floating" name="rpt-password" required>
                            <label class="focus-label">Repeat Password</label>
                        </div>
                        <div class="form-group">
                            <label class="custom_check">
                                <input type="checkbox" name="is_doctor">
                                <span class="checkmark"></span> Are you a Doctor?
                            </label>
                        </div>
                        <div class="text-right">
                            <a class="forgot-link" href="<?php echo BASE_PATH?>login/">Already have an account?</a>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Signup</button>

                    </form>
                    <!-- /Register Form -->

                </div>
            </div>
        </div>
        <!-- /Register Content -->

    </div>
</div>
