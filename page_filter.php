<?php

///
// Optimaal Digitaal - page_filter.php
// ----------------------------------------------------------------------------------
// Biedt mogelijkheid om een pagina aan te maken met toegevoegde filtermogelijkheid
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.1.2
// @desc.   Pagina-templates voor diverse functies toegevoegd.
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme
///

//* Template Name: Pagina met tip-filter (oud)

//remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'fn_od_wbvb_tips_archive_cards_home_met_filter' );

genesis();
