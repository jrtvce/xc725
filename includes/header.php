<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['loggedin']))
{
	header("location:"."index.php");
	exit();
}
$db3 = new SQLite3('./api/user_logs.db');
$db3->exec('CREATE TABLE IF NOT EXISTS logging(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, appid TEXT, version TEXT, device TEXT, pkg TEXT, app TEXT, cid TEXT, uid TEXT, status TEXT, d TEXT, time TEXT, last_online TEXT, ping TEXT)');
$conn_count = new SQLite3('./api/user_logs.db');
$rows_count = $conn_count->query("SELECT COUNT(*) as count FROM logging WHERE status='yes'");
$row_count = $rows_count->fetchArray();
$numRows_count = $row_count['count'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="FTG">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="css/bootstrap-datetimepicker.css">
	<link href="css/themes/darkly/bootstrap.css" rel="stylesheet" title="main">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="css/simple-sidebar.css" rel="stylesheet">
	<link href="css/switch.css" rel="stylesheet" /> 
</head>

<body>
<style>
body{
  background-color: #181828;
  background-image: url("./img/particle_bg.jpg");
  color #fff;
}

#particles-js{
  background-size: cover;
  background-position: 50% 50%;
  background-repeat: no-repeat;
  /*width: 100%;
  height: 100vh;*/
  background: #8000FF;
  display: flex;
  justify-content: center;
  align-items: center;

}

.particles-js-canvas-el{
  position: fixed;
}
</style>
<div id="js-particles"></div>
  <div class="d-flex" id="wrapper">
	<!-- Sidebar -->
	<div class="" id="sidebar-wrapper">
	  <div class="sidebar-heading">XCIPTV 723</div>
	  <span><a class="list-grup-item" href="https://t.me/TheDonCrimini" target="_blank">&nbsp&nbsp&nbsp&nbsp&#169  <? echo date("Y")?> * The Don Panels * </a> </span></center>
	  <div class="list-group list-group-flush">
		<a class="list-group-item list-group-item-action " href="app.php">
		<i class="fa fa-cogs">&nbsp;&nbsp;</i>	General Settings </a>
		<a class="list-group-item list-group-item-action " href="interface.php">
		<i class="fa fa-sliders">&nbsp;&nbsp;</i>	Interface Settings </a>
		<a class="list-group-item list-group-item-action " href="vpn.php">
		<i class="fa fa-shield" >&nbsp;&nbsp;</i>  OVPN Settings </a>
		<a class="list-group-item list-group-item-action " href="theme.php">
		<i class="fa fa-image" >&nbsp;&nbsp;</i>  Theme Settings </a>
		<a class="list-group-item list-group-item-action " href="sports.php">
		<i class="fa fa-futbol-o" >&nbsp;&nbsp;</i>  Sports Schedule </a>
		<a class="list-group-item list-group-item-action " href="player.php">
		<i class="fa fa-play-circle" >&nbsp;&nbsp;</i>	Player Selection </a>
		<a class="list-group-item list-group-item-action " href="language.php">
		<i class="fa fa-globe" >&nbsp;&nbsp;</i>  Language Selection </a>
		<a class="list-group-item list-group-item-action " href="announcement.php">
		<i class="fa fa-bullhorn" >&nbsp;&nbsp;</i>	 In-app Announcement </a>
		<a class="list-group-item list-group-item-action " href="message.php">
		<i class="fa fa-commenting" >&nbsp;&nbsp;</i>  In-app Messages </a>
		<a class="list-group-item list-group-item-action " href="appads.php">
		<i class="fa fa-money" >&nbsp;&nbsp;</i>  In-app Advertisements </a>
		<a class="list-group-item list-group-item-action " href="parental_reset.php">
		<i class="fa fa-lock" >&nbsp;&nbsp;</i>	 Parental PIN Reset </a>
		<a class="list-group-item list-group-item-action " href="maintenance.php">
		<i class="fa fa-wrench" >&nbsp;&nbsp;</i>  Maintenance Mode </a>
		<a class="list-group-item list-group-item-action " href="update.php">
		<i class="fa fa-cloud-upload" >&nbsp;&nbsp;</i>	 Remote Update </a>
		<a class="list-group-item list-group-item-action " href="all_users.php">
		<i class="fa fa-users" >&nbsp;&nbsp;</i>  Connected Users </a>
		<a class="list-group-item list-group-item-action " href="user_update.php">
		<i class="fa fa-user" >&nbsp;&nbsp;</i>	 Update credentials </a>
	  </div>
	</div>
	<!-- /#sidebar-wrapper -->

	<!-- Page Content -->
	<div id="page-content-wrapper">


	  <nav class="navbar navbar-expand-lg navbar-dark ">

		<button class="btn btn-primary" id="menu-toggle"><img src="img/logo.png" width="25" height="25" class="d-flex justify-content-center text-allign centre" alt=""></button>
		
	  &nbsp;&nbsp;

		<div class="btn-group">
		<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Themes</button>
		<div class="dropdown-menu">
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="cerulean"><i class="fa fa-pencil"> Cerulean</i></a></li>      </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="cosmo"><i class="fa fa-pencil"> Cosmo</i></a></li>            </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="cyborg"><i class="fa fa-pencil"> Cyborg</i></a></li>          </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="darkly"><i class="fa fa-pencil"> Darkly (default)</i></a></li></strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="flatly"><i class="fa fa-pencil"> Flatly</i></a></li>          </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="journal"><i class="fa fa-pencil"> Journal</i></a></li>        </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="litera"><i class="fa fa-pencil"> Litera</i></a></li>          </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="lumen"><i class="fa fa-pencil"> Lumen</i></a></li>            </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="lux"><i class="fa fa-pencil"> Lux</i></a></li>                </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="materia"><i class="fa fa-pencil"> Materia</i></a></li>        </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="minty"><i class="fa fa-pencil"> Minty</i></a></li>            </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="pulse"><i class="fa fa-pencil"> Pulse</i></a></li>            </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="sandstone"><i class="fa fa-pencil"> Sandstone</i></a></li>    </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="simplex"><i class="fa fa-pencil"> Simplex</i></a></li>        </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="sketchy"><i class="fa fa-pencil"> Sketchy</i></a></li>        </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="slate"><i class="fa fa-pencil"> Slate</i></a></li>            </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="solar"><i class="fa fa-pencil"> Solar</i></a></li>            </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="spacelab"><i class="fa fa-pencil"> Spacelab</i></a></li>      </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="superhero"><i class="fa fa-pencil"> Superhero</i></a></li>    </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="united"><i class="fa fa-pencil"> United</i></a></li>          </strong></h5>
			<strong><h5><li><a href="#" class="change-style-menu-item" rel="yeti"><i class="fa fa-pencil"> Yeti</i></a></li>              </strong></h5>
		</div>
		</div>
		
		<a href="logout.php" class="btn btn-danger ml-auto mr-1">Logout</a>
	  </nav>



	  <div class="container-fluid"><br>


<?php

$message = '<div class="alert alert-success" id="success-alert"><center><h4 style="color:white!important"><i class="icon fa fa-check"></i>Updated!</h4></center></div>';
if(isset($_GET['status'])){
	if ($_GET['status'] == '1'){
		echo $message;
	}
}
?>