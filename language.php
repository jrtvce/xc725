<?php
$jsondata = file_get_contents("./api/main.json");
$arrayData = json_decode($jsondata, true);
$json = $arrayData['app'];
if (isset($_POST['submit'])){
	$replacementData = array(
		'app' => array(
			'language' => $_POST["language"],
			'app_language' => $_POST["app_language"]
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
			<center>
				<div class="card-body">
					<div class="card bg-primary text-white">
						<div class="card-header card-header-warning">
							<center>
								<h2><i class="icon icon-globe"></i> Language Selection</h2>
							</center>
						</div>
						<div class="card-body">
								<div class="col-12">
								  <h3> Languages Available</h3>
								</div>
								<form method="post">
									<div class="form-group ">
										<label class="form-label" for="app_language" >Pick Your App Language</label>
										<select class="form-control" id="select" name="app_language">
											<option value="en" <?=$json['app_language']=='en'?'selected':'' ?>>English</option>
											<option value="ar" <?=$json['app_language']=='ar'?'selected':'' ?>>Arabic</option>
											<option value="bn" <?=$json['app_language']=='bn'?'selected':'' ?>>Bengali</option>
											<option value="zh" <?=$json['app_language']=='zh'?'selected':'' ?>>Chinese</option>
											<option value="fr" <?=$json['app_language']=='fr'?'selected':'' ?>>French</option>
											<option value="hi" <?=$json['app_language']=='hi'?'selected':'' ?>>Hindi</option>
											<option value="it" <?=$json['app_language']=='it'?'selected':'' ?>>Italian</option>
											<option value="ml" <?=$json['app_language']=='ml'?'selected':'' ?>>Malayalam</option>
											<option value="pt" <?=$json['app_language']=='pt'?'selected':'' ?>>Portugese</option>
											<option value="es" <?=$json['app_language']=='es'?'selected':'' ?>>Spanish</option>
											<option value="ru" <?=$json['app_language']=='ru'?'selected':'' ?>>Russian</option>
											<option value="sv" <?=$json['app_language']=='sv'?'selected':'' ?>>Swedish</option>
										</select>
									</div>

									<div class="form-group ">
									  <label class="form-label" for="language" >Pick Your Language</label>
										<select class="form-control" id="select" name="language">
											<option value="en" <?=@$json['language']=='en'?'selected':'' ?>>English</option>
											<option value="ar" <?=@$json['language']=='ar'?'selected':'' ?>>Arabic</option>
											<option value="bn" <?=@$json['language']=='bn'?'selected':'' ?>>Bengali</option>
											<option value="zh" <?=@$json['language']=='zh'?'selected':'' ?>>Chinese</option>
											<option value="fr" <?=@$json['language']=='fr'?'selected':'' ?>>French</option>
											<option value="hi" <?=@$json['language']=='hi'?'selected':'' ?>>Hindi</option>
											<option value="it" <?=@$json['language']=='it'?'selected':'' ?>>Italian</option>
											<option value="ml" <?=@$json['language']=='ml'?'selected':'' ?>>Malayalam</option>
											<option value="pt" <?=@$json['language']=='pt'?'selected':'' ?>>Portugese</option>
											<option value="es" <?=@$json['language']=='es'?'selected':'' ?>>Spanish</option>
											<option value="ru" <?=@$json['language']=='ru'?'selected':'' ?>>Russian</option>
											<option value="sv" <?=@$json['language']=='sv'?'selected':'' ?>>Swedish</option>
										</select>
									</div>

									<hr>

									<div class="form-group">
									  <center>
										  <button class="btn btn-info" name="submit" type="submit">
											  <i class="icon icon-check"></i> Submit
										  </button>
									  </center>
									</div>
								</form>
						</div>
					</div>
				</div>
			</center>
		</div>


<?php include ('includes/footer.php');?>

</body>
</html>
