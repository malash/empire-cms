<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
define('EmpireCMSConfig',TRUE);
$ecms_config=array();

//�ƾڮw�]�m
$ecms_config['db']['usedb']='<!--dbtype.phome.net-->';	//�ƾڮw����
$ecms_config['db']['dbver']='<!--dbver.phome.net-->';	//�ƾڮw����
$ecms_config['db']['dbserver']='<!--host.phome.net-->';	//�ƾڮw�n���a�}
$ecms_config['db']['dbport']='<!--port.phome.net-->';	//�ݤf�A���񬰫��q�{
$ecms_config['db']['dbusername']='<!--username.phome.net-->';	//�ƾڮw�Τ�W
$ecms_config['db']['dbpassword']='<!--password.phome.net-->';	//�ƾڮw�K�X
$ecms_config['db']['dbname']='<!--name.phome.net-->';	//�ƾڮw�W
$ecms_config['db']['setchar']='<!--char.phome.net-->';	//�]�m�q�{�s�X
$ecms_config['db']['dbchar']='<!--dbchar.phome.net-->';	//�ƾڮw�q�{�s�X
$ecms_config['db']['dbtbpre']='<!--tbpre.phome.net-->';	//�ƾڪ�e��
$dbtbpre=$ecms_config['db']['dbtbpre'];	//�ƾڪ�e��
$ecms_config['db']['showerror']=1;	//���SQL���~����(0�������,1�����)


//�����s�X�]�m
$ecms_config['sets']['pagechar']='<!--headerchar.phome.net-->';	//�w�˫Ұ�CMS���s�X����
$ecms_config['sets']['setpagechar']=1;	//�����q�{�r�Ŷ�,0=���� 1=�}��
$ecms_config['sets']['elang']='gb';	//�y���]

//��x�����t�m
$ecms_config['esafe']['openonlinesetting']=3;	//�}�ҫ�x�b�u�t�m�Ѽ�(0������,1���}�Ҩ�����t�m,2���}�Ҧw���t�m,3�����}��)
$ecms_config['esafe']['openeditdttemp']=1;	//�}�ҫ�x�b�u�ק�ʺA�ҪO(0������,1���}��)

//���q��t�ΰt�m
$ecms_config['epassport']['open']=0;	//�O�_�}�ҩ��q��t��(1���}�ҡA0������)

//�䥦�t�m
$ecms_config['sets']['txtpath']=ECMS_PATH.'d/txt/';	//�奻���ƾڦs��ؿ�
$ecms_config['sets']['saveurlimgclearurl']=0;	//���{�O�s�Ϥ��۰ʥh���Ϥ����챵(0���O�d,1���h��)
$ecms_config['sets']['deftempid']=0;	//�q�{�ҪO��ID
$ecms_config['sets']['selfmoreportid']=0;	//��e�����X�ݺ�ID,0���D�X�ݺ�



//-------EmpireCMS.Seting.member-------

//�|���t�ά����t�m
$ecms_config['member']['tablename']="{$dbtbpre}enewsmember";	//�|����
$user_tablename=$ecms_config['member']['tablename'];	//�|����
$ecms_config['member']['changeregisterurl']="ChangeRegister.php";    //�h�|���դ�����U�a�}
$ecms_config['member']['registerurl']="";							//�|�����U�a�}
$ecms_config['member']['loginurl']="";								//�|���n���a�}
$ecms_config['member']['quiturl']="";								//�|���h�X�a�}
$ecms_config['member']['chmember']=0;//�O�_�ϥέ쪩�|����H��,0���쪩,1���D�쪩
$ecms_config['member']['pwtype']=2;//�K�X�O�s�Φ�,0��md5,1�����X,2�������[�K,3��16��md5
$ecms_config['member']['regtimetype']=1;//���U�ɶ��O�s�榡,0�����`�ɶ�,1���ƭȫ�
$ecms_config['member']['regcookietime']=0;//���U��n���O�s�ɶ�(��)
$ecms_config['member']['defgroupid']=0;//���U�ɷ|����ID(ecms���|����,0����x�q�{)
$ecms_config['member']['saltnum']=6;//SALT�H���X�r�ż�
$ecms_config['member']['utfdata']=0;//�ƾڬO�_�OUTF8�s�X,0�����`�ƾ�,1��UTF8�s�X

