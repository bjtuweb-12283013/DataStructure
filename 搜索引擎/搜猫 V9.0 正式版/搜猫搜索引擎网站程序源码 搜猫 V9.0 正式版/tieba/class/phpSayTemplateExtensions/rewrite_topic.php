<?php
	function phpsay_rewrite_topic($id,$page=1)
	{
		global $site_catalog,$site_rewrite;

		if($site_rewrite)
		{
			$url = $site_catalog."topic-".$id."-".$page.".html";
		}
		else
		{
			$url = $site_catalog."topic.php?tid=".$id;

			if( $page > 1 )
			{
				$url .= "&page=".$page;
			}
		}

		return $url;
	}
?>