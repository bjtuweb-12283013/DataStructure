<?php
	function phpsay_datetime( $time='' )
	{
		if( $time == '' )
		{
			return date('Y-m-d H:i:s');
		}
		else
		{
			return date('Y-m-d H:i:s',$time);
		}
	}
?>
