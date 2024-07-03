<?php
//theme options 
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxCore/framework.php' ) ) {
require_once( dirname( __FILE__ ) . '/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/theme-option.php' ) ) {
require_once( dirname( __FILE__ ) . '/theme-option.php' );
}


function char_count($string, $limit) {	
	$string= strip_tags($string);
	if (mb_strlen($string) < $limit) {
		return $string;
	} else {
		return mb_substr($string, 0, ((int)$limit >0?(int)$limit:0));
	}
}