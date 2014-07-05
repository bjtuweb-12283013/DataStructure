<?php

class  del_path
{
function  wm_chief_delpath($del_path)
{
if(!file_exists($del_path))
{echo'Directory not found.';return  false;}
$hand=@opendir($del_path);
$i=0;
while($file=@readdir($hand))
{$i++;
if ($file!='.'&&$file!='..')
{
if(is_dir($del_path.'/'.$file))
{
$del_s_path=$del_path.'/'.$file;
$this->wm_chief_delpath($del_s_path);
}
else
{
$del_file=$del_path.'/'.$file;
$this->wm_chief_file($del_file);
}
}
}
@closedir($hand);
$this->wm_chief_path($del_path);
return  true;
}
function  wm_chief_file($del_file)
{
@unlink($del_file);
}
function  wm_chief_path($del_path)
{
@rmdir($del_path);
}
}
?>