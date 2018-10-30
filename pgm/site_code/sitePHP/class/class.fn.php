<?php
global $popup;
function convertColor($color) {
    #convert hexadecimal to RGB
    if (!is_array($color) && preg_match("/^[#]([0-9a-fA-F]{6})$/", $color)) {

        $hex_R = substr($color, 1, 2);
        $hex_G = substr($color, 3, 2);
        $hex_B = substr($color, 5, 2);
        $RGB = hexdec($hex_R) . "," . hexdec($hex_G) . "," . hexdec($hex_B);

        return $RGB;
    }

    #convert RGB to hexadecimal
    else {
        if (!is_array($color)) {
            $color = explode(",", $color);
        }

        foreach ($color as $value) {
            $hex_value = dechex($value);
            if (strlen($hex_value) < 2) {
                $hex_value = "0" . $hex_value;
            }
            $hex_RGB.=$hex_value;
        }

        return $hex_RGB;
    }
}

function luminColor($color, $pc = 10) {
    if (!is_array($color) && preg_match("/^[#]([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})$/", $color, $r)) {

        $hex_R = $r[1];
        $hex_G = $r[2];
        $hex_B = $r[3];
        // echo $color." - ".$hex_R."".$hex_G."".$hex_B;
        $dec_R = hexdec($hex_R) + $pc;
        $dec_G = hexdec($hex_G) + $pc;
        $dec_B = hexdec($hex_B) + $pc;

        if ($dec_R > 255)
            $dec_R = 255;
        if ($dec_G > 255)
            $dec_G = 255;
        if ($dec_B > 255)
            $dec_B = 255;

        $dec_R = dechex($dec_R);
        $dec_G = dechex($dec_G);
        $dec_B = dechex($dec_B);

        if (strlen($dec_R) == 1)
            $dec_R = "0" . $dec_R;
        if (strlen($dec_G) == 1)
            $dec_G = "0" . $dec_G;
        if (strlen($dec_B) == 1)
            $dec_B = "0" . $dec_B;

        return $dec_R . $dec_G . $dec_B;
    }
}

function darkColor($color, $pc = 10) {
    if (!is_array($color) && preg_match("/^[#]([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})$/", $color, $r)) {

        $hex_R = $r[1];
        $hex_G = $r[2];
        $hex_B = $r[3];

        $dec_R = hexdec($hex_R) - $pc;
        $dec_G = hexdec($hex_G) - $pc;
        $dec_B = hexdec($hex_B) - $pc;

        if ($dec_R < 0)
            $dec_R = 0;
        if ($dec_G < 0)
            $dec_G = 0;
        if ($dec_B < 0)
            $dec_B = 0;

        $dec_R = dechex($dec_R);
        $dec_G = dechex($dec_G);
        $dec_B = dechex($dec_B);

        if (strlen($dec_R) == 1)
            $dec_R = "0" . $dec_R;
        if (strlen($dec_G) == 1)
            $dec_G = "0" . $dec_G;
        if (strlen($dec_B) == 1)
            $dec_B = "0" . $dec_B;

        return $dec_R . $dec_G . $dec_B;
    }
}

function isIE() {
    if (preg_match('/(?i)msie [8]/i', $_SERVER['HTTP_USER_AGENT'])) {
        return 1;
    }
    if (preg_match('/(?i)msie [9]/i', $_SERVER['HTTP_USER_AGENT'])) {
        return 3;
    } elseif (preg_match('/(?i)msie [2-7]/i', $_SERVER['HTTP_USER_AGENT'])) {
        return 2;
    } else
        return 0;
}

function utf8($array, $ty = "") {
    foreach ($array as $key => $a) {
        foreach ($a as $key => $val) {
            if (is_array($val))
                $array->$key = utf8($val);

            $array->$key = utf8_decode($val);
        }
    }
    return $array;
}

