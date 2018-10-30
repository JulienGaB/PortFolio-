 $(document).ready(function(){

    var email = false;
    var telephone = false;
    var nom = false;
    var prenom = false;
    var message = false;
    
function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};

function isValidPhone(PhoneNumber) {
    var pattern=/^([+]?|(00))?0?[1-9][0-9]{8,15}$/i;
    
    return pattern.test(PhoneNumber);
}


$(".email").on("change keyup paste",
  function(){
      if(isValidEmailAddress($(this).val())){
          email = true;
          $(this).css("webkit-box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
          $(this).css("box-shadow"," inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(34, 234, 48, 0.6)");
            if(email == true && telephone == true && nom == true && prenom == true && message == true){
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
            if(email == true && telephone == true && nom == true && prenom == true && message == true){
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
            if(email == true && telephone == true && nom == true && prenom == true && message == true){
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
            if(email == true && telephone == true && nom == true && prenom == true && message == true){
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
            if(email == true && telephone == true && nom == true && prenom == true && message == true){
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
            if(email == true && telephone == true && nom == true && prenom == true && message == true){
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
            if(email == true && telephone == true && nom == true && prenom == true && message == true){
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
            if(email == true && telephone == true && nom == true && prenom == true && message == true){
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
            if(email == true && telephone == true && nom == true && prenom == true && message == true){
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
	if (email && telephone && nom && prenom && message)
		{
			$.post(
				'envoi.php',
				{
					email : $(".email").val(),
					prenom : $(".prenom").val(),
					nom : $(".nom").val(),
					message : $(".message").val(),
					telephone : $(".telephone").val()
				},
				function(data){
					if(data == 'success'){
						alert("Mail Envoyé !");
						location.reload();
					}
					else{
						alert("Erreur lors de l'envoi de votre message !");
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