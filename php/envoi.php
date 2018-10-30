<?php

$destinataire="julien.gabrielli.pro@gmail.com";

echo $_GET['nom']." ".$_GET['prenom']."<br /><br />";

if(isset($_POST['nom']) && !empty($_POST['nom']) && !empty($_POST['objet']) && !empty($_POST['email']) && !empty($_POST['message']) && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $_POST['email'])){
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8";
    $headers .= "From: ".$_POST['nom']." <".$_POST['email'].">\r\n";
    $headers .= "Reply-to : \"Julien Gabrielli\" <".$destinataire.">\nX-Mailer:PHP";

    $subject=$_POST['objet'];

    $body = "Nom : ".$_POST['nom'];
    $body .= "<br/><br/>Email : ".$_POST['email'];
    $body.="<br/><br/>Message :".$_POST['message'];
    if (mail($destinataire,$subject,$body,$headers)){
    echo "
    <script>
      alert('Mail envoyé !');
      window.location.replace('../index.html');
    </script>
    ";
    }
    else{
      echo "
      <script>
        alert('Echec lors de l'envoi du Mail !');
        window.location.replace('../index.html');
      </script>
      ";
    }
  }
else{
  echo "
  <script>
    alert('Veuillez remplir tous les champs !');
    window.location.replace('../index.html');
  </script>
  ";
}

 ?>
