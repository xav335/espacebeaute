<?
	include_once ( $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/classes/utils.php" );
	require( $_SERVER[ "DOCUMENT_ROOT" ] . "/inc/inc.config.php" );
	require $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/classes/News.php";
	
	$debug = false;
	$news = new News();
	
	// ---- Liste des actualités en ligne ---- //
	$liste_actualite = $news->newsValidGet( $debug );
?>

<!doctype html>
<html class="no-js" lang="fr">
<head>
	
	<title>Espace Beauté | Saint-Loubès | Actualité/Promotion</title>
	<?php include('inc/header.php'); ?>
	
</head>
<body class="actualite">
	
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
			
		<!-- Début actualité -->
		<div class="contenu">
			<div class="row">
				<div class="large-12 columns">
					<h2>Actualité/Promotion</h2>
				</div>
				
				<?
				// ---- Affichage des actualités ---------------------------------- //
				if ( !empty( $liste_actualite ) ) {
					foreach( $liste_actualite as $_actualite ) {
						$id_news = $_actualite[ "id_news" ];
						$imageth = ( $_actualite[ "image1" ] != '' )
							? "/photos/news/thumbs" . $_actualite[ "image1" ]
							: "/img/marker.png";
						$image = ( $_actualite[ "image1" ] != '' )
						? "/photos/news" . $_actualite[ "image1" ]
						: "/img/marker.png";
						$date_news = traitement_datetime_affiche( $_actualite[ "date_news" ] );
						
						echo "<div class='large-4 medium-4 small-12 columns'>\n";
						echo "	<a href='" . $image . "' class=\"fancybox\"><img src='" . $imageth . "' alt=\"" . $_actualite[ "titre" ] . "\" />\n";
						echo "</div>\n";
						echo "<div class='large-8 medium-8 small-12 columns'>\n";
						echo "	<h3>" . $_actualite[ "titre" ] . "</h3>\n";
						echo "	<h4>" . $date_news . "</h4>\n";
						echo "	<p>" . $_actualite[ "contenu" ] . "</p>\n";
						echo "</div>\n";
						echo "<hr />\n";
					}
				}
				// ---------------------------------------------------------------- //
				?>
				
			</div>
		</div>
		<!-- Fin actualité -->
	
		<?php include('inc/footer.php'); ?>
		
	</main>
	
	<script>
		$(document).ready(function(){
			$('nav a:nth-child(5), footer a:nth-of-type(5)').addClass('active');
		});
	</script>
	
</body>
</html>
