<?php

///
// Optimaal Digitaal - page_sitemap.php
// ----------------------------------------------------------------------------------
// Pagina met een sitemap
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 2.6.8
// @desc.   Functions naming convention
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme
///

//* Template Name: Sitemap  

//* Remove standard post content output
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

add_action( 'genesis_header', 'genesis_do_post_title', 12 );
add_action( 'genesis_entry_content', 'fn_od_wbvb_toon_sitemap', 15 );

genesis();
