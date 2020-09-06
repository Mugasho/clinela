<?php
$db = new \clinela\database\DB();
$is_doctor= isset($_SESSION['role'])&& $_SESSION['role']>0;
$is_admin= isset($_SESSION['role'])&& $_SESSION['role']>1;
$label='Patient';
if($is_admin) {
    $label = 'Administrator';
} elseif ($is_doctor){
    $label='Doctor';
}else{
    $label='Patient';
}
$logo=!empty($db->getOptions('header_logo'))?CONTENT_PATH.'uploads/'.$db->getOptions('header_logo'):CONTENT_PATH.'public/img/clinela-logo-red.jpg';
$header_color=!empty($db->getOptions('header_color'))?'style="background-color:'.$db->getOptions('header_color').';"':'';

?>

<nav class="navbar navbar-expand-lg header-nav d-print-none" <?php echo $header_color?>>
    <div class="navbar-header" >
        <a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
        </a>
        <a href="<?php echo BASE_PATH ?>" class="navbar-brand logo">
            <img src="<?php echo $logo ?>" class="img-fluid" alt="Logo">
        </a>
    </div>
    <div class="main-menu-wrapper" >
        <div class="menu-header">
            <a href="<?php echo BASE_PATH ?>" class="menu-logo">
                <img src="<?php echo $logo ?>" class="img-fluid" alt="Logo">
            </a>
            <a id="menu_close" class="menu-close" href="javascript:void(0);">
                <i class="fas fa-times"></i>
            </a>
        </div>
        <ul class="main-nav" >
            <?php
            foreach ($this->getMenu() as $key => $value) {
                $off = isset(explode("/", $_SERVER['REQUEST_URI'])[2]) ? 2 : 1;
                $active = $value['path'] == explode("/", $_SERVER['REQUEST_URI'])[$off] ? ' active"' : '';
                $href = !is_null($value['items']) ? '#' : BASE_PATH . $value['path'];
                $classes = !is_null($value['items']) ? 'has-submenu' : '';

                echo '<li class="' . $classes . $active . '">';
                echo '<a href="' . $href . '">';
                if ($value['icon'] != null) {
                    echo '<i class="' . $value['icon'] . '"></i>' . PHP_EOL;
                }
                echo $key . '</a>' . PHP_EOL;
                if (!is_null($value['items'])) {
                    echo '<ul class="submenu">' . PHP_EOL;
                    foreach ($value['items'] as $item => $item_value) {
                        echo '<li> <a  href="' . BASE_PATH . $item_value . '">' . PHP_EOL . $item . '</a></li>';
                    }
                    echo '</ul>' . PHP_EOL;
                }
                echo '</li>' . PHP_EOL;
            }
            ?>
            <li class="login-link">
                <a href="<?php echo BASE_PATH ?>login/">Login / Signup</a>
            </li>
        </ul>
    </div>
    <ul class="nav header-navbar-rht">
        <li class="nav-item contact-item">
            <div class="header-contact-img">
                <i class="far fa-hospital"></i>
            </div>
            <div class="header-contact-detail">
                <p class="contact-header">Contact</p>
                <p class="contact-info-header"> <?php echo $db->getOptions('site_support_phone')?></>
            </div>
        </li>


        <?php if (isset($_SESSION['id'])) {
            $meta=$db->getUserMeta($_SESSION['id']);
            $img=!empty($meta['photo'])?'uploads/'.$meta['photo']:'public/img/patients/patient.jpg';
            ?>
            <li class="nav-item dropdown has-arrow logged-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false">
								<span class="user-img">
									<img class="rounded-circle" src="<?php echo CONTENT_PATH.$img?>" width="31"
                                         alt="<?php echo $_SESSION['username'] ?>">
								</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="user-header">
                        <div class="avatar avatar-sm">
                            <img src="<?php echo CONTENT_PATH.$img?>" alt="User Image"
                                 class="avatar-img rounded-circle">
                        </div>
                        <div class="user-text">
                            <h6><?php echo $_SESSION['username'] ?></h6>
                            <p class="text-muted mb-0"><?php echo $label ?></p>
                        </div>
                    </div>
                    <?php
                    if($is_admin){
                        echo '<a class="dropdown-item" href="'.BASE_PATH.'admin/">Admin Panel</a>';
                    }
                    if($is_doctor){
                        echo '<a class="dropdown-item" href="'.BASE_PATH.'doctor/dashboard/">Doctor Dashboard</a>';
                    }
                    ?>
                    <a class="dropdown-item" href="<?php echo BASE_PATH ?>logout/">Logout</a>
                </div>
            </li>
        <?php } else { ?>
            <li class="nav-item">
                <a class="nav-link header-login" href="<?php echo BASE_PATH ?>login/">login / Signup </a>
            </li>
            <?php
        }
        ?>
    </ul>
</nav>
