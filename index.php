
<?php 

require("library.php");
$short_url;
if(isset($_POST['long_btn']))
{
	$url=$_POST['long_url'];
	//Checking user entered url is same as of previously entered url
	if(isset($_COOKIE["track"]))
	{
		if($_COOKIE['track']!=$url)
		{
			$short_url=get_short_url(domain,$url,1);
			setCookie("track","$url");
			setCookie("shortUrl","$short_url");
		}
		else{
			if(isset($_COOKIE['shortUrl'])){
				$short_url=$_COOKIE['shortUrl'];
			}
		}
	}else{
		$short_url=get_short_url(domain,$url,1);
		setCookie("track","$url");
		setCookie("shortUrl","$short_url");
	}
}
if(isset($_GET['key']))	
{
	$sh_u=$_GET['key'];
	//getting long url from the database
	$lurl=get_long_url($sh_u);
	if($lurl!=null)
	{
		if(isset($_COOKIE["$sh_u"]))
		{
						
		}
		else{
			update_ymd($sh_u);
			update_mptb($sh_u);
			update_click($sh_u);
			$ex_time=(time('now')+60*60*24);
			setCookie("$sh_u",'1',$ex_time);
		}
		header("location:".$lurl);
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
  <meta name="description" content="">
  
  <title>Home</title>
  
  <style>
  .formbg{
	  background:#df4125
  }
  		.inp{
	width: 80%;
	height:10%;
	margin-left: 10%;
	margin-right: 10%;
	padding: 10px;
	margin-bottom: 5px;
	margin-top: 3px;
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
  </style>
  
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  
  
</head>
<body>
  <section class="menu cid-rxDDrIeH25" once="menu" id="menu1-1">

    

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
                        URL SHORTNER</a></span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
				<li class="nav-item"><a class="nav-link link text-white display-4" href="contact_us.php">Contact Us</a></li>
				<li class="nav-item"><a class="nav-link link text-white display-4" href="PRICING/">Pricing</a></li>
				<li class="nav-item"><a class="nav-link link text-white display-4" href="login.php">Sing Up</a></li>
				<li class="nav-item"><a class="nav-link link text-white display-4" href="login.php"><span class="mbri-user mbr-iconfont mbr-iconfont-btn">Sign-In</span></a></li>
			</ul>
            
        </div>
    </nav>
</section>

<section class="mbr-section article content10 cid-rzvlHD8faD" id="content10-f">

<div class="formbg" style="align:center;margin-top:30px">
	<!-- <form action="" method="POST" onsubmit="return(checkField())"> -->
	
	<input type="text" id="long_url" name="long_url" class="inp" placeholder="copy and paste long URL here" style="margin-top:15%;"><br><br>
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
 -->
</section>


<section class="mbr-section article content9 cid-rzvmxJBttX" id="content9-g">
    
     

    <div class="container">
        <div class="inner-container" style="width: 100%;" >
            <hr class="line" style="width: 10%;">
            <div class="section-text align-center mbr-fonts-style display-1"  style="margin-top:-10px"><strong>Feature</strong></div>
            <hr class="line" style="width: 10%;">
        </div>
        </div>
</section>

<section class="features4 cid-rykRvr09yg" id="features4-d">
    
         

    
    <div class="container">
        <div class="media-container-row">
            <div class="card p-3 col-12 col-md-6 col-lg-4">
                <div class="card-wrapper media-container-row media-container-row">
                    <div class="card-box">
                        <h4 class="card-title pb-3 mbr-fonts-style display-7">Link Statistic</h4>
                        <p class="mbr-text mbr-fonts-style display-7">We are giving you daily,montly or yearly statistic of each link with what type of device is visited to your website.(Device Tracking : Mobile,Tablet,PC,SmartTV,Bots,etc..)&nbsp;<br>(XML/PDF file is send to your email if you need it.)&nbsp;<br></p>
                    </div>
                </div>
            </div>

            <div class="card p-3 col-12 col-md-6 col-12 col-md-6 col-lg-4">
                <div class="card-wrapper media-container-row">
                    <div class="card-box">
                        <h4 class="card-title pb-3 mbr-fonts-style display-7">
                            Custom Link&nbsp;</h4>
                        <p class="mbr-text mbr-fonts-style display-7">Custom link service Available.<br>It helps you To attract more customer/visitors to your website &nbsp;<br>.<br>custom link example :<br>https://liturl.ml/nikeshoes<br>https://liturl.ml/ShubhamProduct</p>
                    </div>
                </div>
            </div>

            <div class="card p-3 col-12 col-md-6 col-lg-4">
                <div class="card-wrapper media-container-row">
                    <div class="card-box">
                        <h4 class="card-title pb-3 mbr-fonts-style display-7">
                            Custom Domain</h4>
                        <p class="mbr-text mbr-fonts-style display-7">For local/enterprices level bussiness custom domain short link service available.<br><br>custom domain short link look like :<br>https://YourShortDoamin/product-name</p>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</section>

<section class="cid-rxDKWNDsJ6" id="social-buttons2-4">

    

    

    <div class="container">
        <div class="media-container-row">
            <div class="col-md-8 align-center">
                <h2 class="pb-3 mbr-fonts-style display-5"><strong>
                    FOLLOW US!
                </strong></h2>
                <div class="social-list pl-0 mb-0">
                    <a href="https://twitter.com/mobirise" target="_blank">
                        <span class="px-2 socicon-twitter socicon mbr-iconfont mbr-iconfont-social"></span>
                    </a>
                    <a href="https://www.facebook.com/pages/Mobirise/1616226671953247" target="_blank">
                        <span class="px-2 socicon-facebook socicon mbr-iconfont mbr-iconfont-social"></span>
                    </a>
                    <a href="https://instagram.com/mobirise" target="_blank">
                        <span class="px-2 socicon-instagram socicon mbr-iconfont mbr-iconfont-social"></span>
                    </a>
                    <a href="https://www.youtube.com/c/mobirise" target="_blank">
                        
                    </a>
                    <a href="https://plus.google.com/u/0/+Mobirise" target="_blank">
                        
                    </a>
                    <a href="https://www.behance.net/Mobirise" target="_blank">
                        
                    </a>
                </div>
            </div>
        </div>
    </div>
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
			  
			  
			  var UrlToSend="jsindexurl.php?long_url="+checkurl;
			  var short_url='';
			  xmlhttp.open("GET",UrlToSend,true);
			  
			  xmlhttp.onload = function (){
					console.log(this.responseText);
					alert(this.responseText);
					document.getElementById("cpydiv").style.display="block";
					document.getElementById("cptext").value=xmlhttp.responseText;
				
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
  <script src="assets/popper/popper.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/sociallikes/social-likes.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/formoid/formoid.min.js"></script>
  
  
</body>
</html>