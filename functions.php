<?php

///
// Optimaal Digitaal - functions.php
// ----------------------------------------------------------------------------------
// zonder functions geen functionaliteit.
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 2.10.4
// @desc.   CSS bug op single .goud pagina: .social-media knopjes.
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme
///


/**
 * Call Genesis's core functions.
 */
require_once( get_template_directory() . '/lib/init.php' );

$sharedfolder 	= get_template_directory();
$sharedfolder 	= preg_replace('|genesis|i','gebruiker-centraal',$sharedfolder);


define( 'GC_FOLDER', $sharedfolder );


$opt_folder 	= get_template_directory();
$opt_folder 	= preg_replace('|genesis|i','optimaal-digitaal',$opt_folder);

require_once( $opt_folder . '/includes/nojs.php' );
require_once( $opt_folder . '/includes/common-functions.php' );

// does our beloved visitor allow for JavaScript?
$genesis_js_no_js = new Genesis_Js_No_Js;
$genesis_js_no_js->run();/**
 * Define child theme constants.
 */



//========================================================================================================
// Theme constants

define( 'CHILD_THEME_NAME', 'Optimaal Digitaal' );
define( 'CHILD_THEME_URL', 'https://github.com/ICTU/optimaal-digitaal-wordpress-theme' );
define( 'CHILD_THEME_VERSION', '2.10.4' );
define( 'CHILD_THEME_DESCRIPTION', "2.10.4 CSS bug op single .goud pagina: .social-media knopjes." );

define( 'WP_THEME_DEBUG', false );
define( 'HALFWIDTH', 'halfwidth' );
define( 'OPSOMMINGWIDTH', 'opsommingwidth' );
define( 'fn_od_wbvb_footer_widget', 'footerwidget');
define( 'child_template_directory', dirname( get_bloginfo('stylesheet_url')) );


define( 'GC_TWITTERACCOUNT', 'GebrCentraal' );

//========================================================================================================
// Image sizes

add_image_size( HALFWIDTH, 380, 9999, false );
add_image_size( OPSOMMINGWIDTH, 245, 9999, false );

//========================================================================================================

//* Display author box on single posts
add_filter( 'get_the_author_genesis_author_box_single', '__return_false' );

//* Add the author box on archive pages
add_filter( 'get_the_author_genesis_author_box_archive', '__return_false' );


//========================================================================================================
// deactivate some site layout options
// Remove Genesis layouts
genesis_unregister_layout( 'content-sidebar' );

//* Unregister primary sidebar
unregister_sidebar( 'sidebar' );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

//* Remove the header right widget area
unregister_sidebar( 'header-right' );

//========================================================================================================
// add role attribute
//add_filter( 'genesis_attr_site-header', 'add_role_to_header' );

function add_role_to_header( $attributes ) {
	$attributes['role'] = 'banner';
	return $attributes;
}

//remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
//remove_action( 'genesis_header', 'genesis_do_header' );
//remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );




// ====
$filterthemas = array();


//========================================================================================================

remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

//========================================================================================================
// specific for this child theme

define( 'GC_TIPTHEMA', 'tipthema' );
define( 'GC_TIPVRAAG', 'tipvraag' );
define( 'GC_TIPORGANISATIE', 'tiporganisatie' );
define( 'GC_TIP_CPT', 'tips' );


//========================================================================================================

// Add support for Genesis layouts to force a different layout for tips
add_post_type_support( GC_TIP_CPT, 'genesis-layouts' );

// Force layout on custom post type 'tip'
add_filter( 'genesis_site_layout', 'allow_only_full_width_layout');

function allow_only_full_width_layout($opt) {

    $opt = 'full-width-content';

    return $opt;
}


//========================================================================================================
// custom taxonomies

add_action( 'init', 'fn_od_wbvb_register_custom_taxonomies' );
function fn_od_wbvb_register_custom_taxonomies() {

	$labels = array(
		"name" => "Tip-thema's",
		"label" => "Tip-thema's",
		"menu_name" => "Tip-thema's",
		"all_items" => "Alle tip-thema's",
		"edit_item" => "Bewerk thema",
		"view_item" => "Bekijk thema",
		"update_item" => "thema bijwerken",
		"add_new_item" => "thema toevoegen",
		"new_item_name" => "Nieuwe thema",
		"search_items" => "Zoek thema",
		"popular_items" => "Meest gebruikte thema's",
		"separate_items_with_commas" => "Scheid met komma's",
		"add_or_remove_items" => "thema toevoegen of verwijderen",
		"choose_from_most_used" => "Kies uit de meest gebruikte",
		"not_found" => "Niet gevonden",
		);

	$args = array(
		"labels" => $labels,
		"hierarchical" => true,
		"label" => "Tip-thema's",
		"show_ui" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => GC_TIPTHEMA, 'with_front' => true ),
		"show_admin_column" => false,
	);
	register_taxonomy( GC_TIPTHEMA, array( "tips" ), $args );


	$labels = array(
		"name" => "Jouw vraag",
		"label" => "Jouw vraag",
		"menu_name" => "Jouw vraag",
		"all_items" => "Alle vragen",
		"edit_item" => "Bewerk vraag",
		"view_item" => "Bekijk vraag",
		"update_item" => "vraag bijwerken",
		"add_new_item" => "vraag toevoegen",
		"new_item_name" => "Nieuwe vraag",
		"search_items" => "Zoek vraag",
		"popular_items" => "Meest gebruikte vragen",
		"separate_items_with_commas" => "Scheid met komma's",
		"add_or_remove_items" => "vraag toevoegen of verwijderen",
		"choose_from_most_used" => "Kies uit de meest gebruikte",
		"not_found" => "Niet gevonden",
		);

	$args = array(
		"labels" => $labels,
		"hierarchical" => true,
		"label" => "Jouw vraag",
		"show_ui" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => GC_TIPVRAAG, 'with_front' => true ),
		"show_admin_column" => false,
	);
	register_taxonomy( GC_TIPVRAAG, array( "tips" ), $args );


	$labels = array(
		"name" => "Jouw organisatie",
		"label" => "Jouw organisatie",
		"menu_name" => "Jouw organisatie",
		"all_items" => "Alle organisaties",
		"edit_item" => "Bewerk organisatie",
		"view_item" => "Bekijk organisatie",
		"update_item" => "organisatie bijwerken",
		"add_new_item" => "organisatie toevoegen",
		"new_item_name" => "Nieuwe organisatie",
		"search_items" => "Zoek organisatie",
		"popular_items" => "Meest gebruikte organisaties",
		"separate_items_with_commas" => "Scheid met komma's",
		"add_or_remove_items" => "organisatie toevoegen of verwijderen",
		"choose_from_most_used" => "Kies uit de meest gebruikte",
		"not_found" => "Niet gevonden",
		);

	$args = array(
		"labels" => $labels,
		"hierarchical" => true,
		"label" => "Jouw organisatie",
		"show_ui" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => GC_TIPORGANISATIE, 'with_front' => true ),
		"show_admin_column" => false,
	);
	register_taxonomy( GC_TIPORGANISATIE, array( "tips" ), $args );


// End fn_od_wbvb_register_custom_taxonomies
}


//========================================================================================================


add_filter( 'body_class', 'fn_od_wbvb_append_body_class' );

function fn_od_wbvb_append_body_class( $classes ) {
  
  global $post;
  global $errormessage;
  
  if ( taxonomy_exists( GC_TIPTHEMA ) && ( $post ) ) {
    $taxonomie   = get_the_terms( $post->ID, GC_TIPTHEMA );
    
    if ( $taxonomie && ! is_wp_error( $taxonomie ) ) {
      $counter = 0;
      // tip slug
      foreach ( $taxonomie as $term ) {
        $classes[] = strtolower( $term->slug );
        
        $counter++;
        
        if ( strval($counter) === '2' ) {
          $errormessage .= '<h1>Er is meer dan 1 ' . GC_TIPTHEMA . ' aan deze tip toegekend</h1>';
        }
        
        if ( function_exists( 'get_field' ) ) {
          $classes[] = strtolower( get_field('thema-kleur', GC_TIPTHEMA . '_' . $term->term_id ) );
          $classes[] = strtolower( get_field('thema-logo', GC_TIPTHEMA . '_' . $term->term_id ) );
        }
      }
    }	
  }
  
  return array_filter($classes);
}
//========================================================================================================

function cleanstring($strinput){
    $strinput = strtolower( $strinput );
	$strinput = strip_tags( $strinput );
	$strinput = preg_replace( '/&#?[a-z0-9]{2,8};/i', '',$strinput); // filter out &amp; etc
	$strinput = preg_replace( '/[^a-z0-9 -]+/', '', $strinput );
//    $z = str_replace(' ', '-', $z);
    return trim($strinput, '-');
}

//========================================================================================================


