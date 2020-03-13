<?php

/*
function __autoload($className) {

    if (file_exists(SYS_DIR.'/controller' . '/' . strtolower($className) . '.php')) {
        require_once(SYS_DIR.'/controller' . '/' . strtolower($className) . '.php');
    } else if (file_exists(SYS_DIR.'/library' . '/' . strtolower($className) . '.php')) {
        require_once(SYS_DIR.'/library' . '/' . strtolower($className) . '.php');
    } else if (file_exists(SYS_DIR.'/model' . '/' . strtolower($className) . '.php')) {
        require_once(SYS_DIR.'/model' . '/' . strtolower($className) . '.php');
    } else if (file_exists(SYS_DIR.'/library/htmlgen' . '/' . strtolower($className) . '.php')) {
        require_once(SYS_DIR.'/library/htmlgen' . '/' . strtolower($className) . '.php');
    } else {
			$filename = SYS_DIR.'/library/phpmailer/class.'.strtolower($className).'.php';
			if (is_readable($filename)) {
				require $filename;
			}else{
				// Error Generation Code Here
				echo "Class not founded: " . $className;
				die();
			}
    }
}

*/

function sharedf_autoload($className){
		if (file_exists(SYS_DIR.'/library' . '/' . strtolower($className) . '.php')) {
			require_once(SYS_DIR.'/library' . '/' . strtolower($className) . '.php');
		} else {
			$filename = SYS_DIR.'/library/phpmailer/class.'.strtolower($className).'.php';
			if (is_readable($filename)) {
				require $filename;
			}else{
				// Error Generation Code Here
				echo "Class not founded: " . $className;
				die();
			}
		}
}

spl_autoload_register("sharedf_autoload");

function no_direct_access(){
	if(!defined('INDEX_PROCEDURE')) die();
}

function myformat_encode($arr){
	$data = "";
	foreach($arr as $k=>$v){
		if($k == "date"){
			$v = Date("d/m/Y H:i:s");
		}
		$data = $data.$k."=".$v.";";
	}
	$data = $data."lastupd=".Date('Y-m-d H:i:s');
	return $data;
}
function myformat_decode($l){
	$vars = explode(';', $l);
	$a = Array();
	foreach($vars as $k=>$v){
		$t = explode('=',$v);
		if(count($t)>1){
			$a[$t[0]] = $t[1];
		}
	}
	return $a;
}

function myarr2str_encode($arr){
	$data = "";
	foreach($arr as $k=>$v){
		$data = $data.$k."=".$v.";";
	}
	return $data;
}
function myarr2str_decode($l){
	$vars = explode(';', $l);
	$a = Array();
	foreach($vars as $k=>$v){
		$t = explode('=',$v);
		if(count($t)>1){
			$a[$t[0]] = $t[1];
		}
	}
	return $a;
}

function arr2separated($a, $delimiter=','){
	$s = '';
	if(count($a) == 0) return '';
	foreach($a as $v){
		$s = $s.$delimiter.$v;
	}
	$s = substr($s, 1);
	return $s;
}

function get_timezone_offset($remote_tz, $origin_tz = 'UTC') {
    if($origin_tz === null) {
        if(!is_string($origin_tz = date_default_timezone_get())) {
            return false; // A UTC timestamp was returned -- bail out!
        }
    }
    $origin_dtz = new DateTimeZone($origin_tz);
    $remote_dtz = new DateTimeZone($remote_tz);
    $origin_dt = new DateTime("now", $origin_dtz);
    $remote_dt = new DateTime("now", $remote_dtz);
    $offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);
    return $offset;
}

function remove_utf8_bom($text)
{
    $bom = pack('H*','EFBBBF');
    $text = preg_replace("/^$bom/", '', $text);
    return $text;
}


function getUrl($c="", $a="", $pars=null, $totalurl=false){
	$url = 'index.php';
	if($c!= ""){
		$url = $url."?contr=".$c;
		if($a!=""){
			$url = $url."&action=".$a;
			if($pars!=null){
				foreach ($pars as $k=>$v){
					$url = $url."&".$k.'='.$v;
				}
			}
		}
	}
	if($totalurl){
		return SYS_URL."/".$url;
	}
	return $url;
}

function egetUrl($c="", $a="", $pars=null,$totalurl=false){
	$url = 'index.php';
	if($c!= ""){
		$url = $url."?contr=".$c;
		if($a!=""){
			$url = $url."&action=".$a;
			if($pars!=null){
				foreach ($pars as $k=>$v){
					$url = $url."&".$k.'='.$v;
				}
			}
		}
	}
	if($totalurl){
		echo SYS_URL."/".$url;
	}else{
	echo $url;
	}
}

function p2f($fname){
	echo SYS_DIR."/".$fname;
}


function getTimeZoneOffset($zone){
	$timezone = new DateTimeZone($zone);
	return (int)(($timezone->getOffset(new DateTime)/60)/60);

}

