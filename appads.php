<?php
$jsondata = file_get_contents("./api/main.json");
$data = json_decode($jsondata, true);
$json = $data['app'];

if (isset($_POST['submit'])){
	$jsonData = file_get_contents("./api/main.json");
	$arrayData = json_decode($jsonData, true);
	$replacementData = array(
		'app' => array(
			'admob_banner_id' => $_POST["admob_banner_id"],
			'admob_interstitial_id' => $_POST["admob_interstitial_id"]
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
					<div class="card-header">
						<center>
							<h2><i class="icon icon-money"></i> In-app Advertisements</h2>
						</center>
					</div>
					<div class="alert alert-info alert-dismissible" role="alert">
						<center>
							Earm more with your app. Click <a href="https://apps.admob.com/signup/" style="color:green!important;">here</a>
							to get more information.
						</center>
					</div>
					<div class="card-body">
							<form method="post">
								<div class="form-group form-float form-group-lg">
									<label class="form-label" for="admob_banner_id" >Admob Banner ID</label>
									<select class="form-control" id="select" name="admob_banner_id">
										<option value="yes"<?=$json['admob_banner_id']=='yes'?'selected':'' ?>>Enabled</option>
										<option value="no" <?=$json['admob_banner_id']=='no'?'selected':'' ?>>Disabled</option>
									</select>								 
								</div>

								<div class="form-group form-float form-group-lg">
									<label class="form-label" for="admob_interstitial_id" >Admob Interstitial ID</label>
									<select class="form-control" id="select" name="admob_interstitial_id">
										<option value="yes"<?=$json['admob_interstitial_id']=='yes'?'selected':'' ?>>Enabled</option>
										<option value="no" <?=$json['admob_interstitial_id']=='no'?'selected':'' ?>>Disabled</option>
									</select>								 
								</div>

								<hr>

								<div class="form-group">
									<center>
										<button class="btn btn-info" name="submit" type="submit">
											<i class="icon icon-check"></i> Update Adverts
										</button>
									</center>
								</div>
							</form>
					</div>
				</div>
			</div>
		</div>


<?php include ('includes/footer.php'); ?>

</body>
</html>