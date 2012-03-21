<?php
/*
 * First authored by Brian Cray
 * License: http://creativecommons.org/licenses/by/3.0/
 * Contact the author at http://briancray.com/
 * 
 * S3 and local store sections added by Elmer Masters
 */

// db options
define('DB_NAME', 'your db name');
define('DB_USER', 'your db usernae');
define('DB_PASSWORD', 'your db password');
define('DB_HOST', 'localhost');
define('DB_TABLE', 'shortenedurls');

// connect to database
mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysql_select_db(DB_NAME);

// base location of script (include trailing slash)
define('BASE_HREF', 'http://' . $_SERVER['HTTP_HOST'] . '/');

// change to limit short url creation to a single IP
define('LIMIT_TO_IP', $_SERVER['REMOTE_ADDR']);

// change to TRUE to start tracking referrals
define('TRACK', FALSE);

// check if URL exists first
define('CHECK_URL', FALSE);

// change the shortened URL allowed characters
define('ALLOWED_CHARS', '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

// do you want to cache?
define('CACHE', TRUE);

// if so, where will the cache files be stored? (include trailing slash)
define('CACHE_DIR', dirname(__FILE__) . '/cache/');

// do you want to create a local store
define('LOCAL_STORE', FALSE);

// if so, where will the local store files be stored (include trailing slash)
define('LOCAL_STORE_DIR', dirname(__FILE__) . '/store/');

// do you want to use Amazon S3 for storage?
define('S3', FALSE);

// if so, let's set some S3 variables
define('awsAccessKey', 'change to your access key');
define('awsSecretKey', 'change to your secret key');
define('S3_BUCKET', 'name of S3 bucket');
