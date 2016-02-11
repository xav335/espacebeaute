<? 
	include_once '../../inc/inc.config.php';
	include_once '../classes/utils.php';
	require '../classes/ImageManager.php';
	require '../classes/Soin.php';
	session_start();
	
	$debug = false;
	if ( $debug ) print_pre( $_POST );
	
	$soin = new Soin();
	$imageManager = New ImageManager();
	
	// ---- Security ---------------------------------------------------------- //
	if ( !isset( $_SESSION[ "accessGranted" ] ) || !$_SESSION[ "accessGranted" ] ) {
		$result = $storageManager->grantAccess( $_POST[ "login" ], $_POST[ "mdp" ] );
		if (!$result){
			if ( !$debug ) header('Location: /admin/?action=error');
			else echo "Erreur de sécurité : Redirection vers /admin/?action=error";
		} else {
			$_SESSION[ "accessGranted" ] = true;
		}
	}
	// ------------------------------------------------------------------------ //

	
	// ---- Forms processing -------------------------------------------------- //
	if ( $_POST[ "mon_action" ] != '' ) {
		
		// ---- Gestion des produits ------------------------------------------ //
		if ( $_POST[ "mon_action" ] == "gerer" ) {
			
			// ---- Gestion de l'image du soin -------------------------------- //
			if ( $_POST[ "url0" ] != '' ) {
				$source = $_SERVER[ "DOCUMENT_ROOT" ] . $_POST[ "url0" ];
				if ( $debug ) echo "Source : " . $source . "<br>";
				
				if( strstr( $source, 'uploads' ) ) {
					$source = $_SERVER[ "DOCUMENT_ROOT" ] . $_POST[ "url0" ];
					$filenameDest = $imageManager->fileDestManagement( $source, $_POST[ "id" ] );
					
					// ---- Image
					$destination = $_SERVER[ "DOCUMENT_ROOT" ] . '/photos/soin' . $filenameDest;
					if ( $debug ) echo "Destination : " . $destination . "<br>";
					$imageManager->imageResize( $source, $destination, 221, 221, ZEBRA_IMAGE_CROP_CENTER );
					
					// ---- Vignette
					$destination = $_SERVER[ "DOCUMENT_ROOT" ] . '/photos/soin/thumbs' . $filenameDest;
					$imageManager->imageResize( $source, $destination, 170, 170, ZEBRA_IMAGE_CROP_CENTER );
					$_POST[ "url0" ] = $filenameDest;
				}
			}
			// ---------------------------------------------------------------- //
			
			// ---- Traitement des données ------------------------------------ //
			if ( 1 == 1 ) {
				$id = $soin->gererDonnees( $_POST, $debug );
			}
			// ---------------------------------------------------------------- //
			
			// ---- Redirection après traitement ------------------------------ //
			if ( 1 == 1 ) {
				$page_redirection = "/admin/soin/liste.php";
				
				if ( $debug ) echo "Redirection vers " . $page_redirection;
				else header( "Location: " . $page_redirection );
				exit();
			}
			// ---------------------------------------------------------------- //
			
		} 
		// -------------------------------------------------------------------- //
		
	}
	// ------------------------------------------------------------------------ //
	
	
	// ---- GET GET GET ------------------------------------------------------- //
	elseif ( $_GET[ "action" ] == 'delete' ) {
		try {
			$result = $soin->supprimer( $_GET[ "id" ], $debug );
			
			if ( !$debug ) header( "Location: /admin/produit/liste.php" );
		} 
		catch (Exception $e) {
			echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
			$goldbook = null;
			exit();
		}
	}
	// ------------------------------------------------------------------------ //
	
	
	// ---- ERREUR!!! --------------------------------------------------------- //
	else {
		header('Location: /admin/');
	}
	// ------------------------------------------------------------------------ //
?>