function car($txt, $t = "") {
    $c = $txt;

    if (preg_match("/utf8/", $t)) {
        $c = utf8_encode($c);
    }

    if (preg_match("/html/", $t)) {
        $c = html_entity_decode($c);
    }
    if (preg_match("/é/", $t)) {
        $c = str_replace(array("é", "è", "ê", "ô", "î", "â", "û", "ù", "ç", "&eacute;", "'"), array("e", "e", "e", "o", "i", "a", "u", "u", "c", "e", ""), $c);
    }
    if (preg_match("/up/", $t)) {
        $c = str_replace("é", "É", $c);
        $c = strtoupper($c);
        $t .="é";
    }
    if (preg_match("/low/", $t)) {

        $c = strtolower($c);
    }

    if (preg_match("/\-/", $t))
        $c = str_replace(" ", "-", $c);

	//Version 1.3
	if (preg_match("/slash/", $t))
        $c = str_replace("/", "-", $c);

    if (preg_match("/\_/", $t))
        $c = str_replace("-", "", $c);

    if (preg_match("/\'/", $t))
        $c = str_replace("'", "", $c);
	
	if (preg_match("/\"/", $t))
		 $c = str_replace("\"", "", $c);



    return $c;
}

function mobile() {
    if (empty($_GET["m"])) {
        $user = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match("#(Android)|(iPhone)|(BlackBerry)|(iPad)|(webOS)#", $user))
            return true;
    }
    return false;
}

function flusRSS() {
    global $C_bien;
    global $agence;
    global $url;

    $b = $C_bien->getLoadBien();

    $bienDate = array();

    for ($i = 0; $i <= sizeof($b) - 1; $i++) {
        $bienDate[$i] = $b[$i]->date_modif;
    }

    arsort($bienDate);

    $rss = '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
	<channel>
		<title>' . $agence->nom_agence . '</title>
		<link>http://' . $url . '</link>
		<description>' . utf8_encode(html_entity_decode('Tout l\'immobilier m&eacute;r&eacute;ville avec l\'agence immobili&egrave;re ' . $agence->nom_agence . ' : Vente et achat immobilier &agrave; Autruy sur juine et ses env')) . '</description>';

    foreach ($bienDate as $i => $val) {
        global $dir;

        $bien_aff = $b[$i];

        $C_bien->setBienByPos($i);

        if ($C_bien->getPrix(true) != "" && !$C_bien->isVendu()) {

            $prix = $C_bien->getPrix(true) . " Euro;";
            $secteur = ($C_bien->getLocalisation(false));
            $description = ($C_bien->getDescription());
            $title = ucfirst($C_bien->getTypeBien()) . " - " . $C_bien->getLocalisation() . " - " . $prix;
            $url = "http://" . $_SERVER['HTTP_HOST'] . "" . $dir . "/#!/annonce-immobiliere-" . car($C_bien->getReference(), "low-é") . "/";
            $image = "http://" . $_SERVER['HTTP_HOST'] . "" . $dir . "/" . $C_bien->getImages()->image_1;

            $desc = $description;
            $desc = str_replace(array("<br />", "<b>", "</b>"), array("", ""), html_entity_decode($desc));
            $date = date("r", mktime("12", "0", "0", substr($bien_aff->date_modif, 4, 2), substr($bien_aff->date_modif, 6, 2), substr($bien_aff->date_modif, 0, 4)));

            $rss .= '
		<item>
			<title>' . utf8_encode(html_entity_decode($title)) . '</title>
			<link>' . $url . '</link>
			<guid isPermaLink="false">' . $bien_aff->idbien . '</guid>
			<description>' . ($desc) . '</description>
			<pubDate>' . $date . '</pubDate>
			<image>
				<url>' . $image . '</url>
				<link>http://' . $_SERVER['HTTP_HOST'] . '</link>
			</image>
		</item>
';
        }
    }
    $rss .= '
	</channel>
</rss>';


    $rss = str_replace("&", "&amp;", $rss);

    file_put_contents("./fluxrss.xml", $rss);
}

