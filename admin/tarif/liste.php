<? include_once ( $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/inc-auth-granted.php" );?>
<? include_once ( $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/classes/utils.php" );?>
<? 
	require( $_SERVER[ "DOCUMENT_ROOT" ] . "/inc/inc.config.php" );
	require $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/classes/Tarif_categorie.php";
	require $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/classes/Tarif.php";
	
	$debug = false;
	$categorie = new Tarif_categorie();
	$tarif = new Tarif();
	
	$id_categorie = ( $_POST[ "id_categorie" ] != '' ) ? $_POST[ "id_categorie" ] : $_GET[ "id_categorie" ];
	
	// ---- Liste des catégories de tarifs -------- //
	if ( 1 == 1 ) {
		unset( $recherche );
		$liste_categorie = $categorie->getListe( $recherche, $debug );
	}
	// -------------------------------------------- //
	
	// ---- Liste des tarifs ---------------------- //
	if ( 1 == 1 ) {
		unset( $recherche );
		if ( $id_categorie != '' ) $recherche[ "id_categorie" ] = $id_categorie;
		$liste_tarif = $tarif->getListe( $recherche, $debug );
	}
	// -------------------------------------------- //

	if ( empty( $liste_tarif ) ) {
		$message = 'Aucun enregistrement';
	} 
	else {
		$message = '';
	}

?>

<!doctype html>
<html class="no-js" lang="en">
	<head>
		<? include_once $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/inc-meta.php";?>
	</head>
	
	<body>	
		<? require_once $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/inc-menu.php";?>
	
		<div class="container">
			
			<div class="row">
				<form name="formulaire" class="form-horizontal" method="POST"  action="liste.php" >
					<div class="col-md-2">	
						<label  >&nbsp;Filtrez par catégorie :</label>
					</div>
					<div class="col-md-4">		
						<select name="id_categorie">
							<option value="" selected>-- afficher tout --</option>
							<?
							if ( !empty( $liste_categorie ) ) {
								foreach( $liste_categorie as $_categorie ) {
									$selected = ( $id_categorie == $_categorie[ "id" ] ) ? "selected" : "";
									echo "<option value='" . $_categorie[ "id" ] . "' " . $selected . " >" . $_categorie[ "titre" ] . "</option>\n";
								}
							}
							?>
						</select>	
					</div>	
					<div class="col-md-3">		
						<button class="btn btn-success col-sm-3" type="submit" >Filtrer</button>
					</div>
				</form>
				<br><br>
			</div>
			
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<? 
					if ( !empty( $liste_tarif ) ) {
						?>
						<table class="table table-hover table-bordered table-condensed table-striped" >
							<thead>
								<tr>
									<th class="col-md-2" style="">Titre</th>
									<th class="col-md-2" style="">Catégorie</th>
									<th class="col-md-6" style="">Description</th>
									<th class="col-md-1" style="">Photo</th>
									<th class="col-md-1" style="">Online</th>
									<th class="col-md-1" colspan="2" style="">Actions</th>
								</tr>
							</thead>
							<tbody>
							<?
							$i=0;
							foreach ( $liste_tarif as $value ) {
								$i++;
								
								// ---- Chargement de la catégorie associée
								$data = $categorie->load( $value[ "id_categorie" ] );
								
								$classe_affichage = ( $i % 2 != 0 ) ? "info" : "";
								$description = couper_correctement( $value[ "texte" ], 50 );
								if ( strlen( $value[ "texte" ] ) > 50 ) $description .= " ...";
								$image_ok = ( $value[ "image" ] != '' ) ? 'check' : 'vide';
								$online = ( $value[ "online" ] == '1' ) ? 'check' : 'vide';
								
								echo "<tr class='" . $classe_affichage . "'>\n";
								echo "	<td>" . $value[ "titre" ] . "</td>\n";
								echo "	<td>" . $data[ 0 ][ "titre" ] . "</td>\n";
								echo "	<td>" . $description . "</td>\n";
								echo "	<td align='center'><img src='../img/" . $image_ok . ".png' width='30' ></td>\n";
								echo "	<td align='center'><img src='../img/" . $online . ".png' width='30' ></td>\n";
								echo "	<td><a href='./edition.php?id=" . $value[ "id" ] . "'><img src='../img/modif.png' width='30' alt='Modifier' ></a></td>\n";
								echo "	<td>\n";
								echo "		<div style='display: none;' class='supp" . $value[ "id" ] . " alert alert-warning alert-dismissible fade in' role='alert'>\n";
								echo "			<button type='button' class='close' aria-label='Close' onclick=\"$('.supp" . $value[ "id" ] . "').css('display', 'none');\"><span aria-hidden='true'>×</span></button>\n";
								echo "			<strong>Voulez vous vraiment supprimer ?</strong>\n";
								echo "			<button type='button' class='btn btn-danger' onclick=\"location.href='./traitement.php?reference=news&action=delete&id=" . $value[ "id" ] . "'\">Oui !</button>\n";
								echo "		</div>\n";
								echo "		<img src='../img/del.png' width='20' alt='Supprimer' onclick=\"$('.supp" . $value[ "id" ] . "').css('display', 'block');\">\n";
								echo "	</td>\n";
								echo "</tr>\n";
							}
							?>
							</tbody>
						</table>
						<?
					}
					?>
	
					<h3><?=$message?></h3>
				</div>
			</div>
		</div>
	</body>
</html>


