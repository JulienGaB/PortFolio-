<?php
	session_start();
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Fichier de configuration à ne pas ecraser
	// Version 1.3	
	//
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	
	require_once("page/administration/save.php");
	
	
	
	$modele = "Doris";
	$_SESSION["modele"] = $modele;
	// Modification Logo
	$logo = "img/logo.png";
	//$color1 = file_get_contents("config.txt");
	
	/*********** MAJ page Administration ********/
	$color1 = $color;
	
	/*print_r($color);
	var_dump($color);*/
    // Modification du style (couleur)
    //$color1 = $color; // couleur principal du site
	$color1RGB = convertColor("#".$color1);
	$color1D = darkColor("#".$color1,20); // couleur pour le hover des boutons
	$color1L = darkColor("#".$color1,250); // couleur pour le texte des bouton hover/actif des menu
    $color1C = darkColor('#'.$color1,-100); // Couleur pour la barre vertical droite
    $color1RGBC = convertColor("#".$color1C); //RGB de color1C
	$color1DRGB = convertColor("#".$color1D);
	// $color2 = "F6B068";
	$coltxt1 = $colortexte;// Choisir une couleur claire pour les textes
	//$coltxt2 = "333333"; // Choisir une couleur foncée pour les texte
	$txtshad = true;		
	// Affichage des villes 
	$showVille = $showville;
	
	// Gestion des langues
	$multilang = false;
	
	//Gestion des images carrées ou rondes
	//$carre = false;
	
	// Popup d'entrée
	$popup = false;
	$today = date("d.m.y");
	// Gestion twiter fb
	$bloc["header"]["fb"] = $facebook;
	$bloc["header"]["twt"] = $twitter;
	$bloc["header"]["over"] = "";
	$bloc["header"]["google"] = $google;
	$bloc["header"]["yt"] = $youtube;
	$bloc["header"]["linkedin"] = $linkedin;
	
	// Gestion filtre supplémentaires
	$filtreSup = array(
					array(	"titre"=>"Viager", 	// Titre du bouton
							"replace"=>"v:",	// Remplace le filtre (optionnel)
							"ref"=>"V",			// Lettre utilisé pour identifier
							"filtre"=>"vi",		// Filtre utilisé dans le data-filtre
							"active"=>false,	// Activé par défault
							"show"=>false		// affiché par défault
						)
					);
	
	$bloc["filtre"]["nb_piece"] = true;
	$bloc["filtre"]["nb_chambre"] = false;
	$dir = "Doris";
	
	$analytics = false; // false ou "CODE UTILISATEUR GOOGLE ANALYTICS"
	if(@file(__DIR__ ."/../analytics.txt"))
		$analytics = true;
	
	$acceProprietaire = true;
	$admin = true;
	$formEstimation = false;
	if ($menu_estimation != ""){
		$formEstimation = $menu_estimation; // false ou "TITRE DU MENU"
	}
	
	$formAlertMail = false; // true ou false
	
	$showVendu = true;
	$textEdit = false;
	$whoEdit = array("1.txt");
	$mdpEdit = md5("@#a14847254"."MONMOTDEPASSE"."#|(([e15478#");
	
	//////////////////////////////////////////////////////////////////
	//			Configuration spécifique au modèle DORIS			//
	//////////////////////////////////////////////////////////////////
	$headerColor = $color1;

	$imageHome = "img/bg_recherche.jpg"; //1170x490
	$imageAnnonce = "img/bg_annonces.jpg"; //1170x490
	$imagePage = "img/bg_presentation.jpg";//1170x490
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////LIEN GOOGLE MAPS AGENCE
	$lien_googlemap="";
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	$bandeauUrl = "img/bandeau/Bandeau_";
	$url = $_SERVER['HTTP_HOST'];
	
	// Gestion des langues
	if($multilang)
	{	
		if(!empty($_SESSION["ml"]))
		{
			$lang = $_SESSION["ml"];
		}
		if(isset($_GET["en"])) 
		{
			$lang = "en";
			$_SESSION["ml"] = "en";
		}
		elseif(isset($_GET["de"])) 
		{
			$lang = "de";
			$_SESSION["ml"] = "de";
		}
		elseif(isset($_GET["fr"]))
		{
			$lang = "fr";
			$_SESSION["ml"] = "fr";
			session_destroy();
		}
		elseif(empty($_SESSION["ml"]))
		{
			$lang = "fr";
			$_SESSION["ml"] = "fr";
			session_destroy();
		}
	}
	else
	{
		$lang = "fr";
	}
	
	


	
	// Titres des blocs en page d'accueil
	$bloc["header"]["adresse"]  = false;
	$bloc["header"]["mobile"]   = true;
	$bloc["header"]["tel"] 	    = true;
	$bloc["header"]["email"]    = true;
	$bloc["contact"]["adresse"] = true;
	$bloc["contact"]["mobile"]  = true;
	$bloc["contact"]["tel"]	    = true;
	$bloc["contact"]["email"]   = true;
	
	$bloc["contact"]["fb"] = $bloc["header"]["fb"];
	$bloc["contact"]["twt"] = $bloc["header"]["twt"];
	$bloc["contact"]["over"] = $bloc["header"]["over"];
	$bloc["contact"]["google"] = $bloc["header"]["google"];
	$bloc["contact"]["yt"] = $bloc["header"]["yt"];
		
	$bloc["footer"]["adresse"] = true;
	$bloc["footer"]["mobile"]  = true;
	$bloc["footer"]["tel"]     = true;
	$bloc["footer"]["email"]   = true;
	$bloc["footer"]["horaire"] = true;
	
	// Détails des biens
	$detailBien = array(
				"detail"=> array(
						"nb_piece",
						"nb_chambre",
						"nb_place_parking",
						"nb_parking_exterieur",
						"etage",
						"nb_etage",
						"ascenseur",
						"terrasse",
						"surface_terrasse",
						"surface_jardin",
						"surface_habitable",
						"surface_constructible",
						"stationnement",
						"piscine",
						"climatisation",
						"acces_handicape",
						"proche_commodites",
						"type_chauffage",
						"tout_a_egout",
						"fausse_sceptique",
						"annee_construction",
						"etat_general",
						"standing",
						"edf",
						"gdf",
						"eau",
						"c_o_s",
						"neuf",
						"reference" 
							),
			"prestation"=>array(
						"ascenseur",
						"terrasse",
						"surface_terrasse",
						"piscine",
						"climatisation",
						"acces_handicape",
						"proche_commodites",
						"type_chauffage",
						"tout_a_egout",
						"fausse_sceptique",
						"etat_general",
						"standing",
						"edf",
						"gdf",
						"eau",
						"c_o_s",
					),
			"information" =>array(
						"nb_piece",
						"nb_chambre",
						"nb_place_parking",
						"nb_parking_exterieur",
						"etage",
						"nb_etage",
						"surface_jardin",
						"surface_habitable",
						"surface_constructible",
						"stationnement",
						"annee_construction",
						"neuf",
						"reference",
						"en_copropriete",
						"charge_prev",
						"nb_lots",
						"procedure_redressement_syndic",
					),
			"piece" =>array(
						"piece_1",
						"piece_2",
						"piece_3",
						"piece_4",
						"piece_5",
						"piece_6",
						"piece_7",
						"piece_8",
						"piece_9",
						"piece_10",
						"piece_11",
						"piece_12",
						"piece_13",
						"piece_14"
					)
				);
    
	$colortitre = $coltxt2;
	if($color1){
            $colortitre = $coltxt1;// Couleur des textes en fonction de la couleur de l'arrière_plan du site
        }
		
    $colortitrehover = $colortitre; 
	
	//////////////////////////////////////////////////////////////////
	//			Configuration des mentions légales					//
	//////////////////////////////////////////////////////////////////
	
	
	$ndd = $_SERVER['HTTP_HOST'];
	//$raison = "nom de la société";
	//$siege = "adresse de la société";
	$capital = "5000";
	$devise	= "€";
	$RCS = "XXXXX rcs Valenciennes";
	$numcartepro = "XXXXXX";
	$siret = "XXXX";
	$responsablepub = "Nom du gérant";
	$mailres = "adresse mail";
	$tva = "num TVA";
	$telhebergeur = "08 203 203 63";
	//$telOVH = "+33 9 72 10 10 07";
	//////////////////////////////////////////////////////////////////
	//			Configuration de l'hébergeur						//
	//////////////////////////////////////////////////////////////////
	
		$ovh = "Ce site est hébergé par <b>OVH</b><br/>
		SAS au capital de 10 059 500 €<br/>
		RCS Lille Métropole 424 761 419 00045<br/>
		Code APE 6202A<br/>
		N° TVA : FR 22 424 761 419<br/>
		Siège social : 2 rue Kellermann – 59100 Roubaix – France.<br/>";
	
		$oneandone  = "<b>1&1 Internet SARL</b> <br/>
			7, place de la Gare <br/>
			BP 70109 <br/>
			57201 Sarreguemines Cedex<br/>
			SARL au capital de 100 000 EUR <br/>
			RCS Sarreguemines B 431 303 775 <br/>
			SIRET 431 303 775 000 16 <br/>
			Code APE : 6201Z <br/>
			Identification intracommunautaire FR 13 431303775 <br/>";

		$hebergeur = $oneandone;
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				
?>