<?php
	function phpsay_rewrite_forum($id,$page=1)
	{
		global $site_catalog,$site_rewrite;

		if($site_rewrite)
		{
			$url = $site_catalog."bar-".$id."-".$page.".html";
		}
		else
		{
			$url = $site_catalog."forum.php?fid=".$id;

			if( $page > 1 )
			{
				$url .= "&page=".$page;
			}
		}

		return $url;
	}
?>