$(document).foundation();

$(document).ready(function(){

	// Gestion des liens du menu
	$('.contenu .sous-menu a, .go2top').click(function(){
		var lienmenu = $(this).attr('href');
		$('body').scrollTo(lienmenu, 800);
	});
	
});