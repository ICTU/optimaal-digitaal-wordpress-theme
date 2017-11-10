<?php

///
// Optimaal Digitaal - page_tipgevers.php
// ----------------------------------------------------------------------------------
// Toont alle citaten en citaatgevers in alle tips
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 2.11.3
// @desc.   Contactinfo: visitekaartje op single met achtergrondkleur.
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme
///

//* Template Name: Overzicht tipgevers  

add_action( 'genesis_header', 'genesis_do_post_title', 12 );

remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );


add_action( 'genesis_entry_content', 'fn_od_wbvb_overzicht_tipgevers', 12 );

genesis();

//========================================================================================================

function fn_od_wbvb_overzicht_tipgevers() {

  $terms = get_terms( array(
    'taxonomy'    => OD_CITAATAUTEUR,
    'hide_empty'  => true,
  ) );

  if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
    echo '<div class="overzicht-tipgevers">';


    foreach ( $terms as $term ) {

      $content        = '';
      $listitems      = '';
      $image_tag      = '';
      $acfid          = $term->taxonomy . '_' . $term->term_id;
      $tipgever_foto  = get_field('tipgever_foto', $acfid);
      $functietitel   = get_field( 'tipgever_functietitel', $acfid );
      $tipgever_mail  = get_field( 'tipgever_mail', $acfid );
      $tipgever_foon  = get_field( 'tipgever_telefoonnummer', $acfid );

      if ( $tipgever_foto ) {
  
        $size       = 'thumbnail';
        $thumb      = $tipgever_foto['sizes'][ $size ];
        $width      = $tipgever_foto['sizes'][ $size . '-width' ];
        $height     = $tipgever_foto['sizes'][ $size . '-height' ];
        $alt        = $tipgever_foto['alt'];
  
        $image_tag  = '<img src="' . $thumb . '" alt="' . $alt . '" width="' . $width . '" height="' . $height . '" class="alignright" />';
                        
      }    

      $titel = '<h2 id="' . sanitize_title( $term->name ) . '">' . $term->name . '</h2>';

      if ( $functietitel ) {
        $content .= '<p>' . $functietitel . '</p>';
      }

      if ( $image_tag ) {
        $content .= $image_tag;
      }
      
      if ( $tipgever_mail ) {
//        $listitems .= '<li class="mailto"><a href="mailto:' . $tipgever_mail . '">' . $tipgever_mail . '</a></li>';
        $listitems .= '<li class="mailto">' . $tipgever_mail . '</li>';
      }
      if ( $tipgever_foon ) {
//        $listitems .= '<li class="tel"><a href="tel:' . preg_replace("/[^0-9+]/", "", $tipgever_foon) . '">' . $tipgever_foon . '</a></li>';
        $listitems .= '<li class="tel">' . $tipgever_foon . '</li>';
      }
      if ( $listitems ) {
        $listitems = '<ul>' . $listitems . '</ul>';
      }

      echo '<div class="visitekaartje"><a href="' . get_term_link( $term, OD_CITAATAUTEUR ) . '">' . $titel . $content . $listitems . '<p class="tiplink">' . sprintf( __( 'Bekijk alle tips <span class="visuallyhidden">van %s</span>', 'gebruikercentraal' ), $term->name ) . '</p></a></div>';
    }
    echo '</div>';
  }

  
}

//========================================================================================================

