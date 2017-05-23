<?php

///
// Optimaal Digitaal - page_filter.php
// ----------------------------------------------------------------------------------
// Biedt mogelijkheid om een pagina aan te maken met toegevoegde filtermogelijkheid
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 2.6.8
// @desc.   Functions naming convention
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme
///

//* Template Name: Filterpagina  

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'fn_od_wbvb_tips_archive_cards_home_met_filter' );

genesis();
