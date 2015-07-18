<?php
define('EmpireCMSAdmin','1');
require("../class/connect.php");
require("../class/db_sql.php");
require("../class/functions.php");
require LoadLang("pub/fun.php");
require("../data/dbcache/class.php");
$link=db_connect();
$empire=new mysqlquery();
//驗證用戶
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
//驗證權限
CheckLevel($logininid,$loginin,$classid,"cj");

//返回節點多列表
function ReturnInfoUrl($r){
	if($r[infourl1])
	{
		if(empty($r['urlbs']))
		{
			$r['urlbs']=1;
		}
		for($i=$r[urlstart];$i<=$r[urlend];$i++)
		{
			$page=$i*$r['urlbs'];
			//補零
			if($r['urlbl'])
			{
				$page=AddNumZero($page,$r[urlend]);
			}
			$dourl=str_replace("[page]",$page,$r[infourl1]);
			//倒序
			if($r['urldx'])
			{
				$a="";
				if($i<>$r[urlend])
				{
					$a="\r\n";
				}
				$url=$a.$dourl.$url;
			}
			else
			{
				if($i<>$r[urlstart])
				{
					$a="\r\n";
				}
				$url.=$a.$dourl;
			}
		}
	}
	if($r[infourl])
	{
		if($url)
		{
			$url=$r[infourl]."\r\n".$url;
		}
		else
		{
			$url=$r[infourl];
		}
	}
	if(empty($url))
	{printerror("EmptyInfourl","history.go(-1)");}
	return $url;
}

