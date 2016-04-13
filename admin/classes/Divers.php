<?php
require_once("StorageManager.php");

class Divers extends StorageManager {

	public function __construct( $num_divers='', $debug=false ){
		if ( $num_divers != '' ) return $this->load( $num_divers, $debug );
	}
	
	public function load( $num_divers, $debug=false ){
		$this->dbConnect();
		
		if ( intval( $num_divers ) <= 0 ) return array();
		$new_array = null;
		
		$requete = "SELECT * FROM `divers` WHERE num_divers = " . $num_divers ;
		if ( $debug ) echo $requete . "<br>";
		$result = mysqli_query( $this->mysqli, $requete );
		
		while( $row = mysqli_fetch_assoc( $result ) ) {
			$new_array[] = $row;
		}
		$this->dbDisConnect();
		return $new_array;
	}
	
	public function gererDonnees( $post, $debug=false ) {
		$datas = $this->load( $post[ "num_divers" ], $debug );
		$modification = ( !empty( $datas ) ) ? true : false;
		
		$val[ "num_divers" ] = intval( $post[ "num_divers" ] );
		$val[ "pdf_methode_depilation" ] = addslashes( $post[ "pdf_methode_depilation" ] );
		$val[ "pdf_tarif_soin" ] = addslashes( $post[ "pdf_tarif_soin" ] );
		$num_divers = $this->modifier( $val, $debug );
		
		return $num_divers;
	}
	
	public function ajouter( $value, $debug=false ) {
		
	}
	
	public function modifier( $value, $debug=false ) {
		$this->dbConnect();
		$this->begin();
		
		try {
			$sql = "UPDATE .`divers` SET";
			$sql .= " `pdf_methode_depilation` = '" . $value[ "pdf_methode_depilation" ] . "',";
			$sql .= " `pdf_tarif_soin` = '" . $value[ "pdf_tarif_soin" ] . "'";
			$sql .= " WHERE `num_divers` = " . $value[ "num_divers" ] . ";";
			
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
		return $value[ "num_divers" ];
	}
	
	public function supprimer( $num_divers, $debug=false ) {
		
	}
	
	public function setChamp( $champ, $valeur=0, $num_divers=0, $debug=false ) {
		if ( intval( $num_divers ) <= 0 )  return false;
		
		$this->dbConnect();
		$this->begin();
		try {
			$requete = "UPDATE `divers` SET";
			$requete .= " " . $champ . " = '" . $this->traiter_champ( $valeur ) . "'";
			$requete .= " WHERE `num_divers`=" . $num_divers . ";";
			$result = mysqli_query( $this->mysqli, $requete );
			
			if ( $debug ) echo $requete . "<br>";
			else {
				if ( !$result ) {
					throw new Exception( $requete );
				}
				
				$this->commit();
				return false;
			}
			
			return $num_offre;
	
		} catch (Exception $e) {
			$this->rollback();
			throw new Exception("Erreur Mysql ". $e->getMessage());
			return "errrrrrrooooOOor";
		}
	
	
		$this->dbDisConnect();
	}
	
	private function traiter_champ( $texte='' ) {
		$texte = trim( $texte );
		$texte = addslashes( $texte );
		$texte = utf8_decode( $texte );
		
		return $texte;
	}
	
	public function getListe( $tab=array(), $debug=false ) {
		$this->dbConnect();
		
		$champ_souhaite = ( $tab[ "champ" ] != '' ) ? $tab[ "champ" ] : "*";
		$requete = "SELECT " . $champ_souhaite . " FROM `divers`";
		
		if ( $tab[ "where" ] == '' ) {
			$requete .= " WHERE num_divers > 0";
			
			if ( !empty( $tab ) ) {
				foreach( $tab as $champ => $val ) {
					if ( $champ != "champ" && $champ != "order_by" && $champ != "sens" )
						$requete .= " AND " . $champ . " = '" . addslashes( $val ) . "'";
				}
			}
			
			$order_by = ( $tab[ "order_by" ] != "" ) ? $tab[ "order_by" ] : "nom";
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