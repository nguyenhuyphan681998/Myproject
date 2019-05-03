<?php 
	session_start();
	$url = $_SERVER['HTTP_REFERER'];
	if(isset($_POST['submit']))
	{
		$selected = $_POST['select'];
		$min = explode('-',$selected);
		if(strpos($url,'?pricemin='))
		{
			$url= explode('?',$url);
			$replace =array_pop($url);
			$url = str_replace($replace,"?pricemin=".$min['0']."",$url);
			$url = implode($url);
			
		}
		if(strpos($url,'&pricemin='))
		{
			$url= explode('&',$url);
			$replace =array_pop($url);
			$url = str_replace($replace,"&pricemin=".$min['0']."",$url);
			$url = str_replace("category","&category",$url);
			$url = implode($url);
			
		}
		if(strpos($url,'sucess')||strpos($url,'fail'))
		{
			$url= explode('?',$url);
			$replace =array_pop($url);
			$url = str_replace($replace,"",$url);
			$url = implode($url);
			
		}
		if(strpos($url,'?'))
		{
			header("location:".$url."&pricemin=".$min['0']."");
		}
		else
		{
			header("location:../index.php?pricemin=".$min['0']."");
		}
		
	}
 ?>