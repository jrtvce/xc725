<?php
$jsondata = file_get_contents("./api/main.json");
$arrayData = json_decode($jsondata, true);
$json = $arrayData['app'];

function yesno($var){
	return (empty($var)) ? 'No' : $var;
}
function yesno2($var){
	return (empty($var)) ? 'no' : $var;
}
function yesno3($var){
	return (empty($var)) ? 'yes' : $var;
}

	if (isset($_POST['submit_app_custom'])){
		$replacementData = array(
			'app' => array(
				"btn_live" => yesno($_POST["btn_live"]),
				"btn_live2" => yesno($_POST["btn_live2"]),
				"btn_live3" => yesno($_POST["btn_live3"]),
				"btn_live4" => yesno($_POST["btn_live4"]),
				"btn_live5" => yesno($_POST["btn_live5"]),
				"btn_vod" => yesno($_POST["btn_vod"]),
				"btn_vod2" => yesno($_POST["btn_vod2"]),
				"btn_vod3" => yesno($_POST["btn_vod3"]),
				"btn_vod4" => yesno($_POST["btn_vod4"]),
				"btn_vod5" => yesno($_POST["btn_vod5"]),
				"btn_epg" => yesno($_POST["btn_epg"]),
				"btn_epg2" => yesno($_POST["btn_epg2"]),
				"btn_epg3" => yesno($_POST["btn_epg3"]),
				"btn_epg4" => yesno($_POST["btn_epg4"]),
				"btn_epg5" => yesno($_POST["btn_epg5"]),
				"btn_series" => yesno($_POST["btn_series"]),
				"btn_series2" => yesno($_POST["btn_series2"]),
				"btn_series3" => yesno($_POST["btn_series3"]),
				"btn_series4" => yesno($_POST["btn_series4"]),
				"btn_series5" => yesno($_POST["btn_series5"]),
				"btn_radio" => yesno($_POST["btn_radio"]),
				"btn_radio2" => yesno($_POST["btn_radio2"]),
				"btn_radio3" => yesno($_POST["btn_radio3"]),
				"btn_radio4" => yesno($_POST["btn_radio4"]),
				"btn_radio5" => yesno($_POST["btn_radio5"]),
				"btn_catchup" => yesno($_POST["btn_catchup"]),
				"btn_catchup2" => yesno($_POST["btn_catchup2"]),
				"btn_catchup3" => yesno($_POST["btn_catchup3"]),
				"btn_catchup4" => yesno($_POST["btn_catchup4"]),
				"btn_catchup5" => yesno($_POST["btn_catchup5"]),
				"btn_account" => yesno2($_POST["btn_account"]),
				"btn_account2" => yesno2($_POST["btn_account2"]),
				"btn_account3" => yesno2($_POST["btn_account3"]),
				"btn_account4" => yesno2($_POST["btn_account4"]),
				"btn_account5" => yesno2($_POST["btn_account5"]),
				"ms" => yesno2($_POST["ms"]),
				"ms2" => yesno2($_POST["ms2"]),
				"ms3" => yesno2($_POST["ms3"]),
				"ms4" => yesno2($_POST["ms4"]),
				"ms5" => yesno2($_POST["ms5"]),
				"btn_fav" => yesno2($_POST["btn_fav"]),
				"btn_fav2" => yesno2($_POST["btn_fav2"]),
				"btn_fav3" => yesno2($_POST["btn_fav3"]),
				"btn_fav4" => yesno2($_POST["btn_fav4"]),
				"btn_fav5" => yesno2($_POST["btn_fav5"]),
				"stream_type" => (empty($_POST["stream_type"])) ? 'ts' : $_POST["stream_type"]
			)
		);
		$newArrayData = array_replace_recursive($arrayData, $replacementData);
		$newJsonData = json_encode($newArrayData, JSON_PRETTY_PRINT);
		file_put_contents("./api/main.json", $newJsonData);
		header("Location: ". basename($_SERVER["SCRIPT_NAME"])."?status=1");
	}

	if (isset($_POST['aditional_submit'])){
		$replacementData = array(
			'app' => array(
				"btn_pr" => yesno3($_POST["btn_pr"]),
				"btn_rec" => yesno3($_POST["btn_rec"]),
				"btn_vpn" => yesno3($_POST["btn_vpn"]),
				"btn_noti" => yesno3($_POST["btn_noti"]),
				"btn_update" => yesno3($_POST["btn_update"]),
				"show_expire" => yesno3($_POST["show_expire"])
			)
		);
		$newArrayData = array_replace_recursive($arrayData, $replacementData);
		$newJsonData = json_encode($newArrayData, JSON_PRETTY_PRINT);
		file_put_contents("./api/main.json", $newJsonData);
	
		header("Location: ". basename($_SERVER["SCRIPT_NAME"])."?status=1");
	}

	include ('includes/header.php');
