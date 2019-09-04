<?php

//======================================================================
//
// Fonction permettant la réécriture, optimisée pour le web, du nom du fichier uploadé
//
//======================================================================

if ( !function_exists( 'rewrite_filename_during_upload' ) ) {
	add_filter( 'sanitize_file_name', 'rewrite_filename_during_upload', 10, 1 );
	function rewrite_filename_during_upload( $filename ) {
                    
        // Converti les accents et caractères spéciaux en lettres standard
		$clean_filename = remove_accents( $filename ); 

        // Création du tableau pour convertir certains caractères
		$invalid = array(
			' '   => '-',
			'%20' => '-',
			'_'   => '-',
		);

		// Remplacer les espaces (réel et encodé) et les underscores par des tirets
		$clean_filename = str_replace( array_keys( $invalid ), array_values( $invalid ), $clean_filename );
          
		// Converti/Supprime tous les caractères non-alphanumérique
		$clean_filename = preg_replace('/[^A-Za-z0-9-\. ]/', '', $clean_filename); 
          
		// Supprime tous les points sauf le dernier
		$clean_filename = preg_replace('/\.(?=.*\.)/', '', $clean_filename);
          
		// Remplacer les multi tirets en un seul
		$clean_filename = preg_replace('/-+/', '-', $clean_filename); 
		
        // Supprime le tiret avant le point d'extension du fichier
		$clean_filename = str_replace('-.', '.', $clean_filename);
		
        // Convertir le tout en minuscule
		$clean_filename = strtolower( $clean_filename ); 

		// Renvoi du nom du fichier converti pour le web
		return $clean_filename;
      
	}
}

?>