<?php
$lang = array
(
	'install_wizard' => 'Cyask 安装向导',
	'welcome' => '欢迎来到 Cyask 安装向导，安装前请仔细阅读 license 档的每个细节，在您确定可以完全满足 Cyask 的授权协议之后才能开始安装。<br />readme 档提供了有关软件安装的说明，请您同样仔细阅读，以保证安装进程的顺利进行。',
	'current_process' => '当前状态:',
	'show_license' => 'Cyask! 用户许可协议',
	'agreement' => '请您务必仔细阅读下面的许可协议',
	'agreement_yes' => '我完全同意',
	'agreement_no' => '我不能同意',

	'succeed' => '成功',
	'fail' => '失败',
	'exit' => '退出安装向导',
	'enabled' => '允许',
	'writeable' => '可写',
	'unwriteable' => '不可写',
	'yes' => '可',
	'no' => '不可',
	'unlimited' => '不限',
	
	'edit_config' => '浏览/编辑当前配置',
	'variable' => '设置选项',
	'value' => '当前值',
	'comment' => '注释',
	'init_log' => '初始化记录',
	'clear_dir' => '清空目录',
	'select_db' => '选择数据库',
	'create_table' => '建立数据表',
	
	'check_config' => '检查配置文件状态',
	'check_existence' => '存在检查',
	'check_writeable' => '可写检查',
	'confirm_config' => '上述配置正确',
	'refresh_config' => '刷新修改结果',
	'recheck_config' => '重新检查设置',
	'save_config' => '保存配置信息',
		
	'config_nonexistence' => '您的 config.inc.php 不存在, 无法继续安装, 请用 FTP 将该文件上传后再试.',
	'config_unwriteable' => '安装向导无法写入配置文件, 请核对现有信息, 如需修改, 请通过 FTP 将改好的 config.inc.php 上传.',
	
	'config_ucenter' => '配置 UCenter',
	'ucenter_url' => 'UCenter 的 URL:',
	'ucenter_url_comment' => '例如：http://www.xxx.com/ucenter',
	'ucenter_founder' => 'UCenter 的创始人密码:',
	'config_ucenter_comment' => '<strong># 请填写 UCenter 的相关参数</strong><br />使用Cyask for UC，首先需要您的站点安装有统一存储用户帐号信息的UCenter用户中心系统。<br />
		如果您的站点还没有安装过UCenter，请这样操作：<br />
		1. <a href="http://download.comsenz.com/UCenter/" target="_blank"><font color="blue"><u>请点击这里下载最新版本的UCenter</u></font></a>，并阅读程序包中的说明进行UCenter的安装。<br />
		2. 安装完毕 UCenter 后，在下面填入UCenter的相关信息即可继续进行 Cyask 的安装。',
	'save_config_ucenter' => '提交UCenter配置信息',
	
	'tagtemplates_subject' => '标题',
	'tagtemplates_uid' => '用户 ID',
	'tagtemplates_username' => '提问者',
	'tagtemplates_dateline' => '日期',
	'tagtemplates_url' => '问题地址',
	
	'config_cyaskdb' => '配置Cyask数据库',
	'dbhost' => '数据库服务器:',
	'dbhost_comment' => '数据库服务器地址, 一般为 localhost',
	'dbuser' => '数据库用户名:',
	'dbuser_comment' => '数据库账号用户名',
	'dbpw' => '数据库密码:',
	'dbpw_comment' => '数据库账号密码',
	'dbname' => '数据库名:',
	'dbname_comment' => '数据库名称',
	'email' => '系统 Email:',
	'email_comment' => '用于发送程序错误报告',
	'tablepre' => '数据库表名前缀:',
	'tablepre_comment' => '方便区分数据库表，建议用默认值',
	'config_cyaskdb_comment' => '请在下面填写您的数据库账号信息, 通常情况下不需要修改红色选项内容。',
	
	'create_cyaskdb' => '创建Cyask数据库',
	'choice_or_new_db' => '请选择已存在的数据库或者新建一个数据库存放cyask数据<br />',
	'show_and_edit_db_conf' => '浏览/编辑当前数据库配置',
	'choice_one_db' => '请指定一个数据库',
	'db' => '数据库',
	'check_user_and_pass' => '检查数据库账号权限',
	'permission' => '权限',
	'status' => '状态',
	'init_conf' => '初始功能方案设定',

	'db_set' => '请设置安装cyask的数据库',
	'db_use_existence' => '使用已存在的数据库',
	'db_create_new' => '创建新的数据库',
	
	'init_file' => '初始化运行目录与文件',
	'check_env' => '检查当前服务器环境',
	'compare_env' => 'Cyask 所需环境和当前服务器配置对比',
	'env_required' => 'Cyask 所需配置',
	'env_best' => 'Cyask 最佳配置',
	'env_current' => '当前服务器',
	'confirm_preparation' => '请确认已完成如下步骤',
	'install_note' => '安装向导提示',
	'install_interrupt' => '安装过程中断',
	'config_admin' => '设置管理员账号',
	'config_admin_comment' => '<strong># 请填写Cyask的管理员信息</strong><br />建议使用UCenter已注册用户作为管理员。',
	'start_install' => '开始安装 Cyask',
	'finish_install' => '完成安装',
	'installing' => '检查管理员账号信息并开始安装 Cyask。',
	'check_admin' => '检查管理员账号',
	'check_admin_validity' => '检查信息合法性',
	'admin_username_invalid1' => '你填写的管理员用户名不合法.',
	'admin_username_invalid2' => '你填写的管理员用户名包含不允许注册的词语.',
	'admin_username_invalid4' => '你填写的管理员Email 格式有误.',
	'admin_username_invalid5' => '你填写的管理员Email 不允许注册.',
	'admin_username_invalid6' => '你填写的管理员Email 已经被注册.',
	'admin_password_invalid' => '两次输入密码不一致.',
	'admin_email_invalid' => 'Email 地址无效',
	'admin_invalid' => '您的信息没有填写完整.',
	'fail_reason' => '失败. 原因:',
	'go_back' => '返回上一页修改',

	'env_os' => '操作系统',
	'env_php' => 'PHP 版本',
	'env_mysql' => 'MySQL 版本',
	'env_attach' => '附件上传',
	'env_diskspace' => '磁盘空间',
	'env_dir_writeable' => '目录写入',
	
	'php_version_435' => '您的 PHP 版本小于 4.3.5, 无法使用 Cyask。',
	'attach_enabled' => '允许/最大尺寸 ',
	'attach_enabled_info' => '您可以上传附件的最大尺寸: ',
	'attach_disabled' => '不允许上传附件',
	'attach_disabled_info' => '附件上传或相关操作被服务器禁止。',
	'mysql_version_323' => '您的 MySQL 版本低于 3.23，安装无法继续进行。',
	'unwriteable_template' => '模板目录(./templates)属性非 777 或无法写入，在线编辑模板功能将无法使用。',
	'unwriteable_askdata' => '数据目录(./askdata)属性非 777 或无法写入，程序运行记录和备份到数据库功能将无法使用。',
	'unwriteable_askdata_template' => '编译模板目录(./askdata/templates)属性非 777 或无法写入，安装无法继续进行。',
	'unwriteable_askdata_cache' => '数据缓存目录(./askdata/cache)属性非 777 或无法写入，安装无法继续进行。',
	'tablepre_invalid' => '您指定的数据表前缀包含点字符(".")，请返回修改。',
	'db_invalid' => '指定的数据库不存在, 系统也无法自动建立, 无法安装 Cyask!.',
	'db_auto_created' => '指定的数据库不存在, 但系统已成功建立, 可以继续安装.',
	'db_not_null' => '数据库中已经安装过 Cyask, 继续安装会清空原有数据.',
	'db_drop_table_confirm' => '继续安装会清空全部原有数据，您确定要继续吗?',

	'install_abort' => '由于您目录属性或服务器配置原因, 无法继续安装 Cyask, 请仔细阅读安装说明.',
	'install_process' => '您的服务器可以安装和使用 Cyask, 请进入下一步安装.',
	'install_succeed' => '恭喜您，Cyask 安装成功！',
	'goto_cyask' => '点击这里进入Cyask',

	'username' => '管理员账号:',
	'password' => '管理员密码:',
	'repeat_password' => '重复密码:',
	'admin_email' => '管理员 Email:',
	
	'init_default_style' => '默认风格',
	'init_default_forum' => '默认分类',
	'init_default_template' => '默认模板套系',
	'init_default_template_copyright' => '赛问工作室',


	'license' => '
<p>感谢您选择 Cyask 问答产品，您可以免费使用Cyask普通版本。希望我们的努力能为您提供一个高效快速和强大的互助社区解决方案。

<p>赛问网为 Cyask 产品的开发者， 官方网站网址为 http://www.cyask.com。

<p>无论个人或组织、盈利与否、用途如何（包括以学习和研究为目的），均需Cyask同意授权后才可以改动源代码。源代码不得作为任何商业用途。 

<p><b>有限担保和免责声明</b>
<ul>
<li>本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的。
<li>用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未购买产品技术服务之前，我们不承诺提供任何形式的技术支持、使用担保，
也不承担任何因使用本软件而产生问题的相关责任。
<li>赛问网不对使用本软件构建的问吧中的问题或回答，以及评论承担责任。
</ul>',

	'preparation' => '<li>将压缩包中 Cyask 目录下全部文件和目录上传到服务器.</li><li>修改服务器上的 config.inc.php 文件以适合您的配置, 有关数据库账号信息请咨询您的空间服务提供商.</li><li>如果您使用非 WINNT 系统请修改以下属性:<br>
	&nbsp; &nbsp; <b>./templates</b> 目录 777;&nbsp; &nbsp; <b>./attachments</b> 目录 777;&nbsp; &nbsp; <b>./askdata</b> 目录 777;<br>
	<b>&nbsp; &nbsp; ./askdata/cache</b> 目录 777;&nbsp; &nbsp; <b>./askdata/templates</b> 目录 777;</li>',

);

?>