$ecms_config['memberf']['userid']='userid';//�Τ�ID�r�q
$ecms_config['memberf']['username']='username';//�Τ�W�r�q
$ecms_config['memberf']['password']='password';//�K�X�r�q
$ecms_config['memberf']['rnd']='rnd';//�H���K�X�r�q
$ecms_config['memberf']['email']='email';//�l�c�r�q
$ecms_config['memberf']['registertime']='registertime';//���U�ɶ��r�q
$ecms_config['memberf']['groupid']='groupid';//�|���զr�q
$ecms_config['memberf']['userfen']='userfen';//�n���r�q
$ecms_config['memberf']['userdate']='userdate';//���Ĵ��r�q
$ecms_config['memberf']['money']='money';//�b��l�B�r�q
$ecms_config['memberf']['zgroupid']='zgroupid';//�����V�|���զr�q
$ecms_config['memberf']['havemsg']='havemsg';//���ܵu�����r�q
$ecms_config['memberf']['checked']='checked';//�f�֪��A�r�q
$ecms_config['memberf']['salt']='salt';//SALT�[�K�r�q
$ecms_config['memberf']['userkey']='userkey';//�Τ�K�_�r�q

//-------EmpireCMS.Seting.member-------




//-------EmpireCMS.Seting.area-------

//��x�w���]�m
$ecms_config['esafe']['loginauth']='<!--loginauth.phome.net-->';	//�n���{�ҽX,�p�G�]�m�n���ݭn��J���{�ҽX�~��q�L
$ecms_config['esafe']['ecookiernd']='<!--cookiernd.phome.net-->';	//��x�n��COOKIE�{�ҽX(��g10~50�ӥ��N�r�šA�̦n�h�ئr�ŲզX)
$ecms_config['esafe']['ckhloginip']=0;	//��x�O�_���ҵn��IP,0��������,1������
$ecms_config['esafe']['ckhsession']=0;	//��x�O�_�ҥ�SESSION����,0��������,1������
$ecms_config['esafe']['ckhanytime']=0;	//��x�H�ɻ{�ҽX�ܧ�g��,���:��(0�����ҥ�)
$ecms_config['esafe']['theloginlog']=0;	//�O�_�O���n����x(0���O��,1�����O��)
$ecms_config['esafe']['thedolog']=0;		//�O�_�O���ާ@��x(0���O��,1�����O��)
$ecms_config['esafe']['ckfromurl']=2;	//�O�_�ҥΨӷ��a�}����,0��������,1����������,2����x����,3���e�x����
$ecms_config['esafe']['ckhash']=0;	//�ҥΫ�x�ӷ��{�ҽX,0������Ҧ�����,1����糼Ҧ�����,2����������

//COOKIE�]�m
$ecms_config['cks']['ckdomain']='';		//cookie�@�ΰ�
$ecms_config['cks']['ckpath']='/';		//cookie�@�θ��|
$ecms_config['cks']['ckvarpre']='<!--cookiepre.phome.net-->';		//�e�xcookie�ܶq�e��
$ecms_config['cks']['ckadminvarpre']='<!--admincookiepre.phome.net-->';		//��xcookie�ܶq�e��
$ecms_config['cks']['ckrnd']='<!--qcookiernd.phome.net-->';	//COOKIE�����H���X(��g10~50�ӥ��N�r�šA�̦n�h�ئr�ŲզX)
$ecms_config['cks']['ckrndtwo']='<!--qcookierndtwo.phome.net-->';	//COOKIE�����H���X2(��g10~50�ӥ��N�r�šA�̦n�h�ئr�ŲզX)

//����������t�m
$ecms_config['fw']['eopen']=0;	//�}�Ҩ�����(0������,1���}��)
$ecms_config['fw']['epass']='';	//������[�K�K�_(��g10~50�ӥ��N�r�šA�̦n�h�ئr�ŲզX)
$ecms_config['fw']['adminloginurl']='';	//���\��x�n������W,�]�m�ᥲ���q�L�o�Ӱ�W�~��X�ݫ�x
$ecms_config['fw']['adminhour']='';	//���\�n����x���ɶ��G0~23�p�ɡA�h�Ӯɶ��I�Υb���r����}
$ecms_config['fw']['adminweek']='';	//���\�n����x���P���G�P��0~6�A�h�ӬP���Υb���r����}
$ecms_config['fw']['adminckpassvar']='';	//��x�w�n�������ܶq�W
$ecms_config['fw']['adminckpassval']='';	//��x�w�n���{�ҽX
$ecms_config['fw']['cleargettext']='';	//�̽�����ӷP�r�šA�h�ӥΥb���r����}

//-------EmpireCMS.Seting.area-------


