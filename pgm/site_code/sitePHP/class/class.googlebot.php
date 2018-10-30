<?
	class Class_GoogleBot
	{
		private $GGB;
		private $GGB_DATA;
		private $hash;
		
		function __construct()
		{
			if(isset($_GET['_escaped_fragment_']))
			{
				$this->GGB = true;
				$this->hash = $_GET["_escaped_fragment_"];
				
				// $this->GGB_DATA["txt"] = false;
				// $this->GGB_DATA["bien"] = false;
				// $this->GGB_DATA["annonces"] = false;
				
				// $this->run();
			}
			else
				$this->GGB = false;
		}
		public function run()
		{

			 if(empty($this->hash))
			{
				 $this->GGB_DATA["annonces"] = true;
				 $this->GGB_DATA["loc"] = "tou les";
			}
		 elseif(preg_match("#annonce\-#",$this->hash))
		 {
				$split = explode("-",$this->hash);
				 $this->GGB_DATA["pos"] = $split[sizeof($split)-1];
				
				 $this->GGB_DATA["pos"] = substr($this->GGB_DATA["pos"],0,-1);
			
				global $C_bien;
				
				 $pos = $C_bien->getPosBienByRef($this->GGB_DATA["pos"]);
				
				 $this->GGB_DATA["pos"] = $pos;
			
				 $this->GGB_DATA["bien"] = true;
			 }
			elseif(preg_match("#page\-#",$this->hash))
			{
				 $this->GGB_DATA["txt"] = true;
				
			     $this->GGB_DATA["titre"] = car($this->hash);
				
				 if(preg_match("#-xml-#",$this->hash))
				 {
					 $this->GGB_DATA["type"] = "xml";
				 }
				 elseif(preg_match("#-page-#",$this->hash))
				 {
				    $this->GGB_DATA["type"] = "page";
				 }
				elseif(preg_match("#-frame-#",$this->hash))
				 {
					 $this->GGB_DATA["type"] = "frame";
				 }
			 }
			elseif(preg_match("#annonces\-#",$this->hash))
			{
				 $this->GGB_DATA["annonces"] = true;
			
				if(preg_match("#\-secteur#",$this->hash))
					 $this->GGB_DATA["type"] = "secteur";
					
				elseif(preg_match("#\-ville#",$this->hash))
					$this->GGB_DATA["type"] = "ville";
				else
					$this->GGB_DATA["type"] = "all";
				
				 if($this->GGB_DATA["type"] == "all")
				$this->GGB_DATA["loc"] = "tou les";
				else
				{
					preg_match("#annonces-immobilieres-(.*?)-".$this->GGB_DATA["type"]."/#",$this->hash,$r);
					 $this->GGB_DATA["loc"] = $r[1];
				 }
			}
		}
		public function getTitrePage()
		{
			global $C_page;
			global $C_bien;
			
			if($this->GGB_DATA["bien"])
			{
				$C_bien->setBienByPos($C_bien->getPosBienByRef($this->GGB_DATA["pos"],true));
				$titrePage = car($C_bien->getTypeBien())." - ".$C_bien->getPrix(true)." - ".$C_bien->getLocalisation();
			}
			elseif($this->GGB_DATA["type"] == "xml" || $this->GGB_DATA["type"] == "page")
			{
				$this->GGB_DATA["page"] = $C_page->getNameByTitle(str_replace("/","",$this->GGB_DATA["titre"]),$this->GGB_DATA["type"]);
				$C_page->setPageSelect($this->GGB_DATA["page"]);
				
				$titrePage = car($C_page->getTitre());
			}
			elseif($this->GGB_DATA["type"] == "frame")
			{
				$this->GGB_DATA["titreP"] = str_replace(array("page-frame-","-","/"),array(""," ",""),$this->GGB_DATA["titre"]);
				$this->GGB_DATA["titreP"] = preg_split("/ /",$this->GGB_DATA["titreP"]);
				
				foreach($this->GGB_DATA["titreP"] as $ch)
					$this->GGB_DATA["t"] .= ucfirst($ch)." ";
				
				$titrePage = substr($this->GGB_DATA["t"],0,-1);
			}
			elseif($this->GGB_DATA["annonces"])
			{
				if(preg_match("/tou.*?les/",$this->GGB_DATA["loc"]))
					$titrePage = "Annonces immobilières ".$agence->nom_agence;
				else
				{
					$titrePage = "Annonces immobilières ".ucfirst(str_replace("-"," ",$this->GGB_DATA["loc"]));
				}
			}
			return $titrePage;
		}
		public function getLoc()
		{
			return $this->GGB_DATA["loc"];
		}
		public function getHash()
		{
			return $this->hash;
		}
		public function getUrl()
		{
			global $dir;
			return "http://".$_SERVER['HTTP_HOST']."/#!".$dir.$this->hash;
		}
		public function getData()
		{
			return $this->GGB_DATA;
		}
		public function getText()
		{
			global $C_page;
			global $agence;
			
			if($this->GGB_DATA["type"] == "xml")
			{
				// echo $GGB_DATA["titre"];
				$this->GGB_DATA["page"] = $C_page->getNameByTitle(str_replace("/","",car($this->GGB_DATA["titre"],"low-é")),$this->GGB_DATA["type"]);
				$C_page->setPageSelect($this->GGB_DATA["page"]);
				
				$html = '
				<div class="xml" itemscope itemtype="http://schema.org/Article">
					<span class="hide" itemprop="url">'.$this->getUrl().'</span>
					<span class="hide" itemprop="author">'.$agence->nom_agence.'</span>	
					<h1 itemprop="name">'.car($C_page->getTitre()).'</h1>
					<div class="txt" itemprop="articleBody">
						'.car($C_page->getText()).'
					</div>
				</div>';			
			}
			elseif($this->GGB_DATA["type"] == "page")
			{	
				$this->GGB_DATA["page"] =  $C_page->getNameByTitle(str_replace("/","",$this->GGB_DATA["titre"]),$this->GGB_DATA["type"]);
				
				$html = '
				<div class="xml" itemscope itemtype="http://schema.org/Article">
					<span class="hide" itemprop="url">'.$this->getUrl().'</span>
					<span class="hide" itemprop="author">'.$agence->nom_agence.'</span>	
					<h1 itemprop="name">'.car($C_page->getTitre()).'</h1>
					<div class="txt" itemprop="articleBody">
						'.car($C_page->getText()).'
					</div>
				</div>';
			}
			elseif($this->GGB_DATA["type"] == "frame")
			{	
				$this->GGB_DATA["page"] = str_replace(array("page-frame-","-","/"),"",$this->GGB_DATA["titre"]);
				
				$html = '<iframe src="page/'.$this->GGB_DATA["page"].'/'.$this->GGB_DATA["page"].'.php" frameborder="0"></iframe>';
			}
			
			return $html;
		}
		public function getPos()
		{
			return $this->GGB_DATA["pos"];
		}
		
		public function isGGB()
		{
			
			return $this->GGB;
		}
		public function isText()
		{
			if($this->GGB_DATA["txt"])return true;
			return false;
		}
		public function isAnnonces()
		{
			if($this->GGB_DATA["annonces"])return true;
			return false;
		}
		public function isBien()
		{
			if($this->GGB_DATA["bien"])return true;
			return false;
		}
		
		public function forceShow($t)
		{
			if($this->GGB_DATA[$t])
				return " force-show ";
			return "";
		}
	}
?>