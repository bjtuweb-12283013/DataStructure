<?php

require 'global.php';
require('class/connect.php');
require('class/db_sql.php');
require('class/functions.php');
require LoadLang('f.php');
$rnd=$lur['rnd'];
$link=db_connect();
$empire=new mysqlquery();
if(!empty($phome_db_dbname))
{
echo $fun_r['GotoDefaultDb']."<script>self.location.href='ChangeTable.php?mydbname=".$phome_db_dbname."'</script>";
exit();
}
$sql=$empire->query('SHOW DATABASES');
require LoadAdminTemp('eChangeDb.php');
db_close();
$empire=null;

?>