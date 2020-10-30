<?php
$protocol=!empty($_SERVER['HTTPS'])?'https://':'http://';
define("PROTOCOL",$protocol); /** know whether its http or https*/
define("SERVER",PROTOCOL.$_SERVER['SERVER_NAME']);
define("ROUTE",$_SERVER['REQUEST_URI']);
define("BASE_PATH",PROTOCOL.$_SERVER['SERVER_NAME']."/");
define("DOCUMENT_PATH",$_SERVER['DOCUMENT_ROOT']."/app/assets/");
define("CONTENT_PATH",BASE_PATH."app/assets/");
