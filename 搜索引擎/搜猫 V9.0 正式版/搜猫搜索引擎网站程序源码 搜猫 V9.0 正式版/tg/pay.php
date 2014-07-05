<?php

require_once('global.php');
is_login();
;echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>首页</title>
        <link type="text/css" rel="stylesheet" media="all" href="images/global.css" />   
        <script language=JavaScript>
function CheckForm()
{
	if (document.alipayment.subject.value.length == 0) {
		alert("请输入商品名称.");
		document.alipayment.subject.focus();
		return false;
	}
	if (document.alipayment.total_fee.value.length == 0) {
		alert("请输入付款金额.");
		document.alipayment.total_fee.focus();
		return false;
	}
	var reg	= new RegExp(/^\\d+$/);
	if (! reg.test(document.alipayment.total_fee.value))
	{
        alert("请正确输入付款金额");
		document.alipayment.total_fee.focus();
		return false;
	}
	if (Number(document.alipayment.total_fee.value) < 1) {
		alert("付款金额金额最小是1.");
		document.alipayment.total_fee.focus();
		return false;
	}
	function getStrLength(value){
        return value.replace(/[^\\x00-\\xFF]/g,\'**\').length;
    }
    if(getStrLength(document.alipayment.alibody.value) > 200){
        alert("备注过长！请在100个汉字以内");
        document.alipayment.alibody.focus();
        return false;
    }
    if(getStrLength(document.alipayment.subject.value) > 256){
        alert("标题过长！请在128个汉字以内");
        document.alipayment.subject.focus();
        return false;
    }

	document.aplipayment.alibody.value = document.aplipayment.alibody.value.replace(/\\n/g,\'\');
}  

</script>
<style>
*{
	margin:0;
	padding:0;
}
ul,ol{
	list-style:none;
}
.title{
    color: #ADADAD;
    font-size: 14px;
    font-weight: bold;
    padding: 8px 16px 5px 10px;
}
.hidden{
	display:none;
}

.new-btn-login-sp{
	border:1px solid #D74C00;
	padding:1px;
	display:inline-block;
}

.new-btn-login{
    background-color: transparent;
    background-image: url("images/new-btn-fixed.png");
    border: medium none;
}
.new-btn-login{
    background-position: 0 -198px;
    width: 82px;
	color: #FFFFFF;
    font-weight: bold;
    height: 28px;
    line-height: 28px;
    padding: 0 10px 3px;
}
.new-btn-login:hover{
	background-position: 0 -167px;
	width: 82px;
	color: #FFFFFF;
    font-weight: bold;
    height: 28px;
    line-height: 28px;
    padding: 0 10px 3px;
}
.bank-list{
	overflow:hidden;
	margin-top:5px;
}
.bank-list li{
	float:left;
	width:153px;
	margin-bottom:5px;
}

#main{
	width:750px;
	margin:0 auto;
	font-size:14px;
	font-family:\'宋体\';
}
#logo{
	background-color: transparent;
    background-image: url("images/new-btn-fixed.png");
    border: medium none;
	background-position:0 0;
	width:166px;
	height:35px;
    float:left;
}
.red-star{
	color:#f00;
	width:10px;
	display:inline-block;
}
.null-star{
	color:#fff;
}
.content{
	margin-top:5px;
}

.content dt{
	width:100px;
	display:inline-block;
	text-align:right;
	float:left;
	
}
.content dd{
	margin-left:100px;
	margin-bottom:5px;
}
#foot{
	margin-top:10px;
}
.foot-ul li {
	text-align:center;
}
.note-help {
    color: #999999;
    font-size: 12px;
    line-height: 130%;
    padding-left: 3px;
}

.cashier-nav {
    font-size: 14px;
    margin: 15px 0 10px;
    text-align: left;
    height:30px;
    border-bottom:solid 2px #CFD2D7;
}
.cashier-nav ol li {
    float: left;
}
.cashier-nav li.current {
    color: #AB4400;
    font-weight: bold;
}
.cashier-nav li.last {
    clear:right;
}
.alipay_link {
    text-align:right;
}
.alipay_link a:link{
    text-decoration:none;
    color:#8D8D8D;
}
.alipay_link a:visited{
    text-decoration:none;
    color:#8D8D8D;
}
</style>
</head>
	<body>
';
headhtml();
;echo '        	    
<div class="wrapper">
<div id="main">
		<div id="head">
			<div id="logo"></div>

  <span class="title">支付宝即时到帐付款快速通道</span>
			<!--<div id="title" class="title">支付宝即时到帐付款快速通道</div>-->
		</div>
        <div class="cashier-nav">
            <ol>
                <li class="current">1、确认付款信息 &rarr;</li>
                <li>2、付款 &rarr;</li>
                <li class="last">3、付款完成</li>
            </ol>
        </div>
        <form name=alipayment onSubmit="return CheckForm();" action=alipayto.php method=post target="_blank">
            <div id="body" style="clear:left">
                <dl class="content">
                   <dt>充值金额：</dt>
                    <dd>
                        <span class="red-star">*</span>
                        <input name=total_fee onfocus="if(Number(this.value)==0){this.value=\'\';}" value="100" size=30 maxLength=10/>
                        <span>如：100</span> | 充值比例：1元RMB=10积分</dd>

                    <dt></dt>
                    <dd >
                        <span class="new-btn-login-sp" >
                        <button class="new-btn-login" type="submit" style="text-align:center;">确认付款</button>
                      </span>                  </dd>
                </dl>
          </div>
		</form>
        <div id="foot">
			<ul class="foot-ul">
				<li>
					<font class=note-help>如果您点击&ldquo;确认付款&rdquo;按钮，即表示您同意向卖家购买此物品。 
					  <br/>
					  您有责任查阅完整的物品登录资料，包括卖家的说明和接受的付款方式。卖家必须承担物品信息正确登录的责任！ 
					</font>
				</li>
		
		  </ul>
	
		</div>
	</div>
'
?>