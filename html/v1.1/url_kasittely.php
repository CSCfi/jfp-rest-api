<?php

  class url_kasittely {

                      
	private function parametri_tarkistus ($parametri, $tyyppi, $max_pituus, $min_pituus) {
	  
	  #
	  # POST / GET parametrien tarkistus.
	  # Tarkistetaan, että sisaltää vain salittuja merkkejä
	  # Tyyppi 1 parametri siältää numeron
	  # Tyyppi 2 string numeroita ja kirjaimia
	  #

          if ($GLOBALS['v_debug']){printf("<br>DEBUG:parametrien tarkistus parametri_tarkistus()");}
          if ((strlen($parametri) <= $max_pituus) and (strlen($parametri) >= $min_pituus)) {
                if (($tyyppi == 1) && (preg_match("/^[0-9]*$/", $parametri))) {
                return 1;
                }
                else if (($tyyppi == 2) && (preg_match("/^[a-zA-Z0-9_äöåÄÖÅ\s-]*$/", $parametri))) {
		  return 1;
		} else {
		  if ($GLOBALS['v_debug']){printf("<br>DEBUG:parametrien tarkistus parametri_tarkistus(), ei onnistunut tyyppi; %s parametri: %s pituus %s", $tyyppi, $parametri, $pituus);}
		  return 0;
		}
          }

        }


	public function url_str($url, $script, $method) {
	 
	  #
	  # Request string käsittely
	  # $url kutsutun url stringin käsitely
	  # $script suoritettyavan skriptin nimi
	  # $method kutsuttu operaation GET, POST, PUT DEDLETE ... 
	  #

	  if ($GLOBALS['v_debug']){printf("<br>DEBUG:parametrien tarkistus url_str(), %s, %s, %s", $url, $script, $method);}	
	  if ($method == "POST") {
	  	# not ilmplemedted
	  }


	  if ($method == "GET") {
		switch ($script) {

		# $t_parametri = "";

		  case "etsi.php":
		 
			if (isset($_GET["nimi"])) {
			  $parametri="";
			  $parametri = $_GET["nimi"];
			  if (self::parametri_tarkistus($parametri, 2, 50, 5) == 1 ) {
			  	 return $parametri;
				# $t_parametri = $t_parametri + "nimi;"+$parametri;
			  }	  
		       }

		       if (isset($_GET["issn"])) {
			  $parametri="";
                          $parametri = $_GET["issn"];
                          if (self::parametri_tarkistus($parametri, 2, 10, 5) == 1 ) {
                                 return $parametri;
                                # $t_parametri = $t_parametri + "nimi;"+$parametri;
                          }
                       }

		       if (isset($_GET["isbn"])) {
                          $parametri="";
                          $parametri = $_GET["isbn"];
                          if (self::parametri_tarkistus($parametri, 2, 20, 5) == 1 ) {
                                 return $parametri;
                                # $t_parametri = $t_parametri + "nimi;"+$parametri;
                          }
                       }

		       if (isset($_GET["lyhenne"])) {
                          $parametri="";
                          $parametri = $_GET["lyhenne"];
                          if (self::parametri_tarkistus($parametri, 2, 10, 2) == 1 ) {
                                 return $parametri;
                                # $t_parametri = $t_parametri + "nimi;"+$parametri;
                          }
                       }
	

		       # if (isset($_GET["tyyppi"])) {
                       #    $parametri="";
                       #    echo "bla";
                       #    $parametri = $_GET["tyyppi"];
                       #    if (self::parametri_tarkistus($parametri, 1, 2) == 1 ) {
                       #          # return $parametri;
                       #          # $t_parametri = $t_parametri + "nimi;"+$parametri;
                       #    }
                       #  }

			/*
			 if (isset($_GET["type"])) {
                          $parametri = $_GET["type"];
                          if (self::parametri_tarkistus($parametri, 1, 2) == 1 ) {
                                return $parametri;
                                # $t_parametri = $t_parametri + "nimi;"+$parametri;
                          }
			  else {
				$parametri = "";
                               return $parametri;
                          }
                        }

			
			  if (isset($_GET["issn"])) {
			    $parametri = $_GET["issn"];
			    if (self::parametri_tarkistus($parametri, 2, 10) == 1 ) {
				return $parametri;
				#  $t_parametri = $t_parametri + "issn;"+$parametri;
			  }	
			  else {
			  	$parametri = "";
				return $parametri;
			  }
			}
			*/

		  break;

		  case "kanava.php";
			# echo "<br>kanava.php";
			# echo "1";
		  	if (isset($_GET["id"])) {
			  # echo ",1A";
			  $parametri = $_GET["id"];
			  # echo "<br>$parametri";
			  if (self::parametri_tarkistus($parametri, 1, 9, 1) == 1 ) {
				# echo"<br>hmm";
				# printf("<br>%s",$parametri);
			  	return $parametri;
			  }
			}	
			  # echo ",2";
			  if (isset($_GET["test"])) {
				# echo "test";
			  	$parametri = $_GET["test"];
                           	if (self::parametri_tarkistus($parametri, 2, 500, 5) == 1 ) {
                                # echo"<br>test ok";
                                # printf("<br>%s",$parametri);
                                return $parametri;

			  }
			} else {
				# echo "fallback";
			   	$parametri = "";
                                return $parametri;
                           }
		     	
		  break;
	  	}

		# return $t_parametri
	  }

	}
	
  }


?>