function fn_od_wbvb_write_tip_kaart($postobject, $plaatjes, $kleuren, $prefix = '', $suffix = '', $idprefix = '') {

  	global $tipcounter;

    $tipnummer      = ''; 
    $tiplabel      	= ''; 
    $themakleur		= ''; 
    $themaplaatje	= '';
    $filters		= ''; 
    $tiporganisatie	= ''; 
    $tipvraag		= ''; 
//    $temp_string 	= '';
    $tipcounter++;

    if ( function_exists( 'get_field' ) ) {
      $tipnummer      = get_field('tip-nummer'); 
      if ( $tipnummer ) {
        $tiplabel 		= __( "Tip", 'gebruikercentraal' ) . ' ' . $tipnummer;
      }
    }


    
    do_action( 'genesis_before_entry' );

	$args = array(
	    'orderby'           => 'name', 
	    'order'             => 'ASC',
	    'hide_empty'        => true, 
	    'exclude'           => array(), 
	    'exclude_tree'      => array(), 
	    'include'           => array(),
	    'number'            => '', 
	    'fields'            => 'all', 
	    'slug'              => '',
	    'parent'            => '',
	    'hierarchical'      => true, 
	    'child_of'          => 0,
	    'childless'         => false,
	    'get'               => '', 
	    'name__like'        => '',
	    'description__like' => '',
	    'pad_counts'        => false, 
	    'offset'            => '', 
	    'search'            => '', 
	    'cache_domain'      => 'core'
	);


	$title			      = get_the_title( );
	$keywords	   	    = $title;
	$keywords		     .= " " . get_the_excerpt();

	$card_unique_id     = preg_replace("/[^A-Za-z0-9 -]/", "", trim($title));
	$card_unique_id     = strtolower( $idprefix . $tipnummer . '-' . preg_replace("/[^A-Za-z0-9]/", "-", $card_unique_id));

	// tipvraag ===========================================================================
	$themas		= get_the_terms( $postobject->ID, GC_TIPTHEMA );
	$counter 		= 0;

	if ( ! empty( $themas ) && ! is_wp_error( $themas ) ){
		foreach ( $themas as $term ) {
			$counter++;
			if ( $counter > 1 ) {
				$filters 		.= " " . $term->slug;
			}
			else {
				$filters 		= $term->slug;
			}
			$keywords 		.= " " . $term->name;
		}
	}

	// tipvraag ===========================================================================
	$tipvragen		= get_the_terms( $postobject->ID, GC_TIPVRAAG );

	$counter 		= 0;

	if ( ! empty( $tipvragen ) && ! is_wp_error( $tipvragen ) ){
		$tipvraag = ' data-tipvraag="[';
		foreach ( $tipvragen as $term ) {
			$counter++;
			if ( $counter > 1 ) {
				$tipvraag .= ", ";
			}
			$tipvraag 		.= "'" . $term->name . "'";
			$filters 		  .= " " . $term->slug;
			$keywords 		.= " " . $term->name;
		}
		$tipvraag .= ']"';
	}

	$counter 		= 0;

	$tiporganisaties	= get_the_terms( $postobject->ID, GC_TIPORGANISATIE );

	if ( ! empty( $tiporganisaties ) && ! is_wp_error( $tiporganisaties ) ){
		$tiporganisatie = ' data-tiporganisatie="[';
		foreach ( $tiporganisaties as $term ) {
			$counter++;
			if ( $counter > 1 ) {
				$tiporganisatie .= ", ";
			}
			$tiporganisatie .= "'" . $term->name . "'";
			$filters 		.= " " . $term->slug;
			$keywords 		.= " " . $term->name;
		}
		$tiporganisatie .= ']"';
	}

	$pattern = '/containstip/';
	$prefix =  preg_replace($pattern, 'containstip ' . $filters, $prefix);

	$pattern = '/class=/';
	$prefix =  preg_replace($pattern, 'data-titel="' . cleanstring( $keywords ) . '" class=', $prefix);

    				
	
    $lelink         = $prefix . '<a id="' . $card_unique_id . '" href="' . get_permalink() . '"
    				class="tipkaart ' . $plaatjes . ' ' . $kleuren . '"
    				' . $tiporganisatie . '
    				' . $tipvraag . '
    				data-volgorde="' . $tipcounter . '"
    				data-tipnummer="' . $tipnummer . '"
    				data-thema="' . $plaatjes . '">
    				<div class="inner">';

    echo $lelink;

    if ( $tiplabel ) {
	    echo '<span class="tipnummer">' . $tiplabel . '</span>';
    }
//    echo '<p>tipcounter: ' . $tipcounter . '</p>';
    
	echo '<h3 itemprop="headline">';
	echo od_wbvb_custom_post_title( $title ) ;
	echo '</h3>';

    echo '<div class="contentinfo">';

	$themas   		= get_the_terms( $postobject->ID, GC_TIPTHEMA );
	if ( $themas ) {					
		foreach ( $themas as $term ) {
	       echo '<span>' . $term->name . '</span>';
		}
	}

    echo '</div></div></a>' . $suffix;	
	
	return $card_unique_id;
	
}



//========================================================================================================


function fn_od_wbvb_get_filterbutton($term) {

	global $filterthemas;
	global $dofilter;

	$returnstring = '';	

	// zijn er tips voor deze tax. term?
	$posts_array = get_posts(
    array(
      'posts_per_page'  => -1,
      'post_type' 	    => GC_TIP_CPT,
      'post_password'   =>	'',
      'tax_query'       => array(
        array(
          'taxonomy'  => $term->taxonomy,
          'field'     => 'term_id',
          'terms'     => $term->term_id,
        )
      )
    )
	);
	
	if ( count( $posts_array ) ) {
		// ja, er zijn tips
			
		$disabled = ' disabled';
		if ( $term->count > 0 ) {
			$disabled = '';
		}
		$name_btn   = 'checkbox_' . $term->slug;
		$name_txt   = 'txt_' . $term->slug;
		$value_btn	= 'true';
		$value_txt	= 'false';
		$class      = $term->slug;
		$checked    =	'';
		
		
		if ( ( isset( $_POST[$name_btn] ) ) || ( isset( $_GET[$name_btn] ) ) ) {

			// checkbox is gebruikt
			$submitvalue = fn_od_wbvb_filter_input_string( ( isset( $_POST[$name_btn] ) ) ? $_POST[$name_btn] : ( isset( $_GET[$name_btn] ) ) ? $_GET[$name_btn] : '' );

			if ( $submitvalue == "." . $term->slug ) {
				$value_btn		=	'false';
				$value_txt		=	'true';
				$class        =	'active';
				$checked      =	' checked="checked"';
			}
			else {
				$value_btn		=	'true';
				$value_txt		=	'false';
				$class        =	'inactive';
			}
		}
		else {

			// checkbox is niet gebruikt
			if ( ( isset( $_POST[$name_txt] ) ) || ( isset( $_GET[$name_txt] ) ) ) {
				$submitvalue2 = fn_od_wbvb_filter_input_string( ( isset( $_POST[$name_txt] ) ) ? $_POST[$name_txt] : ( isset( $_GET[$name_txt] ) ) ? $_GET[$name_txt] : '');
				if ( ( $submitvalue2 == $value_txt ) && ( $submitvalue == $value_btn ) ) {
					// geen verandering
				}
				else {
					$class        =	'inactive';
					if ( $submitvalue2 == "." . $term->slug )  {
						$class      =	'active';
						$value_btn  =	'false';
						$value_txt  =	'true';
					}
					else {
						$class 			=	'inactive';
						$value_btn	=	'true';
						$value_txt	=	'false';
					}
				}
			}
		}

		if ( ( isset( $_GET['filter'] ) ) ) {

			// button is gebruikt
			$submitvalue = fn_od_wbvb_filter_input_string( ( isset( $_POST[$name_btn] ) ) ? $_POST[$name_btn] : ( isset( $_GET[$name_btn] ) ) ? $_GET[$name_btn] : '' );

			if ( $submitvalue == "." . $term->slug ) {
				$filterthemas[$term->slug] = $term;
        $dofilter = true;
			}
		}	
		else {
			if ($term->taxonomy == GC_TIPTHEMA ) {
				$filterthemas[$term->slug] = $term;
			}
		}
	
	
		$id = "filter-" . $term->slug;
		$value_checkbox = "." . $term->slug;

		$returnstring .= '<label for="' . $id . '" class="checkbox ' . $term->slug . ' ' . $class .'"><input type="checkbox" id="' . $id . '"' . $disabled . '' . $checked . ' value="' . $value_checkbox . '" name="' . $name_btn . '">' . $term->name . '</label>';

		return $returnstring;	
		
	}
}


//========================================================================================================

