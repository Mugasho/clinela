<?php
require 'vendor/autoload.php';
require 'app/config/system.php';
if(file_exists('app/config/database.php')){
    require 'app/config/database.php';
}
require 'app/routes.php';
