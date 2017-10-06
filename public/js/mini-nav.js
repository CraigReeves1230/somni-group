
$(function(){

    // populate mobile menu
    $(".nav-container").children().each(function(index, value){
      $(value).clone().appendTo(".mobile-menu");
    });

   // mobile-handle functioning
    $(".mobile-handle").click(function(){
        $(".mobile-menu").toggleClass("showing");
    });

    // mobile submenu functioning
    $(".mobile-menu .has-submenu").click(function(){
        $(this).children(".menu-sub").toggle();
        $(".mobile-menu .has-submenu").not(this).children(".menu-sub").hide();
    });

});

