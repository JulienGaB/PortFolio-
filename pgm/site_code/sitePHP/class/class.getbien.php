<?php

Class Class_GetBien
{
	private $bien;
	private $pos;
	private $data;
	private $nbBien;
	private $nbBienTrouve;
	private $param;
	
	function __construct($bien = "")
	{
		$this->pos = -1;
		if(!empty($bien))
			$this->bien = $bien;
	}
	public function load($bien)
	{
		if(!empty($bien))
			$this->bien = $bien;
		$this->nbBien = sizeof($this->bien);
		
	}
	public function getLoadBien()
	{
		return $this->bien;
	}
	public function insert($data,$col)
	{
		if($data[0]->$col != "")
		{
			$j = 0;
			$newArrayVal = array();
			
			for($i=0;$i<$this->nbBien;$i++)
			{
				if((int) $data[$j]->$col > 0)
				{
					if((int) $this->bien[$i]->$col >= (int) $data[$j]->$col && (int) $this->bien[$i+1]->$col >= (int) $data[$j]->$col)
					{
						$newArrayVal[] = $i;
						$i--;
						$j++;
					}
				}
				$a[$i] = $this->bien[$i];
			}
			
			$this->nbBien = $this->nbBien+sizeof($newArrayVal);
			
			$pos = 0;
			for($i=0;$i<$this->nbBien;$i++)
			{
				$k = array_search($i,$newArrayVal);
				// echo $k;
				if($k!== false)
				{
					$b[$i+$pos] = $data[$pos]; 
				 
					$pos++;
				
					array_splice($newArrayVal,$k,1);
			
					$i--;
					
					// echo $pos." ".$i;
				}
				else
					$b[$i+$pos] = $a[$i]; 
			}
			$this->bien = $b;
			
		}
	}
	public function setValue($data,$col,$set)
	{
		if(empty($data[0]->$col))
		{
			
			
			$new = array();
			for($i=0;$i<=sizeof($data)-1;$i++)
			{
				if($set == "rand")
					$val = rand(10,sizeof($BVbien)*10);
				else
					$val = $set;
					
				$data[$i]->$col = $val;
				$new[$i] = $data[$i];
			}
			return $new;
		}else
			return $data;
	}
	public function getPosBienByID($id)
	{
		$pos = 0;
		foreach($this->bien as $key => $val)
		{
			if((int) $val->idbien == (int) $id)
			{
				return $pos;
			}
			$pos++;
		}
	}
	public function getPosBienByRef($ref,$t = false)
	{
		$pos = 0;
		foreach($this->bien as $key => $val)
		{
			if(!$t)
			{
				if($val->reference == $ref)
				{
					return $pos;
				}
			}
			else
			{
				if(car($val->reference,"low_é-") == $ref)
				{
					return $pos;
				}
			}
			$pos++;
		}
		return -1;
	}
	public function getCdcs()
	{
		$pos = 0;
		$return = array();
		foreach($this->bien as $key => $val)
		{
			if($val->coups_de_coeur == "oui" && empty($val->avancement))
			{
				$return[] = $pos;
			}
			$pos++;
		}
		return $return;
	}
	public function getNextCdc()
	{
		$cdc = $this->getCdcs();
		foreach($cdc as $k=> $pos)
		{
			if($this->pos == $pos)
			{
				if($cdc[$k+1] > -1)
					return $cdc[$k+1];		
				return $cdc[0];
			}
		}
		return -1;
	}
	public function getPrevCdc()
	{
		$cdc = $this->getCdcs();
		foreach($cdc as $k=> $pos)
		{
			if($this->pos == $pos)
			{
				if($cdc[$k-1] > -1)
					return $cdc[$k-1];
				return $cdc[sizeof($cdc)-1];
			}	
		}
		return -1;
	}
	
	
	public function getNextBien($posID)
	{
		$bien = $this->getBiens();
		foreach($bien as $k=> $pos)
		{
			if($posID == $pos)
			{
				if($bien[$k+1] > -1)
					return $bien[$k+1];		
				return $bien[0];
			}
		}
		return -1;
	}
	
	public function getPrevBien($posID)
	{
		$bien = $this->getBiens();
		foreach($bien as $k=> $pos)
		{
			if($posID == $pos)
			{
				if($bien[$k-1] > -1)
					return $bien[$k-1];		
				return $bien[sizeof($bien)-1];
			}
		}
		return -1;
	}
	
	public function getBiens()
	{
		$url = parse_url($_SERVER['REQUEST_URI']);
		$get = $url["query"];
		parse_str($get); 
		
		$this->param = array(
			"t"=>$t,
			"v"=>$v,
			"smin"=>$smin,
			"smax"=>$smax,
			"pmin"=>$pmin,
			"pmax"=>$pmax,
			"r"=>$r,
			"b"=>$b,
			"cmin"=>$cmin,
			"pcmin"=>$pcmin,
			"garage"=>$garage,
			"jardin"=>$jardin,
			"terrasse"=>$terrasse,
			"parking"=>$parking,
			"ascenseur"=>$ascenseur,
			"piscine"=>$piscine
		);
		
		$pos = 0;
		
		$return = array();
		
		//On cherche par la négation les biens correspondants à la recherche
		while($this->bien[$pos]->idbien != "")
		{
			
			$this->setBienByPos($pos);
			
			$data = $this->getDataBien(1);
			echo "<!--".$data."-->";
		
			if(car($this->getReference(),"lowé-") == $r && !empty($r))
			{
				$this->nbBienTrouve = 1;
				return array($pos);
			}	
			
			if ($t == "vd" && !empty($t) && $t != "all" && $t != "" && $t != " "){
			if(!preg_match("/".$t."\:/",$data) && $t != "all" && !empty($t))
			{
				$pos++;
				continue;
			}
			} else {
				if(preg_match("/vd\:/",$data) || (!preg_match("/".$t."\:/",$data) && $t != "all" && !empty($t)))
			{
				$pos++;
				continue;
			}
			}
				
			if(!preg_match("/".$b.":/",$data) && $b != "all" && !empty($b))
			{
				$pos++;
				continue;
			}
				
			if(car($this->getLocalisation(false),"lowé-") != $v && $v != "all" && !empty($v))
			{
				$pos++;
				continue;
			}
			// Gestion des Surfaces
			
			$surface = $this->getAllInfos()->surface_habitable;
			if ($this->getAllInfos()->type_bien == "Terrain")
			$surface = $this->getAllInfos()->surface_jardin;
		
			if (!empty($smin) && !empty($smax))
			{
				
				if((int)$surface < $smin || (int)$surface > $smax)
				{
				$pos++;
				continue;
				}
			}
			else
			{
				if((int)$surface < $smin && !empty($smin) && empty($smax))
				{
					$pos++;
					continue;
				}
				
				if((int)$surface > $smax && empty($smin) && !empty($smax))
				{
					$pos++;
					continue;
				}
			}
			
			
			// Gestion du prix
			if (!empty($pmin) && !empty($pmax))
			{
				if((int)$this->getAllInfos()->prix < $pmin || (int)$this->getAllInfos()->prix > $pmax)
				{
				$pos++;
				continue;
				}
			}
			else
			{
				if((int)$this->getAllInfos()->prix < $pmin && !empty($pmin) && empty($pmax))
				{
					$pos++;
					continue;
				}
				
				if((int)$this->getAllInfos()->prix > $pmax && empty($pmin) && !empty($pmax))
				{
					$pos++;
					continue;
				}
			}
			// nb chambre min
			if (!empty($pcmin) )
			{
				if((int)$this->getAllInfos()->nb_chambre < $pcmin )
				{
				$pos++;
				continue;
				}
			}
			
				// nb pice min
			if (!empty($cmin) )
			{
				if( (int)$this->getAllInfos()->nb_piece < $cmin )
				{
				$pos++;
				continue;
				}
			}
			
			// balcon
			if($this->getAllInfos()->terrasse == "non" && $balcon == "1")
			{
				$pos++;
				continue;
			}
			
			// garage
			if(!empty($garage) && !preg_match("/Garage/",$this->getAllInfos()->stationnement))
			{
				$pos++;
				continue;
			}
				// piscine
			if(!empty($piscine) && $this->getAllInfos()->piscine=="non")
			{
				$pos++;
				continue;
			}
			
				// parking
if(!empty($parking) && !preg_match("/Parking/",$this->getAllInfos()->stationnement))
	{
				$pos++;
				continue;
			}
			
				// ascenceur
			if(!empty($ascenseur) && $this->getAllInfos()->ascenseur!="oui")
			{
				$pos++;
				continue;
			}
			
				// jardin surface_jardin
			if(!empty($jardin) && $this->getAllInfos()->surface_jardin == 0)
			{
				$pos++;
				continue;
			}
			
				
				// terrasse
		if( !empty($terrasse) && $this->getAllInfos()->terrasse == "non")
			{
				$pos++;
				continue;
			}
			
			
			if(!empty($this->getAllInfos()->idbien))	
				$return[] = $pos;
			
			$pos++;
		}
		
		$this->nbBienTrouve = sizeof($return);

		return $return;
	}
	public function getNbBienTrouve()
	{
		return $this->nbBienTrouve;
	}
	public function getParam()
	{
		return $this->param;
	}
        
                  public function getTypeTrans()
                  {
                      return $this->bien[$this->pos]->type_transaction;    //retourne location ou vente
                  }
	// Données simple pour le traitement d'un bien /!\ pos != 0
	/////////////////////////////////////////////////////////////////////////////////////////
	// SET 
	/////////////////////////////////////////////////////////////////////////////////////////
	public function setBienByPos($pos)
	{
		$this->pos = (int) $pos;
	}
	public function getPos($pos)
	{
		$this->pos = (int) $pos;
	}
	/////////////////////////////////////////////////////////////////////////////////////////
	// GET
	/////////////////////////////////////////////////////////////////////////////////////////
public function getTypeBien()
	{   $html="";
		if($this->bien[$this->pos]->categorie_bien == 2 && !$this->isLocal() && !preg_match("/appartement/i",$this->bien[$this->pos]->type_bien))
			$html = "Appartement ";
			$html .= $this->bien[$this->pos]->type_bien;
		
		return $html;
	}
		public function getAdd()
	{   $add=$this->bien[$this->pos]->nom_secteur;
		$add.=" ".$this->bien[$this->pos]->ville;
		$add.=" ".$this->bien[$this->pos]->code_postal;
		$add.=" ".$this->bien[$this->pos]->nom_pays;
		return $add;
	}
	public function getPrix($ty=false)
	{
		global $t;
		
		if($this->bien[$this->pos]->type_transaction == "vente")
		{
			$html = $this->FP($this->bien[$this->pos]->prix)."<span class='euro'>&euro;</span>";//" <sub>".$t->t("fai")."</sub>";
			if ($this->bien[$this->pos]->a_la_charge_du == "acquereur"){
				$html = $this->FP($this->bien[$this->pos]->prix)."<span class='euro'>&euro;</span> <sub>".$t->t("fai")."</sub>";
			}
			
		}
		elseif($this->bien[$this->pos]->type_transaction == "location")
		{
			if($this->bien[$this->pos]->Location_saisonniere == "oui")
			{
				$html = "<span class='apartirde'>".$t->t("apartirde")."</span>";
				if($this->bien[$this->pos]->Prix_semaine_basse_saison != "NC") $html .= $this->FP($this->bien[$this->pos]->Prix_semaine_basse_saison)."<span class='euro'>&euro;</span>/".$t->t("semaine");
				elseif($this->bien[$this->pos]->Prix_quinzaine_basse_saison != "NC") $html .= $this->FP($this->bien[$this->pos]->Prix_quinzaine_basse_saison)."<span class='euro'>&euro;</span>/".$t->t("quinzaine");
				elseif($this->bien[$this->pos]->Prix_mois_basse_saison != "NC") $html .= $this->FP($this->bien[$this->pos]->Prix_mois_basse_saison)."<span class='euro'>&euro;</span>/".$t->t("mois");
				elseif($this->bien[$this->pos]->Prix_semaine_haute_saison != "NC") $html .= $this->FP($this->bien[$this->pos]->Prix_semaine_haute_saison)."<span class='euro'>&euro;</span>/".$t->t("semaine");
				elseif($this->bien[$this->pos]->Prix_quinzaine_haute_saison != "NC") $html .= $this->FP($this->bien[$this->pos]->Prix_quinzaine_haute_saison)."<span class='euro'>&euro;</span>/".$t->t("quinzaine");
				elseif($this->bien[$this->pos]->Prix_mois_haute_saison != "NC") $html .= $this->FP($this->bien[$this->pos]->Prix_mois_haute_saison)."<span class='euro'>&euro;</span>/".$t->t("mois");
				else $html .= $this->bien[$this->pos]->prix."<span class='euro'>&euro;</span>/".$t->t("mois");
			}
			else
			{
				$html = $this->FP($this->bien[$this->pos]->prix)."<span class='euro'>&euro;</span>/".$t->t("mois")." <sub>".$t->t("cc")."</sub>";
			}
		}
		
		if($ty) $html = $this->bien[$this->pos]->prix;
		if($this->isVendu()) return "N.C.";
		return car($html);
	}
	public function getLocalisation($cp = true)
	{
		global $showVille;

		if(!$showVille)
		{
			if($showVille)	
				$html .= " - ";
			if($this->bien[$this->pos]->ville == $this->bien[$this->pos]->nom_secteur)
				$html .= $this->bien[$this->pos]->nom_secteur;
			else
				$html .= str_replace($this->bien[$this->pos]->ville,"", $this->bien[$this->pos]->nom_secteur);
		}
		else
		{
			$html .= $this->bien[$this->pos]->ville;
			
			if($cp) 
				$html .= " (".$this->bien[$this->pos]->code_postal.")";
		}
	
		return car($html);
	}
	public function getReference()
	{
		return $this->bien[$this->pos]->reference;
	}
	public function getDescription()
	{
		global $lang;
		
		if($lang == "en" && !empty($this->bien[$this->pos]->description_internet_anglais))
			$html = str_replace("<BR>","<br />",$this->bien[$this->pos]->description_internet_anglais);
		elseif($lang == "du" && !empty($this->bien[$this->pos]->description_internet_allemand))
			$html = str_replace("<BR>","<br />",$this->bien[$this->pos]->description_internet_allemand);
		elseif($lang == "it" && !empty($this->bien[$this->pos]->description_internet_italien)) 
			$html = str_replace("<BR>","<br />",$this->bien[$this->pos]->description_internet_italien);
		elseif($lang == "es" && !empty($this->bien[$this->pos]->description_internet_espagnol))
			$html = str_replace("<BR>","<br />",$this->bien[$this->pos]->description_internet_espagnol);
		elseif($lang == "po" && !empty($this->bien[$this->pos]->description_internet_portuguais))
			$html = str_replace("<BR>","<br />",$this->bien[$this->pos]->description_internet_portuguais);
		else 
			$html = str_replace("<BR>","<br />",$this->bien[$this->pos]->description_internet);
		
		return car($html);
	}
	public function getImages()
	{
		unset($this->bien[$this->pos]->images[0]->image_princ_min);
		
		global $imgVide;
		
		if(empty($imgVide)) $imgVide = "img/image_vide.png";
		
		if(empty($this->bien[$this->pos]->images[0]->image_1) || !@file($this->bien[$this->pos]->images[0]->image_1))
			$this->bien[$this->pos]->images[0]->image_1 = $imgVide;
		
		return $this->bien[$this->pos]->images[0];	
	}
	public function getNbImages()
	{
		return sizeof($this->getImages());
	}
	public function getImagePrinc($dir = "")
	{
		global $imgVideSmall;
		
		if(empty($imgVideSmall)) $imgVideSmall = "img/image_vide_small.png";
		
		if(empty($this->bien[$this->pos]->images[0]->image_1) || !@file($dir.$this->bien[$this->pos]->images[0]->image_1))
			return $imgVideSmall;
		
		return $this->bien[$this->pos]->images[0]->image_1;
	}
	public function getDetails($type="detail",$img=false)
	{   global $lang;
		global $detailBien;
		global $t;
		$details = array();
		foreach($this->bien[$this->pos] as $key => $val)
		{
			if(in_array($key,$detailBien[$type]))
			{
				if($val != "non" && $val != "" && $val != "0" && $val != "NC")
				{	
					if($type == "piece")
						$detail[$key] = str_replace("","","".$val);
					else {
						if ($key=="type_chauffage" && $val=="Climatisation réversible")
					{
						if($lang=="fr") $val = "Climatisation réversible";
						else if($lang=="en") $val = "Reversible climate control";
					} 
						$detail[$key] = car($val);
					}
					if($val == "oui" && $img)
						$detail[$key] = '<img src="img/detail-check.png" alt="oui"/>';
					if($key == "etat_general")
					{
						$detail[$key] = $t->t("etat_general_".$val);
					}
					if ($key == "surface_habitable" && $this->isLocal()) 
					{
						$key ="surface_commerciale";
						$detail[$key] = $val;
						unset($detail["surface_habitable"]);
					}
					if ($type == "prestation" && $this->isLocal() == true && $key == "etat_general")
						unset($detail[$key]);
				}
			}
		}
		return $detail;
	}
	public function getExtentionDetail($ty)
	{
		if(preg_match("/surface/",$ty))
			return "m²";
		if(preg_match("/charge_prev/",$ty))
			return "€";
	}
	public function getDpeGes()
	{
		$dpe = $this->bien[$this->pos]->consommation_energetique;
		$ges = $this->bien[$this->pos]->emission_GES;
	
		if($this->bien[$this->pos]->non_soumis_dpe == "oui")
			return '<img src="img/dpe-ges-ns.png" alt=""  class="dpe"/>';
		if($this->bien[$this->pos]->dpe_vierge == "oui")
			return '<img src="img/dpe-ges.png" alt=""  class="dpe"/>';
		
		
		$topDpe = $dpe == 0 ? 15 : $topDpe;
		$topDpe = $dpe > 0 && $dpe <=50 ? 8+18 : $topDpe;
		$topDpe = $dpe >= 51 && $dpe <= 90 ? 20*2+4 : $topDpe;
		$topDpe = $dpe >= 91 && $dpe <= 150 ? 20*3+4 : $topDpe;
		$topDpe = $dpe >= 151 && $dpe <= 230 ? 20*4+2 : $topDpe;
		$topDpe = $dpe >= 231 && $dpe <= 330 ? 20*5 : $topDpe;
		$topDpe = $dpe >= 331 && $dpe <= 450 ? 20*6 : $topDpe;
		$topDpe = $dpe >  450 ? 20*7 : $topDpe;
		
		if($dpe == 0)$dpe = "N.C.";
		
		$topGes = 0;
		$topGes = $ges == 0 ? 15 : $topGes;
		$topGes = $ges > 0 && $ges <=5 ? 25 : $topGes;
		$topGes = $ges >= 6 && $ges <= 10 ? 20*2+4 : $topGes;
		$topGes = $ges >= 11 && $ges <= 20 ? 20*3+4 : $topGes;
		$topGes = $ges >= 21 && $ges <= 35 ? 20*4+2 : $topGes;
		$topGes = $ges >= 36 && $ges <= 55 ? 20*5 : $topGes;
		$topGes = $ges >= 56 && $ges <= 80 ? 20*6 : $topGes;
		$topGes = $ges >  80 ? 26+24*5-7 : $topGes;
		
		if($ges == 0)$ges = "N.C.";
		
		$lettre_dpe = "";
		$lettre_dpe = $dpe == 0 ? "" : $lettre_dpe;
		$lettre_dpe = $dpe > 0 && $dpe <=50 ? "A" : $lettre_dpe;
		$lettre_dpe = $dpe >= 51 && $dpe <= 90 ? "B" : $lettre_dpe;
		$lettre_dpe = $dpe >= 91 && $dpe <= 150 ? "C" : $lettre_dpe;
		$lettre_dpe = $dpe >= 151 && $dpe <= 230 ? "D" : $lettre_dpe;
		$lettre_dpe = $dpe >= 231 && $dpe <= 330 ? "E" : $lettre_dpe;
		$lettre_dpe = $dpe >= 331 && $dpe <= 450 ? "F" : $lettre_dpe;
		$lettre_dpe = $dpe >  450 ? "G" : $lettre_dpe;
		
		$lettre_ges = "";
		$lettre_ges = $ges == 0 ? "" : $lettre_ges;
		$lettre_ges = $ges > 0 && $ges <=5 ? "A" : $lettre_ges;
		$lettre_ges = $ges >= 6 && $ges <= 10 ? "B" : $lettre_ges;
		$lettre_ges = $ges >= 11 && $ges <= 20 ? "C" : $lettre_ges;
		$lettre_ges = $ges >= 21 && $ges <= 35 ? "D" : $lettre_ges;
		$lettre_ges = $ges >= 36 && $ges <= 55 ? "E" : $lettre_ges;
		$lettre_ges = $ges >= 56 && $ges <= 80 ? "F" : $lettre_ges;
		$lettre_ges = $ges >  80 ? "G" : $lettre_ges;
		
		$file = "img/dpe/depges-".$topDpe."-".$topGes.".jpg";
		
		//if(@file($file))
		//	return "<img src='".$file."' alt='' class='dpe'/>";
		
		$img = "img/dpe-ges.png";
		$image = ImageCreateFromPng($img);
		
		// $dem = 8.6666666;
		$dem = 2.166666;
		
		$cadreDPE = @ImageCreate (25*$dem, 15*$dem);
		$cadreGES = @ImageCreate (25*$dem, 15*$dem);
		$ligneDPE = @ImageCreate (110*$dem, 1*$dem);
		$ligneGES = @ImageCreate (110*$dem, 1*$dem);
		
		imagecolorallocate($cadreDPE ,54,54,54);
		imagecolorallocate($cadreGES ,54,54,54);
		imagecolorallocate($ligneDPE ,54,54,54);
		imagecolorallocate($ligneGES ,54,54,54);
		
		imagecopy($image,$cadreDPE,110*$dem,$topDpe*$dem,0,0,25*$dem,15*$dem);
		
		if($dpe > 0) imagecopy($image,$ligneDPE,4*$dem,$topDpe*$dem+7*$dem,0,0,110*$dem,1*$dem);
		
		imagecopy($image,$cadreGES,260*$dem,$topGes*$dem,0,0,25*$dem,15*$dem);
		
		if($ges > 0) imagecopy($image,$ligneGES,155*$dem,$topGes*$dem+7*$dem,0,0,110*$dem,1*$dem);
		
		$blanc = imagecolorallocate($image,255,255,255);
		$noir = imagecolorallocate($image,54,54,54);
		
		imagettftext($image,30,0,88*$dem+60,$topDpe*$dem-10,$noir,"/fonts/arial.ttf",$lettre_dpe);
		imagettftext($image,20,0,108*$dem+10,$topDpe*$dem+25,$blanc,"/fonts/arial.ttf",$dpe);
		imagettftext($image,30,0,230*$dem+60,$topGes*$dem-10,$noir,"/fonts/arial.ttf",$lettre_ges);
		imagettftext($image,20,0,258*$dem+10,$topGes*$dem+25,$blanc,"/fonts/arial.ttf",$ges);
		
		
		
		imagePng($image,$file);
				
		$html = "<img src='".$file."' alt='' class='dpe'/>";
		/*$html = '
			<img src="img/dpe-ges.png" alt="" />
			<div class="dpe-bulle dpe" style="top:'.($topDpe-9).'px">
				<div class="arrow-dpe"></div>
				<div class="border"></div>
				<div class="lettre">'.$lettre_dpe.'</div>
				'.$dpe.'
			</div>
			<div class="dpe-bulle ges" style="top:'.($topGes-9).'px">
				<div class="arrow-dpe"></div>
				<div class="border"></div>
				<div class="lettre">'.$lettre_ges.'</div>
				'.$ges.'
			</div>
		';*/
		return $html;
	}
	public function getAllInfos()
	{
		return $this->bien[$this->pos];	
	}
		public function getLoiAlur()
	{ global $lang;
	$pourcentage = ($this->bien[$this->pos]->fai*100)/$this->bien[$this->pos]->prix;
	
		if ($this->bien[$this->pos]->type_transaction == "location"){
			if($lang=="fr") return "<br/> - Charges : ".$this->bien[$this->pos]->montant_charges." € <br/> - Dépôt de Garantie : ".$this->bien[$this->pos]->depot_garantie." € <br/> - Honoraires Agence : ".$this->bien[$this->pos]->fai." € TTC";
		}
		else {
			if($this->bien[$this->pos]->a_la_charge_du == "acquereur")
		{ if($lang=="fr") return "Honoraires d'agence inclus de ".$this->bien[$this->pos]->fai."€ soit ".round($pourcentage,2)."% TTC à la charge de l'acquéreur";
           else if($lang=="en")  return "Commission payable by the purchaser :".$this->bien[$this->pos]->compc."%";
		}
		else {
			return "";
		}
		}
		
	}
	public function getMaxPrix($f=false)
	{
		$prix = array();
		$i = 0;
		while($this->bien[$i]->prix != "")
		{
			$prix[$i] = (int) $this->bien[$i]->prix;
			$i++;
		}
		if($f)
			return $this->FP(round(max($prix), -4));
		else
			return round(max($prix), -4);
	}
	public function getAllLocalisation()
	{
		global $showVille;
		
		$type = $showVille ? "ville" : "nom_secteur";
		
		$secteur = array();
		
		$i = 0;

		while($this->bien[$i]->idbien != "")
		{
			$secteur[($i+1)] = ucfirst(strtolower(preg_replace(array("/^( )/","/\-( )/","/( )+$/"),array("","-",""),car($this->bien[$i]->$type))));
			$i++;
		}
		$secteur = array_unique($secteur,SORT_STRING );
		sort($secteur);	
		
		return $secteur;
	}
	public function getVideo()
	{
		$url = $this->bien[$this->pos]->url_video_youtube;
		
		if(preg_match("#iframe#",$url))
		{
			preg_match('#src="(.*?)"#',$url,$ret);
			$src = "http:".$ret[1];
		}
		elseif(preg_match("#youtu\.be#",$url))
		{
			preg_match('#/([a-zA-Z0-9\-]+)$#',$url,$ret);
			
			$src="http://www.youtube.com/embed/".$ret[1];
		}
		elseif(preg_match("#watch\?v#",$url))
		{
			preg_match('#watch\?v=(.*?)$#',$url,$ret); 
			
			$src="http://www.youtube.com/embed/".$ret[1];
		}
			
		return $src;
	}
	public function getDataBien($ty)
	{
		global $showVille;
		
		$data = "";
		if($ty == 1)
		{
			//transaction 0 
			if($this->isVendu())$data .= "vd:";
			elseif($this->bien[$this->pos]->type_transaction == "vente")$data .= "v:"; // vente
			elseif($this->bien[$this->pos]->type_transaction == "location" && $this->bien[$this->pos]->Location_saisonniere == "non")$data .= "l:"; // location
			else $data .= "s:"; // location saisoniaire
			
			// type de bien 1
			switch($this->bien[$this->pos]->categorie_bien)
			{
				case "1":
					if($this->bien[$this->pos]->type_bien != "Immeuble" && !preg_match("/commer/i",$this->bien[$this->pos]->type_bien)) $data .="m:";
					elseif($this->bien[$this->pos]->type_bien == "Immeuble")$data .="i:";
					else $data .="c:";
				break;
				case "2":
					if(!preg_match("/commer/i",$this->bien[$this->pos]->type_bien)) $data .= "a:";
					else $data .= "c:";
				break;
				case "3":
					$data .= "g:";
				break;
				case "4":
					$data .= "t:";
				break;
			}
			
			// gestion des bloc supplémentaire via lettre dans la référence
			foreach($this->getFiltreSup() as $f)
			{
				if(preg_match("/^".$f["ref"]."/",$this->bien[$this->pos]->reference))
				{
					$data .= $f["filtre"].":";
					if(!empty($f["replace"])) $data = str_replace($f["replace"],"",$data);
				}
			}
			
			if($this->bien[$this->pos]->neuf == "oui" && !$this->isTerrain()) $data.="n:";
			else $data.="an:";
		}
		if($ty == 2)
		{
			// prix 2
			$data .= "p".$this->bien[$this->pos]->prix."";
		}
		if($ty == 3)
		{
			//ville 3
			$data .= $showVille ? "vi".car($this->bien[$this->pos]->ville,"low-é") : "vi".car($this->bien[$this->pos]->nom_secteur,"low-é");
		}
		if($ty == 4)
		{
			//ville 3
			if($this->isTerrain())
				$data .= "sh".$this->bien[$this->pos]->surface_jardin."";
			else
				$data .= "sh".$this->bien[$this->pos]->surface_habitable."";
		}
		return $data;
	}
	public function getDateAjout()
	{
		return $this->bien[$this->pos]->date_modif;
	}
	public function getMaxNbPieces()
	{
		$piece = array();
		$i = 0;
		while($this->bien[$i]->idbien != "")
		{
			$piece[$i] = (int) $this->bien[$i]->nb_piece;
			$i++;
		}
		return max($piece);
	}
	public function getMaxNbChambre()
	{
		$piece = array();
		$i = 0;
		while($this->bien[$i]->idbien != "")
		{
			$piece[$i] = (int) $this->bien[$i]->nb_chambre;
			$i++;
		}
		return max($piece);
	}
	public function getNbPiece()
	{
		return $this->bien[$this->pos]->nb_piece;
	}
	public function getNbChambre()
	{
		return $this->bien[$this->pos]->nb_chambre;
	}
	public function getFiltreSup()
	{
		global $filtreSup;
		
		if(!empty($filtreSup))
		{
			return $filtreSup;
		}
	}
	public function getNbBien()
	{
		return $this->nbBien;
	}
	public function getUrlBandeau()
	{
		global $bandeauUrl;
		
		if($this->isVendu())
		{
			if($this->bien[$this->pos]->avancement == "Compromis")
				return $bandeauUrl."18.png";
			else
				return $bandeauUrl."4.png";
		}
			
		if($this->bien[$this->pos]->bandeau == "1") return false;
		
		return $bandeauUrl.$this->bien[$this->pos]->bandeau.".png";
	}
	public function getVisite()
	{
		$url = $this->bien[$this->pos]->url_visite_virtuelle;
		
		return $url;
	}
	////////////////////////////////////////////////////////////////////////////////
	//	IS
	////////////////////////////////////////////////////////////////////////////////
	public function isTerrain()
	{
		if($this->bien[$this->pos]->categorie_bien == "4") return true;
		return false;
	}
	public function isLocal()
	{
		if($this->bien[$this->pos]->categorie_bien == "2")
		{
			if(preg_match("/commer/i",$this->bien[$this->pos]->type_bien) || preg_match("/ureau/i",$this->bien[$this->pos]->type_bien)) return true;
		}
		return false;
	}
	public function isVendu()
	{
		if(!empty($this->bien[$this->pos]->avancement))
			return true;
		return false;
	}
        
                 public function isLocSaison(){
                      if ($this->getTypeTrans() == "location"){
                          if($this->bien[$this->pos]->Location_saisonniere == "oui")
                            return true;
                      } 
                      return false;
                  }
	/////////////////////////////////////////////////////////////////////////////////////////////
	// Has
	/////////////////////////////////////////////////////////////////////////////////////////////
	public function hasDetail($ty="piece")
	{
		if($ty == "piece")
		{
			if(!empty($this->bien[$this->pos]->piece_1))
				return true;
		}
		elseif($ty == "prestation")
		{
			$detail = $this->getDetails($ty);
			if(sizeof($detail) >= 1)
				return true;
		}
		return false;
	}
	public function hasLocSaison()
	{
		for($i=0;$i<$this->nbBien;$i++)
		{
			if($this->bien[$i]->Location_saisonniere == "oui") return true;
		}
		return false;
	}
	public function hasGarage()
	{
		for($i=0;$i<$this->nbBien;$i++)
		{
			if($this->bien[$i]->categorie_bien == "3") return true;
		}
		return false;
	}
	public function hasImmeuble()
	{
		for($i=0;$i<$this->nbBien;$i++)
		{
			if($this->bien[$i]->type_bien == "Immeuble") return true;
		}
		return false;
	}
	public function hasVideo()
	{
		if(!empty($this->bien[$this->pos]->url_video_youtube))
			return true;
		return false;
	}
	public function hasBandeau()
	{
		global $bandeauUrl;
		
		if((!empty($this->bien[$this->pos]->bandeau) && @file($bandeauUrl.$this->bien[$this->pos]->bandeau.".png")) || $this->isVendu())
			return true;
		return false;
	}
	public function hasVendu()
	{
		if(@file("BV_base.xml"))
			return true;
		return false;
	}
	public function hasLocation()
	{
		for($i=0;$i<$this->nbBien;$i++)
		{
			if($this->bien[$i]->type_transaction == "location") return true;
		}
		return false;
	}
	public function hasLocal()
	{
		for($i=0;$i<$this->nbBien;$i++)
		{
			if(preg_match("/commer/i",$this->bien[$i]->type_bien)) return true;
		}
		return false;
	}
	public function hasTerrain()
	{
		for($i=0;$i<$this->nbBien;$i++)
		{
			if($this->bien[$i]->categorie_bien == "4") return true;
		}
		return false;
	}
	public function hasNeuf()
	{
		for($i=0;$i<$this->nbBien;$i++)
		{
			if($this->bien[$i]->neuf == "oui") return true;
		}
		return false;
	}
	public function existPosBien($id)
	{
		if($id < 0) return false;
		if($this->bien[(int)$id]->idbien != "") return true;
		
		return false;
	}
	public function hasVisite()
	{
		if(!empty($this->bien[$this->pos]->url_visite_virtuelle)) return true;
		return false;
	}
	//Format prix FR
	public function FP($prix)
	{
		return number_format((int) $prix, 0, ',', ' ');
	}
}







