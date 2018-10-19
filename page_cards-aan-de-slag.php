<?php

///
// Optimaal Digitaal - page_cards-aan-de-slag.php
// ----------------------------------------------------------------------------------
// Toont alle tips met een filter
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.1.2
// @desc.   Pagina-templates voor diverse functies toegevoegd.
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme
///

//* Template Name: Pagina met tips voor aan de slag

//remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'fn_od_wbvb_tips_archive_aan_de_slag' );

genesis();

//========================================================================================================


//========================================================================================================