function getTimeZoneName($offset){
	// Calculate seconds from offset
	list($hours, $minutes) = explode(':', $offset);
	$seconds = $hours * 60 * 60 + $minutes * 60;
	// Get timezone name from seconds
	$tz = timezone_name_from_abbr('', $seconds, 1);
	// Workaround for bug #44780
	if($tz === false) $tz = timezone_name_from_abbr('', $seconds, 0);
	// Set timezone
	date_default_timezone_set($tz);

	//echo $tz . ': ' . date('r');
	return $tz;
}

function calculateMinutes(DateInterval $int){
    $days = $int->format('%a');
    return ($days * 24 * 60) + ($int->h * 60) + $int->i;
}

function beautyCapitalize($s){
	$r = "";
	$except = array("da","de","do", "na", "no", "a", "o", "e");
	$s2 = strtolower($s);
	$a = explode(" ",$s2);
	foreach($a as $v){
		if(strlen($r) != 0){
			$r = $r." ";
		}
		if(!in_array($v,$except)){
			$r = $r.ucfirst($v);
		}else{
			$r = $r.$v;
		}
	}
	return $r;
}

function titleCase($string, $delimiters = array(" ", "-", ".", "'", "O'", "Mc"), $exceptions = array("com","na","no","de", "da", "dos", "das", "do", "I", "II", "III", "IV", "V", "VI"))
    {
        /*
         * Exceptions in lower case are words you don't want converted
         * Exceptions all in upper case are any words you don't want converted to title case
         *   but should be converted to upper case, e.g.:
         *   king henry viii or king henry Viii should be King Henry VIII
         */
        $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
        foreach ($delimiters as $dlnr => $delimiter) {
            $words = explode($delimiter, $string);
            $newwords = array();
            foreach ($words as $wordnr => $word) {
                if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtoupper($word, "UTF-8");
                } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtolower($word, "UTF-8");
                } elseif (!in_array($word, $exceptions)) {
                    // convert to uppercase (non-utf8 only)
                    $word = ucfirst($word);
                }
                array_push($newwords, $word);
            }
            $string = join($delimiter, $newwords);
       }//foreach
       return $string;
    }


require_once SYS_DIR."/library/phpmailer/class.phpmailer.php";

function sendHtmlEmail($to_ar, $subject,$msgHtml, $msgPlain, $from_name=null, $attach=null, $emaillog='default'){
	global $configvar;

	$from_name = "IOTBRAS Monitoramento";
	/*
	$mail_HOST = $configvar['sysemails'][$emaillog]['host'];
	$mail_USER = $configvar['sysemails'][$emaillog]['user'];
	$mail_PASS = $configvar['sysemails'][$emaillog]['pass'];
	$mail_PORT = $configvar['sysemails'][$emaillog]['port'];
	if($from_name == null){
		$from_name = $configvar['sysemails'][$emaillog]['from'];
	}
	*/
        
        /*
	$mail_HOST = "br278.hostgator.com.br";
	$mail_USER = "noreply@iotbras.com";
	$mail_PASS = "170587iot";
	$mail_PORT = 465;
*/
        $mail_HOST = "localhost";
	$mail_USER = "test3";
	$mail_PASS = "test3";
	$mail_PORT = 25;
	//$mail_PORT = 26;


	//-------->$from = $mail_USER;
        $from = "test1@localhost";

	$mail = new PHPMailer;
	//$mail->Timeout  =  10;
	$mail->CharSet = 'UTF-8';

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = $mail_HOST;  // Specify main and backup SMTP servers
	//---------->$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->SMTPAuth = false;                               // Enable SMTP authentication
	$mail->Username = $mail_USER;                 // SMTP username
	$mail->Password = $mail_PASS;                           // SMTP password
	//----->$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	
        //ADDED
        //$mail->SMTPSecure = 'tls';
        
        /************** SSL config, remover na producao ** /
        $mail->smtpConnect(
    array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    )
);
        /**/
        
	$mail->Port = $mail_PORT;

	$mail->setFrom($from, $from_name);
	//array_push($to_ar, "jna@jnaeletronicos.com");
	foreach($to_ar as $v){
		$mail->addAddress($v);     // Add a recipient
	}
	$mail->isHTML(true);

	$mail->Subject = $subject;
	$mail->Body    = $msgHtml;
	$mail->AltBody = $msgPlain;

	if(count($attach) > 0){
		foreach($attach as $v){
			$mail->AddAttachment($v);
		}
	}

	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		//echo 'Message has been sent';
		return true;
	}
        die();
	return false;
}
/*
function sendHtmlEmail($to_ar, $subject,$msgHtml, $msgPlain, $from_name="Mailer"){

	$mail_HOST = "br278.hostgator.com.br";
	$mail_USER = "noreply@iotbras.com";
	$mail_PASS = "170587iot";
	$mail_PORT = 465;
	$from = $mail_USER;

	$mail = new PHPMailer;
	//$mail->Timeout  =  10;
	$mail->CharSet = 'UTF-8';

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = $mail_HOST;  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = $mail_USER;                 // SMTP username
	$mail->Password = $mail_PASS;                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = $mail_PORT;

	$mail->setFrom($from, $from_name);
	foreach($to_ar as $v){
		$mail->addAddress($v);     // Add a recipient
	}
	$mail->isHTML(true);

	$mail->Subject = $subject;
	$mail->Body    = $msgHtml;
	$mail->AltBody = $msgPlain;
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message has been sent';
		return true;
	}
	return false;
}
*/

