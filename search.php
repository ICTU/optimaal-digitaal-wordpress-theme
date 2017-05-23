<?php

///
// Optimaal Digitaal - search.php
// ----------------------------------------------------------------------------------
// toont zoekresultaten, if any
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 2.5.18
// @desc.   Search-resultaten aangepast
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme
///

function search_title() {
	$title = sprintf( '%s %s', apply_filters( 'genesis_search_title_text', __( 'Search Results for:', 'gebruikercentraal' ) ), get_search_query() );
	echo '<h1 class="entry-title" itemprop="headline">' .$title . '</h1>';
}

add_action( 'genesis_header', 'search_title', 12 );
genesis();

