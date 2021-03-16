$(document).ready(function() {
  
  let menuFlex = $('#menu-flex');
  
  // Menu Responsive
	// Calculamos el ancho de la página
	let widthScrenn = $(window).width(),
			links = $('#links'),
			btnMenu = $('#btn-menu'),
			hamburguer = $('#hamburguer');

	// Cuando le dan click al boton del menu se alterne que se muestre el menú al igual con los iconos
	btnMenu.on('click', function() {
		links.slideToggle();
		hamburguer.toggleClass('fa-bars fa-times-circle');
	});

	// Si el ancho de la pantalla es 900 o menos no se muestren los enlaces y este el icono de la hamburguesa 
	if ( widthScrenn < 901 ) {
		links.hide();
		hamburguer.addClass('fa-bars').removeClass('fa-times-circle');
	}

	// Cuando hagan resize en la página si es el tamaño es 901 en adelante se muestren los enlaces y varie dependiendo el tamaño
	$(window).on('resize', function() {
		if( $(this).width() > 900 ) {
			links.show();
			hamburguer.addClass('fa-times-circle').removeClass('fa-bars');
		}
	});
  
  $('.links-menu').on('focus', function() {
    $(this).blur();
  });
  
});