<?php if(!defined('IN_CYASK')) exit('Access Denied'); include template('header'); ?>
<div id="middle">
<div id="path"><a href="./"><?php echo $site_name;?></a> &gt;&gt; 站内公告</div>
<div id="c90">
<div class="t3 bcg"><div class="t3t bgg">站内公告</div></div>
<div class="b3 bcg mb12">
<div class="w100">
<table cellspacing="0" cellpadding="0" width="100%" border="0">
<?php if(is_array($notice_list)) { foreach($notice_list as $notice) { ?>
<tr>
<td class="f14" align="left" width="70%" height="26"><a href="<?php echo $notice['id'];?>" target="_blank"><?php echo $notice['title'];?></a></td>
<td align="center" width="10%"><?php echo $notice['author'];?></td>
<td align="center" width="20%"><?php echo $notice['time'];?></td></tr>
<tr><td colspan="3"><hr size=1 color="#cccccc"></td></tr>
<?php } } ?>
</table>
</div>
</div>
</div>
</div>
<br />
<?php include template('footer'); ?>