function siteMap() {
    global $dir;
    global $C_bien;
    global $C_page;
    global $showVille;

    $b = $C_bien->getLoadBien();

    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>
	<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
';
    // Ajout du sitemap de la page principale
    $sitemap .= '
	<url>
		<loc>http://' . $_SERVER['HTTP_HOST'] . '/' . $dir . '/</loc>
		<changefreq>weekly</changefreq>
	</url>
';
    // Génération du sitemap pour la liste des biens
    $listVille = $showVille ? "ville" : "secteur";
    foreach ($C_bien->getAllLocalisation() as $ville) {
        $url = 'http://' . $_SERVER['HTTP_HOST'] . '' . $dir . '/#!/annonces-immobilieres-' . car($ville, "low-é") . '-' . $listVille . '/';

        $sitemap .= '
	<url>
		<loc>' . $url . '</loc>
		<changefreq>weekly</changefreq>
	</url>
';
    }
    // Génération du sitemap pour les page supplémentaire
    foreach ($C_page->getPages() as $val) {
        $C_page->setPageSelect($val);
        $url = 'http://' . $_SERVER['HTTP_HOST'] . '' . $dir . '/#!/page-' . $C_page->getType() . '-' . car($C_page->getTitre(), "élow-") . '/';

        $sitemap .= '
	<url>
		<loc>' . $url . '</loc>
	</url>
';
    }
    // Génération du sitemap pour les biens
    for ($i = 0; $i <= sizeof($b) - 1; $i++) {
        $C_bien->setBienByPos($i);
        if ($C_bien->existPosBien($i)) {
            $url = "http://" . $_SERVER['HTTP_HOST'] . "" . $dir . "/#!/annonce-immobiliere-list-" . car($C_bien->getTypeBien(), "low-é") . "-" . car($C_bien->getLocalisation(false), "low-é") . "-" . $i . "/";
            $date = substr($b[$i]->date_modif, 0, 4) . '-' . substr($b[$i]->date_modif, 4, 2) . '-' . substr($b[$i]->date_modif, 6, 2);

            $sitemap .= '<url>
		<loc>' . $url . '</loc>
		<lastmod>' . $date . '</lastmod>
		<changefreq>weekly</changefreq>
	</url>';
        }
    }

    $sitemap .= '</urlset>';

    file_put_contents("./sitemap.xml", $sitemap);
}

function getUrl($type, $value = "") {
    global $agence;
    global $C_bien;
    global $C_page;
    global $referenceAgence;
    global $referenceVille;

    switch ($type) {
        case "accueil" :
        case "contact" :
        case "presentation" :
            $url = $type . "-agence-immobiliere-" . $referenceAgence . "-" . $referenceVille . ".html";
            break;
        case "page" :
            $C_page->setPageSelect($value);
            $url = "page-" . car($C_page->getTitre(), "lowé-") . ".html";
            break;
        case "annonces" :
            $url = "annonces-immobilieres-" . $referenceVille . ".html";
            break;
        case "coupsdecoeur" :
            $C_bien->setBienByPos($value);
            $url = "annonce-coupsdecoeur-" . car($C_bien->getTypeBien(), "low-é") . "-" . car($C_bien->getLocalisation(false), "lowé-slash") . "-" . $value . ".html#!" . car($C_bien->getReference(), "low-é");
            break;
        case "annonce" :
            $C_bien->setBienByPos($value);
            $url = "annonce-immobiliere-" . car($C_bien->getTypeBien(), "low-é") . "-" . car($C_bien->getLocalisation(false), "lowé-") . "-" . $value . ".html";

            $param = $C_bien->getParam();
            $url .= "?";
            foreach ($param as $t => $p) {
                $url .= $t . "=" . $p . "&";
            }

            $url .= "#!" . car($C_bien->getReference(), "low-é");

            break;
        case "iframe" :
            $url = "pages-agence-immobiliere-" . $referenceAgence . "-" . $referenceVille . "-" . $value . ".html";
            break;
		case "admin" :
			$url = "page-administration-" . $referenceAgence . ".html";
    }

    return $url;
}

function isHome() {
    if (empty($_GET["p"]))
        return true;
    return false;
}

function isCdc() {
    if ($_GET["cdc"] == "1")
        return true;
    return false;
}

