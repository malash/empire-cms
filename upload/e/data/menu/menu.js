// JavaScript Document
function chengstate(menuid,save)
{											//�����`�I���}��/����
	menuobj	= eval("item"+menuid);
	obj		= eval("pr"+menuid);
	
	if(menuobj.style.display == '')
	{
		menuobj.style.display	= 'none';
	}else{
		menuobj.style.display	= '';
	}//end if
	switch (obj.className)
	{
		case "menu1":
			obj.className	= "menu2";
			break;
		case "menu2":
			obj.className	= "menu1";
			break;
		case "menu3":
			obj.className	= "menu4";
			break;
		case "menu4":
			obj.className	= "menu3";
			break;
	}//end switch
	if(save!=false)
	{
		setupcookie(menuid);			//�O�s���A
	}//end if
}//end funciton chengstaut

function setupcookie(menuid)
{										//�s�Jcookie  �O�s�`�I���A
	var menu	= new Array();
	var menustr	= new String();
	menuOpen	= false;
	if(checkCookieExist("menu"))
	{									//�P�_�O�_�O�O�_�w�g�O�s�Lcookie
		menustr		= getCookie("menu");
		//alert(menustr);
		if(menustr.length>0)
		{								//�P�_menu�O�_���šA�A�A�_�h���Ѭ��Ʋ�
			menu	= menustr.split(",");
			for(i=0;i<menu.length;i++)
			{
				if(menu[i]==menuid)
				{						//�p�G�O���}���A�A�A�A�R���O��
					menu[i]='';
					menuOpen	= true;
				}//end if
			}//end for
			if(menuOpen==false)menu[i] = menuid;
		}else{
			menu[0]	= menuid;
		}//end if
	}else{
		menu[0]	= menuid;
	}//end if
	menustr	= menu.join(",");
	menustr	= menustr.replace(",,",",");
	if(menustr.substr(menustr.length-1,1)==',')menustr = menustr.substr(0,menustr.length-1);		//�h���̫᪺ ","
	if(menustr.substr(0,1)==',')menustr = menustr.substr(1,menustr.length-1);		//�h���}�l�� ","
	saveCookie("menu",menustr,1000);
	//alert(menustr);
	//deleteCookie("menu");
}//end function setupcookie

function initialize()
{											//���ocookie  �]�m�`�I���Y��,,��l�Ƶ�檬�A
	var menu	= new Array();
	var menustr	= new String();
	
	if(checkCookieExist("menu"))
	{									//�P�_�O�_�O�O�_�w�g�O�s�Lcookie
		menustr		= getCookie("menu");
		if(menustr.length>0)
		{								//�P�_���׬O�_�X�k
			menu	= menustr.split(",");
			for(i=0;i<menu.length;i++)
			{
				if(objExists(menu[i]))			
				{						//���ҹ�H�O�_�s�b
					chengstate(menu[i],false);
				}//end if
			}//end for
			objExists(99);
		}//end if
	}//end if
}//end funciton setupstate

function objExists(objid)
{											//���ҹ�H�O�_�s�b
	try
	{
		obj = eval("item"+objid);
	}//end try
	catch(obj)
	{
		return false;
	}//end catch
	
	if(typeof(obj)=="object")
	{
		return true;
	}//end if
	return false;
}//end function objExists
//--------------------------------------------------������������������������  ����Cookie �ާ@
function saveCookie(name, value, expires, path, domain, secure)
{											// �O�sCookie
  var strCookie = name + "=" + value;
  if (expires)
  {											// �p��Cookie������, �ѼƬ��Ѽ�
     var curTime = new Date();
     curTime.setTime(curTime.getTime() + expires*24*60*60*1000);
     strCookie += "; expires=" + curTime.toGMTString();
  }//end if
  // Cookie�����|
  strCookie +=  (path) ? "; path=" + path : ""; 
  // Cookie��Domain
  strCookie +=  (domain) ? "; domain=" + domain : "";
  // �O�_�ݭn�O�K�ǰe,���@�ӥ�����
  strCookie +=  (secure) ? "; secure" : "";
  document.cookie = strCookie;
}//end funciton saveCookie

function getCookie(name)
{											// �ϥΦW�ٰѼƨ��oCookie��, null���Cookie���s�b
  var strCookies = document.cookie;
  var cookieName = name + "=";  // Cookie�W��
  var valueBegin, valueEnd, value;
  // �M��O�_����Cookie�W��
  valueBegin = strCookies.indexOf(cookieName);
  if (valueBegin == -1) return null;  // �S����Cookie
  // ���o�Ȫ�������m
  valueEnd = strCookies.indexOf(";", valueBegin);
  if (valueEnd == -1)
      valueEnd = strCookies.length;  // �̫�@��Cookie
  // ���oCookie��
  value = strCookies.substring(valueBegin+cookieName.length,valueEnd);
  return value;
}//end function getCookie

function checkCookieExist(name)
{											// �ˬdCookie�O�_�s�b
  if (getCookie(name))
      return true;
  else
      return false;
}//end function checkCookieExist

function deleteCookie(name, path, domain)
{											// �R��Cookie
  var strCookie;
  // �ˬdCookie�O�_�s�b
  if (checkCookieExist(name))
  {										    // �]�mCookie���������v�L��
    strCookie = name + "="; 
    strCookie += (path) ? "; path=" + path : "";
    strCookie += (domain) ? "; domain=" + domain : "";
    strCookie += "; expires=Thu, 01-Jan-70 00:00:01 GMT";
    document.cookie = strCookie;
  }//end if
}//end function deleteCookie