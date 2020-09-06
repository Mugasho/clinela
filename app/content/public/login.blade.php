<?php
?>
<div class="row">
    <div class="col-md-8 offset-md-2">

        <!-- Login Tab Content -->
        <div class="account-content">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7 col-lg-6 login-left">
                    <img src="<?php echo CONTENT_PATH ?>public/img/login-banner.png" class="img-fluid" alt="Login">
                </div>
                <div class="col-md-12 col-lg-6 login-right">
                    <div class="login-header">
                        <h3>Login <span>Clinela Doctors</span></h3>
                    </div>
                    <form action="" method="post">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" name="email">
                            <label class="focus-label">Username or Email</label>
                        </div>
                        <div class="form-group form-focus">
                            <input type="password" class="form-control floating" name="password">
                            <label class="focus-label">Password</label>
                        </div>
                        <div class="text-right">
                            <a class="forgot-link" href="<?php echo BASE_PATH?>forgot/">Forgot Password ?</a>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Login</button>

                        <div class="text-center dont-have">Don’t have an account? <a href="<?php echo BASE_PATH?>register/">Register</a></div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Login Tab Content -->

    </div>
</div>