function fn_od_wbvb_tips_archive_cards_home_met_filter($theCPT = '') {

  global $dofilter;

  $dofilter = false;

	//** Use old loop hook structure if < HTML5
	if ( ! genesis_html5() ) {
		genesis_legacy_loop();
		return;
	}

	global $loop_counter;

	$loop_counter = 0;
	
	$homepage	= ( get_field('tekst_op_homepage', 'option') ) ? get_field('tekst_op_homepage', 'option') : _x('Tips met praktijkvoorbeelden om de digitale weg naar de overheid te stimuleren onder burgers en bedrijven. Samengesteld op basis van onderzoek en gedragspyschologie.', 'Tekst op homepage', 'gebruikercentraal');

	echo '<article class="entry" itemscope="" itemtype="http://schema.org/CreativeWork">';
	echo $homepage;
	echo '</article>';


  $classes				= array();
		
	$terms = get_terms( GC_TIPTHEMA );

	foreach($terms as $term) {
		// settings per thema ophalen

		$classes[$term->slug] = array();
		$classes[$term->slug]['name']	= $term->name;

    if ( function_exists( 'get_field' ) ) {

			$themakleur			= get_field('thema-kleur', GC_TIPTHEMA . '_' . $term->term_id ); 
			$themaplaatje		= get_field('thema-logo', GC_TIPTHEMA . '_' . $term->term_id ); 

			$classes[$term->slug]['kleur']	  = $themakleur;
			$classes[$term->slug]['plaatje']	= $themaplaatje;

		}
		else {
//  		echo 'ACF is stuk';
		}

    $classes =  array_filter($classes);
	}


	echo '<div class="cardscontainer">';



	echo '<div class="tab-widget js-tab-widget">

		<span id="tab-widget-description" class="visuallyhidden">Gebruik de linker- en rechterpijltjestoetsen om tussen de tabs te navigeren</span>

		<ul class="tab-widget__list" id="tabs_list">
			<li class="tab-widget__item">
				<a href="#tab-panel-1" class="tab-widget__link">' . __( "Alle tips", 'gebruikercentraal' ) . '</a>
			</li>
			<li class="tab-widget__item">
				<a href="#tab-panel-2" class="tab-widget__link">' . __( "Aan de slag", 'gebruikercentraal' ) . '</a>
			</li>
		</ul>

  <div class="tab-widget__tabs">';



	// ============================================================================================================================================
	// start Alle tips
	// ============================================================================================================================================
	echo '<div class="tab-widget__tab-content tab-widget__link--not-yet-activated" id="tab-panel-2" tabindex="-1">';
	echo '<h2 id="tab-panel-2-h2" tabindex="-1"><span>' . __( "Alle tips", 'gebruikercentraal' ) . '</span></h2>';

	$theurl	=	strtok($_SERVER["REQUEST_URI"],'?');	

	echo '<form method="get" action="' . $theurl . '" id="filter_tips" class="filter-options">';

	global $filterthemas;

  // ====================================================================================================

	$theHTML = '';

  $terms = get_terms( GC_TIPTHEMA );
  
  if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
    
    foreach ( $terms as $term ) {
      $return = fn_od_wbvb_get_filterbutton($term);
      if ( $return ) {
        $theHTML .= $return;
      }
    }
    
    if ( $theHTML ) {
      echo '<fieldset class="filter-group checkboxes themas">';
      echo "<legend>" . __( "Thema's:", 'gebruikercentraal' ) . "</legend>";
      echo $theHTML;
      echo '</fieldset>';
    }
    
  }
	

	echo '<button id="toggle_more_filters" type="button" class="meer">' . __( "Meer filters", 'gebruikercentraal' ) . '</button>';

  // ====================================================================================================

	echo '<div id="more_filters">';
	
	$args = array( 'hide_empty' => false );


	$theHTML = '';
	
	$terms = get_terms( GC_TIPVRAAG, $args );
	
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
    	
	    foreach ( $terms as $term ) {
		    $theHTML .= fn_od_wbvb_get_filterbutton($term);
	    }

		if ( $theHTML ) {
			echo '<fieldset class="filter-group checkboxes ' . GC_TIPVRAAG . '">';
			echo "<legend>" . __( "Jouw vraag:", 'gebruikercentraal' ) . "</legend>";
			echo $theHTML;
			echo '</fieldset>';
		}
	}
	
  // ====================================================================================================
	$theHTML = '';
	
	$terms = get_terms( GC_TIPORGANISATIE, $args );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
	    foreach ( $terms as $term ) {
		    $theHTML .= fn_od_wbvb_get_filterbutton($term);
	    }
		if ( $theHTML ) {
			echo '<fieldset class="filter-group checkboxes ' . GC_TIPORGANISATIE . '">';
			echo "<legend>" . __( "Jouw organisatie:", 'gebruikercentraal' ) . "</legend>";
			echo $theHTML;
			echo '</fieldset>';
		}
		
	}

	$filterkeyword    = fn_od_wbvb_filter_input_string( ( isset( $_POST['filtertrefwoord'] ) ) ? $_POST['filtertrefwoord'] : ( isset( $_GET['filtertrefwoord'] ) ) ? $_GET['filtertrefwoord'] : '' );

  if ( $filterkeyword !== '' ) {
    $dofilter = true;
    echo 'keyword is niet leeg<br>';
  }


  // ====================================================================================================
	echo '<fieldset class="filter-group search search-form">
	      <label class="search-form-label screen-reader-text" for="filtertrefwoord">Filter op trefwoord</label>
	      <div id="filter_group_search_form_bg">
  	      <input type="search" id="filtertrefwoord" name="filtertrefwoord" placeholder="Filter op trefwoord" value="' . $filterkeyword . '">
	      </div>
	      </fieldset>';

  // ====================================================================================================

	echo '</div>'; // '<div id="more_filters">';

	echo '<button id="filter" name="filter" value="filter" type="submit">' . __( "Alle tips", 'gebruikercentraal' ) . '</button>';
	if ( $dofilter ) {
  	echo '<a href="?selectie=leeg">' .  __( "Selectie wissen", 'gebruikercentraal' ) . '</a>';
	}
	echo '</form>';

	$failmessage      = ( get_field('filtering_foutboodschap', 'option') ) ? get_field('filtering_foutboodschap', 'option') : _x('Er zijn geen tips met deze selectie.', 'Foutboodschap filtering', 'gebruikercentraal');
	$fail_label       = ( get_field('filtering_foutboodschap_knop', 'option') ) ? get_field('filtering_foutboodschap_knop', 'option') : _x('Toon alles', 'Foutboodschap filtering', 'gebruikercentraal');
	$select_message   = ( get_field('filtering_selectie_boodschap', 'option') ) ? get_field('filtering_selectie_boodschap', 'option') : _x('Aantal gevonden tips:', 'Foutboodschap filtering', 'gebruikercentraal');
	$wis_label	      = ( get_field('filtering_wissen_knop', 'option') ) ? get_field('filtering_wissen_knop', 'option') : _x('Wis selectie', 'Label op knop bij filtering', 'gebruikercentraal');

	echo '<section class="cardflex" id="cardflex_tab1">';


	  // er moet serverside gefilterd worden
		$args=array(
			'post_type' 		  =>	GC_TIP_CPT,
			'post_status' 		=>	'publish',
			'posts_per_page' 	=>	-1,
			'post_password'		=>	''
		);
		
		$my_query = null;
		$my_query = new WP_Query($args);

    echo '<!-- het geheime woord is: supercalifragilisticexpialidocious -->';

    $searchprefix = " supercalifragilisticexpialidocious ";

    // ik heb die prefix nodig om zeker te weten dat de string gevonden kan worden.
    // waarom dan niet er een geintje mee uithalen?
    if ( trim(fn_od_wbvb_make_safe_url($filterkeyword)) === trim(fn_od_wbvb_make_safe_url($searchprefix)) ) {
      echo '<h3><a href="https://www.youtube.com/watch?v=tRFHXMQP-QU">Gezellig!</a></h3>';
      echo '<a href="https://www.youtube.com/watch?v=tRFHXMQP-QU"><img src="' . child_template_directory . '/images/' . trim(fn_od_wbvb_make_safe_url($filterkeyword)) . '.jpg" alt="' . trim(fn_od_wbvb_make_safe_url($filterkeyword)) . '" ></a>';
      echo '<p>We tonen je alle kaarten. Zing je mee?</p>';
    }
	
    if( $my_query->have_posts() ) {

      
      echo '<div class="select-message"><p class="filtercounter">' . $select_message . '</p><button type="button" class="reset">' . $wis_label . '</button></div>';
      
      global $tipcounter;
      
      $tipcounter = 0;

      while ( $my_query->have_posts() ) {

        $my_query->the_post(); 
        
        $term_list = get_the_terms( $my_query->ID, GC_TIPTHEMA );
        
        $theslug = $term_list[0]->slug;
        
        // als er een zoekterm is gezet gaan we hier checken of die gevonden wordt.
        if ( $filterkeyword ) {
          // er is een zoekterm
          $filterkeyword  = fn_od_wbvb_make_safe_url($filterkeyword);
          $searchstring   = $searchprefix . fn_od_wbvb_make_safe_url( strtolower( $theslug . ' ' . $term_list[0]->name . ' ' . get_the_title() . ' ' . get_the_excerpt() ) );


          if ( strpos( $searchstring, $filterkeyword ) ) {
            // de zoekterm is gevonden
          }
          else {
            // er is dus een zoekterm, maar die is niet gevonden
            // next!
            continue;
          }
        }
        
        $loop_counter++;
        
        if ( count($filterthemas) > 0 ) {

          
          if ( $dofilter ) {
            // er moet sowieso gefilterd worden op thema's
            
            if ( isset($filterthemas[$theslug]) ) {

              $kleuren	= $classes[$term_list[0]->slug]['kleur'];
              $plaatjes	= $classes[$term_list[0]->slug]['plaatje'];
              fn_od_wbvb_write_tip_kaart($my_query, $plaatjes, $kleuren, '<div aria-hidden="true" class="containstip">', '</div>', 'tipcard-');
            }
          }
          else {

            $kleuren	= $classes[$term_list[0]->slug]['kleur'];
            $plaatjes	= $classes[$term_list[0]->slug]['plaatje'];
            
            fn_od_wbvb_write_tip_kaart($my_query, $plaatjes, $kleuren, '<div aria-hidden="true" class="containstip">', '</div>', 'tipcard-');
          }          
        }
        else {

          $kleuren	= $classes[$term_list[0]->slug]['kleur'];
          $plaatjes	= $classes[$term_list[0]->slug]['plaatje'];

          fn_od_wbvb_write_tip_kaart($my_query, $plaatjes, $kleuren, '<div aria-hidden="true" class="containstip">', '</div>', 'tipcard-');

        }
      }
    }

    if ( $dofilter && $tipcounter < 1 ) {
      echo '<p>' . $failmessage . '</p>';
    }


  	echo '</section>'; // '<section class="cardflex">';
  	echo '</div>'; // <!-- //tab-widget__tab-content tab-widget__link--not-yet-activated -->';

	// ============================================================================================================================================
	// einde Alle tips
	// ============================================================================================================================================







	// ============================================================================================================================================
	// start Aan de slag
	// ============================================================================================================================================
	echo '<div class="tab-widget__tab-content tab-widget__link--not-yet-activated" tabindex="-1">';
	echo '<p id="tab-panel-1" tabindex="-1"><span>' . __( "Aan de slag", 'gebruikercentraal' ) . '</span></p>';

	global $tipcounter;
	$tipcounter       = 0;
	$carousselcounter = 0;

	$terms = get_terms( GC_TIPVRAAG ); // niet meer tips tonen voor alle thema's (GC_TIPTHEMA) maar tips per vraag

	foreach($terms as $term) {

		// door alle thema's heenlopen
		// per thema's de tips ophalen

		$inlinelinks			= '';
		$kleuren	        = array();
		$plaatjes         = array();
    if ( isset( $classes[$term->slug] ) ) {
    	$kleuren	      = $classes[$term->slug]['kleur'];
    	$plaatjes	      = $classes[$term->slug]['plaatje'];
    }
    
    $args = array(
      'post_type' 		  => GC_TIP_CPT,
      'post_password'		=>	'',
      'tax_query' 	    => array(
        array(
          'taxonomy'    => GC_TIPVRAAG,
          'field' 	    => 'slug',
          'terms' 	    => $term->slug
        )
      ),
      'numberposts'	    => -1,
			'posts_per_page' 	=>	-1,
    );

    
 
    
		// The Query
		$the_query = new WP_Query( $args );
		
		// The Loop
		if ( $the_query->have_posts() ) {

      $carousselcounter++;

			echo '<section class="cardgallery ' . implode( $kleuren ) . '">';
			echo "<h2>" . $term->name . "</h2>";

			if ( $term->description ) {
				echo "<p>" . $term->description . "</p>";
			}

			echo '<div class="carousel" id="carousel-'  . $carousselcounter . '">';

			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				
      	$themadataforcard	= get_the_terms( $the_query->ID, GC_TIPTHEMA );

    		$kleuren	= '';
    		$plaatjes	= '';

        if ( ! empty( $themadataforcard ) && ! is_wp_error( $themadataforcard ) ){

          $term     = $themadataforcard[0];
          $kleuren	= $classes[$term->slug]['kleur'];
          $plaatjes	= $classes[$term->slug]['plaatje'];
          
        }
				
				$title		      = get_the_title( );
				$theID          = fn_od_wbvb_write_tip_kaart($the_query, $plaatjes, $kleuren, '<div class="containstip carousel-cell">', '</div>', 'caroussel-');
				$inlinelinks	.= '<li><a href="#' . $theID . '" title="Spring naar \'' . $title . '\'"><span>' . $title . '</span></a></li>';		

			}

			echo '</div>'; 
			echo '</section>';

		}
		else {
			// no posts found
		}
		/* Restore original Post Data */
		wp_reset_postdata();		
	}
	
	echo '</div>'; // <!-- //tab-widget__tab-content tab-widget__link--not-yet-activated -->
	// ============================================================================================================================================
	// einde Aan de slag
	// ============================================================================================================================================








	
	echo '</div>'; // <!-- //tab-widget__tabs -->
	echo '</div>'; // <!-- //tab-widget js-tab-widge -->
	echo '</div>'; // <!-- //.cardscontainer -->


	wp_reset_query();

}


