
  /*
   * Julkaisukanvatietokannan REST-rajapinnan toiminnallisuuden demo
   * (c) CSC by R. R: 2015
   */ 



  var ar_results = new Array();
  var linkki;
  var v_tyyppi = "&tyyppi=1";
  var v_haku = "?nimi=";

  /*
   * Ennakkohaun (Syöttökenttä) toiminnallisuus
   */ 

  $(function() {
  $("#jnimi").autocomplete({
        source: function (request, response) {
          $.ajax({
        url: 'https://jufo-rest.csc.fi/v1.0/etsi.php'+v_haku+request.term+v_tyyppi,
        data: {
          format: 'json'
        },
        error: function(e) {
          $("#msgid").html("This is Error function by JQuery: "+e);
        },
        datatype: 'json',
        success: function (data) {
                var ar_name = new Array();
                for (var i in data) {
                        var t_ar = $.each(data[i],function (index, value) {
                        return index, value
                        });

                        ar_name.push(t_ar.Name);

                        obj_result = new Object;

			obj_result['Jufo_ID'] = t_ar.Jufo_ID;
                        obj_result['Link'] = t_ar.Link;
                        obj_result['Name'] = t_ar.Name;
                        obj_result['Type'] = t_ar.Type;

                        ar_results.push(obj_result);

                }
                console.log(ar_name);
                response(ar_name);

           },
        type: 'GET',
        crossDomain: true,

    });

        },
        select: function (event, ui) {

            $("#msgid").html("<b>Valitsit: </b>"+ui['item'].value);

                console.log(ui['item'].value);
                console.log(ar_results);

                linkki = "";
                for (x in ar_results) {
                        console.log(ar_results[x].Name);
                        if (ar_results[x].Name == ui['item'].value) {
                                linkki = ar_results[x].Link;
                        }
                }

                console.log(linkki);

                tee_kutsu(linkki);
        },
        minLength: 5,
        delay: 100

		  });
  });

  /*
   * Alasvetovalikon arvojen hallinta
   */ 

  $(function() {
  $(".dropdown-menu li a").click(function() {
        var selText = $(this).text();
        $(this).parents('.dropdown').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
        console.log("dropdown: "+selText);
        if (selText == "Lehti/Sarja") {
          v_tyyppi = "&tyyppi=1";
          }
          else if (selText == "Kirjakustantaja") {
            v_tyyppi = "&tyyppi=2";
            }
            else if  (selText == "Konfferenssi"){
             v_tyyppi = "&tyyppi=3";
            }

        if (selText == "nimi") {
          v_haku = "?nimi=";
          }
          else if (selText == "issn") {
            v_haku = "?issn=";
            }
            else if  (selText == "isbn"){
             v_haku = "?isbn=";
            }
	    else if  (selText == "lyhenne"){
             v_haku = "?lyhenne=";
            }


  });
  });

  /*
   * Julkaisukanavatietojen haku - AJAX kutsu
   */ 

   function tee_kutsu(v_url) {
    $.ajax({
                url: v_url,
                data: {
                   format: 'json'
                },
                error: function(e) {
                    $("#msgid").html("This is Error function by JQuery: "+e);
                },
                datatype: 'json',
                success: populoi_formi,
                type: 'GET',
                crossDomain: true,
    });

  }


 /*
  * "Uusi haku" -painikkeen toiminnalisuus
  */


  function resetoi_lomake() {
     $('#demo')[0].reset();
     location.reload();
  }
     
	
  /*
   * Haetaan julkaisukanavan tiedot
   */ 

  function populoi_formi(response) {

     var frm = $("#demo");
     var i;

     for (i in response) {

                var t_taulu = $.each(response[i], function(index, value) {
                return index,value;
        });

    var fit = t_taulu.Field + " / " + t_taulu.Subfield;
        console.log("<br>Jufo_ID:"+t_taulu.Jufo_ID);


        $("#Jufo_ID").html(t_taulu.Jufo_ID);
        $("#Level").html(t_taulu.Level);
        $("#Name").html(t_taulu.Name);
        $("#Abbreviation").html(t_taulu.Abbreviation);
        $("#Other_Title").html(t_taulu.Other_Title);
        $("#Title_Details").html(t_taulu.Title_Details);
        $("#ISSNL").html(t_taulu.ISSNL);
        $("#ISSN1").html(t_taulu.ISSN1);
        $("#ISSN2").html(t_taulu.ISSN2);
        $("#ISBN").html(t_taulu.ISBN);
        $("#Continues").html(t_taulu.Continues);
        $("#Continued_by").html(t_taulu.Continued_by);
        $("#Type").html(t_taulu.Type);
        $("#Website").html(t_taulu.Website);
        $("#Country").html(t_taulu.Country);
        $("#Publisher").html(t_taulu.Publisher);
        $("#Language").html(t_taulu.Language);
        $("#Year_Start").html(t_taulu.Year_Start);
        $("#Year_End").html(t_taulu.Year_End);
        $("#Active").html(t_taulu.Active);
        $("#Norway_Level").html(t_taulu.Norway_Level);
        $("#Denmark_Level").html(t_taulu.Denmark_Level);
        $("#SJR_SJR").html(t_taulu.SJR_SJR);
        $("#SNIP").html(t_taulu.SNIP);
        $("#IPP").html(t_taulu.IPP);
        $("#DOAJ_Index").html(t_taulu.DOAJ_Index);
        $("#Sherpa_Romeo_Code").html(t_taulu.Sherpa_Romeo_Code);
        $("#CreatedAt").html(t_taulu.CreatedAt);
        $("#ModifiedAt").html(t_taulu.ModifiedAt);
        $("#Active_Binary").html(t_taulu.Active_Binary);
        $("#Predator").html(t_taulu.Predator);
        $("#Jufo_2012").html(t_taulu.Jufo_2012);
        $("#Jufo_2013").html(t_taulu.Jufo_2013);
        $("#Jufo_2014").html(t_taulu.Jufo_2014);
        $("#Jufo_2015").html(t_taulu.Jufo_2015);
        $("#Fields").html(t_taulu.Fields);
        $("#Scientific").html(t_taulu.Scientific);
        $("#Professional").html(t_taulu.Professional);


      }
  }

 /*
  * Kaikki OK asetaan otsikko
  */

  $(document).ready(function(){
        $("#msgid").html("<b>Julkaisukanavan REST-rajapinta demo</b>");
  });

  
		
		
