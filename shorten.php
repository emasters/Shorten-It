<?php
/*
 * First authored by Brian Cray
 * License: http://creativecommons.org/licenses/by/3.0/
 * Contact the author at http://briancray.com/
 * 
 * S3 and local store sections added by Elmer Masters
 */
 
ini_set('display_errors', 0);

$url_to_shorten = get_magic_quotes_gpc() ? stripslashes(trim($_REQUEST['longurl'])) : trim($_REQUEST['longurl']);

if(!empty($url_to_shorten) && preg_match('|^https?://|', $url_to_shorten))
{
	require('config.php');

	// check if the client IP is allowed to shorten
	if($_SERVER['REMOTE_ADDR'] != LIMIT_TO_IP)
	{
		die('You are not allowed to shorten URLs with this service.');
	}
	
	// check if the URL is valid
	if(CHECK_URL)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url_to_shorten);
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, TRUE);
		$response = curl_exec($ch);
		curl_close($handle);
		if(curl_getinfo($ch, CURLINFO_HTTP_CODE) == '404')
		{
			die('Not a valid URL');
		}
	}
	
	// check if the URL has already been shortened
	$already_shortened = mysql_result(mysql_query('SELECT id FROM ' . DB_TABLE. ' WHERE long_url="' . mysql_real_escape_string($url_to_shorten) . '"'), 0, 0);
	if(!empty($already_shortened))
	{
		// URL has already been shortened
		$shortened_url = getShortenedURLFromID($already_shortened);
	}
	else
	{
		// URL not in database, insert
		mysql_query('LOCK TABLES ' . DB_TABLE . ' WRITE;');
		mysql_query('INSERT INTO ' . DB_TABLE . ' (long_url, created, creator) VALUES ("' . mysql_real_escape_string($url_to_shorten) . '", "' . time() . '", "' . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . '")');
		$shortened_url = getShortenedURLFromID(mysql_insert_id());
		mysql_query('UNLOCK TABLES');
		
		
	}
	/**
	 * This is were we write to a file
	 * and stick it into S3
	 */
	if(LOCAL_STORE)
	{
		$fhandle = fopen(LOCAL_STORE_DIR . $shortened_url, 'w+');
		$redirpage = '<html>
						<head>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<title></title>
							<META HTTP-EQUIV="Refresh" CONTENT="0;URL='.$url_to_shorten.'">
							<meta name="robots" content="noindex"/>
							<link rel="canonical" href="'.$url_to_shorten.'"/>
						</head>
							<body>
							</body>
					  </html>';
		fwrite($fhandle, $redirpage);
		fclose($fhandle);	
	}
	if(S3)
	{
		if (!class_exists('S3')) require_once './amazon-s3-php-class/S3.php';

		$uploadFile = LOCAL_STORE_DIR . $shortened_url; 
		$s3 = new S3(awsAccessKey, awsSecretKey);
		// Put our file (also with public read access)
		if ($s3->putObjectFile($uploadFile, S3_BUCKET, baseName($uploadFile), S3::ACL_PUBLIC_READ,array(),'text/html')) {
		}
	}
	
	
	echo BASE_HREF . $shortened_url;
}

function getShortenedURLFromID ($integer, $base = ALLOWED_CHARS)
{
	$length = strlen($base);
	while($integer > $length - 1)
	{
		$out = $base[fmod($integer, $length)] . $out;
		$integer = floor( $integer / $length );
	}
	return $base[$integer] . $out;
}