//========================================================================================================

function fn_od_wbvb_tips_archive_cards_loop() {

	global $posts;

	//** Use old loop hook structure if < HTML5
	if ( ! genesis_html5() ) {
		genesis_legacy_loop();
		return;
	}

	global $loop_counter;


	$loop_counter = 0;
		
	if ( have_posts() ) {
		
		while ( have_posts() ) {
			the_post(); 
	
		    $tipnummer      = ''; 
		    $themakleur		= ''; 
		    $themaplaatje	= ''; 
		    $classes		= array();
		
		    $taxonomie   	= get_the_terms( $post->ID, GC_TIPTHEMA );
		
        if ( $taxonomie && ! is_wp_error( $taxonomie ) ) {
          foreach ( $taxonomie as $term ) {
            
            $classes[$term->term_id] = array();
            $classes[$term->term_id]['name']	= $term->name;
            
            if ( function_exists( 'get_field' ) ) {
              $themakleur			= get_field('thema-kleur', GC_TIPTHEMA . '_' . $term->term_id ); 
              $themaplaatje		= get_field('thema-logo', GC_TIPTHEMA . '_' . $term->term_id ); 
              
              $classes[$term->term_id]['kleur']	= $themakleur;
              $classes[$term->term_id]['plaatje']	= $themaplaatje;
            }
          }
        }	
		
		
        if ( function_exists( 'get_field' ) ) {
          $tipnummer      = get_field('tip-nummer'); 
          if ( $tipnummer ) {
            $tipnummer 		= __( "Tip", 'gebruikercentraal' ) . ' ' . $tipnummer;
          }
        }
		    
		    do_action( 'genesis_before_entry' );
		
			$args = array(
			    'orderby'           => 'name', 
			    'order'             => 'ASC',
			    'hide_empty'        => true, 
			    'exclude'           => array(), 
			    'exclude_tree'      => array(), 
			    'include'           => array(),
			    'number'            => '', 
			    'fields'            => 'all', 
			    'slug'              => '',
			    'parent'            => '',
			    'hierarchical'      => true, 
			    'child_of'          => 0,
			    'childless'         => false,
			    'get'               => '', 
			    'name__like'        => '',
			    'description__like' => '',
			    'pad_counts'        => false, 
			    'offset'            => '', 
			    'search'            => '', 
			    'cache_domain'      => 'core'
			);
		
		
		    $lelink         = '<a href="' . get_permalink() . '" class="blocklink">';
		
		
		    $kleuren	= '';
		    $plaatjes	= '';
		
		    if ($classes) {
				foreach ($classes as $key => $value) {
			        $plaatjes	.= ' ' . $value['plaatje'];
			        $kleuren	.= ' ' . $value['kleur'];
			     }		    
		    }
		    
		    echo '<section class="tipkaart' . $kleuren . $plaatjes . '">';
		
		
		    echo $lelink;
		    echo '<span class="tipnummer">' . $tipnummer . '</span>';
		    
		    
			echo '<h2 class="entry-title" itemprop="headline">';
			echo od_wbvb_custom_post_title( get_the_title() ) ;
			echo '</h2>';
		
		    if ($classes) {
			    echo '<div class="contentinfo">';
				foreach ($classes as $key => $value) {
			       echo '<span>' . $value['name'] . '</span>';
			     }		    
			    echo '</div>';
		    }
		    else {
		        echo '<p>' . __( "Deze tip is niet gekoppeld aan een thema", 'gebruikercentraal' ) . '</p>';
		    }
		
		//        echo '</div>';
		    echo '</a></section>';
			

		};
	}


	

	
	wp_reset_query();
}

//========================================================================================================
// columns for tip taxonomy

add_filter("manage_edit-tips_columns", 'admin_tip_columns'); 

function admin_tip_columns($theme_columns) {
    $new_columns = array(
        'cb'				=> '<input type="checkbox" />',
        'title'				=> __('Titel', 'gebruikercentraal' ),
        'tipnummer'			=> __('Tipnummer', 'gebruikercentraal' ),
        'tipthema'			=> __('Tip-thema', 'gebruikercentraal' ),
        'tiporganisatie'	=> __('Jouw organisatie', 'gebruikercentraal' ),
        'tipvraag'			=> __('Jouw vraag', 'gebruikercentraal' ),
    );
    return $new_columns;
}

//========================================================================================================

// Add to admin_init function   
//add_filter("manage_tips_custom_column", 'admin_manage_theme_columns_tips', 10, 3);
 
//function admin_manage_theme_columns_tips($out, $column_name, $theme_id) {

add_action('manage_posts_custom_column',  'admin_manage_theme_columns_tips');

function admin_manage_theme_columns_tips($name) {


    global $post;
    global $column;

    $acfid      = $post->ID;
    
	switch ( $name ){
		case ('tipnummer'): 

            $tipnummer  = get_field('tip-nummer', $acfid);

            if ($tipnummer) {
                echo 'Tip ' . $tipnummer . '<br />';
            }
            else {
                echo '<strong class="error">Geen tipnummer ingevoerd</strong><br />';
            }

			break;

		case ('tipthema'): 
            $thehoofdkoplijst = get_the_term_list( $acfid, GC_TIPTHEMA, '', ', ', '' );
	    	if ( $thehoofdkoplijst && ! is_wp_error( $thehoofdkoplijst ) ) {
                echo $thehoofdkoplijst;
            }
            else {
                echo '<strong>Niet gekoppeld aan een thema</strong>';
            }


		    break;
            
		case ('tiporganisatie'): 

            $thehoofdkoplijst = get_the_term_list( $acfid, GC_TIPORGANISATIE, '', ', ', '' );
	    	if ( $thehoofdkoplijst && ! is_wp_error( $thehoofdkoplijst ) ) {
                echo $thehoofdkoplijst;
            }
            else {
                echo '-';
            }


		    break;
            
		case ('tipvraag'): 

            $thehoofdkoplijst = get_the_term_list( $acfid, GC_TIPVRAAG, '', ', ', '' );
	    	if ( $thehoofdkoplijst && ! is_wp_error( $thehoofdkoplijst ) ) {
                echo $thehoofdkoplijst;
            }
            else {
                echo '-';
            }


		    break;
            

		default:
//			echo "Ja else: " . $column_name;
			break;
	}
	if ("ID" == $column) echo $post->ID;
	elseif ("title" == $column) echo "title : " . $post->post_content;

    
}


//========================================================================================================
// custom fields

