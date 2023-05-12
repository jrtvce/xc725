<?php
$Tag = $_GET['tag'];
@$UserID = $_GET['userid'];
include('../includes/function.php');
$key = "mysecretkeywsdef";
$iv = "myuniqueivparamu";
$PING = date('d-m-Y H:i:s');

if (isset($_GET['tag'])){
	if ($Tag == "licV3"){
		echo bin2hex(openssl_encrypt(file_get_contents("./main.json") , "AES-128-CBC", $key, OPENSSL_RAW_DATA, $iv));
	}
	if ($Tag == "man" || $Tag == "ann"){
		echo file_get_contents("./" . $Tag . ".json");
	}
	if ($Tag == "conn" || $Tag == "msg_conf"){
		echo '{"tag":"' . $Tag . '","success":"1","api_ver":"1.0v"}';
	}
	if ($Tag == "whatsup"){
		echo '{"tag":"whatsup","success":"0","api_ver":"1.0v","whatsup":"no"}';
	}
	if ($Tag == "gfilter"){
		echo '{"tag":"gfilter_n","success":"1","api_ver":"1.0v","status":"No","filter":[]}';
	}
	if ($Tag == "msg_cat_view" || $Tag == "msg"){
		$db = new SQLite3('./user_message.db');
		$stmt = $db->prepare("SELECT * FROM messages WHERE userid=?");
		$stmt->bindValue(1, sanitize($UserID));
		$res = $stmt->execute();
		$row = $res->fetchArray() ;
		$message = $row['message'];
		$userid = $row['userid'];
		$status = $row['status'];
		$expire = $row['expire'];
		if (empty($message)){
			echo '{"tag":"' . $Tag . '","success":"0","api_ver":"1.0v","message":"None Messages"}';
		}
		else{
			echo '{"tag":"' . $Tag . '","success":"1","api_ver":"1.0v","status":"$status","msgid":"1646","message":"$message"}';
		}
	}
	if($Tag == "connv2"){
		$LASTTIME = date('d-m-Y H:i:s');
		$TIME = date('d-m-Y H:i:s');
		$IPADDRESS = real_ip();

		if (isset($_GET['userid'])) {
			$UserID = $_GET['userid'];
		}else {
			$UserID = '';
		}

		$db1 = new SQLite3('./user_logs.db');
		$db1->exec('CREATE TABLE IF NOT EXISTS logging(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, appid TEXT, version TEXT, device TEXT, pkg TEXT, app TEXT, cid TEXT, uid TEXT, status TEXT, d TEXT, time TEXT, last_online TEXT, ping TEXT, IP TEXT)');
		$res1 = $db1->query("SELECT * FROM logging WHERE uid='".$UserID."'" );

		while ($row5 = $res1->fetchArray()) {
			$app_id = $row5['appid'];
		}

		if (empty($app_id)) {
			$db1->exec("INSERT INTO logging(appid, version, device, pkg, app, cid, uid, status, d, time, ping, IP) 
						VALUES( '" . $_GET['appid'] . "',
								'" . $_GET['version'] . "',
								'" . $_GET['device_type'] . "',
								'" . $_GET['p'] . "',
								'" . $_GET['an'] . "',
								'" . $_GET['customerid'] . "',
								'" . $_GET['userid'] . "',
								'" . $_GET['online'] . "',
								'" . $_GET['did'] . "',
								'" . $TIME . "',
								'" . $PING . "',
								'" . $IPADDRESS . "'
								)");
		}
		else if ($_GET['online'] == 'yes') {
			$db1->exec("UPDATE logging SET  appid='" . $_GET['appid'] . "',
											version='" . $_GET['version'] . "',
											device='" . $_GET['device_type'] . "',
											pkg='" . $_GET['p'] . "',
											app='" . $_GET['an'] . "',
											cid='" . $_GET['customerid'] . "',
											status='" . $_GET['online'] . "',
											d='" . $_GET['did'] . "',
											last_online='" . $LASTTIME . "',
											ping='" . $PING . "',
											IP='" . $IPADDRESS . "'
										WHERE uid='" . $_GET['userid'] . "'
										");
		}
		else {
			$db1->exec("UPDATE logging SET  appid='" . $_GET['appid'] . "',
											version='" . $_GET['version'] . "',
											device='" . $_GET['device_type'] . "',
											pkg='" . $_GET['p'] . "',
											app='" . $_GET['an'] . "',
											cid='" . $_GET['customerid'] . "',
											status='" . $_GET['online'] . "',
											d='" . $_GET['did'] . "',
											ping='" . $PING . "',
											IP='" . $IPADDRESS . "'
										WHERE uid='" . $_GET['userid'] . "'
										");
		}



		$db = new SQLite3('./user_message.db');
		$stmt = $db->prepare("SELECT * FROM messages WHERE userid=?");
		$stmt->bindValue(1, sanitize($UserID));
		$res = $stmt->execute();
		$row = $res->fetchArray() ;
		$msgid = $row['id'];
		$message = $row['message'];
		$userid = $row['userid'];
		$status = $row['status'];
		$expire = $row['expire'];
		$jsonData = file_get_contents("./connv2.json");
		if($message != ''){
			$arrayData = json_decode($jsonData, true);
			$replacementData = array(
				'success' => '1',
				'message' => $message,
				'msg_status' => $status,
				'msg_expire' => $expire,
				'msgid' => '1646'
			);
			$newArrayData = array_replace_recursive($arrayData, $replacementData);
			$newJsonData = json_encode($newArrayData, JSON_PRETTY_PRINT);
			echo $newJsonData;
		}else{
			echo file_get_contents("./connv2.json");
		}
	}
	if($Tag == "vpnconfigV2"){
		$db = new SQLite3('./.db.db');
		$vpn = $db->query('SELECT * FROM vpn');
		while ($vpna = $vpn -> fetchArray(SQLITE3_ASSOC)) {
			$dataA[]=array(
				"id" => $vpna['id'],
				"userid" => $vpna['userid'],
				"vpn_appid" => $vpna['vpn_appid'],
				"vpn_country" => $vpna['vpn_country'],
				"vpn_state" => $vpna['vpn_state'],
				"vpn_config" => $vpna['vpn_config'],
				"vpn_status" => $vpna['vpn_status'],
				"auth_type" => $vpna['auth_type'],
				"auth_embedded" => $vpna['auth_embedded'],
				"username" => $vpna['username'],
				"password" => $vpna['password'],
				"date" => $vpna['date']
				);
		}
		$jdata = json_encode($dataA);
		$vpn_out = "{\"tag\": \"vpnconfigV2\",\"success\": \"1\",\"api_ver\": \"1.0v\",\"vpnconfigs\": {$jdata}}";
		echo bin2hex(openssl_encrypt($vpn_out , "AES-128-CBC", $key, OPENSSL_RAW_DATA, $iv));
	}
}else{
	include ('index.php');
}

?>
