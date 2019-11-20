<?php
require("library.php");
require("linkstat.php");
session_start();
$userArr;
$obj;
if(!isset($_SESSION['user_id']))
{
	header("location:login.html");
}else{
	$obj=new LinkStat($_SESSION['user_id']);
	$obj->load_short_url_table();
	$userArr=$obj->ac_user_detail();
	if($userArr['ac_type']=="TEST" || $userArr['ac_type']=="BASIC")
	{
		echo"<script>alert('TO VIEW MORE STATISTICS OF EACH URL YOU NEED TO UPGARDE YOUR ACCOUNT / PACKAGE TO BASIC PRO/PRO/ADVANCE PRO...');
						window.location='make_payment.php';
			</script>";
		die;
	}
}

?>
<html>
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.10.0, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/jellyfish-122x92.jpg" type="image/x-icon">
  <meta name="FULL STATISTICS" content="FULL STATISTICS OF EACH URL WITH WHICH TYPE DEVICE USER USING TO VISIT YOUR WEBSITE">
  
  <title>FULL STATISTICS</title>
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
  
</head>
<body style="background:#df4125">

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
                        URLS STATISTICS</a></span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
				<li class="nav-item"><a class="nav-link link text-white display-4" href="#">&nbsp; &nbsp; &nbsp;</a></li>
				<li class="nav-item"><a class="nav-link link text-white display-4" href="contact_us.php"><span class="mbri-contact-form mbr-iconfont mbr-iconfont-btn"></span>Contact Us</a></li>
				<li class="nav-item"><a class="nav-link link text-white display-4" href="logout.php"><span class="mbrib-logout mbr-iconfont mbr-iconfont-btn"></span>Logout</a></li>
				<li class="nav-item"><a class="nav-link link text-white display-4" href="profile.php"><span class="mbri-user mbr-iconfont mbr-iconfont-btn"></span><?php echo $userArr['name'];?></a></li>
			</ul>
        </div>
    </nav>
</section>

<section class="mbr-section article content10 cid-rzClX7G6DI" id="content10-m" style="background:lightgrey;margin-bottom:5px;margin-top:6%;">
     <div class="container">
	<hr class="line" style="width: 10%;">
        <div >
                <strong ><h2 style="margin-bottom:5px;margin-top:5px;color:red;">All Short URLS </h2></strong>
        </div>
    </div>

	  
        <?php
		echo "<div >";
		$count=1;$id=1;
			echo "<table border=2 bgcolor=white width=100% >";
					echo "<tr>";
						echo "<th> <center> Line No </center> </th>";
						echo "<th> <center> Long URLS </center> </th>";
						echo "<th> <center> Short URLS </center> </th>";
						echo "<th><center> Copy </center> </th>";
						echo "<th> <center> Total Clicks </center> </th>";
						echo "<th> <center> Daily Clicks </center> </th>";
						echo "<th><center> Monthly Clicks </center> </th>";
						echo "<th> <center> Yearly Clicks </center> </th>";
						echo "<th> <center> MOBILE USER </center> </th>";
						echo "<th><center> PC USER </center> </th>";
						echo "<th> <center> TABLET USER </center> </th>";
						echo "<th> <center> BOTS </center> </th>";
					echo "</tr>";
					$row=each_link_click($_SESSION['user_id']);
					
					foreach($row as $data)
					{
						
						$short=$data['short_url'];
						$long=$data['long_url'];
						$click=$data['no_of_click'];
						$ymdclick=$obj->get_ymd_click($short);
						$device=$obj->get_mptb_click($short);
						//checking how many click are there for each link if link click is greater than 0 then add 1 click in each of $ymdclick
						if($click >0)
						{
							$ymdclick['d']=$ymdclick['d']+1;
							$ymdclick['m']=$ymdclick['m']+1;
							$ymdclick['y']=$ymdclick['y']+1;
						}
						$mobile=$device['mobile'];
						echo "<tr>";
						echo "<td> <center> $count </center> </td>";
						
						echo "<td> <center>"."<input type='text' value='$long' style='width:100%;border:0px;text-align:center' readonly>"."<center> </td>";
						
						echo "<td> <center>"."<input type='text' id='$id' value='".domain."$short' style='width:100%;border:0px;text-align:center' readonly>"."<center> </td>";
						
						echo "<td> <center> <button id='$id' onclick='copyToClipBoardLink($id)' style='width:100%;border:0px;background:white;text-align:center'> Copy <center> </button></td>";
						
						echo "<td> <center>"."<input type='text' value='$click' style='width:100%;border:0px;text-align:center' readonly>"."<center> </td>";
						
						echo "<td> <center>"."<input type='text' value=".$ymdclick['d']." style='width:100%;border:0px;text-align:center' readonly>"."<center> </td>";
						
						echo "<td> <center>"."<input type='text' value=".$ymdclick['m']." style='width:100%;border:0px;text-align:center' readonly>"."<center> </td>";
						
						echo "<td> <center>"."<input type='text' value=".$ymdclick['y']." style='width:100%;border:0px;text-align:center' readonly>"."<center> </td>";
						
						echo "<td> <center>"."<input type='text' value='$mobile' style='width:100%;border:0px;text-align:center' readonly>"."<center> </td>";
						
						echo "<td> <center>"."<input type='text' value=".$device['pc']." style='width:100%;border:0px;text-align:center' readonly>"."<center> </td>";
						
						echo "<td> <center>"."<input type='text' value=".$device['tablet']." style='width:100%;border:0px;text-align:center' readonly>"."<center> </td>";
						
						echo "<td> <center>"."<input type='text' value=".$device['bots']." style='width:100%;border:0px;text-align:center' readonly>"."<center> </td>";
						
						$count++;
						$id++;
						echo "</tr>";
						
					}
					
			echo "</table>";
		echo "<div>";
		?>
    
</section>
<script type="text/javascript">
	function copyToClipBoard() {
		/* Get the text field */
		var copyText = document.getElementById("cptext");

		copyText.select();
		/* Copy the text inside the text field */
		document.execCommand('copy');
		/* Alert the copied text */
		alert("Copied the text: " + copyText.value);
	}
	function copyToClipBoardLink(id) {
	  /* Get the text field */
	  var copyText = document.getElementById(id);

	 copyText.select();
	 /* Copy the text inside the text field */
	  document.execCommand('copy');

	  /* Alert the copied text */
	  alert("Copied the text: " + copyText.value);
	}
			
</script>
 <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/popper/popper.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/datatables/jquery.data-tables.min.js"></script>
  <script src="assets/datatables/data-tables.bootstrap4.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/theme/js/script.js"></script>
  

</body>
</html>