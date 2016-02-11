<?
	include_once ( $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/classes/utils.php" );
	require( $_SERVER[ "DOCUMENT_ROOT" ] . "/inc/inc.config.php" );
	require $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/classes/Soin_categorie.php";
	require $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/classes/Soin.php";
	
	$debug = false;
	$categorie = new Soin_categorie();
	$soin = new Soin();
	
	// ---- Liste des catégories disponibles ---- //
	if ( 1 == 1 ) {
		unset( $recherche );
		$liste_categorie = $categorie->getListe( $recherche, $debug );
	}
	// ------------------------------------------ //
	
?>

<!doctype html>
<html class="no-js" lang="fr">
<head>
	
	<title>Espace Beauté | Saint-Loubès | Nos soins</title>
	<?php include('inc/header.php'); ?>
	
</head>
<body class="nos-soins">
	
	<main id="top">
			
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
		
		<div class="contenu">
			<div class="row">
				<div class="large-12 columns">
					<h2>Nos soins</h2>
				</div>
				
				<div class="row sous-menu">
					<?
					// ---- Affichage de la liste des catégories ------------- //
					if ( !empty( $liste_categorie ) ) {
						foreach( $liste_categorie as $_categorie ) {
							
							echo "<div class='large-4 columns'>\n";
							echo "	<a href='#" . $_categorie[ "id" ] . "'>" . $_categorie[ "titre" ] . "</a>\n";
							echo "</div>\n";
						}
					}
					// ------------------------------------------------------- //
					?>
				</div>
				
				<?
				// ---- Affichage des soins composant la catégorie ----------- //
				if ( !empty( $liste_categorie ) ) {
					foreach( $liste_categorie as $_categorie ) {
						
						// ---- Liste des soins disponibles pour cette catégorie
						if ( 1 == 1 ) {
							unset( $recherche );
							$recherche[ "id_categorie" ] = $_categorie[ "id" ];
							$liste_soin = $soin->getListe( $recherche, $debug );
						}
						// --------------------------------------------------- //
						
						// ---- Affichge des soins --------------------------- //
						if ( !empty( $liste_soin ) ) {
							
							echo "<div class='row soins' id='" . $_categorie[ "id" ] . "'>\n";
							echo "	<div class='large-12 columns'>\n";
							echo "		<h3>" . $_categorie[ "titre" ] . "</h3>\n";
							echo "		<h4>" . $_categorie[ "sous_titre" ] . "</h4>\n";
							echo "	</div>\n";
							
							$cpt = 1;
							foreach( $liste_soin as $_soin ) {
								$_image = ( $_soin[ "image" ] != '' && file_exists( $_SERVER[ "DOCUMENT_ROOT" ] . "/photos/soin" . $_soin[ "image" ] ) )
									? "/photos/soin" . $_soin[ "image" ]
									: "img/photos-soins-01.jpg";
								
								echo "	<div class='large-4 medium-4 small-12 columns'>\n";
								echo "		<img src='" . $_image  ."' alt='' title=\"" . $_soin[ "titre" ] . "\" />\n";
								echo "		<h4>" . $_soin[ "titre" ] . "</h4>\n";
								echo "		<p>" . nl2br( $_soin[ "texte" ] ) . "</p>\n";
								echo "	</div>\n";
								
								$cpt++;
								if ( $cpt > 3 ) {
									echo "	<div style='clear:both;'></div>\n";
									$cpt = 1;
								}
							}
							
							echo "</div>\n";
						}
						// --------------------------------------------------- //
						
					}
				}
				// ----------------------------------------------------------- //
				?>
				
			</div>
		</div>
		
		<a href="#top" class="go2top"></a>
		
		<?php include('inc/footer.php'); ?>
		
	</main>
    
    <script>
	    $(document).ready(function(){
		   $('nav a:nth-child(3), footer a:nth-of-type(3)').addClass('active'); 
	    });
    </script>
    
  </body>
</html>
