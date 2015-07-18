<?php
if(!function_exists('version_compare') || version_compare( phpversion(), '5', '<' ) )
	include_once(dirname(__FILE__).'/fckeditor_php4.php');
else
	include_once(dirname(__FILE__).'/fckeditor_php5.php');

//變量名,變量值,工具條模式,編輯器目錄,高度,寬度
function ECMS_ShowEditorVar($varname,$varvalue,$toolbar='Default',$basepath='',$height='300',$width='100%'){
	if(empty($basepath))
	{
		$basepath='../data/ecmseditor/infoeditor/';
	}
	if(empty($height))
	{
		$height='300';
	}
	if(empty($width))
	{
		$width='100%';
	}
	//設置區域
	$oFCKeditor=new FCKeditor($varname);
	$oFCKeditor->BasePath=$basepath;
	$oFCKeditor->Value=$varvalue;
	$oFCKeditor->Height=$height;
	$oFCKeditor->Width=$width;
	$oFCKeditor->ToolbarSet=$toolbar;
	//區域的模板變量
	$area=$oFCKeditor->CreateHtml();
	return $area;
}

//附加參數
function ECMS_ReturnEditorCx(){
	global $classid,$filepass;
	$str="&classid=$classid&filepass=$filepass";
	return $str;
}
?>