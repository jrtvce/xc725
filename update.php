<?php
$jsondata = file_get_contents("./api/main.json");
$arrayData = json_decode($jsondata, true);
$json = $arrayData['app'];

if (isset($_POST['submit'])){
	$replacementData = array(
		'app' => array(
			'version_code' => $_POST["version_code"],
			'apkurl' => $_POST["apkurl"],
			'backupurl' => $_POST["backupurl"],
			'apkautoupdate' => $_POST["apkautoupdate"]
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
							<h2><i class="icon icon-cloud-upload"></i> Create Update</h2>
						</center>
					</div>
					<div class="card-body">
						<div class="form-group">
							<form method="post">
								<div class="form-group form-float form-group-lg">
									<label class="form-label">Current Application Build Nº</label>
									<div class="input-group">
										<input class="form-control" id="version_code" name="version_code" value="<?=$json['version_code']?>" type="text"/>
									</div>
								</div>

								<div class="form-group form-float form-group-lg">
									<label class="form-label">Foce Update Application</label>
									<select class="form-control" id="select" name="apkautoupdate">
										<option value="yes" <?=$json['apkautoupdate']=='yes'?'selected':'' ?>>Enabled</option>
										<option value="no" <?=$json['apkautoupdate']=='no'?'selected':'' ?>>Disabled</option>
									</select>
								</div>

								<div class="form-group form-float form-group-lg">
									<label class="form-label">Application Update URL (direct link)</label>
									<input type="text" class="form-control" name="apkurl" id="apkurl" value="<?=@$json['apkurl'] ?>">
								</div>

								<div class="form-group form-float form-group-lg">
									<label class="form-label">Application Backup URL (direct link)</label>
									<input type="text" class="form-control" name="backupurl" id="backupurl" value="<?=@$json['backup'] ?>">
								</div>

								<hr>

								<div class="form-group">
									<center>
										<button class="btn btn-info" name="submit" type="submit">
											<i class="icon icon-check"></i>Push Update
										</button>
									</center>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>


<?php include ('includes/footer.php');?>

</body>
</html>