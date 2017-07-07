<?php
	function enc($str, $key)
	{
		$slen = strlen($str);
		$klen = strlen($key);
		for ($i = 0; $i < $slen; ++$i)
		{
			$str[$i] = chr(ord($str[$i]) + ord($key[$i % $klen]) % 255);
		}
		return base64_encode($str);
	}

	function dec($str, $key)
	{
		$str = base64_decode($str);
		$slen = strlen($str);
		$klen = strlen($key);
		for ($i = 0; $i < $slen; ++$i)
		{
			$tmp = (ord($str[$i]) - ord($key[$i % $klen])) % 255;
			$str[$i] = ($tmp < 0) ? chr(255 + $tmp) : chr($tmp);
		}
		return $str;
	}
?>