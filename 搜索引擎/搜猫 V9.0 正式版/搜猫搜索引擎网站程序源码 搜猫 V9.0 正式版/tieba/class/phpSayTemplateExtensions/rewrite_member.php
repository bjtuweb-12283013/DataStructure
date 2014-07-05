<?php
	function phpsay_rewrite_member( $id )
	{
		global $site_catalog,$site_rewrite;

		if($site_rewrite)
			$url = $site_catalog."member-".$id.".html";
		else
			$url = $site_catalog."member.php?uid=".$id;

		return $url;
	}
?>