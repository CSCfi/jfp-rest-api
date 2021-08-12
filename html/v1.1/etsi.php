<?php
  
  # 
  # Julkaisukanava rajapinta
  #

# ini_set('default_mimetype', 'application/json');
# header("Access-Control-Allow-Origin: *");



require_once('kyselyt.php');
require_once('url_kasittely.php');
 
 
  # kasa muttujia
  $v_debug 	= false;
  $url 		= $_SERVER['REQUEST_URI'];
  $script 	= $_SERVER['SCRIPT_NAME'];
  $method 	=  $_SERVER['REQUEST_METHOD'];
  $v_parametri  = "";
  $kanava_sqlp1  = "";


  #
  # Käyttäjä laskeutuu sovelluksen juureen 
  #

  ini_set('default_mimetype', 'application/json');
  header("Access-Control-Allow-Origin: *");


  if ($url == $script) {
	$file = file_get_contents('./hello.html', FILE_USE_INCLUDE_PATH);
	echo $file;
	die();
  }
  else {
	$v_parametri = url_kasittely::url_str(urldecode($url), basename($script), $method);
	 if ($v_debug){printf("<br>parametri: %s", $v_parametri);}
  }		

  # ini_set('default_mimetype', 'application/json');
  # header("Access-Control-Allow-Origin: *");
  # exit;

 #
 # Requsert URI:n tarkastus epäonnistui palautetaan virhe
 #


  if ($v_parametri == "") {
	header('X-PHP-Response-Code: 400', true, 400);
	die();
  } 

  #
  # Tyyppi parametrin käsittely 
  #

  # printf("%s",substr($_GET["type"],1));

  $v_type = "";
  $t_type = "";
  if (isset($_GET["tyyppi"])) {
	$t_type =  htmlspecialchars($_GET["tyyppi"],1);
    if ($t_type == '1') {
        $v_type = 'Lehti/Sarja';
    }
    else if ($t_type == '2') {
        $v_type = 'Kirjakustantaja';
    }
    else if ($t_type == '3') {
         $v_type = 'Konferenssi';
    }
    else {
	## printf('tyyppi: %s', $v_type); 
        header('X-PHP-Response-Code: 400', true, 400);
        die();
    }
  }
  else {
     $v_type = 'Lehti/Sarja';

  }


 #
 # Tarkistukset ohi astetaan headrerit
 #
 
 #  ini_set('default_mimetype', 'application/json');
 #  header("Access-Control-Allow-Origin: *");

 

 #
 # So far so good... avataan yhetys tietokantaan 
 # 


  # Haetaan kayttajatunnus ja salasana
  $passfile = fopen("/var/www/files/jfp.ini", "r") or die("ERR01 - Report this error to administration at: raine.rapo@csc.fi, Thanks");
  if ($passfile) {
	$t_rivi = fgets($passfile, 4096);
	$t_rivi = preg_replace('/\s+/','', trim($t_rivi));
	list($server, $user, $pass, $dbase) = explode(":", $t_rivi);
       
  }
  fclose($passfile);
 
  # first connection test

  $mysqli = mysqli_connect($server, $user, $pass, $dbase);
  if (!$mysqli) {
	echo "ERR02 - Report this error to administration at: raine.rapo@csc.fi, Thanks";
	die();
  }

  #mysql character set
  mysqli_set_charset($mysqli, 'utf8');
 
  #
  # Astetaan hakuparametrit ja suoritetaan kysely
  #


  $kanava_sqlp1 = 'https://jufo-rest.csc.fi/v1.0/kanava/';
  $kanava_sqlp2 = $v_parametri;
  $kanava_sqlp3 = $v_type;

  $t_use = 0;
  if (isset($_GET["nimi"]) && $t_use == 0) {
        $kanava_etsi_jkanava = preg_replace('/%PARAM1%/', $kanava_sqlp1, $kanava_etsi_jkanava);
        $kanava_etsi_jkanava = preg_replace('/%PARAM2%/', $kanava_sqlp2, $kanava_etsi_jkanava);
	$kanava_etsi_jkanava = preg_replace('/%PARAM3%/', $kanava_sqlp3, $kanava_etsi_jkanava);
	$t_use = 1;
  }


  if (isset($_GET["issn"])&& $t_use == 0) {
  	$kanava_etsi_jkanava_issn = preg_replace('/%PARAM1%/', $kanava_sqlp1, $kanava_etsi_jkanava_issn);
  	$kanava_etsi_jkanava_issn = preg_replace('/%PARAM2%/', $kanava_sqlp2, $kanava_etsi_jkanava_issn);
	$kanava_etsi_jkanava_issn = preg_replace('/%PARAM3%/', $kanava_sqlp3, $kanava_etsi_jkanava_issn);
	$kanava_etsi_jkanava = $kanava_etsi_jkanava_issn;
	$t_use = 1;
  }
 

  if (isset($_GET["isbn"]) && $t_use == 0) {
	# $kanava_sqlp3 = 'Kirjakustantaja';
        $kanava_etsi_jkanava_isbn = preg_replace('/%PARAM1%/', $kanava_sqlp1, $kanava_etsi_jkanava_isbn);
        $kanava_etsi_jkanava_isbn = preg_replace('/%PARAM2%/', $kanava_sqlp2, $kanava_etsi_jkanava_isbn);
	$kanava_etsi_jkanava_isbn = preg_replace('/%PARAM3%/', $kanava_sqlp3, $kanava_etsi_jkanava_isbn);
	$kanava_etsi_jkanava = $kanava_etsi_jkanava_isbn;
	$t_use = 1;
  }

  if (isset($_GET["lyhenne"]) && $t_use == 0) {
        # $kanava_sqlp3 = 'Kirjakustantaja';
        $kanava_etsi_jkanava_lyhenne = preg_replace('/%PARAM1%/', $kanava_sqlp1, $kanava_etsi_jkanava_lyhenne);
        $kanava_etsi_jkanava_lyhenne = preg_replace('/%PARAM2%/', $kanava_sqlp2, $kanava_etsi_jkanava_lyhenne);
        $kanava_etsi_jkanava_lyhenne = preg_replace('/%PARAM3%/', $kanava_sqlp3, $kanava_etsi_jkanava_lyhenne);
        $kanava_etsi_jkanava = $kanava_etsi_jkanava_lyhenne;
        $t_use = 1;
  }



  # $kanava_sqlp1 = 'https://kanava-dev.csc.fi/jufo/kanava/';
  # $kanava_sqlp2 = $v_parametri;
  # $kanava_etsi_jkanava = preg_replace('/%PARAM1%/', $kanava_sqlp1, $kanava_etsi_jkanava);
  # $kanava_etsi_jkanava = preg_replace('/%PARAM2%/', $kanava_sqlp2, $kanava_etsi_jkanava);
  $res = mysqli_query($mysqli, $kanava_etsi_jkanava);
      
  $rivit = mysqli_num_rows($res);

  if($rivit > 0){   
  	  while ($row = mysqli_fetch_array($res, MYSQL_ASSOC)){
	    # foreach ($row as $key => $value) {
	    #	echo "$key : $value <br>";
	    #
	    # }
	    $myArray[] = $row;		
  	  } 

          # header("Access-Control-Allow-Origin: *");

	  echo json_encode($myArray);	
  }
  else {
	# Luodaan tyja 
	echo json_encode(json_decode ("{}"));	
  }

  # Suljetaan yhteys
  $mysqli->close();
  die();

?>
