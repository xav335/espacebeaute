<? include_once ( $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/inc-auth-granted.php" );?>
<? include_once ( $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/classes/utils.php" );?>
<? 
	require( $_SERVER[ "DOCUMENT_ROOT" ] . "/inc/inc.config.php" );
	require $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/classes/Tarif_categorie.php";
	
	$debug = false;
	$categorie = new Tarif_categorie();
	
	$id = $_GET[ "id" ];
	
	$btn_creation_categorie = "Créer la catégorie";
	
	// ---- Liste des categories diponibles ------- //
	if ( 1 == 1 ) {
		unset( $recherche );
		$liste_categorie = $categorie->getListe( $recherche, $debug );
	}
	// -------------------------------------------- //
	
	// ---- Chargement d'une catégorie ------------ //
	if ( $_GET[ "id" ] != '' ) {
		$datas = $categorie->load( $id );
		
		if ( !empty( $datas[ 0 ] ) ) {
			$titre = $datas[ 0 ][ "titre" ];
			$btn_creation_categorie = "Modifier la catégorie";
		}
	}
	// -------------------------------------------- //

	if ( empty( $liste_categorie ) ) {
		$message = 'Aucune catégorie enregistrée.';
	} 
	else {
		$message = '';
	}

?>

<!doctype html>
<html class="no-js" lang="en">
	<head>
		<? include_once $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/inc-meta.php"; ?>
	</head>
	
	<body>	
		<? include_once $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/inc-menu.php"; ?>
		
		<div class="container">
			
			<div class="row">
				
				<!-- Nouvelle catégorie -->
				<div class="col-md-8">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Indiquez le titre de la catégorie</h3>
						</div>
						<div class="panel-body">
							<form name="formulaire" class="form-horizontal" method="POST" action="/admin/tarif_categorie/traitement.php" >
								<input type="hidden" name="mon_action" id="mon_action" value="gerer">
								<input type="hidden" name="id" value="<?=$id?>">
								
								<div class="row">
									<div class="row">
										<label class="col-md-3">&nbsp;Titre catégorie :</label>
					      				<input type="text" class="col-md-5" name="titre" id="titre" value="<?=$titre?>" required>
					      			</div>
					      			</div>
								</div>	
								
						      	<div class="row ">	
						      		<div class="col-md-3">&nbsp;</div>	
									<div class="col-md-8"><br>
										<button class="btn btn-success col-sm-10" type="submit" > <?=$btn_creation_categorie?> </button>
									</div>		
								</div>
								<br>
							</form>
						</div>
					</div>
				</div>
				
				<div class="col-md-6"><br><?=$message?></div>
				
				<? 
				if ( !empty( $liste_categorie ) ) {
					?>
					<table class="table table-hover table-bordered table-condensed table-striped" >
						<thead>
							<tr>
								<th class="col-md-11">Liste des catégories</th>
								<th class="col-md-1" colspan="2">Actions</th>
							</tr>
						</thead>
						<tbody>
						
						<?
						foreach ( $liste_categorie as $_categorie ) {
							echo "<tr>\n";
							echo "	<td>\n";
							echo "		<a href='/admin/tarif_categorie/liste.php?id=" . $_categorie[ "id" ] . "'>" . $_categorie[ "titre" ] . "</a>\n";
							echo "	</td>\n";
							echo "	<td><a href='/admin/tarif_categorie/liste.php?id=" . $_categorie[ "id" ] . "'><img src='/admin/img/modif.png' width='30' alt='Modifier' ></a></td>\n";
								
							echo "	<td>\n";
							echo "		<div style='display: none;' class='supp" . $_categorie[ "id" ] . " alert alert-warning alert-dismissible fade in' role='alert'>\n";
							echo "			<button type='button' class='close' aria-label='Close' onclick=\"$('.supp" . $_categorie[ "id" ] . "').css('display', 'none');\"><span aria-hidden='true'>×</span></button>\n";
							echo "			<strong>Voulez vous vraiment supprimer ?</strong>\n";
							echo "			<button type='button' class='btn btn-danger' onclick=\"location.href='/admin/tarif_categorie/traitement.php?action=delete&id=" . $_categorie[ "id" ] . "'\">Oui !</button>\n";
							echo "	 	</div>\n";
							echo "		<img src='/admin/img/del.png' width='20' alt='Supprimer' onclick=\"$('.supp" . $_categorie[ "id" ] . "').css('display', 'block');\"> \n";
							echo "	</td>\n";
							echo "</tr>\n";
						}
						?>
						</tbody>
					</table>
					<?
				}
				?>
					
			</div>
		</div>
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="/js/jquery.min.js"><\/script>')</script>
		
		<script>
			
			// DOM Ready
			$(function() {
				
				
				
			});
			
		</script>
		
	</body>
</html>


