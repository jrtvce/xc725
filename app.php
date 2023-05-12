<?php
$json_file = "./api/main.json";
$jsondata = file_get_contents($json_file);
$arrayData = json_decode($jsondata, true);
$json = $arrayData['app'];

$lurl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER["PHP_SELF"]) . '/api/';

function yesno($var){
	return (empty($var)) ? 'yes' : $var;
}
function yesno2($var){
	return (empty($var)) ? 'no' : $var;
}

if (isset($_POST['submit_support'])){
	$replacementData = array(
		'app' => array(
			'announcement_enabled' => yesno2($_POST["announcement_enabled"]),
			'message_enabled' => yesno2($_POST["message_enabled"]),
			'updateuserinfo_enabled' => yesno2($_POST["updateuserinfo_enabled"]),
			'appname' => $_POST['appname'],
			'version_code' => $_POST['version_code'],
			'customerid' => $_POST["customerid"],
			'expire' => $_POST["expire"],
			'support_email' => $_POST["support_email"],
			'support_phone' => $_POST["support_phone"],
			'login_type' => (empty($_POST["login_type"])) ? 'login' : $_POST["login_type"],
			'btn_login_account' => yesno2($_POST["btn_login_account"]),
			'btn_login_settings' => yesno2($_POST["btn_login_settings"]),
			'logurl' => $lurl
		)
	);

	$newArrayData = array_replace_recursive($arrayData, $replacementData);
	$newJsonData = json_encode($newArrayData, JSON_PRETTY_PRINT);
	file_put_contents($json_file, $newJsonData);
	header("Location: ". basename($_SERVER["SCRIPT_NAME"])."?status=1");
}
if (isset($_POST['submit'])){
	$replacementData = array(
		'app' => array(
			'portal' => $_POST['portal'],
			'portal2' => $_POST["portal2"],
			'portal3' => $_POST["portal3"],
			'portal4' => $_POST["portal4"],
			'portal5' => $_POST["portal5"],
			'portal_name' => $_POST["portal_name"],
			'portal2_name' => $_POST["portal2_name"],
			'portal3_name' => $_POST["portal3_name"],
			'portal4_name' => $_POST["portal4_name"],
			'portal5_name' => $_POST["portal5_name"],
			'logurl' => $lurl,
			'epg_url' => $_POST["epg_url"],
			'ovpn_url' => $_POST["ovpn_url"],
			"stream_type" => $_POST["stream_type"]
		)
	);
	$newArrayData = array_replace_recursive($arrayData, $replacementData);
	$newJsonData = json_encode($newArrayData, JSON_PRETTY_PRINT);
	file_put_contents($json_file, $newJsonData);
	header("Location: ". basename($_SERVER["SCRIPT_NAME"])."?status=1");
}


if (isset($_POST['aditional_submit'])){
	$replacementData = array(
		'app' => array(
			"show_cat_count" => yesno($_POST["show_cat_count"]),
			"load_last_channel" => yesno($_POST["load_last_channel"]),
			"login_logo" => yesno($_POST["login_logo"]),
			"logs" => $logs,
			"agent" => (empty($_POST["agent"])) ? 'XCIPTV - FTG' : $_POST["agent"],
		)
	);
	$newArrayData = array_replace_recursive($arrayData, $replacementData);
	$newJsonData = json_encode($newArrayData, JSON_PRETTY_PRINT);
	file_put_contents($json_file, $newJsonData);
	
	header("Location: ". basename($_SERVER["SCRIPT_NAME"])."?status=1");
}

