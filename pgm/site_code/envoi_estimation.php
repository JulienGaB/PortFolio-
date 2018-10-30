<?php 

if (!empty($_POST)){
extract($_POST);
 

}
$objet_moi= "Demande depuis mon site";
$objet_client = "Votre demande sur le site ".$agence->nom_agence;

$headers = "MIME-Version: 1.0\r\n"; 

$headers .= "Content-Type: text/html; charset=utf-8"; 

$headers .= "From: ".$nom." <".$email.">\r\nReply-to : ".$nom." <".$mail.">\nX-Mailer:PHP"; 

$subject=$objet_moi; 
$destinataire="julien.gabrielli.pro@gmail.com";
$body = "Prenom : ".$prenom;
$body .= "<br />Nom : ".$nom;
$body .= "<br />Email : ".$email;
$body .= "<br />Telephone : ".$telephone;
$body.="<br />Message :".$message; 

if (mail($destinataire,$subject,$body,$headers)) { 
echo "success"; 
} else { 
echo error_get_last(); 
} 


$body = "Voici une copie du message que vous m'avez envoyé : ";
$body .= $message;
mail($email,$objet_client,$body,$headers);


?>