<? include_once ( $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/inc-auth-granted.php" );?>
<? include_once ( $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/classes/utils.php" );?>
<? 
	require( $_SERVER[ "DOCUMENT_ROOT" ] . "/inc/inc.config.php" );
	require $_SERVER[ "DOCUMENT_ROOT" ] . "/admin/classes/Divers.php";
	
	$mon_action = $_POST[ "mon_action" ];
	$debug = false;
	$divers = new Divers();
	
	$info_divers = $divers->load( 1, $debug );
	
	if ( $debug ) print_pre( $_POST );
	//if ( $debug ) print_pre( $info_divers[ 0 ] );
	
	// ---- Actions à mener ---------------------------- //
	if ( $mon_action != '' ) {
		
		if ( $mon_action == "gerer" ) {
			if ( $debug ) echo "Ajout / modif des pdfs...<br>";
			$tab_pdf = array( "pdf_methode_depilation", "pdf_tarif_soin" );
			
			// ---- Gestion des PDFs ------------------- //
			foreach( $tab_pdf as $pdf ) {
				
				if ( $_POST[ $pdf ] != '' && $_POST[ $pdf ] != $info_divers[ 0 ][ $pdf ] ) {
					//echo "Traitement de " . $pdf . "<br>";
					
					// ---- Suppression du fichier précédent
					if ( $info_divers[ 0 ][ $pdf ] != '' && file_exists( $_SERVER[ "DOCUMENT_ROOT" ] . "/pdf/" . $info_divers[ 0 ][ $pdf ] ) ) {
						if ( $debug ) echo "Suppression de " . $_SERVER[ "DOCUMENT_ROOT" ] . "/pdf/" . $info_divers[ 0 ][ $pdf ] . "<br>";
						else unlink( $_SERVER[ "DOCUMENT_ROOT" ] . "/pdf/" . $info_divers[ 0 ][ $pdf ] );
					}
					
					// ---- Traitement du nom de fichier //
					if ( 1 == 1 ) {
						$info_fichier = pathinfo( $_SERVER[ "DOCUMENT_ROOT" ] . $_POST[ $pdf ] );
						//print_pre( $info_fichier );
						
						$nouveau_fichier = $info_fichier[ "filename" ] . "_" . date( "Y_m_d" ) . "." . $info_fichier[ "extension" ];
					}
					
					// ---- Copie du pdf --------------- //
					$result = copy(
						$_SERVER[ "DOCUMENT_ROOT" ] . $_POST[ $pdf ],
						$_SERVER[ "DOCUMENT_ROOT" ] . "/pdf/" . $nouveau_fichier
					);
					
					// ---- MAJ de la BDD -------------- //
					if ( $result ) {
						$divers->setChamp(
							$pdf,
							$nouveau_fichier,
							1,
							$debug
						);
					}
					
				}
			}
			// ----------------------------------------- //
			
			// ---- On recharge les infos -------------- //
			$info_divers = $divers->load( 1, $debug );
			
		}
	}
	// ------------------------------------------------- //
	
	// ---- Traitemant avan affichage ------------------ //
	if ( 1 == 1 ) {
		
		$pdf_methode_depilation = ( $info_divers[ 0 ][ "pdf_methode_depilation" ] != '' && file_exists( $_SERVER[ "DOCUMENT_ROOT" ] . "/pdf/" . $info_divers[ 0 ][ "pdf_methode_depilation" ] ) )
			? $info_divers[ 0 ][ "pdf_methode_depilation" ]
			: "";
		
		$pdf_tarif_soin = ( $info_divers[ 0 ][ "pdf_tarif_soin" ] != '' && file_exists( $_SERVER[ "DOCUMENT_ROOT" ] . "/pdf/" . $info_divers[ 0 ][ "pdf_tarif_soin" ] ) )
			? $info_divers[ 0 ][ "pdf_tarif_soin" ]
			: "";
	}
	// ------------------------------------------------- //
	
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
					<form name="formulaire" id="formulaire" class="form-horizontal" method="POST" action="./gestion_pdf.php">
						<input type="hidden" name="mon_action" value="gerer">
						<input type="hidden" name="idImage" id="idImage" value="">
						
						<!-- PDF "Méthode dépilation" -->
						<div class="form-group" >
							<label class="col-sm-3" for="titre">PDF "Méthode dépilation" :</label>
							<div class="col-md-3">
								<input type="hidden" name="pdf_methode_depilation" id="urlpdf_methode_depilation" value="<?=$pdf_methode_depilation?>">
								<?=$pdf_methode_depilation?>
							</div>
							<div class="col-md-4">
								<? 
								$style_pdf = ( $pdf_methode_depilation != '' ) ? "" : "style='display:none;'";
								?>
								<div id="visu_pdf_methode_depilation" <?=$style_pdf?> ><a href="/pdf/<?=$pdf_methode_depilation?>" class="btn btn-info col-sm-5" target="_blank">Visualiser</a></div>
								<div id="modif_pdf_methode_depilation" ><a href="javascript:openCustomRoxy( 'pdf_methode_depilation' )" class="btn btn-primary col-sm-5">Modifier</a></div>
								<div id="wait_pdf_methode_depilation" style="display:none;" ><img src="../img/loader.gif" /></div>
							</div>
						</div>
						
						<!-- PDF "Tarifs soins" -->
						<div class="form-group">
							<label class="col-sm-3" for="texte">PDF "Tarifs soins" :</label>
							<div class="col-md-3">
								<input type="hidden" name="pdf_tarif_soin" id="urlpdf_tarif_soin" value="<?=$pdf_tarif_soin?>">
								<?=$pdf_tarif_soin?>
							</div>
							<div class="col-md-4">
								<? 
								$style_pdf = ( $pdf_tarif_soin != '' ) ? "" : "style='display:none;'";
								?>
								<div id="visu_pdf_tarif_soin" <?=$style_pdf?> ><a href="/pdf/<?=$pdf_tarif_soin?>" class="btn btn-info col-sm-5" target="_blank">Visualiser</a></div>
								<div id="modif_pdf_tarif_soin" ><a href="javascript:openCustomRoxy( 'pdf_tarif_soin' )" class="btn btn-primary col-sm-5">Modifier</a></div>
								<div id="wait_pdf_tarif_soin" style="display:none;" ><img src="../img/loader.gif" /></div>
							</div>
						</div>
						
						<div id="roxyCustomPanel" style="display:none;">
							<iframe src="/admin/fileman2/index.html?integration=custom" style="width:100%;height:100%" frameborder="0"></iframe>
						</div>
						
					</form>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
			
			/*tinymce.init({
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
			});*/

			/*function RoxyFileBrowser( field_name, url, type, win ) {
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
					title: 			"Gestionnaire de fichiers",
					width: 			850, 
					height: 		650,
					resizable: 		"yes",
					plugins: 		"media",
					inline: 		"yes",
					close_previous:	"no" 
				}, {   
					window: win,
					input: field_name
				});
				return false; 
			}*/
			
			function openCustomRoxy( idImage ) {
				//alert( idImage );
				
				$( "#idImage" ).val( idImage );
				$( "#roxyCustomPanel" ).dialog({
					modal:true, 
					width:875,
					height:600
				});
			}
			function closeCustomRoxy(){
				var pdf = $( "#idImage" ).val();
				$( "#roxyCustomPanel" ).dialog('close');
				
				// ---- Fichier sélectionné -------- //
				if ( $( "#url" + pdf ).val() != '' ) {
					$( "#modif_" + pdf ).hide();
					$( "#wait_" + pdf ).show();
					
					$( "#formulaire" ).submit();
				}
			}
			
		</script>
		
	</body>
</html>


