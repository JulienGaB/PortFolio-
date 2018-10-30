		<?php 
		// On se positionne sur le bien
		$Pos = $C_bien->getPosBienByID($_GET["id"]);
		$C_bien->setBienByPos($Pos);
		$type_trans = $C_bien->getAllInfos()->categorie_bien;
		?>
      <!-- Page Contents-->
      <main class="page-content">
        <!--Section The Presidio Residences-->
        <section class="section-98 section-sm-110">
          <div class="shell">
            <h2 class="text-bold"><?php echo $C_bien->getTypeBien();?></h2>
            <hr class="divider bg-saffron">
            <div class="offset-sm-top-66">
              <div class="range">
                <div class="cell-md-7 cell-lg-8">
                  <!-- Owl Carousel-->
				  <?php $images = $C_bien->getImages();
					$nbimages = $C_bien->getNbImages();
				  ?>
                  <div data-items="1" data-dots="true" data-nav="true" data-nav-class="[&quot;owl-prev mdi mdi-chevron-left&quot;, &quot;owl-next mdi mdi-chevron-right&quot;]" data-photo-swipe-gallery="" class="owl-carousel owl-carousel-classic">
						<?php foreach ($images as $image){ 
						
						echo "<a class='thumbnail-classic' data-photo-swipe-item='' data-size='770x510' href='".$image."'>
                      <figure><img width='770' height='510' src='".$image."' alt='".$C_bien->getTypeBien()." ".$C_bien->getLocalisation()." ".$agence->nom_agence."' title= ".$C_bien->getTypeBien()." ".$C_bien->getLocalisation()." ".$agence->nom_agence."'/>
                      </figure></a>";
						
						}
						
						?>
						
					  <?php /*
					  <a class="thumbnail-classic" data-photo-swipe-item="" data-size="770x510" href="images/single-property-page-01-770x510.jpg">
                      <figure><img width="770" height="510" src="images/single-property-page-01-770x510.jpg" alt=""/>
                      </figure></a>
					  <a class="thumbnail-classic" data-photo-swipe-item="" data-size="770x510" href="images/single-property-page-02-770x510.jpg">
                      <figure><img width="770" height="510" src="images/single-property-page-02-770x510.jpg" alt=""/>
                      </figure></a>
					  <a class="thumbnail-classic" data-photo-swipe-item="" data-size="770x510" href="images/single-property-page-03-770x510.jpg">
                      <figure><img width="770" height="510" src="images/single-property-page-03-770x510.jpg" alt=""/>
                      </figure></a>
					  <a class="thumbnail-classic" data-photo-swipe-item="" data-size="770x510" href="images/single-property-page-05-770x510.jpg">
                      <figure><img width="770" height="510" src="images/single-property-page-05-770x510.jpg" alt=""/>
                      </figure></a>
					  <a class="thumbnail-classic" data-photo-swipe-item="" data-size="770x510" href="images/single-property-page-06-770x510.jpg">
                      <figure><img width="770" height="510" src="images/single-property-page-06-770x510.jpg" alt=""/>
                      </figure></a>
					  <a class="thumbnail-classic" data-photo-swipe-item="" data-size="770x510" href="images/single-property-page-07-770x510.jpg">
                      <figure><img width="770" height="510" src="images/single-property-page-07-770x510.jpg" alt=""/>
                      </figure></a>
					  <a class="thumbnail-classic" data-photo-swipe-item="" data-size="770x510" href="images/single-property-page-08-770x510.jpg">
                      <figure><img width="770" height="510" src="images/single-property-page-08-770x510.jpg" alt=""/>
                      </figure></a>
					  <a class="thumbnail-classic" data-photo-swipe-item="" data-size="770x510" href="images/single-property-page-08-770x510.jpg">
                      <figure><img width="770" height="510" src="images/single-property-page-08-770x510.jpg" alt=""/>
                      </figure></a>   */?>
                  </div>
                  <div class="text-sm-left offset-top-50">
                    <h5 class="text-bold">Description</h5>
                    <p><?php echo $C_bien->getDescription();?></p>
                  </div>
                  <div class="offset-top-30">
                    <!-- Bootstrap Table-->
                    <div class="table-responsive clearfix">
                      <table class="table table-striped">
                        <tr>
                          <th>Détails</th>
                          <th></th>
                        </tr>
						<?php $details = $C_bien->getDetailsNew();
						foreach ($details as $key=>$val){
							
							echo "<tr>
                          <th>".$key."</th>
                          <td>".$val."</td>
                        </tr>";
						}
						 ?>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="cell-md-5 cell-lg-4 text-md-left inset-md-left-30 offset-top-66 offset-sm-top-0">
                  <div class="range">
				  <?php if ($globales->afficher_conseiller_bien == "oui"){?>
                    <div class="cell-xs-12 offset-top-50 cell-md-push-4">
                      <div class="unit unit-md unit-md-horizontal">
                        <div class="unit-left"><img src="images/users/user-shirley-vasquez-120x120.jpg" width="120" height="120" alt="" class="img-responsive reveal-inline-block"></div>
                        <div class="unit-body">
                          <div>
                            <h5 class="text-primary text-bold"><?php echo $C_bien->getAllInfos()->nom_conseiller ?></h5>
                          </div>
                          <div class="offset-top-10">
                            <address class="contact-info text-md-left">
                              <ul class="list-unstyled p">
                                <li class="reveal-block"><span class="icon icon-xxs mdi mdi-phone text-middle"></span> <a href="callto:<?php echo $agence->telephone_agence ?>" class="reveal-inline-block text-middle"><?php echo $agence->telephone_agence ?></a>
                                </li>
                                <li class="reveal-block"><span class="icon icon-xxs mdi mdi-email-open text-middle"></span> <a href="mailto:<?php echo $agence->email_agence ?>" class="reveal-inline-block text-middle"><?php echo $agence->email_agence ?></a>
                                </li>
                              </ul>
                            </address>
                          </div>
                        </div>
                      </div>
                    </div>
				  <?php } ?>
                    <div class="cell-xs-12 cell-md-push-1 offset-top-41 offset-md-top-0">
                      <p><span class="text-middle mdi-forward mdi text-light icon icon-xxs"></span> <span><?php echo "Référence : ".$C_bien->getReference(); ?></span>
                      </p>
                      <div class="offset-top-20 offset-md-top-50">
                        <ul class="list-inline list-inline-dotted text-dark">
                          <li><span class="input-group-icon mdi mdi-home"></span> <?php echo floor($C_bien->getAllInfos()->surface_habitable)." m²";?></li>
                          <li><span class="input-group-icon mdi mdi-view-quilt"></span> <?php echo floor($C_bien->getAllInfos()->nb_piece);?><?php if ($C_bien->getAllInfos()->nb_piece > 1) { echo " pièces"; } else  {  echo " pièce"; }?></li>
                          <li><span class="input-group-icon mdi mdi-hotel"></span> <?php echo floor($C_bien->getAllInfos()->nb_chambre);?><?php if ($C_bien->getAllInfos()->nb_chambre > 1) { echo " chambres"; } else  {  echo " chambre"; }?></li>
                          
                        </ul>
                      </div>
                      <div class="offset-top-20 offset-md-top-50">
                        <h5 class="text-bold"><?php echo $C_bien->getPrix();?></h5>
                      </div>
                    </div>
                    <div class="cell-xs-12 cell-md-push-2 offset-top-41 offset-md-top-20"><a href="http://consutest.ovh/IntenseFR/index.php?p=4&id=<?php echo $_GET["id"]?>&contact=1" class="btn btn-primary">Nous Contacter</a>
                      <div class="offset-top-10"><a href="http://consutest.ovh/IntenseFR/index.php?p=4&id=<?php echo $_GET["id"]?>&contact=2" class="btn btn-info">Demander une visite</a></div>
                    </div>
                    <div class="cell-xs-12 offset-top-66 cell-md-push-3">
