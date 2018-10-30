 $(document).ready(function(){

    var surface_habitable = false;
    var surface_terrain = false;
    var nb_piece = false;
    var nb_chambre = false;
    var niveau = false;
    var annee_construction = false;
    var adresse = false;
    var cp = false;
    var ville = false;
    var nom = false;
    var prenom = false;
    var email = false;
    var telephone = false;
    var message = false;
    
function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};

function isValidPhone(PhoneNumber) {
    var pattern=/^([+]?|(00))?0?[1-9][0-9]{8,15}$/i;
    
    return pattern.test(PhoneNumber);
}

$(".surface_habitable").on("change keyup paste",
  function(){
        if($(this).val() != ""){
            surface_habitable = true;
        $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
        }
        else {
          $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          surface_habitable = false;
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
      }
    });

$(".surface_terrain").on("change keyup paste",
  function(){
        if($(this).val() != ""){
            surface_terrain = true;
        $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
        }
        else {
          $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          surface_terrain = false;
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
      }
    });
	
$(".nb_piece").on("change keyup paste",
  function(){
        if($(this).val() != ""){
            nb_piece = true;
        $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
        }
        else {
          $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          nb_piece = false;
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
      }
    });
	
$(".nb_chambre").on("change keyup paste",
  function(){
        if($(this).val() != ""){
            nb_chambre = true;
        $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
        }
        else {
          $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          nb_chambre = false;
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
      }
    });
	
$(".niveau").on("change keyup paste",
  function(){
        if($(this).val() != ""){
            niveau = true;
        $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
        }
        else {
          $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          niveau = false;
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
      }
    });
	
$(".annee_construction").on("change keyup paste",
  function(){
        if($(this).val() != ""){
            annee_construction = true;
        $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
        }
        else {
          $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          annee_construction = false;
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
      }
    });
	
$(".adresse").on("change keyup paste",
  function(){
        if($(this).val() != ""){
            adresse = true;
        $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
        }
        else {
          $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          adresse = false;
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
      }
    });
	
$(".cp").on("change keyup paste",
  function(){
        if($(this).val() != ""){
            cp = true;
        $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
        }
        else {
          $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          cp = false;
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
      }
    });
	
$(".ville").on("change keyup paste",
  function(){
        if($(this).val() != ""){
            ville = true;
        $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
        }
        else {
          $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          ville = false;
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
      }
    });
	
$(".nom").on("change keyup paste",
  function(){
        if($(this).val() != ""){
            nom = true;
        $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
        }
        else {
          $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          nom = false;
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
      }
    });   
	
$(".prenom").on("change keyup paste",
  function(){
        if($(this).val() != ""){
            prenom = true;
        $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
        }
        else {
          $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          prenom = false;
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
      }
    });   


$(".email").on("change keyup paste",
  function(){
      if(isValidEmailAddress($(this).val())){
          email = true;
          $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
      }
      else {
          $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          email = false;
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
      }
  });	
  
 $(".telephone").on("change keyup paste",
  function(){
        if(isValidPhone(($(this).val()))){
            telephone = true;
             $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
        }
        else {
          $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          telephone = false;
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
      }
    });

$(".message").on("change keyup paste",
  function(){
        if($(this).val() != ""){
            message = true;
        $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
            if(surface_habitable == true && surface_terrain == true && nb_piece == true && nb_chambre == true && niveau == true && annee_construction == true && adresse == true && cp == true && ville == true && nom == true && prenom == true && email == true && telephone == true && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
        }
        else {
          $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(247, 43, 43, 0.6)");
          message = false;
          if(email == true && telephone == true && nom == true && prenom && message == true){
                $('.rechercher').removeClass("btn-disabled");
            }
            else {
                $('.rechercher').addClass("btn-disabled");
            }
      }
    });    

$('.rechercher').on("click",function(e){
	e.preventDefault();
	$('.rechercher').addClass("btn-disabled");
	if (surface_habitable && surface_terrain && nb_piece && nb_chambre && niveau && annee_construction && adresse && cp && ville && email && telephone && nom && prenom && message)
		{
			$.post(
				'envoi_estimation.php',
				{
					type : $(".type").val(),
					renover : $(".renover").val(),
					piscine : $(".piscine").val(),
					surface_habitable : $(".surface_habitable").val(),
					surface_terrain : $(".surface_terrain").val(),
					nb_piece : $(".nb_piece").val(),
					nb_chambre : $(".nb_chambre").val(),
					niveau : $(".niveau").val(),
					annee_construction : $(".annee_construction").val(),
					adresse : $(".adresse").val(),
					cp : $(".cp").val(),
					ville : $(".ville").val(),
					prenom : $(".prenom").val(),
					nom : $(".nom").val(),
					message : $(".message").val(),
					telephone : $(".telephone").val()
				},
				function(data){
					if(data == 'success'){
						alert("Demande d'estimation enregistré !");
						location.reload();
					}
					else{
						alert("Erreur lors de l'enregistrement !");
					}
				},
				'text'
			 );
		}
		else {
			alert("Merci de renseigner chaque champ");
		}
	});
    
    });