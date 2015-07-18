<?php
define('InEmpireCMSQfun',TRUE);

//�۩w�q�r�q��^�ҪO�r�q�B�z
function doReturnAddTempf($temp){
	$record="<!--record-->";
	$field="<!--field--->";
	$r=explode($record,$temp);
	$count=count($r);
	$str=',';
	for($i=0;$i<$count-1;$i++)
	{
		$r1=explode($field,$r[$i]);
		$str.=$r1[1].",";
	}
	if($str==',,')
	{
		$str=',';
	}
	return $str;
}

//��^�r�q
function ReturnAddF($modid,$rdata=0){
	global $empire,$dbtbpre;
	$modid=(int)$modid;
	$record="<!--record-->";
	$field="<!--field--->";
	$mr=$empire->fetch1("select tempvar,enter,listandf,setandf,listtempvar from {$dbtbpre}enewsmod where mid='$modid'");
	//�ҪO�r�q
	if($rdata==1)//���e
	{
		$ret_r['tempvar']=doReturnAddTempf($mr['tempvar']);
	}
	elseif($rdata==2)//�C��
	{
		$ret_r['listtempvar']=doReturnAddTempf($mr['listtempvar']);
	}
	else//����
	{
		$ret_r['tempvar']=doReturnAddTempf($mr['tempvar']);
		$ret_r['listtempvar']=doReturnAddTempf($mr['listtempvar']);
	}
	$ret_r['listandf']=$mr['listandf'];
	$ret_r['setandf']=$mr['setandf'];
	return $ret_r;
}

//����php�N�X
function RepPhpAspJspcode($string){
	//$string=str_replace("<?xml","[!--ecms.xml--]",$string);
	$string=str_replace("<\\","&lt;\\",$string);
	$string=str_replace("<?","&lt;?",$string);
	$string=str_replace("<%","&lt;%",$string);
	if(@stristr($string,' language'))
	{
		$string=preg_replace(array('!<script!i','!</script>!i'),array('&lt;script','&lt;/script&gt;'),$string);
	}
	//$string=str_replace("[!--ecms.xml--]","<?xml",$string);
	return $string;
}


//�զX�_��ؼƾ�
function ReturnFBCheckboxAddF($r,$f,$checkboxf){
	$val=$r;
	if(is_array($r)&&strstr($checkboxf,','.$f.','))
	{
		$val='';
		$count=count($r);
		for($i=0;$i<$count;$i++)
		{
			$val.=$r[$i].'|';
		}
		if($val)
		{
			$val='|'.$val;
		}
	}
	return $val;
}

