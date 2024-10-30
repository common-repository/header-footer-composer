(function($) {
		   

	 $.fn.menumaker = function(options) {
      
      var cssmenu = $(this), settings = $.extend({
        title: "Menu",
        format: "dropdown",
        sticky: false
      }, options);

      return this.each(function() {        
        $(this).find("#hfc-menu-button-toggle").on('click', function(){
          $(this).toggleClass('menu-opened');
          var mainmenu = $('ul.hfc-nav-menu-top');
            
            //adjust width of menu in mobile  
            var elementor_section_width = $( '#hfc-navigation' ).closest('.elementor-section').outerWidth();               
            var elementor_self_section_width = $( '#hfc-navigation' ).closest('.elementor-column').outerWidth();                    
            var self_position = elementor_self_section_width - elementor_section_width - 10;                                              
            
            mainmenu.css("width", elementor_section_width +'px');
            mainmenu.css("left", self_position +'px');                      
            
          if (mainmenu.hasClass('open')) { 
            mainmenu.hide().removeClass('open');
          }
          else {
            mainmenu.show().addClass('open');
            if (settings.format === "dropdown") {
              mainmenu.find('ul').show();
            }
          }
        });

        cssmenu.find('li ul').parent().addClass('has-sub');

        multiTg = function() {
          cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
          cssmenu.find('.submenu-button').on('click', function() {
            $(this).toggleClass('submenu-opened');
            if ($(this).siblings('ul').hasClass('open')) {
              $(this).siblings('ul').removeClass('open').hide();
            }
            else {
              $(this).siblings('ul').addClass('open').show();
            }
          });
        };

        if (settings.format === 'multitoggle') multiTg();
        else cssmenu.addClass('dropdown');

        if (settings.sticky === true) cssmenu.css('position', 'fixed');

        resizeFix = function() {
          if ($( window ).width() > 768) {                            
            cssmenu.find('ul').show();
          }

          if ($(window).width() <= 768) {
            cssmenu.find('ul').hide().removeClass('open');
          }
        };
        resizeFix();
        return $(window).on('resize', resizeFix);

      });
  };
})(jQuery);

(function($){	  
	  
$(document).ready(function(){

$(".hfc-nav-mobile-toggle-ed #hfc-navigation").menumaker({
   format: "multitoggle"
});

});

})(jQuery);
