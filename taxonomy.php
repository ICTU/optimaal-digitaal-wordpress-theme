<?php

///
// Optimaal Digitaal - taxonomy-tipthema.php
// ----------------------------------------------------------------------------------
// Taxonomie-pagina voor tip-thema's
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 2.7.1
// @desc.   Taxonomy, archives reviewed. Sharing icons restyled, pagination updated.
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme
///

remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
remove_action( 'genesis_loop', 'genesis_do_loop' );
remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );

add_action( 'genesis_loop', 'op_do_show_cards_for_thema', 10 );

add_filter( 'genesis_term_intro_text_output', 'wpautop' );

// add description
add_action( 'genesis_before_loop', 'rhswp_add_taxonomy_description', 15 );



genesis();




    
    