<html>

<head>
	<meta name="viewport" content='width=device-width, initial-scale=1.0,text/html,charset=utf-8'>
	<style>
	body {
		margin: 0;
		/* Reset default margin */
	}
	
	iframe {
		display: block;
		background: #000;
		border: none;
		height: 100vh;
		width: 100vw;
	}
	</style>
</head>

<body>
<?php
$db = new SQLite3('./sports.db');
$res = $db->query('SELECT * FROM sports'); 
$row = $res->fetchArray(SQLITE3_ASSOC);
$_1 = $row['header_n'];
$_2 = str_replace("#", "", $row['border_c']);
$_3 = str_replace("#", "", $row['background_c']);
$_4 = str_replace("#", "", $row['text_c']);
$_5 = $row['days'];
$_6 = $row['auto_s'];
$api = "5cc316f797659";
$url = "https:\/\/www.tvsportguide.com\/widget\/$api?filter_mode=all&filter_value=&days=$_5&heading=$_1&border_color=custom&autoscroll=$_6&prev_nonce=a7242d2019&custom_colors=$_2,$_3,$_4";
?>

<iframe id="iframe" src="<?=$url?>" frameborder="0"></iframe>
</body>
</html>