function getOG($type = "business") {
    global $C_bien;
    global $agence;
    global $titrePage;
    global $dir;
    global $logo;

    if ($type == "business") {
        $html = '
			<meta property="og:title" content="' . $titrePage . '"/>
			<meta property="og:url" content="http://' . $_SERVER['HTTP_HOST'] . '' . $_SERVER['REQUEST_URI'] . '"/>
			<meta property="og:image" content="http://' . $_SERVER['HTTP_HOST'] . '/' . $dir . '/' . $logo . '"/>
			<meta property="og:type" content="business.business"/>
			<meta property="og:site_name" content="' . $agence->nom_agence . '"/>
			<meta property="og:description" content="' . car(html_entity_decode($agence->description_agence),"utf8") . '"/>
			<meta property="business:contact_data:street_address" content="' . $agence->adresse_agence . '" /> 
			<meta property="business:contact_data:locality"       content="' . $agence->ville_agence . '" /> 
			<meta property="business:contact_data:postal_code"    content="' . $agence->code_postal_agence . '" /> 
			<meta property="business:contact_data:country_name"   content="' . $agence->nom_pays_agence . '" />
			';
        return $html;
    }

    if ($type == "product") {
        $html = '
			<meta property="og:title" content="' . $titrePage . '"/>
			<meta property="og:url" content="http://' . $_SERVER['HTTP_HOST'] . '' . $_SERVER['REQUEST_URI'] . '"/>
			<meta property="og:image" content="http://' . $_SERVER['HTTP_HOST'] . '/' . $dir . '/' . $C_bien->getImagePrinc() . '"/>
			<meta property="og:type" content="product"/>
			<meta property="og:description" content="' . $C_bien->getDescription() . '"/>
			<meta property="og:site_name" content="' . $agence->nom_agence . '"/>
			';
        return $html;
    }
}

function isDark($color) {
    $dec = hexdec($color);
    if ($dec >= 10066329) {
        return false;
    }
    return true;
}

function White($color) {
    $dec = hexdec($color);
    if ($dec >= "16777000") {
        return "333333";
    }
    return "FFFFFF";
}

function UploadImage($imagetext = "",$image){
		switch($imagetext){
			case "Home" : 
			$nom_final = "img/bg_recherche.jpg";
			break;
			case "Annonces" : 
			$nom_final = "img/bg_annonces.jpg";
			break;
			case "Page" : 
			$nom_final = "img/bg_presentation.jpg";
			break;
			case "HomeYvo1" : 
			$nom_final =  "1.jpg";
			break;
			case "HomeYvo2" : 
			$nom_final =  "2.jpg";
			break;
			case "HomeYvo3" : 
			$nom_final =  "3.jpg";
			break;
			case "HomeYvo4" : 
			$nom_final =  "4.jpg";
			break;
			case "HomeYvo5" : 
			$nom_final =  "5.jpg";
			break;
			case "HomeYvo6" : 
			$nom_final =  "6.jpg";
			break;
			case "HomeYvo7" : 
			$nom_final =  "7.jpg";
			break;
			case "HomeYvo8" : 
			$nom_final =  "8.jpg";
			break;
			case "HomeYvo9" : 
			$nom_final =  "9.jpg";
			break;
			default :
			$nom_final = "test.jpg";
			break;
		}
		
		
		if ($image['error'] == UPLOAD_ERR_OK) {
			
			$nom = basename($image['name']);
			$tmp_nom = $image["tmp_name"];
			$extension = strtolower(substr(strrchr($image['name'], '.'),1));
			if (exif_imagetype($tmp_nom) != false){
				while (file_exists("../../img/".$nom)){
					$nom = uniqid().".".$extension;
				}
				if (move_uploaded_file($tmp_nom,"../../img/".car($nom,"lowé-_")) == false)
					echo "<br/>Une erreur est survenue lors de l'import de votre fichier";
				else
						$nom_final = "./img/".car($nom,"lowé-_");
				}
				else {
					//echo "<br/>Votre fichier n'est pas de type image";
				}
		}
		
	return $nom_final;
}



	

?>