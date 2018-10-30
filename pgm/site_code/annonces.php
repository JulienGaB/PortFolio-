<div class="propositions_des_annonces_total_page row">
		<div class="espace_blanc col-md-1">
		</div>
		<div class="placement_page_annonces col-md-10 col-sm-12 col-xs-12 row">
		<?php
			 $cpt = 1;
			foreach($biens as $pos){
			 $C_bien->setBienByPos($pos);
			 if($cpt%2==1){
				 ?>
					<div class="Annonces_classement col-md-5 col-sm-6 col-xs-12 wow fadeInLeft">
						<table>
							<tr>
								<td colspan="3" class="position_relative">
									<div class="prix">
										<img src="<?php echo $C_bien->getImagePrinc() ?>" alt="photo du bien" />
										<img src="./icon/prix.png" class="post_it" alt="post it de fond du prix" />
										<span class="prix_foyer"><?php echo $C_bien->getPrix() ?></span>
										<span class="secteur_foyer"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $C_bien->getLocalisation() ?></span>
									</div>
								</td>					
							</tr>	
							<tr>
								<td colspan="2">
									<p><?php echo $C_bien->getTypeBien() ?></p>
								</td>					
								<td>
									<a href="./index.php?p=2&id=<?php echo $C_bien->getAllInfos()->idbien?>">
										<h2>DECOUVRIR</h2>
									</a>
								</td>
							</tr>						
							<tr>						
								<td style="text-align:left;">
									<i class="fa fa-home" aria-hidden="true"></i> <?php echo $C_bien->getSuperficie() ?>
								</td>			
								<td style="text-align:left;">
									<i class="fa fa-bed" aria-hidden="true"></i> <?php echo $C_bien->getNbChambres() ?>
								</td>			
								<td>
									<?php
									$bandeauInfos = $C_bien->getUrlBandeau();
									$bandeau = $bandeauInfos[0];
									$alt = $bandeauInfos[1];
									?>
									<img src="<?php echo $bandeau?>" class="banderolle" alt="<?php echo $alt?>"  />
								</td>
							</tr>
							<tr>						
								<td style="text-align:left;">
									<i class="fa fa-square" aria-hidden="true"></i> <?php echo $C_bien->getNbPieces() ?>
								</td>			
								<td style="text-align:left;" colspan="2">
									<i class="fa fa-file-text" aria-hidden="true"></i> Référence : <?php echo $C_bien->getReference() ?>
								</td>				
							</tr>
							<tr>
								<td colspan="3">
									<p class="description_foyer">
										<?php echo $C_bien->getDescription() ?>
									</p>
								</td>
							</tr>
						</table>
					</div>
					<div class="espace_blanc col-md-2">
				</div>
				<?php }
				else
				{ ?>
				<div class="Annonces_classement col-md-5 col-sm-6 col-xs-12 wow fadeInRight">
					<table>
							<tr>
								<td colspan="3" class="position_relative">
									<div class="prix">
										<img src="<?php echo $C_bien->getImagePrinc() ?>" alt="photo du bien" />
										<img src="./icon/prix.png" class="post_it" alt="post it de fond du prix" />
										<span class="prix_foyer"><?php echo $C_bien->getPrix() ?></span>
										<span class="secteur_foyer"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $C_bien->getLocalisation() ?></span>
									</div>
								</td>					
							</tr>	
							<tr>
								<td colspan="2">
									<p><?php echo $C_bien->getTypeBien() ?></p>
								</td>					
								<td>
									<a href="./index.php?p=2&id=<?php echo $C_bien->getAllInfos()->idbien?>">
										<h2>DECOUVRIR</h2>
									</a>
								</td>
							</tr>						
							<tr>						
								<td style="text-align:left;">
									<i class="fa fa-home" aria-hidden="true"></i> <?php echo $C_bien->getSuperficie() ?>
								</td>			
								<td style="text-align:left;">
									<i class="fa fa-bed" aria-hidden="true"></i> <?php echo $C_bien->getNbChambres() ?>
								</td>			
								<td>
									<?php
									$bandeauInfos = $C_bien->getUrlBandeau();
									$bandeau = $bandeauInfos[0];
									$alt = $bandeauInfos[1];
									?>
									<img src="<?php echo $bandeau?>" class="banderolle" alt="<?php echo $alt?>"  />
								</td>
							</tr>
							<tr>						
								<td style="text-align:left;">
									<i class="fa fa-square" aria-hidden="true"></i> <?php echo $C_bien->getNbPieces() ?>
								</td>			
								<td style="text-align:left;" colspan="2">
									<i class="fa fa-file-text" aria-hidden="true"></i> Référence : <?php echo $C_bien->getReference() ?>
								</td>				
							</tr>
							<tr>
								<td colspan="3">
									<p class="description_foyer">
										<?php echo $C_bien->getDescription() ?>
									</p>
								</td>
							</tr>
						</table>
				</div>
				<div class="clear"></div>
				<?php }
		 $cpt++;
		}
				?>
		</div>	
		<div class="espace_blanc col-md-1">
		</div>	
<div class="clear">
	</div>		
	<div class="changement_page">
		<i class="fa fa-arrow-left" aria-hidden="true"></i>
		<span>2</span>
		<i class="fa fa-arrow-right" aria-hidden="true"></i>	
	</div>
	<div class="clear">
	</div>
</div>