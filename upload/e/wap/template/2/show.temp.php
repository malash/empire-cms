<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
DoWapHeader($pagetitle);
?>
<p><b>�H�����D:</b> <?=DoWapClearHtml($r[title])?><br/>
<b>�o�G�ɶ�:</b> <?=date("Y-m-d H:i:s",$r[newstime])?><br/>
<b>�� �b �a  &nbsp;:</b> <?=DoWapRepF($r[myarea],'myarea',$ret_r)?><br/>
<b>�H�����e:</b></p>
<p><?=DoWapRepF($r[smalltext],'smalltext',$ret_r)?><br/></p>
<p><b>�pô�覡</b><br/>
�o �� ��  &nbsp;: <?=DoWapClearHtml($r['username'])?><br/>
�pô�l�c: <?=DoWapClearHtml($r['email'])?><br/>
�pô�覡: <?=DoWapRepF($r[mycontact],'mycontact',$ret_r)?><br/>
�pô�a�}: <?=DoWapRepF($r[address],'address',$ret_r)?><br/>
</p>
<p><br/><a href="<?=$listurl?>">��^�C��</a> <a href="index.php?style=<?=$wapstyle?>">��������</a></p>
<?php
DoWapFooter();
?>