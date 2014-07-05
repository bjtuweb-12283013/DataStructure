<?php
	function phpsay_avatar( $uid )
	{
		global $site_catalog;

		$avatarPath = "attachment/avatar/".($uid%32)."/".($uid%257)."/".$uid."/40_40.jpg";

		if( !file_exists(dirname(__FILE__)."/../../".$avatarPath) )
		{
			$avatarPath = "images/group_face_1.gif";
		}

		return $site_catalog.$avatarPath;
	}
?>
