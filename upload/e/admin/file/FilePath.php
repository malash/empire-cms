<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//���ҥΤ�
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
//�����v��
CheckLevel($logininid,$loginin,$classid,"file");
//��ؿ�
$basepath=eReturnEcmsMainPortPath()."d/file";//moreport
$filepath=ehtmlspecialchars($_GET['filepath']);
if(strstr($filepath,".."))
{
	$filepath="";
}
$filepath=eReturnCPath($filepath,'');
$openpath=$basepath."/".$filepath;
if(!file_exists($openpath))
{
	$openpath=$basepath;
}
$hand=@opendir($openpath);
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�޲z����</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
<script>
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.name != 'chkall')
       e.checked = form.chkall.checked;
    }
  }
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="34%">��m�G<a href="FilePath.php<?=$ecms_hashur['whehref']?>">�޲z���� (�ؿ���)</a></td>
    <td width="66%"><div align="right" class="emenubutton">
      </div></td>
  </tr>
</table>
  
<br>
<table width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td height="32">��e�ؿ��G<strong>/ 
      <?=$filepath?>
      </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[<a href="#ecms" onclick="javascript:history.go(-1);">��^�W�@��</a>]</td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <form name="form1" method="post" action="../ecmsfile.php" onsubmit="return confirm('�T�{�R��?');">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25"> <div align="center">���</div></td>
      <td height="25"><div align="center">���W</div></td>
      <td><div align="center">�j�p</div></td>
      <td><div align="center">����</div></td>
      <td><div align="center">�ק�ɶ�</div></td>
    </tr>
    <?php
	$efileurl=eReturnFileUrl(1);
	while($file=@readdir($hand))
	{
		if(empty($filepath))
		{
			$truefile=$file;
		}
		else
		{
			$truefile=$filepath."/".$file;
		}
		if($file=="."||$file=="..")
		{
			continue;
		}
		//�ؿ�
		$pathfile=$openpath."/".$file;
		if(is_dir($pathfile))
		{
			$filelink="'FilePath.php?filepath=".$truefile.$ecms_hashur['ehref']."'";
			$filename=$file;
			$img="../../data/images/dir/folder.gif";
			$checkbox="";
			$target="";
			//�o�G�ɶ�
			$ftime=@filemtime($pathfile);
			$filetime=date("Y-m-d H:i:s",$ftime);
			$filesize='<�ؿ�>';
			$filetype='���';
		}
		//���
		else
		{
			$filelink="'".eReturnFileUrl().$truefile."'";
			$filename=$file;
			$ftype=GetFiletype($file);
			$img='../../data/images/dir/'.substr($ftype,1,strlen($ftype))."_icon.gif";
			if(!file_exists($img))
			{
				$img='../../data/images/dir/unknown_icon.gif';
			}
			$checkbox="<input name='filename[]' type='checkbox' value='".$truefile."'>";
			$target=" target='_blank'";
			//�o�G�ɶ�
			$ftime=@filemtime($pathfile);
			$filetime=date("Y-m-d H:i:s",$ftime);
			//���j�p
			$fsize=@filesize($pathfile);
			$filesize=ChTheFilesize($fsize);
			//�������
			if(strstr($ecms_config['sets']['tranpicturetype'],','.$ftype.','))
			{
				$filetype='�Ϥ�';
			}
			elseif(strstr($ecms_config['sets']['tranflashtype'],','.$ftype.','))
			{
				$filetype='FLASH';
			}
			elseif(strstr($ecms_config['sets']['mediaplayertype'],','.$ftype.',')||strstr($ecms_config['sets']['realplayertype'],','.$ftype.','))
			{
				$filetype='���W';
			}
			else
			{
				$filetype='����';
			}
			$furl=$efileurl.$truefile;
		}
	 ?>
    <tr bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#C3EFFF'"> 
      <td width="6%" height="25"> 
        <div align="center"> 
          <?=$checkbox?>
        </div></td>
      <td width="47%" height="25"><img src="<?=$img?>" width="23" height="22"><a href=<?=$filelink?><?=$target?>> 
        <?=$filename?>
        </a></td>
      <td width="14%"> 
        <div align="right"> 
          <?=$filesize?>
        </div></td>
      <td width="10%"> 
        <div align="center"> 
          <?=$filetype?>
        </div></td>
      <td width="23%"> 
        <div align="center"> 
          <?=$filetime?>
        </div></td>
    </tr>
    <?php
	}
	@closedir($hand);
	?>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"> 
        <div align="center"> 
          <input type="checkbox" name="chkall" value="on" onclick="CheckAll(this.form)">
        </div></td>
      <td height="25" colspan="4"> 
        <input type="submit" name="Submit" value="�R�����"> 
        <input name="enews" type="hidden" id="enews" value="DelPathFile"> <div align="center"></div>
        <div align="center"></div>
        <div align="center"></div></td>
    </tr>
  </form>
</table>
</body>
</html>