//增加節點
function AddInfoClass($bclassid,$newsclassid,$add,$ztid,$userid,$username){
	global $empire,$class_r,$dbtbpre;
	if(!$add[classname])
	{printerror("EmptyInfoTitleSuccess","history.go(-1)");}
	//操作權限
	CheckLevel($userid,$username,$classid,"cj");
	//選擇欄目
	if($newsclassid)
	{
		if(!$class_r[$newsclassid][islast])
		{
			printerror("CjClassidMustLast","history.go(-1)");
		}
		//返回採集頁面地址
		$add[infourl]=ReturnInfoUrl($add);
	    //取得採集字段
		$mr=$empire->fetch1("select cj,tid,tbname from {$dbtbpre}enewsmod where mid='".$class_r[$newsclassid][modid]."'");
	    $ret_r=ReturnAddCj($add,$mr[cj],0);
	}
	$lasttime=time();
	if(empty($add[startday]))
	{$add[startday]=date("Y-m-d");}
	if(empty($add[endday]))
	{$add[endday]="2099-12-31";}
	if(empty($add[relistnum]))
	{$add[relistnum]=1;}
	if(empty($add[renum]))
	{$add[renum]=2;}
	if(empty($add[insertnum]))
	{$add[insertnum]=10;}
	//處理變量
	$bclassid=(int)$bclassid;
	$newsclassid=(int)$newsclassid;
	$add[num]=(int)$add[num];
	$add[copyimg]=(int)$add[copyimg];
	$add[renum]=(int)$add[renum];
	$add[titlelen]=(int)$add[titlelen];
	$add[retitlewriter]=(int)$add[retitlewriter];
	$add[smalltextlen]=(int)$add[smalltextlen];
	$add[relistnum]=(int)$add[relistnum];
	$add[keynum]=(int)$add[keynum];
	$add[insertnum]=(int)$add[insertnum];
	$add[copyflash]=(int)$add[copyflash];
	$mr[tid]=(int)$mr[tid];
	$add[pagetype]=(int)$add[pagetype];
	$add[mark]=(int)$add[mark];
	$add[enpagecode]=(int)$add[enpagecode];
	$add[recjtheurl]=(int)$add[recjtheurl];
	$add[hiddenload]=(int)$add[hiddenload];
	$add[justloadin]=(int)$add[justloadin];
	$add[justloadcheck]=(int)$add[justloadcheck];
	$add[delloadinfo]=(int)$add[delloadinfo];
	$add[getfirstpic]=(int)$add[getfirstpic];
	$add[getfirstspic]=(int)$add[getfirstspic];
	$add[getfirstspicw]=(int)$add[getfirstspicw];
	$add[getfirstspich]=(int)$add[getfirstspich];
	$add[doaddtextpage]=(int)$add[doaddtextpage];
	$add[infourlispage]=(int)$add[infourlispage];
	$keeptime=(int)$add['keeptime'];
	$newstextisnull=(int)$add['newstextisnull'];
	//寫入主表
	$sql=$empire->query("insert into {$dbtbpre}enewsinfoclass(bclassid,classname,infourl,newsclassid,startday,endday,bz,num,copyimg,renum,keyboard,oldword,newword,titlelen,retitlewriter,smalltextlen,zz_smallurl,zz_newsurl,httpurl,repad,imgurl,relistnum,zz_titlepicl,z_titlepicl,qz_titlepicl,save_titlepicl,keynum,insertnum,copyflash,tid,tbname,pagetype,smallpagezz,pagezz,smallpageallzz,pageallzz,mark,enpagecode,recjtheurl,hiddenload,justloadin,justloadcheck,delloadinfo,pagerepad,getfirstpic,oldpagerep,newpagerep,keeptime,lasttime,newstextisnull,getfirstspic,getfirstspicw,getfirstspich,doaddtextpage,infourlispage) values($bclassid,'".eaddslashes($add[classname])."','".eaddslashes2($add[infourl])."',$newsclassid,'$add[startday]','$add[endday]','".eaddslashes2($add[bz])."',$add[num],$add[copyimg],$add[renum],'".eaddslashes2($add[keyboard])."','".eaddslashes2($add[oldword])."','".eaddslashes2($add[newword])."',$add[titlelen],$add[retitlewriter],$add[smalltextlen],'".eaddslashes2($add[zz_smallurl])."','".eaddslashes2($add[zz_newsurl])."','".eaddslashes2($add[httpurl])."','".eaddslashes2($add[repad])."','".eaddslashes2($add[imgurl])."',$add[relistnum],'".eaddslashes2($add[zz_titlepicl])."','".eaddslashes2($add[z_titlepicl])."','".eaddslashes2($add[qz_titlepicl])."','$add[save_titlepicl]',$add[keynum],$add[insertnum],$add[copyflash],$mr[tid],'$mr[tbname]',$add[pagetype],'".eaddslashes2($add[smallpagezz])."','".eaddslashes2($add[pagezz])."','".eaddslashes2($add[smallpageallzz])."','".eaddslashes2($add[pageallzz])."',$add[mark],$add[enpagecode],$add[recjtheurl],$add[hiddenload],$add[justloadin],$add[justloadcheck],$add[delloadinfo],'".eaddslashes2($add[pagerepad])."',$add[getfirstpic],'".eaddslashes2($add[oldpagerep])."','".eaddslashes2($add[newpagerep])."',$keeptime,$lasttime,$newstextisnull,$add[getfirstspic],$add[getfirstspicw],$add[getfirstspich],$add[doaddtextpage],$add[infourlispage]);");
	$classid=$empire->lastid();
	if($newsclassid)
	{
		//寫入副表
		$usql=$empire->query("insert into {$dbtbpre}ecms_infoclass_".$mr[tbname]."(classid".$ret_r[0].") values($classid".$ret_r[1].");");
	}
	if($sql)
	{
		//操作日誌
		insert_dolog("classid=".$classid."<br>classname=".$add[classname]);
		printerror("AddInfoClassSuccess","AddInfoClass.php?enews=AddInfoClass&newsclassid=$newsclassid&from=".ehtmlspecialchars($_POST[from]).hReturnEcmsHashStrHref2(0));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//修改節點
function EditInfoClass($bclassid,$newsclassid,$add,$ztid,$userid,$username){
	global $empire,$class_r,$dbtbpre;
	if(!$add[classid]||!$add[classname])
	{printerror("EmptyInfoTitleSuccess","history.go(-1)");}
	//操作權限
	CheckLevel($userid,$username,$classid,"cj");
	//父節點與原節點一樣
	if($add[classid]==$bclassid)
	{printerror("OldInfoidNotSingle","history.go(-1)");}
	//選擇欄目
	if($newsclassid)
	{
		if(!$class_r[$newsclassid][islast])
		{
			printerror("CjClassidMustLast","history.go(-1)");
		}
		//返回採集頁面地址
		$add[infourl]=ReturnInfoUrl($add);
		//取得採集字段
		$mr=$empire->fetch1("select cj,tid,tbname from {$dbtbpre}enewsmod where mid='".$class_r[$newsclassid][modid]."'");
	}
	if(empty($add[startday]))
	{$add[startday]=date("Y-m-d");}
	if(empty($add[endday]))
	{$add[endday]="2099-12-31";}
	if(empty($add[relistnum]))
	{$add[relistnum]=1;}
	if(empty($add[renum]))
	{$add[renum]=2;}
	if(empty($add[insertnum]))
	{$add[insertnum]=10;}
	//處理變量
	$add[classid]=(int)$add[classid];
	$bclassid=(int)$bclassid;
	$newsclassid=(int)$newsclassid;
	$add[num]=(int)$add[num];
	$add[copyimg]=(int)$add[copyimg];
	$add[renum]=(int)$add[renum];
	$add[titlelen]=(int)$add[titlelen];
	$add[retitlewriter]=(int)$add[retitlewriter];
	$add[smalltextlen]=(int)$add[smalltextlen];
	$add[relistnum]=(int)$add[relistnum];
	$add[keynum]=(int)$add[keynum];
	$add[insertnum]=(int)$add[insertnum];
	$add[copyflash]=(int)$add[copyflash];
	$mr[tid]=(int)$mr[tid];
	$add[pagetype]=(int)$add[pagetype];
	$add[mark]=(int)$add[mark];
	$add[enpagecode]=(int)$add[enpagecode];
	$add[recjtheurl]=(int)$add[recjtheurl];
	$add[hiddenload]=(int)$add[hiddenload];
	$add[justloadin]=(int)$add[justloadin];
	$add[justloadcheck]=(int)$add[justloadcheck];
	$add[delloadinfo]=(int)$add[delloadinfo];
	$add[getfirstpic]=(int)$add[getfirstpic];
	$add[getfirstspic]=(int)$add[getfirstspic];
	$add[getfirstspicw]=(int)$add[getfirstspicw];
	$add[getfirstspich]=(int)$add[getfirstspich];
	$add[doaddtextpage]=(int)$add[doaddtextpage];
	$add[infourlispage]=(int)$add[infourlispage];
	$keeptime=(int)$add['keeptime'];
	$newstextisnull=(int)$add['newstextisnull'];
	//主表
	$sql=$empire->query("update {$dbtbpre}enewsinfoclass set bclassid=$bclassid,classname='".eaddslashes($add[classname])."',infourl='".eaddslashes2($add[infourl])."',newsclassid=$newsclassid,startday='$add[startday]',endday='$add[endday]',bz='".eaddslashes2($add[bz])."',num=$add[num],copyimg=$add[copyimg],renum=$add[renum],keyboard='".eaddslashes2($add[keyboard])."',oldword='".eaddslashes2($add[oldword])."',newword='".eaddslashes2($add[newword])."',titlelen=$add[titlelen],retitlewriter=$add[retitlewriter],smalltextlen=$add[smalltextlen],zz_smallurl='".eaddslashes2($add[zz_smallurl])."',zz_newsurl='".eaddslashes2($add[zz_newsurl])."',httpurl='".eaddslashes2($add[httpurl])."',repad='".eaddslashes2($add[repad])."',imgurl='".eaddslashes2($add[imgurl])."',relistnum=$add[relistnum],zz_titlepicl='".eaddslashes2($add[zz_titlepicl])."',z_titlepicl='".eaddslashes2($add[z_titlepicl])."',qz_titlepicl='".eaddslashes2($add[qz_titlepicl])."',save_titlepicl='$add[save_titlepicl]',keynum=$add[keynum],insertnum=$add[insertnum],copyflash=$add[copyflash],tid=$mr[tid],tbname='$mr[tbname]',pagetype=$add[pagetype],smallpagezz='".eaddslashes2($add[smallpagezz])."',pagezz='".eaddslashes2($add[pagezz])."',smallpageallzz='".eaddslashes2($add[smallpageallzz])."',pageallzz='".eaddslashes2($add[pageallzz])."',mark=$add[mark],enpagecode=$add[enpagecode],recjtheurl=$add[recjtheurl],hiddenload=$add[hiddenload],justloadin=$add[justloadin],justloadcheck=$add[justloadcheck],delloadinfo=$add[delloadinfo],pagerepad='".eaddslashes2($add[pagerepad])."',getfirstpic=$add[getfirstpic],oldpagerep='".eaddslashes2($add[oldpagerep])."',newpagerep='".eaddslashes2($add[newpagerep])."',keeptime='$keeptime',newstextisnull=$newstextisnull,getfirstspic=$add[getfirstspic],getfirstspicw=$add[getfirstspicw],getfirstspich=$add[getfirstspich],doaddtextpage=$add[doaddtextpage],infourlispage=$add[infourlispage] where classid='$add[classid]'");
	if($newsclassid)
	{
		//是否已有記錄
		$havenum=$empire->num("select count(*) as total from {$dbtbpre}ecms_infoclass_".$mr[tbname]." where classid='$add[classid]' limit 1");
		//原本是父欄目
		if(empty($add[oldnewsclassid])&&!$havenum)
		{
			$ret_r=ReturnAddCj($add,$mr[cj],0);
			//寫入副表
			$usql=$empire->query("insert into {$dbtbpre}ecms_infoclass_".$mr[tbname]."(classid".$ret_r[0].") values($add[classid]".$ret_r[1].");");
	    }
		else
		{
			$ret_r=ReturnAddCj($add,$mr[cj],1);
			//副表
			$usql=$empire->query("update {$dbtbpre}ecms_infoclass_".$mr[tbname]." set classid='$add[classid]'".$ret_r[0]." where classid='$add[classid]'");
		}
	}
	//來源
	if($_POST['from'])
	{
		$returnurl="ListPageInfoClass.php";
	}
	else
	{
		$returnurl="ListInfoClass.php";
	}
	if($sql)
	{
		//操作日誌
	    insert_dolog("classid=".$add[classid]."<br>classname=".$add[classname]);
		printerror("EditInfoClassSuccess",$returnurl.hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//刪除採集節點
function DelInfoClass($classid,$userid,$username){
	global $empire,$dbtbpre;
	if(empty($classid))
	{printerror("NotDelInfoid","history.go(-1)");}
	//操作權限
	CheckLevel($userid,$username,$classid,"cj");
	$r=$empire->fetch1("select classname,tid,tbname,newsclassid from {$dbtbpre}enewsinfoclass where classid='$classid'");
	$del=$empire->query("delete from {$dbtbpre}enewsinfoclass where classid='$classid'");
	if($r[newsclassid])
	{
		$del2=$empire->query("delete from {$dbtbpre}ecms_infoclass_".$r[tbname]." where classid='$classid'");
		$del1=$empire->query("delete from {$dbtbpre}ecms_infotmp_".$r[tbname]." where classid='$classid'");
	}
	//刪除子節點
	DelInfoClass1($classid);
	//來源
	if($_GET['from'])
	{
		$returnurl="ListPageInfoClass.php";
	}
	else
	{
		$returnurl="ListInfoClass.php";
	}
	if($del)
	{
		//操作日誌
		insert_dolog("classid=".$classid."<br>classname=".$r[classname]);
		printerror("DelInfoClassSuccess",$returnurl.hReturnEcmsHashStrHref2(1));
	}
	else
	{printerror("DbError","history.go(-1)");}
}

//遞歸刪除節點
function DelInfoClass1($classid){
	global $empire,$dbtbpre;
	if(empty($classid))
	{
		return "";
    }
	$sql=$empire->query("select classid,tid,tbname,newsclassid from {$dbtbpre}enewsinfoclass where bclassid='$classid'");
	while($r=$empire->fetch($sql))
	{
		$del=$empire->query("delete from {$dbtbpre}enewsinfoclass where classid='$r[classid]'");
		if($r[newsclassid])
		{
			$del1=$empire->query("delete from {$dbtbpre}ecms_infotmp_".$r[tbname]." where classid='$r[classid]'");
			$del2=$empire->query("delete from {$dbtbpre}ecms_infoclass_".$r[tbname]." where classid='$r[classid]'");
		}
		DelInfoClass1($r[classid]);
    }
}

//設置伸縮
function SetDisplayInfoClass($open){
	$time=time()+365*24*3600;
	$set=esetcookie("displayinfoclass",$open,$time,1);
	echo"<script>self.location.href='ListInfoClass.php".hReturnEcmsHashStrHref2(1)."';</script>";
	exit();
}

//顯示無限級節點[管理節點時]
function ShowClass_ListInfoClass($bclassid,$exp){
	global $empire,$class_r,$fun_r,$dbtbpre,$ecms_hashur;
	//縮
	if(getcvar('displayinfoclass',1))
	{
		$display=" style=display=none";
    }
	if(empty($bclassid))
	{
		$bclassid=0;
		$exp="";
    }
	else
	{$exp="&nbsp;&nbsp;&nbsp;".$exp;}
	$sql=$empire->query("select * from {$dbtbpre}enewsinfoclass where bclassid='$bclassid' order by classid desc");
	$returnstr="";
	while($r=$empire->fetch($sql))
	{
		//採集頁面
		$pager=explode("\r\n",$r[infourl]);
	    $infourl=$pager[0];
		$divonclick="";
		$start_tbody="";
		$end_tbody="";
		$img="../data/images/dir.gif";
		if(empty($r[bclassid]))
		{
			$bgcolor="#DBEAF5";
			$divonclick=" language=JScript onMouseUp='turnit(classdiv".$r[classid].");' style='CURSOR: hand' title='open'";
			$start_tbody="<tbody id='classdiv".$r[classid]."'".$display.">";
	        $end_tbody="</tbody>";
		}
		else
		{$bgcolor="#ffffff";}
		if($r[newsclassid])
		{
			$lastcjtime=!$r['lasttime']?'從未採集':date("Y-m-d H:i:s",$r['lasttime']);
			$cj="<a href='DoCj.php?enews=CjUrl&classid[]=".$r[classid].$ecms_hashur['href']."' title='最後採集時間：".$lastcjtime."'><u>".$fun_r['StartCj']."</u></a>";
			$emptydb="&nbsp;[<a href=ListInfoClass.php?enews=EmptyCj&classid=$r[classid]".$ecms_hashur['href']." onclick=\"return confirm('".$fun_r['CheckEmptyCjRecord']."');\">".$fun_r['EmptyCjRecord']."</a>]";
			$loadoutcj="&nbsp;[<a href=ecmscj.php?enews=LoadOutCj&classid=$r[classid]".$ecms_hashur['href']." onclick=\"return confirm('確認要導出?');\">導出</a>]";
			$checkbox="<input type=checkbox name=classid[] value=$r[classid]>";
		}
		else
		{
			$cj=$fun_r['StartCj'];
			$emptydb="";
			$loadoutcj="";
			$checkbox="";
		}
		//欄目鏈接
		$getcurlr['classid']=$r[newsclassid];
		$classurl=sys_ReturnBqClassname($getcurlr,9);
		$returnstr.="<tr bgcolor=".$bgcolor.">
	<td height=25 align='center'>".$checkbox."</td>
    <td height=25".$divonclick.">".$exp."<img src=".$img." width=19 height=15></td>
    <td height=25><div align=center>".$cj."</div></td>
    <td height=25><a href='".$infourl."' target=_blank>".$r[classname]."</a></td>
    <td height=25><div align=center><a href=ecmscj.php?enews=ViewCjList&classid=".$r[classid].$ecms_hashur['href']." target=_blank>".$fun_r['view']."</a></div></td>
    <td height=25><div align=center><a href='".$classurl."' target=_blank>".$class_r[$r[newsclassid]][classname]."</a></div></td>
    <td height=25><div align=center><a href=CheckCj.php?classid=".$r[classid].$ecms_hashur['ehref'].">".$fun_r['CheckCj']."</a></div></td>
    <td height=25><div align=center>[<a href=AddInfoClass.php?enews=AddInfoClass&docopy=1&classid=".$r[classid]."&newsclassid=".$r[newsclassid].$ecms_hashur['ehref'].">".$fun_r['Copy']."</a>]&nbsp;[<a href=AddInfoClass.php?enews=EditInfoClass&classid=".$r[classid].$ecms_hashur['ehref'].">".$fun_r['edit']."</a>]&nbsp;[<a href=ListInfoClass.php?enews=DelInfoClass&classid=".$r[classid].$ecms_hashur['href']." onclick=\"return confirm('".$fun_r['CheckDelCj']."');\">".$fun_r['del']."</a>]".$emptydb.$loadoutcj."</div></td>
  </tr>";
		//取得子節點
		$returnstr.=$start_tbody.ShowClass_ListInfoClass($r[classid],$exp).$end_tbody;
	}
	return $returnstr;
}

//清空採集記錄
function EmptyCj($classid,$userid,$username){
	global $empire,$dbtbpre;
	$classid=(int)$classid;
	if(empty($classid))
	{printerror("NotEmptyCjClassid","history.go(-1)");}
	//操作權限
	CheckLevel($userid,$username,$classid,"cj");
	$r=$empire->fetch1("select classid,classname,tbname from {$dbtbpre}enewsinfoclass where classid='$classid'");
	if(!$r[classid])
	{
		printerror("ErrorUrl","history.go(-1)");
	}
	$sql=$empire->query("delete from {$dbtbpre}ecms_infotmp_".$r[tbname]." where classid='$classid' and checked=1");
	//來源
	if($_GET['from'])
	{
		$returnurl="ListPageInfoClass.php";
	}
	else
	{
		$returnurl="ListInfoClass.php";
	}
	if($sql)
	{
		//操作日誌
	    insert_dolog("classid=".$classid."<br>classname=".$r[classname]);
		printerror("EmptyCjSuccess",$returnurl.hReturnEcmsHashStrHref2(1));
	}
	else
	{
		printerror("DbError","history.go(-1)");
	}
}

$enews=$_POST['enews'];
if(empty($enews))
{$enews=$_GET['enews'];}
if($enews)
{
	hCheckEcmsRHash();
}
//增加節點
if($enews=="AddInfoClass")
{
	$bclassid=$_POST[bclassid];
	$newsclassid=$_POST[newsclassid];
	$add=$_POST[add];
	$ztid=$_POST['ztid'];
	$add['pagerepad']=$_POST['pagerepad'];
	$add['repad']=$_POST['repad'];
	AddInfoClass($bclassid,$newsclassid,$add,$ztid,$logininid,$loginin);
}
//修改節點
elseif($enews=="EditInfoClass")
{
	$bclassid=$_POST[bclassid];
	$newsclassid=$_POST[newsclassid];
	$add=$_POST[add];
	$ztid=$_POST['ztid'];
	$add['pagerepad']=$_POST['pagerepad'];
	$add['repad']=$_POST['repad'];
	EditInfoClass($bclassid,$newsclassid,$add,$ztid,$logininid,$loginin);
}
//刪除節點
elseif($enews=="DelInfoClass")
{
	$classid=$_GET[classid];
	DelInfoClass($classid,$logininid,$loginin);
}
//清空採集記錄
elseif($enews=="EmptyCj")
{
	$classid=$_GET['classid'];
	EmptyCj($classid,$logininid,$loginin);
}

//展開
if($_GET['doopen'])
{
	$open=(int)$_GET['open'];
	SetDisplayInfoClass($open);
}
//圖標
if(getcvar('displayinfoclass',1))
{
	$img="<a href='ListInfoClass.php?doopen=1&open=0".$ecms_hashur['ehref']."' title='展開'><img src='../data/images/displaynoadd.gif' width='15' height='15' border='0'></a>";
}
else
{
	$img="<a href='ListInfoClass.php?doopen=1&open=1".$ecms_hashur['ehref']."' title='收縮'><img src='../data/images/displayadd.gif' width='15' height='15' border='0'></a>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>管理節點</title>
<link href="adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
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
 function turnit(ss)
{
 if (ss.style.display=="") 
  ss.style.display="none";
 else
  ss.style.display=""; 
}
var newWindow = null
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr> 
    <td width="50%">位置：採集 &gt; <a href="ListInfoClass.php<?=$ecms_hashur['whehref']?>">管理節點</a></td>
    <td><div align="right" class="emenubutton">
        <input type="button" name="Submit5" value="增加節點" onclick="self.location.href='AddInfoC.php<?=$ecms_hashur['whehref']?>';">
		&nbsp;&nbsp;
        <input type="button" name="Submit52" value="導入採集規則" onclick="self.location.href='cj/LoadInCj.php<?=$ecms_hashur['whehref']?>';">
      </div></td>
  </tr>
</table>
<form name=form1 method=get action="DoCj.php" onsubmit="return confirm('確認要採集?');" target=_blank>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableborder">
<?=$ecms_hashur['form']?>
<input type=hidden name=enews value=DoCj>
  <tr class="header">
    <td width="3%"><div align="center"></div></td>
    <td width="8%" height="25"><div align="center"><?=$img?></div></td>
    <td width="8%" height="25"> <div align="center">採集</div></td>
    <td width="27%" height="25"> <div align="center">節點(點擊訪問採集頁)</div></td>
    <td width="6%" height="25"> <div align="center">預覽</div></td>
    <td width="16%" height="25"> <div align="center">綁定欄目</div></td>
    <td width="9%" height="25"> <div align="center">審核採集</div></td>
    <td width="24%" height="25"> 
      <div align="center">操作</div></td>
  </tr>
  <?php
echo ShowClass_ListInfoClass(0,'');
?>
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr> 
    <td><input type=checkbox name=chkall value=on onClick=CheckAll(this.form)>
        選中全部 
        &nbsp;&nbsp;<input type="submit" name="Submit" value="批量採集節點"></td>
  </tr>
</table>
</form>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td><font color="#666666">備註：彈出採集窗口，請按住&quot;Shift&quot;+點擊〞開始採集&quot;</font></td>
  </tr>
</table>
</body>
</html>
<?php
db_close();
$empire=null;
?>
