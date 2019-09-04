<?php

//======================================================================
//
// Fonction permettant de mettre le canonical sur la page principale disposant d'une pagination dans son url.
//
//======================================================================

if ( !function_exists( 'canonical_url_pagination' ) ) {
	add_action('wp_head', 'canonical_url_pagination');
	function canonical_url_pagination(){
		
		$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		$canonicalURL = explode('/page',$url)[0];
		
		if (strpos($url,'/page/') !== false) {
		?>
			<link rel="canonical" href="<?php echo $canonicalURL . '/'; ?>" />
		<?php
		} else {
		?>
			<link rel="canonical" href="<?php echo $url; ?>" />
		<?php
		}
		
	}
}

?>