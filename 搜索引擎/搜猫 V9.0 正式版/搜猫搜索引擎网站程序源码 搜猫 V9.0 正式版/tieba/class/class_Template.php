<?php
	class phpSayTemplate
	{
		var $reuse_code		= true;

		var $template_dir	= '_template/';

		var $temp_dir		= '_cache/';

		var $cache_dir      = '_cache/';

		var $cache_lifetime =  600;

		var $cache_filename;

		var $tpl_file;

		var $cpl_file;

		var $data = array();

		var $parser;

		function phpSayTemplate ( $template_filename = '' )
		{
			$this->tpl_file  =  $template_filename;
		}

		function set_templatefile ($template_filename)	{	$this->tpl_file  =  $template_filename;	}
		function add_value ($name, $value )				{	$this->assign($name, $value);	}
		function add_array ($name, $value )				{	$this->append($name, $value);	}

		function assign ( $name, $value = '' )
		{
			if (is_array($name))
			{
				foreach ($name as $k => $v)
				{
					$this->data[$k]  =  $v;
				}
			}
			else
			{
				$this->data[$name]  =  $value;
			}
		}

		function append ( $name, $value )
		{
			if (is_array($value))
			{
				$this->data[$name][]  =  $value;
			}
			elseif (!is_array($this->data[$name]))
			{
				$this->data[$name]  .=  $value;
			}
		}

		function result ( $_top = '' )
		{
			ob_start();
			$this->output( $_top );
			$result  =  ob_get_contents();
			ob_end_clean();
			return $result;
		}

		function output ( $_top = '' )
		{
			global $_top;

			if (strlen($this->template_dir)  &&  substr($this->template_dir, -1) != '/')
			{
				$this->template_dir  .=  '/';
			}
			if (strlen($this->temp_dir)  &&  substr($this->temp_dir, -1) != '/')
			{
				$this->temp_dir  .=  '/';
			}

			if (!is_array($_top))
			{
				if (strlen($_top))
				{
					$this->tpl_file  =  $_top;
				}
				$_top  =  $this->data;
			}
			$_obj  =  &$_top;
			$_stack_cnt  =  0;
			$_stack[$_stack_cnt++]  =  $_obj;

			$cpl_file_name = preg_replace('/[:\/.\\\\]/', '_', $this->tpl_file);
			if (strlen($cpl_file_name) > 0)
			{
	    		$this->cpl_file  =  $this->temp_dir . $cpl_file_name . '.php';
				$compile_template  =  true;
				if ($this->reuse_code)
				{
					if (is_file($this->cpl_file))
					{
						if ($this->mtime($this->cpl_file) > $this->mtime($this->template_dir . $this->tpl_file))
						{
							$compile_template  =  false;
						}
					}
				}
				if ($compile_template)
				{
					$this->parser = new phpSayTemplateParser($this->template_dir . $this->tpl_file);
					if (!$this->parser->compile($this->cpl_file))
					{
						exit( "phpSayTemplate Parser Error: " . $this->parser->error );
					}
				}
				include($this->cpl_file);
			}
			else
			{
				exit( "phpSayTemplate Error: You must set a template file name");
			}

			unset ($_top);
		}

		function use_cache ( $key = '' )
		{
			if (empty($_POST))
			{
				$this->cache_filename  =  $this->cache_dir . 'cache_' . md5(serialize($key)) . '.html';
				if (@is_file($this->cache_filename))
				{
					if ((time() - filemtime($this->cache_filename)) < $this->cache_lifetime)
					{
						readfile($this->cache_filename);
						exit;
					}
				}
				ob_start( array( &$this, 'cache_callback' ) );
			}
		}

		function cache_callback ( $output )
		{
			if ($hd = @fopen($this->cache_filename, 'w'))
			{
				fputs($hd,  $output);
				fclose($hd);
			}
			return $output;
		}

		function mtime ( $filename )
		{
			if (@is_file($filename))
			{
				$ret = filemtime($filename);
				return $ret;
			}
		}
	}

	class phpSayTemplateParser
	{
		var $template;

		var $template_dir;

		var $extension_tagged = array();

		var $error;

		function phpSayTemplateParser ( $template_filename )
		{
			if ($hd = @fopen($template_filename, "r"))
			{
				if (filesize($template_filename))
				{
					$this->template = fread($hd, filesize($template_filename));
				}
				else
				{
					$this->template = "phpSayTemplate Parser Error: File size is zero byte: '$template_filename'";
				}
				fclose($hd);
				$this->template_dir = dirname($template_filename);
			}
			else
			{
				$this->template = "phpSayTemplate Parser Error: File not found: '$template_filename'";
			}
		}

		function compile( $compiled_template_filename = '' )
		{
			if (empty($this->template))
			{
				return;
			}

			if(preg_match("/<!-- INCLUDE/i", $this->template))
			{
				while ($this->count_subtemplates() > 0)
				{
					preg_match_all('/<!-- INCLUDE ([a-zA-Z0-9_.]+) -->/', $this->template, $tvar);
					foreach($tvar[1] as $subfile)
					{
						if(file_exists($this->template_dir . "/$subfile"))
							$subst = implode('',file($this->template_dir . "/$subfile"));
						else
							$subst = 'phpSayTemplate Parser Error: Subtemplate not found: \''.$subfile.'\'';
						
						$this->template = str_replace("<!-- INCLUDE $subfile -->", $subst, $this->template);
					}
				}
			}
			$page = str_replace(array("\r","\n","\t"),"",$this->template);
			$page = preg_replace('/\s+/',' ',$page);
			$page = preg_replace('/ +/',' ',$page);
			$page = preg_replace("/<!-- ENDIF.+?-->/","<?php\n}\n?>",$page);
			$page = preg_replace("/<!-- END[ a-zA-Z0-9_.]* -->/","<?php\n}\n\$_obj=\$_stack[--\$_stack_cnt];}\n?>",$page);
			$page = str_replace("<!-- ELSE -->","<?php\n} else {\n?>",$page);

			if (preg_match_all('/<!-- BEGIN ([a-zA-Z0-9_.]+) -->/',$page,$var))
			{
				foreach ($var[1] as $tag)
				{
					list($parent, $block)  =  $this->var_name($tag);
					$code  =  "<?php\n"
							. "if (!empty(\$$parent"."['$block'])){\n"
							. "if (!is_array(\$$parent"."['$block']))\n"
							. "\$$parent"."['$block']=array(array('$block'=>\$$parent"."['$block']));\n"
							. "\$_tmp_arr_keys=array_keys(\$$parent"."['$block']);\n"
							. "if (\$_tmp_arr_keys[0]!='0')\n"
							. "\$$parent"."['$block']=array(0=>\$$parent"."['$block']);\n"
							. "\$_stack[\$_stack_cnt++]=\$_obj;\n"
							. "foreach (\$$parent"."['$block'] as \$rowcnt=>\$v) {\n"
							. "if (is_array(\$v)) \$$block=\$v; else \$$block=array();\n"
							. "\$$block"."['ROWVAL']=\$v;\n"
							. "\$$block"."['ROWCNT']=\$rowcnt;\n"
							. "\$$block"."['ROWBIT']=\$rowcnt%2;\n"
							. "\$_obj=&\$$block;\n?>";
					$page  =  str_replace("<!-- BEGIN $tag -->",  $code,  $page);
				}
			}

			if (preg_match_all('/<!-- (ELSE)?IF ([a-zA-Z0-9_.]+)[ ]*([!=<>]+)[ ]*(["]?[^"]*["]?) -->/', $page, $var))
			{
				foreach ($var[2] as $cnt => $tag)
				{
					list($parent, $block)  =  $this->var_name($tag);
					$cmp   =  $var[3][$cnt];
					$val   =  $var[4][$cnt];
					$else  =  ($var[1][$cnt] == 'ELSE') ? '} else' : '';
					if ($cmp == '=')
					{
						$cmp  =  '==';
					}
					if (preg_match('/"([^"]*)"/',$val,$matches))
					{
						$code  =  "<?php\n$else"."if (\$$parent"."['$block'] $cmp \"".$matches[1]."\"){\n?>";
					}
					elseif (preg_match('/([^"]*)/',$val,$matches))
					{
						list($parent_right, $block_right)  =  $this->var_name($matches[1]);
						$code  =  "<?php\n$else"."if (\$$parent"."['$block'] $cmp \$$parent_right"."['$block_right']){\n?>";
					}
					
					$page  =  str_replace($var[0][$cnt],  $code,  $page);
				}
			}

			if (preg_match_all('/<!-- (ELSE)?IF ([a-zA-Z0-9_.]+) -->/', $page, $var))
			{
				foreach ($var[2] as $cnt => $tag)
				{
					$else  =  ($var[1][$cnt] == 'ELSE') ? '} else' : '';
					list($parent, $block)  =  $this->var_name($tag);
					$code  =  "<?php\n$else"."if (!empty(\$$parent"."['$block'])){\n?>";
					$page  =  str_replace($var[0][$cnt],  $code,  $page);
				}
			}

			if (preg_match_all('/{([a-zA-Z0-9_. >]+)}/', $page, $var))
			{
				foreach ($var[1] as $fulltag)
				{
					list($cmd, $tag)  =  $this->cmd_name($fulltag);
					list($block, $skalar)  =  $this->var_name($tag);
					$code  =  "<?php\n$cmd \$$block"."['$skalar'];\n?>\n";
					$page  =  str_replace('{'.$fulltag.'}',  $code,  $page);
				}
			}

			if (preg_match_all('/<"([a-zA-Z0-9_.]+)">/', $page, $var))
			{
				foreach ($var[1] as $tag)
				{
					list($block, $skalar)  =  $this->var_name($tag);
					$code  =  "<?php\necho gettext('$skalar');\n?>\n";
					$page  =  str_replace('<"'.$tag.'">',  $code,  $page);
				}
			}

			$header = '';

			if (preg_match_all('/{([a-zA-Z0-9_]+):([^}]*)}/', $page, $var))
			{
				foreach ($var[2] as $cnt => $tag)
				{
					list($cmd, $tag)  =  $this->cmd_name($tag);

					$extension  =  $var[1][$cnt];

					if (!isset($this->extension_tagged[$extension]))
					{
						$header  .=  "include \"".str_replace("\\","/",dirname(__FILE__))."/phpSayTemplateExtensions/".$extension.".php\";\n";
						
						$this->extension_tagged[$extension]  =  true;
					}
					if (!strlen($tag))
					{
						$code  =  "<?php\n$cmd phpsay_$extension();\n?>\n";
					}
					elseif (substr($tag, 0, 1) == '"')
					{
						$code  =  "<?php\n$cmd phpsay_$extension($tag);\n?>\n";
					}
					elseif (strpos($tag, ','))
					{
						list($tag, $addparam)  =  explode(',', $tag, 2);
						
						list($block, $skalar)  =  $this->var_name($tag);
						
						if (preg_match('/^([a-zA-Z_]+)/', $addparam, $match))
						{
							$nexttag   =  $match[1];
							list($nextblock, $nextskalar)  =  $this->var_name($nexttag);
							$addparam  =  substr($addparam, strlen($nexttag));
							$code  =  "<?php\n$cmd phpsay_$extension(\$$block"."['$skalar'],\$$nextblock"."['$nextskalar']"."$addparam);\n?>\n";
						}
						else
						{
							$code  =  "<?php\n$cmd phpsay_$extension(\$$block"."['$skalar'],$addparam);\n?>\n";
						}
					}
					else
					{
						list($block, $skalar)  =  $this->var_name($tag);

						$code  =  "<?php\n$cmd phpsay_$extension(\$$block"."['$skalar']);\n?>\n";
					}
					$page  =  str_replace($var[0][$cnt],  $code,  $page);
				}
			}

			if (isset($header) && !empty($header))
			{
				$page  =  "<?php\n$header\n?>$page";
			}
			
			if (strlen($compiled_template_filename))
			{
		        if ($hd  =  fopen($compiled_template_filename,  "w"))
		        {
			        fwrite($hd,  $page);
			        fclose($hd);
			        return true;
			    }
			    else
			    {
			    	$this->error  =  "Could not write compiled file.";
			        return false;
			    }
			}
			else
			{
				return $page;
			}
		}

		function var_name($tag)
		{
			$parent_level  =  0;
			while (substr($tag, 0, 7) == 'parent.')
			{
				$tag  =  substr($tag, 7);
				$parent_level++;
			}
			if (substr($tag, 0, 4) == 'top.')
			{
				$obj  =  '_stack[0]';
				$tag  =  substr($tag,4);
			}
			elseif ($parent_level)
			{
				$obj  =  '_stack[$_stack_cnt-'.$parent_level.']';
			}
			else
			{
				$obj  =  '_obj';
			}
			while (is_int(strpos($tag, '.')))
			{
				list($parent, $tag)  =  explode('.', $tag, 2);
				if (is_numeric($parent))
				{
					$obj  .=  "[" . $parent . "]";
				}
				else
				{
					$obj  .=  "['" . $parent . "']";
				}
			}
			$ret = array($obj, $tag);
			return $ret;
		}

		function cmd_name($tag)
		{
			if (preg_match('/^(.+) > ([a-zA-Z0-9_.]+)$/', $tag, $tagvar))
			{
				$tag  =  $tagvar[1];
				list($newblock, $newskalar)  =  $this->var_name($tagvar[2]);
				$cmd  =  "\$$newblock"."['$newskalar']=";
			}
			else
			{
				$cmd  =  "echo";
			}
			$ret = array($cmd, $tag);
			return $ret;
		}

		function count_subtemplates()
		{
			preg_match_all('/<!-- INCLUDE ([a-zA-Z0-9_.]+) -->/', $this->template, $tvar);
			$count_subtemplates = count($tvar[1]);
			$ret = intval($count_subtemplates);
			return $ret;
		}
	}
?>