include ('includes/header.php');
?>


		<div class="card bg-primary text-white">
			<div class="card-header card-header-warning">
				<center>
					<h2><i class="icon icon-cogs"></i> General Applications Settings</h2>
				</center>
			</div>
			<div class="alert alert-info alert-dismissible" role="alert">
				<center>
					Update one section at a time.
				</center>
			</div>
			<div class="row">
				<div class="card-body">
					<div class="card bg-primary text-white">
						<div class="card-header card-header-warning">
							<center>
								<h3><i class="icon icon-sliders"></i> Application</h3>
							</center>
						</div>
						<div class="card-body">

							<form method="post">
								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Application Name</label>
										<input class="form-control" id="appname" name="appname" value="<?=$json['appname']?>" type="text"/>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Application Build Number</label>
										<input class="form-control" id="version_code" name="version_code" value="<?=$json['version_code']?>" type="text"/>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Application Identifier</label>
										<input class="form-control" id="customerid" name="customerid"  value="<?=$json['customerid']?>" type="text"/>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Client Login type</label>
										<select class="form-control" id="select" name="login_type">
											<option value="login"<?=$json['login_type']=='login'?'selected':'' ?>>XC Login</option>
											<option value="mac" <?=$json['login_type']=='mac'?'selected':'' ?>>MAC Address</option>
											<option value="activation" <?=$json['login_type']=='activation'?'selected':'' ?>>Activiation Code</option>
										</select>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Login Accounts Button</label>
										<select class="form-control" id="select" name="btn_login_account">
											<option value="yes" <?=$json['btn_login_account']=='yes'?'selected':'' ?>>Enabled</option>
											<option value="no" <?=$json['btn_login_account']=='no'?'selected':'' ?>>Disabled</option>
										</select>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Login Settings Button</label>
										<select class="form-control" id="select" name="btn_login_settings">
											<option value="yes" <?=$json['btn_login_settings']=='yes'?'selected':'' ?>>Enabled</option>
											<option value="no" <?=$json['btn_login_settings']=='no'?'selected':'' ?>>Disabled</option>
										</select>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label" >Announcements</label>
										<select class="form-control" id="select" name="announcement_enabled">
											<option value="yes"<?=$json['announcement_enabled']=='yes'?'selected':'' ?>>Enabled</option>
											<option value="no" <?=$json['announcement_enabled']=='no'?'selected':'' ?>>Disabled</option>
										</select>
									</div>
							   </div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label" >Messages</label>
										<select class="form-control" id="select" name="message_enabled">
											<option value="yes"<?=$json['message_enabled']=='yes'?'selected':'' ?>>Enabled</option>
											<option value="no" <?=$json['message_enabled']=='no'?'selected':'' ?>>Disabled</option>
										</select>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label" >Update User Info</label>
										<select class="form-control" id="select" name="updateuserinfo_enabled">
											<option value="yes"<?=$json['updateuserinfo_enabled']=='yes'?'selected':'' ?>>Enabled</option>
											<option value="no" <?=$json['updateuserinfo_enabled']=='no'?'selected':'' ?>>Disabled</option>
										</select>
									</div>						   
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Developer Name</label>
										<input class="form-control" name="support_email" value="<?=$json['support_email'] ?>" type="text"/>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Developer Contact</label>
										<input class="form-control" name="support_phone"  value="<?=$json['support_phone']?>" type="text"/>
									</div>
								</div>
							
							<div class="form-group form-float form-group-lg">
								<center>
									<button class="btn btn-info" name="submit_support" type="submit">
										<i class="icon icon-check"></i> Update Application
									</button>
								</center>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="card bg-primary text-white">
					<div class="card-header card-header-warning">
						<center>
							<h2><i class="icon icon-sliders"></i> Providers</h2>
						</center>
					</div>
					<div class="card-body">
							
							<form method="post">
								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Portal 1	</label> Name
										<input class="form-control" id="portal_name" name="portal_name" placeholder="Portal 1 Name" type="text" value=<?=$json['portal_name']=='0'?'0':$json['portal_name'] ?>>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Portal 1	</label> URL
										<input class="form-control" id="portal" name="portal" placeholder="Poral Address 1" type="text" value=<?=$json['portal']=='0'?'0':$json['portal'] ?>>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Portal 2	</label> Name
										<input class="form-control" id="portal2_name" name="portal2_name" placeholder="Portal 2 Name" type="text" value=<?=$json['portal2_name']=='0'?'0':$json['portal2_name']?>>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Portal 2	</label> URL
										<input class="form-control" id="portal2" name="portal2" placeholder="Poral Address 2" type="text" value=<?=$json['portal2']=='0'?'0':$json['portal2'] ?>>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Portal 3	</label> Name
										<input class="form-control" id="portal3_name" name="portal3_name" placeholder="Portal 3 Name" type="text" value=<?=$json['portal3_name']=='0'?'0':$json['portal3_name'] ?>>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Portal 3	</label> URL
										<input class="form-control" id="portal3" name="portal3" placeholder="Portal Address 3" type="text" value=<?=$json['portal3']=='0'?'0':$json['portal3'] ?>>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Portal 4	</label> Name
										<input class="form-control" id="portal4_name" name="portal4_name" placeholder="Portal 4 Name" type="text" value=<?=$json['portal4_name']=='0'?'0':$json['portal4_name'] ?>>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Portal 4	</label> URL
										<input class="form-control" id="portal4" name="portal4" placeholder="Portal Address 4" type="text" value=<?=$json['portal4']=='0'?'0':$json['portal4'] ?>>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Portal 5	</label> Name
										<input class="form-control" id="portal5_name" name="portal5_name" placeholder="Portal 5 Name" type="text" value=<?=$json['portal5_name']=='0'?'0':$json['portal5_name'] ?>>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Portal 5	</label> URL
										<input class="form-control" id="portal5" name="portal5" placeholder="Portal Address 5" type="text" value=<?=$json['portal5']=='0'?'0':$json['portal5'] ?>>
									</div>
								</div>


								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">VOD Portal</label>
										<input class="form-control" id="portal_vod" name="portal_vod" placeholder="Custom VOD Portal" value='no' type="text">
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Series Portal</label>
										<input class="form-control" id="portal_series" name="portal_series" placeholder="Custom Series Portal" value='no' type="text">
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">EPG Url</label>
										<input class="form-control" id="epg_url" name="epg_url" placeholder="EPG URL" value='No' type="text">
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">OVPN Config URL</label>
										<input class="form-control" id="ovpn_url" name="ovpn_url" placeholder="OVPN Config URL" type="text" value=<?=$json['ovpn_url']=='0'?'0':$json['ovpn_url'] ?>>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<div class="form-line">
										<label class="form-label">Stream Format</label>
										<select class="form-control" id="select" name="stream_type">
											<option value="ts"<?=$json['stream_type']=='ts'?'selected':'' ?>>MPEGTS (.ts)</option>
											<option value="m3u8" <?=$json['stream_type']=='m3u8'?'selected':'' ?>>HLS (.m3u8)</option>
										</select>
									</div>
								</div>

								<hr>

								<div>
									<div class="form-group form-float form-group-lg">
										<center>
											<button class="btn btn-info" name="submit" type="submit">
												<i class="icon icon-check"></i>Update Portals
											</button>
										</center>
									</div>
								</div>
							</form>
					</div>
				</div>
			</div>

			<div class="card-body col-md-4 mx-auto">
				<div class="card bg-primary text-white">
					<div class="card-header card-header-warning">
						<center>
							<h2><i class="icon icon-sliders"></i> Extra Application Options</h2>
						</center>
					</div>
					<div class="card-body">
							<form method="post">

								<div class="form-group form-float form-group-lg">
									<label class="form-label" for="login_logo" >Show Login Logo</label>
									<select class="form-control" id="select" name="login_logo">
										<option value="yes" <?=$json['login_logo']=='yes'?'selected':'' ?>>Enabled</option>
										<option value="no" <?=$json['login_logo']=='no'?'selected':'' ?>>Disabled</option>
									</select>								 
								</div>

								<div class="form-group form-float form-group-lg">
									<label class="form-label" for="logs" >Show App Logs</label>
									<select class="form-control" id="select" name="logs">
										<option value="yes"<?=$json['logs']=='yes'?'selected':'' ?>>Enabled</option>
										<option value="no" <?=$json['logs']=='no'?'selected':'' ?>>Disabled</option>
									</select>								 
								</div>

								<div class="form-group form-float form-group-lg">
									<label class="form-label" for="show_cat_count" >Show Category Count</label>
									<select class="form-control" id="select" name="show_cat_count">
										<option value="yes"<?=$json['show_cat_count']=='yes'?'selected':'' ?>>Enabled</option>
										<option value="no" <?=$json['show_cat_count']=='no'?'selected':'' ?>>Disabled</option>
									</select>								 
								</div>

								<div class="form-group form-float form-group-lg">
									<label class="form-label" for="agent">User-Agent</label>
									<input class="form-control" name="agent"  value="<?=$json['agent']?>" type="text"/>
								</div>

								<div class="form-group form-float form-group-lg">
									<label class="form-label" for="load_last_channel" >Load Last Channel</label>
									<select class="form-control" id="select" name="load_last_channel">
										<option value="yes"<?=$json['load_last_channel']=='yes'?'selected':'' ?>>Enabled</option>
										<option value="no"<?=$json['load_last_channel']=='no'?'selected':'' ?>>Disabled</option>
									</select>								 
								</div>

								<hr>

								<div class="form-group form-float form-group-lg">
									<center>
										<button class="btn btn-info" name="aditional_submit" type="submit">
											<i class="icon icon-check"></i> Update App Settings
										</button>
									</center>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php include ('includes/footer.php'); ?>

</body>
</html>