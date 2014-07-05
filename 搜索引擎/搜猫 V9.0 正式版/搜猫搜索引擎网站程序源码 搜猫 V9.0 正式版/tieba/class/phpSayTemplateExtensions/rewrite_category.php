<?php
	function phpsay_rewrite_category( $id )
	{
		global $site_catalog,$site_rewrite;

		if($site_rewrite)
			$url = $site_catalog."category-".$id."-1.html";
		else
			$url = $site_catalog."category.php?cid=".$id;

		return $url;
	}
?>