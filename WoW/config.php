<?php
	$iniParse = parse_ini_file("./wow.ini", true);
/*Set Current */
$current = $iniParse['currentEnv']['data'];

/*Database config*/
$db_host = "localhost";  $iniParse[$current]['db_host'];
$db_database = "warcraft"; $iniParse[$current]['db_database'];
$db_user = "root"; $iniParse[$current]['db_user'];
$db_password = ""; $iniParse[$current]['db_password'];

/*end config*/
$db = new PDO('mysql:host='.$db_host.';
                   dbname='.$db_database, 
                   $db_user, $db_password);
				   
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>

