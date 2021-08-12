<?php  
/*
$hae_julkaisunkanvan_tiedot="SELECT Jufo_ID, Level, Name, Abbreviation, Other_Title, Title_Details, ISSNL, ISSN1, ISSN2, ISBN, Continues, Continued_by, Type, Field, Subfield, Website, Country, Publisher, Language, Year_Start, Year_End, Active, Norway_Level, Denmark_Level, SJR_SJR, SNIP, IPP, DOAJ_Index, Sherpa_Romeo_Code, CreatedAt, ModifiedAt, Active_Binary, Predator, Jufo_2012, Jufo_2013, Jufo_2014, Jufo_2015, Fields, Scientific, Professional, Substitutive_Channel, Grounds_Removal FROM Publications LIMIT 10";
*/

# Haetaan  tiedot esivalmistelu 
$kanava_hae_jkanava_pre1="select Fields from Publications where jufo_id = %PARAM1%";


$hae_julkaisunkanvan_tiedot="SELECT IFNULL(Jufo_ID, '') as Jufo_ID, IFNULL(Level, '') as Level ,IFNULL(Name, '') as Name, IFNULL(Abbreviation, '') as Abbreviation, IFNULL(Other_Title, '') as Other_Title, IFNULL(Title_Details, '') as Title_Details, IFNULL(ISSNL, '') as ISSNL, IFNULL(ISSN1, '') as ISSN1, IFNULL(ISSN2, '') as ISSN2, IFNULL(ISBN, '') as ISBN, IFNULL(Continues, '') as Continues, IFNULL(Continued_by, '') as Continued_by, IFNULL(Type, '') as Type, IFNULL(Field, '') as Field, IFNULL(Subfield, '') as Subfield, IFNULL(Website, '') as Website ,IFNULL(Country, '') as Country, IFNULL(Publisher, '') as Publisher, IFNULL(Language, '') as Language, IFNULL(Year_Start, '') as Year_Start, IFNULL(Year_End, '') as Year_End, IFNULL(Active, '') as Active, IFNULL(Norway_Level, '') as Norway_Level, IFNULL(Denmark_Level, '') as Denmark_Level, IFNULL(SJR_SJR, '') as SJR_SJR, IFNULL(SNIP, '') as  SNIP, IFNULL(IPP, '') as IPP, IFNULL(DOAJ_Index, '') as DOAJ_Index, IFNULL(Sherpa_Romeo_Code, '') as Sherpa_Romeo_Code, IFNULL(CreatedAt, '') as CreatedAt, IFNULL(ModifiedAt, '') as ModifiedAt, IFNULL(Active_Binary, '') as Active_Binary ,IFNULL(Predator, '') as Predator,IFNULL(Jufo_2012, '') as Jufo_2012, IFNULL(Jufo_2013, '') as Jufo_2013, IFNULL(Jufo_2014, '') as Jufo_2014, IFNULL(Jufo_2015, '') as Jufo_2015, IFNULL(Fields, '') as Fields, IFNULL(Scientific, '') as Scientific, IFNULL(Professional, '') as Professional, IFNULL(Substitutive_Channel, '') as Substitutive_Channel, IFNULL(Grounds_Removal, '') as Grounds_Removal FROM Publications LIMIT 10;";


$kanava_hae_jkanava="SELECT IFNULL(p.Jufo_ID, '') as Jufo_ID, IFNULL(p.Level, '') as Level ,IFNULL(p.Name, '') as Name, IFNULL(p.Abbreviation, '') as Abbreviation, IFNULL(p.Other_Title, '') as Other_Title, IFNULL(p.Title_Details, '') as Title_Details, IFNULL(p.ISSNL, '') as ISSNL, IFNULL(p.ISSN1, '') as ISSN1, IFNULL(p.ISSN2, '') as ISSN2, IFNULL(p.ISBN, '') as ISBN, IFNULL(p.Continues, '') as Continues, IFNULL(p.Continued_by, '') as Continued_by, IFNULL(p.Type, '') as Type, IFNULL(p.Field, '') as Field, IFNULL(p.Subfield, '') as Subfield, IFNULL(p.Website, '') as Website ,IFNULL(p.Country, '') as Country, IFNULL(p.Publisher, '') as Publisher, IFNULL(p.Language, '') as Language, IFNULL(p.Year_Start, '') as Year_Start, IFNULL(p.Year_End, '') as Year_End, IFNULL(p.Active, '') as Active, IFNULL(p.Norway_Level, '') as Norway_Level, IFNULL(p.Denmark_Level, '') as Denmark_Level, IFNULL(p.SJR_SJR, '') as SJR_SJR, IFNULL(p.SNIP, '') as  SNIP, IFNULL(p.IPP, '') as IPP, IFNULL(p.DOAJ_Index, '') as DOAJ_Index, IFNULL(p.Sherpa_Romeo_Code, '') as Sherpa_Romeo_Code, IFNULL(p.CreatedAt, '') as CreatedAt, IFNULL(p.ModifiedAt, '') as ModifiedAt, IFNULL(p.Active_Binary, '') as Active_Binary ,IFNULL(p.Predator, '') as Predator,IFNULL(p.Jufo_2012, '') as Jufo_2012, IFNULL(p.Jufo_2013, '') as Jufo_2013, IFNULL(p.Jufo_2014, '') as Jufo_2014, IFNULL(p.Jufo_2015, '') as Jufo_2015, group_concat(e.Name SEPARATOR '; ') as Fields, IFNULL(p.Scientific, '') as Scientific, IFNULL(p.Professional, '') as Professional, IFNULL(p.Jufo_History, '') as Jufo_history, IFNULL(p.Substitutive_Channel, '') as Substitutive_Channel, IFNULL(p.Grounds_Removal, '') as Grounds_Removal FROM Publications p CROSS JOIN ExtEvaluationCategories e on e.Source_ID = 6 and e.id in (%PARAM2%)
WHERE p.jufo_ID = %PARAM1%;";


