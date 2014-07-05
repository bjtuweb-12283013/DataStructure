<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-12-20
	Author: zhaoshunyao
	QQ: 240508015
*/

define('CURSCRIPT', 'signal');
require('./include/common.inc.php');

include language('signal',$tpldir,$styleid);
$resultno= empty($_GET['resultno']) ? $_POST['resultno'] : $_GET['resultno'];
$url= empty($_GET['url']) ? $_POST['url'] : $_GET['url'];
$signal_message='';
switch($_GET['resultno'])
{
	case '101':
	$signal_message=$lang['ques_already_submit'];
	break;
	case '102':
	$signal_message=$lang['ques_already_update'];
	break;
	case '103':
	$signal_message=$lang['ques_already_collect'];
	break;
	case '104':
	$signal_message=$lang['ques_already_vote'];
	break;
	case '106':
	$signal_message=$lang['ques_already_upscore'];
	break;
	case '107':
	$signal_message=$lang['ques_already_close'];
	break; 
	case '108':
	$signal_message=$lang['ques_select_answer'];
	break;
	case '109':
	$signal_message=$lang['ques_already_answer'];
	break;
	case '110':
	$signal_message=$lang['ques_update_answer'];
	break;
	case '111':
	$signal_message=$lang['ques_comment_submit'];
	break;
	case '112':
	$signal_message=$lang['vote_submit'];
	break;
	default:
	$signal_message=$lang['undefined_action'];
	
}
include template('signal','signal');
?>