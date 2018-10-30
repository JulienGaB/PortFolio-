// FONCTION PAGE SLIDER ACCUEIL

  function openHeader() {
    document.getElementById("header-page").style.height = "250px";
  }

  function closeHeader() {
    document.getElementById("header-page").style.height = "0";
  }

  function openAbout() {
    document.getElementById("about-page").style.height = "100vh";
  }

  function closeAbout() {
    document.getElementById("about-page").style.height = "0";
  }

  function openNav() {
    document.getElementById("menu-open").style.width = "300px";
  }

  function closeNav() {
    document.getElementById("menu-open").style.width = "0";
  }

  function openNavProfil() {
    document.getElementById("profil-open").style.opacity = "1";
    document.getElementById("profil-open").style.height = "100vh";
  }

  function closeNavProfil() {
    document.getElementById("profil-open").style.opacity = "0";
    document.getElementById("profil-open").style.height = "0";
  }

  function openNavDip() {
    document.getElementById("dip-open").style.opacity = "1";
    document.getElementById("dip-open").style.height = "100vh";
  }

  function closeNavDip() {
    document.getElementById("dip-open").style.opacity = "0";
    document.getElementById("dip-open").style.height = "0";
  }

  function openNavExp() {
    document.getElementById("exp-open").style.opacity = "1";
    document.getElementById("exp-open").style.height = "100vh";
  }

  function closeNavExp() {
    document.getElementById("exp-open").style.opacity = "0";
    document.getElementById("exp-open").style.height = "0";
  }

  function openProjet1() {
    document.getElementById("projet1-open").style.opacity = "1";
    document.getElementById("projet1-open").style.height = "100vh";
  }

  function closeProjet1() {
    document.getElementById("projet1-open").style.opacity = "0";
    document.getElementById("projet1-open").style.height = "0";
  }

  function openProjet2() {
    document.getElementById("projet2-open").style.opacity = "1";
    document.getElementById("projet2-open").style.height = "100vh";
  }

  function closeProjet2() {
    document.getElementById("projet2-open").style.opacity = "0";
    document.getElementById("projet2-open").style.height = "0";
  }

  function openProjet3() {
    document.getElementById("projet3-open").style.opacity = "1";
    document.getElementById("projet3-open").style.height = "100vh";
  }

  function closeProjet3() {
    document.getElementById("projet3-open").style.opacity = "0";
    document.getElementById("projet3-open").style.height = "0";
  }

  function openProjet4() {
    document.getElementById("projet4-open").style.opacity = "1";
    document.getElementById("projet4-open").style.height = "100vh";
  }

  function closeProjet4() {
    document.getElementById("projet4-open").style.opacity = "0";
    document.getElementById("projet4-open").style.height = "0";
  }

// FONCTION FORMULAIRE DE CONTACT

function surligne(champ, erreur){
		if(erreur){
			champ.style.border = "1px solid #fb4444";
		}
		else{
			champ.style.border = "1px solid #fff";
		}
	}

	function verifChamp(champ){
		if(champ.value.length < 3){
			surligne(champ, true);
			return false;
		}
		else{
			surligne(champ, false);
			return true;
		}
	}

	function verifMail(champ){
		var regex = new RegExp("^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-zA-Z0-9]{2,4}$");
		if(!regex.test(champ.value)){
			surligne(champ, true);
			return false;
		}
		else{
			surligne(champ, false);
			return true;
		}
	}

	function validation(){
		var nomOk = verifChamp(nom);
		var objetOk = verifChamp(objet);
		var messageOk = verifChamp(message);
		var emailOk = verifMail(email);

		if(nomOk && objetOk && messageOk && emailOk){
			return true;
		}
		else{
			alert("Veuillez remplir correctement tous les champs");
			return false;
		}
	}

function StopSubmit(){
  document.getElementById("contact-form").submit();
  document.getElementById("Btn-Envoie").value = "En attente ...";
  document.getElementById("Btn-Envoie").style.cursor = "not-allowed";
  document.getElementById("Btn-Envoie").setAttribute("disabled", true);
}
