<?php
require_once("StorageManager.php");
class Soin extends StorageManager {

	public function __construct( $id='', $debug=false ){
		if ( $id != '' ) return $this->load( $id, $debug );
	}
	
	public function load( $id, $debug=false ){
		$this->dbConnect();
		
		if ( intval( $id ) <= 0 ) return array();
		$new_array = null;
		
		$requete = "SELECT * FROM `soin` WHERE id = " . $id ;
		if ( $debug ) echo $requete . "<br>";
		$result = mysqli_query( $this->mysqli, $requete );
		
		while( $row = mysqli_fetch_assoc( $result ) ) {
			$new_array[] = $row;
		}
		$this->dbDisConnect();
		return $new_array;
	}
	
	public function gererDonnees( $post, $debug=false ) {
		$datas = $this->load( $post[ "id" ], $debug );
		$modification = ( !empty( $datas ) ) ? true : false;
		
		$val[ "id" ] = intval( $post[ "id" ] );
		$val[ "id_categorie" ] = intval( $post[ "id_categorie" ] );
		$val[ "titre" ] = addslashes( $post[ "titre" ] );
		$val[ "texte" ] = addslashes( $post[ "texte" ] );
		$val[ "image" ] = addslashes( $post[ "url0" ] );
		$val[ "online" ] = ( $post[ "online" ] == '1' ) ? '1' : '0';
		
		// ---- Modification / Ajout -------- //
		$id = ( $modification )
			? $this->modifier( $val, $debug )
			: $this->ajouter( $val, $debug );
		
		return $id;
	}
	
	public function ajouter( $value, $debug=false ) {
		$this->dbConnect();
		$this->begin();
		
		try {
			$sql = "INSERT INTO `soin`
				( `id_categorie`, `titre`, `texte`, `image`, `online` )
				VALUES (
				'" . $value[ "id_categorie" ] . "',
				'" . $value[ "titre" ] ."',
				'" . $value[ "texte" ] ."',
				'" . $value[ "image" ] ."',
				'" . $value[ "online" ] ."'
			);";
			
			if ( $debug ) echo $sql . "<br>";
			else {
				$result = mysqli_query( $this->mysqli, $sql );
				
				if ( !$result ) {
					throw new Exception( $sql );
				}
				
				$id_record = mysqli_insert_id( $this->mysqli );
				$this->commit();
			}
		
		} 
		catch (Exception $e) {
			$this->rollback();
			throw new Exception("Erreur Mysql ". $e->getMessage());
			return "errrrrrrooooOOor";
		}
		$this->dbDisConnect();
		return $id_record;
	}
	
	public function modifier( $value, $debug=false ) {
		$this->dbConnect();
		$this->begin();
		
		try {
			$sql = "UPDATE `soin` SET";
			$sql .= " `id_categorie` = '" . $value[ "id_categorie" ] ."',";
			$sql .= " `titre` = '" . $value[ "titre" ] . "',";
			$sql .= " `texte` = '" . $value[ "texte" ] . "',";
			if ( $value[ "image" ] != '' ) $sql .= " `image` = '" . $value[ "image" ] . "',";
			$sql .= " `online` = '" . $value[ "online" ] . "'";
			$sql .= " WHERE `id` = " . $value[ "id" ] . ";";
			
			if ( $debug ) echo $sql . "<br>";
			else {
				$result = mysqli_query( $this->mysqli, $sql );
				
				if ( !$result ) {
					throw new Exception( $sql );
				}
			
				$this->commit();
			}
		
		} catch (Exception $e) {
			$this->rollback();
			throw new Exception("Erreur Mysql ". $e->getMessage());
			return "errrrrrrooooOOor";
		}
		
		$this->dbDisConnect();
		return $value[ "id" ];
	}
	
	public function supprimer( $id, $debug=false ) {
		$this->dbConnect();
		$this->begin();
	
		try {
			
			// ---- Chargement du soin -------------- //
			$data = $this->load( $id, $debug );
			//print_pre( $data );
			
			// ---- Supresion physique des images --- //
			$this->dbConnect();
			// ....
			
			// ---- Suppression de la catégorie ---- //
			$sql = "DELETE FROM `soin`";
			$sql .= " WHERE `id`=" . $id . ";";
			
			if ( $debug ) echo $sql . "<br>";
			else {
				$result = mysqli_query( $this->mysqli, $sql );
				if (!$result) {
					throw new Exception($sql);
				}
				
				$this->commit();
			}
	
		} catch (Exception $e) {
			$this->rollback();
			throw new Exception("Erreur Mysql ". $e->getMessage());
			return "errrrrrrooooOOor";
		}
	
	
		$this->dbDisConnect();
	}
	
	function setChamp( $id=0, $champ, $valeur=0, $debug=false ) {
		$this->dbConnect();
		$this->begin();
		
		$requete = "UPDATE `soin` SET";
		$requete .= " " . $champ . " = '" . $this->traiter_champ( $valeur ) . "'";
		$requete .= " WHERE id = " . $id;
		if ( $debug ) echo $requete . "<br>";
		else {
			$result = mysqli_query( $this->mysqli, $requete );
		
			if ( !$result ) {
				$this->rollback();
				throw new Exception( 'Erreur Mysql valideCommande sql = : ' . $requete );
			}
			
			$this->commit();
			$this->dbDisConnect();
		}
	}
	
	function traiter_champ( $texte='' ) {
		$texte = trim( $texte );
		$texte = addslashes( $texte );
		//$texte = utf8_decode( $texte );
		
		return $texte;
	}
	
	public function getListe( $tab=array(), $debug=false ) {
		$this->dbConnect();
		
		$champ_souhaite = ( $tab[ "champ" ] != '' ) ? $tab[ "champ" ] : "*";
		$requete = "SELECT " . $champ_souhaite . " FROM `soin`";
		
		if ( $tab[ "where" ] == '' ) {
			$requete .= " WHERE id > 0";
			
			if ( !empty( $tab ) ) {
				foreach( $tab as $champ => $val ) {
					if ( $champ != "champ" && $champ != "order_by" && $champ != "sens" )
						$requete .= " AND " . $champ . " = '" . addslashes( $val ) . "'";
				}
			}
			
			$order_by = ( $tab[ "order_by" ] != "" ) ? $tab[ "order_by" ] : "titre";
			$sens = ( $tab[ "sens" ] != "" ) ? $tab[ "sens" ] : "ASC";
			$requete .= " ORDER BY " . $order_by . " " . $sens;
		}
		else $requete .= $tab[ "where" ];
		
		if ( $debug ) echo $requete . "<br>";
		$result = mysqli_query( $this->mysqli, $requete );
		
		while( $row = mysqli_fetch_assoc( $result ) ) {
			$new_array[] = $row;
		}
		$this->dbDisConnect();
		return $new_array;
	}
	
}