function sendsms($numeroTel, $mensTexto){
	require_once SYS_DIR."/library/smsgateway/smsGateway.php";


	if($numeroTel[0] != '5'){
		$numeroTel = "+55".$numeroTel;
	}


	$smsGateway = new SmsGateway('centralblbean@gmail.com', '170587sms');

	$deviceID = 62071;
	$number = $numeroTel;
	$message = $mensTexto;
/*
	$options = [
	'send_at' => strtotime('+10 minutes'), // Send the message in 10 minutes
	'expires_at' => strtotime('+1 hour') // Cancel the message in 1 hour if the message is not yet sent
	];
*/
	//Please note options is no required and can be left out
	$result = $smsGateway->sendMessageToNumber($number, $message, $deviceID);
	//print_r($result);
	//echo "::".count($result["response"]["result"]["success"]);
	if(isset($result["response"]))
		if(isset($result["response"]["result"]))
			if(isset($result["response"]["result"]["success"]))
				if (count($result["response"]["result"]["success"]) > 0){
					//echo "TRUE RETURNED....";
					return true;
				}


	return false;
}


/*
function sendsms($numeroTel, $mensTexto){

	$chaveAPI = "8183261309"; #Chave API do Usuario
	$usuarioNome = "leandro"; #Nome de usuario Login
	$assinatura = ""; #Assinatura da mensagem
	$Url = "http://smsbr.com.br/enviosms.php";

	//$mensTexto = urlencode($mensTexto);
	if($numeroTel[0] != '5'){
		$numeroTel = "55".$numeroTel;
	}


	$sessao_curl = curl_init();
	curl_setopt($sessao_curl, CURLOPT_URL, $Url);
	curl_setopt($sessao_curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($sessao_curl, CURLOPT_POST, 1);
	curl_setopt($sessao_curl,CURLOPT_POSTFIELDS,
	"chaveAPI=$chaveAPI&usuarioNome=$usuarioNome&numeroTel=$numeroTel&mensTexto=$mensTexto");
	$resultado = curl_exec($sessao_curl);
	curl_close($sessao_curl);
	echo $resultado.'\n';
	$APIMsgID= substr($resultado, 0, -1); #Recebe o ID da Mensagem
	echo $APIMsgID.'\n';
	if(strpos($APIMsgID, "Sucesso")){
		//echo "SUCESSO<br/>";

		return true;
	}
	return false;

}
*/
function removeChars($v)
{
	$v = str_replace("'", "", $v);
	$v = str_replace("\"", "", $v);
	$v = str_replace("<", "", $v);
	$v = str_replace(">", "", $v);
	return $v;
}

$_post = array();
$_get = array();

function escapeInput($filter = null)
{
    global $_post;
    global $_get;

	foreach($_GET as $key => $value) // STORE $_GET VALUES
	{
		$_get[$key] = removeChars($value);
	}

	foreach($_POST as $key => $value) // STORE $_GET VALUES
	{
		$_post[$key] = removeChars($value);
	}

}

function remove_accents($string) {
    if ( !preg_match('/[\x80-\xff]/', $string) )
        return $string;

    $chars = array(
    // Decompositions for Latin-1 Supplement
    chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
    chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
    chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
    chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
    chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
    chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
    chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
    chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
    chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
    chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
    chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
    chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
    chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
    chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
    chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
    chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
    chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
    chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
    chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
    chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
    chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
    chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
    chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
    chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
    chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
    chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
    chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
    chr(195).chr(191) => 'y',
    // Decompositions for Latin Extended-A
    chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
    chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
    chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
    chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
    chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
    chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
    chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
    chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
    chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
    chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
    chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
    chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
    chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
    chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
    chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
    chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
    chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
    chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
    chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
    chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
    chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
    chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
    chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
    chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
    chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
    chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
    chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
    chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
    chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
    chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
    chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
    chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
    chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
    chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
    chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
    chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
    chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
    chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
    chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
    chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
    chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
    chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
    chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
    chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
    chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
    chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
    chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
    chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
    chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
    chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
    chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
    chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
    chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
    chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
    chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
    chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
    chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
    chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
    chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
    chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
    chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
    chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
    chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
    chr(197).chr(190) => 'z', chr(197).chr(191) => 's'
    );

    $string = strtr($string, $chars);

    return $string;
}


function url_get_contents ($Url) {
    if (!function_exists('curl_init')){
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
