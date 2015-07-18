<?php
if(!defined('InEmpireCMS'))
{
	exit();
}

//-------- �s�X�ഫ
function DoWapIconvVal($str){
	global $ecms_config,$iconv,$pr;
	if($ecms_config['sets']['pagechar']!='utf-8')
	{
		$char=$ecms_config['sets']['pagechar']=='big5'?'BIG5':'GB2312';
		$targetchar=$pr['wapchar']?'UTF8':'UNICODE';
		$str=$iconv->Convert($char,$targetchar,$str);
	}
	return $str;
}

//-------- ���ܫH��
function DoWapShowMsg($error,$returnurl='index.php',$ecms=0){
	global $empire,$public_r;
	$gotourl=str_replace('&amp;','&',$returnurl);
	if(strstr($gotourl,"(")||empty($gotourl))
	{
		if(strstr($gotourl,"(-2"))
		{
			$gotourl_js="history.go(-2)";
			$gotourl="javascript:history.go(-2)";
		}
		else
		{
			$gotourl_js="history.go(-1)";
			$gotourl="javascript:history.go(-1)";
		}
	}
	else
	{$gotourl_js="self.location.href='$gotourl';";}
	if($ecms==9)//�u�X��ܮ�
	{
		echo"<script>alert('".$error."');".$gotourl_js."</script>";
	}
	elseif($ecms==7)//�u�X��ܮب��������f
	{
		echo"<script>alert('".$error."');window.close();</script>";
	}
	else
	{
		@include(ECMS_PATH.'e/wap/message.php');
	}
	db_close();
	$empire=null;
	exit();
}

//-------- �Y��
function DoWapHeader($title){
	global $ecms_config;
	ob_start();
	header("Content-type: text/vnd.wap.wml; charset=utf-8");
	echo'<?xml version="1.0" encoding="UTF-8"?>';
?>

<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN" "http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>
<head>
<meta http-equiv="Cache-Control" content="max-age=180,private" />
</head>
<card id="empirecms_wml" title="<?php echo $title;?>">
<?php
}

//-------- ����
function DoWapFooter(){
?>
<p><br/><small>Powered by EmpireCMS</small></p>
</card></wml>
<?php
	$str=ob_get_contents();
	ob_end_clean();
	echo DoWapIconvVal($str);
}

//-------- ����
function DoWapListPage($num,$line,$page,$search){
	if(empty($num))
	{
		return '';
	}
	$str='';
	$pagenum=ceil($num/$line);
	$search=RepPostStr($search,1);
	$phpself=eReturnSelfPage(0);
	if($page)//����
	{
		$str.="<a href=\"".$phpself."?page=0".$search."\">����</a>&nbsp;";
	}
	if($page)
	{
		$str.="<a href=\"".$phpself."?page=".($page-1).$search."\">�W�@��</a>&nbsp;";
	}
	if($page!=$pagenum-1)
	{
		$str.="<a href=\"".$phpself."?page=".($page+1).$search."\">�U�@��</a>&nbsp;";
	}
	if($page!=$pagenum-1)
	{
		$str.="<a href=\"".$phpself."?page=".($pagenum-1).$search."\">����</a>&nbsp;";
	}
	return $str;
}

//-------- ����<p> --------
function DoWapRepPtags($text){
	$text=str_replace(array('<p>','<P>','</p>','</P>'),array('','','<br />','<br />'),$text);
	$preg_str="/<(p|P) (.+?)>/is";
	$text=preg_replace($preg_str,"",$text);
	return $text;
}

//-------- �r�q�ݩ� --------
function DoWapRepField($text,$f,$field){
	global $modid,$emod_r;
	$modid=(int)$modid;
	if(strstr($emod_r[$modid]['tobrf'],','.$f.','))//�[br
	{
		$text=nl2br($text);
	}
	if(!strstr($emod_r[$modid]['dohtmlf'],','.$f.','))//�h��html
	{
		$text=ehtmlspecialchars($text);
	}
	return $text;
}

//-------- �h��html�N�X --------
function DoWapClearHtml($text){
	$text=stripSlashes($text);
	$text=ehtmlspecialchars(strip_tags($text));
	return $text;
}

