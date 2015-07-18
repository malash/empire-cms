<?php
define('InEmpireCMSIconv',TRUE);

class Chinese
{
	//�s��²�餤��P������Ӫ�
    var $pinyin_table = array();

	//�s�� GB <-> UNICODE ��Ӫ����e
    var $unicode_table = array();

	//�X�ݤ����c²�����������w
    var $ctf;

    var $SourceText = "";

	//�t�m
    var $config  =  array(
        'codetable_dir'         => '',                      //  �s��U�ػy���������ؿ�
        'source_lang'           => '',                      //  �r�Ū���s�X
        'target_lang'           => '',                      //  �ഫ�᪺�s�X
        'GBtoBIG5_table'        => 'gb-big5.table',         //  ²�餤���ഫ���c�餤�媺��Ӫ�
        'BIG5toGB_table'        => 'big5-gb.table',         //  �c�餤���ഫ��²�餤�媺��Ӫ�
        'GBtoPinYin_table'      => 'gb-pinyin.table',       //  ²�餤���ഫ����������Ӫ�
        'GBtoUnicode_table'     => 'gb-unicode.table',      //  ²�餤���ഫ��UNICODE����Ӫ�
        'BIG5toUnicode_table'   => 'big5-unicode.table'     //  �c�餤���ഫ��UNICODE����Ӫ�
    );

    function Chinese($dir='./')
    {
        $this->config['codetable_dir'] = $dir."../data/codetable/";
    }

    function Convert( $source_lang , $target_lang , $source_string='' )
    {
        /* �p�G�s�X�ۦP�A������^ */
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
        // �P�_�O�_�������c�B²�ഫ
        if ( ($this->config['source_lang']=="GB2312" || $this->config['source_lang']=="BIG5") && ($this->config['target_lang']=="GB2312" || $this->config['target_lang']=="BIG5") ) {
            return $this->GB2312toBIG5();
        }

        // �P�_�O�_��²�餤��P�����ഫ
        if ( ($this->config['source_lang']=="GB2312" || $this->config['source_lang']=="BIG5") && $this->config['target_lang']=="PinYin" ) {
            return $this->CHStoPinYin();
        }

        // �P�_�O�_��²��B�c�餤��PUTF8�ഫ
        if ( ($this->config['source_lang']=="GB2312" || $this->config['source_lang']=="BIG5" || $this->config['source_lang']=="UTF8") && ($this->config['target_lang']=="UTF8" || $this->config['target_lang']=="GB2312" || $this->config['target_lang']=="BIG5") ) {
            return $this->CHStoUTF8();
        }

        // �P�_�O�_��²��B�c�餤��PUNICODE�ഫ
        if ( ($this->config['source_lang']=="GB2312" || $this->config['source_lang']=="BIG5") && $this->config['target_lang']=="UNICODE" ) {
            return $this->CHStoUNICODE();
        }
    }

	//�N 16 �i���ഫ�� 2 �i��r��
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

        // ���p��s�X��²�餤�媺��
        if ($this->config['source_lang']=="GB2312") {

            // ���p�ഫ�ؼнs�X���c�餤�媺��
            if ($this->config['target_lang'] == "BIG5") {
                $this->ctf = fopen($this->config['codetable_dir'].$this->config['GBtoBIG5_table'], "rb");
                if (is_null($this->ctf)) {
                    echo "���}���}�ഫ���󥢱ѡI";
                    exit;
                }
            }

            // ���p�ഫ�ؼнs�X����������
            if ($this->config['target_lang'] == "PinYin") {
                $tmp = @file($this->config['codetable_dir'].$this->config['GBtoPinYin_table']);
                if (!$tmp) {
                    echo "���}���}�ഫ���󥢱ѡI";
                    exit;
                }
                //
                $i = 0;
                for ($i=0; $i<count($tmp); $i++) {
                    $tmp1 = explode("	", $tmp[$i]);
                    $this->pinyin_table[$i]=array($tmp1[0],$tmp1[1]);
                }
            }

            // ���p�ഫ�ؼнs�X�� UTF8 ����
            if ($this->config['target_lang'] == "UTF8") {
                $tmp = @file($this->config['codetable_dir'].$this->config['GBtoUnicode_table']);
                if (!$tmp) {
                    echo "�s�X�ഫ���ѡI";
                    exit;
                }
                $this->unicode_table = array();
                while(list($key,$value)=each($tmp))
                $this->unicode_table[hexdec(substr($value,0,6))]=substr($value,7,6);
            }

            // ���p�ഫ�ؼнs�X�� UNICODE ����
            if ($this->config['target_lang'] == "UNICODE") {
                $tmp = @file($this->config['codetable_dir'].$this->config['GBtoUnicode_table']);
                if (!$tmp) {
                    echo "���}���}�ഫ���󥢱ѡI";
                    exit;
                }
                $this->unicode_table = array();
                while(list($key,$value)=each($tmp))
                $this->unicode_table[hexdec(substr($value,0,6))]=substr($value,9,4);
            }
        }

