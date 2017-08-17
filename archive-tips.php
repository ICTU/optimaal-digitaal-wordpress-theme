<?php

///
// Optimaal Digitaal - archive-tips.php
// ----------------------------------------------------------------------------------
// Archive-pagina voor tips. Toont alle tips.
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 2.7.1
// @desc.   Taxonomy, archives reviewed. Sharing icons restyled, pagination updated.
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme
///

die('ARCHIVE TIPS');

if ( 22 == 33 ) {
  
  remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
  remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
  remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
  remove_action( 'genesis_loop', 'genesis_do_loop' );
  
  add_action( 'genesis_loop', 'op_do_show_cards_for_thema', 10 );
  
}
else {

  remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
  
  remove_action( 'genesis_loop', 'genesis_do_loop' );
  add_action( 'genesis_loop', 'fn_od_wbvb_tips_archive_cards_home_met_filter' );

}


genesis();