if( function_exists('acf_add_local_field_group') ):


	acf_add_local_field_group(array (
		'key' => 'group_5654241bc6feb',
		'title' => 'Extra content: layout-instellingen voor de inleiding, goede voorbeelden, waarom werkt dit',
		'fields' => array (
			array (
				'key' => 'field_569d645a172a7',
				'label' => 'Soort inleiding',
				'name' => 'soort_inleiding',
				'type' => 'radio',
				'instructions' => 'Wil je een inleiding met een grote foto of een aantal opsommingen onder elkaar?',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'geenfoto' => 'Geen foto',
					'grotefoto' => 'Grote foto naast de tekst',
					'opsommingen' => 'Lijstje met opsommingen en kleine foto\'s',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'grotefoto',
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_569d6543eca6a',
				'label' => 'Grote foto',
				'name' => 'grote_foto',
				'type' => 'image',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_569d645a172a7',
							'operator' => '==',
							'value' => 'grotefoto',
						),
					),
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array (
				'key' => 'field_569d656e0caea',
				'label' => 'Lijstjes met kleine foto',
				'name' => 'lijstjes_met_kleine_foto',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_569d645a172a7',
							'operator' => '==',
							'value' => 'opsommingen',
						),
					),
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => '',
				'max' => '',
				'layout' => 'table',
				'button_label' => 'Nieuwe regel',
				'sub_fields' => array (
					array (
						'key' => 'field_569d660c2835f',
						'label' => 'Bijbehorende foto',
						'name' => 'bijbehorende_foto',
						'type' => 'image',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '10',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
						'preview_size' => 'thumbnail',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
					array (
						'key' => 'field_569d65dc2835d',
						'label' => 'Titel',
						'name' => 'titel',
						'type' => 'text',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '20',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'readonly' => 0,
						'disabled' => 0,
					),
					array (
						'key' => 'field_569d65f22835e',
						'label' => 'Lijstje',
						'name' => 'lijstje',
						'type' => 'wysiwyg',
						'instructions' => 'Voer alsjeblieft alleen lijstjes in.',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => 70,
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 1,
					),
				),
			),
			array (
				'key' => 'field_565426c3a737d',
				'label' => 'Goed voorbeeld',
				'name' => 'goed_voorbeeld',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => 'field_565427cd84d56',
				'min' => '',
				'max' => '',
				'layout' => 'row',
				'button_label' => 'Voeg voorbeeld toe',
				'sub_fields' => array (
					array (
						'key' => 'field_565427cd84d56',
						'label' => 'Titel',
						'name' => 'titel_goed_voorbeeld',
						'type' => 'text',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => 100,
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'readonly' => 0,
						'disabled' => 0,
					),
					array (
						'key' => 'field_565427f384d57',
						'label' => 'Tekst',
						'name' => 'tekst_goed_voorbeeld',
						'type' => 'wysiwyg',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => 100,
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'new_lines' => 'wpautop',
						'readonly' => 0,
						'disabled' => 0,
					),
					array (
						'key' => 'field_5654280584d58',
						'label' => 'Naam van de tipgever',
						'name' => 'voorbeeld-auteur-naam',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => 100,
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
					),
					array (
						'key' => 'field_5654281b84d59',
						'label' => 'Functie van de tipgever',
						'name' => 'voorbeeld-auteur-functie',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => 100,
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'readonly' => 0,
						'disabled' => 0,
					),
					array (
						'key' => 'field_56542a066f951',
						'label' => 'Afbeelding',
						'name' => 'afbeelding_goed_voorbeeld',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
						'preview_size' => 'thumbnail',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
				),
			),

			array (
				'key' => 'field_565429a092d58',
				'label' => 'Waarom werkt dit?',
				'name' => 'waarom_werkt_dit_goed_voorbeeld',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => 'wpautop',
				'readonly' => 0,
				'disabled' => 0,
			),

		array (
			'key' => 'field_569d55285990f',
			'label' => 'Onderzoek: inleiding',
			'name' => 'inleiding-onderzoek',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => 'wpautop',
			'readonly' => 0,
			'disabled' => 0,
		),

		array (
			'key' => 'field_569d55fd856cc',
			'label' => 'Vraag 1 - titel',
			'name' => 'inleiding-vraag_1_titel',
			'type' => 'text',
			'instructions' => 'Maximaal 40 karakters. 
Voorbeeld: "Kan het 100% digitaal?"',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_569d5639deb33',
			'label' => 'Vraag 1 - cijfer',
			'name' => 'inleiding-vraag_1_-_cijfer',
			'type' => 'text',
			'instructions' => 'Hier een percentage of een cijfer.
Voorbeelden: 
85%
> 8,0',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_569d568e1d383',
			'label' => 'Vraag 1 - antwoord',
			'name' => 'inleiding-vraag_1_-_antwoord',
			'type' => 'text',
			'instructions' => 'Voorbeeld:
"Geeft voldoende aan niet-digitale route"
"55% geeft een 8 of hoger"',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_569d5701b75ae',
			'label' => 'Vraag 2 - titel',
			'name' => 'inleiding-vraag_2_titel',
			'type' => 'text',
			'instructions' => 'Maximaal 40 karakters. 
Voorbeeld: "Kan het 100% digitaal?"',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_569d57269e612',
			'label' => 'Vraag 2 - cijfer',
			'name' => 'inleiding-vraag_2_-_cijfer',
			'type' => 'text',
			'instructions' => 'Hier een percentage of een cijfer.
Voorbeelden: 
85%
> 8,0',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_569d57c2d61d4',
			'label' => 'Vraag 2 - antwoord',
			'name' => 'inleiding-vraag_2_-_antwoord',
			'type' => 'text',
			'instructions' => 'Voorbeeld:
"Geeft voldoende aan niet-digitale route"
"55% geeft een 8 of hoger"',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_569d571139792',
			'label' => 'Vraag 3 - titel',
			'name' => 'inleiding-vraag_3_titel',
			'type' => 'text',
			'instructions' => 'Maximaal 40 karakters. 
Voorbeeld: "Kan het 100% digitaal?"',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_569d5735e0391',
			'label' => 'Vraag 3 - cijfer',
			'name' => 'inleiding-vraag_3_-_cijfer',
			'type' => 'text',
			'instructions' => 'Hier een percentage of een cijfer.
Voorbeelden: 
85%
> 8,0',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_569d57c1d61d3',
			'label' => 'Vraag 3 - antwoord',
			'name' => 'inleiding-vraag_3_-_antwoord',
			'type' => 'text',
			'instructions' => 'Voorbeeld:
"Geeft voldoende aan niet-digitale route"
"55% geeft een 8 of hoger"',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_569d55b0f0869',
			'label' => 'Onderzoek: conclusie',
			'name' => 'inleiding-conclusie',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => 'wpautop',
			'readonly' => 0,
			'disabled' => 0,
		),			

		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => GC_TIP_CPT,
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array (
			0 => 'custom_fields',
			1 => 'discussion',
			2 => 'comments',
			3 => 'slug',
			4 => 'send-trackbacks',
		),
		'active' => 1,
		'description' => '',
	));

endif;

//========================================================================================================
// custom post types


add_action( 'init', 'fn_od_wbvb_register_tip_cpt' );
function fn_od_wbvb_register_tip_cpt() {
	$labels = array(
		"name" => "Tips",
		"singular_name" => "Tip",
		"menu_name" => "Tips",
		"all_items" => "Alle tips",
		"add_new" => "Toevoegen",
		"add_new_item" => "Tip toevoegen",
		"edit" => "Tip bewerken",
		"edit_item" => "Bewerk tip",
		"new_item" => "Nieuwe tip",
		"view" => "Bekijk",
		"view_item" => "Bekijk tip",
		"search_items" => "Tips zoeken",
		"not_found" => "Geen tips gevonden",
		"not_found_in_trash" => "Geen tips in de prullenbak",
		);

	$args = array(
		"labels" => $labels,
		"description" => "Hier voer je de tips in.",
		"public" => true,
		"show_ui" => true,
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "page",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "optimaaldigitaal", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 5,		
		"supports" => array( "title", "editor", "excerpt", "revisions", "thumbnail", "author" ),		
	);
	register_post_type( GC_TIP_CPT	, $args );



// End of fn_od_wbvb_register_tip_cpt()
}

