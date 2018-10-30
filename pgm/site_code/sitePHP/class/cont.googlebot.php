<?
	if(isset($_GET['_escaped_fragment_']) && !empty($_GET['_escaped_fragment_']))
	{
		$GGB_DATA = array();
		$GGB = true;
		$GGB_DATA["hash"] = $_GET["_escaped_fragment_"];
		$GGB_DATA["txt"] = false;
		$GGB_DATA["bien"] = false;
		$GGB_DATA["annonces"] = false;
		
		if(preg_match("#annonce\-#",$GGB_DATA["hash"]))
		{
			$split = explode("-",$GGB_DATA["hash"]);
			$GGB_DATA["pos"] = $split[sizeof($split)-1];
			$GGB_DATA["bien"] = true;
		}
		elseif(preg_match("#page\-#",$GGB_DATA["hash"]))
		{
			$GGB_DATA["txt"] = true;
			$GGB_DATA["titre"] = car($_GET["_escaped_fragment_"]);
			
			if(preg_match("#-xml-#",$GGB_DATA["hash"]))
			{
				$GGB_DATA["type"] = "xml";
			}
			elseif(preg_match("#-page-#",$GGB_DATA["hash"]))
			{
				$GGB_DATA["type"] = "page";
			}
			elseif(preg_match("#-frame-#",$GGB_DATA["hash"]))
			{
				$GGB_DATA["type"] = "frame";
			}
		}
		elseif(preg_match("#annonces\-#",$GGB_DATA["hash"]))
		{
			$GGB_DATA["annonces"] = true;
			
			if(preg_match("#\-secteur#",$GGB_DATA["hash"]))
				$GGB_DATA["type"] = "secteur";
				
			elseif(preg_match("#\-ville#",$GGB_DATA["hash"]))
				$GGB_DATA["type"] = "ville";
			else
				$GGB_DATA["type"] = "all";
			
			if($GGB_DATA["type"] == "all")
				$GGB_DATA["loc"] = "tou les";
			else
			{
				preg_match("#annonces-immobilieres-(.*?)-".$GGB_DATA["type"]."/#",$GGB_DATA["hash"],$r);
				$GGB_DATA["loc"] = $r[1];
			}
		}
	}
	else
	{
		$GGB = false;
	}	
?>