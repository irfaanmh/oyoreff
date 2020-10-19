<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set("Asia/Jakarta");

function json($status, $keterangan) {
	print_r(
		json_encode(
			array(
				"status" => $status,
				"keterangan" => $keterangan
			)
		)
	);
}

function nama() {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$ex = curl_exec($ch);
	preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);

	return $name[2][mt_rand(0, 14)];
}

function generateRandomString($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

if (!empty($_GET["opsi"])) {
	$ip	= rand(1, 255).".".rand(0, 255).".".rand(0, 255).".".rand(0, 255);

	if ($_GET["opsi"] === "otp") {
		if (
			!empty($_POST["negara"])		&& is_numeric($_POST["negara"])
			&& !empty($_POST["telepon"])
		) {
			$negara		= @str_replace(["-", "+", "(",")", " "], "", $_POST["negara"]);
			$telepon	= @str_replace(["-", "+", "(",")", " "], "", $_POST["telepon"]);

			$ch			= curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://api.oyorooms.com/v2/users/generate_otp?phone=".$telepon."&nod=4&intent=login&sms_auto_retrieval=true&country_code=%2B.".$negara.".&version=20205&partner_app_version=20205&android_id=".generateRandomString(16)."&idfa=&sid=1551940465205");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($ch, CURLOPT_ENCODING, "gzip, deflate");
			$headers	= array();
			$headers[]	= "Access_token: QmpDZlRxZWo2UkZ5M3pSeHZ5NW46bi13NHN0ZTV5V1I1aGpCUVVHOUM=";
			$headers[]	= "Authorization: Basic QmpDZlRxZWo2UkZ5M3pSeHZ5NW46bi13NHN0ZTV5V1I1aGpCUVVHOUM=";
			$headers[]	= "Oyo_ab_config: 1551940467632|dea:1|mwhp:1|t3c:0|epba:0|rst2:1|phbb:0|wcta:1|wtea:1|cdr2:0|popl:0|bann:1|sbma:1|rae:1|gmfh:1|prep:1|fbtn:1|htab:1|hbna:1|absb:1|se1:0|sbmi:1|se3:0|se2:0|se5:6|se4:1|rtsa:0|se6:1|cour:0|gsra:1|rtsi:1|hdab:1|rba:0|cdr:0|ipw:0|rd:1|ipw2:0|pppp:0|lzpi:1|npfi:1|uprc:1|rbl:1|rsa:0|dww2:0|deal:1|pnpd:1|rcua:1|rsi:0|gsti:1|dwep:2|otp4:1|urha:1|ppa:2|ona:0|svh:1|stc2:1|urhi:1|ppi:2|gsta:0|gstc:0|nlab:1|asa:1|cr:1|rts:0|nlp:1|mjo:1|onab:0|asi:1|wtei:1|asei:1|bsba:2|aca:1|bea:1|wtib:2|hbri:0|lyr:0|aci:0|scta:0|tspk:1|hste:1|tspi:0|tspj:0|DWWS:1|a2hs:1|pfri:0|brch:4|test:1|raab:0|sink:0|aswp:1|shli:0|hrr:0|hrt:1|riab:1|hbad:0|hbi:0|rcui:1|idl:0|sbpa:0|stcl:0|sbpi:0|sinc:1|shla:0|brea:1|idum:1|lpta:1|lpti:1|ffab:1|his2:0|hbci:1|pst:1|stfi:0|pce:1|stft:2|omue:0|brei:1|hsei:0|sold:1|hbca:1|home:1|scti:0|otab:1|cvis:0|gsa:1|dwhp:0|gsi:1|rasl:0|locr:0|obai:1|dbad:1|nrca:1|epa:2|nrci:1|hlis:0|epi:0|epn:2|fbb:1|trab:1|rmo2:1|niab:0|lbht:0|weng:0|shpa:0|hppl:0|hsfa:1|sls:1|shpi:0|loc:0|phli:0|gpwa:0|nsl:1|prpa:1|saet:1|nhba:1|gpwi:0|nrfa:0|nbwa:0|prpi:1|hbi2:1|saea:1|mrc:1|blh:1|cpab:1|hpsa:0|vct:0|octt:1|phb:1|hpsi:0|cadd:1|nsfa:1|oban:1|spc2:1|smla:0|sfni:0|auto:1|uiab:1|pvis:0|wtab:3|shel:1|ndlp:0|hmpi:1|his:0|rmo:1|bdpi:1|pbra:1|sos:2|logn:1|rms:1|uaab:1|papg:1|bdpa:1|pbri:1|nob2:1|swar:1|aowt:1|spc:1|pioi:0|rms2:0|trCl:1|nhbi:0|lbh:1|nrfi:0|nbwi:1|paom:0|lsc:1|pdhi:0|tsb:0|lsc2:0|diei:1|dmme:1|diea:1|dte:1|acsi:1|nuom:0|adum:0|pdha:0|uhps:0|mwen:0|nobs:1|efa:1|hpwa:0|fbb2:1|sra:2|reca:1|BnTc:0|paab:1|mwep:2|ngst:1|hpwi:1|ltsc:1|reci:1|jbei:0|piab:1|aimg:1|avgp:0|ffib:1|mww2:1|ioab:0|hpfd:1|srz:1|socp:0|plwc:1";
			$headers[]	= "Accept-Language: en";
			$headers[]	= "Content-Type: application/json";
			$headers[]	= "User-Agent: Dalvik/2.1.0 (Linux; U; Android 8.1.0; SM-G610F Build/M1AJQ)";
			$headers[]	= "Host: api.oyorooms.com";
			$headers[]	= "X-Forwarded-For: ".$ip;
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$data	= curl_exec($ch);
			if (curl_errno($ch)) {
				$permintaan	= curl_error($ch);
			}
			else {
				$permintaan	= json_decode($data, true);
			}
			curl_close ($ch);

			if (@is_array($permintaan)) {
				if (!empty($permintaan["status"])) {
					$status	= true;
					if (empty($permintaan["is_user_present"])) {
						$keterangan	= "Pengguna baru.";
					}
					else {
						$keterangan	= "Pengguna lama.";
					}
				}
				else {
					$status		= false;
					$keterangan	= $permintaan["error"]["message"];
				}
			}
			else {
				$status		= false;
				$keterangan	= $permintaan;
			}

			json($status, $keterangan);
		}
		else {
			json(false, "Nomor telepon/kode negara belum diinputkan.");
		}
	}
	else if ($_GET["opsi"] === "daftar") {
		if (
			!empty($_POST["negara"])		&& is_numeric($_POST["negara"])
			&& !empty($_POST["telepon"])
			&& !empty($_POST["otp"])		&& is_numeric($_POST["otp"])
			&& !empty($_POST["referral"])
		) {
			$negara		= @str_replace(["-", "+", "(",")", " "], "", $_POST["negara"]);
			$telepon	= @str_replace(["-", "+", "(",")", " "], "", $_POST["telepon"]);
			$nama		= nama();
			$email		= @str_shuffle(@str_replace(["HMKK.", " "], "", $nama))."@hmkk.org";
			$otp		= @trim($_POST["otp"]);
			$referral	= @trim($_POST["referral"]);

			$ch			= curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
			curl_setopt($ch, CURLOPT_URL, "https://api.oyorooms.com/v2/users/new_sign_up?additional_fields=ab_service_data&handset=samsung%2C%20SM-G610F&version=20205&partner_app_version=20205&android_id=".generateRandomString(16)."&idfa=&sid=1551940465205");
			curl_setopt($ch, CURLOPT_POSTFIELDS, '{
				"truecaller": false,
				"code": "'.$otp.'",
				"country_code": "+'.$negara.'",
				"device_id": "'.generateRandomString(16).'",
				"device_type": "android",
				"email": "'.$email.'",
				"id": 0,
				"idfa": "",
				"name": "'.$nama.'",
				"phone": "'.$telepon.'",
				"push_type": "gcm",
				"referral_code": "'.$referral.'",
				"token": "c-PeIXwYYwg:APA91bHHQLHnS0FvSIOYJpN-hBJXYHxc1xQh8FrMZaQawBVPVyXxk77vTz7LWC4rtApBrZb3p4pOwJRD2JBMq0u3sChUgpasQFGcN_HNAGCscrcREwL-trFIBX3votCcFY1bn7eBmuCd",
				"updated_at": 0
			}');
			$headers	= array();
			$headers[]	= "Access_token: QmpDZlRxZWo2UkZ5M3pSeHZ5NW46bi13NHN0ZTV5V1I1aGpCUVVHOUM=";
			$headers[]	= "Authorization: Basic QmpDZlRxZWo2UkZ5M3pSeHZ5NW46bi13NHN0ZTV5V1I1aGpCUVVHOUM=";
			$headers[]	= "Oyo_ab_config: 1551940467632|dea:1|mwhp:1|t3c:0|epba:0|rst2:1|phbb:0|wcta:1|wtea:1|cdr2:0|popl:0|bann:1|sbma:1|rae:1|gmfh:1|prep:1|fbtn:1|htab:1|hbna:1|absb:1|se1:0|sbmi:1|se3:0|se2:0|se5:6|se4:1|rtsa:0|se6:1|cour:0|gsra:1|rtsi:1|hdab:1|rba:0|cdr:0|ipw:0|rd:1|ipw2:0|pppp:0|lzpi:1|npfi:1|uprc:1|rbl:1|rsa:0|dww2:0|deal:1|pnpd:1|rcua:1|rsi:0|gsti:1|dwep:2|otp4:1|urha:1|ppa:2|ona:0|svh:1|stc2:1|urhi:1|ppi:2|gsta:0|gstc:0|nlab:1|asa:1|cr:1|rts:0|nlp:1|mjo:1|onab:0|asi:1|wtei:1|asei:1|bsba:2|aca:1|bea:1|wtib:2|hbri:0|lyr:0|aci:0|scta:0|tspk:1|hste:1|tspi:0|tspj:0|DWWS:1|a2hs:1|pfri:0|brch:4|test:1|raab:0|sink:0|aswp:1|shli:0|hrr:0|hrt:1|riab:1|hbad:0|hbi:0|rcui:1|idl:0|sbpa:0|stcl:0|sbpi:0|sinc:1|shla:0|brea:1|idum:1|lpta:1|lpti:1|ffab:1|his2:0|hbci:1|pst:1|stfi:0|pce:1|stft:2|omue:0|brei:1|hsei:0|sold:1|hbca:1|home:1|scti:0|otab:1|cvis:0|gsa:1|dwhp:0|gsi:1|rasl:0|locr:0|obai:1|dbad:1|nrca:1|epa:2|nrci:1|hlis:0|epi:0|epn:2|fbb:1|trab:1|rmo2:1|niab:0|lbht:0|weng:0|shpa:0|hppl:0|hsfa:1|sls:1|shpi:0|loc:0|phli:0|gpwa:0|nsl:1|prpa:1|saet:1|nhba:1|gpwi:0|nrfa:0|nbwa:0|prpi:1|hbi2:1|saea:1|mrc:1|blh:1|cpab:1|hpsa:0|vct:0|octt:1|phb:1|hpsi:0|cadd:1|nsfa:1|oban:1|spc2:1|smla:0|sfni:0|auto:1|uiab:1|pvis:0|wtab:3|shel:1|ndlp:0|hmpi:1|his:0|rmo:1|bdpi:1|pbra:1|sos:2|logn:1|rms:1|uaab:1|papg:1|bdpa:1|pbri:1|nob2:1|swar:1|aowt:1|spc:1|pioi:0|rms2:0|trCl:1|nhbi:0|lbh:1|nrfi:0|nbwi:1|paom:0|lsc:1|pdhi:0|tsb:0|lsc2:0|diei:1|dmme:1|diea:1|dte:1|acsi:1|nuom:0|adum:0|pdha:0|uhps:0|mwen:0|nobs:1|efa:1|hpwa:0|fbb2:1|sra:2|reca:1|BnTc:0|paab:1|mwep:2|ngst:1|hpwi:1|ltsc:1|reci:1|jbei:0|piab:1|aimg:1|avgp:0|ffib:1|mww2:1|ioab:0|hpfd:1|srz:1|socp:0|plwc:1";
			$headers[]	= "Accept-Language: en";
			$headers[]	= "Content-Type: application/json; charset=utf-8";
			$headers[]	= "User-Agent: Dalvik/2.1.0 (Linux; U; Android 8.1.0; SM-G610F Build/M1AJQ)";
			$headers[]	= "Host: api.oyorooms.com";
			$headers[]	= "X-Forwarded-For: ".$ip;
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$data	= curl_exec($ch);
			if (curl_errno($ch)) {
				$permintaan	= curl_error($ch);
			}
			else {
				$permintaan	= json_decode($data, true);
			}
			curl_close ($ch);

			//print_r($permintaan);

			if (@is_array($permintaan)) {
				if (!empty($permintaan["access_token"])) {
					$status		= true;
					$keterangan	= [
						"telepon"	=> $permintaan["country_code"].$permintaan["phone"],
						"email"		=> $permintaan["email"],
						"nama"		=> $permintaan["first_name"]." ".$permintaan["last_name"],
						"data"		=> $permintaan
					];
				}
				else {
					$status		= false;
					$keterangan	= $permintaan["error"]["message"];
				}
			}
			else {
				$status		= false;
				$keterangan	= $permintaan;
			}

			json($status, $keterangan);
		} else {
			json(false, "Data yang dikirim tidak lengkap.");
		}
	}
	else {
		json(false, "Permintaan tidak ditemukan.");
	}
} else {
	json(true, "Made with love by Alvriyanto Azis.");
}
?>