//========================================================================================================
// requrired field for Tip-nummer

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array (
		'key' => 'group_5654e441524ac',
		'title' => 'Tip-nummer',
		'fields' => array (
			array (
				'key' => 'field_5654e448b40c2',
				'label' => 'Tip-nummer',
				'name' => 'tip-nummer',
				'type' => 'number',
				'instructions' => 'Voer het tip-nummer in. Geen letters, alleen cijfers',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => GC_TIP_CPT,
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

endif;


//========================================================================================================

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_56656a2421879',
	'title' => 'Layout van titel-thema\'s',
	'fields' => array (
		array (
			'key' => 'field_56656a8b627fc',
			'label' => 'Thema-logo',
			'name' => 'thema-logo',
			'type' => 'radio',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'icon-deelenwerksamen'      => 'Deel en werk samen',
				'icon-digitaaloporde'       => 'Digitaal op orde',
				'icon-goedproces' 		      => 'Goed proces',
				'icon-interndraagvlak'      => 'Intern draagvlak',
				'icon-kanaalsturing'        => 'Kanaalsturing',
				'icon-informatieveiligheid' => 'Informatieveiligheid',
				'icon-gloeilamp'            => 'Gloeilamp',
			),
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'muis',
			'layout' => 'vertical',
		),
		array (
			'key' => 'field_56656a2e627fb',
			'label' => 'Thema-kleur',
			'name' => 'thema-kleur',
			'type' => 'radio',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'oranje'    => 'Oranje',
				'groen'     => 'Groen',
				'paars'     => 'Paars',
				'blauw'     => 'Blauw',
				'turquoise' => 'Turquoise',
				'bruin'     => 'Rood',
				'goud'      => 'Goud',
			),
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'oranje',
			'layout' => 'vertical',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'tipthema',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

//nuttige links

acf_add_local_field_group(array (
	'key' => 'group_569f5ed3033ec_XXXXX',
	'title' => 'Tips: nuttige links',
'fields' => array (
		array (
			'key' => 'field_569f616abab78',
			'label' => 'Nuttige links',
			'name' => 'nuttige_links',
			'type' => 'repeater',
			'instructions' => '<img src="/wp-content/themes/optimaal-digitaal/images/linkbeschrijving-illustratie.png" alt="waar komen de velden terecht?" width="600" height="126" /><br />De URL is verplicht; de andere velden niet. Maar als er geen beschrijving, CTA of titel wordt ingevoerd, wordt er "<em>' .  __( "Geen linkbeschrijving ingevoerd", 'gebruikercentraal' ) . '</em>" getoond.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => '',
			'max' => '',
			'layout' => 'table',
			'button_label' => 'Nieuwe regel',
			'sub_fields' => array (
				array (
					'key' => 'field_569f619e3c9cb',
					'label' => 'URL',
					'name' => 'url',
					'type' => 'url',
					'instructions' => 'Dit is de link waarnaar wordt verwezen',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
				array (
					'key' => 'field_56a9f294de11f',
					'label' => 'Link: icoon',
					'name' => 'link_icoon',
					'type' => 'radio',
					'instructions' => 'Het plaatje voor de link',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array (
						'folder' => '<img src="/wp-content/themes/optimaal-digitaal/images/icon-folder20h.png" alt="Folder" width="26" height="20" />&nbsp;Folder',
						'document' => '<img src="/wp-content/themes/optimaal-digitaal/images/icon-document20h.png"	alt="Document" width="17" height="20"/>&nbsp;Document',
					),
					'other_choice' => 0,
					'save_other_choice' => 0,
					'default_value' => 'folder',
					'layout' => 'vertical',
				),
				array (
					'key' => 'field_569f61c53c9cc',
					'label' => 'Link: Titel',
					'name' => 'link_titel',
					'type' => 'text',
					'instructions' => 'Deze wordt in vette letters getoond',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_569f634af8a81',
					'label' => 'Link: beschrijving',
					'name' => 'link_beschrijving',
					'type' => 'textarea',
					'instructions' => 'Deze kan meerdere regels bevatten',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => 'wpautop',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_569f636df8a82',
					'label' => 'Link: CTA',
					'name' => 'link_cta',
					'type' => 'text',
					'instructions' => 'Call to action. ',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_5ZfuTpRAX3AFv',
					'label' => 'Link: hreflang',
					'name' => 'link_hreflang',
					'type' => 'text',
					'instructions' => 'Als de taal van de pagina waarnaar je verwijst anders is dan Nederlands, voer je hier de hreflang in.<br>(zie: <a href="https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes">lijst met taalcodes</a>)',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
    			'maxlength' => 5,
					'readonly' => 0,
					'disabled' => 0,
				),
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'tips',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;

//========================================================================================================
// options page 
if( function_exists('acf_add_options_page') ):

	$args = array(
		'slug' => 'instellingen',
		'title' => 'Theme-instelling',
		'parent' => 'themes.php'
	); 
	
		acf_add_options_page($args);

endif;


if( function_exists('acf_add_local_field_group') ):

	
	acf_add_local_field_group(array (
		'key' => 'group_56b268032bdb7',
		'title' => 'Tekst op homepage',
		'fields' => array (
			array (
				'key' => 'field_56b2680c9d5fd',
				'label' => 'Tekst op homepage',
				'name' => 'tekst_op_homepage',
				'type' => 'wysiwyg',
				'instructions' => 'Deze tekst wordt getoond op de homepage, in de magentakleurige header.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Tips met praktijkvoorbeelden om de digitale weg naar de overheid te stimuleren onder burgers en bedrijven. Samengesteld op basis van onderzoek en gedragspyschologie.',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 1,
			),
			array (
				'key' => 'field_yiMQNn4HpgGr2',
				'label' => 'Selectiemelding',
				'name' => 'filtering_selectie_boodschap',
				'type' => 'text',
				'instructions' => 'Deze tekst meldt het aantal gevonden tips voor de selectie van de gebruiker.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Aantal gevonden tips',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 1,
			),
			array (
				'key' => 'field_L8rpCEa3srHTR',
				'label' => 'Label op Wissen-knop',
				'name' => 'filtering_wissen_knop',
				'type' => 'text',
				'instructions' => 'Dit is het label op de knop "wissen".',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Wis selectie',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 1,
			),
			array (
				'key' => 'field_591230c9d5fd',
				'label' => 'Foutboodschap voor filtering',
				'name' => 'filtering_foutboodschap',
				'type' => 'text',
				'instructions' => 'Deze tekst wordt getoond als er geen tips gevonden worden voor de ingegeven filters.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Er zijn geen tips met deze selectie.',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 1,
			),
			array (
				'key' => 'field_yKs8LFHipYc8',
				'label' => 'Label op Toon Alles-knop',
				'name' => 'filtering_foutboodschap_knop',
				'type' => 'text',
				'instructions' => 'Dit is het label op de knop voor het tonen van alle tips, als de foutboodschap hiervoor getoond wordt.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Toon alles',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 1,
			),


			
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'instellingen',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
	
	
	acf_add_local_field_group(array (
		'key' => 'group_56a73cbfdf435',
		'title' => 'Instellingen voor contactformulier',
		'fields' => array (
			array (
				'key' => 'field_56a73cbfe31be',
				'label' => 'Contactformulier',
				'name' => 'contactformulier',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array (
					0 => 'wpcf7_contact_form',
				),
				'taxonomy' => array (
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'id',
				'ui' => 1,
			),
			array (
				'key' => 'field_56a73ce794fcf',
				'label' => 'Lege naam',
				'name' => 'lege_naam',
				'type' => 'text',
				'instructions' => 'Foutboodschap als naam leeg is',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'We willen graag uw naam weten.',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_56a73d2e94fd0',
				'label' => 'Lege suggestie',
				'name' => 'lege_suggestie',
				'type' => 'text',
				'instructions' => 'Foutboodschap als er geen suggestie of vraag is ingevuld',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'U hebt geen vraag of suggestie ingevuld.',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_56a73d6294fd1',
				'label' => 'Leeg mailadres',
				'name' => 'leeg_mailadres',
				'type' => 'text',
				'instructions' => 'Foutboodschap als er geen e-mailadres is ingevuld',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'We hebben uw mailadres nodig om te antwoorden.',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'instellingen',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
	
	acf_add_local_field_group(array (
		'key' => 'group_569e0529172fb',
		'title' => 'Teksten voor doorspringen naar contactformulier',
		'fields' => array (
			array (
				'key' => 'field_56a72fb44d372',
				'label' => 'Titel',
				'name' => 'spring_naar_contactformulier_titel',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Hebt u misschien een aanvulling op deze tip?',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_56a72febac2b1',
				'label' => 'Tekst',
				'name' => 'spring_naar_contactformulier_tekst',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Heeft u een voorbeeld, eigen case of andere aanvulling waar anderen iets aan hebben? Laat het ons weten! Optimaal Digitaal draait immers om het delen van goede ideeën.',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_56a72ffada688',
				'label' => 'Call to action',
				'name' => 'spring_naar_contactformulier_cta',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Stuur hier in',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'instellingen',
				),
			),
		),
		'menu_order' => 2,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
	

	acf_add_local_field_group(array (
		'key' => 'group_56dd829022462',
		'title' => '404 tekst',
		'fields' => array (
			array (
				'key' => 'field_56dd82959ab29',
				'label' => 'Titel op 404-pagina',
				'name' => 'titel404',
				'type' => 'text',
				'instructions' => 'Titel zoals die getoond wordt op de 404-pagina',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Excuses. De pagina waarnaar u verwezen bent bestaat niet.',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_56dd83d6c4674',
				'label' => 'Beschrijving op 404-pagina',
				'name' => 'description404',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'instellingen',
				),
			),
		),
		'menu_order' => 3,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	
endif;

//========================================================================================================

add_filter( 'wpcf7_validate_text', 'fn_od_wbvb_cf7_check_naam_veld', 999, 2);
add_filter( 'wpcf7_validate_text*', 'fn_od_wbvb_cf7_check_naam_veld', 999, 2);

add_filter( 'wpcf7_validate_textarea', 'fn_od_wbvb_cf7_check_message_veld', 9, 2);
add_filter( 'wpcf7_validate_textarea*', 'fn_od_wbvb_cf7_check_message_veld', 9, 2);

add_filter( 'wpcf7_validate_email', 'fn_od_wbvb_cf7_check_email_veld', 9, 2);
add_filter( 'wpcf7_validate_email*', 'fn_od_wbvb_cf7_check_email_veld', 9, 2);

function fn_od_wbvb_cf7_check_naam_veld($result, $tag) {
	$type = $tag['type'];
	$name = $tag['name'];

	$foutboodschap	= ( get_field('lege_naam', 'option') ) ? get_field('lege_naam', 'option') : _x('We willen graag uw naam weten.', 'Foutboodschap contactformulier', 'gebruikercentraal');
	
	if ('your-name' == $name) {
	    $the_value = fn_od_wbvb_filter_input_string($_POST[$name]);
	    $myresult = trim($the_value);
	    if ($myresult == "") {
	        $result->invalidate($tag, $foutboodschap );
	    }
	}
	
	return $result;
}

function fn_od_wbvb_cf7_check_message_veld($result, $tag) {

  $type = $tag['type'];
  $name = $tag['name'];
  
  $the_value  = fn_od_wbvb_filter_input_string($_POST[$name]);
  $myresult   = trim($the_value);
  
  $foutboodschap	= ( get_field('lege_suggestie', 'option') ) ? get_field('lege_suggestie', 'option') : _x('U hebt geen vraag of suggestie ingevuld.', 'Foutboodschap contactformulier', 'gebruikercentraal');
  
  if ($myresult == "") {
    $result->invalidate($tag, $foutboodschap );
  }
  
  return $result;

}

function cf7_add_custom_class($error) {
  $error=str_replace('class=\"','value="SUKKER!" class=\"', $error);
  return $error;
}
add_filter('wpcf7_validation_error', 'cf7_add_custom_class');

function fn_od_wbvb_cf7_check_email_veld($result, $tag) {
  $type = $tag['type'];
  $name = $tag['name'];
  
  $the_value 		= $_POST[$name];
  $foutboodschap	= ( get_field('leeg_mailadres', 'option') ) ? get_field('leeg_mailadres', 'option') : _x('We hebben uw mailadres nodig om te antwoorden.', 'Foutboodschap contactformulier', 'gebruikercentraal');
  
  if ($the_value == "") {
    $result->invalidate($tag, $foutboodschap );
  }
  
  return $result;
}

//========================================================================================================

function fn_od_wbvb_cf7_check_send_additional_mail($cf7) {
    //get CF7's mail and posted_data objects

    $submission = WPCF7_Submission::get_instance();
    if ( $submission ) {
      $posted_data = $submission->get_posted_data();
    }
    $mail = $cf7->prop( 'mail' );

    if ( $posted_data['sendcopy'][0] ) { //if Checkbox checked
      // do nothing
      // send the mail 2 as instructed
    }
    else {
      // user does not want mail to
      // make mail 2 empty
      $cf7->set_properties( array( 'mail_2' => array() ) );
    }
  
  return $cf7;
}
add_action('wpcf7_before_send_mail','fn_od_wbvb_cf7_check_send_additional_mail');

//========================================================================================================

if ( WP_DEBUG ) {
//    add_action( 'wp_enqueue_scripts', 'wbvb_debug_css' );
}
else {
}

//========================================================================================================
// == load extra scripts
add_action( 'wp_print_scripts', 'fn_od_wbvb_get_menu_scripts'); // now just run the function
function fn_od_wbvb_get_menu_scripts() {

	if ( !is_admin() ) { // don't add to any admin pages
//		wp_register_script('menujs', ( get_stylesheet_directory_uri() . '/js/min/menu-min.js'), false); // register script

		if ( is_singular( GC_TIP_CPT ) ) {	
			wp_register_script('combineer', ( get_stylesheet_directory_uri() . '/js/min/combineer.singletip-min.js'), false); // register script
			wp_enqueue_script('combineer'); // load script		

      wp_enqueue_script( 'cf7_custom_form', get_stylesheet_directory_uri() . '/js/min/jquery.form.min.js', array( 'jquery' ) );
      wp_enqueue_script( 'cf7_custom', get_stylesheet_directory_uri() . '/js/min/contactform-7-validation-min.js', array( 'jquery' ) );

			
//			wp_register_script('menujs', ( get_stylesheet_directory_uri() . '/js/singlemenu.js'), false); // register script
//			wp_enqueue_script('menujs'); // load script		
		}
		else {

//			wp_enqueue_script("jquery");

			
//			wp_register_script('mixitup', ( 'http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js' ) , false); // register script
//			wp_enqueue_script('mixitup'); // load script		
			
			
//			wp_register_script('tabs_functions', ( get_stylesheet_directory_uri() . '/js/min/tabs-functions-min.js'), false); // register script
//			wp_enqueue_script('tabs_functions'); // load script		

//			wp_register_script('menu', ( get_stylesheet_directory_uri() . '/js/min/menu-min.js'), false); // register script
//			wp_enqueue_script('menu'); // load script		

//			wp_register_script('sortfunctions', ( get_stylesheet_directory_uri() . '/js/sortfunctions.js'), false); // register script
//			wp_enqueue_script('sortfunctions'); // load script		

// als alles werkt: samenvoegen en minificeren

			wp_register_script('combineer', ( get_stylesheet_directory_uri() . '/js/min/combineer.cardspage-min.js'), false, CHILD_THEME_VERSION); // register script
			wp_enqueue_script('combineer'); // load script		



//			wp_register_script('menujs', ( get_stylesheet_directory_uri() . '/js/menu.js'), false); // register script
//			wp_enqueue_script('menujs'); // load script		

//			wp_register_script('mixitup', ( get_stylesheet_directory_uri() . '/js/min/jquery.mixitup.min.js'), false); // register script
//			wp_enqueue_script('mixitup'); // load script		

//			wp_register_script('shuffle', ( get_stylesheet_directory_uri() . '/js/min/jquery.shuffle.modernizr.js'), false); // register script
//			wp_enqueue_script('shuffle'); // load script		

//			wp_register_script('cardsort', ( get_stylesheet_directory_uri() . '/js/min/cardsort-min.js'), false); // register script
//			wp_enqueue_script('cardsort'); // load script		

//			wp_register_script('tinysort', ( get_stylesheet_directory_uri() . '/js/tinysort.js'), false); // register script
//			wp_enqueue_script('tinysort'); // load script		
	
//			wp_register_script('sortfunctions', ( get_stylesheet_directory_uri() . '/js/sortfunctions.js'), false); // register script
//			wp_enqueue_script('sortfunctions'); // load script		
		}
	}
	else {
//		wp_enqueue_script("jquery");
	}
}
//========================================================================================================
//* Add menu button option
add_action( 'genesis_site_description', 'fn_od_wbvb_menubutton' );

function fn_od_wbvb_menubutton() {
    echo '<div id="oc-trigger"><button id="nav-primary-button" data-effect="oc-push"><span class="label">' . __( "Menu", 'gebruikercentraal' ) . '</span><span class="icon">&nbsp;</span></button></div>';
}

//========================================================================================================

//* Add class to .site-container
add_filter( 'genesis_attr_site-container', 'fn_od_wbvb_add_attribute_site_container');
function fn_od_wbvb_add_attribute_site_container($attributes) {
	$attributes['id'] = 'site-container';
	return $attributes;
}


//* Add class to .site-container
add_filter( 'genesis_attr_site-header', 'fn_od_wbvb_add_pusher_class');
add_filter( 'genesis_attr_site-inner', 'fn_od_wbvb_add_pusher_class');
function fn_od_wbvb_add_pusher_class($attributes) {
	$attributes['class'] .= ' oc-pusher';
	return $attributes;
}

//========================================================================================================

add_filter( 'genesis_do_nav', 'fn_od_wbvb_add_open_menu_button', 10, 3 );

function fn_od_wbvb_add_menu_search_form($nav_output, $nav, $args) {

    if( 'primary' == $args['theme_location'] ) {
        $nav = $nav . get_search_form();
	}

	return $nav;

}

//========================================================================================================

function fn_od_wbvb_add_open_menu_button($nav_output, $nav, $args) {
	
    if( 'primary' == $args['theme_location'] ) {

        $vind       = 'class="nav-primary"';
        $vervang    = 'class="nav-primary oc-menu oc-push" id="nav-primary"';
        $nav_output = str_replace($vind, $vervang, $nav_output);

        $vind       = '</nav>';
        $vervang    = '<div id="nav-primary-closebutton-placeholder">&nbsp;</div></nav>';
        $nav_output = str_replace($vind, $vervang, $nav_output);

    }

	return $nav_output;

}
//========================================================================================================

//* Unregister secondary navigation menu
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Hoofdmenu', 'gebruikercentraal' ) ) );

//========================================================================================================

function fn_od_wbvb_frontend_load_scripts() {

	if ( !is_admin() ) { // don't add to any admin pages
		wp_register_script('yourscript', ( get_stylesheet_directory_uri() . '/js/tips-functions.js'), false); // register script
		wp_enqueue_script('yourscript'); // load script		
	}
}

//========================================================================================================

function fn_od_wbvb_no_posts_content_header() {

if ( is_search() ) {
	$titel404	=  __( 'Helaas. We konden niet vinden wat u zocht', 'optimaaldigitaal' );
}
else {
	$titel404	= ( get_field('titel404', 'option') ) ? get_field('titel404', 'option') :  _x( 'Excuses. De pagina waarnaar u verwezen bent bestaat niet', 'optimaaldigitaal' );
}



	printf( '<h1 class="entry-title">%s</h1>',$titel404 );

}
//========================================================================================================

function fn_od_wbvb_no_posts_content() {

	$description404	= ( get_field('description404', 'option') ) ? get_field('description404', 'option') :  '';
	if ( $description404 ) {
		echo $description404;
	}

if ( is_search() ) {
	echo '<p>Misschien kunt u het opnieuw proberen met een andere zoekterm. <br>' . get_search_form(false) . '</p>';
}
else {
	echo '<p>' . sprintf( __( '<a href="%s">Ga naar de homepage</a>.', 'gebruikercentraal' ), home_url() ) . '</p>';
	echo '<p>' . get_search_form() . '</p>';
}


}


//========================================================================================================
// voor pagina's zonder goede 404-afhandeling

remove_action( 'genesis_loop_else', 'genesis_404' );
remove_action( 'genesis_loop_else', 'genesis_do_noposts' );

add_action( 'genesis_loop_else', 'fn_od_wbvb_no_posts_content_header', 13 );
add_action( 'genesis_loop_else', 'fn_od_wbvb_no_posts_content', 14 );
add_action( 'genesis_loop_else', 'fn_od_wbvb_toon_sitemap', 15 );


//========================================================================================================

function fn_od_wbvb_toon_sitemap() {

  echo genesis_html5() ? '<article class="entry">' : '<div class="post hentry">';
  
  if ( is_404() ) {
    fn_od_wbvb_no_posts_content_header();
  }
  
  echo '<div class="entry-content">';
  
  if ( is_404() ) {
    fn_od_wbvb_no_posts_content();
  }
  
  ?>
  <h2><?php _e( 'Pages:', 'gebruikercentraal' ); ?></h2>
  <ul>
    <?php wp_list_pages( 'title_li=' ); ?>
  </ul>
  <?php 
  
  if ( taxonomy_exists( GC_TIPTHEMA ) ) { ?>
    
    <h2><?php _e( 'Tip-thema\'s:', 'gebruikercentraal' ); ?></h2>
    <?php 
    
    $args = array( 'hide_empty' => 1 );
    
    $terms = get_terms( GC_TIPTHEMA, $args );
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
      $count = count( $terms );
      $i = 0;
      $term_list = '<ul>';
      foreach ( $terms as $term ) {
        $i++;
        $term_list .= '<li><a href="' . get_term_link( $term ) . '" title="' . sprintf( __( 'View all post filed under %s', 'gebruikercentraal' ), $term->name ) . '">' . $term->name . '</a></li>';
      }
      $term_list .= '</ul>';
      echo $term_list;
    }				
  }
  echo '</div>';
  
  echo genesis_html5() ? '</article>' : '</div>';

}

//========================================================================================================
function dovardump($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}	    
//========================================================================================================
function fn_od_wbvb_add_header_css() {
	
	wp_enqueue_style(
		ID_SKIPLINKS,
		WBVB_THEMEFOLDER . '/css/blanco.css'
	);

    $custom_css = '';

    wp_add_inline_style( ID_SKIPLINKS, $custom_css );

}

//========================================================================================================

function fn_od_wbvb_skiplinks_styling() {
	
	wp_enqueue_style(
		ID_SKIPLINKS,
		WBVB_THEMEFOLDER . '/css/blanco.css'
	);

    $custom_css = '

    
ul#' . ID_SKIPLINKS . ', ul#' . ID_SKIPLINKS . ' li {
    list-style-type: none;
    list-style-image: none;
    padding: 0;
    margin: 0;
}
ul#' . ID_SKIPLINKS . ' li {
    background: none;
}
#' . ID_SKIPLINKS . ' li a {
    position: absolute;
    top: -1000px;
    left: 50px;
}
#wpadminbar .screen-reader-shortcut:focus, 
#' . ID_SKIPLINKS . ' li a:focus {


    left: 6px;
    top: 7px;
    height: auto;
    width: auto;
    display: block;
    font-size: 14px;
    font-weight: 700;
    padding: 15px 23px 14px;
    background: #fff;
    color: #000;
    z-index: 100000;
    line-height: normal;
    text-decoration: none;
    -webkit-box-shadow: 0 0 2px 2px rgba(0,0,0,.6);
    box-shadow: 0 0 2px 2px rgba(0,0,0,.6)
}

	
#' . ID_ZOEKEN . ':focus label {
    position: relative;
    left: 0;
    top: 0;
}';

    wp_add_inline_style( ID_SKIPLINKS, $custom_css );

}



//========================================================================================================
/* CSS voor admin, site en debug
*/

function admin_append_editor_styles() {
    add_editor_style(WBVB_THEMEFOLDER . '/editor-styles.css');
}

add_action( 'init', 'admin_append_editor_styles' );


//========================================================================================================

// remove Open Sans font
// Remove Open Sans that WP adds from frontend

if (!function_exists('fn_od_wbvb_remove_css_styles')) :

	function fn_od_wbvb_remove_css_styles() {

		wp_deregister_style( 'open-sans' );
		wp_register_style( 'open-sans', false );
		

		wp_deregister_script( 'contact-form-7' );
		
		
//		wp_deregister_script( 'jquery' ); 

		// all actions related to emojis
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		
		// filter to remove TinyMCE emojis
//		add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );		
		
		
	}

	add_action('wp_enqueue_scripts', 'fn_od_wbvb_remove_css_styles');
	
	// Uncomment below to remove from admin
	add_action('admin_enqueue_scripts', 'fn_od_wbvb_remove_css_styles');

endif;

//========================================================================================================


function fn_od_wbvb_get_tipnummer_formatted( $atts ) {
	global $post;

	$tipnummer = 'neen';

	if ( function_exists( 'get_field' ) ) {
    $tipnummer      = get_field('tip-nummer'); 
    
    if ( $tipnummer ) {
      return __( "Tip", 'gebruikercentraal' ) . ' ' . $tipnummer;
    }
	}	
  return $tipnummer;
}

add_shortcode( 'gettipnummer', 'fn_od_wbvb_get_tipnummer_formatted' );

//========================================================================================================
//* Customize the entry meta in the entry header (requires HTML5 theme support)
add_filter( 'genesis_post_info', 'od_correct_postinfo' ); 
function od_correct_postinfo($post_info) {
    global $wp_query;
    global $post;
    
	return '';
	
}

//========================================================================================================

add_filter( 'genesis_post_title_output', 'fn_od_wbvb_append_tipnummer_to_title', 15 );

function fn_od_wbvb_append_tipnummer_to_title( $title ) {

	if ( ( GC_TIP_CPT == get_post_type() ) && ( is_search() ) ) {
        $tipnummer      = get_field('tip-nummer'); 
        if ( $tipnummer ) {
            $tiplabel 		= __( "Tip", 'gebruikercentraal' ) . ' ' . $tipnummer;
        }
        $title = sprintf( '<h2 class="tax-entry-title"><a href="%s">' . $tiplabel . ' - %s</a></h2>', 
        	get_permalink(),
        	apply_filters( 'genesis_post_title_text', get_the_title() )
        	 );
    }
    return $title;
}

//========================================================================================================
add_action( 'genesis_after_entry_content', 'fn_od_wbvb_append_readmore_link' );
function fn_od_wbvb_append_readmore_link() { 

    global $post;
    
    $ankeiler = __( "Lees het hele bericht", 'gebruikercentraal' );

	if ( GC_TIP_CPT == get_post_type() ) {
	    $ankeiler = __( "Bekijk tip", 'gebruikercentraal' );
    }
    elseif ( 'page' == get_post_type() ) {
	    $ankeiler = __( "Bekijk pagina", 'gebruikercentraal' );
    }


    if ( ! is_singular() ) {
       echo '<div class="read-more"><a href="' . get_permalink() . '" tabindex="-1">' . $ankeiler . '</a></div>';
    }
}

//========================================================================================================
// sidebar
function fn_od_wbvb_footer_widget() {
    if ( !dynamic_sidebar( fn_od_wbvb_footer_widget ) ) {
        // do nothing
    }     
}

genesis_register_sidebar(   
    array(
        'name'              => __( "Footer-widget", 'gebruikercentraal' ),
        'id'                => fn_od_wbvb_footer_widget,
        'description'       => __( "Widget in de footer voor custom menu", 'gebruikercentraal' ),
		'before_widget' => genesis_markup( array(
			'html5' => '<div id="%1$s" class="widget %2$s side-bar '.fn_od_wbvb_footer_widget . '"><div class="widget-wrap">',
			'xhtml' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'echo'  => false,
		) ),
		'after_widget'  => genesis_markup( array(
			'html5' => '</div></div>' . "\n",
			'xhtml' => '</div></div>' . "\n",
			'echo'  => false
		) ),
		'before_title'  => '<h2 class="widget-title widgettitle">',
		'after_title'   => "</h2>\n",
    )

);

remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'fn_od_wbvb_append_footer_widget' );
function fn_od_wbvb_append_footer_widget() {
	fn_od_wbvb_footer_widget();
}

//========================================================================================================

add_filter( 'wp_nav_menu_items', 'theme_menu_extras', 10, 2 );/**
 * Filter menu items, appending either a search form or today's date.
 *
 * @param string   $menu HTML string of list items.
 * @param stdClass $args Menu arguments.
 *
 * @return string Amended HTML string of list items.
 */
function theme_menu_extras( $menu, $args ) {
	//* Change 'primary' to 'secondary' to add extras to the secondary navigation menu
	if ( 'primary' !== $args->theme_location )
		return $menu;
	//* Uncomment this block to add a search form to the navigation menu

	ob_start();
	get_search_form();
	$search = ob_get_clean();
	$menu  .= '<li class="right search">' . $search . '</li>';

	//* Uncomment this block to add the date to the navigation menu
	/*
	$menu .= '<li class="right date">' . date_i18n( get_option( 'date_format' ) ) . '</li>';
	*/
	return $menu;
}

//========================================================================================================

function fn_od_wbvb_filter_input_string( $string ) {

  $text = htmlspecialchars( $string );

  $text = preg_replace("/</", "-", $text);
  $text = preg_replace("/>/", "-", $text);
  $text = preg_replace("/script/", "ja doei", $text);
  $text = preg_replace("/username/i", " *zucht* ", trim($text));
  $text = preg_replace("/password/i", " *gaap* ", trim($text));
  $text = preg_replace("/;DROP /i", " *snurk* ", trim($text));
  $text = preg_replace("/select /i", " *fart* ", trim($text));
  $text = preg_replace("/ table /i", " *pfffffrt* ", trim($text));
  
  return $text;

}


//========================================================================================================
// function to strip out unwanted text characters

function fn_od_wbvb_make_safe_url($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", " ", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", " ", $string);
    return $string;
}

//========================================================================================================

//Social Buttons

function fn_od_wbvb_socialmediabuttons( $post_info ) {
	
    $thelink    = urlencode(get_permalink($post_info->ID));
    $thetitle   = urlencode($post_info->post_title);
    $sitetitle  = urlencode(get_bloginfo('name'));
    $summary    = urlencode($post_info->post_excerpt);
    $comment    = '';
    $print      = '';
        

    $thetag     = 'a';
    $hrefattr   = 'href';
    $popup      = ' onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;"';

    $mailshare  = __('E-mail', 'gebruikercentraal' );
    $mail_alt   = __('Deel dit via e-mail', 'gebruikercentraal' );
    $mailbody   = __('Bekijk deze pagina eens', 'gebruikercentraal' );


    $mail       = "<script type=\"text/javascript\">
<!-- Begin
function isPPC() {
if (navigator.appVersion.indexOf(\"PPC\") != -1) return true;
else return false;
}
if(isPPC()) {
document.write('<a class=\"mail\" HREF=\\\"mailto:\?subject\=" . $mailbody . ", ' + document.title + '?body=Link: ' + window.location + '\" onMouseOver=\"window.status=\'" . $mail_alt . "\'; return true\" title=\"" . $mail_alt . "\"><span class=\"visuallyhidden\">" . $mailshare . "<\/span><\/a>');
}
else { 
document.write('<a class=\"mail\" HREF=\\\"mailto:\?body\=" . $mailbody . ": ' + document.title + '. Link: ' + window.location + '\\\" onMouseOver=\"window.status=\\'" . $mail_alt . "\\'; return true\" title=\"" . $mail_alt . "\" rel=\"nofollow\"><span class=\"visuallyhidden\">" . $mailshare . "<\/span><\/a>');
}
// End -->
</script>";

//  $print = '<a href="#" class="print"><span class="visuallyhidden">print</span></a>';

  $share = '<li><' . $thetag . ' ' . $hrefattr . '="https://twitter.com/share?url=' . $thelink . '&via=' . GC_TWITTERACCOUNT . '&text=' . $thetitle . '" class="twitter" data-url="' . $thelink . '" data-text="' . $thetitle . '" data-via="' . GC_TWITTERACCOUNT . '"' . $popup . '><span class="visuallyhidden">' . __('Deel op Twitter', 'gebruikercentraal') . '</span></' . $thetag . '></li>
        <li><' . $thetag . ' class="linkedin" ' . $hrefattr . '="http://www.linkedin.com/shareArticle?mini=true&url=' . $thelink . '&title=' . $thetitle . '&summary=' . $summary . '&source=' . $sitetitle . '"' . $popup . '><span class="visuallyhidden">' . __('Deel op LinkedIn', 'gebruikercentraal') . '</span></' . $thetag . '></li>';
    
    if ( $thelink ) {
      return $comment . '<ul class="social-media share-buttons">' .$share . '<li>' .$mail . '</li>
        <li>' .$print . '</li>
        </ul>';    
            
    }
}

//========================================================================================================

function rhswp_add_taxonomy_description() {
  
    global $wp_query;
    if ( ! is_category() && ! is_tag() && ! is_tax() )
        return;

    $prefix = '';

    if ( is_tag() ) {
      $prefix = __( "Tag", 'wp-rijkshuisstijl' ) . ': ';  
    }

    $term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();
    if ( ! $term || ! isset( $term->meta ) )
        return;
        
    $headline   = '';
    $intro_text = '';
    if ( $term->name ) {
        $headline = sprintf( '<h1 class="archive-title">%s</h1>', $prefix . strip_tags( $term->name ) );
    }
        
    if ( isset( $term->meta['headline'] ) && $term->meta['headline'] ) {
        $headline = sprintf( '<h1 class="archive-title">%s</h1>', $prefix . strip_tags( $term->meta['headline'] ) );
    }
        
    if ( isset( $term->meta['intro_text'] ) && $term->meta['intro_text'] ) {
        $intro_text = apply_filters( 'genesis_term_intro_text_output', $term->meta['intro_text'] );
    }
        
    if ( $term->description ) {
        $intro_text = apply_filters( 'genesis_term_intro_text_output', $term->description );
    }

    if ( $headline || $intro_text ) {
        printf( '<div class="taxonomy-description">%s</div>', $headline . $intro_text );
    }
    else {
        return;
    }
}

//========================================================================================================

function op_do_show_cards_for_thema() {
	echo '<section class="cardflex">';
	global $tipcounter;
	global $post;
	global $filterthemas;

    $classes				= array();
		
	$terms = get_terms( GC_TIPTHEMA );

	foreach($terms as $term) {
		// settings per thema ophalen

		$classes[$term->slug] = array();
		$classes[$term->slug]['name']	= $term->name;

	    if ( function_exists( 'get_field' ) ) {
			$themakleur			= get_field('thema-kleur', GC_TIPTHEMA . '_' . $term->term_id ); 
			$themaplaatje		= get_field('thema-logo', GC_TIPTHEMA . '_' . $term->term_id ); 

			$classes[$term->slug]['kleur']	= $themakleur;
			$classes[$term->slug]['plaatje']	= $themaplaatje;


		}

	    $classes =  array_filter($classes);
	}


	$tipcounter = 0;

	while ( have_posts() ) {

		the_post(); 

		$term_list = get_the_terms( get_the_ID(), GC_TIPTHEMA );

		$theslug = $term_list[0]->slug;

		$kleuren	= $classes[$theslug]['kleur'];
		$plaatjes	= $classes[$theslug]['plaatje'];
		fn_od_wbvb_write_tip_kaart(get_post(), $plaatjes, $kleuren, '<div class="containstip">', '</div>');
	}

	echo '</section>';

  genesis_posts_nav();

	
}

//========================================================================================================