?>

		<div class="card bg-primary text-white">
			<div class="card-header card-header-warning">
				<center>
					<h2><i class="icon icon-cogs"></i>	Application Interface Settings</h2>
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
							<h2><i class="icon icon-sliders"></i> Interface</h2>
						</center>
					</div>
						
					<div class="card-body">
						<center>
							<div class="mr-5">
								<form method="post">
									<div class="fform-group form-float form-group-lg">
										<label class="form-label" for="btn_live">
											Show <strong>Live TV</strong> Icon?
										</label>
										<div class="form-line">
											<div class="material-switch form-check-inline">
											<label for="btn_live" class="bg-info">Portal 1<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="info" name="btn_live" id="btn_live" value="Yes" <?=$json['btn_live']=='Yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_live2" class="bg-success">Portal 2<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="success" name="btn_live2" id="btn_live2" value="Yes" <?=$json['btn_live2']=='Yes'?'checked':'' ?>>
											</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_live3" class="bg-warning">Portal 3<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="warning" name="btn_live3" id="btn_live3" value="Yes" <?=$json['btn_live3']=='Yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
												<label for="btn_live4" class="bg-danger">Portal 4<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="danger" name="btn_live4" id="btn_live4" value="Yes" <?=$json['btn_live4']=='Yes'?'checked':'' ?> >
												</label>
											</div>
											<div class="material-switch form-check-inline">
												<label for="btn_live5" class="bg-secondary">Portal 5<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="secondary" name="btn_live5" id="btn_live5" value="Yes" <?=$json['btn_live5']=='Yes'?'checked':'' ?> >
												</label>
											</div>
										</div>
									</div>

									<hr>

									<div class="form-group form-float form-group-lg">
										<label class="form-label" for="btn_epg">
											Show <strong>TV Guide</strong> Icon?
										</label>
										<div class="form-line">
											<div class="material-switch form-check-inline">
											<label for="btn_epg" class="bg-info">Portal 1<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="info" name="btn_epg" id="btn_epg" value="Yes" <?=$json['btn_epg']=='Yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_epg2" class="bg-success">Portal 2<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="success" name="btn_epg2" id="btn_epg2" value="Yes" <?=$json['btn_epg2']=='Yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_epg3" class="bg-warning">Portal 3<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="warning" name="btn_epg3" id="btn_epg3" value="Yes" <?=$json['btn_epg3']=='Yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
												<label for="btn_epg3" class="bg-danger">Portal 4<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="danger" name="btn_epg4" id="btn_epg4" value="Yes" <?=$json['btn_epg4']=='Yes'?'checked':'' ?> >
												</label>
											</div>
											<div class="material-switch form-check-inline">
												<label for="btn_epg3" class="bg-secondary">Portal 5<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="secondary" name="btn_epg5" id="btn_epg5" value="Yes" <?=$json['btn_epg5']=='Yes'?'checked':'' ?> >
												</label>
											</div>
										</div>
									</div>

									<hr>
									
									<div class="form-group form-float form-group-lg">
										<label class="form-label" for="btn_vod">
											Show <strong>VOD</strong> Icon?
										</label>
										<div class="form-line">
											<div class="material-switch form-check-inline">
											<label for="btn_vod" class="bg-info">Portal 1<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="info" name="btn_vod" id="btn_vod" value="Yes" <?=$json['btn_vod']=='Yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_vod2" class="bg-success">Portal 2<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="success" name="btn_vod2" id="btn_vod2" value="Yes" <?=$json['btn_vod2']=='Yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_vod3" class="bg-warning">Portal 3<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="warning" name="btn_vod3" id="btn_vod3" value="Yes" <?=$json['btn_vod3']=='Yes'?'checked':'' ?>>
												<br></label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_vod4" class="bg-danger">Portal 4<br>
												  <input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="danger" name="btn_vod4" id="btn_vod4" value="Yes" <?=$json['btn_vod4']=='Yes'?'checked':'' ?>>
												  <br></label>
											  </div>
											  <div class="material-switch form-check-inline">
											<label for="btn_vod5" class="bg-secondary">Portal 5<br>
												  <input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="secondary" name="btn_vod5" id="btn_vod5" value="Yes" <?=$json['btn_vod5']=='Yes'?'checked':'' ?>>
												  <br></label>
											  </div>
										</div>
									</div>

									<hr>
									
									<div class="form-group form-float form-group-lg">
										<label class="form-label" for="btn_series">
											Show <strong>Series</strong> Icon?
										</label>
										<div class="form-line">
											<div class="material-switch form-check-inline">
											<label for="btn_series" class="bg-info">Portal 1<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="info" name="btn_series" id="btn_series" value="Yes" <?=$json['btn_series']=='Yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_series2" class="bg-success">Portal 2<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="success" name="btn_series2" id="btn_series2" value="Yes" <?=$json['btn_series2']=='Yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_series3" class="bg-warning">Portal 3<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="warning" name="btn_series3" id="btn_series3" value="Yes" <?=$json['btn_series3']=='Yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_series4" class="bg-danger">Portal 4<br>
												  <input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="danger" name="btn_series4" id="btn_series4" value="Yes" <?=$json['btn_series4']=='Yes'?'checked':'' ?>>
												  <br></label>
											  </div>
											  <div class="material-switch form-check-inline">
											<label for="btn_series5" class="bg-secondary">Portal 5<br>
												  <input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="secondary" name="btn_series5" id="btn_series5" value="Yes" <?=$json['btn_series5']=='Yes'?'checked':'' ?>>
												  <br></label>
											  </div>
										</div>
									</div>

									<hr>
									
									<div class="form-group form-float form-group-lg">
										<label class="form-label" for="btn_catchup">
											Show <strong>Catchup</strong> Icon?
										</label>
										<div class="form-line">
											<div class="material-switch form-check-inline">
											<label for="btn_catchup" class="bg-info">Portal 1<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="info" name="btn_catchup" id="btn_catchup" value="Yes" <?=$json['btn_catchup']=='Yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_catchup2" class="bg-success">Portal 2<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="success" name="btn_catchup2" id="btn_catchup2" value="Yes" <?=$json['btn_catchup2']=='Yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_catchup3" class="bg-warning">Portal 3<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="warning" name="btn_catchup3" id="btn_catchup3" value="Yes" <?=$json['btn_catchup3']=='Yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_catchup4" class="bg-danger">Portal 4<br>
												  <input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="danger" name="btn_catchup4" id="btn_catchup4" value="Yes" <?=$json['btn_catchup4']=='Yes'?'checked':'' ?>>
												  <br></label>
											  </div>
											  <div class="material-switch form-check-inline">
											<label for="btn_catchup5" class="bg-secondary">Portal 5<br>
												  <input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="secondary" name="btn_catchup5" id="btn_catchup5" value="Yes" <?=$json['btn_catchup5']=='Yes'?'checked':'' ?>>
												  <br></label>
											  </div>
											  
										</div>
									</div>

									<hr>
									
									<div class="form-group form-float form-group-lg">
										<label class="form-label" for="btn_radio">
											Show <strong>Radio</strong> Icon?
										</label>
										<div class="form-line">
											<div class="material-switch form-check-inline">
											<label for="btn_radio" class="bg-info">Portal 1<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="info" name="btn_radio" id="btn_radio" value="Yes" <?=$json['btn_radio']=='Yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_radio2" class="bg-success">Portal 2<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="success" name="btn_radio2" id="btn_radio2" value="Yes" <?=$json['btn_radio2']=='Yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_radio3" class="bg-warning">Portal 3<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="warning" name="btn_radio3" id="btn_radio3" value="Yes" <?=$json['btn_radio3']=='Yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_radio4" class="bg-danger">Portal 4<br>
												  <input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="danger" name="btn_radio4" id="btn_radio4" value="Yes" <?=$json['btn_radio4']=='Yes'?'checked':'' ?>>
												  <br></label>
											  </div>
											  <div class="material-switch form-check-inline">
											<label for="btn_radio5" class="bg-secondary">Portal 5<br>
												  <input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="secondary" name="btn_radio5" id="btn_radio5" value="Yes" <?=$json['btn_radio5']=='Yes'?'checked':'' ?>>
												  <br></label>
											  </div>
										</div>
									</div>

									<hr>
									
									<div class="form-group form-float form-group-lg">
										<label class="form-label" for="ms">
											Show <strong>Multi-Screens</strong> Icon?
										</label>
										<div class="form-line">
											<div class="material-switch form-check-inline">
											<label for="ms" class="bg-info">Portal 1<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="info" name="ms" id="ms" value="yes" <?=$json['ms']=='yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="ms2" class="bg-success">Portal 2<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="success" name="ms2" id="ms2" value="yes" <?=$json['ms2']=='yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="ms3" class="bg-warning">Portal 3<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="warning" name="ms3" id="ms3" value="yes" <?=$json['ms3']=='yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="ms4" class="bg-danger">Portal 4<br>
												  <input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="danger" name="ms4" id="ms4" value="yes" <?=$json['ms4']=='yes'?'checked':'' ?>>
												  <br></label>
											  </div>
											  <div class="material-switch form-check-inline">
											<label for="ms5" class="bg-secondary">Portal 5<br>
												  <input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="secondary" name="ms5" id="ms5" value="yes" <?=$json['ms5']=='yes'?'checked':'' ?>>
												  <br></label>
											  </div>
										</div>
									</div>

									<hr>
									
									<div class="form-group form-float form-group-lg">
										<label class="form-label" for="btn_fav">
											Show <strong>Favorite</strong> Icon?
										</label>
										<div class="form-line">
											<div class="material-switch form-check-inline">
											<label for="btn_fav" class="bg-info">Portal 1<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="info" name="btn_fav" id="btn_fav" value="yes" <?=$json['btn_fav']=='yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_fav2" class="bg-success">Portal 2<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="success" name="btn_fav2" id="btn_fav2" value="yes" <?=$json['btn_fav2']=='yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_fav3" class="bg-warning">Portal 3<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="warning" name="btn_fav3" id="btn_fav3" value="yes" <?=$json['btn_fav3']=='yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_fav4" class="bg-danger">Portal 4<br>
												  <input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="danger" name="btn_fav4" id="btn_fav4" value="yes" <?=$json['btn_fav4']=='yes'?'checked':'' ?>>
												  <br></label>
											  </div>
											  <div class="material-switch form-check-inline">
											<label for="btn_fav5" class="bg-secondary">Portal 5<br>
												  <input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="secondary" name="btn_fav5" id="btn_fav5" value="yes" <?=$json['btn_fav5']=='yes'?'checked':'' ?>>
												  <br></label>
											  </div>
										</div>
									</div>

									<hr>
									
									<div class="form-group form-float form-group-lg">
										<label class="form-label" for="btn_account">
											Show <strong>Account</strong> Icon?
										</label>
										<div class="form-line">
											<div class="material-switch form-check-inline">
											<label for="btn_account" class="bg-info">Portal 1<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="info" name="btn_account" id="btn_account" value="yes" <?=$json['btn_account']=='yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_account2" class="bg-success">Portal 2<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="success" name="btn_account2" id="btn_account2" value="yes" <?=$json['btn_account2']=='yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_account3" class="bg-warning">Portal 3<br>
												<input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="warning" name="btn_account3" id="btn_account3" value="yes" <?=$json['btn_account3']=='yes'?'checked':'' ?>>
												</label>
											</div>
											<div class="material-switch form-check-inline">
											<label for="btn_account4" class="bg-danger">Portal 4<br>
												  <input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="danger" name="btn_account4" id="btn_account4" value="yes" <?=$json['btn_account4']=='yes'?'checked':'' ?>>
												  <br></label>
											  </div>
											  <div class="material-switch form-check-inline">
											<label for="btn_account5" class="bg-secondary">Portal 5<br>
												  <input type="checkbox" data-toggle="switchbutton" data-width="25" data-onstyle="secondary" name="btn_account5" id="btn_account5" value="yes" <?=$json['btn_account5']=='yes'?'checked':'' ?>>
												  <br></label>
											  </div>
										</div>
									</div>

									<hr>

									<div class="form-group form-float form-group-lg">
										<center>
											<button class="btn btn-info" name="submit_app_custom" type="submit">
												<i class="icon icon-check"></i>Update Icons
											</button>
										</center>
									</div>
								</form>
							</div>
						</center>
					</div>
				</div>
			</div>
				<div class="card-body">
					<div class="card bg-primary text-white">
						<div class="card-header card-header-warning">
							<center>
								<h2><i class="icon icon-sliders"></i> Extra Interface Options</h2>
							</center>
						</div>
						<div class="card-body">

							<form method="post">
								<div class="form-group form-float form-group-lg">
									<label class="form-label" for="btn_pr" >Show Reminders Button</label>
									<select class="form-control" id="select" name="btn_pr">
										<option value="yes" <?=$json['btn_pr']=='yes'?'selected':'' ?> >Enabled</option>
										<option value="no" <?=$json['btn_pr']=='no'?'selected':'' ?> >Disabled</option>
									</select>								 
								</div>

								<div class="form-group form-float form-group-lg">
									<label class="form-label" for="btn_rec" >Show Record Button</label>
									<select class="form-control" id="select" name="btn_rec">
										<option value="yes" <?=$json['btn_rec']=='yes'?'selected':'' ?>>Enabled</option>
										<option value="no" <?=$json['btn_rec']=='no'?'selected':'' ?>>Disabled</option>
									</select>								 
								</div>

								<div class="form-group form-float form-group-lg">
									<label class="form-label" for="btn_vpn" >Show VPN Button</label>
									<select class="form-control" id="select" name="btn_vpn">
										<option value="yes" <?=$json['btn_vpn']=='yes'?'selected':'' ?>>Enabled</option>
										<option value="no" <?=$json['btn_vpn']=='no'?'selected':'' ?>>Disabled</option>
									</select>								 
								</div>

								<div class="form-group form-float form-group-lg">
									<label class="form-label" for="btn_noti" >Show Message Button</label>
									<select class="form-control" id="select" name="btn_noti">
										<option value="yes" <?=$json['btn_noti']=='yes'?'selected':'' ?>>Enabled</option>
										<option value="no" <?=$json['btn_noti']=='no'?'selected':'' ?>>Disabled</option>
									</select>								 
								</div>

								<div class="form-group form-float form-group-lg">
									<label class="form-label" for="btn_update" >Show Update Button</label>
									<select class="form-control" id="select" name="btn_update">
										<option value="yes" <?=$json['btn_update']=='yes'?'selected':'' ?>>Enabled</option>
										<option value="no" <?=$json['btn_update']=='no'?'selected':'' ?>>Disabled</option>
									</select>								 
								</div>

								<div class="form-group form-float form-group-lg">
									<label class="form-label" for="show_expire" >Show Sub Expiry</label>
									<select class="form-control" id="select" name="show_expire">
										<option value="yes" <?=$json['show_expire']=='yes'?'selected':'' ?>>Enabled</option>
										<option value="no" <?=$json['show_expire']=='no'?'selected':'' ?>>Disabled</option>
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