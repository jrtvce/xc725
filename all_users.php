<?php

$db1 = new SQLite3('./api/user_logs.db');
$db1->exec('CREATE TABLE IF NOT EXISTS logging(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, appid TEXT, version TEXT, device TEXT, pkg TEXT, app TEXT, cid TEXT, uid TEXT, status TEXT, d TEXT, time TEXT, last_online TEXT, ping TEXT, IP TEXT)');


if (isset($_GET['delete'])) {
	$db1->exec('DELETE FROM logging WHERE id=' . $_GET['delete']);
	header('Location: all_users.php');
}

include 'includes/header.php';

?>
<style>
div.dataTables_length label, div.dataTables_length select, div.dataTables_filter label, #table_id_info {
  color: #fff;
}

div.dataTables_length select option	 {
	background: #000
}
</style>
		<div class="col-md-12 mx-auto">
			<div class="card-body">
				<div class="card bg-primary text-white">
					<div class="card-header card-header-warning">
						<center>
						<?php if (isset($_GET['o'])){ ?>
							<h2><i class="icon icon-commenting"></i> Users Connected</h2>
						<?php }else{ ?>
							<h2><i class="icon icon-commenting"></i> All Users</h2>
						<?php } ?>
						</center>
					</div>

					<div class="card-body">
						<div class="col-12">
							<center>
								<h1 class=" h3 mb-1 text-gray-800"> <?=$numRows_count . ' Online Users' ?></h1>
								<?php if (isset($_GET['o'])){ ?>
								<a button class="btn btn-warning btn-icon-split" id="button" href="all_users.php">
									<span class="icon text-white-50"><i class="fa fa-user"></i></span>&nbsp;&nbsp;<span class="text">All Users</span>
								</button></a>
								<?php }else{ ?>
									<a button class="btn btn-warning btn-icon-split" id="button" href="all_users.php?o">
									<span class="icon text-white-50"><i class="fa fa-user"></i></span>&nbsp;&nbsp;<span class="text">Users Connected </span>
								</button></a>
								<?php } ?>
							</center>
						</div>

						<hr>

						<div class="table-responsive">
							<table id="table_id" class="table table-striped table-sm">
							<thead style="color:white!important">
								<tr>
								<th>User ID</th>
								<th>IP Address</th>
								<th>Online</th>
								<th>Last Online</th>
								<th>App ID</th>
								<th>Version</th>
								<th>Device</th>
								<th>Package Name</th>
								<th>App Name</th>
								<th>Customer ID</th>
								<th>First Registered</th>
								<th>Last Connection</th>
								<th>Delete</th>
								</tr>
							</thead>
							<?php 
							if (isset($_GET['o'])){
								$res = $db1->query("SELECT * FROM logging WHERE status='yes'");
							}else{
								$res = $db1->query("SELECT * FROM logging");
							}
							while ($row = $res->fetchArray()) {?>
							<tbody>
								<tr>
								<td><?=$row['uid']?></td>
								<td><?=$row['IP']?></td>
								<td><center><span class="icon text-white-50"><i class="fas fa-fw fa fa-times"style="font-size:20px;color:<?=$row['status']=='Yes'?'green':'red' ?>"></i></span></td>
								<td><?=$row['last_online']?></td>
								<td><?=$row['appid']?></td>
								<td><?=$row['version']?></td>
								<td><?=$row['device']?></td>
								<td><?=$row['pkg']?></td>
								<td><?=$row['app']?></td>
								<td><?=$row['cid']?></td>
								<td><?=$row['time']?></td>
								<td><?=$row['ping']?></td>
								<td><a class="btn btn-danger btn-ok" href="#" data-href="./<?=$base_file ?>?delete=<?=$row['id'] ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a></td>
								</tr>
							</tbody>
							<?php }?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php include ('includes/footer.php');?>
<script>
$(document).ready( function () {
	$('#table_id').DataTable({
					"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
					"filter": true,
					"Paginate": true,
					"ordering": false,
				});
} );
</script>
</body>
</html>