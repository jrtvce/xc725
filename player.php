<?php
$jsondata = file_get_contents("./api/main.json");
$arrayData = json_decode($jsondata, true);
$json = $arrayData['app'];

if (isset($_POST['submit'])){
	$replacementData = array(
		'app' => array(
			'player' => $_POST["player"],
			'player_tv' => $_POST["player_tv"],
			'player_vod' => $_POST["player_vod"],
			'player_series' => $_POST["player_series"]
		)
	);
	$newArrayData = array_replace_recursive($arrayData, $replacementData);
	$newJsonData = json_encode($newArrayData, JSON_PRETTY_PRINT);
	file_put_contents("./api/main.json", $newJsonData);
	header("Location: ". basename($_SERVER["SCRIPT_NAME"])."?status=1");
}

include ('includes/header.php');
?>


		<div class="col-md-8 mx-auto">
			<div class="card-body">
				<div class="card bg-primary text-white">
					<div class="card-header card-header-warning">
						<center>
							<h2><i class="icon icon-play-circle"></i> Player Selection</h2>
						</center>
					</div>
					<div class="card-body">
						<form method="post">
							<div class="form-group ">
								<label class="form-label">Choose Live video player</label>
								<select class="form-control" id="select" name="player">
									<option value="EXO" <?=$json['player']=='EXO'?'selected':'' ?>>EXO Player</option>
									<option value="VLC" <?=$json['player']=='VLC'?'selected':'' ?>>VLC Player</option>
								</select>			
							</div>

							<div class="form-group ">
								<label class="form-label">Choose EPG video player</label>
								<select class="form-control" id="select" name="player_tv">
									<option value="EXO" <?=$json['player_tv']=='EXO'?'selected':'' ?>>EXO Player</option>
									<option value="VLC" <?=$json['player_tv']=='VLC'?'selected':'' ?>>VLC Player</option>
								</select>			
							</div>

							<div class="form-group ">
								<label class="form-label">Choose VOD video player</label>
								<select class="form-control" id="select" name="player_vod">
									<option value="EXO" <?=$json['player_vod']=='EXO'?'selected':'' ?>>EXO Player</option>
									<option value="VLC" <?=$json['player_vod']=='VLC'?'selected':'' ?>>VLC Player</option>
								</select>			
							</div>

							<div class="form-group ">
								<label class="form-label">Choose Series video player</label>
								<select class="form-control" id="select" name="player_series">
									<option value="EXO" <?=$json['player_series']=='EXO'?'selected':'' ?>>EXO Player</option>
									<option value="VLC" <?=$json['player_series']=='VLC'?'selected':'' ?>>VLC Player</option>
								</select>			
							</div>

							<hr>

							<div class="form-group">
								<center>
								  <button class="btn btn-info" name="submit" type="submit">
									  <i class="icon icon-check"></i> Update Players
								  </button>
								</center>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>


<?php include ('includes/footer.php');?>

</body>
</html>