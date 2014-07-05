<dl><?php
if ($_obj['loginArr']['state'] == "1"){
?><?php
if ($_obj['loginArr']['group'] == "6"){
?><dd><a href="./admin.php" target="_blank">系统管理</a></dd><?php
}
?><dd><a href="./profile.php" target="_top">个人中心</a></dd><dd><a href="./login.php?do=logout" target="_top">退出</a></dd><?php
} else {
?><dd><a href="./register.php?height=216&width=296&modal=true" class="thickbox">注册</a></dd><dd><a href="./login.php?height=142&width=308" class="thickbox" title="登录到<?php
echo $_obj['siteName'];
?>
">登录</a></dd><dd><a href="./recoverpass.php?height=175&width=282&modal=true" class="thickbox">忘记密码</a></dd><?php
}
?></dl>