//������X�H��
function AddFeedback($add){
	global $empire,$dbtbpre,$level_r,$public_r;
	CheckCanPostUrl();//���Ҩӷ�
	if($add['bid'])
	{
		$bid=(int)$add['bid'];
	}
	else
	{
		$bid=(int)getcvar('feedbackbid');
	}
	if(empty($bid))
	{
		printerror("EmptyFeedbackname","history.go(-1)",1);
    }
	//���ҽX
	$keyvname='checkfeedbackkey';
	if($public_r['fbkey_ok'])
	{
		ecmsCheckShowKey($keyvname,$add['key'],1);
	}
	//�����O�_�s�b
	$br=$empire->fetch1("select bid,enter,mustenter,filef,groupid,checkboxf from {$dbtbpre}enewsfeedbackclass where bid='$bid';");
	if(empty($br['bid']))
	{
		printerror("EmptyFeedback","history.go(-1)",1);
	}
	//�v��
	if($br['groupid'])
	{
		$user=islogin();
		if($level_r[$br[groupid]][level]>$level_r[$user[groupid]][level])
		{
			printerror("HaveNotEnLevel","history.go(-1)",1);
		}
	}
	$pr=$empire->fetch1("select feedbacktfile,feedbackfilesize,feedbackfiletype from {$dbtbpre}enewspublic limit 1");
	//����
	$mustr=explode(",",$br['mustenter']);
	$count=count($mustr);
	for($i=1;$i<$count-1;$i++)
	{
		$mf=$mustr[$i];
		if(strstr($br['filef'],",".$mf.","))//����
		{
			if(!$pr['feedbacktfile'])
			{
				printerror("NotOpenFBFile","",1);
			}
			if(!$_FILES[$mf]['name'])
			{
				printerror("EmptyFeedbackname","",1);
			}
		}
		else
		{
			$chmustval=ReturnFBCheckboxAddF($add[$mf],$mf,$br['checkboxf']);
			if(!trim($chmustval))
			{
				printerror("EmptyFeedbackname","",1);
			}
		}
	}
	$saytime=date("Y-m-d H:i:s");
	//�r�q�B�z
	$dh="";
	$tranf="";
	$record="<!--record-->";
	$field="<!--field--->";
	$er=explode($record,$br['enter']);
	$count=count($er);
	for($i=0;$i<$count-1;$i++)
	{
		$er1=explode($field,$er[$i]);
		$f=$er1[1];
		//����
		$add[$f]=str_replace('[!#@-','ecms',$add[$f]);
		if(strstr($br['filef'],",".$f.","))
		{
			if($_FILES[$f]['name'])
			{
				if(!$pr['feedbacktfile'])
				{
					printerror("NotOpenFBFile","",1);
				}
				$filetype=GetFiletype($_FILES[$f]['name']);//���o�������
				if(CheckSaveTranFiletype($filetype))
				{
					printerror("NotQTranFiletype","",1);
				}
				if(!strstr($pr['feedbackfiletype'],"|".$filetype."|"))
				{
					printerror("NotQTranFiletype","",1);
				}
				if($_FILES[$f]['size']>$pr['feedbackfilesize']*1024)//���j�p
				{
					printerror("TooBigQTranFile","",1);
				}
				$tranf.=$dh.$f;
				$dh=",";
				$fval="[!#@-".$f."-@!]";
			}
			else
			{
				$fval="";
			}
		}
		else
		{
			$add[$f]=ReturnFBCheckboxAddF($add[$f],$f,$br['checkboxf']);
			$fval=$add[$f];
		}
		$addf.=",`".$f."`";
		$addval.=",'".addslashes(RepPostStr($fval))."'";
	}
	$type=0;
	$classid=0;
	$filename='';
	$filepath='';
	$userid=(int)getcvar('mluserid');
	$username=RepPostVar(getcvar('mlusername'));
	$filepass=ReturnTranFilepass();
	//�W�Ǫ���
	if($tranf)
	{
		$dh="";
		$tranr=explode(",",$tranf);
		$count=count($tranr);
		for($i=0;$i<$count;$i++)
		{
			$tf=$tranr[$i];
			$tfr=DoTranFile($_FILES[$tf]['tmp_name'],$_FILES[$tf]['name'],$_FILES[$tf]['type'],$_FILES[$tf]['size'],$classid);
			if($tfr['tran'])
			{
				$filepath=$tfr[filepath];
				//�g�J�ƾڮw
				$filetime=$saytime;
				$filesize=(int)$_FILES[$tf]['size'];
				eInsertFileTable($tfr[filename],$filesize,$tfr[filepath],'[Member]'.$username,$classid,'[FB]'.addslashes(RepPostStr($add[title])),$type,$filepass,$filepass,$public_r[fpath],0,4,0);
				$repfval=($tfr[filepath]?$tfr[filepath].'/':'').$tfr[filename];
				$filename.=$dh.$tfr[filename];
				$dh=",";
			}
			else
			{
				$repfval="";
			}
			$addval=str_replace("[!#@-".$tf."-@!]",$repfval,$addval);
		}
	}
	$ip=egetip();
	$eipport=egetipport();
	$sql=$empire->query("insert into {$dbtbpre}enewsfeedback(bid,saytime,ip,filepath,filename,userid,username,haveread,eipport".$addf.") values('$bid','$saytime','$ip','$filepath','$filename','$userid','$username',0,'$eipport'".$addval.");");
	$fid=$empire->lastid();
	//��s����
	UpdateTheFileOther(4,$fid,$filepass,'other');
	ecmsEmptyShowKey($keyvname);//�M�����ҽX
	if($sql)
	{
		$reurl=DoingReturnUrl("../tool/feedback/?bid=$bid",$add['ecmsfrom']);
		printerror("AddFeedbackSuccess",$reurl,1);
	}
	else
	{printerror("DbError","history.go(-1)",1);}
}

//--------------�o�e���~���i
function AddError($add){
	global $empire,$class_r,$dbtbpre;
	CheckCanPostUrl();//���Ҩӷ�
	$id=(int)$add['id'];
	$classid=(int)$add['classid'];
	if(!$classid||!$id||!trim($add[errortext]))
	{printerror("EmptyErrortext","history.go(-1)",1);}
	//��^���D�챵
	if(empty($class_r[$classid][tbname]))
	{
		printerror("ErrorUrl","history.go(-1)",1);
    }
	$r=$empire->fetch1("select isurl,titleurl,classid,id from {$dbtbpre}ecms_".$class_r[$classid][tbname]." where id='$id' limit 1");
	if(empty($r[id])||$r['classid']!=$classid)
	{
		printerror("ErrorUrl","history.go(-1)",1);
    }
	$cid=(int)$add[cid];
	$titleurl=sys_ReturnBqTitleLink($r);
	$email=RepPostStr($add[email]);
	$ip=egetip();
	$errortext=RepPostStr($add[errortext]);
	$errortime=date("Y-m-d H:i:s");
	$sql=$empire->query("insert into {$dbtbpre}enewsdownerror(id,errortext,errorip,errortime,email,classid,cid) values($id,'".addslashes($errortext)."','$ip','$errortime','".addslashes($email)."',$classid,'$cid');");
	if($sql)
	{
		printerror("AddErrorSuccess",$titleurl,1);
	}
	else
	{
		printerror("DbError","history.go(-1)",1);
	}
}


//���������ҪO�ܶq
function ReplaceTempvar($temp){
	global $empire;
	if(empty($temp))
	{return $temp;}
	$sql=$empire->query("select myvar,varvalue from ".GetTemptb("enewstempvar")." where isclose=0 order by myorder desc,varid");
	while($r=$empire->fetch($sql))
	{
		$myvar="[!--temp.".$r[myvar]."--]";
		$temp=str_replace($myvar,$r[varvalue],$temp);
    }
	return $temp;
}

?>