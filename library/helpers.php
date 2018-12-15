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



/*----------------------------------------------djh Dec 14, 2018
  Simple Minify a String
  - replace multiple spaces with single space
  - replace new lines and returns with nothing
----------------------------------------------*/
if ( ! function_exists( 'simple_string_minify' ) ) :
	function simple_string_minify($string='') {
        // turn multiple spaces into single space
		$string = preg_replace('!\s+!', ' ', $string);
        // purge newlines and returns
        $string = str_replace(array("\r", "\n"), '', $string);
        // compress curly brackets
        $string = str_replace('{ ', '{', $string);
        $string = str_replace(' }', '}', $string);
		return $string;
	}
endif;



/*----------------------------------------------djh Dec 14, 2018
  Calculate content width %'s based on sidebar width
----------------------------------------------*/
if ( ! function_exists( 'calc_grid_chunks' ) ) :
	function calc_grid_chunks($known=array(4),$grid=12) {
		$output = array();
		$known_total = 0;
		foreach ($known as $key => $value) {
			$known_total += intval($value);
			$knownkey = 'sidebar' . $key;
			$output[$knownkey] = convert_grid_to_perc(intval($value),$grid,'sidebar');
		}
		$unknown_total = 12 - $known_total;
		$content_width = convert_grid_to_perc($unknown_total,$grid,'content');
		$output['content'] = $content_width;

		return $output;
	}
endif;



/*----------------------------------------------djh Dec 14, 2018
  Convert column int to percentage
----------------------------------------------*/
if ( ! function_exists( 'convert_grid_to_perc' ) ) :
	function convert_grid_to_perc($column,$grid,$where) {
		$output = '100%';
		// force 12 column grid until further notice
		if ( $grid !== 12 ) {
			$grid = 12;
		}
		if ( $where === 'sidebar' ) {
			switch (intval($column)) {
			    case 1:
			        $output = '8.33333%';
			        break;
			    case 2:
			        $output = '16.66666%';
			        break;
			    case 3:
			        $output = '25%';
			        break;
			    case 4:
			        $output = '33.33333%';
			        break;
			    case 5:
			        $output = '41.66666%';
			        break;
			    case 6:
			        $output = '50%';
			        break;
			    case 7:
			        $output = '58.33333%';
			        break;
			    case 8:
			        $output = '66.66666%';
			        break;
			    case 9:
			        $output = '75%';
			        break;
			    case 10:
			        $output = '83.33333%';
			        break;
			    case 11:
			        $output = '91.66666%';
			        break;
			    case 12:
			        $output = '100%';
			        break;
			}
		} else if ( $where === 'content' ) {
			switch (intval($column)) {
			    case 1:
			        $output = '8.33334%';
			        break;
			    case 2:
			        $output = '16.66667%';
			        break;
			    case 3:
			        $output = '25%';
			        break;
			    case 4:
			        $output = '33.33334%';
			        break;
			    case 5:
			        $output = '41.66667%';
			        break;
			    case 6:
			        $output = '50%';
			        break;
			    case 7:
			        $output = '58.33334%';
			        break;
			    case 8:
			        $output = '66.66667%';
			        break;
			    case 9:
			        $output = '75%';
			        break;
			    case 10:
			        $output = '83.33334%';
			        break;
			    case 11:
			        $output = '91.66667%';
			        break;
			    case 12:
			        $output = '100%';
			        break;
			}
		}
		return $output;
	}
endif;











