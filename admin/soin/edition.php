<? include_once ( $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/inc-auth-granted.php" );?>
<? include_once ( $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/classes/utils.php" );?>
<? 
	require( $_SERVER[ "DOCUMENT_ROOT" ] . "/inc/inc.config.php" );
	require $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/classes/Soin_categorie.php";
	require $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/classes/Soin.php";
	
	$debug = false;
	$categorie = new Soin_categorie();
	$soin = new Soin();
	
	// ---- Liste des catégories disponibles -------- //
	if ( 1 == 1 ) {
		unset( $recherche );
		$liste_categorie = $categorie->getListe( $recherche, $debug );
		//print_pre( $liste_categorie );
	}
	// ---------------------------------------------- //
	
	// ---- Modification ---------------------------- //
	if ( !empty( $_GET ) ) {
		$result = $soin->load( $_GET[ "id" ] );
		//print_pre( $result );
		
		if ( empty( $result ) ) {
			$message = 'Aucun enregistrement';
		} 
		else {
			$labelTitle = 	"Soin N°: " . $_GET[ "id" ];
			$id = 			$_GET[ "id" ];
			$id_categorie =	$result[ 0 ][ "id_categorie" ];
			$titre = 		$result[ 0 ][ "titre" ];
			$texte = 		$result[ 0 ][ "texte" ];
			$image = 		$result[ 0 ][ "image" ];
			$online = 		( $result[ 0 ][ "online" ] == '1' ) ? "checked" : '';
			
			if( empty( $image ) || !isset( $image ) ) {
				$img = 		"/img/photos-soins-01.jpg";
				$imgval = 	'';
			} 
			else {
				$img = 		"/photos/soin/thumbs". $image;
				$imgval = 	$image;
			}
		}
	} 
	// ---- Ajout ----------------------------------- //
	else {
		$labelTitle = 	"Edition Nouveau soin";
		$id = 			null;
		$id_categorie =	0;
		$titre = 		null;
		$texte = 		null;
		$online = 		null;
		$img = 			"/img/photos-soins-01.jpg";
		$imgval = 		'';
	}
?>

<!doctype html>
<html class="no-js" lang="fr">
	<head>
		<? include_once $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/inc-meta.php";?>
	</head>
	
	<body>	
		<? require_once $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/inc-menu.php";?>
	
		<div class="container">
	
			<div class="row">
				<h3><?=$labelTitle?></h3>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<form name="formulaire" class="form-horizontal" method="POST" action="./traitement.php">
						<input type="hidden" name="mon_action" value="gerer">
						<input type="hidden" name="id" id="id" value="<?=$id?>">
						
						<div class="form-group" >
							<label class="col-sm-2" for="titre">Catégorie :</label>
							<select name="id_categorie" required >
								<option value="" selected>-- Choisir --</option>
								<?
								if ( !empty( $liste_categorie ) ) {
									foreach( $liste_categorie as $_categorie ) {
										$selected = ( $_categorie[ "id" ] == $id_categorie ) ? "selected" : "";
										echo "<option value='" . $_categorie[ "id" ] . "' " . $selected . ">" . ( $_categorie[ "titre" ] ) . "</option>\n";
									}
								}
								?>
							</select>
						</div>
						
						<div class="form-group" >
							<label class="col-sm-2" for="titre">Titre :</label>
							<input type="text" class="col-sm-10" name="titre" required value="<?=$titre?>">
						</div>
						
						<div class="form-group">
							<label class="col-sm-2" for="texte">Texte :</label><br>
							<textarea class="col-sm-10" name="texte" id="texte" rows="5" required ><?=$texte?></textarea>
						</div>
						
						<div class="form-group" >
							<label class="col-sm-2" for="titre">En ligne :</label>
							<input type="checkbox" name="online" <?=$online?>>
						</div>
						
						<div class="form-group"><br>
							<label class="col-sm-2">Choisissez la photo :</label>
							<input type="hidden" name="idImage" id="idImage" value="">
						</div>	
						
						<div class="col-md-4" style="margin-bottom:20px;">
							<input type="hidden" name="url0" id="url0" value="<?=$imgval?>"><br>
							<a href="javascript:openCustomRoxy('0')"><img src="<?=$img?>" id="customRoxyImage0" style="max-width:200px;"></a>
							<img src="img/del.png" width="20" alt="Supprimer" onclick="clearImage(0)"/>
						</div>	
						
						<div id="roxyCustomPanel" style="display:none;">
							<iframe src="/admin/fileman2/index.html?integration=custom" style="width:100%;height:100%" frameborder="0"></iframe>
						</div>
						
						<div style="clear:both;"></div>
						<button class="btn btn-success col-sm-6 annuler" type="button"> Annuler </button>
						<button class="btn btn-success col-sm-6" type="submit"> Valider </button>
					
					</form>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
			
			tinymce.init({
				selector: "textarea.editme",
				// ===========================================
				// INCLUDE THE PLUGIN
				// ===========================================
				plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen textcolor",
				"insertdatetime media table contextmenu paste jbimages"
				],
									
				// ===========================================
				// PUT PLUGIN'S BUTTON on the toolbar
				// ===========================================
				toolbar: "insertfile undo redo | styleselect | forecolor backcolor | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
				// ===========================================
				// SET RELATIVE_URLS to FALSE (This is required for images to display properly)
				// ===========================================
				// AJOUTE LES URL EN ENTIER decommenter les 2 lignes suivantes
				//document_base_url: "http://dev.bsport.fr",
				//remove_script_host : false,
				relative_urls: false,
				file_browser_callback: RoxyFileBrowser
			});

			function RoxyFileBrowser(field_name, url, type, win) {
				var roxyFileman = '/admin/fileman/index.html';
				if (roxyFileman.indexOf("?") < 0) {   
					roxyFileman += "?type=" + type;  
				}
				else {
					roxyFileman += "&type=" + type;
				}
				roxyFileman += '&input=' + field_name + '&value=' + document.getElementById(field_name).value;
				if(tinyMCE.activeEditor.settings.language){
					roxyFileman += '&langCode=' + tinyMCE.activeEditor.settings.language;
				}
				tinyMCE.activeEditor.windowManager.open({
					file: roxyFileman,
					title: 'Gestionnaire de fichiers',
					width: 850, 
					height: 650,
					resizable: "yes",
					plugins: "media",
					inline: "yes",
					close_previous: "no" 
				}, {   
					window: win,
					input: field_name
				});
				return false; 
			}
			
			function openCustomRoxy(idImage){
				$('#idImage').val(idImage);
			 $('#roxyCustomPanel').dialog({modal:true, width:875,height:600});
			}
			function closeCustomRoxy(){
			 $('#roxyCustomPanel').dialog('close');
			}
			
			function clearImage(idImage){
				$( '#customRoxyImage' + idImage ).attr( "src", "/img/photos-soins-01.jpg" );
				$( '#url' + idImage ).val( '' );
			}
			
			$( ".annuler" ).click(function() {
				window.location.href = "./liste.php";
			});
				
		</script>
		
	</body>
</html>