<?php 
				
				/*	require_once("./bat/geocoding.php");
						$key = array_search($agence->adresse_agence." ".$agence->code_postal_agence." ".$agence->ville_agence,$address);
						if ($key != false){
							$Lng = (string) $address[$key][0];
							$Lat = (string) $address[$key][1];
						}
				*/
				
				$a = $C_bien->getAllInfos()->code_postal." ".$C_bien->getAllInfos()->ville;
					$result = array();
					$result = $GeoLoc->GetLatLng($a);
					$Lat = $result[0];
					$Lng = $result[1];
					
						
				?>
				<style type="text/css">
				#map{
					height : 700px;
					width : 369.98px;
				}
				#iframemap {
					height : 700px;
					width : 369.98px;
					overflow : hidden;
				}
				
				</style>
				<div  id="map" class="liftstyle"><iframe id="iframemap" scrolling="no" src="<?php echo 'http://consutest.ovh/api/testmap.php?x='.$Lng.'&y='.$Lat.'&circle=true&marker=true' ?> "></iframe></div>
                
                </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
        </section>
        <!--Section Similar Properties-->
        <?php 
					$bienssim = $C_bien->getBiens();
					$arraysim = array();
		
			foreach ($bienssim as $pos){
				$C_bien->setBienByPos($pos);
			
				if ((int) $C_bien->getAllInfos()->categorie_bien == (int) $type_trans){
						$arraysim[] = $pos;
		}
}
		$simcount = count($arraysim);
		
		$array_key = array_rand($arraysim, 1);
		$random1 = $arraysim[$array_key];
		
		$afficher2 = false;
		if ($simcount > 1 ){
		do {
		$array_key2 = array_rand($arraysim, 1);
		$random2 = $arraysim[$array_key2];
		}
		while ($random2 == $random1);
		$afficher2 = true;
		}

		$afficher3 = false;
		if ($simcount > 2 ){
		do {
		$array_key3 = array_rand($arraysim, 1);
		$random3 = $arraysim[$array_key3];
		}
        while ($random3 == $random1 || $random3 == $random2);
		$afficher3 = true;
		}

		
        $bien1->setBienByPos($random1);
		if ($afficher2)
        $bien2->setBienByPos($random2);
		if ($afficher3)
        $bien3->setBienByPos($random3);
        

     
        
                 ?>
        <section class="section-bottom-98 section-sm-bottom-110">
          <div class="shell">
            <h2 class="text-bold">Biens Similaires</h2>
            <hr class="divider bg-saffron">
            <div class="offset-sm-top-66">
              <div class="range range-xs-center">
                <div class="cell-sm-4 bienhover"><div class="grid"><figure class="effect-lexi"><img src="<?php echo $bien1->getAllInfos()->images[0]->image_1?>" width="370" height="250" alt="" class="img-responsive reveal-inline-block "><figcaption>
							
							<p>Cliquez pour plus de détails</p>
							<a href="./index.php?p=2&id=<?php echo $bien1->getAllInfos()->idbien?>">Plus de détails</a>
						</figcaption></figure>
                </div>
                  <div class="text-sm-left offset-top-24">
                    <div>
                      <h5 class="text-bold text-primary"><a href="./index.php?p=2&id=<?php echo $bien1->getAllInfos()->idbien?>"><?php echo $bien1->getTypeBien();?></a></h5>
                    </div>
                    <h6 class="offset-top-10"> <?php echo $bien1->getPrix();?></h6>
                    <ul class="list-inline list-inline-dotted text-dark">
                      <li><?php echo floor($bien1->getAllInfos()->surface_habitable)." m²";?></li>
                          <li><?php echo floor($bien1->getAllInfos()->nb_piece);?><?php if ($bien1->getAllInfos()->nb_piece > 1) { echo " pièces"; } else  {  echo " pièce"; }?></li>
                          <li><?php echo floor($bien1->getAllInfos()->nb_chambre);?><?php if ($bien1->getAllInfos()->nb_chambre > 1) { echo " chambres"; } else  {  echo " chambre"; }?></li>
                    </ul>
                    <div>
                      <p><?php echo substr(utf8_encode($bien1->getDescription()),0,160)."...";?></p>
                    </div>
                  </div>
                </div>
                <div class="cell-sm-4 offset-top-66 offset-sm-top-0 bienhover"><div class="grid"><figure class="effect-lexi"><img src="<?php echo $bien2->getAllInfos()->images[0]->image_1?>" width="370" height="250" alt="" class="img-responsive reveal-inline-block "><figcaption>
							
							<p>Cliquez pour plus de détails</p>
							<a href="./index.php?p=2&id=<?php echo $bien1->getAllInfos()->idbien?>">Plus de détails</a>
						</figcaption></figure>
                </div>
                  <div class="text-sm-left offset-top-24">
                    <div>
                      <h5 class="text-bold text-primary"><a href="./index.php?p=2&id=<?php echo $bien2->getAllInfos()->idbien?>"><?php echo $bien2->getTypeBien();?></a></h5>
                    </div>
                    <h6 class="offset-top-10"> <?php echo $bien2->getPrix();?></h6>
                    <ul class="list-inline list-inline-dotted text-dark">
                      <li><?php echo floor($bien2->getAllInfos()->surface_habitable)." m²";?></li>
                          <li><?php echo floor($bien2->getAllInfos()->nb_piece);?><?php if ($bien2->getAllInfos()->nb_piece > 1) { echo " pièces"; } else  {  echo " pièce"; }?></li>
                          <li><?php echo floor($bien2->getAllInfos()->nb_chambre);?><?php if ($bien2->getAllInfos()->nb_chambre > 1) { echo " chambres"; } else  {  echo " chambre"; }?></li>
                    </ul>
                    <div>
                      <p><?php echo substr(utf8_encode($bien2->getDescription()),0,160)."...";?></p>
                    </div>
                  </div>
                </div>
                <div class="cell-sm-4 offset-top-66 offset-sm-top-0 bienhover"><div class="grid"><figure class="effect-lexi"><img src="<?php echo $bien3->getAllInfos()->images[0]->image_1?>" width="370" height="250" alt="" class="img-responsive reveal-inline-block "><figcaption>
							
							<p>Cliquez pour plus de détails</p>
							<a href="./index.php?p=2&id=<?php echo $bien1->getAllInfos()->idbien?>">Plus de détails</a>
						</figcaption></figure>
                </div>
                  <div class="text-sm-left offset-top-24">
                    <div>
                      <h5 class="text-bold text-primary"><a href="./index.php?p=2&id=<?php echo $bien3->getAllInfos()->idbien?>"><?php echo $bien3->getTypeBien();?></a></h5>
                    </div>
                    <h6 class="offset-top-10"> <?php echo $bien3->getPrix();?></h6>
                    <ul class="list-inline list-inline-dotted text-dark">
                      <li><?php echo floor($bien3->getAllInfos()->surface_habitable)." m²";?></li>
                          <li><?php echo floor($bien3->getAllInfos()->nb_piece);?><?php if ($bien3->getAllInfos()->nb_piece > 1) { echo " pièces"; } else  {  echo " pièce"; }?></li>
                          <li><?php echo floor($bien3->getAllInfos()->nb_chambre);?><?php if ($bien3->getAllInfos()->nb_chambre > 1) { echo " chambres"; } else  {  echo " chambre"; }?></li>
                    </ul>
                    <div>
                      <p><?php echo substr(utf8_encode($bien2->getDescription()),0,160)."...";?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>
