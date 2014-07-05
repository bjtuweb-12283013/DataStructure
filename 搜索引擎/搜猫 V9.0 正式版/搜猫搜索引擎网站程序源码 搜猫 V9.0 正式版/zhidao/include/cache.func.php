<?php

/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-1-19
	Author: zhaoshunyao
	QQ: 240508015
*/


function updatecache($cachename = '')
{
	global $db, $bbname, $tablepre, $maxbdays;

	static $cachescript = array
		(
		'settings'	=> array('settings'),
		'usergroups'	=> array('usergroups'),
		'ipbanned'	=> array('ipbanned'),

		);

	if($maxbdays) 
	{
		$cachescript['birthdays'] = array('birthdays');
		$cachescript['index'][]   = 'birthdays_index';
	}

	$updatelist = empty($cachename) ? array_values($cachescript) : (is_array($cachename) ? array('0' => $cachename) : array(array('0' => $cachename)));
	$updated = array();
	foreach($updatelist as $value) 
	{
		foreach($value as $cname) 
		{
			if(empty($updated) || !in_array($cname, $updated)) 
			{
				$updated[] = $cname;
				getcachearray($cname);
			}
		}
	}

	foreach($cachescript as $script => $cachenames) 
	{
		if(empty($cachename) || (!is_array($cachename) && in_array($cachename, $cachenames)) || (is_array($cachename) && array_intersect($cachename, $cachenames))) 
		{
			$cachedata = '';
			$query = $db->query("SELECT data FROM {$tablepre}caches WHERE cachename in(".implodeids($cachenames).")");
			while($data = $db->fetch_array($query)) 
			{
				$cachedata .= $data['data'];
			}
			writetocache($script, $cachenames, $cachedata);
		}
	}

	if(!$cachename || $cachename == 'admingroups') 
	{
		$query = $db->query("SELECT * FROM {$tablepre}admingroups");
		while($data = $db->fetch_array($query))
		{
			writetocache($data['admingid'], '', getcachevars($data), 'admingroup_');
		}
	}
}

function updatesettings() 
{
	global $_DCACHE;
	if(isset($_DCACHE['settings']) && is_array($_DCACHE['settings'])) 
	{
		writetocache('settings', '', '$_DCACHE[\'settings\'] = '.arrayeval($_DCACHE['settings']).";\n\n");
	}
}

function writetocache($script, $cachenames, $cachedata = '', $prefix = 'cache_') 
{
	global $authkey;

	if(is_array($cachenames) && !$cachedata) 
	{
		foreach($cachenames as $name) 
		{
			$cachedata .= getcachearray($name, $script);
		}
	}
	
	$dir = CYASK_ROOT.'./askdata/cache/';
	if(!is_dir($dir)) 
	{
		@mkdir($dir, 0777);
	}
	if($fp = @fopen("$dir$prefix$script.php", 'wb'))
	{
		fwrite($fp, "<?php\n//Cyask cache file, DO NOT modify me!".
			"\n//Created: ".date("M j, Y, G:i").
			"\n//Identify: ".md5($prefix.$script.'.php'.$cachedata.$authkey)."\n\n$cachedata?>");
		fclose($fp);
	} 
	else 
	{
		exit('Can not write to cache files, please check directory ./askdata/ and ./askdata/cache/ .');
	}
}

