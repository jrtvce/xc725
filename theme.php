<?php
$jsondata = file_get_contents("./api/main.json");
$arrayData = json_decode($jsondata, true);
$json = $arrayData['app'];
if (isset($_POST['submit'])){
	$replacementData = array(
		'app' => array(
			'theme' => $_POST["theme"],
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
					 <h2><i class="icon icon-play-circle"></i> Theme Selection</h2>
				  </center>
			   </div>
			   <div class="card-body">
				  <form method="post">
					 <div class="form-group ">
						<label class="form-label">Choose Theme</label>
						<select class="select form-control text-primary" id="select" name="theme">
						   <option value="theme_d" <?=$json['theme']=='theme_d'?'selected':'' ?>>Standard</span></option>
						   <option value="theme_1" <?=$json['theme']=='theme_1'?'selected':'' ?>>Theme 1</option>
						   <option value="theme_2" <?=$json['theme']=='theme_2'?'selected':'' ?>>Theme 2</option>
						   <option value="theme_3" <?=$json['theme']=='theme_3'?'selected':'' ?>>Theme 3</option>
						   <option value="theme_4" <?=$json['theme']=='theme_4'?'selected':'' ?>>Theme 4</option>
						   <option value="theme_5" <?=$json['theme']=='theme_5'?'selected':'' ?>>Theme 5</option>
						   <option value="theme_6" <?=$json['theme']=='theme_6'?'selected':'' ?>>Theme 6</option>
						</select>
					 </div>
					 <hr>
					 <div class="form-group">
						<center>
						   <button class="btn btn-info" name="submit" type="submit">
						   <i class="icon icon-check"></i> Set Theme
						   </button>
						</center>
					 </div>
				  </form>
			   </div>
			</div>
		 </div>
	  </div>
	  <div class="col-md-8 mx-auto">
		 <div class="row">
			<div class="center">
				  <div class="container">
					 <div class="row">
						<div class="col-sm-6">
						   <div class="card">
							  <div class="card-block">
								 <h4 class="card-title text-center card card bg-light text-primary">Standard</h4>
							  </div>
							  <img class="card-img-bottom" src="./img/d.jpg" alt="Card image" style="">
						   </div>
						</div>
						<div class="col-sm-6">
						   <div class="card">
							  <div class="card-block">
								 <h4 class="card-title text-center card card bg-light text-primary">Theme 1</h4>
							  </div>
							  <img class="card-img-bottom" src="./img/1.jpg" alt="Card image" style="width:100%">
						   </div>
						</div>
						<div class="col-sm-6">
						   <div class="card">
							  <div class="card-block">
								 <h4 class="card-title text-center card card bg-light text-primary">Theme 2</h4>
							  </div>
							  <img class="card-img-bottom" src="./img/2.jpg" alt="Card image" style="width:100%">
						   </div>
						</div>
						<div class="col-sm-6">
						   <div class="card">
							  <div class="card-block">
								 <h4 class="card-title text-center card card bg-light text-primary">Theme 3</h4>
							  </div>
							  <img class="card-img-bottom" src="./img/3.jpg" alt="Card image" style="width:100%">
						   </div>
						</div>
						<div class="container">
						   <div class="row">
							  <div class="col-sm-6">
								 <div class="card">
									<div class="card-block">
									   <h4 class="card-title text-center card card bg-light text-primary">Theme 4</h4>
									</div>
									<img class="card-img-bottom" src="./img/4.jpg" alt="Card image" style="width:100%">
								 </div>
							  </div>
							  <div class="col-sm-6">
								 <div class="card">
									<div class="card-block">
									   <h4 class="card-title text-center card card bg-light text-primary">Theme 5</h4>
									</div>
									<img class="card-img-bottom" src="./img/5.jpg" alt="Card image" style="width:100%">
								 </div>
							  </div>
						   </div>
						</div>
						<div class="container">
						   <div class="row">
							  <div class="col-sm-6">
								 <div class="card">
									<div class="card-block">
									   <h4 class="card-title text-center card card bg-light text-primary">Theme 6</h4>
									</div>
									<img class="card-img-bottom" src="./img/6.jpg" alt="Card image" style="width:100%">
								 </div>
							  </div>
						   </div>
						</div>
					 </div>
				  </div>
			  </div>
		  </div>
	  </div>
<br><br><br><br>
<?php include ('includes/footer.php');?>
</body>
</html>