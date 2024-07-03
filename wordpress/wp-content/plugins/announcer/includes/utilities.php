<?php

if( ! defined( 'ABSPATH' ) ) exit;

class ANCR_Utilities{

    public static function style_generator( $styles ){

        $properties = [];
        extract( $styles, EXTR_SKIP );

        if( !empty( $background_color ) ){
            $properties[ 'background' ] = $background_color;
        }

        if( !empty( $font_color ) ){
            $properties[ 'color' ] = $font_color;
        }

        if( !empty( $font_size ) ){
            $properties[ 'font-size' ] = "{$font_size}px";
        }

        if( isset( $border_width ) && $border_width > 0 ){
            $border_style = empty( $border_style ) ? 'solid' : $border_style;
            $border_color = empty( $border_color ) ? 'transparent' : $border_color;
            $properties[ 'border' ] = "{$border_width}px $border_style $border_color";
        }

        if( isset( $border_radius ) && $border_radius > 0 ){
            $properties[ 'border-radius' ] = "{$border_radius}px";
        }

        if( !empty( $width ) ){
            $properties[ 'min-width' ] = $width;
        }

        if( isset( $shadow ) && $shadow == 'yes' ){
            $properties[ 'box-shadow' ] = '0 2px 4px -2px rgba(0, 0, 0, 0.5)';
        }

        $props_text = '';
        foreach( $properties as $prop => $value ){
            $props_text .= "{$prop}:{$value};";
        }

        return $props_text;

    }

    public static function datetime_timestamp( $datetime, $timezone ){

        if( empty( $datetime ) ){
            return '';
        }

        try{
            $tz = new DateTimezone( $timezone );
        }catch( Exception $e ) {
            $tz = null;
        }

        try{
            $t = new DateTime( $datetime, $tz );
            return $t->getTimestamp();
        }catch( Exception $e ){
            return '';
        }

    }

}

?>