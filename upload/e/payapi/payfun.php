<?php
//�ʶR�I�ƳB�z
function PayApiBuyFen($fen,$money,$paybz,$orderid,$userid,$username,$ecms_paytype){
	global $empire,$dbtbpre;
	$fen=(int)$fen;
	$money=(float)$money;
	$paybz=RepPostStr($paybz);
	$userid=(int)$userid;
	$username=RepPostVar($username);
	$ecms_paytype=RepPostVar($ecms_paytype);
	//���ҬO�_���ƴ���
	$orderid=RepPostVar($orderid);
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewspayrecord where orderid='$orderid' limit 1");
	if($num)
	{
		printerror('�z�w���\�ʶR '.$fen.' �I','../../../',1,0,1);
	}
	if($fen)
	{
		$sql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('userfen')."=".egetmf('userfen')."+".$fen." where ".egetmf('userid')."='$userid'");
		$posttime=date("Y-m-d H:i:s");
		$payip=egetip();
		$empire->query("insert into {$dbtbpre}enewspayrecord(id,userid,username,orderid,money,posttime,paybz,type,payip) values(NULL,'$userid','$username','$orderid','$money','$posttime','$paybz','$ecms_paytype','$payip');");
		//�ƥ��R�ȰO��
		BakBuy($userid,$username,$orderid,$fen,$money,0,2);
	}
	printerror('�z�w���\�ʶR '.$fen.' �I','../../../',1,0,1);
}

//�w�I�ڳB�z
function PayApiPayMoney($money,$paybz,$orderid,$userid,$username,$ecms_paytype){
	global $empire,$dbtbpre;
	$money=(float)$money;
	$paybz=RepPostStr($paybz);
	$userid=(int)$userid;
	$username=RepPostVar($username);
	$ecms_paytype=RepPostVar($ecms_paytype);
	//���ҬO�_���ƴ���
	$orderid=RepPostVar($orderid);
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewspayrecord where orderid='$orderid' limit 1");
	if($num)
	{
		printerror('�z�w���\�s�w�I�� '.$money.' ��','../../../',1,0,1);
	}
	if($money)
	{
		$sql=$empire->query("update ".eReturnMemberTable()." set ".egetmf('money')."=".egetmf('money')."+".$money." where ".egetmf('userid')."='$userid'");
		$posttime=date("Y-m-d H:i:s");
		$payip=egetip();
		$empire->query("insert into {$dbtbpre}enewspayrecord(id,userid,username,orderid,money,posttime,paybz,type,payip) values(NULL,'$userid','$username','$orderid','$money','$posttime','$paybz','$ecms_paytype','$payip');");
		//�ƥ��R�ȰO��
		BakBuy($userid,$username,$orderid,0,$money,0,3);
	}
	printerror('�z�w���\�s�w�I�� '.$money.' ��','../../../',1,0,1);
}

//�ӫ���I
function PayApiShopPay($ddid,$money,$paybz,$orderid,$userid,$username,$ecms_paytype){
	global $empire,$dbtbpre;
	$ddid=(int)$ddid;
	$userid=(int)$userid;
	$username=RepPostVar($username);
	$ecms_paytype=RepPostVar($ecms_paytype);
	//���ҬO�_���ƴ���
	$orderid=RepPostVar($orderid);
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewspayrecord where orderid='$orderid' limit 1");
	if($num)
	{
		printerror('�z�w���\�ʶR���q��','../../ShopSys/buycar/',1,0,1);
	}
	$ddr=PayApiShopDdMoney($ddid);
	if($money==$ddr['tmoney'])
	{
		include('../../ShopSys/class/ShopSysFun.php');
		$money=(float)$money;
		$sql=$empire->query("update {$dbtbpre}enewsshopdd set haveprice=1 where ddid='$ddid'");
		//��֮w�s
		$shoppr=ShopSys_ReturnSet();
		if($shoppr['cutnumtype']==1)
		{
			$buycarr=$empire->fetch1("select buycar from {$dbtbpre}enewsshopdd_add where ddid='$ddid'");
			Shopsys_CutMaxnum($ddid,$buycarr['buycar'],$ddr['havecutnum'],$shoppr,0);
		}
		$posttime=date("Y-m-d H:i:s");
		$payip=egetip();
		$userid=(int)$ddr[userid];
		$username=$ddr[username]?$ddr[username]:$ddr[truename];
		$username=RepPostStr($username);
		$paybz=str_replace('[!--ddno--]',$ddr[ddno],$paybz);
		$paybz=RepPostStr($paybz);
		$empire->query("insert into {$dbtbpre}enewspayrecord(id,userid,username,orderid,money,posttime,paybz,type,payip) values(NULL,'$userid','$username','$orderid','$money','$posttime','$paybz','$ecms_paytype','$payip');");
	}
	printerror('�z�w���\�ʶR���q��','../../ShopSys/buycar/',1,0,1);
}

