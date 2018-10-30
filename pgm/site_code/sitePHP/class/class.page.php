<?
Class Class_GetPage
{
	private $xml;

	private $page;
	private $lien;
	
	private $select;
	private $nbPage;
	
	private $arrayPage;
	
	function __construct($xml="")
	{
		if(!empty($xml))
			$this->xml = $xml;
		$this->nbPage = -1;
	}
	
	public function load($xml)
	{
		if(!empty($xml))
		{
			if(is_array($xml))
				$this->xml = $xml;
			else
			{
				$this->page = $xml;
				$this->lien = "page/".$this->page;
			}
		}
	}
	public function hasHtml()
	{
		for($i=1;$i<=4;$i++)
		{
			if(@file("page/".$i.".txt"))
				return true;
		}
		return false;
	}
	public function getPageHTML()
	{
		$array = array();
		for($i=1;$i<=4;$i++)
		{
			if(@file("page/".$i.".txt"))
				$array[] = $i.".txt";
		}
		return $array;
	}
	public function htmlExist()
	{
		if(@file($this->lien))
			return true;
		return false;
	}
	public function getHtml($limit,$more,$h1)
	{
		$html = file_get_contents($this->lien);
		
		if($limit)
		{
			if(strlen($html) > 200)
				$html = substr($html,0,$limit)."...";
		}
		if($h1)
			$html = preg_replace("#<h1>.*?</h1>(<br/>)?#","",$html);
		if($more)
			$html .= '<br/><a href="#/page-'.$this->page.'/" class="pages more" data-page="'.$this->page.'" data-type="page">>> Lire la suite</a>';
		return $html;
	}
	public function getPages()
	{
		if(!empty($this->arrayPage))
			return $this->arrayPage;
			
		$this->arrayPage = array();
		foreach($this->xml as $xml)
		{
			foreach($xml as $key => $val)
			{
				if(preg_match("/page/",$key))
				{
					if($val != "" && $this->getTitre($key))
					{
						$this->arrayPage[] = $key;
					}
				}
			}
		}
		if($this->hasHtml())
		{
			foreach($this->getPageHTML() as $val)
			{
				$this->arrayPage[] = $val;
			}
		}
		
		// print_r($this->arrayPage);
		
		$this->nbPage = sizeof($this->arrayPage);
		return $this->arrayPage;
	}
	public function setPageSelect($select)
	{
		if(!empty($select))
		{
			if(is_numeric($select))
				$this->select = "page".$select;
			else
				$this->select = $select;
		}
	}
	
	public function setText($page,$txt){
		preg_replace(array("&lt;","&gt;","Ã©","Ã¨"),array("<",">","é","è"),$txt);		
		file_put_contents("./page/".$page,$txt);
	}
	
	public function getText()
	{
		global $lang;

		if($this->getType()=="xml")
		{
			$s = $this->select;
			$this->xml->$s = preg_replace("#&lt;!\-\-.*?&gt;(.*?)&lt;/.*?&gt;#","",$this->xml->$s);
			$this->xml->$s = preg_replace("#’#","'",$this->xml->$s);
			
			if(preg_match("#(&lt;EN.*?&gt;(.*?)&lt;/EN.*?&gt;)|(<EN>(.*?)</EN>)#",$this->xml->$s,$r))
			{
				if($lang=="fr")
				{
					preg_match("#(^(.*?)&lt;EN.*?&gt;)|(^(.*?)<EN>)#",$this->xml->$s,$r);
					return $r[0];
				}
				else
					return $r[0];
			}
			else
			{
				return $this->xml->$s;
			}
		}
		elseif($this->getType()=="page")
		{
			global $agence;
			global $logo;
			global $ovh;
			global $capital;
			global $devise;
			global $siege;
			global $siret;
			global $responsablepub;
			global $mailres;
			global $tva;
			global $RCS;
			global $numcartepro;
			global $raison;
			global $ndd;
			global $oneandone;
			global $hebergeur;
			global $telhebergeur;
			global $modele;
			
			$txt = file_get_contents("./page/".$this->select);
			
			preg_match_all("/(\[.*?\])+/",$txt,$array);
			foreach($array[0] as $a)
			{
				$eval = str_replace(array("[","]"),"",$a);
				eval("\$eval = ".$eval.";");
				$txt = str_replace($a,$eval,$txt);
				
			}
			
			if(preg_match("#(&lt;EN.*?&gt;(.*?)&lt;/EN.*?&gt;)|(<EN>(.*?)</EN>)#",$txt,$r))
			{
				if($lang=="fr")
				{
					$txt = preg_replace("#(&lt;EN.*?&gt;(.*?)&lt;/EN.*?&gt;)|(<EN>(.*?)</EN>)#","",$txt);
					
					return $txt;
				}
				else
					return $r[0];
			}
			else
			{
				return $txt;
			}
		}
	}
	
	public function setName($name){
		$this->select = $name;
	}
	public function getName()
	{
		return $this->select;
	}
	public function getType()
	{
		if(preg_match("/txt/",$this->select))
		{
			return "page";
		}
		elseif(preg_match("/page/",$this->select))
		{
			return "xml";
		}
	}
	public function getTitre($sel="")
	{
		global $t;
		
		if(!empty($sel))$s = $sel;
		else $s = $this->select;
		
		if(preg_match("/txt/",$s))
			$txt = file_get_contents("./page/".$s);
		else
			$txt = $this->xml->$s;
		
		preg_match("#<!\-\-.*?>(.*?)</#",$txt,$r);
		
		if(empty($r[1]))
			preg_match("#&lt;!\-\-.*?&gt;(.*?)&lt;/#",$txt,$r);
		
		if($t->t(car($r[1],"low-é")) != car($r[1],"low-é"))
			return $t->t(car($r[1],"low-é"));
			
		return $r[1];
	}
	public function getNameByTitle($title,$ty=false)
	{
		foreach($this->getPages() as $val)
		{
			$this->setPageSelect($val);
			
			if($title == car($this->getTitre(),"élow-"))
				return $val;
		}
	}
	public function getNbPage()
	{
		if($this->nbPage == -1)
		{
			$this->getPages();
		}
		return $this->nbPage;
	}
} 
?>