
<!--
Long URL text field id => long_url
SHORT URL button id =>long_btn
copy text field div id =>cpdiv
copy text field id =>cptext
-->

<?php 
require("library.php");
require("linkstat.php");
session_start();
$userArr=array();
$no_of_url;
if(!isset($_SESSION['user_id']))
{
	header("location:login.html");
}else{
	$obj=new LinkStat($_SESSION['user_id']);
	$userArr=$obj->ac_user_detail();
	$no_of_url=$obj->total_link();
}

$short_url;
if(isset($_POST['long_btn']))
{
	$url=$_POST['long_url'];
	
	$ssid=$_SESSION['user_id'];
	if($no_of_url < $userArr['link_limit'])
		{
			$short_url=get_short_url(domain,$url,$ssid);
			
		}else{
			echo"<script>alert('You Cannot Create No More SHORT URL. To Create More URL Upgrade Your Account/PACKAGE');</script>";
		}
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
  <meta name="Create New Link" content="Create New custom link to attract more customer/visitor to your website using our powerfull link shortner tool">
  
  <title>Create New Link</title>
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
	.sub-btn-copy
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
                        CREATE NEW SHORT LINK</a></span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true"><li class="nav-item"><a class="nav-link link text-white display-4" href="#">&nbsp; &nbsp; &nbsp;</a></li><li class="nav-item"><a class="nav-link link text-white display-4" href="contact_us.php"><span class="mbri-contact-form mbr-iconfont mbr-iconfont-btn"></span>Contact Us</a></li><li class="nav-item"><a class="nav-link link text-white display-4" href="logout.php"><span class="mbrib-logout mbr-iconfont mbr-iconfont-btn"></span>Logout</a></li><li class="nav-item">
                    <a class="nav-link link text-white display-4" href="#"><span class="mbri-user mbr-iconfont mbr-iconfont-btn"><?php if(isset($userArr)) echo $userArr['name'];?></span></a>
                </li></ul>
            
        </div>
    </nav>
</section>

<section class="engine"></section><section class="features4 cid-rzCjScTTpw" id="features4-k">
  

<div class="formbg">
<!--	<form action="" method="POST" onsubmit="return(checkField())"> -->
	
	<input type="text" id="long_url" name="long_url" class="inp" placeholder="copy and paste long URL here" ><br><br>
	<input type="submit" name="long_btn" value="SHORT" onclick="checkField()"class="sub-btn">
	  
</div>

<center>
<div class="formbg" style="margin-top:2%">
    <div id='cpydiv' style="display:none">
		<input type='text' readonly id='cptext' style='align:center;width:100%;background:#df4125;border:none;text-align:center;font-size:150%'>
		<input type='button' class='sub-btn'  value='COPY' onclick='copyToClipBoard()' style="margin-top:1%">   
	</div>
</div>
</center>
<!--
<section class="mbr-section article content10 cid-rzvlHD8faD" id="content10-f">
    

    <div class="container">
        <div class="inner-container" style="width: 50%;" >
            <hr class="line" style="width: 10%;">
            <div class="section-text align-center mbr-white mbr-fonts-style display-5" id="cpdiv">
				<?php
					if(!empty($short_url))
					{
						echo "<input type='text' readonly id='cptext' value='$short_url' style='align:center;width:100%;background:#df4125;border:none;text-align:center'>";
						echo "<input type='button' class='sub-btn'  value='COPY' onclick='copyToClipBoard()'>";
					}
				?>
			</div>
        </div>
		
   </div>
</section>

-->
<section class="mbr-section article content10 cid-rzClX7G6DI" id="content10-m" style="background:lightgrey;height:7%">
    <div class="container" style="margin-top:5px">
        <hr class="line" style="width: 10%;">
        <div >
            <a href="customurl.php"><h3 >Create Custome Link</h3></a>
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
						echo "<th><center> Copy </center> </th>";
						echo "<th> <center> Total Clicks </center> </th>";
					echo "</tr>";
					$row=each_link_click($_SESSION['user_id']);
					
					foreach($row as $data)
					{
						
						$short=$data['short_url'];
						$long=$data['long_url'];
						$click=$data['no_of_click'];
						echo "<tr>";
						echo "<td> <center> $count </center> </td>";
						
						echo "<td> <center>"."<input type='text' value='$long' style='width:100%;border:0px;text-align:center' readonly>"."<center> </td>";
						
						echo "<td> <center>"."<input type='text' id='$id' value='".domain."$short' style='width:100%;border:0px;text-align:center' readonly>"."<center> </td>";
						
						echo "<td> <center> <button id='$id' onclick='copyToClipBoardLink($id)' style='width:100%;border:0px;background:white;text-align:center'> Copy <center> </button></td>";
						
						echo "<td> <center>"."<input type='text' value='$click' style='width:100%;border:0px;text-align:center' readonly>"."<center> </td>";
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
	function checkField(){
		var checkurl = document.getElementById("long_url").value;
		var c=checkurl.match(/^http....[a-zA-Z0-9]/i);
			
		if(checkurl==''){
			return false;
		}else if(c==null){
			return false;
		}else{
			
			if(window.XMLHttpRequest){
				  xmlhttp=new XMLHttpRequest();
			  }else{
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  
			  
			  var UrlToSend="jscreatenew.php?long_url="+checkurl;
			  var short_url='';
			  xmlhttp.open("GET",UrlToSend,true);
			  
			  xmlhttp.onload = function (){
					console.log(this.responseText);
					//alert(this.responseText);
					var viewresult=this.responseText;
					if(viewresult.search(/http/i) != -1)
					{
						document.getElementById("cpydiv").style.display="block";
						document.getElementById("cptext").value=this.responseText;
					}else if(viewresult.search(/You/i)!=-1){
						alert(this.responseText);
					}
				}
			 /*	
			xmlhttp.onreadystatechange = function(){
					if(this.readyState==4 && this.status==200)
					{
						alert(this.responseText);
					}
				}
			  */
				xmlhttp.send();
			return true;
		}
		
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