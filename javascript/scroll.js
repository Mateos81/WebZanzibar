function scrollDroit(){
      $("#slideshow ul").animate({marginLeft:-300},1000,function(){
         $(this).css({marginLeft:0}).find("li:last").after($(this).find("li:first"));
});
}

function scrollGauche(){
      $("#slideshow ul").animate({marginLeft:300},1000,function(){
         $(this).css({marginLeft:0}).find("li:first").before($(this).find("li:last"));
});
}