//-------- �����r�q���e
function DoWapRepF($text,$f,$field){
	$text=stripSlashes($text);
	$text=DoWapRepPtags($text);
	$text=DoWapRepField($text,$f,$field);
	return $text;
}

//-------- �����峹���e�r�q
function DoWapRepNewstext($text){
	$text=stripSlashes($text);
	$text=DoWapRepPtags($text);
	return $text;
}

//-------- �S��r�ťh��
function DoWapCode($string){
	$string=str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string);
	return $string;
}

//-------- ��^�ϥμҪO
function ReturnWapStyle($add,$style){
	global $empire,$dbtbpre,$pr,$class_r;
	$style=(int)$style;
	$styleid=$pr['wapdefstyle'];
	$classid=0;
	if(WapPage=='index')
	{
		$classid=(int)$add['bclassid'];
	}
	elseif(WapPage=='list')
	{
		$classid=(int)$add['classid'];
	}
	elseif(WapPage=='show')
	{
		$classid=(int)$add['classid'];
	}
	if($classid&&$class_r[$classid]['tbname'])
	{
		$cr=$empire->fetch1("select wapstyleid from {$dbtbpre}enewsclass where classid='$classid'");
		if($cr['wapstyleid'])
		{
			$styleid=$cr['wapstyleid'];
		}
	}
	if($style&&$styleid==$pr['wapdefstyle'])
	{
		$styleid=$style;
	}
	$sr=$empire->fetch1("select path from {$dbtbpre}enewswapstyle where styleid='$styleid'");
	$wapstyle=$sr['path'];
	if(empty($wapstyle))
	{
		$wapstyle=1;
	}
	return $wapstyle;
}


//----------------- �ҪO�եΰ� ------------------