        // ���p��s�X���c�餤�媺��
        if ($this->config['source_lang']=="BIG5") {
            // ���p�ഫ�ؼнs�X��²�餤�媺��
            if ($this->config['target_lang'] == "GB2312") {
                $this->ctf = fopen($this->config['codetable_dir'].$this->config['BIG5toGB_table'], "r");
                if (is_null($this->ctf)) {
                    echo "���}���}�ഫ���󥢱ѡI";
                    exit;
                }
            }
            // ���p�ഫ�ؼнs�X�� UTF8 ����
            if ($this->config['target_lang'] == "UTF8") {
                $tmp = @file($this->config['codetable_dir'].$this->config['BIG5toUnicode_table']);
                if (!$tmp) {
                    echo "���}���}�ഫ���󥢱ѡI";
                    exit;
                }
                $this->unicode_table = array();
                while(list($key,$value)=each($tmp))
                $this->unicode_table[hexdec(substr($value,0,6))]=substr($value,7,6);
            }

            // ���p�ഫ�ؼнs�X�� UNICODE ����
            if ($this->config['target_lang'] == "UNICODE") {
                $tmp = @file($this->config['codetable_dir'].$this->config['BIG5toUnicode_table']);
                if (!$tmp) {
                    echo "���}���}�ഫ���󥢱ѡI";
                    exit;
                }
                $this->unicode_table = array();
                while(list($key,$value)=each($tmp))
                $this->unicode_table[hexdec(substr($value,0,6))]=substr($value,9,4);
            }

            // ���p�ഫ�ؼнs�X����������
            if ($this->config['target_lang'] == "PinYin") {
                $tmp = @file($this->config['codetable_dir'].$this->config['GBtoPinYin_table']);
                if (!$tmp) {
                    echo "���}���}�ഫ���󥢱ѡI";
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

        // ���p��s�X�� UTF8 ����
        if ($this->config['source_lang']=="UTF8") {

            // ���p�ഫ�ؼнs�X�� GB2312 ����
            if ($this->config['target_lang'] == "GB2312") {
                $tmp = @file($this->config['codetable_dir'].$this->config['GBtoUnicode_table']);
                if (!$tmp) {
                    echo "���}���}�ഫ���󥢱ѡI";
                    exit;
                }
                $this->unicode_table = array();
                while(list($key,$value)=each($tmp))
                {
                	$this->unicode_table[hexdec(substr($value,7,6))]=substr($value,0,6);
                }
            }

            // ���p�ഫ�ؼнs�X�� BIG5 ����
            if ($this->config['target_lang'] == "BIG5") {
                $tmp = @file($this->config['codetable_dir'].$this->config['BIG5toUnicode_table']);
                if (!$tmp) {
                    echo "���}���}�ഫ���󥢱ѡI";
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
            echo "���}��󥢱ѡI";
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
            echo "���}��󥢱ѡI";
            exit;
        }

        // �N�Ʋժ��Ҧ����e�ഫ���r�Ŧ�
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

            // ��^���G
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
        // ��������ഫ���r�Ŧꪺ�`����
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

        // �N�ഫ�᪺���G�ᤩ $result;
        $result = $this->SourceText;

        // �M�� $thisSourceText
        $this->SourceText = "";

        // ��^�ഫ���G
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
                echo "���}���}�ഫ���󥢱ѡI";
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

        // �M�� $this->SourceText
        $this->SourceText = "";

        $this->pinyin_table = array();

        // ��^�ഫ�᪺���G
        return implode(" ", $ret);
    }

    function ConvertIT()
    {
        // �P�_�O�_�������c�B²�ഫ
        if ( ($this->config['source_lang']=="GB2312" || $this->config['source_lang']=="BIG5") && ($this->config['target_lang']=="GB2312" || $this->config['target_lang']=="BIG5") ) {
            return $this->GB2312toBIG5();
        }

        // �P�_�O�_��²�餤��P�����ഫ
        if ( ($this->config['source_lang']=="GB2312" || $this->config['source_lang']=="BIG5") && $this->config['target_lang']=="PinYin" ) {
            return $this->CHStoPinYin();
        }

        // �P�_�O�_��²��B�c�餤��PUTF8�ഫ
        if ( ($this->config['source_lang']=="GB2312" || $this->config['source_lang']=="BIG5" || $this->config['source_lang']=="UTF8") && ($this->config['target_lang']=="UTF8" || $this->config['target_lang']=="GB2312" || $this->config['target_lang']=="BIG5") ) {
            return $this->CHStoUTF8();
        }

        // �P�_�O�_��²��B�c�餤��PUNICODE�ഫ
        if ( ($this->config['source_lang']=="GB2312" || $this->config['source_lang']=="BIG5") && $this->config['target_lang']=="UNICODE" ) {
            return $this->CHStoUNICODE();
        }

    }

}
?>