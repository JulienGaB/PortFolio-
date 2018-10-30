$(window).on('load', function() {
  jsScrollTo();
  headerAnimation();
  skillsGetMore();
  applyScrollOrNot();
});

$(window).on('resize', function() {
  addDataElement($('.skillsSectionContent'), 'data-valueSkills', calcValueSkillsGetMore($('.skillsSectionContent')));
  removeClass($('.skillsSectionContent'), 'openGetMoreSkills');
  applyCss($('.skillsSection'), 'height', 0);
});

function jsScrollTo() {
  $('.js-scrollTo').on('click', function() {
    var page = $(this).attr('href');
    $('html, body').animate( { scrollTop: $(page).offset().top }, 750 );
  });
}

function headerAnimation() {
  $(window).on('scroll', function() {
    applyScrollOrNot();
  });
}

function applyScrollOrNot() {
  if(calcScrollTop() > 50) {
    addClass($('.contentHeader'), 'menuColor');
  }
  else {
    removeClass($('.contentHeader'), 'menuColor');
  }
}

function skillsGetMore() {
  addDataElement($('.skillsSectionContent'), 'data-valueSkills', calcValueSkillsGetMore($('.skillsSectionContent')));
  $('.openSkills').on('click', function(x) {
    var value = 0;
    x = addRemoveClass($('.skillsSectionContent'), 'openGetMoreSkills');
    if (x == true) {
      value = returnDataElement($('.skillsSectionContent'), 'data-valueSkills');
    }
    applyCss($('.skillsSection'), 'height', value);
  });
}

// FUNCTIONS BASIQUES

function addRemoveClass(classChoice, classTest) {
  if (hasClass(classChoice, classTest)) {
    removeClass(classChoice, classTest);
    return false;
  }
  else {
    addClass(classChoice, classTest);
    return true;
  }
}

function hasClass(classChoice, classTest) {
  return classChoice.hasClass(classTest);
}

function addClass(classChoice, classTest) {
  classChoice.addClass(classTest);
}

function removeClass(classChoice, classTest) {
  classChoice.removeClass(classTest);
}

function calcScrollTop() {
  return $(window).scrollTop();
}

function addDataElement(classChoice, dataElement, value) {
  classChoice.attr(dataElement, value);
}

function returnDataElement(classChoice, dataElement) {
  return classChoice.attr(dataElement);
}

function calcValueSkillsGetMore(classChoice) {
  return classChoice.innerHeight();
}

function applyCss(classChoice, cssElement, value) {
  classChoice.css(cssElement, value);
}
