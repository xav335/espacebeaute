<? 
	require( $_SERVER[ "DOCUMENT_ROOT" ] . "/inc/inc.config.php" );
	require 'admin/classes/Contact.php';
	require 'admin/classes/utils.php';
	session_start();
	
	$debug = false;
	
	$contact = new Contact();
	
	$mon_action = $_POST[ "mon_action" ];
	$anti_spam = $_POST[ "as" ];
	//print_pre( $_POST );
	
	$affichage_success = "wait";
	$affichage_erreur = "wait";
	
	// ---- Post du formulaire ------------------------------- //
	if ( $mon_action == "poster" && $anti_spam == '' ) {
		if ( $debug ) echo "On poste...<br>";
		
		// ---- Enregistrement dans "contact" -------- //
		if ( 1 == 1 ) {
			$num_contact = $contact->isContact( $_POST[ "email" ], $debug );
			
			unset( $val );
			$val[ "id"] = $num_contact;
			$val[ "firstname"] = $_POST[ "prenom" ];
			$val[ "name"] = $_POST[ "nom" ];
			$val[ "adresse"] = $_POST[ "adresse" ];
			$val[ "cp"] = $_POST[ "cp" ];
			$val[ "ville"] = $_POST[ "ville" ];
			$val[ "email"] = $_POST[ "email" ];
			$val[ "tel"] = $_POST[ "tel" ];
			$val[ "message"] = $_POST[ "message" ];
			$val[ "newsletter"] = $_POST[ "newsletter" ];
			$val[ "fromcontact"] = "on";
			if ( $num_contact <= 0 ) $contact->contactAdd( $val, $debug );
			else $contact->contactModify( $val, $debug );
		}
		// ------------------------------------------- //
		
		// ---- Envoi du mail à l'admin -------------- //
		if ( 1 == 1 ) {
			$entete = "From:" . MAILNAMECUSTOMER . " <" . MAILCUSTOMER . ">\n";
			$entete .= "MIME-version: 1.0\n";
			$entete .= "Content-type: text/html; charset= iso-8859-1\n";
			$entete .= "Bcc:" . MAIL_BCC . "\n";
			//echo "Entete :<br>" . $entete . "<br><br>";
			
			$sujet = utf8_decode( "Prise de contact" );
			
			//$_to = "franck_langleron@hotmail.com";
			$_to = ( MAIL_TEST != '' )
		    	? MAIL_TEST
		    	: MAIL_CONTACT;
			//echo "Envoi du message à : " . $_to . "<br><br>";
			
			$message = "Bonjour,<br><br>";
			$message .= "La personne suivante a rempli le formulaire de contact de votre site :<br>";
			$message .= "Nom : <b>" . $_POST[ "nom" ] . " " . $_POST[ "prenom" ] . "</b><br>";
			$message .= "E-mail / Téléphone : <b>" . $_POST[ "email" ] . " / " . $_POST[ "tel" ] . "</b><br>";
			$message .= "Adresse postale : <b>" . $_POST[ "adresse" ] . ", " . $_POST[ "cp" ] . " " . $_POST[ "ville" ] . "</b><br>";
			$message .= "Message : <br><i>" . nl2br( $_POST[ "message" ] ) . "</i><br><br>";
			$message .= "Cordialement.";
			$message = utf8_decode( $message );
			if ( $debug ) echo $message;
			
			if ( !$debug ) $retour = mail( $_to, $sujet, stripslashes( $message ), $entete );
			//exit();
			
			$affichage_success = ( $retour ) ? "" : "wait";
			$affichage_erreur = ( $retour ) ? "wait" : "";
		}
		// ------------------------------------------- //
		//exit();
		
	}
	// ------------------------------------------------------- //
?>

