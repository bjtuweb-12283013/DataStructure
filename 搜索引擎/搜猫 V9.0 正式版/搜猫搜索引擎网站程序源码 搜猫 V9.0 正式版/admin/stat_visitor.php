<?php

require 'global.php';
headhtml();
;echo '<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
  <tr>
    <th width="50">&nbsp;</th>
    <th>IP</th>
    <th>来访时间</th>
    <th>来访地址</th>
  </tr>
';
$sql='select * from ve123_stat_visitor ';
$result=$db->query($sql);
$total=$db->num_rows($result);
$pagesize=30;
$totalpage=ceil($total/$pagesize);
$page=intval($_GET['page']);
if($page<=0){$page=1;}
$offset=($page-1)*$pagesize;
$result=$db->query($sql." order by v_id desc limit $offset,$pagesize");
while($row=$db->fetch_array($result))
{
;echo '  <tr>
    <td>&nbsp;</td>
    <td>';echo $row['v_ip'];;echo '</td>
    <td>';echo $row['v_time'];;echo '</td>
    <td>';echo $row['http_referer'];;echo '</td>
  </tr>
    ';
}
;echo '</table>
';
echo pageshow($page,$totalpage,$total,'?');
?>