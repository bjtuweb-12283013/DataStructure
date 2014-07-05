<?php if(!defined('IN_CYASK')) exit('Access Denied'); include template('header'); ?>
<div id="middle">
<div id="left">
<div class="t3 bcb"><div class="t3t bgb">问题分类</div></div>
<div class="b3 bcb mb12">
<span class="grn">已解决问题数 <?php echo $solve_ques_count;?><br />待解决问题数 <?php echo $nosolve_ques_count;?></span><hr size="1" color="#999999" />
<?php if(is_array($sort1_list)) { foreach($sort1_list as $key => $qs1) { ?>
<span class="f14b"><a href="<?php echo $web_path;?>browse.php?sortid=<?php echo $qs1['sid'];?>"><?php echo $qs1['sort'];?></a></span> (<?php echo $qs1['qcount'];?>)<br />
<?php if(is_array($sort2_list[$key])) { foreach($sort2_list[$key] as $qs2) { ?>
<a class="sort" href="<?php echo $web_path;?>browse.php?sortid=<?php echo $qs2['sid'];?>"><?php echo $qs2['sort'];?></a>&nbsp;&nbsp;
<?php if(!($qs2['id']%3)) { ?>
<br />
<?php } } } ?>
<a href="<?php echo $web_path;?>browse.php?sortid=<?php echo $qs1['sid'];?>">&gt&gt</a><br />
<br class="per80" />
<?php } } ?>
</div>
</div>
<div id="right">
<div class="t3 bcy"><div class="t3t bgy"><a class=lbk href="notelist.php" target="_blank">站内公告</a></div></div>
<div class="b3 bcy f14 mb12">
<?php if(is_array($notice_list)) { foreach($notice_list as $nl) { ?>
&#8226; <a class="lq" href="<?php echo $nl['id'];?>" target="_blank" title="<?php echo $nl['title'];?>"><?php echo $nl['stitle'];?></a><br />
<?php } } ?>
<div class="lmore"><a class="lmore" href="notelist.php" target="_blank">更多&gt&gt</a></div>
</div>

<div class="t3 bcy"><div class="t3t bgy"><a class="lbk" href="scorelist.php">总积分排行榜</a></div></div>
<div class="b3 bcy mb12">
<table cellspacing=0 cellpadding=0 width="100%" border="0">
<?php if(is_array($scorelist)) { foreach($scorelist as $sl) { ?>
<tr><td class="ln23" width="50%">
<?php echo $sl['orderid'];?>&nbsp;<a href="member.php?uid=<?php echo $sl['uid'];?>" target="_blank"><?php echo $sl['username'];?></a></td>
<td class="ln23" width="50%" align="right"><?php echo $sl['allscore'];?>&nbsp;&nbsp;</td></tr>
<?php } } ?>
</table>
<div class="lmore"><a class="lmore" href="scorelist.php">更多&gt&gt</a>&nbsp;&nbsp;</div>
</div>

<div class="t3 bcy"><div class="t3t bgy"><a class="lbk" href="scorelist.php?stype=week">上周积分排行榜</a></div></div>
<div class="b3 bcy mb12">
<table cellspacing=0 cellpadding=0 width="100%" border="0">
<?php if(is_array($weeklist)) { foreach($weeklist as $sl) { ?>
<tr><td class="ln23" width="50%">
<?php echo $sl['orderid'];?>&nbsp;<a href="member.php?uid=<?php echo $sl['uid'];?>" target="_blank"><?php echo $sl['username'];?></a></td>
<td class="ln23" width="50%" align="right"><?php echo $sl['wscore'];?>&nbsp;&nbsp;</td></tr>
<?php } } ?>
</table>
<div class="lmore"><a class="lmore" href="scorelist.php?stype=week">更多&gt&gt</a>&nbsp;&nbsp;</div>
</div>

</div>
<div id="center">

<div class="t3 bcg"><div class="t3t bgg"><a href="<?php echo $web_path;?>browse.php?type=6" class="lbk">推荐的问题</a></div></div>
<div id="intro" class="b3 bcg mb12 qlist">
<?php if(is_array($intro_ques)) { foreach($intro_ques as $ql) { ?>
&#8226;&nbsp;<a class="lq" href="<?php echo $web_path;?><?php echo $ql['url'];?>" target="_blank"><?php echo $ql['title'];?></a>&nbsp;&nbsp;[<a class="lgy" href="<?php echo $web_path;?>browse.php?sortid=<?php echo $ql['sid'];?>"><?php echo $ql['sort'];?></a>]<br />
 
<?php } } ?>
<div class="lmore"><a href="<?php echo $web_path;?>browse.php?type=6" class="lmore">更多&gt&gt</a></div>
</div>

<div class="t3 bcg"><div class="t3t bgg"><a href="<?php echo $web_path;?>browse.php?type=1" class="lbk">待解决问题</a></div></div>
<div id="nosolve" class="b3 bcg mb12 qlist">
<?php if(is_array($nosolve_ques)) { foreach($nosolve_ques as $ql) { ?>
&#8226;&nbsp;<a class="lq" href="<?php echo $web_path;?><?php echo $ql['url'];?>" target="_blank"><?php echo $ql['title'];?></a>&nbsp;&nbsp;[<a href="<?php echo $web_path;?>browse.php?sortid=<?php echo $ql['sid'];?>" class="lgy"><?php echo $ql['sort'];?></a>]<br />
 
<?php } } ?>
<div class="lmore"><a href="<?php echo $web_path;?>browse.php?type=1" class="lmore">更多&gt&gt</a></div>
</div>

<div class="t3 bcg"><div class="t3t bgg"><a href="<?php echo $web_path;?>browse.php?type=2" class="lbk">已解决问题</a></div></div>
<div id="solve" class="b3 bcg mb12 qlist">
<?php if(is_array($solve_ques)) { foreach($solve_ques as $ql) { ?>
&#8226;&nbsp;<a class="lq" href="<?php echo $web_path;?><?php echo $ql['url'];?>" target="_blank"><?php echo $ql['title'];?></a>&nbsp;&nbsp;[<a href="<?php echo $web_path;?>browse.php?sortid=<?php echo $ql['sid'];?>" class="lgy"><?php echo $ql['sort'];?></a>]<br />
<?php } } ?>
<div class="lmore"><a href="<?php echo $web_path;?>browse.php?type=2" class="lmore">更多&gt&gt</a></div>
</div>

</div>
</div>
<?php include template('footer'); ?>