//�������
$ecms_config['sets']['tranpicturetype']=',.jpg,.gif,.png,.bmp,.jpeg,';	//�Ϥ�
$ecms_config['sets']['tranflashtype']=',.swf,.flv,.dcr,';	//FLASH
$ecms_config['sets']['mediaplayertype']=',.wmv,.asf,.wma,.mp3,.asx,.mid,.midi,';	//mediaplayer
$ecms_config['sets']['realplayertype']=',.rm,.ra,.rmvb,.mp4,.mov,.avi,.wav,.ram,.mpg,.mpeg,';	//realplayer




//***************** �H�U�������w�s�A���γ]�m **************

//-------EmpireCMS.Public.Cache-------

//------------e_public
$public_r=array('sitename'=>'�Ұ�����޲z�t��',
'newsurl'=>'<!--ecms.newsurl-->',
'filetype'=>'|.gif|.jpg|.swf|.rar|.zip|.mp3|.wmv|.txt|.doc|',
'filesize'=>2048,
'relistnum'=>8,
'renewsnum'=>100,
'min_keyboard'=>2,
'max_keyboard'=>20,
'search_num'=>20,
'search_pagenum'=>10,
'newslink'=>0,
'checked'=>0,
'searchtime'=>30,
'loginnum'=>5,
'logintime'=>60,
'addnews_ok'=>0,
'register_ok'=>0,
'indextype'=>'.html',
'goodlencord'=>0,
'goodtype'=>'',
'searchtype'=>'.html',
'exittime'=>40,
'smalltextlen'=>160,
'defaultgroupid'=>1,
'fileurl'=>'<!--ecms.fileurl-->',
'install'=>0,
'phpmode'=>0,
'dorepnum'=>300,
'loadtempnum'=>50,
'bakdbpath'=>'bdata',
'bakdbzip'=>'zip',
'downpass'=>'<!--ecms.downpass-->',
'filechmod'=>1,
'loginkey_ok'=>0,
'tbname'=>'news',
'limittype'=>0,
'redodown'=>1,
'downsofttemp'=>'[ <a href=\"#ecms\" onclick=\"window.open(\'[!--down.url--]\',\'\',\'width=300,height=300,resizable=yes\');\">[!--down.name--]</a> ]',
'onlinemovietemp'=>'[ <a href=\"#ecms\" onclick=\"window.open(\'[!--down.url--]\',\'\',\'width=300,height=300,resizable=yes\');\">[!--down.name--]</a> ]',
'lctime'=>1222406370,
'candocode'=>1,
'opennotcj'=>0,
'listpagetemp'=>'�����G[!--thispage--]/[!--pagenum--]&nbsp;�C��[!--lencord--]&nbsp;�`��[!--num--]&nbsp;&nbsp;&nbsp;&nbsp;[!--pagelink--]&nbsp;&nbsp;&nbsp;&nbsp;���:[!--options--]',
'reuserpagenum'=>50,
'revotejsnum'=>100,
'readjsnum'=>100,
'qaddtran'=>1,
'qaddtransize'=>50,
'ebakthisdb'=>1,
'delnewsnum'=>300,
'markpos'=>5,
'markimg'=>'../data/mark/maskdef.gif',
'marktext'=>'',
'markfontsize'=>'5',
'markfontcolor'=>'',
'markfont'=>'../data/mark/cour.ttf',
'adminloginkey'=>1,
'php_outtime'=>0,
'listpagefun'=>'sys_ShowListPage',
'textpagefun'=>'sys_ShowTextPage',
'adfile'=>'thea',
'notsaveurl'=>'',
'rssnum'=>50,
'rsssub'=>300,
'savetxtf'=>',article.newstext,',
'dorepdlevelnum'=>300,
'listpagelistfun'=>'sys_ShowListMorePage',
'listpagelistnum'=>10,
'infolinknum'=>100,
'searchgroupid'=>0,
'opencopytext'=>0,
'reuserjsnum'=>100,
'reuserlistnum'=>8,
'opentitleurl'=>1,
'searchtempvar'=>1,
'showinfolevel'=>0,
'navfh'=>'>',
'spicwidth'=>105,
'spicheight'=>118,
'spickill'=>1,
'jpgquality'=>80,
'markpct'=>65,
'redoview'=>24,
'reggetfen'=>0,
'regbooktime'=>30,
'revotetime'=>30,
'fpath'=>0,
'filepath'=>'Y-m-d',
'nreclass'=>',',
'nreinfo'=>',',
'nrejs'=>',',
'nottobq'=>',',
'defspacestyleid'=>1,
'canposturl'=>'',
'openspace'=>0,
'defadminstyle'=>1,
'realltime'=>0,
'closeip'=>'',
'openip'=>'',
'hopenip'=>'',
'textpagelistnum'=>6,
'memberlistlevel'=>0,
'ebakcanlistdb'=>0,
'keytog'=>2,
'keytime'=>30,
'keyrnd'=>'<!--ecms.keyrnd-->',
'checkdorepstr'=>',0,0,0,0,',
'regkey_ok'=>0,
'opengetdown'=>0,
'gbkey_ok'=>0,
'fbkey_ok'=>0,
'newaddinfotime'=>0,
'classnavs'=>'<a href=\"/ecms72/news/\">�s�D����</a>&nbsp;|&nbsp;<a href=\"/ecms72/download/\">�U������</a>&nbsp;|&nbsp;<a href=\"/ecms72/movie/\">�v���W�D</a>&nbsp;|&nbsp;<a href=\"/ecms72/shop/\">���W�ӫ�</a>&nbsp;|&nbsp;<a href=\"/ecms72/flash/\">FLASH�W�D</a>&nbsp;|&nbsp;<a href=\"/ecms72/photo/\">�Ϥ��W�D</a>&nbsp;|&nbsp;<a href=\"/ecms72/article/\">�峹����</a>&nbsp;|&nbsp;<a href=\"/ecms72/info/\">�����H��</a>',
'adminstyle'=>',1,2,',
'docnewsnum'=>300,
'openschall'=>0,
'schallfield'=>1,
'schallminlen'=>3,
'schallmaxlen'=>20,
'schallnum'=>20,
'schallpagenum'=>10,
'dtcanbq'=>1,
'dtcachetime'=>43200,
'repkeynum'=>0,
'regacttype'=>0,
'opengetpass'=>0,
'hlistinfonum'=>30,
'qlistinfonum'=>25,
'dtncanbq'=>1,
'dtncachetime'=>43200,
'readdinfotime'=>0,
'qeditinfotime'=>0,
'onclicktype'=>0,
'onclickfilesize'=>10,
'onclickfiletime'=>60,
'schalltime'=>0,
'defprinttempid'=>1,
'opentags'=>1,
'tagstempid'=>1,
'usetags'=>',1,2,3,4,5,6,7,8,',
'chtags'=>'',
'tagslistnum'=>25,
'closeqdt'=>0,
'settop'=>0,
'qlistinfomod'=>0,
'gb_num'=>20,
'member_num'=>20,
'space_num'=>25,
'infolday'=>0,
'filelday'=>0,
'dorepkey'=>0,
'dorepword'=>0,
'onclickrnd'=>'',
'indexpagedt'=>0,
'keybgcolor'=>'',
'keyfontcolor'=>'',
'keydistcolor'=>'',
'indexpageid'=>0,
'closeqdtmsg'=>'',
'openfileserver'=>0,
'fs_purl'=>'',
'closemods'=>'',
'fieldandtop'=>0,
'fieldandclosetb'=>'',
'filedatatbs'=>',1,',
'filedeftb'=>1,
'pldeftb'=>1,
'plurl'=>'<!--ecms.plurl-->',
'plkey_ok'=>1,
'plface'=>'||[~e.jy~]##1.gif||[~e.kq~]##2.gif||[~e.se~]##3.gif||[~e.sq~]##4.gif||[~e.lh~]##5.gif||[~e.ka~]##6.gif||[~e.hh~]##7.gif||[~e.ys~]##8.gif||[~e.ng~]##9.gif||[~e.ot~]##10.gif||',
'plf'=>'',
'pldatatbs'=>',1,',
'defpltempid'=>1,
'pl_num'=>12,
'plgroupid'=>0,
'closelisttemp'=>'',
'chclasscolor'=>'#99C4E3',
'timeclose'=>'',
'timeclosedo'=>'',
'ipaddinfonum'=>0,
'ipaddinfotime'=>0,
'rewriteinfo'=>'',
'rewriteclass'=>'',
'rewriteinfotype'=>'',
'rewritetags'=>'',
'rewritepl'=>'',
'memberconnectnum'=>0,
'closehmenu'=>'',
'indexaddpage'=>0,
'modmemberedittran'=>0,
'modinfoedittran'=>0,
'deftempid'=>0);
//------------e_public

