<?php
define('InEmpireCMSIconv',TRUE);

class Chinese
{
	//存放簡體中文與拼音對照表
    var $pinyin_table = array();

	//存放 GB <-> UNICODE 對照表的內容
    var $unicode_table = array();

	//訪問中文繁簡互換表的文件指針
    var $ctf;

    var $SourceText = "";

	//配置
    var $config  =  array(
        'codetable_dir'         => '',                      //  存放各種語言互換表的目錄
        'source_lang'           => '',                      //  字符的原編碼
        'target_lang'           => '',                      //  轉換後的編碼
        'GBtoBIG5_table'        => 'gb-big5.table',         //  簡體中文轉換為繁體中文的對照表
        'BIG5toGB_table'        => 'big5-gb.table',         //  繁體中文轉換為簡體中文的對照表
        'GBtoPinYin_table'      => 'gb-pinyin.table',       //  簡體中文轉換為拼音的對照表
        'GBtoUnicode_table'     => 'gb-unicode.table',      //  簡體中文轉換為UNICODE的對照表
        'BIG5toUnicode_table'   => 'big5-unicode.table'     //  繁體中文轉換為UNICODE的對照表
    );

    function Chinese($dir='./')
    {
        $this->config['codetable_dir'] = $dir."../data/codetable/";
    }

    function Convert( $source_lang , $target_lang , $source_string='' )
    {
        /* 如果編碼相同，直接返回 */
        if ($source_lang == $target_lang || $source_string == '')
        {
            return $source_string;
        }
        
        if ($source_lang != '') {
            $this->config['source_lang'] = $source_lang;
        }

        if ($target_lang != '') {
            $this->config['target_lang'] = $target_lang;
        }

		
        $this->SourceText = $source_string;
        
        $this->OpenTable();
        // 判斷是否為中文繁、簡轉換
        if ( ($this->config['source_lang']=="GB2312" || $this->config['source_lang']=="BIG5") && ($this->config['target_lang']=="GB2312" || $this->config['target_lang']=="BIG5") ) {
            return $this->GB2312toBIG5();
        }

        // 判斷是否為簡體中文與拼音轉換
        if ( ($this->config['source_lang']=="GB2312" || $this->config['source_lang']=="BIG5") && $this->config['target_lang']=="PinYin" ) {
            return $this->CHStoPinYin();
        }

        // 判斷是否為簡體、繁體中文與UTF8轉換
        if ( ($this->config['source_lang']=="GB2312" || $this->config['source_lang']=="BIG5" || $this->config['source_lang']=="UTF8") && ($this->config['target_lang']=="UTF8" || $this->config['target_lang']=="GB2312" || $this->config['target_lang']=="BIG5") ) {
            return $this->CHStoUTF8();
        }

        // 判斷是否為簡體、繁體中文與UNICODE轉換
        if ( ($this->config['source_lang']=="GB2312" || $this->config['source_lang']=="BIG5") && $this->config['target_lang']=="UNICODE" ) {
            return $this->CHStoUNICODE();
        }
    }

	//將 16 進制轉換為 2 進制字符
    function _hex2bin( $hexdata )
    {
        $bindata = '';
        for ($i = 0; $i < strlen($hexdata); $i += 2 )
        {
        	$bindata .= chr(hexdec(substr($hexdata, $i, 2)));
        }

        return $bindata;
    }