function getcachearray($cachename, $script = '')
{
	global $db, $timestamp, $tablepre, $timeoffset, $maxbdays, $charset;

	$cols = '*';
	$conditions = '';
	switch($cachename)
	{
		case 'settings':
			$table = 'set';
			$conditions = "";
			break;
			
		case 'ipbanned':
			$db->query("DELETE FROM {$tablepre}banned WHERE expiration<'$timestamp'");
			$table = 'banned';
			$cols = 'ip1, ip2, ip3, ip4, expiration';
			break;
	}

	$data = array();

	if(empty($table) || empty($cols)) return '';
	
	$query = $db->query("SELECT $cols FROM {$tablepre}$table $conditions");
	
	switch($cachename) 
	{
		case 'settings':
			while($setting = $db->fetch_array($query)) 
			{
				if($setting['type'] == 'number') 
				{
					$setting['value'] = $setting['value'];
				} 
				 
				elseif($setting['type'] == 'array') 
				{
					$setting['value'] = unserialize($setting['value']);
				}
				else
				{
					$setting['value'] = $setting['value'];
				}
				$GLOBALS[$setting['variable']] = $data[$setting['variable']] = $setting['value'];
			}


			$outextcreditsrcs = $outextcredits = array();
			foreach((array)$data['outextcredits'] as $value)
			{
				$outextcreditsrcs[$value['creditsrc']] = $value['creditsrc'];
				$key = $value['appiddesc'].'|'.$value['creditdesc'];
				if(!isset($outextcredits[$key]))
				{
					$outextcredits[$key] = array('title' => $value['title'], 'unit' => $value['unit']);
				}
				$outextcredits[$key]['ratiosrc'][$value['creditsrc']] = $value['ratiosrc'];
				$outextcredits[$key]['ratiodesc'][$value['creditsrc']] = $value['ratiodesc'];
				$outextcredits[$key]['creditsrc'][$value['creditsrc']] = $value['ratio'];
			}
			$data['outextcredits'] = $outextcredits;

			$exchcredits = array();
			$allowexchangein = $allowexchangeout = FALSE;
			foreach((array)$data['extcredits'] as $id => $credit) 
			{
				$data['extcredits'][$id]['img'] = $credit['img'] ? '<img style="vertical-align:middle" src="'.$credit['img'].'" />' : '';
				if(!empty($credit['ratio'])) 
				{
					$exchcredits[$id] = $credit;
					$credit['allowexchangein'] && $allowexchangein = TRUE;
					$credit['allowexchangeout'] && $allowexchangeout = TRUE;
				}
				$data['creditnotice'] && $data['creditnames'][] = str_replace("'", "\'", htmlspecialchars($id.'|'.$credit['title'].'|'.$credit['unit']));
			}
			$data['creditnames'] = $data['creditnotice'] ? implode(',', $data['creditnames']) : '';

			$creditstranssi = explode(',', $data['creditstrans']);
			$data['creditstrans'] = $creditstranssi[0];
			unset($creditstranssi[0]);
			$data['creditstransextra'] = $creditstranssi;
			for($i = 1;$i < 5;$i++) 
			{
				$data['creditstransextra'][$i] = !$data['creditstransextra'][$i] ? $data['creditstrans'] : $data['creditstransextra'][$i];
			}
			$data['exchangestatus'] = $allowexchangein && $allowexchangeout;
			$data['transferstatus'] = isset($data['extcredits'][$data['creditstrans']]);
		

			require_once CYASK_ROOT.'./uc_client/client.php';
			$ucapparray = uc_app_ls();
			$data['allowsynlogin'] = isset($ucapparray[UC_APPID]['synlogin']) ? $ucapparray[UC_APPID]['synlogin'] : 1;
			$appnamearray = array('UCHOME','XSPACE','DISCUZ','SUPESITE','SUPEV','ECSHOP','ECMALL','CYASK');
			$data['ucapp'] = $data['ucappopen'] = array();
			$data['uchomeurl'] = '';
			$appsynlogins = 0;
			foreach($ucapparray as $apparray) 
			{
				if($apparray['appid'] != UC_APPID) 
				{
					if(!empty($apparray['synlogin'])) 
					{
						$appsynlogins = 1;
					}
					if($data['uc']['navlist'][$apparray['appid']] && $data['uc']['navopen']) 
					{
						$data['ucapp'][$apparray['appid']]['name'] = $apparray['name'];
						$data['ucapp'][$apparray['appid']]['url'] = $apparray['url'];
					}
				}
				$data['ucapp'][$apparray['appid']]['viewprourl'] = $apparray['url'].$apparray['viewprourl'];
				foreach($appnamearray as $name) 
				{
					if($apparray['type'] == $name && $apparray['appid'] != UC_APPID) 
					{
						$data['ucappopen'][$name] = 1;
						if($name == 'UCHOME') 
						{
							$data['uchomeurl'] = $apparray['url'];
						} 
						elseif($name == 'XSPACE') 
						{
							$data['xspaceurl'] = $apparray['url'];
						}
					}
				}
			}
			
			include language('runtime');
			$dlang['date'] = explode(',', $dlang['date']);
			$data['dlang'] = $dlang;

			break;


		case 'ipbanned':
			if($db->num_rows($query)) 
			{
				$data['expiration'] = 0;
				$data['regexp'] = $separator = '';
			}
			while($banned = $db->fetch_array($query)) 
			{
				$data['expiration'] = !$data['expiration'] || $banned['expiration'] < $data['expiration'] ? $banned['expiration'] : $data['expiration'];
				$data['regexp'] .=	$separator.
							($banned['ip1'] == '-1' ? '\\d+\\.' : $banned['ip1'].'\\.').
							($banned['ip2'] == '-1' ? '\\d+\\.' : $banned['ip2'].'\\.').
							($banned['ip3'] == '-1' ? '\\d+\\.' : $banned['ip3'].'\\.').
							($banned['ip4'] == '-1' ? '\\d+' : $banned['ip4']);
				$separator = '|';
			}
			break;
			
		default:
			while($datarow = $db->fetch_array($query))
			{
				$data[] = $datarow;
			}
	}

	$dbcachename = $cachename;

	$curdata = "\$_DCACHE['$cachename'] = ".arrayeval($data).";\n\n";
	$db->query("REPLACE INTO {$tablepre}caches (cachename, type, dateline, data) VALUES ('$dbcachename', '1', '$timestamp', '".addslashes($curdata)."')");

	return $curdata;
}

