<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
DoWapHeader($pagetitle);
?>
<p><b>信息標題:</b> <?=DoWapClearHtml($r[title])?><br/>
<b>發佈時間:</b> <?=date("Y-m-d H:i:s",$r[newstime])?><br/>
<b>所 在 地  &nbsp;:</b> <?=DoWapRepF($r[myarea],'myarea',$ret_r)?><br/>
<b>信息內容:</b></p>
<p><?=DoWapRepF($r[smalltext],'smalltext',$ret_r)?><br/></p>
<p><b>聯繫方式</b><br/>
發 布 者  &nbsp;: <?=DoWapClearHtml($r['username'])?><br/>
聯繫郵箱: <?=DoWapClearHtml($r['email'])?><br/>
聯繫方式: <?=DoWapRepF($r[mycontact],'mycontact',$ret_r)?><br/>
聯繫地址: <?=DoWapRepF($r[address],'address',$ret_r)?><br/>
</p>
<p><br/><a href="<?=$listurl?>">返回列表</a> <a href="index.php?style=<?=$wapstyle?>">網站首頁</a></p>
<?php
DoWapFooter();
?>