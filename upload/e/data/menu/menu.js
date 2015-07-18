// JavaScript Document
function chengstate(menuid,save)
{											//切換節點的開放/關閉
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
		setupcookie(menuid);			//保存狀態
	}//end if
}//end funciton chengstaut

function setupcookie(menuid)
{										//存入cookie  保存節點狀態
	var menu	= new Array();
	var menustr	= new String();
	menuOpen	= false;
	if(checkCookieExist("menu"))
	{									//判斷是否是是否已經保存過cookie
		menustr		= getCookie("menu");
		//alert(menustr);
		if(menustr.length>0)
		{								//判斷menu是否為空，，，否則分解為數組
			menu	= menustr.split(",");
			for(i=0;i<menu.length;i++)
			{
				if(menu[i]==menuid)
				{						//如果是打開狀態，，，刪除記錄
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
	if(menustr.substr(menustr.length-1,1)==',')menustr = menustr.substr(0,menustr.length-1);		//去掉最後的 ","
	if(menustr.substr(0,1)==',')menustr = menustr.substr(1,menustr.length-1);		//去掉開始的 ","
	saveCookie("menu",menustr,1000);
	//alert(menustr);
	//deleteCookie("menu");
}//end function setupcookie

function initialize()
{											//取得cookie  設置節點的縮放,,初始化菜單狀態
	var menu	= new Array();
	var menustr	= new String();
	
	if(checkCookieExist("menu"))
	{									//判斷是否是是否已經保存過cookie
		menustr		= getCookie("menu");
		if(menustr.length>0)
		{								//判斷長度是否合法
			menu	= menustr.split(",");
			for(i=0;i<menu.length;i++)
			{
				if(objExists(menu[i]))			
				{						//驗證對象是否存在
					chengstate(menu[i],false);
				}//end if
			}//end for
			objExists(99);
		}//end if
	}//end if
}//end funciton setupstate

function objExists(objid)
{											//驗證對象是否存在
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
//--------------------------------------------------↓↓↓↓↓↓↓↓↓↓↓↓  執行Cookie 操作
function saveCookie(name, value, expires, path, domain, secure)
{											// 保存Cookie
  var strCookie = name + "=" + value;
  if (expires)
  {											// 計算Cookie的期限, 參數為天數
     var curTime = new Date();
     curTime.setTime(curTime.getTime() + expires*24*60*60*1000);
     strCookie += "; expires=" + curTime.toGMTString();
  }//end if
  // Cookie的路徑
  strCookie +=  (path) ? "; path=" + path : ""; 
  // Cookie的Domain
  strCookie +=  (domain) ? "; domain=" + domain : "";
  // 是否需要保密傳送,為一個布爾值
  strCookie +=  (secure) ? "; secure" : "";
  document.cookie = strCookie;
}//end funciton saveCookie

function getCookie(name)
{											// 使用名稱參數取得Cookie值, null表示Cookie不存在
  var strCookies = document.cookie;
  var cookieName = name + "=";  // Cookie名稱
  var valueBegin, valueEnd, value;
  // 尋找是否有此Cookie名稱
  valueBegin = strCookies.indexOf(cookieName);
  if (valueBegin == -1) return null;  // 沒有此Cookie
  // 取得值的結尾位置
  valueEnd = strCookies.indexOf(";", valueBegin);
  if (valueEnd == -1)
      valueEnd = strCookies.length;  // 最後一個Cookie
  // 取得Cookie值
  value = strCookies.substring(valueBegin+cookieName.length,valueEnd);
  return value;
}//end function getCookie

function checkCookieExist(name)
{											// 檢查Cookie是否存在
  if (getCookie(name))
      return true;
  else
      return false;
}//end function checkCookieExist

function deleteCookie(name, path, domain)
{											// 刪除Cookie
  var strCookie;
  // 檢查Cookie是否存在
  if (checkCookieExist(name))
  {										    // 設置Cookie的期限為己過期
    strCookie = name + "="; 
    strCookie += (path) ? "; path=" + path : "";
    strCookie += (domain) ? "; domain=" + domain : "";
    strCookie += "; expires=Thu, 01-Jan-70 00:00:01 GMT";
    document.cookie = strCookie;
  }//end if
}//end function deleteCookie