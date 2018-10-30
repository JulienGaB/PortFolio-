<?php $html = "
	<html xmlns=\"http://www.w3.org/1999/xhtml\">
		<body style=\"margin:0;padding:0;min-width:100%!important;\">
			<table width=\"100%\" color=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
					<td>
						<table style=\"width:100%;max-width:800px;\" bgcolor=\"#f6f8f1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
							<tr>
								<td style=\"padding:40px 30px 20px 30px; background-color:#222\">
									<table width=\"70\" align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
										<tr>
											<td height=\"70\" style=\"padding:0 20px 20px 0;\">
												<img style=\"height:auto;\" src=\".././img/logo.png\" width=\"70\" height=\"70\" border=\"0\" alt=\"\" />
											</td>
										</tr>
									</table>
									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%;max-width:425px;\">
										<tr>
											<td height=\"70\">
												<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
													<tr>
														<td style=\"font-size:15px;color:#ffffff;font-family:sans-serif;letter-spacing:10px;\" style=\"padding:0 0 0 3px;\">
															CONTACT
														</td>
													</tr>
													<tr>
														<td style=\"font-family:sans-serif;font-size:33px;color:#ffffff !important;line-height:38px;font-weight:bold;padding:5px 0 0 0;\">
															$agence = $xml->getContentXML()->agence
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style=\"padding:30px 30px 30px 30px;border-bottom:1px solid #f2eeed;\">
									<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
										<tr>
											<td style=\"font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\">
												Merci d'avoir enregistré cette estimation, nous vous transmettrons les résultats dés que possible !
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style=\"padding:30px 30px 30px 30px;border-bottom:1px solid #f2eeed;\">
									<table class=\"col380\" align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%;\">
										<tr>
											<td>
												<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
													<tr>
														<td style=\"width:30%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\"\">
															Type de bien :
														</td>
														<td style=\"width:70%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\">
															$type
														</td>
													</tr>
													<br />
													<tr>
														<td style=\"width:30%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\"\">
															Surface habitable :
														</td>
														<td style=\"width:70%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\">
															$surface_habitable
														</td>
													</tr>
													<br />
													<tr>
														<td style=\"width:30%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\"\">
															Surface du terrain :
														</td>
														<td style=\"width:70%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\">
															$surface_terrain
														</td>
													</tr>
													<br />
													<tr>
														<td style=\"width:30%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\"\">
															Nombre de pièces :
														</td>
														<td style=\"width:70%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\">
															$nb_piece
														</td>
													</tr>
													<br />
													<tr>
														<td style=\"width:30%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\"\">
															Nombre de chambres :
														</td>
														<td style=\"width:70%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\">
															$nb_chambre
														</td>
													</tr>
													<br />
													<tr>
														<td style=\"width:30%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\"\">
															Niveau :
														</td>
														<td style=\"width:70%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\">
															$niveau
														</td>
													</tr>
													<br />
													<tr>
														<td style=\"width:30%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\"\">
															Année de construction :
														</td>
														<td style=\"width:70%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\">
															$annee_construction
														</td>
													</tr>
													<br />
													<tr>
														<td style=\"width:30%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\"\">
															A rénover :
														</td>
														<td style=\"width:70%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\">
															$renover
														</td>
													</tr>
													<br />
													<tr>
														<td style=\"width:30%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\"\">
															Piscine :
														</td>
														<td style=\"width:70%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\">
															$piscine
														</td>
													</tr>
													<br />
													<br />
													<tr>
														<td style=\"width:30%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\"\">
															Adresse :
														</td>
														<td style=\"width:70%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\">
															$adresse
														</td>
													</tr>
													<br />
													<tr>
														<td style=\"width:30%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\"\">
															Code postale :
														</td>
														<td style=\"width:70%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\">
															$cp
														</td>
													</tr>
													<br />
													<tr>
														<td style=\"width:30%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\"\">
															Ville :
														</td>
														<td style=\"width:70%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\">
															$ville
														</td>
													</tr>
													<br />
													<tr>
														<td style=\"width:30%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\"\">
															Nom :
														</td>
														<td style=\"width:70%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\">
															$nom
														</td>
													</tr>
													<br />
													<tr>
														<td style=\"width:30%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\"\">
															Prénom :
														</td>
														<td style=\"width:70%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\">
															$prenom
														</td>
													</tr>
													<br />
													<tr>
														<td style=\"width:30%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\"\">
															Email :
														</td>
														<td style=\"width:70%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\">
															$email
														</td>
													</tr>
													<br />
													<tr>
														<td style=\"width:30%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\"\">
															Numéro de Téléphone :
														</td>
														<td style=\"width:70%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\">
															$telephone
														</td>
													</tr>
													<br />
													<br />
													<tr>
														<td style=\"width:30%;vertical-align:top;font-family:sans-serif;padding:0 0 15px 0;font-size:24px;line-height:28px;font-weight:bold;padding:0px !important;\"\">
															Message :
														</td>
														<td style=\"font-family:sans-serif;font-size:16px;line-height:22px;width:70%;vertical-align:top;\">
															$message
														</td>
													</tr>
													<br /> 
													<br /> 
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style=\"padding:20px 30px 15px 30px;background-color:#222\">
									<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
										<tr>
											<td align=\"center\" style=\"font-family:sans-serif;font-size:14px;color:#ffffff;\">
												Ne pas répondre à ce message !
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</body>
	</html>
"; ?>