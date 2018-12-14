<?php

/*----------------------------------------------djh Dec 12, 2018
  Current Version / Cache Breaker
----------------------------------------------*/
if ( ! function_exists( 'gutencore_current_version' ) ) :
	function gutencore_current_version() {
		$version = '0.0.1';
		$non_prod_strings = array('dev','test','staging','localhost');
		// check for Theme Settings "Staging URL ID String" option
		if ( get_option( 'options_uc_staging_url_identifier' ) ) {
			$non_prod_strings[] = esc_html( get_option( 'options_uc_staging_url_identifier' ) );
		}
		// check for Theme Settings "Development URL ID String" option
		if ( get_option( 'options_uc_development_url_identifier' ) ) {
			$non_prod_strings[] = esc_html( get_option( 'options_uc_development_url_identifier' ) );
		}
		// if any of the non-production strings are found in URL, 
		// break cache with a rando, otherwise return version
		if ( strpos_arr(home_url(), $non_prod_strings) !== false ) {
			return '999.' . rand(1,9999);
		} else {
			return $version;			
		}
	}
endif;

/*----------------------------------------------djh Aug 28, 2018
  Debug to console
----------------------------------------------*/
if ( ! function_exists( 'debug_to_console' ) ) :
	function debug_to_console($obj) {
		$jsonprd = json_encode($obj);
		print_r('<script>console.log('.$jsonprd.')</script>');
	}
endif;

/*----------------------------------------------djh Aug 28, 2018
  Prefab var_dump
----------------------------------------------*/
if ( ! function_exists( 'cvar_dump' ) ) :
	function cvar_dump($var) {
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
endif;

/*----------------------------------------------djh Dec 13, 2018
  strpos with array arg
  CREDIT: https://stackoverflow.com/questions/6284553/using-an-array-as-needles-in-strpos
----------------------------------------------*/
if ( ! function_exists( 'strpos_arr' ) ) :
	function strpos_arr( $haystack, $needle, $offset=0 ) {
	    if ( ! is_array( $needle ) ) $needle = array( $needle );
	    foreach ( $needle as $query ) {
	        if ( strpos( $haystack, $query, $offset) !== false) return true; // stop on first true result
	    }
	    return false;
	}
endif;





