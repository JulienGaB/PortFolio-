<section>
	<div class="container">
		<div class="bg_presentation">
			<img class="img_recherche" src="<?=$imagePage?>" alt="Presentation">
		</div>
	</div>
</section>

<!-- BLOC PRESENTATION -->
<section id="bloc_presentation">
	<div class="container">
		<div class="row">
		
		<?php $val = $C_page->getNameByTitle($_GET["title"]);
			
				if ($_GET["title"] == "presentation" && $lang!="fr"){
					$file = "2_".$lang.".txt";
					$C_page->setName($file);
					
				} ?>
			<div class="col-md-12 titre_presentation text-center">
				
				<h1><?=$C_page->getTitre()?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			<?php $val = $C_page->getNameByTitle($_GET["title"]);
				if ($_GET["title"] == "presentation" && $lang!="fr"){
					$file = "2_".$lang.".txt";
					$C_page->setName($file);
				} ?>
			<?=$C_page->getText()?>
				
			</div>
		</div>
	</div>
</section>
<!-- /BLOC PRESENTATION -->