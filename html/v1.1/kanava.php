<?php
  
  # 
  # Julkaisukanava rajapinta
  #

ini_set('default_mimetype', 'application/json');
header("Access-Control-Allow-Origin: *");


require_once('kyselyt.php');
require_once('url_kasittely.php');
 
 
  # kasa muttujia
  $v_debug 	= false;
  $url 		= $_SERVER['REQUEST_URI'];
  $script 	= $_SERVER['SCRIPT_NAME'];
  $method 	=  $_SERVER['REQUEST_METHOD'];
  $v_parametri  = "";
  $kanava_sqlp1  = "";
  $kanava_sqlp2  = "";


  #
  # Käyttäjä laskeutuu sovelluksen juureen 
  #

  if ($url == $script) {
	$file = file_get_contents('./hello.html', FILE_USE_INCLUDE_PATH);
	echo $file;
	die();
  }
  else {
	$v_parametri = url_kasittely::url_str(urldecode($url), basename($script), $method);
	# printf("<br>p: %s", $v_parametri);
  }		


 #
 # Requsert URI:n tarkastus epäonnistui palautetaan virhe
 #

  if ($v_parametri == "") {
	header('X-PHP-Response-Code: 400', true, 400);
	die();
  } 


 #
 # So far so good... avataan yhetys tietokantaan 
 # 


  # Haetaan kayttajatunnus ja salasana
  $passfile = fopen("/var/www/files/jfp.ini", "r") or die("ERR01 - Report this error to administration at: olli.eskola@csc.fi, Thanks");
  if ($passfile) {
	$t_rivi = fgets($passfile, 4096);
	$t_rivi = preg_replace('/\s+/','', trim($t_rivi));
	list($server, $user, $pass, $dbase) = explode(":", $t_rivi);
       
  }
  fclose($passfile);
  
  # first connection test

  $mysqli = mysqli_connect($server, $user, $pass, $dbase);
  if (!$mysqli) {
	echo "ERR02 - Report this error to administration at: joonas.kesaniemi@csc.fi, Thanks";
	die();
  }

   #mysql character set
  mysqli_set_charset($mysqli, 'utf8');

 
  #
  # Astetaan hakuparametrit ja suoritetaan kysely
  #
 
  $kanava_sqlp1 = $v_parametri;
  $kanava_hae_jkanava_pre1 = preg_replace('/%PARAM1%/', $kanava_sqlp1, $kanava_hae_jkanava_pre1);
  $res = mysqli_query($mysqli, $kanava_hae_jkanava_pre1);


  if ($res) {
	while ($row =  mysqli_fetch_row($res)){
	  # printf ("%s\n", $row[0]);
	  $kanava_sqlp2 = trim($row[0]);
	  $kanava_sqlp2 = preg_replace('/^[;]/','',  $kanava_sqlp2);
	  $kanava_sqlp2 = preg_replace('/[;]$/','',  $kanava_sqlp2);
	  $kanava_sqlp2 = preg_replace('/[;]/',',', $kanava_sqlp2);
	  # printf("%s\n", $kanava_sqlp2);
	}
  }
  
  if ($kanava_sqlp2 != "") {
	$kanava_hae_jkanava = preg_replace('/%PARAM1%/', $kanava_sqlp1, $kanava_hae_jkanava);
  	$kanava_hae_jkanava = preg_replace('/%PARAM2%/', $kanava_sqlp2, $kanava_hae_jkanava);
  	$res = mysqli_query($mysqli, $kanava_hae_jkanava);
  }
  else {
	$kanava_hae_jkanava_b = preg_replace('/%PARAM1%/', $kanava_sqlp1, $kanava_hae_jkanava_b);
        $res = mysqli_query($mysqli, $kanava_hae_jkanava_b);
  }
  
 
  $rivit = mysqli_num_rows($res);

  if($rivit > 0){
 	if ($res) {  
  		while ($row = mysqli_fetch_array($res, MYSQL_ASSOC)){
	   	# foreach ($row as $key => $value) {
	   	#	echo "$key : $value <br>";
	   	#
	   	# }
	   	$myArray[] = $row;		
  		}

	 	# header("Content-Type: application/json");
		# header("Access-Control-Allow-Origin: *"); 
		echo json_encode($myArray);

  	}
  	else {
	 	echo "Error: " . mysqli_error($mysqli);
  	}	
  }
  else {
        # Luodaan tyja
        echo json_encode(json_decode ("{}"));
  }


  # $res->close();
  $mysqli->close();

?>
