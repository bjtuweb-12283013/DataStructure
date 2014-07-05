<?php if(!defined('IN_CYASK')) exit('Access Denied'); include template('header'); ?>
<div id="middle">
<div id="path"><a href="<?php echo $web_path;?>"><?php echo $site_name;?></a> &gt&gt 积分排行榜</div>
<div id="left2">
<div class="w100">
<div id="subline"></div>
<div id="sub">
<?php if($stype=='all') { ?>
<span>总积分排行榜</span>
<?php } else { ?>
<a href="<?php echo $web_path;?>scorelist.php"><b>总积分排行榜</b></a>
<?php } if($stype=='week') { ?>
<span>上周积分排行榜</span>
<?php } else { ?>
<a href="<?php echo $web_path;?>scorelist.php?stype=week"><b>上周积分排行榜</b></a>
<?php } if($stype=='month') { ?>
<span>上月积分排行榜</span>
<?php } else { ?>
<a href="<?php echo $web_path;?>scorelist.php?stype=month"><b>上月积分排行榜</b></a>
<?php } ?>
</div>
<div class="subt bgg">共计上榜 <?php echo $membercount;?> 人</div>
<?php if($membercount) { ?>
<table class="tlp4" id="tl" cellspacing="0" width="100%" border="0">
<tr>
<td class="nl" nowrap="nowrap" align="center" height="30" width="5%">&nbsp;&nbsp;排名</td>
<td class="nl" nowrap="nowrap" align="center" width="15%">用户名</td>
<td class="nl" nowrap="nowrap" align="center" width="10%">积分</td>
<td class="nl" nowrap="nowrap" align="center" width="5%">性 别</td>
<td class="nl" nowrap="nowrap" align="center" width="20%">最后登录</td>
</tr>
<?php if(is_array($score_list)) { foreach($score_list as $members) { ?>
<tr>
<td height="65" align=center><?php echo $members['orderid'];?></td>
<td height="65" align=center>
<a href="<?php echo $web_path;?>member.php?uid=<?php echo $members['uid'];?>" target="_blank"><?php echo $members['username'];?></a>
</td>
<td height="65" align=center><?php echo $members['newscore'];?></td>
<td height="65" align=center>
<?php if($members['gender']==1) { ?>
男
<?php } elseif($members['gender']==2) { ?>
女
<?php } else { ?>
保密
<?php } ?>
</td>
<td height="65" align=center><?php echo $members['lastlogin'];?></td>
</tr>
<?php } } ?>
</table>
<?php } else { ?>
<table class="tlp4" id="tl" cellspacing="0" width="100%" border="0">
<tr><td height="30" align="center">&nbsp;</td></tr>
</table>
<?php } ?>
<div id="pg">
<?php if($page>1) { ?>
<a href="<?php echo $web_path;?>scorelist.php?type=<?php echo $stype;?>&page=1">[首页]</a>                                                                                                          
<a href="<?php echo $web_path;?>scorelist.php?type=<?php echo $stype;?>&page=<?php echo $page_front;?>">前一页</a>
<?php } if($pagecount>1) { echo $pagelinks;?>
<?php } if($page<$pagecount) { ?>
<a href="<?php echo $web_path;?>scorelist.php?type=<?php echo $stype;?>&page=<?php echo $page_next;?>">下一页</a>                                                                                                                        
<a href="<?php echo $web_path;?>scorelist.php?type=<?php echo $stype;?>&page=<?php echo $pagecount;?>">[尾页]</a>
<?php } ?>
                     
</div>
</div>
</div>
<div id="right2">
&nbsp;
</div>
</div>
<br />
<?php include template('footer'); ?>
