<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");
	
	/*$file=fopen("orderid.txt",'r');
$orderid=fread($file,filesize("orderid.txt"));
fclose($file);
$orderid=$orderid+1;
$file=fopen("orderid.txt",'w');
fwrite($file,$orderid);
fclose($file);
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PAYMENT</title>
<meta name="GENERATOR" content="Evrsoft First Page">
<style>
	/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
  
}
.tabcontent {
  animation: fadeEffect 1s; /* Fading effect takes 1 second */
}

/* Go from zero to full opacity */
@keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}

.inp{
width: 100%;
height:20px;
font-size:100%;
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
.sub-btn:hover
{
background:linear-gradient(#800000,#dc133c);
}
.sub-btn
{
width: 50%;
padding: 10px;
margin-top: 5px;
margin-left: 25%;
margin-right: 25%;
border:none;
border-radius: 5px;
background:linear-gradient(#dc133c,#800000);
font-weight: bold;
font-size:100%;
color: navy;
}
</style>
</head>
<body bgcolor="#df4125">
	

	<pre>
	</pre>
	
	<form method="post" action="pgRedirect.php" onSubmit="return checkField()">
		<h1>SELECT PACKAGE :
			<select id="package" name="package"> 
				<option value="350">BASIC </option>
				<option value="700">BASIC PRO </option>
				<option value="1400">PRO </option>
				<option value="2800" selected>ADVANCE PRO </option>
			<select>
		</h1>
		<h1 id="price1" >PRICE : 5.00$ </h1>
		<h1 id="price2" >PRICE : 10.00$ </h1>
		<h1 id="price3" >PRICE : 20.00$</h1>
		<h1 id="price4" >PRICE : 40.00$</h1>
	

		<input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo  "ORDS" . rand(1000000,100000000);?>">
		
		<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="CUST001"></td>
		
		<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail"></td>
		
		<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12"size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">		
		
		<input type="hidden" title="TXN_AMOUNT" id="txt_amt" tabindex="10" type="text" name="TXN_AMOUNT" value="">
			
		<h3>Enter Your Email</h3>
		 <input type="email" name="email" id="email" class="inp" required placeholder="Enter Your Email"><br><br>
				  
		<h3>Enter Your Mobile Number</h3>
		<input type="phone" name="mobile_number" id="phone" class="inp" required placeholder="Enter Mobile Number"><br><br>
				  
				
		<input value="Proceed To Pay" type="submit"	onclick="" class="sub-btn">
					
		
	</form>
<script>
document.getElementById('price1').style.display= "none";
document.getElementById('price2').style.display= "none";
document.getElementById('price3').style.display= "none";
document.getElementById('package').onchange=function(){
	var planValue=document.getElementById("txt_amt");
		planValue.value=this.value;
	
		if(planValue.value==350)
		{
			document.getElementById('price1').style.display="block";
			document.getElementById('price2').style.display= "none";
			document.getElementById('price3').style.display= "none";
			document.getElementById('price4').style.display= "none";
		}else if(planValue.value==700){
			document.getElementById('price2').style.display="block";
			document.getElementById('price1').style.display= "none";
			document.getElementById('price3').style.display= "none";
			document.getElementById('price4').style.display= "none";
		}else if(planValue.value==1400){
			document.getElementById('price3').style.display="block";
			document.getElementById('price1').style.display= "none";
			document.getElementById('price2').style.display= "none";
			document.getElementById('price4').style.display= "none";
		}else if(planValue.value==2800){
			document.getElementById('price4').style.display="block";
			document.getElementById('price2').style.display= "none";
			document.getElementById('price3').style.display= "none";
			document.getElementById('price1').style.display= "none";
		}
	alert("PACKAGE PRICE : "+this.value/70+"$");
};


	
</script>

</body>
</html>