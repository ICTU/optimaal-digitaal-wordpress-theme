<?php

///
// Optimaal Digitaal - page_all-cards.php
// ----------------------------------------------------------------------------------
// Template voor het tonen van alle tips, zonder filter
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.1.2
// @desc.   Pagina-templates voor diverse functies toegevoegd.
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme
///
 
//* Template Name: Pagina met alle tips zonder filter


//remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

//remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'fn_od_wbvb_tips_archive_cards_home_no_filter' );



genesis();
