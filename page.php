<?php

///
// Optimaal Digitaal - page.php
// ----------------------------------------------------------------------------------
// Standaardpagina
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 2.5.13
// @desc.   In PHP-pagina's comments toegevoegd, code opgeschoond
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme
///


//* Template Name: Standaardpagina  

add_action( 'genesis_header', 'genesis_do_post_title', 12 );

remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

genesis();

