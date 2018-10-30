<?php
	////////////////////////////////////////
	// version:1.2.1
	// maj:15-10-2015
	////////////////////////////////////////
	//error_reporting(0); Cache les warning et notices
	////////////////////////////////////////
	// Afficher les Erreurs PHP
	 //error_reporting(-1);
	 //	ini_set("display_errors", 1);
	////////////////////////////////////////
	
	$url = parse_url($_SERVER['REQUEST_URI']);
	parse_str($url["query"],$dataUrl);
	
	foreach($dataUrl as $k => $v)
	{
		if($k != "p")
		   $_GET[$k] = $v;
	}
	
	require_once("class/class.fn.php");
	//require_once("page/administration/admin.php");
	require_once("config.php");
	require_once("class/class.xml.php");
	require_once("class/class.getbien.php");
	require_once("class/class.page.php");
	require_once("class/class.trans.php");
	require_once("class/class.googlebot.php");
	require_once("page/administration/save.php");
	
	//////////////////////////////////////
	// 	Check Version mobile
	//////////////////////////////////////
	//if(mobile())
	//{
	//	header("location:./mobile/");
	//}
	
	$xml = new Class_XML;
	$C_bien = new Class_GetBien;
	
	// Récupération des donnée des biens
	$xml->load("base.xml");
	$xml->parse();
	$bien = $xml->getContentXML()->bien;
	
	// Chargement des données pour l'exploitation
	$C_bien->load($bien);
	
	// Test si il existe des biens vendu
	if($C_bien->hasVendu() && $showVendu)
	{
		$xml->load("BV_base.xml");
		$xml->parse();
		$BVbien = $xml->getContentXML()->bien;
		
		//Si les BV n'ont pas de prix 
		$BVbien = $C_bien->setValue($BVbien,"prix","rand");
		$C_bien->insert($BVbien,"prix");
	}
        
	// Récupération des donnée de l'agence
	$xml->load("info.xml");
	$xml->parse();
	$agence = $xml->getContentXML()->agence;
	$vedette = $xml->getContentXML()->bien;
	
	//Mise en place de la traduction
	$t = new Class_Translate;
	$t->load("txt.ini");
	$t->getText();
	
	// Gestion des pages supplémentaires 
	$xml->load("./page.xml");
	$xml->parse();
	$C_page = new Class_GetPage($xml->getContentXML()->agence);
	
	// Si c'est l'acceuil on charge les infos du bien vedette
	$vedettePosition = $C_bien->getPosBienByID($vedette->idbien);
	
	// Gestion du google bot
	$C_GGB = new Class_GoogleBot();
	
	$bienvenue=$t->t("text_bienvenue");
	/////////////////////////////////////////////////////////////////
	// Modification
	/////////////////////////////////////////////////////////////////
	$agence->nom_agence = car($agence->nom_agence,"html");
	
	/////////////////////////////////////////////////////////////////
	// REFERENCEMENT
	/////////////////////////////////////////////////////////////////
	$referenceAgence = car(str_replace("agence","",$agence->nom_agence),"low-é");
	$referenceVille  = car($agence->ville_agence,"low-é");
	$titleAgence     = car($agence->nom_agence);
	$titleVille      = car($agence->ville_agence);
	
	/////////////////////////////////////////////////////////////////
	// TITRE
	/////////////////////////////////////////////////////////////////
	$titreBase = ' | '.$titleAgence.' Agence Immobiliere '.$titleVille ;
		
	/////////////////////////////////////////////////////////////////
	
	$P = $_GET["p"];
	if(isIE() == 2 || isIE() == 1 || $_GET["ie"] == "1")
	{
		require_once("inc/ie.php");
		die();
	}
	if($P == "mod")
	{
		chdir("./page/alertemail/");
		require_once("getAlerte.php");
		die();
	}
	if($C_GGB->isGGB())
	{
		$P = 2;
		$_GET["ref"] = $C_GGB->getHash();
	}
	
	$keyword = $mots_cles;
	if ($mots_cles == "")
		$keyword = $titleAgence.",agence,immmobilier,".$titleVille.",vente,achat,appartement,maison";

	
	$description = $description_agence;
	if ($description_agence == "")
		$description = html_entity_decode($agence->description_agence);
	
	
	if ($page_presentation != ""){
		unlink("page/2.txt");
		$a = "<!--TITRE>".$menu_presentation."</TITRE-->\r\n".$page_presentation;
		file_put_contents("page/2.txt",$a);
	}
	
	
	
	
	if ($honoraires != ""){
		unlink("page/3.txt");
		$a = "<!--TITRE>Nos Honoraires</TITRE-->\r\n".$honoraires;
		file_put_contents("page/3.txt",$a);
	}
	

	
	switch($P)
	{
		case "" : 
			$menu = "accueil";
			$titrePage = "Accueil".$titreBase;
			require_once("inc/header.php");
			require_once("inc/index_form_accueil.php");
			require_once("page/index_accueil.php");
			require_once("inc/footer.php");
		break;
		
		case "1" :
			$menu = "annonces";
			$titrePage = "Annonces immobilières".$titreBase;
			$biens = $C_bien->getBiens();
			$param = $C_bien->getParam();
			require_once("inc/header.php");
			require_once("page/annonces.php");
			require_once("inc/footer.php");
		break;
		
		case "2" :
			if(!empty($_GET["ref"]))
			{
				$posid = $_GET["ref"]; //Correction 08/02/2017 Baptiste
				//$posid = $C_bien->getPosBienByRef($reference,true);
				$C_bien->setBienByPos($posid);
				if(isCdc())
				{
					$posNext = $C_bien->getNextCdc();
					$posPrev = $C_bien->getPrevCdc();
				}
				else
				{
					$posNext = $C_bien->getNextBien($posid);
					$posPrev = $C_bien->getPrevBien($posid);
				}	
				$C_bien->setBienByPos($posid);
			}
			$OG = getOG("product");
			$titrePage = $C_bien->getTypeBien()." ".$C_bien->getLocalisation(false)." ".$C_bien->getPrix(true)."€".$titreBase;
			$keyword .= ",".$C_bien->getTypeBien().",".$C_bien->getLocalisation(false);
			$description = car(html_entity_decode($C_bien->getDescription(),"\""));
			$param = $C_bien->getParam();
			$urlParam = "?t=".$param["t"]."&s=".$param["s"]."&v=".$param["v"]."&b=".$param["b"]."&p=".$param["p"]."&r=".$param["r"];
			require_once("inc/header.php");		
			require_once("page/bien.php");
			require_once("inc/footer.php");
		break;
		
		case "3" :
			$val = $C_page->getNameByTitle($_GET["title"]);
				if ($_GET["title"] == "2.txt" && $lang!="fr"){
					$file = "2_".$lang.".txt";
					$C_page->setName($file);
				}
				
			$C_page->setPageSelect($val);
			$valPage = $val;
			$menu = $C_page->getTitre();
			$titrePage = $C_page->getTitre().$titreBase;
			$keyword .= ",".$C_page->getTitre();
			require_once("inc/header.php");			
			require_once("page/page.php");
			require_once("inc/footer.php");
		break;
		
		case "4" :
			if(!empty($_POST))
			{
				include("inc/mail.submit.php");
			}
			else if(!empty($_GET["ref"]))
			{
				$reference = $_GET["ref"];
				$posid = $C_bien->getPosBienByRef($reference,true);
				$C_bien->setBienByPos($posid);
			}
			$menu = "contact";
			$titrePage = "Contact".$titreBase;
			$keyword .= ",contact";
			require_once("inc/header.php");
			require_once("page/contact.php");
			require_once("inc/footer.php");
		break;
		
		case "5" :
			$src = $_GET["src"];
			$srcIframe = "page/".$src."/".$src.".php";
			$menu = $src;
			require_once("inc/header.php");
			require_once("page/iframe.php");
			require_once("inc/footer.php");
		break;
		
		case "6" :
			$menu = "coupsdecoeurliste";
			$titrePage = "Coups de Coeur".$titreBase;
			$keyword .= ",cdc";
			require_once("inc/header.php");
			require_once("page/home2.php");
			require_once("inc/footer.php");
		break;
		
		case "7" :
			if(!empty($_GET["ref"]))
			{
				$reference = $_GET["ref"];
				$posid = $C_bien->getPosBienByRef($reference,true);
				$C_bien->setBienByPos($posid);
				if(isCdc())
				{
					$posNext = $C_bien->getNextCdc();
					$posPrev = $C_bien->getPrevCdc();
				}
				else
				{
					$posNext = $C_bien->getNextBien($posid);
					$posPrev = $C_bien->getPrevBien($posid);
				}	
				$C_bien->setBienByPos($posid);
			}
			$OG = getOG("product");
			$titrePage = $C_bien->getTypeBien()." ".$C_bien->getLocalisation(false)." ".$C_bien->getPrix(true)."€".$titreBase;
			$keyword .= ",".$C_bien->getTypeBien().",".$C_bien->getLocalisation(false);
			$description = car(html_entity_decode($C_bien->getDescription(),"\""));
			$param = $C_bien->getParam();
			$urlParam = "?t=".$param["t"]."&s=".$param["s"]."&v=".$param["v"]."&b=".$param["b"]."&p=".$param["p"]."&r=".$param["r"];
			require_once("inc/header.php");		
			require_once("page/bien.php");
			require_once("inc/footer.php");
		break;
		
		case "9" : 
			require_once("inc/header.php");		
			require_once("page/administration/login.php");
			require_once("inc/footer.php");
			break;
			
		default:
			$menu = "accueil";
			$titrePage = "Accueil".$titreBase;
			$keyword .= ",accueil";
			require_once("inc/header.php");
			require_once("page/home.php");
			require_once("inc/footer.php");
		break;
	}
	
	

	flusRSS();
	siteMap();
	
	if(@file("maj.appli.php"))
		include("maj.appli.php");
?>