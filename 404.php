<?php

///
// Optimaal Digitaal - 404.php
// ----------------------------------------------------------------------------------
// De pagina voor ongevonden pagina's
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 2.6.8
// @desc.   Functions naming convention
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme
///


remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );


remove_action( 'genesis_loop', 'genesis_do_loop' );
remove_action( 'genesis_loop', 'genesis_404' );

add_action( 'genesis_loop', 'fn_od_wbvb_toon_sitemap' );

genesis();

