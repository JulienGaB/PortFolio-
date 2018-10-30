<?
Class Class_GetVisite
{
	private $pos;
	private $data;
	
	public function __construct($pos = 0)
	{
		if($this->setPos($pos))
		{
			$this->getData();
			
			$this->addVisiteurByPosBien();
			
			$this->del30daysNbVisiteur();
			
			$this->saveData();
		}
	}
	
	public function addVisiteurByPosBien()
	{

		if(empty($this->pos))
			return false;
		if($this->hasShowThisPage())
			return false;

		$date = date("Ymd");
		
		if(empty($this->data[$this->pos]))
			$this->data[$this->pos][$date] = 0;
			
		$this->data[$this->pos][$date]++;
		
		$_SESSION["visite"] .= "|".$this->pos."|";

		return true;
	}
	
	public function getAllVisiteurByPosBien()
	{
		if(empty($this->pos))
			return false;

		$nb = 0;

		foreach($this->data[$this->pos] as $v)
		{
		
			$nb += $v;
			
		}

		return $nb;
	}
	
	public function hasShowThisPage()
	{
		if(preg_match("/\|".$this->pos."\|/",$_SESSION["visite"]))
			return true;
		return false;
	}

	public function setPos($pos)
	{
		if($pos === 0 || empty($pos))
			return false;
				
		$this->pos = $pos;
		
		return true;
	}
	
	public function saveData($file = "./visites.json")
	{		
		if(file_put_contents($file,json_encode($this->data)))
			return true;
		return false;
	}
	
	public function getData($file = "./visites.json")
	{
		$json = file_get_contents($file);

		$this->data = json_decode($json,true);
		
		return true;
	}
	
	public function del30daysNbVisiteur()
	{
		$ddj = date("Ymd");
		$d1m = date("Ymd",(time-3600*24*30));
		
		unset($this->data[$this->pos][$d1m]);
	}
}
?>