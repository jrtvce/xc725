<?php
$jsondata = file_get_contents("./api/main.json");
$arrayData = json_decode($jsondata, true);
$json = $arrayData['app'];

if (isset($_POST['submit'])){
	$replacementData = array(
		'app' => array(
			'mnt_status' => $_POST["mnt_status"],
			'mnt_message' => $_POST["mnt_message"],
			'mnt_expire' => $_POST["mnt_expire"]
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
							<h2><i class="icon icon-wrench"></i> Maintenance</h2>
						</center>
					</div>
					<div class="card-body">
							<form method="post">
								<div class="form-group ">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Reason for Maintenance</label>
										<input class="form-control" id="description" name="mnt_message" value="<?=$json['mnt_message']?>" type="text"/>
									</div>
								</div>

								<div class="form-group ">
									<div class="form-line">
									  <label class="form-group form-float form-group-lg">Current Status</label>
									  <select class="form-control" id="select" name="mnt_status">
										  <option value="INACTIVE" <?=$json['mnt_status']=='INACTIVE'?'selected':'' ?>>INACTIVE</option>
										  <option value="ACTIVE" <?=$json['mnt_status']=='ACTIVE'?'selected':'' ?>>ACTIVE</option>
									  </select>
									</div>
								</div>
				  
								<div class="form-group">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Maintenance End Date</label>
										<input type="text" readonly id="form_datetime"	autocomplete="off" class="date-time-picker form-control" name="mnt_expire" placeholder="YYYY-MM-DD HH:MM:SS" value="<?=$json['mnt_expire'] ?>"/>
									<div class="input-group focused">
								</div>

								<hr>

								<div class="form-group">
									<center>
										<button class="btn btn-info" name="submit" type="submit">
											<i class="icon icon-check"></i> Update Status
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