function getcachevars($data, $type = 'VAR') 
{
	$evaluate = '';
	foreach($data as $key => $val) 
	{
		if(is_array($val)) 
		{
			$evaluate .= "\$$key = ".arrayeval($val).";\n";
		} 
		else 
		{
			$val = addcslashes($val, '\'\\');
			$evaluate .= $type == 'VAR' ? "\$$key = '$val';\n" : "define('".strtoupper($key)."', '$val');\n";
		}
	}
	return $evaluate;
}

function pluginmodulecmp($a, $b) 
{
	return $a['displayorder'] > $b['displayorder'] ? 1 : -1;
}

function smthumb($size, $smthumb = 50) 
{
	if($size[0] <= $smthumb && $size[1] <= $smthumb) 
	{
		return array('w' => $size[0], 'h' => $size[1]);
	}
	$sm = array();
	$x_ratio = $smthumb / $size[0];
	$y_ratio = $smthumb / $size[1];
	if(($x_ratio * $size[1]) < $smthumb) 
	{
		$sm['h'] = ceil($x_ratio * $size[1]);
		$sm['w'] = $smthumb;
	} else {
		$sm['w'] = ceil($y_ratio * $size[0]);
		$sm['h'] = $smthumb;
	}
	return $sm;
}

function parsehighlight($highlight)
{
	if($highlight) {
		$colorarray = array('', 'red', 'orange', 'yellow', 'green', 'cyan', 'blue', 'purple', 'gray');
		$string = sprintf('%02d', $highlight);
		$stylestr = sprintf('%03b', $string[0]);

		$style = ' style="';
		$style .= $stylestr[0] ? 'font-weight: bold;' : '';
		$style .= $stylestr[1] ? 'font-style: italic;' : '';
		$style .= $stylestr[2] ? 'text-decoration: underline;' : '';
		$style .= $string[1] ? 'color: '.$colorarray[$string[1]] : '';
		$style .= '"';
	} else {
		$style = '';
	}
	return $style;
}

function arrayeval($array, $level = 0)
{

	if(!is_array($array)) 
	{
		return "'".$array."'";
	}
	if(is_array($array) && function_exists('var_export')) 
	{
		return var_export($array, true);
	}

	$space = '';
	for($i = 0; $i <= $level; $i++) 
	{
		$space .= "\t";
	}
	$evaluate = "Array\n$space(\n";
	$comma = $space;
	if(is_array($array)) 
	{
		foreach($array as $key => $val) 
		{
			$key = is_string($key) ? '\''.addcslashes($key, '\'\\').'\'' : $key;
			$val = !is_array($val) && (!preg_match("/^\-?[1-9]\d*$/", $val) || strlen($val) > 12) ? '\''.addcslashes($val, '\'\\').'\'' : $val;
			if(is_array($val)) 
			{
				$evaluate .= "$comma$key => ".arrayeval($val, $level + 1);
			} 
			else 
			{
				$evaluate .= "$comma$key => $val";
			}
			$comma = ",\n$space";
		}
	}
	$evaluate .= "\n$space)";
	return $evaluate;
}

?>