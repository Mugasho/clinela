<?php
$sidebar_color=!empty($db->getOptions('admin_sidebar_color'))?'style="background-color:'.$db->getOptions('admin_sidebar_color').';"':'';

?>

<!-- Sidebar -->
<div class="sidebar" id="sidebar" <?php echo $sidebar_color;?>>
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <?php
                foreach ($this->getMenu() as $key => $value) {
                    $off = isset(explode("/", $_SERVER['REQUEST_URI'])[2]) ? 2 : 1;
                    $active = $value['path'] == explode("/", $_SERVER['REQUEST_URI'])[$off] ? ' active current-page"' : '';
                    $href = !is_null($value['items']) ? '#' : BASE_PATH . $value['path'];
                    $classes = !is_null($value['items']) ? 'has-submenu' : '';

                    echo '<li class="' . $classes . $active . '">';
                    echo '<a href="' . $href . '">';
                    if ($value['icon'] != null) {
                        echo '<i class="' . $value['icon'] . '"></i>' . PHP_EOL;
                    }
                    echo '<span>'.$key . '</span></a>' . PHP_EOL;
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

            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