# Julkaisukanavan tiedot ilma tieteenaljo
$kanava_hae_jkanava_b="SELECT IFNULL(p.Jufo_ID, '') as Jufo_ID, IFNULL(p.Level, '') as Level ,IFNULL(p.Name, '') as Name, IFNULL(p.Abbreviation, '') as Abbreviation, IFNULL(p.Other_Title, '') as Other_Title, IFNULL(p.Title_Details, '') as Title_Details, IFNULL(p.ISSNL, '') as ISSNL, IFNULL(p.ISSN1, '') as ISSN1, IFNULL(p.ISSN2, '') as ISSN2, IFNULL(p.ISBN, '') as ISBN, IFNULL(p.Continues, '') as Continues, IFNULL(p.Continued_by, '') as Continued_by, IFNULL(p.Type, '') as Type, IFNULL(p.Field, '') as Field, IFNULL(p.Subfield, '') as Subfield, IFNULL(p.Website, '') as Website ,IFNULL(p.Country, '') as Country, IFNULL(p.Publisher, '') as Publisher, IFNULL(p.Language, '') as Language, IFNULL(p.Year_Start, '') as Year_Start, IFNULL(p.Year_End, '') as Year_End, IFNULL(p.Active, '') as Active, IFNULL(p.Norway_Level, '') as Norway_Level, IFNULL(p.Denmark_Level, '') as Denmark_Level, IFNULL(p.SJR_SJR, '') as SJR_SJR, IFNULL(p.SNIP, '') as  SNIP, IFNULL(p.IPP, '') as IPP, IFNULL(p.DOAJ_Index, '') as DOAJ_Index, IFNULL(p.Sherpa_Romeo_Code, '') as Sherpa_Romeo_Code, IFNULL(p.CreatedAt, '') as CreatedAt, IFNULL(p.ModifiedAt, '') as ModifiedAt, IFNULL(p.Active_Binary, '') as Active_Binary ,IFNULL(p.Predator, '') as Predator,IFNULL(p.Jufo_2012, '') as Jufo_2012, IFNULL(p.Jufo_2013, '') as Jufo_2013, IFNULL(p.Jufo_2014, '') as Jufo_2014, IFNULL(p.Jufo_2015, '') as Jufo_2015, '' as Fields, IFNULL(p.Scientific, '') as Scientific, IFNULL(p.Professional, '') as Professional, IFNULL(p.Jufo_History, '') as Jufo_history, IFNULL(p.Substitutive_Channel, '') as Substitutive_Channel, IFNULL(p.Grounds_Removal, '') as Grounds_Removal FROM Publications p WHERE p.jufo_ID = %PARAM1%;";



$kanava_etsi_jkanava="select IFNULL(jufo_id, '') as Jufo_ID, concat('%PARAM1%', IFNULL(jufo_id, '')) as Link, IFNULL(name, '') as Name, IFNULL(Type, '') as Type from Publications where Type = '%PARAM3%' and name like '%%PARAM2%%';";


$kanava_etsi_jkanava_issn="select IFNULL(jufo_id, '') as Jufo_ID,  concat('%PARAM1%', IFNULL(jufo_id, '')) as Link, IFNULL(name, '') as Name, IFNULL(Type, '') as Type from Publications where Type = '%PARAM3%' and issn1 like '%%PARAM2%%' or issn2 like '%%PARAM2%%';";


$kanava_etsi_jkanava_isbn="select IFNULL(jufo_id, '') as Jufo_ID,  concat('%PARAM1%', IFNULL(jufo_id, '')) as Link, IFNULL(name, '') as Name, IFNULL(Type, '') as Type from Publications where Type = '%PARAM3%' and isbn like '%%PARAM2%%';";


$kanava_etsi_jkanava_lyhenne="select IFNULL(jufo_id, '') as Jufo_ID,  concat('%PARAM1%', IFNULL(jufo_id, '')) as Link, IFNULL(name, '') as Name, IFNULL(Type, '') as Type from Publications where Type = '%PARAM3%' and Abbreviation like '%PARAM2%%';";




?>
