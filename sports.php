<?php
//db call
$db = new SQLite3('./api/sports.db');

//table name
$table_name = "sports";

//current file var
$base_file = basename($_SERVER["SCRIPT_NAME"]);

//create if not
$db->exec("CREATE TABLE IF NOT EXISTS {$table_name}(id INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL, header_n TEXT, border_c TEXT, background_c TEXT, text_c TEXT, days TEXT, auto_s TEXT)");

$rows = $db->query("SELECT COUNT(*) as count FROM {$table_name}");
$row = $rows->fetchArray();
$numRows = $row['count'];
if ($numRows == 0)
{
	$db->exec("INSERT INTO {$table_name}(id, header_n, border_c, background_c, text_c, days, auto_s) VALUES('1', 'Event', '#000000', '#000000', '#ffffff', '3', '1')");
}

//update call
@$resU = $db->query("SELECT * FROM {$table_name} WHERE id='1'");
@$rowU=$resU->fetchArray();
if(isset($_POST['submit'])){
	$db->exec("UPDATE {$table_name} SET header_n='".$_POST['header_n']."',
										border_c='".$_POST['border_c']."', 
										background_c='".$_POST['background_c']."', 
										text_c='".$_POST['text_c']."',
										days='".$_POST['days']."',
										auto_s='".$_POST['auto_s']."'
									WHERE 
										id='1'");
	$db->close();
	header("Location: {$base_file}");
}

include ('includes/header.php');
?>

		<div class="col-md-6 mx-auto">
			<div class="card-body">
				<div class="card bg-primary text-white">
					<div class="card-header">
						<center>
							<h2><i class="icon icon-wrench"></i> Sports Events</h2>
						</center>
					</div>
					<div class="card-body">
							<form method="post">

								<div class="form-group ">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Header Name</label>
										<input class="form-control" name="header_n" value="<?=$rowU['header_n']?>" type="text"/>
									</div>
								</div>

								<div class="form-group ">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Border</label>
										<input class="form-control" name="border_c" value="<?=$rowU['border_c']?>" type="color"/>
									</div>
								</div>

								<div class="form-group ">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Background Color</label>
										<input class="form-control" name="background_c" value="<?=$rowU['background_c']?>" type="color"/>
									</div>
								</div>

								<div class="form-group ">
									<div class="form-line">
										<label class="form-group form-float form-group-lg">Text Color</label>
										<input class="form-control" name="text_c" value="<?=$rowU['text_c']?>" type="color"/>
									</div>
								</div>

								<div class="form-group ">
									<div class="form-line">
									  <label class="form-group form-float form-group-lg">Days</label>
									  <select class="form-control" id="select" name="days">
										  <option value="1" <?=$rowU['days']=='1'?'selected':'' ?>>1</option>
										  <option value="3" <?=$rowU['days']=='3'?'selected':'' ?>>3</option>
										  <option value="7" <?=$rowU['days']=='7'?'selected':'' ?>>7</option>
									  </select>
									</div>
								</div>
				  
								<div class="form-group ">
									<div class="form-line">
									  <label class="form-group form-float form-group-lg">Auto Scroll</label>
									  <select class="form-control" id="select" name="auto_s">
										  <option value="0" <?=$rowU['auto_s']=='0'?'selected':'' ?>>No</option>
										  <option value="1" <?=$rowU['auto_s']=='1'?'selected':'' ?>>Yes</option>
									  </select>
									</div>
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