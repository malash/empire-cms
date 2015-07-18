<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
DoWapHeader($pagetitle);
?>
<p><b>獺夹肈:</b> <?=DoWapClearHtml($r[title])?><br/>
<b>祇丁:</b> <?=date("Y-m-d H:i:s",$r[newstime])?><br/>
<b>┮    &nbsp;:</b> <?=DoWapRepF($r[myarea],'myarea',$ret_r)?><br/>
<b>獺ず甧:</b></p>
<p><?=DoWapRepF($r[smalltext],'smalltext',$ret_r)?><br/></p>
<p><b>羛么よΑ</b><br/>
祇 ガ   &nbsp;: <?=DoWapClearHtml($r['username'])?><br/>
羛么秎絚: <?=DoWapClearHtml($r['email'])?><br/>
羛么よΑ: <?=DoWapRepF($r[mycontact],'mycontact',$ret_r)?><br/>
羛么: <?=DoWapRepF($r[address],'address',$ret_r)?><br/>
</p>
<p><br/><a href="<?=$listurl?>"></a> <a href="index.php?style=<?=$wapstyle?>">呼</a></p>
<?php
DoWapFooter();
?>