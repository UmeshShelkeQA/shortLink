<?php
//require("dbconn.php");
class LinkStat
{
	var $urlArr=array();
	var $ac_id;
	function __construct($ac_id)
	{
		$this->ac_id=$ac_id;
	}
	
	//load the short url into $urlArr array
	function load_short_url_table()
	{
		$conn=make_connection();
		
		//gives assoc array =>indexes => long_url,short_url,shid,ac_id,date,mptb,ymd,no_of_click
		
		$query="SELECT * FROM `short_url` WHERE ac_id=$this->ac_id";
		
		$result=mysqli_query($conn,$query);
		if($result)
		{
			if($result->num_rows>0)
			{
				while($row=mysqli_fetch_assoc($result))
				{
					array_push($this->urlArr,$row);
				}
				mysqli_free_result($result);
				close_connection();
				return true;
			}
			else{
				close_connection();
				return false;
			}
		}
		else{
			close_connection();
			return false;
		}
	}
	
	function check()
	{
				$this->urlArr=$this->load_short_url_table();
		foreach($this->urlArr as $arr)
		{
			echo"<br>";
			print_r($arr);
		}
	}
	function get_mptb_click($link)
	{
		$visitorDevice=array("mobile"=>0,"pc"=>0,"tablet"=>0,"bots"=>0);
				foreach($this->urlArr as $arr)
				{
					if($arr['short_url']==$link)
					{
						$ar=explode('-',$arr['mptb']);
						if(isset($ar[0]))
							$visitorDevice['mobile']=(int)$ar[0];
						if(isset($ar[1]))
							$visitorDevice['pc']=(int)$ar[1];
						if(isset($ar[2]))
							$visitorDevice['tablet']=(int)$ar[2];
						if(isset($ar[3]))
							$visitorDevice['bots']=(int)$ar[3];
						break;
					}
				}
		return $visitorDevice;
	}
	function get_total_mptb_click()
	{
		$visitorDevice=array('mobile'=>0,'pc'=>0,'tablet'=>0,'bots'=>0);
		$i=0;
		//echo "<br> size :".sizeof($this->urlArr);
		foreach($this->urlArr as $arr)
		{
			
			if(isset($arr['mptb']))
			{			
				$ar=explode('-',$arr['mptb']);
				//print_r($ar);
				if(isset($ar[0]))
					$visitorDevice['mobile']+=(int)$ar[0];
				if(isset($ar[1]))
					$visitorDevice['pc']+=(int)$ar[1];
				if(isset($ar[2]))
					$visitorDevice['tablet']+=(int)$ar[2];
				if(isset($ar[3]))
					$visitorDevice['bots']+=(int)$ar[3];
			}
		}
		return $visitorDevice;
		
	}
	function get_stat($from_date,$to_date)
	{
		
	}
	
	function total_link()
	{
		$conn=make_connection();
		
		$query="SELECT no_of_url FROM account WHERE id=$this->ac_id";
		
		$result=mysqli_query($conn,$query);
		if($result)
		{
			$row=mysqli_fetch_assoc($result);
			mysqli_free_result($result);
			close_connection();
			return $row['no_of_url'];
		}
		else{	
			return 0;
		}
	}
	
	function total_link_click()
	{
		$conn=make_connection();
		
		$query="SELECT sum(no_of_click) FROM short_url WHERE ac_id=$this->ac_id";
		
		$result=mysqli_query($conn,$query);
		if($result)
		{
			$row=mysqli_fetch_assoc($result);
			mysqli_free_result($result);
			close_connection();
			return $row['sum(no_of_click)'];
		}
		else{	
			close_connection();
			return 0;
		}
	}
	
	function dailyClick($ymdstr)//$ymdstr => yymmdd-click format
	{
		$ymdArr=explode(",",$ymdstr);
		$today=date('ymd',time('now'));
		
		foreach($ymdArr as $dayArr)
		{
			$day=explode("-",$dayArr);
			if(isset($day[0]))
			{
				$temp=(int)$day[0];
				//echo "<br>temp :".$temp;
				if($temp==$today)
				{
					if(isset($day[1]))
					{
						$dc=(int)$day[1];
						return $dc;
					}
				}
			}
			
		}
		
		return 0;
	}
	
	function customDailyClick($ymdstr,$year,$month,$day)//$ymdstr => yymmdd-click format
	{
		$ymdArr=explode(",",$ymdstr);
		$today=(($year*100)+$month)*100+$day;//getting date to search click on that date
		
		foreach($ymdArr as $dayArr)
		{
			$day=explode("-",$dayArr);
			if(isset($day[0]))
			{
				$temp=(int)$day[0];
				//echo "<br>temp :".$temp;
				if($temp==$today)
				{
					if(isset($day[1]))
					{
						$dc=(int)$day[1];
						return $dc;
					}
				}
			}
			
		}
		
		return 0;
	}
	