/*Class Class_GetBien
{
	private $bien;
	private $pos;
	private $data;
	private $nbBien;
	private $nbBienTrouve;
	private $param;
	
	function __construct($bien = "")
	{
		$this->pos = -1;
		if(!empty($bien))
			$this->bien = $bien;
	}
	public function load($bien)
	{
		if(!empty($bien))
			$this->bien = $bien;
		$this->nbBien = sizeof($this->bien);
		
	}
	public function getLoadBien()
	{
		return $this->bien;
	}
	public function insert($data,$col)
	{
		if($data[0]->$col != "")
		{
			$j = 0;
			$newArrayVal = array();
			
			for($i=0;$i<$this->nbBien;$i++)
			{
				if((int) $data[$j]->$col > 0)
				{
					if((int) $this->bien[$i]->$col >= (int) $data[$j]->$col && (int) $this->bien[$i+1]->$col >= (int) $data[$j]->$col)
					{
						$newArrayVal[] = $i;
						$i--;
						$j++;
					}
				}
				$a[$i] = $this->bien[$i];
			}
			
			$this->nbBien = $this->nbBien+sizeof($newArrayVal);
			
			$pos = 0;
			for($i=0;$i<$this->nbBien;$i++)
			{
				$k = array_search($i,$newArrayVal);
				// echo $k;
				if($k!== false)
				{
					$b[$i+$pos] = $data[$pos]; 
				 
					$pos++;
				
					array_splice($newArrayVal,$k,1);
			
					$i--;
					
					// echo $pos." ".$i;
				}
				else
					$b[$i+$pos] = $a[$i]; 
			}
			$this->bien = $b;
			
		}
	}
	public function setValue($data,$col,$set)
	{
		if(empty($data[0]->$col))
		{
			
			
			$new = array();
			for($i=0;$i<=sizeof($data)-1;$i++)
			{
				if($set == "rand")
					$val = rand(10,sizeof($BVbien)*10);
				else
					$val = $set;
					
				$data[$i]->$col = $val;
				$new[$i] = $data[$i];
			}
			return $new;
		}else
			return $data;
	}
	public function getPosBienByID($id)
	{
		$pos = 0;
		foreach($this->bien as $key => $val)
		{
			if((int) $val->idbien == (int) $id)
			{
				return $pos;
			}
			$pos++;
		}
	}
	public function getPosBienByRef($ref,$t = false)
	{
		$pos = 0;
		foreach($this->bien as $key => $val)
		{
			if(!$t)
			{
				if($val->reference == $ref)
				{
					return $pos;
				}
			}
			else
			{
				if(car($val->reference,"low_é-") == $ref)
				{
					return $pos;
				}
			}
			$pos++;
		}
		return -1;
	}
	public function getCdcs()
	{
		$pos = 0;
		$return = array();
		foreach($this->bien as $key => $val)
		{
			if($val->coups_de_coeur == "oui" && empty($val->avancement))
			{
				$return[] = $pos;
			}
			$pos++;
		}
		return $return;
	}
	public function getNextCdc()
	{
		$cdc = $this->getCdcs();
		foreach($cdc as $k=> $pos)
		{
			if($this->pos == $pos)
			{
				if($cdc[$k+1] > -1)
					return $cdc[$k+1];		
				return $cdc[0];
			}
		}
		return -1;
	}
	public function getPrevCdc()
	{
		$cdc = $this->getCdcs();
		foreach($cdc as $k=> $pos)
		{
			if($this->pos == $pos)
			{
				if($cdc[$k-1] > -1)
					return $cdc[$k-1];
				return $cdc[sizeof($cdc)-1];
			}	
		}
		return -1;
	}
	
	
	public function getNextBien($posID)
	{
		$bien = $this->getBiens();
		foreach($bien as $k=> $pos)
		{
			if($posID == $pos)
			{
				if($bien[$k+1] > -1)
					return $bien[$k+1];		
				return $bien[0];
			}
		}
		return -1;
	}
	
	public function getPrevBien($posID)
	{
		$bien = $this->getBiens();
		foreach($bien as $k=> $pos)
		{
			if($posID == $pos)
			{
				if($bien[$k-1] > -1)
					return $bien[$k-1];		
				return $bien[sizeof($bien)-1];
			}
		}
		return -1;
	}
	
	public function getBiens()
	{
		$url = parse_url($_SERVER['REQUEST_URI']);
		$get = $url["query"];
		parse_str($get); 
		
		$this->param = array(
			"t"=>$t,
			"v"=>$v,
			"s"=>$s,
			"p"=>$p,
			"r"=>$r,
			"b"=>$b
		);
		
		$pos = 0;
		
		$return = array();
		
		//On cherche par la négation les biens correspondants à la recherche
		while($this->bien[$pos]->idbien != "")
		{
			
			$this->setBienByPos($pos);
			
			$data = $this->getDataBien(1);
			echo "<!--".$data."-->";
		
			if(car($this->getReference(),"lowé-") == $r && !empty($r))
			{
				$this->nbBienTrouve = 1;
				return array($pos);
			}	
			
			if(!preg_match("/".$t."\:/",$data) && $t != "all" && !empty($t))
			{
				$pos++;
				continue;
			}
				
			if(!preg_match("/".$b.":/",$data) && $b != "all" && !empty($b))
			{
				$pos++;
				continue;
			}
				
			if(car($this->getLocalisation(false),"lowé-") != $v && $v != "all" && !empty($v))
			{
				$pos++;
				continue;
			}
			
			if((int)$this->getAllInfos()->surface_habitable < $s && !empty($s))
			{
				$pos++;
				continue;
			}
			
			if((int)$this->getAllInfos()->prix > $p && !empty($p))
			{
				$pos++;
				continue;
			}
			// balcon
			if($this->getAllInfos()->terrasse == "non" && $balcon == "1")
			{
				$pos++;
				continue;
			}
			
			if(!empty($this->getAllInfos()->idbien))	
				$return[] = $pos;
			
			$pos++;
		}
		
		$this->nbBienTrouve = sizeof($return);

		return $return;
	}
	public function getNbBienTrouve()
	{
		return $this->nbBienTrouve;
	}
	public function getParam()
	{
		return $this->param;
	}
        
                  public function getTypeTrans()
                  {
                      return $this->bien[$this->pos]->type_transaction;    //retourne location ou vente
                  }
	// Données simple pour le traitement d'un bien /!\ pos != 0
	/////////////////////////////////////////////////////////////////////////////////////////
	// SET 
	/////////////////////////////////////////////////////////////////////////////////////////
	public function setBienByPos($pos)
	{
		$this->pos = (int) $pos;
	}
	public function getPos($pos)
	{
		$this->pos = (int) $pos;
	}
	/////////////////////////////////////////////////////////////////////////////////////////
	// GET
	/////////////////////////////////////////////////////////////////////////////////////////
	public function getTypeBien()
	{
	if($this->bien[$this->pos]->categorie_bien == 2 && !$this->isLocal())
			$html = "Appartement ";
			
		$html .= $this->bien[$this->pos]->type_bien;
		
		return $html;

		
	}
	public function getPrix($ty=false)
	{
		global $t;
		
		if($this->bien[$this->pos]->type_transaction == "vente")
		{
			$html = $this->FP($this->bien[$this->pos]->prix)."<span class='euro'>&euro;</span>";//" <sub>".$t->t("fai")."</sub>";
		}
		elseif($this->bien[$this->pos]->type_transaction == "location")
		{
			if($this->bien[$this->pos]->Location_saisonniere == "oui")
			{
				$html = "<span class='apartirde'>".$t->t("apartirde")."</span>";
				if($this->bien[$this->pos]->Prix_semaine_basse_saison != "NC") $html .= $this->FP($this->bien[$this->pos]->Prix_semaine_basse_saison)."<span class='euro'>&euro;</span>/".$t->t("semaine");
				elseif($this->bien[$this->pos]->Prix_quinzaine_basse_saison != "NC") $html .= $this->FP($this->bien[$this->pos]->Prix_quinzaine_basse_saison)."<span class='euro'>&euro;</span>/".$t->t("quinzaine");
				elseif($this->bien[$this->pos]->Prix_mois_basse_saison != "NC") $html .= $this->FP($this->bien[$this->pos]->Prix_mois_basse_saison)."<span class='euro'>&euro;</span>/".$t->t("mois");
				elseif($this->bien[$this->pos]->Prix_semaine_haute_saison != "NC") $html .= $this->FP($this->bien[$this->pos]->Prix_semaine_haute_saison)."<span class='euro'>&euro;</span>/".$t->t("semaine");
				elseif($this->bien[$this->pos]->Prix_quinzaine_haute_saison != "NC") $html .= $this->FP($this->bien[$this->pos]->Prix_quinzaine_haute_saison)."<span class='euro'>&euro;</span>/".$t->t("quinzaine");
				elseif($this->bien[$this->pos]->Prix_mois_haute_saison != "NC") $html .= $this->FP($this->bien[$this->pos]->Prix_mois_haute_saison)."<span class='euro'>&euro;</span>/".$t->t("mois");
				else $html .= $this->bien[$this->pos]->prix."<span class='euro'>&euro;</span>/".$t->t("mois");
			}
			else
			{
				$html = $this->FP($this->bien[$this->pos]->prix)."<span class='euro'>&euro;</span>/".$t->t("mois")." <sub>".$t->t("cc")."</sub>";
			}
		}
		
		if($ty) $html = $this->bien[$this->pos]->prix;
		if($this->isVendu()) return "N.C.";
		return car($html);
	}
	public function getLocalisation($cp = true)
	{
		global $showVille;
        global $t;
		if(!$showVille)
		{   if($this->bien[$this->pos]->nom_secteur=="Centre ville")
				$html .=$t->t("centre_ville");
			else if($showVille)	
				$html .= " - ";
		else	if($this->bien[$this->pos]->ville == $this->bien[$this->pos]->nom_secteur)
				$html .= $this->bien[$this->pos]->nom_secteur;
			else
				$html .= str_replace($this->bien[$this->pos]->ville,"", $this->bien[$this->pos]->nom_secteur);
			
		}
		else
		{ 
			$html .= $this->bien[$this->pos]->ville;
			
			if($cp) 
				$html .= " (".$this->bien[$this->pos]->code_postal.")";
		}
	
		return car($html);
	}
	public function getReference()
	{
		return $this->bien[$this->pos]->reference;
	}
	public function getIdBien()
	{
		return $this->bien[$this->pos]->idbien;
	}
	public function getDescription()
	{
		global $lang;
		
		if($lang == "en" && !empty($this->bien[$this->pos]->description_internet_anglais))
			$html = str_replace("<BR>","<br />",$this->bien[$this->pos]->description_internet_anglais);
		elseif($lang == "du" && !empty($this->bien[$this->pos]->description_internet_allemand))
			$html = str_replace("<BR>","<br />",$this->bien[$this->pos]->description_internet_allemand);
		elseif($lang == "it" && !empty($this->bien[$this->pos]->description_internet_italien)) 
			$html = str_replace("<BR>","<br />",$this->bien[$this->pos]->description_internet_italien);
		elseif($lang == "es" && !empty($this->bien[$this->pos]->description_internet_espagnol))
			$html = str_replace("<BR>","<br />",$this->bien[$this->pos]->description_internet_espagnol);
		elseif($lang == "po" && !empty($this->bien[$this->pos]->description_internet_portuguais))
			$html = str_replace("<BR>","<br />",$this->bien[$this->pos]->description_internet_portuguais);
		else 
			$html = str_replace("<BR>","<br />",$this->bien[$this->pos]->description_internet);
		
		return car($html);
	}
	public function getImages()
	{
		unset($this->bien[$this->pos]->images[0]->image_princ_min);
		
		global $imgVide;
		
		if(empty($imgVide)) $imgVide = "img/image_vide.png";
		
		if(empty($this->bien[$this->pos]->images[0]->image_1) || !@file($this->bien[$this->pos]->images[0]->image_1))
			$this->bien[$this->pos]->images[0]->image_1 = $imgVide;
		
		return $this->bien[$this->pos]->images[0];	
	}
	public function getNbImages()
	{
		return sizeof($this->getImages());
	}
	public function getImagePrinc($dir = "")
	{
		global $imgVideSmall;
		
		if(empty($imgVideSmall)) $imgVideSmall = "img/image_vide_small.png";
		
		if(empty($this->bien[$this->pos]->images[0]->image_1) || !@file($dir.$this->bien[$this->pos]->images[0]->image_1))
			return $imgVideSmall;
		
		return $this->bien[$this->pos]->images[0]->image_1;
	}
	public function getDetails($type="detail",$img=false)
	{
		global $detailBien;
		global $t;
		$details = array();
		foreach($this->bien[$this->pos] as $key => $val)
		{
			if(in_array($key,$detailBien[$type]))
			{
				if($val != "non" && $val != "" && $val != "0" && $val != "NC")
				{	
					if($type == "piece")
					{
					//$detail[$key] = str_replace(":",":</b>","<b>".$val); }
					
					if($type == "piece" && preg_match("/piece_/",$key) )
					{ 
				    if(preg_match("/\bChambre\b/i",$val))
					{
						$var=str_replace("Chambre","",$val);
					    $detail[$key]="<b>".$t->t("chambre")."</b>".$var;
					
					}
					else if(preg_match("/\bCuisine\b/i",$val))
					{
						$var=str_replace("Cuisine","",$val);
					    $detail[$key]="<b>".$t->t("cuisine")."</b>".$var;
					
					}
					else if(preg_match("/\bCuisine\b/i",$val))
					{
						$var=str_replace("Cuisine","",$val);
					    $detail[$key]="<b>".$t->t("cuisine")."</b>".$var;
					
					}
					else if(preg_match("/\bBureau\b/i",$val))
					{
						$var=str_replace("Bureau","",$val);
					    $detail[$key]="<b>".$t->t("bureau")."</b>".$var;
					
					}
					else if(preg_match("/\bCellier\b/i",$val))
					{
						$var=str_replace("Cellier","",$val);
					    $detail[$key]="<b>".$t->t("celier")."</b>".$var;
					
					}
					else if(preg_match("/\bSalon\b/i",$val))
					{
						$var=str_replace("Salon","",$val);
					    $detail[$key]="<b>".$t->t("salon")."</b>".$var;
					
					}
										else if(preg_match("/eau/",$val))
					{
						$var1=str_replace("Salle","",$val);						
						$var=str_replace("d'eau","",$var1);
					    $detail[$key]="<b>".$t->t("salle_eau")."</b>".$var;
					
					}
						else if(preg_match("/sport/",$val))
					{
						$var1=str_replace("Salle","",$val);						
						$var=str_replace("de sport","",$var1);
					    $detail[$key]="<b>".$t->t("salle_sport")."</b>".$var;
					
					}
					else if(preg_match("/\bbains\b/i",$val))
					{
						$var1=str_replace("Salle","",$val);
						$var2=str_replace("de","",$var1);
						$var=str_replace("bains","",$var2);
					    $detail[$key]="<b>".$t->t("salle_bain")."</b>".$var;
					
					}
					else if(preg_match("/jour/",$val)){
						$var=str_replace("S&eacute;jour","",$val);
					    $detail[$key]="<b>".$t->t("sejour")."</b>".$var;
						}
					else if(preg_match("/Entr/",$val) || preg_match("/Hall/",$val) ){
						$var=str_replace("Entr&eacute;e","",$val);
						$var=str_replace("Hall d'entr&eacute;e","",$var);
						$var=str_replace("Entr&eacute;e","",$var);
                        $var=str_replace("Hall d'entr&eacute;e","",$var);
					    $detail[$key]="<b>".$t->t("entre")."</b>".$var;
						}
					
					
										
					else  $detail[$key] =str_replace(":",":</b>","<b>".$val);
					}
					}
					else
						$detail[$key] = car($val);
					if (preg_match("/nb_etage/",$key) && $this->bien[$this->pos]->categorie_bien == 1)
					{
						$key = "Niveau";
						if ($val > 1) $key = "Niveaux";
					}
					if($val == "oui" && $img)
						$detail[$key] = '<img src="img/detail-check.png" alt="oui"/>';
					if($key == "etat_general")
					{
						$detail[$key] = $t->t("etat_general_".$val);
					}
					if ($key == "surface_habitable" && $this->isLocal()) 
					{
						$key ="surface_commerciale";
						$detail[$key] = $val;
						unset($detail["surface_habitable"]);
					}
					
					if ($type == "prestation" && $key="type_chauffage" && preg_match("/Climatisation/",$val) )
					{  //$var=str_replace("Climatisation r&eacute;versible","",$val);
					    //$detail[$key]="<b>".$t->t("climatisations")."</b>".$var;
					}
					
					if ($type == "prestation" && $this->isLocal() == true && $key == "etat_general")
						unset($detail[$key]);
				}
			}
		}
		return $detail;
	}
	public function getExtentionDetail($ty)
	{
		if(preg_match("/surface/",$ty))
			return "m²";
		if(preg_match("/charge_prev/",$ty))
			return "€";
	}
	public function getDpeGes()
	{
		$dpe = $this->bien[$this->pos]->consommation_energetique;
		$ges = $this->bien[$this->pos]->emission_GES;
		
		if($this->bien[$this->pos]->non_soumis_dpe == "oui")
			return '<img src="img/dpe-ges-ns.png" alt=""  class="dpe"/>';
		if($this->bien[$this->pos]->dpe_vierge == "oui")
			return '<img src="img/dpe-ges.png" alt=""  class="dpe"/>';
		
		$topDpe = $dpe == 0 ? 15 : $topDpe;
		$topDpe = $dpe > 0 && $dpe <=50 ? 8+18 : $topDpe;
		$topDpe = $dpe >= 51 && $dpe <= 90 ? 20*2+4 : $topDpe;
		$topDpe = $dpe >= 91 && $dpe <= 150 ? 20*3+4 : $topDpe;
		$topDpe = $dpe >= 151 && $dpe <= 230 ? 20*4+2 : $topDpe;
		$topDpe = $dpe >= 231 && $dpe <= 330 ? 20*5 : $topDpe;
		$topDpe = $dpe >= 331 && $dpe <= 450 ? 20*6 : $topDpe;
		$topDpe = $dpe >  450 ? 20*7 : $topDpe;
		
		if($dpe == 0)$dpe = "N.C.";
		
		$topGes = 0;
		$topGes = $ges == 0 ? 15 : $topGes;
		$topGes = $ges > 0 && $ges <=5 ? 25 : $topGes;
		$topGes = $ges >= 6 && $ges <= 10 ? 20*2+4 : $topGes;
		$topGes = $ges >= 11 && $ges <= 20 ? 20*3+4 : $topGes;
		$topGes = $ges >= 21 && $ges <= 35 ? 20*4+2 : $topGes;
		$topGes = $ges >= 36 && $ges <= 55 ? 20*5 : $topGes;
		$topGes = $ges >= 56 && $ges <= 80 ? 20*6 : $topGes;
		$topGes = $ges >  80 ? 26+24*5-7 : $topGes;
		
		if($ges == 0)$ges = "N.C.";
		
		$lettre_dpe = "";
		$lettre_dpe = $dpe == 0 ? "" : $lettre_dpe;
		$lettre_dpe = $dpe > 0 && $dpe <=50 ? "A" : $lettre_dpe;
		$lettre_dpe = $dpe >= 51 && $dpe <= 90 ? "B" : $lettre_dpe;
		$lettre_dpe = $dpe >= 91 && $dpe <= 150 ? "C" : $lettre_dpe;
		$lettre_dpe = $dpe >= 151 && $dpe <= 230 ? "D" : $lettre_dpe;
		$lettre_dpe = $dpe >= 231 && $dpe <= 330 ? "E" : $lettre_dpe;
		$lettre_dpe = $dpe >= 331 && $dpe <= 450 ? "F" : $lettre_dpe;
		$lettre_dpe = $dpe >  450 ? "G" : $lettre_dpe;
		
		$lettre_ges = "";
		$lettre_ges = $ges == 0 ? "" : $lettre_ges;
		$lettre_ges = $ges > 0 && $ges <=5 ? "A" : $lettre_ges;
		$lettre_ges = $ges >= 6 && $ges <= 10 ? "B" : $lettre_ges;
		$lettre_ges = $ges >= 11 && $ges <= 20 ? "C" : $lettre_ges;
		$lettre_ges = $ges >= 21 && $ges <= 35 ? "D" : $lettre_ges;
		$lettre_ges = $ges >= 36 && $ges <= 55 ? "E" : $lettre_ges;
		$lettre_ges = $ges >= 56 && $ges <= 80 ? "F" : $lettre_ges;
		$lettre_ges = $ges >  80 ? "G" : $lettre_ges;
		
		$file = "img/dpe/depges-".$topDpe."-".$topGes.".jpg";
		
		if(@file($file))
			return "<img src='".$file."' alt='' class='dpe'/>";
		
		$img = "img/dpe-ges.png";
		$image = ImageCreateFromPng($img);
		
		// $dem = 8.6666666;
		$dem = 2.166666;
		
		$cadreDPE = @ImageCreate (25*$dem, 15*$dem);
		$cadreGES = @ImageCreate (25*$dem, 15*$dem);
		$ligneDPE = @ImageCreate (110*$dem, 1*$dem);
		$ligneGES = @ImageCreate (110*$dem, 1*$dem);
		
		imagecolorallocate($cadreDPE ,54,54,54);
		imagecolorallocate($cadreGES ,54,54,54);
		imagecolorallocate($ligneDPE ,54,54,54);
		imagecolorallocate($ligneGES ,54,54,54);
		
		imagecopy($image,$cadreDPE,110*$dem,$topDpe*$dem,0,0,25*$dem,15*$dem);
		
		if($dpe > 0) imagecopy($image,$ligneDPE,4*$dem,$topDpe*$dem+7*$dem,0,0,110*$dem,1*$dem);
		
		imagecopy($image,$cadreGES,260*$dem,$topGes*$dem,0,0,25*$dem,15*$dem);
		
		if($ges > 0) imagecopy($image,$ligneGES,155*$dem,$topGes*$dem+7*$dem,0,0,110*$dem,1*$dem);
		
		$blanc = imagecolorallocate($image,255,255,255);
		$noir = imagecolorallocate($image,54,54,54);
		
		imagettftext($image,30,0,88*$dem+60,$topDpe*$dem-10,$noir,"/fonts/arial.ttf",$lettre_dpe);
		imagettftext($image,20,0,108*$dem+10,$topDpe*$dem+25,$blanc,"/fonts/arial.ttf",$dpe);
		imagettftext($image,30,0,230*$dem+60,$topGes*$dem-10,$noir,"/fonts/arial.ttf",$lettre_ges);
		imagettftext($image,20,0,258*$dem+10,$topGes*$dem+25,$blanc,"/fonts/arial.ttf",$ges);
		
		
		
		imagePng($image,$file);
				
		$html = "<img src='".$file."' alt='' class='dpe'/>";
		// $html = '
			// <img src="img/dpe-ges.png" alt="" />
			// <div class="dpe-bulle dpe" style="top:'.($topDpe-9).'px">
				// <div class="arrow-dpe"></div>
				// <div class="border"></div>
				// <div class="lettre">'.$lettre_dpe.'</div>
				// '.$dpe.'
			// </div>
			// <div class="dpe-bulle ges" style="top:'.($topGes-9).'px">
				// <div class="arrow-dpe"></div>
				// <div class="border"></div>
				// <div class="lettre">'.$lettre_ges.'</div>
				// '.$ges.'
			// </div>
		// ';
		return $html;
	}
	public function getAllInfos()
	{
		return $this->bien[$this->pos];	
	}
	public function getLoiAlur()
	{
		if($this->bien[$this->pos]->a_la_charge_du == "acquereur")
			return "Commission à la charge de l'acquéreur : ".$this->bien[$this->pos]->compc."%";

		return "Commission à la charge du vendeur";
	}
	public function getMaxPrix($f=false)
	{
		$prix = array();
		$i = 0;
		while($this->bien[$i]->prix != "")
		{
			$prix[$i] = (int) $this->bien[$i]->prix;
			$i++;
		}
		if($f)
			return $this->FP(round(max($prix), -4));
		else
			return round(max($prix), -4);
	}
	public function getAllLocalisation()
	{
		global $showVille;
		
		$type = $showVille ? "ville" : "nom_secteur";
		
		$secteur = array();
		
		$i = 0;

		while($this->bien[$i]->idbien != "")
		{
			$secteur[($i+1)] = ucfirst(strtolower(preg_replace(array("/^( )/","/\-( )/","/( )+$/"),array("","-",""),car($this->bien[$i]->$type))));
			$i++;
		}
		$secteur = array_unique($secteur,SORT_STRING );
		sort($secteur);	
		
		return $secteur;
	}
	public function getVideo()
	{
		$url = $this->bien[$this->pos]->url_video_youtube;
		
		if(preg_match("#iframe#",$url))
		{
			preg_match('#src="(.*?)"#',$url,$ret);
			$src = "http:".$ret[1];
		}
		elseif(preg_match("#youtu\.be#",$url))
		{
			preg_match('#/([a-zA-Z0-9\-]+)$#',$url,$ret);
			
			$src="http://www.youtube.com/embed/".$ret[1];
		}
		elseif(preg_match("#watch\?v#",$url))
		{
			preg_match('#watch\?v=(.*?)$#',$url,$ret); 
			
			$src="http://www.youtube.com/embed/".$ret[1];
		}
			
		return $src;
	}
	public function getDataBien($ty)
	{
		global $showVille;
		
		$data = "";
		if($ty == 1)
		{
			//transaction 0 
			if($this->isVendu())$data .= "vd:";
			elseif($this->bien[$this->pos]->type_transaction == "vente")$data .= "v:"; // vente
			elseif($this->bien[$this->pos]->type_transaction == "location" && $this->bien[$this->pos]->Location_saisonniere == "non")$data .= "l:"; // location
			else $data .= "s:"; // location saisoniaire
			
			// type de bien 1
			switch($this->bien[$this->pos]->categorie_bien)
			{
				case "1":
					if($this->bien[$this->pos]->type_bien != "Immeuble" && !preg_match("/commer/i",$this->bien[$this->pos]->type_bien)) $data .="m:";
					elseif($this->bien[$this->pos]->type_bien == "Immeuble")$data .="i:";
					else $data .="c:";
				break;
				case "2":
					if(!preg_match("/commer/i",$this->bien[$this->pos]->type_bien)) $data .= "a:";
					else $data .= "c:";
				break;
				case "3":
					$data .= "g:";
				break;
				case "4":
					$data .= "t:";
				break;
			}
			
			// gestion des bloc supplémentaire via lettre dans la référence
			foreach($this->getFiltreSup() as $f)
			{
				if(preg_match("/^".$f["ref"]."/",$this->bien[$this->pos]->reference))
				{
					$data .= $f["filtre"].":";
					if(!empty($f["replace"])) $data = str_replace($f["replace"],"",$data);
				}
			}
			
			if($this->bien[$this->pos]->neuf == "oui" && !$this->isTerrain()) $data.="n:";
			else $data.="an:";
		}
		if($ty == 2)
		{
			// prix 2
			$data .= "p".$this->bien[$this->pos]->prix."";
		}
		if($ty == 3)
		{
			//ville 3
			$data .= $showVille ? "vi".car($this->bien[$this->pos]->ville,"low-é") : "vi".car($this->bien[$this->pos]->nom_secteur,"low-é");
		}
		if($ty == 4)
		{
			//ville 3
			if($this->isTerrain())
				$data .= "sh".$this->bien[$this->pos]->surface_jardin."";
			else
				$data .= "sh".$this->bien[$this->pos]->surface_habitable."";
		}
		return $data;
	}
	public function getDateAjout()
	{
		return $this->bien[$this->pos]->date_modif;
	}
	public function getMaxNbPieces()
	{
		$piece = array();
		$i = 0;
		while($this->bien[$i]->idbien != "")
		{
			$piece[$i] = (int) $this->bien[$i]->nb_piece;
			$i++;
		}
		return max($piece);
	}
	public function getMaxNbChambre()
	{
		$piece = array();
		$i = 0;
		while($this->bien[$i]->idbien != "")
		{
			$piece[$i] = (int) $this->bien[$i]->nb_chambre;
			$i++;
		}
		return max($piece);
	}
	public function getNbPiece()
	{
		return $this->bien[$this->pos]->nb_piece;
	}
	public function getNbChambre()
	{
		return $this->bien[$this->pos]->nb_chambre;
	}
	public function getFiltreSup()
	{
		global $filtreSup;
		
		if(!empty($filtreSup))
		{
			return $filtreSup;
		}
	}
	public function getNbBien()
	{
		return $this->nbBien;
	}
	public function getUrlBandeau()
	{
		global $bandeauUrl;
		
		if($this->isVendu())
		{
			if($this->bien[$this->pos]->avancement == "Compromis")
				return $bandeauUrl."18.png";
			else
				return $bandeauUrl."4.png";
		}
			
		if($this->bien[$this->pos]->bandeau == "1") return false;
		
		return $bandeauUrl.$this->bien[$this->pos]->bandeau.".png";
	}
	public function getVisite()
	{
		$url = $this->bien[$this->pos]->url_visite_virtuelle;
		
		return $url;
	}
	////////////////////////////////////////////////////////////////////////////////
	//	IS
	////////////////////////////////////////////////////////////////////////////////
	public function isTerrain()
	{
		if($this->bien[$this->pos]->categorie_bien == "4") return true;
		return false;
	}
	public function isLocal()
	{
		if($this->bien[$this->pos]->categorie_bien == "2")
		{
			if(preg_match("/commer/i",$this->bien[$this->pos]->type_bien) || preg_match("/ureau/i",$this->bien[$this->pos]->type_bien)) return true;
		}
		return false;
	}
	public function isVendu()
	{
		if(!empty($this->bien[$this->pos]->avancement))
			return true;
		return false;
	}
        
                 public function isLocSaison(){
                      if ($this->getTypeTrans() == "location"){
                          if($this->bien[$this->pos]->Location_saisonniere == "oui")
                            return true;
                      } 
                      return false;
                  }
	/////////////////////////////////////////////////////////////////////////////////////////////
	// Has
	/////////////////////////////////////////////////////////////////////////////////////////////
	public function hasDetail($ty="piece")
	{
		if($ty == "piece")
		{
			if(!empty($this->bien[$this->pos]->piece_1))
				return true;
		}
		elseif($ty == "prestation")
		{
			$detail = $this->getDetails($ty);
			if(sizeof($detail) >= 1)
				return true;
		}
		return false;
	}
	public function hasLocSaison()
	{
		for($i=0;$i<$this->nbBien;$i++)
		{
			if($this->bien[$i]->Location_saisonniere == "oui") return true;
		}
		return false;
	}
	public function hasGarage()
	{
		for($i=0;$i<$this->nbBien;$i++)
		{
			if($this->bien[$i]->categorie_bien == "3") return true;
		}
		return false;
	}
	public function hasImmeuble()
	{
		for($i=0;$i<$this->nbBien;$i++)
		{
			if($this->bien[$i]->type_bien == "Immeuble") return true;
		}
		return false;
	}
	public function hasVideo()
	{
		if(!empty($this->bien[$this->pos]->url_video_youtube))
			return true;
		return false;
	}
	public function hasBandeau()
	{
		global $bandeauUrl;
		
		if((!empty($this->bien[$this->pos]->bandeau) && @file($bandeauUrl.$this->bien[$this->pos]->bandeau.".png")) || $this->isVendu())
			return true;
		return false;
	}
	public function hasVendu()
	{
		if(@file("BV_base.xml"))
			return true;
		return false;
	}
	public function hasLocation()
	{
		for($i=0;$i<$this->nbBien;$i++)
		{
			if($this->bien[$i]->type_transaction == "location") return true;
		}
		return false;
	}
	public function hasLocal()
	{
		for($i=0;$i<$this->nbBien;$i++)
		{
			if(preg_match("/commer/i",$this->bien[$i]->type_bien)) return true;
		}
		return false;
	}
	public function hasTerrain()
	{
		for($i=0;$i<$this->nbBien;$i++)
		{
			if($this->bien[$i]->categorie_bien == "4") return true;
		}
		return false;
	}
	public function hasNeuf()
	{
		for($i=0;$i<$this->nbBien;$i++)
		{
			if($this->bien[$i]->neuf == "oui") return true;
		}
		return false;
	}
	public function existPosBien($id)
	{
		if($id < 0) return false;
		if($this->bien[(int)$id]->idbien != "") return true;
		
		return false;
	}
	public function hasVisite()
	{
		if(!empty($this->bien[$this->pos]->url_visite_virtuelle)) return true;
		return false;
	}
	//Format prix FR
	public function FP($prix)
	{
		return number_format((int) $prix, 0, ',', ' ');
	}
}

*/