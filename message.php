<?php
//db call
$db = new SQLite3('./api/user_message.db');

//table name
$table_name = "messages";

//current file var
$base_file = basename($_SERVER["SCRIPT_NAME"]);

//create if not
$db->exec("CREATE TABLE IF NOT EXISTS {$table_name}(id INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL, message VARCHAR(100), userid TEXT, status TEXT, expire TEXT)");

//table call
$res = $db->query("SELECT * FROM {$table_name}");

//update call
@$resU = $db->query("SELECT * FROM {$table_name} WHERE id='".$_GET['update']."'");
@$rowU=$resU->fetchArray();
if(isset($_POST['submitU'])){
	$db->exec("UPDATE {$table_name} SET message='".$_POST['message']."',
										userid='".$_POST['userid']."', 
										status='".$_POST['status']."', 
										expire='".$_POST['expire']."'
									WHERE 
										id='".$_GET['update']."'");
	$db->close();
	header("Location: {$base_file}");
}

//submit new
if (isset($_POST['submit'])){
	
	$db->exec("INSERT INTO {$table_name}(message, userid, status, expire) VALUES('".$_POST['message']."', '".$_POST['userid']."', '".$_POST['status']."', '".$_POST['expire']."')");
	header("Location: {$base_file}");
	}

//delete row
if(isset($_GET['delete'])){
	$db->exec("DELETE FROM {$table_name} WHERE id=".$_GET['delete']);
	header("Location: ". basename($_SERVER["SCRIPT_NAME"])."?status=1");
}

include ('includes/header.php');

//delete modal
?>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Confirm</h2>
            </div>
            <div class="modal-body">
                Do you really want to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_GET['create'])){

//create form
?>
        <div class="col-md-8 mx-auto">
            <div class="card-body">
                <div class="card bg-primary text-white">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-commenting"></i> User Messages</h2>
                        </center>
                    </div>

                    <div class="card-body">
                        <div class="col-12">
                            <h3>Create Message</h3>
                        </div>
                            <form method="post">
                                <div class="form-group">
                                    <label class="form-label " for="message">Message</label>
                                        <input class="form-control" id="description" name="message" placeholder="Message" value='' type="text"/>

                                </div>
                                <div class="form-group">
                                    <label class="form-label " for="userid">Username</label>
                                        <input class="form-control" id="description" name="userid" placeholder="Username" value='' type="text"/>

                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="status">Status</label>
                                    <select class="select form-control" id="select" name="status">
                                        <option value="ACTIVE">ACTIVE</option>
                                        <option value="INACTIVE">INACTIVE</option>
                                    </select>

                                </div>
                                <div class="form-group ">
                                    <label class="form-label" for="message">Expiration </label>
									<input type="text" autocomplete="off" readonly id="form_datetime"  autocomplete="off" class="date-time-picker form-control" name="expire" placeholder="YYYY-MM-DD HH:MM:SS"/>
                                </div>

                                <div class="form-group">
                                    <center>
                                        <button class="btn btn-info " name="submit" type="submit">
                                            <i class="icon icon-check"></i> Submit
                                        </button>
                                    </center>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

<?php 
}else if (isset($_GET['update'])){ 

//update form
?>
        <div class="col-md-8 mx-auto">
            <div class="card-body">
                <div class="card bg-primary text-white">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-bullhorn"></i> User Messages</h2>
                        </center>
                    </div>
                    
                    <div class="card-body">
                        <div class="col-12">
                            <h3>Edit Message</h3>
                        </div>
                            <form method="post">
                                <div class="form-group">
                                    <label class="form-label " for="message">Message</label>
                                        <input class="form-control" id="description" name="message" placeholder="Message" value="<?=$rowU['message'] ?>" type="text"/>

                                </div>
                                <div class="form-group">
                                    <label class="form-label " for="userid">Username</label>
                                        <input class="form-control" id="description" name="userid" placeholder="Username" value="<?=$rowU['userid'] ?>" type="text"/>

                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="status">Status</label>
                                    <select class="select form-control" id="select" name="status">
                                        <option value="ACTIVE" <?=$rowU['status']=='INACTIVE'?'selected':'' ?>>ACTIVE</option>
                                        <option value="INACTIVE" <?=$rowU['status']=='INACTIVE'?'selected':'' ?>>INACTIVE</option>
                                    </select>

                                </div>
                                <div class="form-group ">
                                    <label class="form-label" for="message">Expiration </label>
									<input type="text" autocomplete="off" readonly id="form_datetime" value="<?=$rowU['expire'] ?>" autocomplete="off" class="date-time-picker form-control" name="expire" placeholder="YYYY-MM-DD HH:MM:SS"/>
                                </div>

                                <div class="form-group">
                                    <center>
                                        <button class="btn btn-info " name="submitU" type="submit">
                                            <i class="icon icon-check"></i> Submit
                                        </button>
                                    </center>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
<?php
 }else{
//main table/form
	 ?>
        <div class="col-md-12 mx-auto">
            <div class="card-body">
                <div class="card bg-primary text-white">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-commenting"></i> Send Messages</h2>
                        </center>
                    </div>

                    <div class="card-body">
                        <div class="col-12">
                        	<center>
	        					<a id="button" href="./<?php echo $base_file ?>?create" class="btn btn-info">New Message</a>
	        				</center>
    					</div>

    					<hr>

						<div class="table-responsive">
							<table class="table table-striped table-sm">
							<thead style="color:white!important">
								<tr>
								<th>Index</th>
								<th>Username</th>
								<th>Message</th>
								<th>Status</th>
								<th>Expire</th>
								<th>Edit&nbsp&nbsp&nbspDelete</th>
								</tr>
							</thead>
							<?php while ($row = $res->fetchArray()) {?>
							<tbody>
								<tr>
								<td><?=$row['id'] ?></td>
								<td><?=$row['userid'] ?></a></td>
								<td><?=$row['message'] ?></td>
								<td><?=$row['status'] ?></td>
								<td><?=$row['expire'] ?></td>
								<td>
								<a class="btn btn-info btn-ok" href="./<?php echo $base_file ?>?update=<?=$row['id'] ?>"><i class="fa fa-pencil-square-o"></i></a>
								&nbsp&nbsp&nbsp
								<a class="btn btn-danger btn-ok" href="#" data-href="./<?php echo $base_file ?>?delete=<?=$row['id'] ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
								</td>
								</tr>
							</tbody>
							<?php }?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php }?>

<?php include ('includes/footer.php');?>

</body>
</html>