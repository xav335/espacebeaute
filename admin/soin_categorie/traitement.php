<? 
	include_once '../../inc/inc.config.php';
	include_once '../classes/utils.php';
	require '../classes/Soin_categorie.php';
	session_start();
	
	$debug = false;
	if ( $debug ) print_pre( $_POST );
	
	// ---- Security ---------------------------------------------------------- //
	if ( !isset( $_SESSION[ "accessGranted" ] ) || !$_SESSION[ "accessGranted" ] ) {
		$result = $storageManager->grantAccess($_POST[ "login" ], $_POST[ "mdp" ]);
		if (!$result){
			header('Location: /admin/?action=error');
		} else {
			$_SESSION[ "accessGranted" ] = true;
		}
	}
	// ------------------------------------------------------------------------ //
	
	// ---- Forms processing -------------------------------------------------- //
	if ( !empty( $_POST ) ) {
		
		 // ---- Gestion des cat�gories --------------------------------------- //
		if ( $_POST[ "mon_action" ] == "gerer" ) {
			$categorie = new Soin_categorie();
			
			// ---- Traitement des donn�es ------------------ //
			if ( 1 == 1 ) {
				$id = $categorie->gererDonnees( $_POST, $debug );
			}
			// ---------------------------------------------- //
			
			// ---- Redirection apr�s traitement ------------ //
			if ( 1 == 1 ) {
				$page_redirection = "/admin/soin_categorie/liste.php";
				
				if ( $debug ) echo "Redirection vers " . $page_redirection;
				else header( "Location: " . $page_redirection );
				exit();
			}
			// ---------------------------------------------- //
			
		} 
		// -------------------------------------------------------------------- //
		
	}
	// ------------------------------------------------------------------------- //
	
	
	// ---- GET GET GET -------------------------------------------------------- //
	elseif ( $_GET[ "action" ] == 'delete' ) {
		try {
			$categorie = new Soin_categorie();
			$result = $categorie->supprimer( $_GET[ "id" ], $debug );
			
			if ( !$debug ) header( "Location: /admin/soin_categorie/liste.php" );
		} 
		catch (Exception $e) {
			echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
			$goldbook = null;
			exit();
		}
	}
	// ------------------------------------------------------------------------- //
	
	
	// ---- ERREUR!!! ---------------------------------------------------------- //
	else {
		if ( $debug ) echo "ERREUR!!!";
		else header('Location: /admin/');
	}
	// ------------------------------------------------------------------------- //
?>