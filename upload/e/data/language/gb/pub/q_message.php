<?php
//--------  帝國網站管理系統〞信息提示〞語言包（前台）

$qmessage_r=array(
	'CreatePathFail'=>'無法建立目錄，請檢查目錄權限。',
	'DbError'=>'數據庫出錯',
	'ErrorUrl'=>'您來自的鏈接不存在',
	'NotNextInfo'=>'下面沒有記錄了',
	'NotCanPostUrl'=>'請從網站提交數據',
	'NotCanPostIp'=>'您的IP不在允許提交數據的範圍內，所以無法提交',

	'CloseAddNews'=>'此模塊已被管理員關閉,有問題請聯繫管理員',
	'MustLast'=>'您選擇的欄目不是終極欄目(藍色條)',
	'EmptyTitle'=>'請輸入標題和內容,並選擇欄目',
	'AddNewsSuccess'=>'感謝您的投稿,我們將第一時間審核您的信息',
	'CloseAddNewsTranpic'=>'系統關閉了圖片上傳',
	'EmptyQMustF'=>'請將信息填寫完整',
	'HaveNotLevelQInfo'=>'您沒有權限管理此信息',
	'ClassSetNotAdminQCInfo'=>'此欄目設置已審核過的信息不能管理',
	'ClassSetNotEditQCInfo'=>'此欄目設置只可編輯未審核信息',
	'ClassSetNotDelQCInfo'=>'此欄目設置只可刪除未審核信息',
	'ClassSetNotAdminQInfo'=>'此欄目設置投稿的信息不能管理',
	'ClassSetNotEditQInfo'=>'此欄目設置投稿的信息只能編輯',
	'ClassSetNotDelQInfo'=>'此欄目設置投稿的信息只能刪除',
	'EmptyQinfoCid'=>'請選擇提交欄目',
	'NotOpenCQInfo'=>'此欄目未開放投稿',
	'HaveNotLevelAQinfo'=>'您所屬的會員組不能提交信息',
	'HaveNotFenAQinfo'=>'您的點數不足,不能提交信息',
	'AddQinfoSuccess'=>'提交信息完畢',
	'EditQinfoSuccess'=>'修改信息完畢',
	'DelQinfoSuccess'=>'刪除信息完畢',
	'EmptyQTranFile'=>'請選擇要上傳的文件',
	'NotQTranFiletype'=>'您上傳的文件擴展名有誤',
	'CloseQTranPic'=>'系統關閉圖片上傳',
	'TooBigQTranFile'=>'您上傳的文件大小超過系統限制',
	'CloseQTranFile'=>'系統關閉了附件上傳',
	'CloseQAdd'=>'系統關閉投稿模塊',
	'HaveCloseWords'=>'您提交的信息含有非法字符',
	'ReIsOnlyF'=>'字段 '.$GLOBALS['msgisonlyf'].' 的值已存在，請不要重複提交',
	'NewMemberAddInfoError'=>'系統限制新註冊會員 '.$public_r['newaddinfotime'].' 分鐘後才能投稿',
	'CrossDayInfo'=>'您今天的投稿次數已超過系統限制',
	'TranFail'=>'請查看目錄權限是否為0777,文件無法上傳',
	'QAddInfoOutTime'=>'系統限制的投稿間隔是 '.$public_r[readdinfotime].' 秒,請稍後再提交',
	'QEditInfoOutTime'=>'信息發佈超過 '.$public_r[qeditinfotime].' 分鐘不能修改',
	'IpMaxAddInfo'=>'您的投稿過於頻繁，請稍後再提交',

	'NotVote'=>'此投票不存在!',
	'VoteOutDate'=>'此投票已過期.不能投票!',
	'ReVote'=>'此IP已投票過,請勿重複投票!',
	'EmptyChangeVote'=>'請至少選擇一個投票項',
	'NotChangeVote'=>'您還沒有選擇投票項',
	'VoteSuccess'=>'感謝您的投票',
	'EmptyPl'=>'請輸入評論內容',
	'EmptyPlMustF'=>'字段 '.$GLOBALS['msgmustf'].' 的值為空，請將必填項填寫完整',
	'PlOutTime'=>'系統限制的發表評論間隔是 '.$GLOBALS['setpltime'].' 秒,請稍後再發',
	'VoteOutTime'=>'系統限制的發表投票間隔是 '.$public_r[revotetime].' 秒,請稍後再投',
	'GbOutTime'=>'系統限制的發表留言間隔是 '.$public_r[regbooktime].' 秒,請稍後再發',
	'HavePlCloseWords'=>'評論內容含有非法字符',
	'NotLevelToPl'=>'您所在的會員組不能發表評論',
	'PlOutMaxFloor'=>'引用樓層數已超過限制',
	'GuestNotToPl'=>'遊客不能發表評論',
	'CloseClassPl'=>'此欄目已關閉評論',
	'CloseInfoPl'=>'此信息已關閉評論',
	'AddPlSuccess'=>'提交完畢',
	'PlSizeTobig'=>'您的評論內容過長，系統不接受（系統限制 '.$GLOBALS['setplsize'].' 字節）',
	'EmptyGbookname'=>'請輸入留言姓名,郵箱與留言內容',
	'AddGbookSuccess'=>'提交完畢',
	'EmptyFeedbackname'=>'帶*項為必填',
	'AddFeedbackSuccess'=>'提交完畢',
	'AddErrorSuccess'=>'感謝您的報告，我們會盡快處理此事',
	'EmptyErrortext'=>'請輸入錯誤報告內容',
	'EmptyGbook'=>'此留言板不存在',
	'EmptyFeedback'=>'此信息反饋不存在',
	'DoForPlGSuccess'=>'謝謝您的支持',
	'DoForPlBSuccess'=>'謝謝您的意見',
	'ReDoForPl'=>'您已提交過',
	'AddInfoPfen'=>'感謝您的評價',
	'DoDiggGSuccess'=>'謝謝您的支持',
	'DoDiggBSuccess'=>'謝謝您的意見',
	'ReDigg'=>'您已提交過',
	'NotOpenFBFile'=>'系統未開啟附件上傳',
	'NotLevelToClass'=>'您所在的會員組沒有權限訪問此欄目',
	'ThisTimeCloseDo'=>'本時間段內不允許使用此操作',
	'NotOpenMemberConnect'=>'網站沒有開啟外部登錄',

	'CloseRegister'=>'管理員已關閉註冊',
	'EmptyMember'=>'用戶名，密碼與郵箱不能為空',
	'FaiUserlen'=>'用戶名長度有誤',
	'FailPasslen'=>'密碼位數不夠或過長',
	'NotRepassword'=>'二次密碼不一致',
	'EmailFail'=>'您輸入的郵箱有誤!',
	'ReEmailFail'=>'此郵箱已被註冊',
	'RegisterReIpError'=>'同一IP不能重複註冊',
	'RegHaveCloseword'=>'用戶名包含禁用字符',
	'NotSpeWord'=>'用戶名不能包含特殊字符',
	'ReUsername'=>'此用戶名已被註冊，請重填！',
	'LoginToRegister'=>'您已登入，不能註冊帳號',
	'RegisterSuccess'=>'註冊完畢',
	'RegisterSuccessCheck'=>'註冊完畢，請等待管理員的審核',
	'NotEmpty'=>'帶*項的為必填',
	'FailOldPassword'=>'原密碼錯誤，無法修改',
	'EditInfoSuccess'=>'修改信息完畢！',
	'NotLogin'=>'您還沒登入!',
	'NotSingleLogin'=>'同一帳號同一時刻只能一人在線!',
	'NotCheckedUser'=>'您的帳號還未通過審核',
	'ExitSuccess'=>'退出系統完畢！',
	'EmptyLogin'=>'用戶名和密碼不能為空',
	'FailPassword'=>'您的用戶名或密碼有誤!',
	'LoginSuccess'=>'已完成登入',
	'NotCookie'=>'無法登入，請確認您的cookie是否已開啟!',
	'MoreFava'=>'您的收藏夾已滿，無法增加收藏',
	'AddFavaSuccess'=>'增加收藏夾完畢',
	'ReFava'=>'此收藏鏈接已存在',
	'NotDelFavaid'=>'請選擇要刪除的收藏夾',
	'DelFavaSuccess'=>'刪除收藏夾完畢',
	'EmptyFavaClassname'=>'請輸入分類名稱',
	'AddFavaClassSuccess'=>'增加分類完畢',
	'EditFavaClassSuccess'=>'修改分類完畢',
	'EmptyFavaClassid'=>'請選擇要刪除的分類',
	'DelFavaClassSuccess'=>'刪除分類完畢',
	'NotChangeMoveCid'=>'請選擇要轉移的分類',
	'NotMoveFavaid'=>'請至少選擇一個要轉移的收藏夾',
	'MoveFavaSuccess'=>'轉移收藏夾完畢',
	'EmptyGetCard'=>'請輸入充值的用戶名,卡號和密碼',
	'DifCardUsername'=>'兩次輸入的用戶名不一致!',
	'ExiestCardUsername'=>'您輸入的用戶名不存在！請查看你輸入的用戶名是否有誤。',
	'CardPassError'=>'您輸入的充值卡號或密碼有誤。無法充值！',
	'CardGetFenSuccess'=>'恭喜您！充值完畢',
	'CardGetFenError'=>'數據庫忙，請稍後再充值，謝謝!',
	'CardOutDate'=>'此點卡已過期,無法充值',
	'FailKey'=>'驗證碼不正確',
	'OutKeytime'=>'驗證碼已過期',
	'EmptyMsg'=>'請輸入標題、消息內容與發送目標',
	'MsgToself'=>'不能發給自己!',
	'MoreMsglen'=>'內容過長,不能發送',
	'MsgNotToUsername'=>'接收者帳號不存在!',
	'UserMoreMsgnum'=>'對方短消息已滿，不能發送!',
	'AddMsgSuccess'=>'短消息發送完畢!',
	'EmptyDelMsg'=>'請選擇要刪除的短消息',
	'DelMsgSuccess'=>'刪除短消息完畢',
	'HaveNotMsg'=>'此消息不存在',
	'HaveNotEnLevel'=>'權限不足',
	'NotUsername'=>'此帳號不存在',
	'NotLevelShowInfo'=>'您沒有足夠的權限查看會員信息',
	'NotLevelMemberList'=>'您沒有足夠的權限查看會員列表',
	'EmptyFriend'=>'請輸入用戶名',
	'NotFriendUsername'=>'此帳號不存在',
	'AddFriendSuccess'=>'添加好友完畢',
	'EditFriendSuccess'=>'修改好友完畢',
	'EmptyFriendId'=>'請選擇要刪除的好友',
	'DelFriendSuccess'=>'刪除好友完畢',
	'NotAddFriendSelf'=>'不能加自己為好友',
	'ReAddFriend'=>'此用戶已在你的好友列表裡',
	'NotChangeSpaceStyleId'=>'請選擇要設置的空間模板',
	'ChangeSpaceStyleSuccess'=>'設置空間模板完畢',
	'SetSpaceSuccess'=>'設置空間信息完畢',
	'CloseMemberSpace'=>'系統已關閉會員空間模塊',
	'EmptyMemberGbook'=>'請輸入暱稱與留言內容',
	'AddMemberGbookSuccess'=>'留言完畢',
	'NotDelMemberGbookid'=>'請選擇要刪除的留言',
	'DelMemberGbookSuccess'=>'刪除留言完畢',
	'EmptyReMemberGbook'=>'請輸入要回復的留言',
	'ReMemberGbookSuccess'=>'留言回復完畢',
	'EmptyMemberFeedback'=>'請輸入聯繫人、信息標題與信息內容',
	'AddMemberFeedbackSuccess'=>'信息提交完畢',
	'NotDelMemberFeedbackid'=>'請選擇要刪除的反饋',
	'DelMemberFeedbackSuccess'=>'刪除完畢',
	'EmptyGetPassword'=>'請輸入用戶名和郵箱',
	'ErrorGPUsername'=>'用戶名或郵箱不正確',
	'CloseGetPassword'=>'網站已關閉取回密碼模塊',
	'SendGetPasswordEmailSucess'=>'郵件已發送，請登錄郵箱認證並取回密碼',
	'GPOutTime'=>'鏈接已過期',
	'GPErrorPass'=>'參數不正確，驗證不通過',
	'GetPasswordSuccess'=>'取回密碼完畢',
	'ActUserSuccess'=>'帳號已激活完畢',
	'SendActUserEmailSucess'=>'激活帳號郵件已發送，請登錄郵箱激活帳號',
	'CloseRegAct'=>'網站沒有啟用郵件激活帳號方式',
	'EmptyRegAct'=>'請輸入用戶名、密碼和郵箱',
	'ErrorRegActUser'=>'用戶名、密碼或郵箱不正確',
	'HaveRegActUser'=>'此帳號已激活過',
	
	'SearchNotRecord'=>'沒有搜索到相關的內容',
	'SearchOutTime'=>'系統限制的搜索時間間隔為 '.$public_r[searchtime].' 秒,請稍後再搜索',
	'EmptyKeyboard'=>'請輸入搜索關鍵字',
	'MinKeyboard'=>'系統限制的搜索關鍵字只能在 '.$public_r[min_keyboard].'~'.$public_r[max_keyboard].' 個字符之間',
	'NotLevelToSearch'=>'您所在的會員組沒有權限使用搜索',

	'FailDownpass'=>'下載驗證碼不正確,請重新刷新下載頁面,然後在點擊下載.',
	'ExiestSoftid'=>'此下載不存在',
	'MustSingleUser'=>'同時只能一人在線,請重新登錄',
	'NotDownLevel'=>'您的會員級別不足，沒有下載此軟件的權限!',
	'NotEnoughFen'=>'您的點數不足，無法下載此軟件',
	'CrossDaydown'=>'您今天的下載與觀看次數已超過系統限制',
	'CloseGetDown'=>'沒有開啟直接下載',
	
	'NotChangeProduct'=>'此商品不存在',
	'MustEnterSelect'=>'帶*項為必填，請填寫完整',
	'EmptyBuycar'=>'您的購物車無任何商品',
	'NotPsid'=>'請選擇配送方式',
	'NotPayfsid'=>'請選擇付款方式',
	'NotProductForBuyfen'=>'您選擇的商品不支持積分購買',
	'NotEnoughFenBuy'=>'您的點數不足,不能通過點數購買商品',
	'NotLoginTobuy'=>'您未登入,不能使用此付費方式',
	'NotEnoughMoneyBuy'=>'您的帳號餘額不足,不能購買商品',
	'AddDdSuccess'=>'訂單提交完畢.',
	'AddDdSuccessa'=>'訂單提交完畢.',
	'AddDdAndToPaySuccess'=>'訂單提交完畢，正轉向在線支付...',
	'FenNotFp'=>'積分購買不開發票',
	'NotShopDdId'=>'此訂單不存在',
	'ShopDdIdHavePrice'=>'此訂單已經支付',
	'EmptyAddress'=>'請輸入地址名稱',
	'AddAddressSuccess'=>'增加地址完畢',
	'EditAddressSuccess'=>'修改地址完畢',
	'NotAddressid'=>'請選擇地址',
	'DelAddressSuccess'=>'刪除地址完畢',
	'DefAddressSuccess'=>'設置默認地址完畢',
	'ErrorShopTbname'=>'非商城表的信息',
	'NotChangeShopDdid'=>'請選擇訂單',
	'NotDelShopDd'=>'此訂單已確認，不能取消',
	'OuttimeNotDelShopDd'=>'此訂單下單時間已超過可取消時間',
	'DelShopDdSuccess'=>'取消訂單完畢',
	'EmptyPreCode'=>'此優惠碼不存在',
	'PreCodeOuttime'=>'此優惠碼已過期',
	'PreCodeNotLevel'=>'您所在的會員組沒有權限使用此優惠碼',
	'PreCodeErrorClass'=>'此類商品不能使用此優惠碼',
	'PreCodeMusttotal'=>'購滿 '.$GLOBALS['precodemusttotal'].' 元才可以使用此優惠碼',
	'ShopOutMaxnum'=>'您購買的商品數量已超過庫存量',
	'ShopNotProductNum'=>'此商品目前無貨',
	'ShopDdCancel'=>'此訂單已經取消',
	'ShopBuycarMaxnum'=>'您的購物車商品數量超過限制',
	'ShopOutSinglenum'=>'您購買的單商品總數已超過限制',

	'SchallNotRecord'=>'沒有搜索到相關的內容',
	'SchallOutTime'=>'系統限制的搜索時間間隔為 '.$public_r[schalltime].' 秒,請稍後再搜索',
	'EmptySchallKeyboard'=>'請輸入搜索關鍵字',
	'SchallMinKeyboard'=>'系統限制的搜索關鍵字只能在 '.$public_r[schallminlen].'~'.$public_r[schallmaxlen].' 個字符之間',
	'SchallNotOpenTitleText'=>'系統未開啟標題+全文同時搜索',
	'SchallNotOpenTitle'=>'系統未開啟標題搜索',
	'SchallNotOpenText'=>'系統未開啟全文搜索',
	'SchallClose'=>'全站搜索未開啟',

	'CloseTags'=>'TAG模塊已關閉',
	'HaveNotTags'=>'此TAG不存在',
);
?>