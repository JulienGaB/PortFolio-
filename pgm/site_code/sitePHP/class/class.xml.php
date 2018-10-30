<?php 
	Class Class_XML
	{
		private $xml; 
		
		function __construct($xml = "",$run = false)
		{
			$this->xml = $xml;
			if($run)
			{
				$this->parse();
				return $this->getContentXML();
			}
		}
		public function load($xml)
		{
			$this->xml = $xml;
		}
		public function parse()
		{
			$this->contentXML = (file_get_contents($this->xml));
			$this->contentXML = str_replace("","",file_get_contents($this->xml));
			$this->contentXML = simplexml_load_string($this->contentXML, null, LIBXML_NOCDATA);	
		}
		public function getContentXML()
		{	
			return $this->contentXML;
		}
	}
?>