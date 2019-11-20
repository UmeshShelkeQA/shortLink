<?php
session_start();
require("library.php");
require("linkstat.php");
$userArr;
if(isset($_SESSION['user_id']))
{
	$obj=new LinkStat($_SESSION['user_id']);
	$userArr=$obj->ac_user_detail();
	//$name=$userArr['name'];
	//$email=$userArr['email'];
	//$no_of_url=$userArr['no_of_url'];
}
else{
	header("location:login.html");
}

?>
<html>
<head>
<!-- Site made with Mobirise Website Builder v4.10.0, #m -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.10.0, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/jellyfish-122x92.jpg" type="image/x-icon">
  <meta name="Dashboard" content="PowerFull Dashboard">
  
  <title>Profile</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css">
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/datatables/data-tables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  <style>
	th{
	width:10%;
	margin-left: 10%;
	margin-right: 10%;
	padding: 10px;
	margin-bottom: 5px;
	margin-top: 5%;
	font-weight: bold;
	font-size:150%;
	}
	td{
	width:10%;
	margin-left: 10%;
	margin-right: 10%;
	padding: 10px;
	margin-bottom: 5px;
	margin-top: 5%;
	font-weight: bold;
	font-size:100%;
	}
  </style>
</head>
<body style="background:lightgrey">
  <section class="menu cid-rxDDrIeH25" once="menu" id="menu1-5">

    

    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    
                         <img src="assets/images/jellyfish-122x92.jpg" alt="Mobirise" title="" style="height: 3.8rem;">
                    
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-white display-4" href="#">
                       PROFILE INFO</a></span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true"><li class="nav-item"><a class="nav-link link text-white display-4" href="contact_us.php"><span class="mbri-contact-form mbr-iconfont mbr-iconfont-btn"></span>Contact Us</a></li>
				<li class="nav-item"><a class="nav-link link text-white display-4" href="logout.php"><span class="mbrib-logout mbr-iconfont mbr-iconfont-btn"></span>Logout</a></li>
				<li class="nav-item">
                    <a class="nav-link link text-white display-4" href="profile.php"><span class="mbri-user mbr-iconfont mbr-iconfont-btn"><?php echo $userArr['name'];?></span></a>
                </li></ul>
            
        </div>
    </nav>
</section>

<section class="engine"></section><section class="features4 cid-rzCjScTTpw" id="features4-k" style="background:lightgrey">
    

    
    <div class="container" >
        <table width="100%" border=1 id="pc">
			<tr>
				<b><th>NAME</th></b>
			</tr>
			<tr>
				<td>&nbsp <input type="text" value="<?php echo $userArr['name'];?>" readonly style="background:lightgrey;border:none;font-size:150%;margin-top:-10px;"> </td>
			</tr>
			<tr>
				<th >E-MAIL</th>
			</tr>
			<tr>
				<td>&nbsp <input type="text" value="<?php echo $userArr['email'];?>" readonly style="background:lightgrey;border:none;font-size:150%;margin-top:-10px"> </td>
			</tr>
			<tr>
				<th>ACCOUNT TYPE</th>
			</tr>
			<tr>
				<td>&nbsp <input type="text" value="<?php echo $userArr['ac_type'];?>" readonly style="background:lightgrey;border:none;font-size:150%;margin-top:-10px;"> </td>
			</tr>
			<tr>
				<th>LINK CREATION LIMIT</th>
			</tr>
			<tr>
				<td>&nbsp <input type="text" value="<?php echo $userArr['link_limit']."&nbsp Limit";?>" readonly style="background:lightgrey;border:none;font-size:150%;margin-top:-10px;"> </td>
			</tr>
			<tr>
				<td><a href="make_payment.php">INCREASE LINK CREATION LIMIT (click here)</a>
			</tr>
			
			<tr>
				<td> <a href="dashboard.php">GO TO Dashboard</td></a>
			</tr>
			</table>
        
    </div>
</section>

</body>
</html>



 		
<!--

<p style="font-size:150%">Name : <br><?php echo $userArr['name'];?> suresh shelke</p>
						</div></p>
						<p>
							<div >
								<p style="font-size:150%">E-mail :  <br> <?php echo $userArr['email'];?> </p>
							</div>
						</p>
						<p>
							<div >
								<p style="font-size:150%">ACCOUNT TYPE : <br> <?php echo $userArr['ac_type'];?></p>
							</div>
						</p>
						<p>
							<div >
								<p style="font-size:150%">LINK CREATION LIMIT : <br>&nbsp<?php echo $userArr['link_limit'];?> Links</p>
							</div>
						</p>
						<p>
							<div >
								<p style="font-size:130%"> <a href="make_payment.php">INCREASE LINK CREATION LIMIT <strong style="font-size:80%">(click here)</strong></p>
							</div>
						</p>
						<p>
							<div >
								<a href="dashboard.php"><h5>Go To Dashboard</h5></a>
							</div>
						</p>