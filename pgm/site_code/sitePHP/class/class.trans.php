<?php
	Class Class_Translate
	{	
		private $text;
		private $file;
		
		public function load($file)
		{
			$this->file = $file;
		}
		public function getText()
		{
			$this->text = array();
			$this->text = parse_ini_file($this->file,true);
		}
		public function t($mot)
		{
			global $lang;
			// print_r($this->text);	
			// echo $lang;
			if(!empty($this->text[$lang][(string)$mot]))
				return ucfirst($this->text[$lang][(string)$mot]);
			else
				return $mot;
		}
	}
?>