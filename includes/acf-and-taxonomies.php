<?php

// Optimaal Digitaal - acf-and-taxonomies.php
// ----------------------------------------------------------------------------------
// definitions for ACF and custom taxonomies
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 2.11.1
// @desc.   Contactinfo van tipgevers toegevoegd.
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme


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

  //------------------------------------------------------------------------------------------------------

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

  //------------------------------------------------------------------------------------------------------

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

  //------------------------------------------------------------------------------------------------------

	$labels = array(
		"name"              => __( 'Tipgevers', 'gebruikercentraal' ),
		"singular_name"     => __( 'Tipgever', 'gebruikercentraal' ),
		);

	$labels = array(
		"name"                  => __( 'Tipgevers', 'gebruikercentraal' ),
		"singular_name"         => __( 'Tipgever', 'gebruikercentraal' ),
		"menu_name"             => __( 'Tipgevers', 'gebruikercentraal' ),
		"all_items"             => __( 'Alle tipgevers', 'gebruikercentraal' ),
		"add_new"               => __( 'Nieuwe tipgever toevoegen', 'gebruikercentraal' ),
		"add_new_item"          => __( 'Voeg nieuwe tipgever toe', 'gebruikercentraal' ),
		"edit_item"             => __( 'Bewerk tipgever', 'gebruikercentraal' ),
		"new_item"              => __( 'Nieuwe tipgever', 'gebruikercentraal' ),
		"view_item"             => __( 'Bekijk tipgever', 'gebruikercentraal' ),
		"search_items"          => __( 'Zoek tipgever', 'gebruikercentraal' ),
		"not_found"             => __( 'Geen tipgever gevonden', 'gebruikercentraal' ),
		"not_found_in_trash"    => __( 'Geen tipgever gevonden in de prullenbak', 'gebruikercentraal' ),
		"featured_image"        => __( 'Uitgelichte afbeelding', 'gebruikercentraal' ),
		"archives"              => __( 'Overzichten', 'gebruikercentraal' ),
		"uploaded_to_this_item" => __( 'Bijbehorende bestanden', 'gebruikercentraal' ),
		);

	$args = array(
		"label"               => __( 'Tipgevers', 'gebruikercentraal' ),
		"labels"              => $labels,
		"public"              => true,
		"hierarchical"        => false,
		"label"               => __( 'Tipgevers', 'gebruikercentraal' ),
		"show_ui"             => true,
		"show_in_menu"        => true,
		"show_in_nav_menus"   => true,
		"query_var"           => true,
		"rewrite"             => array( 'slug' => OD_CITAATAUTEUR, 'with_front' => true, ),
		"show_admin_column"   => false,
		"show_in_rest"        => false,
		"rest_base"           => "",
		"show_in_quick_edit"  => false,
	);
	register_taxonomy( OD_CITAATAUTEUR, array( GC_TIP_CPT ), $args );

  //------------------------------------------------------------------------------------------------------
  // custom fields

  if( function_exists('acf_add_local_field_group') ) {
    
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
        			'key' => 'field_58ee12572addf',
        			'label' => 'Tipgever',
        			'name' => OD_CITAATAUTEUR . '_field',
        			'type' => 'taxonomy',
        			'instructions' => 'Selecteer één uit de lijst of voer een nieuwe naam in',
        			'required' => 0,
        			'conditional_logic' => 0,
        			'wrapper' => array (
        				'width' => '',
        				'class' => '',
        				'id' => '',
        			),
        			'taxonomy' => OD_CITAATAUTEUR,
        			'field_type' => 'multi_select',
        			'allow_null' => 0,
        			'add_term' => 1,
        			'save_terms' => 1,
        			'load_terms' => 0,
        			'return_format' => 'id',
        			'multiple' => 0,
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
  
  }

  //------------------------------------------------------------------------------------------------------



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
				'icon-inclusie'            => 'inclusie',
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
				'inclusie'            => 'inclusie',
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
//==
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_5a02ef774dca6',
	'title' => 'Contactgegevens voor tipgever',
	'fields' => array (
		array (
			'key' => 'field_5a02f087c923e',
			'label' => 'Functietitel',
			'name' => 'tipgever_functietitel',
			'type' => 'text',
			'value' => NULL,
			'instructions' => '',
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
			'maxlength' => '',
		),
		array (
			'key' => 'field_5a02ef8fe03f1',
			'label' => 'Foto',
			'name' => 'tipgever_foto',
			'type' => 'image',
			'value' => NULL,
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'opsommingwidth',
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
			'key' => 'field_5a02f05afe0a8',
			'label' => 'E-mailadres',
			'name' => 'tipgever_mail',
			'type' => 'email',
			'value' => NULL,
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
			'prepend' => '',
			'append' => '',
		),
		array (
			'key' => 'field_5a02f8c21d789',
			'label' => 'Telefoonnummer',
			'name' => 'tipgever_telefoonnummer',
			'type' => 'text',
			'value' => NULL,
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
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => OD_CITAATAUTEUR,
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



// End fn_od_wbvb_register_custom_taxonomies


}


/*
          		array (
        			'key' => 'field_58ee12572addf',
        			'label' => 'Docent',
        			'name' => 'college_docent',
        			'type' => 'taxonomy',
        			'instructions' => 'docent_multiselect',
        			'required' => 0,
        			'conditional_logic' => 0,
        			'wrapper' => array (
        				'width' => '',
        				'class' => '',
        				'id' => '',
        			),
        			'taxonomy' => 'docent',
        			'field_type' => 'multi_select',
        			'allow_null' => 0,
        			'add_term' => 1,
        			'save_terms' => 1,
        			'load_terms' => 0,
        			'return_format' => 'id',
        			'multiple' => 0,
        		),
*/

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