	function monthlyClick($ymdstr)
	{
		$ymdArr=explode(",",$ymdstr);
		$cmonth=date('ym',time('now'));
		$count=0;
		foreach($ymdArr as $dayArr)
		{
			$day=explode("-",$dayArr);
			if(isset($day[0]))
			{
				$temp=(int)substr($day[0],0,4);
				if($temp==$cmonth)
				{
					if(isset($day[1]))
					{
						$count=$count+(int)$day[1];
					}
				}
			}
			
		}
		
		return $count;
	}
	
	function customMonthlyClick($ymdstr,$year,$month)
	{
		$ymdArr=explode(",",$ymdstr);
		$cmonth=($year*100)+$month;
		$count=0;
		foreach($ymdArr as $dayArr)
		{
			$day=explode("-",$dayArr);
			if(isset($day[0]))
			{
				$temp=(int)substr($day[0],0,4);
				if($temp==$cmonth)
				{
					if(isset($day[1]))
					{
						$count=$count+(int)$day[1];
					}
				}
			}
			
		}
		
		return $count;
	}
	
	function yearlyClick($ymdstr)
	{
		$ymdArr=explode(",",$ymdstr);
		$cyear=date('y',time('now'));
		$count=0;
		foreach($ymdArr as $dayArr)
		{
			$day=explode("-",$dayArr);
			if(isset($day[0]))
			{
				$temp=(int)substr($day[0],0,2);
				if($temp==$cyear)
				{
					if(isset($day[1]))
					{
						$count=$count+(int)$day[1];
					}
				}
			}
			
		}
		
		return $count;
	}
	function customYearlyClick($ymdstr,$year)
	{
		$ymdArr=explode(",",$ymdstr);
		
		$count=0;
		foreach($ymdArr as $dayArr)
		{
			$day=explode("-",$dayArr);
			if(isset($day[0]))
			{
				$temp=(int)substr($day[0],0,2);
				if($temp==$year)
				{
					if(isset($day[1]))
					{
						$count=$count+(int)$day[1];
					}
				}
			}
			
		}
		
		return $count;
	}
	
	function get_ymd_click($link)
	{
		$visitorYMD=array("y"=>0,"m"=>0,"d"=>0);
		if(isset($this->urlArr))
		{		
			foreach($this->urlArr as $arr)
			{
				if(isset($arr['short_url']))
				{
					if($arr['short_url']==$link)
					{
						$visitorYMD['d']=$this->dailyClick($arr['ymd']);
						$visitorYMD['m']=$this->monthlyClick($arr['ymd']);
						$visitorYMD['y']=$this->yearlyClick($arr['ymd']);
					}
				}
			}
		}
		return $visitorYMD;
	}
	
	function get_custom_ymd_click($link,$year,$month,$day)
	{
		$visitorYMD=array("y"=>0,"m"=>0,"d"=>0);
		if(isset($this->urlArr))
		{		
			foreach($this->urlArr as $arr)
			{
				if(isset($arr['short_url']))
				{
					if($arr['short_url']==$link)
					{
						$visitorYMD['d']=$this->customDailyClick($arr['ymd'],$year,$month,$day);
						$visitorYMD['m']=$this->customMonthlyClick($arr['ymd'],$year,$month);
						$visitorYMD['y']=$this->customYearlyClick($arr['ymd'],$year);
					}
				}
			}
		}
		return $visitorYMD;
	}
	
	
	function get_total_ymd_click()
	{
		$visitorYMD=array("y"=>0,"m"=>0,"d"=>0);
		
		if(!empty($this->urlArr))
		{
			foreach($this->urlArr as $arr)
			{
				if(isset($arr['short_url']))
				{
					$resArr=$this->get_ymd_click($arr['short_url']);
					$visitorYMD['y']=$visitorYMD['y']+$resArr['y'];
					$visitorYMD['m']=$visitorYMD['m']+$resArr['m'];
					$visitorYMD['d']=$visitorYMD['d']+$resArr['d'];
				}
			}
		}
		return $visitorYMD;
	}
	
	// cannot write function name get_user_name or username or etc... because of that we write these name
	function ac_user()
	{
		$conn=make_connection();
		if($conn)
		{
			$query="SELECT name FROM account WHERE id=$this->ac_id";
			$result=mysqli_query($conn,$query);
			if($result)
			{
				if($result->num_rows>0)
				{
					$row=mysqli_fetch_assoc($result);
					$name=$row['name'];
					mysqli_free_result($result);
					close_connection();
					return $name;
				}
				else{
					close_connection();
					return false;
				}
			}
			else{
				close_connection();
				return false;
			}
		}
	}
	function ac_user_detail()
	{
		$conn=make_connection();
		if($conn)
		{
			$query="SELECT name,email,no_of_url,ac_type,link_limit FROM account WHERE id=$this->ac_id";
			$result=mysqli_query($conn,$query);
			if($result)
			{
				if($result->num_rows>0)
				{
					$row=mysqli_fetch_assoc($result);
					$name=$row;
					mysqli_free_result($result);
					close_connection();
					return $name;
				}
				else{
					close_connection();
					return false;
				}
			}
			else{
				close_connection();
				return false;
			}
		}
	}
	
}
?>