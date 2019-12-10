<?php
define('ROOT', __DIR__);
define('DB_ONLINE', true);
require ROOT . '/../include/setting.php';

$table = "wsp_tongji";

$date = '';
$where_array['date'] = 1;
$where_string = array();
//$where_string[] = " a1 LIKE '%google%' ";
//$where_string[] = " a2 NOT LIKE '%Googlebot%' ";
$where_string_string = join(' AND ', $where_string);
if ($where_string_string) {
	$where = " WHERE " . $where_string_string;
} else {
	$where = " ";
}

$groupby = "";
//$groupby = "GROUP BY a5";
$orderby = "";
$orderby = "ORDER BY id DESC";
 
$data = mysql_select("SELECT * FROM $table $where $groupby $orderby", "SELECT COUNT(*) FROM $table $where $groupby $orderby", 20);

function browser($userAgent) {
	preg_match_all('/(CriOS|Firefox|PaleMoon|Chrome|YaBrowser|Edge|OPR|Maxthon|Googlebot|Trident|Version|MSIE|rv|BingPreview)[\/ :]([\w.]+)/', $userAgent, $matches);

	if (! empty($matches[0])) {
		$browser = $matches[0][0];
		$count = count($matches[0]);
		if ($count==2 && $matches[1][0] == "Chrome") {
			$browser = $matches[0][1];
		} elseif ($count==2 && $matches[1][0] == "Trident") {
			$browser = $matches[0][1];
		} elseif ($count==2 && $matches[1][0] == "Version") {
			$browser = $matches[0][1];
		} elseif ($count==2 && $matches[1][0] == "rv" && $matches[1][1] == "Firefox") {
			$browser = $matches[0][1];
		} elseif ($count==3 && $matches[1][1] == "Firefox") {
			$browser = $matches[0][2];
		}
	} else {
		$browser = '';
	}
	$browser = str_replace('Version', 'Safari', $browser);
	$browser = str_replace('rv', 'MSIE', $browser);
	preg_match('/Mobile/', $userAgent, $matches2);
	$mobile = empty($matches2) ? ' ' : ' ' . $matches2[0];
	return $browser . ' ' . $mobile;
}
function os($userAgent) {
	preg_match_all('/(Windows NT|Windows NT|Windows NT|WOW64|Win64|x64|Android|Mac OS X|iPad; CPU OS|iPhone OS|Linux|Googlebot)[\/ ]([\w.]+)/', $userAgent, $matches);

	
	$browser = $matches[0][0];
	$count = count($matches[0]);
	if ($count==2 && $matches[1][0] == "Mac OS X") {
		$browser = $matches[0][1];
	} elseif ($count==2 && $matches[1][0] == "Trident") {
		$browser = $matches[0][1];
	} elseif ($count==2 && $matches[1][0] == "Version") {
		$browser = $matches[0][1];
	} elseif ($count==2 && $matches[1][0] == "rv" && $matches[1][1] == "Firefox") {
		$browser = $matches[0][1];
	} elseif ($count==3 && $matches[1][1] == "Firefox") {
		$browser = $matches[0][2];
	}
	$browser = str_replace('Windows NT 6.1', 'W7', $browser);
	$browser = str_replace('Windows NT 5.1', 'WXP', $browser);
	$browser = str_replace('Windows NT 10.0', 'W10', $browser);
	return $browser;
}
function page($page) {$url = $page;
	$page = str_replace('http://www.shijuewuyu.com/spotlight/image.php?id=', '', $page);
	$page = str_replace('http://shijuewuyu.com/spotlight/image.php?id=', '', $page);
	$page = "<a href=$url>$page</a>";
	return $page;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<style>
body {
	font-size: 16px;
}
td {
	padding:5px;
	word-break: break-all;
}
tr:nth-of-type(4n)
{
	background: silver;
}
tr:nth-of-type(4n+1)
{
	background: silver;
}
.pagebar{
	font-size:12px;
}
.pagebar a, .pagebar span{
	margin-left: 5px;
	float:left;
	padding:4px 6px;
	border:1px silver solid;
}
.pagebar .on{
	color:red;
	background: #E5EDF2;
	border:1px orange solid;
}
.pagebar .first{
	margin-left: 0;
}
</style>
</head>
<body>
<table border=1 width= style="table-layout: fixed">
<tr>
<th width=1.2%>ID</th >
<th width=16%>Page</th >
<th width=3%>Location</th ><th width=5%>OS / Browser</th >
<th width=4%></th >
</tr>
<?php foreach($data as $v): ?>
<tr>
<td rowspan=2><?php echo $v->id; ?></td>
<td><?php echo page($v->a1); ?></td>
<td><?php echo $v->a11; ?></td><td><?php echo os($v->a2); ?></td>
<td><?php echo $v->createtime; ?></td>
</tr>
<tr>
<td><?php echo page($v->a4); ?></td>
<td><?php echo $v->a3; ?></td><td><?php echo browser($v->a2); ?></td>
<td><?php echo $v->a5; ?>x<?php echo $v->a6; ?> / <?php echo $v->a12; ?>x<?php echo $v->a13; ?></td>
</tr>
<?php endforeach;?>

</table>
<?php pagebar();?>
</body>
</html>