<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

@$resetcode = $_POST['resetcode'];
@$backup = $_REQUEST['backup'];
@$UserID = $_REQUEST['user'];
@$Pass = $_REQUEST['pass'];

$bupdb = new SQLite3('./.bu.db');
$bupdb->exec("CREATE TABLE IF NOT EXISTS BACKUP(id INTEGER PRIMARY KEY ,user TEXT, pass TEXT, resetcode TEXT, backup TEXT)");

$backedup = '{
	"tag":"CloudBackup",
	"success":"1",
	"api_ver":"1.0v",
	"version":"1.0",
	"msg":"Your backup has been completed successfully"
}';
						  
$badpass = '{
	"tag":"CloudBackup",
	"success":"0",
	"api_ver":"1.0v",
	"version":"1.0",
	"msg":"Backup Password is incorrect. Please check your password and try again. Code: BPE"
}';

$nouser = '{"tag":"CloudBackup","success":"0","api_ver":"1.0v","version":"1.0","msg":"Your Cloud Backup has been failed. Please try again or contact support. Code: JE"}';

$bupres = $bupdb->query("SELECT * FROM BACKUP WHERE user='".$UserID."'");

while($buprow=$bupres->fetchArray()) {
	$dbuser = $buprow['user'];
	$dbpass = $buprow['pass'];
	$dbresetcode = $buprow['resetcode'];
	$dbbackup = $buprow['backup'];
}

if(isset($resetcode)) {
	if(@$dbuser !== $UserID) {
		$bupdb->exec("INSERT INTO BACKUP (user, pass, resetcode, backup) VALUES('".$UserID."', '".$Pass."', '".$resetcode."', '".$backup."') ");
		echo $backedup;
	}else if (@$dbuser == $UserID) {
		$bupdb->exec("UPDATE BACKUP SET backup='".$backup."' WHERE user='".$UserID."'");
		echo $backedup;
	}else {
	echo $nouser;
	}
}

if($resetcode == '') {
	if ($Pass == @$dbpass) {
		echo '
{
"tag":"CloudBackup",
"success":"1",
"api_ver":"1.0v",
"backup":"'.@$dbbackup.'",
"msg":"Backup has been downloaded successfully"
}';
		}else{
			echo $badpass;
		}
} else {
	echo $nouser;
	}