//�ӫ��q����B
function PayApiShopDdMoney($ddid){
	global $empire,$dbtbpre;
	$ddid=(int)$ddid;
	if(empty($ddid))
	{
		printerror('�q�椣�s�b','../../../',1,0,1);
	}
	$r=$empire->fetch1("select ddid,ddno,userid,username,truename,pstotal,alltotal,fptotal,pretotal,fp,payby,havecutnum from {$dbtbpre}enewsshopdd where ddid='$ddid'");
	if(empty($r['ddid']))
	{
		printerror('�q�椣�s�b','../../../',1,0,1);
	}
	//�O�_�{���ʶR
	if($r['payby']!=0)
	{
		printerror('���q�欰�D�{����I','../../../',1,0,1);
	}
	$r['tmoney']=$r['alltotal']+$r['pstotal']+$r['fptotal']-$r['pretotal'];
	return $r;
}

//�R��������I
function PayApiBuyGroupPay($bgid,$money,$orderid,$userid,$username,$groupid,$ecms_paytype){
	global $empire,$dbtbpre,$level_r;
	$bgid=(int)$bgid;
	$userid=(int)$userid;
	$username=RepPostVar($username);
	$groupid=(int)$groupid;
	$ecms_paytype=RepPostVar($ecms_paytype);
	//���ҬO�_���ƴ���
	$orderid=RepPostVar($orderid);
	$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewspayrecord where orderid='$orderid' limit 1");
	if($num)
	{
		printerror('�z�w���\�R��','../../../',1,0,1);
	}
	$buyr=$empire->fetch1("select * from {$dbtbpre}enewsbuygroup where id='$bgid'");
	if($buyr['id']&&$money==$buyr['gmoney']&&$level_r[$buyr[buygroupid]][level]<=$level_r[$groupid][level])
	{
		$money=(float)$money;
		//�R��
		$user=$empire->fetch1("select ".eReturnSelectMemberF('userdate,userid,username')." from ".eReturnMemberTable()." where ".egetmf('userid')."='$userid'");
		eAddFenToUser($buyr['gfen'],$buyr['gdate'],$buyr['ggroupid'],$buyr['gzgroupid'],$user);
		$posttime=date("Y-m-d H:i:s");
		$payip=egetip();
		$paybz="�R������:".addslashes($buyr['gname']);
		$paybz=RepPostStr($paybz);
		$empire->query("insert into {$dbtbpre}enewspayrecord(id,userid,username,orderid,money,posttime,paybz,type,payip) values(NULL,'$userid','$username','$orderid','$money','$posttime','$paybz','$ecms_paytype','$payip');");
		//�ƥ��R�ȰO��
		BakBuy($userid,$username,$buyr['gname'],$buyr['gfen'],$money,$buyr['gdate'],1);
	}
	printerror('�z�w���\�R��','../../../',1,0,1);
}
?>