//moreports
$emoreport_r=array();
//moreports


//-------EmpireCMS.Public.Cache-------

$emod_pubr=Array('linkfields'=>'|');

$etable_r=array();
$etable_r['news']=Array('deftb'=>'1',
'yhid'=>0,
'intb'=>0,
'mid'=>1);
$etable_r['download']=Array('deftb'=>'1',
'yhid'=>0,
'intb'=>0,
'mid'=>2);
$etable_r['photo']=Array('deftb'=>'1',
'yhid'=>0,
'intb'=>0,
'mid'=>3);
$etable_r['flash']=Array('deftb'=>'1',
'yhid'=>0,
'intb'=>0,
'mid'=>4);
$etable_r['movie']=Array('deftb'=>'1',
'yhid'=>0,
'intb'=>0,
'mid'=>5);
$etable_r['shop']=Array('deftb'=>'1',
'yhid'=>0,
'intb'=>0,
'mid'=>6);
$etable_r['article']=Array('deftb'=>'1',
'yhid'=>0,
'intb'=>0,
'mid'=>7);
$etable_r['info']=Array('deftb'=>'1',
'yhid'=>0,
'intb'=>0,
'mid'=>8);


$emod_r=array();
$emod_r[1]=Array('mid'=>1,
'mname'=>'�s�D�t�μҫ�',
'qmname'=>'�s�D',
'defaulttb'=>1,
'datatbs'=>',1,',
'deftb'=>'1',
'enter'=>',title,ftitle,special.field,newstime,titlepic,smalltext,writer,befrom,newstext,',
'qenter'=>',title,ftitle,special.field,titlepic,smalltext,writer,befrom,newstext,',
'listtempf'=>',title,ftitle,newstime,titlepic,smalltext,diggtop,',
'tempf'=>',title,ftitle,newstime,titlepic,smalltext,writer,befrom,newstext,diggtop,',
'mustqenterf'=>',title,newstext,',
'listandf'=>'',
'setandf'=>0,
'searchvar'=>',title,smalltext,',
'cj'=>',title,ftitle,newstime,titlepic,smalltext,writer,befrom,newstext,',
'canaddf'=>',title,ftitle,newstime,titlepic,smalltext,writer,befrom,newstext,',
'caneditf'=>',title,ftitle,newstime,titlepic,smalltext,writer,befrom,newstext,',
'tbmainf'=>',title,titlepic,newstime,ftitle,smalltext,diggtop,',
'tbdataf'=>',writer,befrom,newstext,',
'tobrf'=>',smalltext,newstext,',
'dohtmlf'=>',ftitle,smalltext,writer,befrom,newstext,diggtop,',
'checkboxf'=>',',
'savetxtf'=>'',
'editorf'=>',newstext,',
'ubbeditorf'=>',',
'pagef'=>'newstext',
'smalltextf'=>',smalltext,',
'filef'=>',',
'imgf'=>',titlepic,',
'flashf'=>',',
'linkfields'=>'|',
'morevaluef'=>'|',
'onlyf'=>',',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>'',
'sonclass'=>'|34|35|36|37|',
'tid'=>1,
'tbname'=>'news');
$emod_r[2]=Array('mid'=>2,
'mname'=>'�U���t�μҫ�',
'qmname'=>'�n��',
'defaulttb'=>0,
'datatbs'=>',1,',
'deftb'=>'1',
'enter'=>',title,special.field,newstime,titlepic,softwriter,homepage,demo,softfj,language,softtype,softsq,star,filetype,filesize,downpath,softsay,',
'qenter'=>',title,special.field,titlepic,softwriter,homepage,demo,softfj,language,softtype,softsq,filetype,filesize,downpath,softsay,',
'listtempf'=>',title,newstime,titlepic,softfj,language,softtype,softsq,star,filetype,filesize,softsay,',
'tempf'=>',title,newstime,titlepic,softwriter,homepage,demo,softfj,language,softtype,softsq,star,filetype,filesize,downpath,softsay,',
'mustqenterf'=>',title,downpath,softsay,',
'listandf'=>'',
'setandf'=>0,
'searchvar'=>',title,softsay,',
'cj'=>',title,newstime,titlepic,softwriter,homepage,demo,softfj,language,softtype,softsq,star,filetype,filesize,downpath,softsay,',
'canaddf'=>',title,newstime,titlepic,softwriter,homepage,demo,softfj,language,softtype,softsq,star,filetype,filesize,downpath,softsay,',
'caneditf'=>',title,newstime,titlepic,softwriter,homepage,demo,softfj,language,softtype,softsq,star,filetype,filesize,downpath,softsay,',
'tbmainf'=>',title,titlepic,newstime,softfj,language,softtype,softsq,star,filetype,filesize,softsay,',
'tbdataf'=>',softwriter,homepage,demo,downpath,',
'tobrf'=>',softsay,',
'dohtmlf'=>',softwriter,homepage,demo,softfj,language,softtype,softsq,star,filetype,filesize,downpath,softsay,',
'checkboxf'=>',',
'savetxtf'=>'',
'editorf'=>',',
'ubbeditorf'=>',',
'pagef'=>'',
'smalltextf'=>',softsay,',
'filef'=>',',
'imgf'=>',titlepic,',
'flashf'=>',',
'linkfields'=>'|',
'morevaluef'=>'|',
'onlyf'=>',',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>'',
'sonclass'=>'|38|39|40|41|',
'tid'=>2,
'tbname'=>'download');
$emod_r[3]=Array('mid'=>3,
'mname'=>'�Ϥ��t�μҫ�',
'qmname'=>'�Ϥ�',
'defaulttb'=>0,
'datatbs'=>',1,',
'deftb'=>'1',
'enter'=>',title,special.field,newstime,filesize,picsize,picfbl,picfrom,titlepic,picurl,morepic,num,width,height,picsay,',
'qenter'=>',title,special.field,filesize,picsize,picfbl,picfrom,titlepic,picurl,picsay,',
'listtempf'=>',title,newstime,titlepic,picurl,picsay,',
'tempf'=>',title,newstime,filesize,picsize,picfbl,picfrom,titlepic,picurl,morepic,num,width,height,picsay,',
'mustqenterf'=>',title,picsay,',
'listandf'=>'',
'setandf'=>0,
'searchvar'=>',title,picsay,',
'cj'=>',title,newstime,filesize,picsize,picfbl,picfrom,titlepic,picurl,morepic,num,width,height,picsay,',
'canaddf'=>',title,newstime,filesize,picsize,picfbl,picfrom,titlepic,picurl,morepic,num,width,height,picsay,',
'caneditf'=>',title,newstime,filesize,picsize,picfbl,picfrom,titlepic,picurl,morepic,num,width,height,picsay,',
'tbmainf'=>',title,titlepic,newstime,picurl,picsay,',
'tbdataf'=>',filesize,picsize,picfbl,picfrom,morepic,num,width,height,',
'tobrf'=>',picsay,',
'dohtmlf'=>',filesize,picsize,picfbl,picfrom,picurl,morepic,num,width,height,picsay,',
'checkboxf'=>',',
'savetxtf'=>'',
'editorf'=>',',
'ubbeditorf'=>',',
'pagef'=>'',
'smalltextf'=>',picsay,',
'filef'=>',',
'imgf'=>',titlepic,picurl,',
'flashf'=>',',
'linkfields'=>'|',
'morevaluef'=>'|',
'onlyf'=>',',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>'',
'sonclass'=>'|52|53|54|',
'tid'=>3,
'tbname'=>'photo');
$emod_r[4]=Array('mid'=>4,
'mname'=>'FLASH�t�μҫ�',
'qmname'=>'FLASH',
'defaulttb'=>0,
'datatbs'=>',1,',
'deftb'=>'1',
'enter'=>',title,special.field,newstime,titlepic,flashwriter,email,star,filesize,flashurl,width,height,flashsay,',
'qenter'=>',title,special.field,titlepic,flashwriter,email,filesize,flashurl,width,height,flashsay,',
'listtempf'=>',title,newstime,titlepic,flashwriter,star,filesize,flashurl,flashsay,',
'tempf'=>',title,newstime,titlepic,flashwriter,email,star,filesize,flashurl,width,height,flashsay,',
'mustqenterf'=>',title,flashurl,flashsay,',
'listandf'=>'',
'setandf'=>0,
'searchvar'=>',title,flashwriter,flashsay,',
'cj'=>',title,newstime,titlepic,flashwriter,email,star,filesize,flashurl,width,height,flashsay,',
'canaddf'=>',title,newstime,titlepic,flashwriter,email,star,filesize,flashurl,width,height,flashsay,',
'caneditf'=>',title,newstime,titlepic,flashwriter,email,star,filesize,flashurl,width,height,flashsay,',
'tbmainf'=>',title,titlepic,newstime,flashwriter,email,star,filesize,flashurl,width,height,flashsay,',
'tbdataf'=>',',
'tobrf'=>',flashsay,',
'dohtmlf'=>',flashwriter,email,star,filesize,flashurl,width,height,flashsay,',
'checkboxf'=>',',
'savetxtf'=>'',
'editorf'=>',',
'ubbeditorf'=>',',
'pagef'=>'',
'smalltextf'=>',flashsay,',
'filef'=>',',
'imgf'=>',titlepic,',
'flashf'=>',flashurl,',
'linkfields'=>'|',
'morevaluef'=>'|',
'onlyf'=>',',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>'',
'sonclass'=>'|50|51|',
'tid'=>4,
'tbname'=>'flash');
$emod_r[5]=Array('mid'=>5,
'mname'=>'�q�v�t�μҫ�',
'qmname'=>'�q�v',
'defaulttb'=>0,
'datatbs'=>',1,',
'deftb'=>'1',
'enter'=>',title,special.field,newstime,titlepic,movietype,company,movietime,player,playadmin,filetype,filesize,star,playdk,playtime,moviefen,downpath,playerid,onlinepath,moviesay,',
'qenter'=>',',
'listtempf'=>',title,newstime,titlepic,movietype,company,movietime,player,playadmin,filetype,filesize,star,moviefen,moviesay,',
'tempf'=>',title,newstime,titlepic,movietype,company,movietime,player,playadmin,filetype,filesize,star,playdk,playtime,moviefen,downpath,playerid,onlinepath,moviesay,',
'mustqenterf'=>',title,moviesay,',
'listandf'=>'',
'setandf'=>0,
'searchvar'=>',title,movietype,company,player,playadmin,moviesay,',
'cj'=>',title,newstime,titlepic,movietype,company,movietime,player,playadmin,filetype,filesize,star,playdk,playtime,moviefen,downpath,playerid,onlinepath,moviesay,',
'canaddf'=>',title,newstime,titlepic,movietype,company,movietime,player,playadmin,filetype,filesize,star,playdk,playtime,moviefen,downpath,playerid,onlinepath,moviesay,',
'caneditf'=>',title,newstime,titlepic,movietype,company,movietime,player,playadmin,filetype,filesize,star,playdk,playtime,moviefen,downpath,playerid,onlinepath,moviesay,',
'tbmainf'=>',title,titlepic,newstime,movietype,company,movietime,player,playadmin,filetype,filesize,star,moviefen,moviesay,',
'tbdataf'=>',playdk,playtime,downpath,playerid,onlinepath,',
'tobrf'=>',moviesay,',
'dohtmlf'=>',movietype,company,movietime,player,playadmin,filetype,filesize,star,playdk,playtime,moviefen,downpath,playerid,onlinepath,moviesay,',
'checkboxf'=>',',
'savetxtf'=>'',
'editorf'=>',',
'ubbeditorf'=>',',
'pagef'=>'',
'smalltextf'=>',moviesay,',
'filef'=>',',
'imgf'=>',titlepic,',
'flashf'=>',',
'linkfields'=>'|',
'morevaluef'=>'|',
'onlyf'=>',',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>'',
'sonclass'=>'|42|43|44|45|',
'tid'=>5,
'tbname'=>'movie');
$emod_r[6]=Array('mid'=>6,
'mname'=>'�ӫ��t�μҫ�',
'qmname'=>'�ӫ~',
'defaulttb'=>0,
'datatbs'=>',1,',
'deftb'=>'1',
'enter'=>',title,special.field,newstime,productno,pbrand,intro,unit,weight,tprice,price,buyfen,pmaxnum,titlepic,productpic,newstext,',
'qenter'=>',',
'listtempf'=>',title,newstime,productno,pbrand,intro,unit,weight,tprice,price,buyfen,pmaxnum,titlepic,productpic,newstext,psalenum,',
'tempf'=>',title,newstime,productno,pbrand,intro,unit,weight,tprice,price,buyfen,pmaxnum,titlepic,productpic,newstext,psalenum,',
'mustqenterf'=>',title,newstext,',
'listandf'=>'',
'setandf'=>0,
'searchvar'=>',title,productno,pbrand,intro,price,newstext,',
'cj'=>',title,newstime,productno,pbrand,intro,unit,weight,tprice,price,buyfen,pmaxnum,titlepic,productpic,newstext,',
'canaddf'=>',title,newstime,productno,pbrand,intro,unit,weight,tprice,price,buyfen,pmaxnum,titlepic,productpic,newstext,',
'caneditf'=>',title,newstime,productno,pbrand,intro,unit,weight,tprice,price,buyfen,pmaxnum,titlepic,productpic,newstext,',
'tbmainf'=>',title,titlepic,newstime,productno,pbrand,intro,unit,weight,tprice,price,buyfen,pmaxnum,productpic,newstext,psalenum,',
'tbdataf'=>',',
'tobrf'=>',intro,newstext,',
'dohtmlf'=>',productno,pbrand,intro,unit,weight,tprice,price,buyfen,pmaxnum,productpic,newstext,psalenum,',
'checkboxf'=>',',
'savetxtf'=>'',
'editorf'=>',newstext,',
'ubbeditorf'=>',',
'pagef'=>'newstext',
'smalltextf'=>',',
'filef'=>',',
'imgf'=>',titlepic,productpic,',
'flashf'=>',',
'linkfields'=>'|',
'morevaluef'=>'|',
'onlyf'=>',',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>'',
'sonclass'=>'|46|47|48|49|',
'tid'=>6,
'tbname'=>'shop');
$emod_r[7]=Array('mid'=>7,
'mname'=>'�峹�t�μҫ�',
'qmname'=>'�峹',
'defaulttb'=>0,
'datatbs'=>',1,',
'deftb'=>'1',
'enter'=>',title,ftitle,special.field,newstime,titlepic,smalltext,writer,befrom,newstext,',
'qenter'=>',title,ftitle,special.field,titlepic,smalltext,writer,befrom,newstext,',
'listtempf'=>',title,ftitle,newstime,titlepic,smalltext,diggtop,',
'tempf'=>',title,ftitle,newstime,titlepic,smalltext,writer,befrom,newstext,diggtop,',
'mustqenterf'=>',title,newstext,',
'listandf'=>'',
'setandf'=>0,
'searchvar'=>',title,smalltext,',
'cj'=>',title,ftitle,newstime,titlepic,smalltext,writer,befrom,newstext,',
'canaddf'=>',title,ftitle,newstime,titlepic,smalltext,writer,befrom,newstext,',
'caneditf'=>',title,ftitle,newstime,titlepic,smalltext,writer,befrom,newstext,',
'tbmainf'=>',title,titlepic,newstime,ftitle,smalltext,writer,befrom,newstext,diggtop,',
'tbdataf'=>',',
'tobrf'=>',smalltext,newstext,',
'dohtmlf'=>',ftitle,smalltext,writer,befrom,newstext,diggtop,',
'checkboxf'=>',',
'savetxtf'=>'newstext',
'editorf'=>',newstext,',
'ubbeditorf'=>',',
'pagef'=>'newstext',
'smalltextf'=>',smalltext,',
'filef'=>',',
'imgf'=>',titlepic,',
'flashf'=>',',
'linkfields'=>'|',
'morevaluef'=>'|',
'onlyf'=>',',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>'',
'sonclass'=>'|55|56|57|',
'tid'=>7,
'tbname'=>'article');
$emod_r[8]=Array('mid'=>8,
'mname'=>'�����H���t�μҫ�',
'qmname'=>'�����H��',
'defaulttb'=>0,
'datatbs'=>',1,',
'deftb'=>'1',
'enter'=>',title,special.field,newstime,smalltext,titlepic,myarea,email,mycontact,address,',
'qenter'=>',title,smalltext,titlepic,myarea,email,mycontact,address,',
'listtempf'=>',title,newstime,smalltext,titlepic,myarea,',
'tempf'=>',title,newstime,smalltext,titlepic,myarea,email,mycontact,address,',
'mustqenterf'=>',title,smalltext,myarea,email,',
'listandf'=>',myarea,',
'setandf'=>0,
'searchvar'=>',title,smalltext,myarea,',
'cj'=>',title,newstime,smalltext,titlepic,myarea,email,mycontact,address,',
'canaddf'=>',title,newstime,smalltext,titlepic,myarea,email,mycontact,address,',
'caneditf'=>',title,newstime,smalltext,titlepic,myarea,email,mycontact,address,',
'tbmainf'=>',title,titlepic,newstime,smalltext,myarea,',
'tbdataf'=>',email,mycontact,address,',
'tobrf'=>',smalltext,',
'dohtmlf'=>',smalltext,myarea,email,mycontact,address,',
'checkboxf'=>',',
'savetxtf'=>'',
'editorf'=>',',
'ubbeditorf'=>',',
'pagef'=>'',
'smalltextf'=>',smalltext,',
'filef'=>',',
'imgf'=>',titlepic,',
'flashf'=>',',
'linkfields'=>'|',
'morevaluef'=>'|',
'onlyf'=>',',
'adddofunf'=>'||',
'editdofunf'=>'||',
'qadddofunf'=>'||',
'qeditdofunf'=>'||',
'definfovoteid'=>0,
'orderf'=>'',
'sonclass'=>'|11|12|13|14|15|16|18|19|20|21|23|24|25|26|28|29|30|31|',
'tid'=>8,
'tbname'=>'info');


//-------EmpireCMS.Public.Cache-------

?>