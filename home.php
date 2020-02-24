<?php

///
// Optimaal Digitaal - home.php
// ----------------------------------------------------------------------------------
// De homepage
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 2.7.3
// @desc.   Code clean-up home.php, functions.php
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme
///
 
//* Template Name: Home  


remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'fn_od_wbvb_tips_archive_cards_home_met_filter' );



genesis();
