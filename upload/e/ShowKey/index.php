<?php
require('../class/connect.php');

//���o�H����
function domake_password($pw_length){
	global $public_r;
	if($public_r['keytog']==1)//�r��
	{
		$low_ascii_bound=65;
		$upper_ascii_bound=90;
		$notuse=array(91);
	}
	elseif($public_r['keytog']==2)//�Ʀr+�r��
	{
		$low_ascii_bound=50;
		$upper_ascii_bound=90;
		$notuse=array(58,59,60,61,62,63,64,73,79);
	}
	else//�Ʀr
	{
		$low_ascii_bound=48;
		$upper_ascii_bound=57;
		$notuse=array(58);
	}
	while($i<$pw_length)
	{
		if(PHP_VERSION<'4.2.0')
		{
			mt_srand((double)microtime()*1000000);
		}
		$randnum=mt_rand($low_ascii_bound,$upper_ascii_bound);
		if(!in_array($randnum,$notuse))
		{
			$password1=$password1.chr($randnum);
			$i++;
		}
	}
	return $password1;
}

//��^�C��
function ReturnShowKeyColor($img){
	global $public_r;
	//�I����
	if($public_r['keybgcolor'])
	{
		$bgcr=ToReturnRGB($public_r['keybgcolor']);
		$r['bgcolor']=imagecolorallocate($img,$bgcr[0],$bgcr[1],$bgcr[2]);
	}
	else
	{
		$r['bgcolor']=imagecolorallocate($img,102,102,102);
	}
	//��r��
	if($public_r['keyfontcolor'])
	{
		$fcr=ToReturnRGB($public_r['keyfontcolor']);
		$r['fontcolor']=ImageColorAllocate($img,$fcr[0],$fcr[1],$fcr[2]);
	}
	else
	{
		$r['fontcolor']=ImageColorAllocate($img,255,255,255);
	}
	//�z�Z��
	if($public_r['keydistcolor'])
	{
		$dcr=ToReturnRGB($public_r['keydistcolor']);
		$r['distcolor']=ImageColorAllocate($img,$dcr[0],$dcr[1],$dcr[2]);
	}
	else
	{
		$r['distcolor']=ImageColorAllocate($img,71,71,71);
	}
	return $r;
}

//������ҽX
function ShowKey($v){
	$vname=ecmsReturnKeyVarname($v);
	$key=strtolower(domake_password(4));
	ecmsSetShowKey($vname,$key);
	//�O�_���gd�w
	if(function_exists("imagejpeg")) 
	{
		header ("Content-type: image/jpeg");
		$img=imagecreate(47,20);
		$colorr=ReturnShowKeyColor($img);
		$bgcolor=$colorr['bgcolor'];
		$fontcolor=$colorr['fontcolor'];
		$distcolor=$colorr['distcolor'];
		imagefill($img,0,0,$bgcolor);
		imagestring($img,5,6,3,$key,$fontcolor);
		for($i=0;$i<90;$i++) //�[�J�z�Z�H��
		{
			imagesetpixel($img,rand()%70,rand()%30,$distcolor);
		}
		imagejpeg($img);
		imagedestroy($img);
	}
	elseif (function_exists("imagepng"))
	{
		header ("Content-type: image/png");
		$img=imagecreate(47,20);
		$colorr=ReturnShowKeyColor($img);
		$bgcolor=$colorr['bgcolor'];
		$fontcolor=$colorr['fontcolor'];
		$distcolor=$colorr['distcolor'];
		imagefill($img,0,0,$bgcolor);
		imagestring($img,5,6,3,$key,$fontcolor);
		for($i=0;$i<90;$i++) //�[�J�z�Z�H��
		{
			imagesetpixel($img,rand()%70,rand()%30,$distcolor);
		}
		imagepng($img);
		imagedestroy($img);
	}
	elseif (function_exists("imagegif")) 
	{
		header("Content-type: image/gif");
		$img=imagecreate(47,20);
		$colorr=ReturnShowKeyColor($img);
		$bgcolor=$colorr['bgcolor'];
		$fontcolor=$colorr['fontcolor'];
		$distcolor=$colorr['distcolor'];
		imagefill($img,0,0,$bgcolor);
		imagestring($img,5,6,3,$key,$fontcolor);
		for($i=0;$i<90;$i++) //�[�J�z�Z�H��
		{
			imagesetpixel($img,rand()%70,rand()%30,$distcolor);
		}
		imagegif($img);
		imagedestroy($img);
	}
	elseif (function_exists("imagewbmp")) 
	{
		header ("Content-type: image/vnd.wap.wbmp");
		$img=imagecreate(47,20);
		$colorr=ReturnShowKeyColor($img);
		$bgcolor=$colorr['bgcolor'];
		$fontcolor=$colorr['fontcolor'];
		$distcolor=$colorr['distcolor'];
		imagefill($img,0,0,$bgcolor);
		imagestring($img,5,6,3,$key,$fontcolor);
		for($i=0;$i<90;$i++) //�[�J�z�Z�H��
		{
			imagesetpixel($img,rand()%70,rand()%30,$distcolor);
		}
		imagewbmp($img);
		imagedestroy($img);
	}
	else
	{
		ecmsSetShowKey($vname,'ecms');
		echo ReadFiletext("../data/images/ecms.jpg");
	}
}

//��^�ܶq�W
function ecmsReturnKeyVarname($v){
	if($v=='login')//�n��
	{
		$name='checkloginkey';
	}
	elseif($v=='reg')//���U
	{
		$name='checkregkey';
	}
	elseif($v=='info')//�H��
	{
		$name='checkinfokey';
	}
	elseif($v=='spacefb')//�Ŷ����X
	{
		$name='checkspacefbkey';
	}
	elseif($v=='spacegb')//�Ŷ��d��
	{
		$name='checkspacegbkey';
	}
	elseif($v=='gbook')//�d��
	{
		$name='checkgbookkey';
	}
	elseif($v=='feedback')//���X
	{
		$name='checkfeedbackkey';
	}
	elseif($v=='getpassword')//���^�K�X
	{
		$name='checkgetpasskey';
	}
	elseif($v=='regsend')//���o�E���l��
	{
		$name='checkregsendkey';
	}
	else//����pl
	{
		$name='checkplkey';
	}
	return $name;
}

$v=$_GET['v'];
ShowKey($v);
?>