    function OpenTable()
    {

        // 假如原編碼為簡體中文的話
        if ($this->config['source_lang']=="GB2312") {

            // 假如轉換目標編碼為繁體中文的話
            if ($this->config['target_lang'] == "BIG5") {
                $this->ctf = fopen($this->config['codetable_dir'].$this->config['GBtoBIG5_table'], "rb");
                if (is_null($this->ctf)) {
                    echo "打開打開轉換表文件失敗！";
                    exit;
                }
            }

            // 假如轉換目標編碼為拼音的話
            if ($this->config['target_lang'] == "PinYin") {
                $tmp = @file($this->config['codetable_dir'].$this->config['GBtoPinYin_table']);
                if (!$tmp) {
                    echo "打開打開轉換表文件失敗！";
                    exit;
                }
                //
                $i = 0;
                for ($i=0; $i<count($tmp); $i++) {
                    $tmp1 = explode("	", $tmp[$i]);
                    $this->pinyin_table[$i]=array($tmp1[0],$tmp1[1]);
                }
            }

            // 假如轉換目標編碼為 UTF8 的話
            if ($this->config['target_lang'] == "UTF8") {
                $tmp = @file($this->config['codetable_dir'].$this->config['GBtoUnicode_table']);
                if (!$tmp) {
                    echo "編碼轉換失敗！";
                    exit;
                }
                $this->unicode_table = array();
                while(list($key,$value)=each($tmp))
                $this->unicode_table[hexdec(substr($value,0,6))]=substr($value,7,6);
            }

            // 假如轉換目標編碼為 UNICODE 的話
            if ($this->config['target_lang'] == "UNICODE") {
                $tmp = @file($this->config['codetable_dir'].$this->config['GBtoUnicode_table']);
                if (!$tmp) {
                    echo "打開打開轉換表文件失敗！";
                    exit;
                }
                $this->unicode_table = array();
                while(list($key,$value)=each($tmp))
                $this->unicode_table[hexdec(substr($value,0,6))]=substr($value,9,4);
            }
        }

        // 假如原編碼為繁體中文的話
        if ($this->config['source_lang']=="BIG5") {
            // 假如轉換目標編碼為簡體中文的話
            if ($this->config['target_lang'] == "GB2312") {
                $this->ctf = fopen($this->config['codetable_dir'].$this->config['BIG5toGB_table'], "r");
                if (is_null($this->ctf)) {
                    echo "打開打開轉換表文件失敗！";
                    exit;
                }
            }
            // 假如轉換目標編碼為 UTF8 的話
            if ($this->config['target_lang'] == "UTF8") {
                $tmp = @file($this->config['codetable_dir'].$this->config['BIG5toUnicode_table']);
                if (!$tmp) {
                    echo "打開打開轉換表文件失敗！";
                    exit;
                }
                $this->unicode_table = array();
                while(list($key,$value)=each($tmp))
                $this->unicode_table[hexdec(substr($value,0,6))]=substr($value,7,6);
            }

            // 假如轉換目標編碼為 UNICODE 的話
            if ($this->config['target_lang'] == "UNICODE") {
                $tmp = @file($this->config['codetable_dir'].$this->config['BIG5toUnicode_table']);
                if (!$tmp) {
                    echo "打開打開轉換表文件失敗！";
                    exit;
                }
                $this->unicode_table = array();
                while(list($key,$value)=each($tmp))
                $this->unicode_table[hexdec(substr($value,0,6))]=substr($value,9,4);
            }

            // 假如轉換目標編碼為拼音的話
            if ($this->config['target_lang'] == "PinYin") {
                $tmp = @file($this->config['codetable_dir'].$this->config['GBtoPinYin_table']);
                if (!$tmp) {
                    echo "打開打開轉換表文件失敗！";
                    exit;
                }
                //
                $i = 0;
                for ($i=0; $i<count($tmp); $i++) {
                    $tmp1 = explode("	", $tmp[$i]);
                    $this->pinyin_table[$i]=array($tmp1[0],$tmp1[1]);
                }
            }
        }

        // 假如原編碼為 UTF8 的話
        if ($this->config['source_lang']=="UTF8") {

            // 假如轉換目標編碼為 GB2312 的話
            if ($this->config['target_lang'] == "GB2312") {
                $tmp = @file($this->config['codetable_dir'].$this->config['GBtoUnicode_table']);
                if (!$tmp) {
                    echo "打開打開轉換表文件失敗！";
                    exit;
                }
                $this->unicode_table = array();
                while(list($key,$value)=each($tmp))
                {
                	$this->unicode_table[hexdec(substr($value,7,6))]=substr($value,0,6);
                }
            }

            // 假如轉換目標編碼為 BIG5 的話
            if ($this->config['target_lang'] == "BIG5") {
                $tmp = @file($this->config['codetable_dir'].$this->config['BIG5toUnicode_table']);
                if (!$tmp) {
                    echo "打開打開轉換表文件失敗！";
                    exit;
                }
                $this->unicode_table = array();
                while(list($key,$value)=each($tmp))
                {
                	$this->unicode_table[hexdec(substr($value,7,6))]=substr($value,0,6);
                }
            }
        }

    }

    function OpenFile( $position , $isHTML=false )
    {
        $tempcontent = @file($position);

        if (!$tempcontent) {
            echo "打開文件失敗！";
            exit;
        }

        $this->SourceText = implode("",$tempcontent);

        if ($isHTML) {
            $this->SourceText = preg_replace( "/charset=".$this->config['source_lang']."/i" , "charset=".$this->config['target_lang'] , $this->SourceText);

            $this->SourceText = str_replace("\n", "", $this->SourceText);

            $this->SourceText = str_replace("\r", "", $this->SourceText);
        }
    }