//��^sql�y�y
function ewap_ReturnBqQuery($classid,$line,$enews=0,$do=0,$ewhere='',$eorder=''){
	global $empire,$public_r,$class_r,$class_zr,$navclassid,$dbtbpre,$fun_r,$class_tr,$emod_r,$etable_r,$eyh_r;
	$navclassid=(int)$navclassid;
	if($enews==24)//��sql�d��
	{
		$query_first=substr($classid,0,7);
		if(!($query_first=='select '||$query_first=='SELECT '))
		{
			return "";
		}
		$classid=RepSqlTbpre($classid);
		$sql=$empire->query1($classid);
		if(!$sql)
		{
			echo"SQL Error: ".ReRepSqlTbpre($classid);
		}
		return $sql;
	}
	if($enews==0||$enews==1||$enews==2||$enews==9||$enews==12||$enews==15)//���
	{
		if(strstr($classid,','))//�h���
		{
			$son_r=sys_ReturnMoreClass($classid,1);
			$classid=$son_r[0];
			$where=$son_r[1];
		}
		else
		{
			if($classid=='selfinfo')//��ܷ�e��ثH��
			{
				$classid=$navclassid;
			}
			if($class_r[$classid][islast])
			{
				$where="classid='$classid'";
			}
			else
			{
				$where=ReturnClass($class_r[$classid][sonclass]);
			}
		}
		$tbname=$class_r[$classid][tbname];
		$mid=$class_r[$classid][modid];
		$yhid=$class_r[$classid][yhid];
    }
	elseif($enews==6||$enews==7||$enews==8||$enews==11||$enews==14||$enews==17)//�M�D
	{
		echo"Error�GChange to use e:indexloop";
		return false;
	}
	elseif($enews==25||$enews==26||$enews==27||$enews==28||$enews==29||$enews==30)//���D����
	{
		if(strstr($classid,','))//�h���D����
		{
			$son_r=sys_ReturnMoreTT($classid);
			$classid=$son_r[0];
			$where=$son_r[1];
		}
		else
		{
			if($classid=='selfinfo')//��ܷ�e���D�����H��
			{
				$classid=$navclassid;
			}
			$where="ttid='$classid'";
		}
		$mid=$class_tr[$classid][mid];
		$tbname=$emod_r[$mid][tbname];
		$yhid=$class_tr[$classid][yhid];
	}
	$query='';
	$qand=' and ';
	if($enews==0)//��س̷s
	{
		$query=' where ('.$where.')';
		$order='newstime';
		$yhvar='bqnew';
    }
	elseif($enews==1)//��ؼ���
	{
		$query=' where ('.$where.')';
		$order='onclick';
		$yhvar='bqhot';
    }
	elseif($enews==2)//��ر���
	{
		$query=' where ('.$where.') and isgood>0';
		$order='newstime';
		$yhvar='bqgood';
    }
	elseif($enews==9)//��ص��ױƦ�
	{
		$query=' where ('.$where.')';
		$order='plnum';
		$yhvar='bqpl';
    }
	elseif($enews==12)//����Y��
	{
		$query=' where ('.$where.') and firsttitle>0';
		$order='newstime';
		$yhvar='bqfirst';
    }
	elseif($enews==15)//��ؤU���Ʀ�
	{
		$query=' where ('.$where.')';
		$order='totaldown';
		$yhvar='bqdown';
    }
	elseif($enews==3)//�Ҧ��̷s
	{
		$qand=' where ';
		$order='newstime';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqnew';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==4)//�Ҧ��I���Ʀ�
	{
		$qand=' where ';
		$order='onclick';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqhot';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==5)//�Ҧ�����
	{
		$query=' where isgood>0';
		$order='newstime';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqgood';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==10)//�Ҧ����ױƦ�
	{
		$qand=' where ';
		$order='plnum';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqpl';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==13)//�Ҧ��Y��
	{
		$query=' where firsttitle>0';
		$order='newstime';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqfirst';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==16)//�Ҧ��U���Ʀ�
	{
		$qand=' where ';
		$order='totaldown';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqdown';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==18)//�U��̷s
	{
		$qand=' where ';
		$order='newstime';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqnew';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==19)//�U�����
	{
		$qand=' where ';
		$order='onclick';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqhot';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==20)//�U�����
	{
		$query=' where isgood>0';
		$order='newstime';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqgood';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==21)//�U����ױƦ�
	{
		$qand=' where ';
		$order='plnum';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqpl';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==22)//�U���Y���H��
	{
		$query=' where firsttitle>0';
		$order="newstime";
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqfirst';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==23)//�U��U���Ʀ�
	{
		$qand=' where ';
		$order='totaldown';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqdown';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==25)//���D�����̷s
	{
		$query=' where ('.$where.')';
		$order='newstime';
		$yhvar='bqnew';
    }
	elseif($enews==26)//���D�����I���Ʀ�
	{
		$query=' where ('.$where.')';
		$order='onclick';
		$yhvar='bqhot';
    }
	elseif($enews==27)//���D��������
	{
		$query=' where ('.$where.') and isgood>0';
		$order='newstime';
		$yhvar='bqgood';
    }
	elseif($enews==28)//���D�������ױƦ�
	{
		$query=' where ('.$where.')';
		$order='plnum';
		$yhvar='bqpl';
    }
	elseif($enews==29)//���D�����Y��
	{
		$query=' where ('.$where.') and firsttitle>0';
		$order='newstime';
		$yhvar='bqfirst';
    }
	elseif($enews==30)//���D�����U���Ʀ�
	{
		$query=' where ('.$where.')';
		$order='totaldown';
		$yhvar='bqdown';
    }
	//�u��
	$yhadd='';
	if(!empty($eyh_r[$yhid]['dobq']))
	{
		$yhadd=ReturnYhSql($yhid,$yhvar);
		if(!empty($yhadd))
		{
			$query.=$qand.$yhadd;
			$qand=' and ';
		}
	}
	//���ե�
	if(!strstr($public_r['nottobq'],','.$classid.','))
	{
		$notbqwhere=ReturnNottoBqWhere();
		if(!empty($notbqwhere))
		{
			$query.=$qand.$notbqwhere;
			$qand=' and ';
		}
	}
	//�Ϥ��H��
	if(!empty($do))
	{
		$query.=$qand.'ispic=1';
		$qand=' and ';
    }
	//���[����
	if(!empty($ewhere))
	{
		$query.=$qand.'('.$ewhere.')';
		$qand=' and ';
	}
	//����
	if(empty($tbname))
	{
		echo "ClassID=<b>".$classid."</b> Table not exists.(DoType=".$enews.")";
		return false;
	}
	//�Ƨ�
	$addorder=empty($eorder)?$order.' desc':$eorder;
	$query='select '.ReturnSqlListF($mid).' from '.$dbtbpre.'ecms_'.$tbname.$query.' order by '.ReturnSetTopSql('bq').$addorder.' limit '.$line;
	$sql=$empire->query1($query);
	if(!$sql)
	{
		echo"SQL Error: ".ReRepSqlTbpre($query);
	}
	return $sql;
}

//�F�ʼ��ҡG��^SQL���e���
function ewap_eloop($classid=0,$line=10,$enews=3,$doing=0,$ewhere='',$eorder=''){
	return ewap_ReturnBqQuery($classid,$line,$enews,$doing,$ewhere,$eorder);
}

//�F�ʼ��ҡG��^�S���e���
function ewap_eloop_sp($r){
	global $class_r;
	$sr['titleurl']=ewap_ReturnTitleUrl($r);
	$sr['classname']=$class_r[$r[classid]][bname]?$class_r[$r[classid]][bname]:$class_r[$r[classid]][classname];
	$sr['classurl']=ewap_ReturnClassUrl($r);
	return $sr;
}

//��^wap���e���a�}
function ewap_ReturnTitleUrl($r){
	global $public_r,$class_r,$ecmsvar_mbr,$wapstyle;
	if(empty($r['isurl']))
	{
		$titleurl='show.php?classid='.$r[classid].'&amp;id='.$r[id].'&amp;style='.$wapstyle.'&amp;bclassid='.$class_r[$r[classid]][bclassid].'&amp;cid='.$r[classid].'&amp;cpage=0';
	}
	else
	{
		if($public_r['opentitleurl'])
		{
			$titleurl=$r['titleurl'];
		}
		else
		{
			$titleurl=$public_r['newsurl'].'e/public/jump/?classid='.$r['classid'].'&amp;id='.$r['id'];
		}
	}
	return $titleurl;
}

//��^��ح��a�}
function ewap_ReturnClassUrl($r){
	global $public_r,$class_r,$ecmsvar_mbr,$wapstyle;
	//�~�����
	if($class_r[$r[classid]][wburl])
	{
		$classurl=$class_r[$r[classid]][wburl];
	}
	else
	{
		$classurl='list.php?classid='.$r[classid].'&amp;style='.$wapstyle.'&amp;bclassid='.$class_r[$r[classid]][bclassid];
	}
	return $classurl;
}

//�챵���[�Ѽ�
function ewap_UrlAddCs(){
	global $ecmsvar_mbr;
	$wapstyle=(int)$ecmsvar_mbr['wapstyle'];
	$fbclassid=(int)$ecmsvar_mbr['fbclassid'];
	$fclassid=(int)$ecmsvar_mbr['fclassid'];
	$fcpage=(int)$ecmsvar_mbr['fcpage'];
	$addcs='';
	if($wapstyle)
	{
		$addcs.='&amp;style='.$wapstyle;
	}
	if($fbclassid)
	{
		$addcs.='&amp;bclassid='.$fbclassid;
	}
	if($fclassid)
	{
		$addcs.='&amp;cid='.$fclassid;
	}
	if($fcpage)
	{
		$addcs.='&amp;cpage='.$fcpage;
	}
	return $addcs;
}


$pr=$empire->fetch1("select wapopen,wapdefstyle,wapshowmid,waplistnum,wapsubtitle,wapshowdate,wapchar from {$dbtbpre}enewspublic limit 1");

//�ɤJ�s�X���
$iconv='';
if($ecms_config['sets']['pagechar']!='utf-8')
{
	@include_once("../class/doiconv.php");
	$iconv=new Chinese('');
}

if(empty($pr['wapopen']))
{
	DoWapShowMsg('�����S���}��WAP�\��','index.php');
}

$wapstyle=intval($_GET['style']);
//��^�ϥμҪO
$usewapstyle=ReturnWapStyle($_GET,$wapstyle);
if(!file_exists('template/'.$usewapstyle))
{
	$usewapstyle=1;
}
?>