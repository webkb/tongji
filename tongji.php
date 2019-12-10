<?php
if (! isset($_GET['url'])):
?>
var $url = 'http://shijuewuyu.com/tongji.php';
$url += '?url=' + encodeURIComponent(location);
$url += '&referrer=' + encodeURIComponent(document.referrer);
$url += '&platform=' + navigator.platform;
$url += '&language=' + navigator.language;
$url += '&tz=' + new Date().getTimezoneOffset()/60;
$url += '&x=' + screen.width;
$url += '&y=' + screen.height;
$url += '&iw=' + innerWidth;
$url += '&ih=' + innerHeight;

var $ele =document.createElement("script");$ele.src = $url;
document.body.appendChild($ele);
<?php
else:

define('ROOT', __DIR__);	
require './include/setting.php';


$a4 = $_GET['url'];
$a1 = $_GET['referrer'];
$a8 = $_GET['platform'];
$a10 = $_GET['tz'];
$a11 = $_GET['language'];
$a5 = $_GET['x'];
$a6 = $_GET['y'];
$a12 = $_GET['iw'];
$a13 = $_GET['ih'];


$a2 = $_SERVER['HTTP_USER_AGENT'];
$a3 = $_SERVER['REMOTE_ADDR'];
$a7 = $_SERVER['HTTP_ACCEPT_LANGUAGE'];


mysql_xquery("INSERT wsp_tongji SET
`a1` = '$a1',
`a2` = '$a2',
`a3` = '$a3',
`a4` = '$a4',
`a5` = '$a5',
`a6` = '$a6',
`a7` = '$a7',
`a8` = '$a8',
`a10` = '$a10',
`a11` = '$a11',
`a12` = '$a12',
`a13` = '$a13'
");
endif;
?>