    function SiteOpen( $position )
    {
        $tempcontent = @file($position);

        if (!$tempcontent) {
            echo "打開文件失敗！";
            exit;
        }

        // 將數組的所有內容轉換為字符串
        $this->SourceText = implode("",$tempcontent);

        $this->SourceText = preg_replace( "/charset=".$this->config['source_lang']."/i" , "charset=".$this->config['target_lang'] , $this->SourceText);

    }

    function setvar( $parameter , $value )
    {
        if(!trim($parameter))
        return $parameter;

        $this->config[$parameter] = $value;

    }

    function CHSUtoUTF8($c)
    {
        $str="";

        if ($c < 0x80) {
            $str.=$c;
        }

        elseif ($c < 0x800) {
            $str.=(0xC0 | $c>>6);
            $str.=(0x80 | $c & 0x3F);
        }

        elseif ($c < 0x10000) {
            $str.=(0xE0 | $c>>12);
            $str.=(0x80 | $c>>6 & 0x3F);
            $str.=(0x80 | $c & 0x3F);
        }

        elseif ($c < 0x200000) {
            $str.=(0xF0 | $c>>18);
            $str.=(0x80 | $c>>12 & 0x3F);
            $str.=(0x80 | $c>>6 & 0x3F);
            $str.=(0x80 | $c & 0x3F);
        }

        return $str;
    }

    function CHStoUTF8(){

        if ($this->config["source_lang"]=="BIG5" || $this->config["source_lang"]=="GB2312") {
            $ret="";

            while($this->SourceText){

                if(ord(substr($this->SourceText,0,1))>127){

                    if ($this->config["source_lang"]=="BIG5") {
                        $utf8=$this->CHSUtoUTF8(hexdec($this->unicode_table[hexdec(bin2hex(substr($this->SourceText,0,2)))]));
                    }
                    if ($this->config["source_lang"]=="GB2312") {
                        $utf8=$this->CHSUtoUTF8(hexdec($this->unicode_table[hexdec(bin2hex(substr($this->SourceText,0,2)))-0x8080]));
                    }
                    for($i=0;$i<strlen($utf8);$i+=3)
                    $ret.=chr(substr($utf8,$i,3));

                    $this->SourceText=substr($this->SourceText,2,strlen($this->SourceText));
                }

                else{
                    $ret.=substr($this->SourceText,0,1);
                    $this->SourceText=substr($this->SourceText,1,strlen($this->SourceText));
                }
            }
            $this->unicode_table = array();
            $this->SourceText = "";
            return $ret;
        }

        if ($this->config["source_lang"]=="UTF8") {
            $out = '';
            $len = strlen($this->SourceText);
            $i = 0;
            while($i < $len) {
                $c = ord( substr( $this->SourceText, $i++, 1 ) );
                switch($c >> 4)
                {
                    case 0: case 1: case 2: case 3: case 4: case 5: case 6: case 7:
                        // 0xxxxxxx
                        $out .= substr( $this->SourceText, $i - 1, 1 );
                        break;
                    case 12: case 13:
                        // 110x xxxx   10xx xxxx
                        $char2 = ord( substr( $this->SourceText, $i++, 1 ) );
                        $char3 = $this->unicode_table[(($c & 0x1F) << 6) | ($char2 & 0x3F)];

                        if ($this->config["target_lang"]=="GB2312")
                        {
                        	$out .= $this->_hex2bin( dechex(  $char3 + 0x8080 ) );
                        } elseif ($this->config["target_lang"]=="BIG5")
                        {
                        	$out .= $this->_hex2bin( dechex ( $char3 + 0x0000 ) );
                        }
                        break;
                    case 14:
                        // 1110 xxxx  10xx xxxx  10xx xxxx
                        $char2 = ord( substr( $this->SourceText, $i++, 1 ) );
                        $char3 = ord( substr( $this->SourceText, $i++, 1 ) );
                        $char4 = $this->unicode_table[(($c & 0x0F) << 12) | (($char2 & 0x3F) << 6) | (($char3 & 0x3F) << 0)];

                        if ($this->config["target_lang"]=="GB2312")
                        {
                        	$out .= $this->_hex2bin( dechex ( $char4 + 0x8080 ) );
                        } elseif ($this->config["target_lang"]=="BIG5")
                        {
                        	$out .= $this->_hex2bin( dechex ( $char4 + 0x0000 ) );
                        }
                        break;
                }
            }

            // 返回結果
            return $out;
        }
    }