<!doctype html>
<html class="no-js" lang="fr">
	<head>
		
		<title>Espace Beauté | Saint-Loubès | Contact</title>
		<?php include('inc/header.php'); ?>
		
	</head>
	<body class="contact">
		
		<main>
				
			<div class="row top-of-page">
				<div class="large-2 columns">
					&nbsp;
				</div>
				<div class="large-8 columns">
					<h1>
						Espace Beauté
						<span>Saint-Loubès</span>
					</h1>
				</div>
				<div class="large-2 columns">
					<p class="adresse">
						3 rue du stade<br/>
						33450 Saint-Loubès<br/>
						<a>05 56 68 60 00</a>
					</p>
				</div>
			</div>
			
			<?php include('inc/menu.php'); ?>
			
			<div class="row fullwidth">
				<div class="maps columns large-8 medium-6 small-12" id="map-canvas">
					
				</div>
				
				<div class="columns large-4 medium-6 small-12 <?=$affichage_success?>">
					<div id="div_success">
						<h3>Félicitations!</h3>
						<p>Votre message a été envoyé avec succès!</p>
					</div>
				</div>
				
				<div class="columns large-4 medium-6 small-12 <?=$affichage_erreur?>">
					<div id="div_erreur">
						<h3>Erreur!</h3>
						<p>
							Une erreur s'est produite lors de l'envoi de votre message.<br>
							Veuillez essayer ultérieurement.
						</p>
					</div>
				</div>
				
				<form id="contact" name="contact" class="columns large-4 medium-6 small-12" method="post" action="contact.php">
					<input type="hidden" name="mon_action" id="mon_action" value="" />
					<input type="hidden" name="as" value="" />
					
					<div class="row">
						<h3>Contactez-nous</h3>
						<div class="large-6 medium-12 columns">
							<input type="text" id="prenom" name="prenom" placeholder="Votre prénom" />						
						</div>
						<div class="large-6 medium-12 columns">
							<input type="text" id="nom" name="nom" placeholder="Votre nom" />
						</div>
						<div class="large-12 columns">
							<input type="text" id="adresse" name="adresse" placeholder="Votre adresse">
						</div>
						<div class="large-4 medium-5 small-12 columns">
							<input type="text" id="cp" name="cp" placeholder="Code postal" />						
						</div>
						<div class="large-8 medium-7 small-12 columns">
							<input type="text" id="ville" name="ville" placeholder="Ville" />
						</div>
						<div class="large-6 medium-12 columns">
							<input type="tel" id="tel" name="tel" placeholder="Votre n° de téléphone" />						
						</div>
						<div class="large-6 medium-12 columns">
							<input type="email" id="email" name="email" placeholder="Votre e-mail" />
						</div>
						<div class="large-12 columns">
							<textarea id="message" name="message" placeholder="Votre message"></textarea>
						</div>
						<div class="large-12 medium-12 columns">
							<input type="checkbox" name="newsletter" checked />&nbsp;Je souhaite m'inscrire sur la newsletter et ainsi recevoir vos offres spéciales.
						</div>
						<div class="large-12 columns">
							<button class="envoyer">Envoyer</button>
						</div>
						<div class="large-12 columns">
							<p>Conformément à la loi Informatique et Libertés en date du 6 janvier 1978, vous disposez d'un droit d'accès, de rectification, de modification et de suppression des données qui vous concernent. Vous pouvez exercer ce droit en nous envoyant un courrier électronique ou postal.</p>
						</div>
						
					</div>
				</form>
				
			</div>
			
			<?php include('inc/footer.php'); ?>
			
		</main>
    
	    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
		<script>
			var map;
			function initialize() {
			
				var mapOptions = {
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					mapTypeControl: false,
					zoom: 12,
					zoomControl: false,
					panControl: false,
					streetViewControl: false,
					scaleControl: false,
					overviewMapControl: false,
					center: new google.maps.LatLng(44.93173054040349, -0.4285989999999673)
				};
				
				map = new google.maps.Map(document.getElementById('map-canvas'),
					mapOptions);
				
				var infoContent = '<div class="window-content"><h4>Espace Beauté</h4><p>Ouvert du mardi au vendredi<br/>de 9h00 à 18h30<br/>Le samedi de 9h00 à 12h<br/>-</p><p>3 rue du stade<br/>33450 Saint-Loubès<br/>-</p><p>05 56 68 60 00<br/>espace-beaute33@orange.fr</p></div>';
				
				var infowindow = new google.maps.InfoWindow({
					content: infoContent
				});
				
				var icon = {
					path: 'M16.5,33c-9.0818,0-16.5-7.119-16.5-16.327,0-9.2082,7.3873-16.673,16.5-16.673,9.113,0,16.5,7.4648,16.5,16.673,0,9.208-7.418,16.327-16.5,16.327zm0-9.462c3.7523,0,6.7941-3.0737,6.7941-6.8654,0-3.7916-3.0418-6.8654-6.7941-6.8654s-6.7941,3.0737-6.7941,6.8654c0,3.7916,3.0418,6.8654,6.7941,6.8654z',
					anchor: new google.maps.Point(16.5, 16.5),
					fillColor: '#FF0000',
					fillOpacity: 0.6,
					strokeWeight: 0,
					scale: 0.66
				};
				
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng(44.916913, -0.42859899999996287),
					map: map,
					icon: icon,
					title: 'marker'
				});
				
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
				
				infowindow.open(map, marker);
			}
			
			google.maps.event.addDomListener(window, 'load', initialize);
			
			function checkResize(){
			
				var center = map.getCenter();
				google.maps.event.trigger(map, 'resize');
				map.setCenter(center);
			}
			
			window.onresize = checkResize;			
		</script>
    
		<script>
			$(document).ready(function(){
			
				$('nav a:last-child, footer a:nth-of-type(7)').addClass('active'); 
				
				// ---- Validation du formulaire ---------------------------- //
				if ( 1 == 1 ) {
					
					function initialiser() {
						$( "#nom" ).removeClass( "erreur" );
						$( "#prenom" ).removeClass( "erreur" );
						$( "#email" ).removeClass( "erreur" );
						$( "#tel" ).removeClass( "erreur" );
						$( "#message" ).removeClass( "erreur" );
					}
					
					function checkEmail( adr ) {
						if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(adr)) {
								return (true);
						}
						return (false);
					}
					
					$( ".envoyer" ).click(function() {
						//alert( "validation..." );
						var erreur = 0;
						initialiser();
						
						if ( $.trim( $( "#nom" ).val() ) == '' ) {
							erreur = 1;
							$( "#nom" ).addClass( "erreur" );
						}
						
						if ( $.trim( $( "#prenom" ).val() ) == '' ) {
							erreur = 1;
							$( "#prenom" ).addClass( "erreur" );
						}
						
						if ( $.trim( $( "#email" ).val() ) == '' ) {
							erreur = 1;
							$( "#email" ).addClass( "erreur" );
						}
						else if ( !checkEmail( $.trim( $( "#email" ).val() ) ) ) {
							erreur = 1;
							$( "#email" ).addClass( "erreur" );
						}
						
						if ( $.trim( $( "#tel" ).val() ) == '' ) {
							erreur = 1;
							$( "#tel" ).addClass( "erreur" );
						}
						
						if ( $.trim( $( "#message" ).val() ) == '' ) {
							erreur = 1;
							$( "#message" ).addClass( "erreur" );
						}
						
						if ( erreur == 0 ) $( "#mon_action" ).val( "poster" );
						return ( erreur == 0 ) ? true : false;
					});
					
				}
				// ---------------------------------------------------------- //
				
			});
		</script>
    
	</body>
</html>
