<?php
	date_default_timezone_set("Asia/Urumqi");

	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'sbes');

	session_start();

	$con = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	if ($con->connect_error) {
	    die("Connection failed: " . $con->connect_error);
	}
	
	function passwordEncrypt($string) {
		$key = 'digal domaub pioquinto';
		$iv = mcrypt_create_iv(
	    mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC),
	    MCRYPT_DEV_URANDOM);

		$encrypted = base64_encode(
	    $iv .
	    mcrypt_encrypt(
	        MCRYPT_RIJNDAEL_128,
	        hash('sha256', $key, true),
	        $string,
	        MCRYPT_MODE_CBC,
	        $iv
	    ));
		
		return $encrypted;
	}

	function passwordDecrypt($string) {
		$key = 'digal domaub pioquinto';
		$data = base64_decode($string);
		$iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));

		$decrypted = rtrim(
		    mcrypt_decrypt(
		        MCRYPT_RIJNDAEL_128,
		        hash('sha256', $key, true),
		        substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)),
		        MCRYPT_MODE_CBC,
		        $iv
		    ),
		    "\0"
		);
		return $decrypted;
	}

	function displayMoney($double) {
		return number_format($double, 2, ".", ",");
	}

	function displayDuration($start, $end) {
		$start = date_format(date_create($start), 'm/d/Y');
		$end = date_format(date_create($end), 'm/d/Y');

		return $start . ' - ' . $end;
	}

	function displayFilename($dir, $file) {
		return preg_replace('/^' 
			. preg_quote($dir, '/') . '/', '', $file);
	}

	function tempID($size) {
		$alpha_key = '';
		$keys = range('A', 'Z');

		for ($i = 0; $i < 2; $i++) {
			$alpha_key .= $keys[array_rand($keys)];
		}

		$length = $size - 2;

		$key = '';
		$keys = range(0, 9);

		for ($i = 0; $i < $length; $i++) {
			$key .= $keys[array_rand($keys)];
		}

		return $alpha_key . $key;
	}

	function consolePrint($string) {
		echo '<script>console.log("'.$string.'");</script>';
	}

	function getBonusesAndDeductions() {
		global $con;

		$_SESSION['deductions'] = array();
		$_SESSION['bonuses'] =  array();
		$index 				= 0;

		$getDeductions 		= $con->prepare("SELECT deduction_id,
													deduction_name,
													deduction_percent,
													deduction_amount
													FROM lib_deductions");
		$bind 				= $getDeductions->execute();
		$getDeductions		->store_result();
		$getDeductions		->bind_result($deduction_id,
											$deduction_name,
											$deduction_percent,
											$deduction_amount);
		$deduction_count	= $getDeductions->num_rows();

		while($getDeductions->fetch()){
			$_SESSION['deductions'][$index]['id'] 		= $deduction_id;
			$_SESSION['deductions'][$index]['name'] 	= $deduction_name;
			$_SESSION['deductions'][$index]['percent'] 	= $deduction_percent;
			$_SESSION['deductions'][$index]['amount'] 	= $deduction_amount;
			$index++;
		}
		$getDeductions->close();
		$index				= 0;

		$getBonuses 		= $con->prepare("SELECT bonus_id,
													bonus_name,
													bonus_percent,
													bonus_amount
													FROM lib_bonuses");
		$bind 				= $getBonuses->execute();
		$getBonuses	        ->store_result();
		$getBonuses		    ->bind_result($bonus_id,
											$bonus_name,
											$bonus_percent,
											$bonus_amount);
		$bonus_count		= $getBonuses->num_rows();

		while($getBonuses->fetch()){
			$_SESSION['bonuses'][$index]['id'] 		= $bonus_id;
			$_SESSION['bonuses'][$index]['name'] 	= $bonus_name;
			$_SESSION['bonuses'][$index]['percent'] = $bonus_percent;
			$_SESSION['bonuses'][$index]['amount'] 	= $bonus_amount;
			$index++;
		}
		$getBonuses->close();
	}
?>