    function CHStoUNICODE()
    {

        $utf="";

        while($this->SourceText)
        {
            if (ord(substr($this->SourceText,0,1))>127)
            {

                if ($this->config["source_lang"]=="GB2312")
                $utf.="&#x".$this->unicode_table[hexdec(bin2hex(substr($this->SourceText,0,2)))-0x8080].";";

                if ($this->config["source_lang"]=="BIG5")
                $utf.="&#x".$this->unicode_table[hexdec(bin2hex(substr($this->SourceText,0,2)))].";";

                $this->SourceText=substr($this->SourceText,2,strlen($this->SourceText));
            }
            else
            {
                $utf.=substr($this->SourceText,0,1);
                $this->SourceText=substr($this->SourceText,1,strlen($this->SourceText));
            }
        }
        return $utf;
    }

    function GB2312toBIG5()
    {
        // 獲取等待轉換的字符串的總長度
        $max=strlen($this->SourceText)-1;

        for($i=0;$i<$max;$i++){

            $h=ord($this->SourceText[$i]);

            if($h>=160){

                $l=ord($this->SourceText[$i+1]);

                if($h==161 && $l==64){
                    $gb="  ";
                }
                else{
                    fseek($this->ctf,($h-160)*510+($l-1)*2);
                    $gb=fread($this->ctf,2);
                }

                $this->SourceText[$i]=$gb[0];
                $this->SourceText[$i+1]=$gb[1];
                $i++;
            }
        }
        fclose($this->ctf);

        // 將轉換後的結果賦予 $result;
        $result = $this->SourceText;

        // 清空 $thisSourceText
        $this->SourceText = "";

        // 返回轉換結果
        return $result;
    }

    function PinYinSearch($num){

        if($num>0&&$num<160){
            return chr($num);
        }

        elseif($num<-20319||$num>-10247){
            return "";
        }

        else{

            for($i=count($this->pinyin_table)-1;$i>=0;$i--){
                if($this->pinyin_table[$i][1]<=$num)
                break;
            }

            return $this->pinyin_table[$i][0];
        }
    }

    function CHStoPinYin(){
        if ( $this->config['source_lang']=="BIG5" ) {
            $this->ctf = fopen($this->config['codetable_dir'].$this->config['BIG5toGB_table'], "r");
            if (is_null($this->ctf)) {
                echo "打開打開轉換表文件失敗！";
                exit;
            }

            $this->SourceText = $this->GB2312toBIG5();
            $this->config['target_lang'] = "PinYin";
        }

        $ret = array();
        $ri = 0;
        for($i=0;$i<strlen($this->SourceText);$i++){

            $p=ord(substr($this->SourceText,$i,1));

            if($p>160){
                $q=ord(substr($this->SourceText,++$i,1));
                $p=$p*256+$q-65536;
            }

            $ret[$ri]=$this->PinYinSearch($p);
            $ri = $ri + 1;
        }

        // 清空 $this->SourceText
        $this->SourceText = "";

        $this->pinyin_table = array();

        // 返回轉換後的結果
        return implode(" ", $ret);
    }

    function ConvertIT()
    {
        // 判斷是否為中文繁、簡轉換
        if ( ($this->config['source_lang']=="GB2312" || $this->config['source_lang']=="BIG5") && ($this->config['target_lang']=="GB2312" || $this->config['target_lang']=="BIG5") ) {
            return $this->GB2312toBIG5();
        }

        // 判斷是否為簡體中文與拼音轉換
        if ( ($this->config['source_lang']=="GB2312" || $this->config['source_lang']=="BIG5") && $this->config['target_lang']=="PinYin" ) {
            return $this->CHStoPinYin();
        }

        // 判斷是否為簡體、繁體中文與UTF8轉換
        if ( ($this->config['source_lang']=="GB2312" || $this->config['source_lang']=="BIG5" || $this->config['source_lang']=="UTF8") && ($this->config['target_lang']=="UTF8" || $this->config['target_lang']=="GB2312" || $this->config['target_lang']=="BIG5") ) {
            return $this->CHStoUTF8();
        }

        // 判斷是否為簡體、繁體中文與UNICODE轉換
        if ( ($this->config['source_lang']=="GB2312" || $this->config['source_lang']=="BIG5") && $this->config['target_lang']=="UNICODE" ) {
            return $this->CHStoUNICODE();
        }

    }

}
?>