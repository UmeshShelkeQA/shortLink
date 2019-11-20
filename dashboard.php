
<?php 
session_start();

require("library.php");
require("linkstat.php");
$short_url;
$obj;
$ymdstat;
$device;
$user;
if(isset($_SESSION['user_id']))
{
	$obj=new LinkStat($_SESSION['user_id']);
	$obj->load_short_url_table();
	$device=$obj->get_total_mptb_click();
	$ymdstat=$obj->get_total_ymd_click();
	$user=$obj->ac_user();
}else{
	header("Location:login.html");
}

?>

<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v4.10.0, #m -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.10.0, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/jellyfish-122x92.jpg" type="image/x-icon">
  <meta name="Dashboard" content="PowerFull Dashboard">
  
  <title>Dashboard</title>
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
  .formbg{
	  background:#df4125
  }
  		.inp{
	width: 80%;
	margin-left: 10%;
	margin-right: 10%;
	padding: 10px;
	margin-bottom: 5px;
	margin-top: 5%;
	border:2px solid #dc143c;
	border-radius: 5px;
	font-weight: bold;
	border-right: 20px solid #dc143c;
	border-left: 20px solid #dc143c;
	color: navy;
	}
		.sub-btn
	{
	width: 25%;
	padding: 10px;
	margin-top: 5px;
	margin-left:37.5%;
	margin-right:37.5%;
	border:none;
	border-radius: 5px;
	background:linear-gradient(#dc133c,#800000);
	font-weight: bold;
	font-size:100%;
	color: navy;
	
	}
	.td{
		max-width:0;
		overflow:hidden;
		text-overflow:hidden;
		white-spaces:nowrap;
		text-wrap:off;
	}
	
  </style>
  
  
</head>
<body>

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
                        Welcome To Dashboard <?php echo $user;?></a></span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true"><li class="nav-item"><a class="nav-link link text-white display-4" href="contact_us.php"><span class="mbri-contact-form mbr-iconfont mbr-iconfont-btn"></span>Contact Us</a></li>
				<li class="nav-item"><a class="nav-link link text-white display-4" href="logout.php"><span class="mbrib-logout mbr-iconfont mbr-iconfont-btn"></span>Logout</a></li>
				<li class="nav-item">
                    <a class="nav-link link text-white display-4" href="profile.php"><span class="mbri-user mbr-iconfont mbr-iconfont-btn"><?php echo $user;?></span></a>
                </li></ul>
            
        </div>
    </nav>
</section>

<section class="engine"></section><section class="features4 cid-rzCjScTTpw" id="features4-k" style="background:lightgrey">
    

    
    <div class="container" >
        <div class="media-container-row" >
            <div class="card p-3 col-12 col-md-6 col-lg-3">
                <div class="card-wrapper media-container-row media-container-row">
                    <div class="card-box">
                        <h4 class="card-title pb-3 mbr-fonts-style display-7"><b>Total Link</b></h4>
                        <p class="mbr-text mbr-fonts-style display-7"><?php if(isset($obj)) echo $obj->total_link();?></p>
                    </div>
                </div>
            </div>

            <div class="card p-3 col-12 col-md-6 col-12 col-md-6 col-lg-3">
                <div class="card-wrapper media-container-row">
                    <div class="card-box">
                        <h4 class="card-title pb-3 mbr-fonts-style display-7">
                           <b> Total Click<br><h6 style="font-size:12px">(Unique User)</h6></b></h4>
                        <p class="mbr-text mbr-fonts-style display-7">
                            <?php 
							if(isset($obj)){
								if(!$obj->total_link_click())
									echo 0;
								else
									echo $obj->total_link_click();
							}
							?>
					</p>
                    </div>
                </div>
            </div>

            <div class="card p-3 col-12 col-md-6 col-lg-3">
                <div class="card-wrapper media-container-row">
                    <div class="card-box">
                        <h4 class="card-title pb-3 mbr-fonts-style display-7">
                           <b> Daily Click </b></h4>
                        <p class="mbr-text mbr-fonts-style display-7">
						<?php 
							if(isset($ymdstat['d']))
							{
								if(isset($obj)){
								if(!$obj->total_link_click())
									echo 0;
								else
									echo $ymdstat['d']+1;
							}
							}
							else{
								echo '--';
							}
						?>
						</p>
                    </div>
                </div>
            </div>

            <div class="card p-3 col-12 col-md-6 col-lg-3">
                <div class="card-wrapper media-container-row">
                    <div class="card-box">
                        <h4 class="card-title pb-3 mbr-fonts-style display-7"> <b>Monthly click </b></h4>
                        <p class="mbr-text mbr-fonts-style display-7">
                         <?php 
							if(isset($ymdstat['m']))
							{
								if(isset($obj)){
								if(!$obj->total_link_click())
									echo 0;
								else
									echo $ymdstat['m']+1;
							}
							}
							else{
								echo '--';
							}
						?>
						 </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mbr-section article content10 cid-rzClX7G6DI" id="content10-m">
    
     

    <div class="container">
        <div class="inner-container" style="width: 50%;">
            <hr class="line" style="width: 10%;">
            <div  style="color:black;">
                <strong><center><h2>   User Devices</h2></center></strong></div>
            <hr class="line" style="width: 10%;">
        </div>
    </div>
</section>

<section class="features4 cid-rzCkMo3hys" id="features4-l" style="background:lightgrey">
    
         

    
    <div class="container">
        <div class="media-container-row">
            <div class="card p-3 col-12 col-md-6 col-lg-3">
                <div class="card-wrapper media-container-row media-container-row">
                    <div class="card-box">
                        <h4 class="card-title pb-3 mbr-fonts-style display-7">
                            <b> Mobile User </b></h4>
                        <p class="mbr-text mbr-fonts-style display-7">
						<?php 
							if(isset($device['mobile']))
								echo $device['mobile'];
							else{
								echo 0;
							}
						?>
						</p>
                    </div>
                </div>
            </div>

            <div class="card p-3 col-12 col-md-6 col-12 col-md-6 col-lg-3">
                <div class="card-wrapper media-container-row">
                    <div class="card-box">
                        <h4 class="card-title pb-3 mbr-fonts-style display-7">
                           <b> Computer user </b></h4>
                        <p class="mbr-text mbr-fonts-style display-7">
                        <?php 
							if(isset($device['pc']))
								echo $device['pc'];
							else{
								echo 0;
							}
						?>    
						</p>
                    </div>
                </div>
            </div>

            <div class="card p-3 col-12 col-md-6 col-lg-3">
                <div class="card-wrapper media-container-row">
                    <div class="card-box">
                        <h4 class="card-title pb-3 mbr-fonts-style display-7"><b>Tablet User</b></h4>
                        <p class="mbr-text mbr-fonts-style display-7">
                         <?php 
							if(isset($device['tablet']))
								echo $device['tablet'];
							else{
								echo 0;
							}
						?>
						 </p>
                    </div>
                </div>
            </div>

            <div class="card p-3 col-12 col-md-6 col-lg-3">
                <div class="card-wrapper media-container-row">
                    <div class="card-box">
                        <h4 class="card-title pb-3 mbr-fonts-style display-7"><b> Bots Traffic </b></h4>
                        <p class="mbr-text mbr-fonts-style display-7">
						<?php 
							if(isset($device['bots']))
								echo $device['bots'];
							else{
								echo 0;
							}
						?>
						</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mbr-section article content10 cid-rzClX7G6DI" id="content10-m" style="background:lightgrey;height:7%">
    
     

    <div class="container" style="margin-top:5px">
        <hr class="line" style="width: 10%;">
        <div >
            <a href="createnew.php"><h3 >Create New Link</h3></a>
        </div>
    </div>
</section>

<section class="mbr-section article content10 cid-rzClX7G6DI" id="content10-m" style="background:lightgrey;margin-bottom:5px;margin-top:5px;">
    
     

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
						echo "<th> <center> Copy </center> </th>";
						echo "<th> <center> Total Clicks </center> </th>";
						echo "<th> <center> Delete Link </center> </th>";
					echo "</tr>";
					$row=each_link_click($_SESSION['user_id']);
					
					foreach($row as $data)
					{
						
						$short=$data['short_url'];
						$long=$data['long_url'];
						$click=$data['no_of_click'];
						echo "<tr>";
						echo "<td> <center> $count </center> </td>";
								
						echo "<td> <center>"."<input type='text' value='$long' style='width:100%;border:0px;text-align:center' readonly>"."</center> </td>";
								
						echo "<td> <center>"."<input type='text' id='$id' value='".domain."$short' style='width:100%;border:0px;text-align:center' readonly>"." </center> </td>";
								
						echo "<td> <center> <button onclick='copyToClipBoard($id)' style='width:100%;border:0px;background:white;text-align:center'> Copy </button> </center> </td>";
								
						echo "<td> <center>"."<input type='text' value='$click' style='width:100%;border:0px;text-align:center' readonly>"."</center> </td>";
								
						echo "<td> <center> <button onclick='deleteLink($id)' style='width:100%;border:0px;background:white;text-align:center'> Delete </button> </center> </td>";
								
						echo "</tr>";
						$count++;
						$id++;
					}
					
			echo "</table>";
		echo "<div>";
				
		?>
    
</section>
<section class="mbr-section article content10 cid-rzClX7G6DI" id="content10-m" style="background:lightgrey;margin-bottom:5px;margin-top:5px;">
    
     

    <div class="container">
	<hr class="line" style="width: 10%;">
        <div >
                <h3 style="margin-bottom:5px;margin-top:5px;color:red;"><a href="viewmorestat.php"><b>View More Statistic</b></a> </h3>
        </div>
    </div>

</section>
<input type="hidden" id="ac_id_session" value="<?php echo $_SESSION['user_id'];?>">
<script type="text/javascript">

	function copyToClipBoard(id) {
	  /* Get the text field */
		var copyText = document.getElementById(id);

		copyText.select();
		 /* Copy the text inside the text field */
		document.execCommand('copy');

		/* Alert the copied text */
		alert("Copied the text: " + copyText.value);
	}
	function deleteLink(id) {
			  var xmlhttp;
			  var deletelink = document.getElementById(id).value;
			  
		var c=confirm('are you really want to delete the link : '+deletelink);
		if(c){
			  if(window.XMLHttpRequest){
				  xmlhttp=new XMLHttpRequest();
			  }else{
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  
			  var name="shortlink=";
			  var ac="ac_id=";
				/* Get the link */
			  var deletelink = document.getElementById(id).value;
			  var ac_id=document.getElementById('ac_id_session').value;
			
			  var UrlToSend="deletelink.php?"+name+deletelink +"&"+ ac + ac_id;
			  xmlhttp.open("GET",UrlToSend,false);
			  xmlhttp.send();
			   alert('Link Deleted');
		}
		 
		  window.location.reload();
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