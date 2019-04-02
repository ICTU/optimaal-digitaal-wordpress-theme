<?php

///
// Optimaal Digitaal - single-tips.php
// ----------------------------------------------------------------------------------
// Verantwoordelijk voor de structuur van het tonen van een single tip
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.1.4
// @desc.   Contactformulier is nu optioneel.
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme
///

define( 'ID_waaromwerktdit', 'ID_waaromwerktdit' );
define( 'ID_nuttigelinks', 'ID_nuttigelinks' );
define( 'ID_goedvoorbeeld', 'ID_goedvoorbeeld' );
define( 'ID_onderzoek', 'ID_onderzoek' );
define( 'ID_reactieformulier', 'reactieformulier' );
define( 'ID_maincontent', 'inleiding' );


$skiplinks         = '';
$inlinelinks       = '';
$goed_voorbeeld	   = '';
$waaromwerktdit	   = '';
$nuttigelinks		   = '';
$onderzoek         = '';
$contactformulier	 = '';
$contactformulier_tonen = '';

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action('genesis_entry_content','genesis_do_post_content');
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

/** Remove Header and navigation */
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

remove_action( 'genesis_entry_header','genesis_do_post_title' );

// custom content
add_action('genesis_entry_header','od_tip_custom_content');

// custom link
add_action( 'genesis_header', 'od_pageheader_backlink', 1 );

function od_pageheader_backlink() {
	echo '<nav id="backlink" class="clearfix"><a href="/">&lt;&nbsp;alle&nbsp;tips</a>';
	get_search_form();
	echo '</nav>';
}

// == load extra scripts
add_action( 'wp_print_scripts', 'fn_od_wbvb_frontend_load_scripts'); // now just run the function

//add_action( 'genesis_after_entry', 'prev_next_post_nav' );

function prev_next_post_nav() {
  
  global $post;
  
  if ( ! is_singular( GC_TIP_CPT ) )  return;

  $tipnummer      = '';
  $nexttitle      = '';
  $taxonomie      = '';
  $taxonomielist  = '';

  if ( taxonomy_exists( GC_TIPTHEMA ) && ( $post ) ) {
    
    $taxonomie   = get_the_terms( $post->ID, GC_TIPTHEMA );

  	if ( $taxonomie && ! is_wp_error( $taxonomie ) ) {
    	$counter = 0;
    	// tip slug
      foreach ( $taxonomie as $term ) {

        $term_link = get_term_link( $term->term_id );    
    
        if ( $term_link ) {
          $taxonomielist .= '<li><a href="' . $term_link . '">' . __('Alle tips bij het thema', 'optimaaldigitaal' ) . ' <em>' . $term->name . '</em></a></li>';
        }
      }
  	}	
  }

  if ( taxonomy_exists( GC_TIPVRAAG ) && ( $post ) ) {
    
    $taxonomie   = get_the_terms( $post->ID, GC_TIPVRAAG );

  	if ( $taxonomie && ! is_wp_error( $taxonomie ) ) {
    	$counter = 0;
    	// tip slug
      foreach ( $taxonomie as $term ) {

        $term_link = get_term_link( $term->term_id );    
    
        if ( $term_link ) {
          $taxonomielist .= '<li><a href="' . $term_link . '">' . __('Alle tips bij de vraag', 'optimaaldigitaal' ) . ' <em>' . $term->name . '</em></a></li>';
        }
      }
  	}	
  }

  if ( taxonomy_exists( GC_TIPORGANISATIE ) && ( $post ) ) {
    
    $taxonomie   = get_the_terms( $post->ID, GC_TIPORGANISATIE );

  	if ( $taxonomie && ! is_wp_error( $taxonomie ) ) {
    	$counter = 0;
    	// tip slug
      foreach ( $taxonomie as $term ) {

        $term_link = get_term_link( $term->term_id );    
    
        if ( $term_link ) {
          $taxonomielist .= '<li><a href="' . $term_link . '">' . __('Alle tips bij de organisatie', 'optimaaldigitaal' ) . ' <em>' . $term->name . '</em></a></li>';
        }
      }
  	}	
  }


  $tipnummer      = ''; 

  if ( function_exists( 'get_field' ) ) {

      $tipnummer      = get_field('tip-nummer'); 
      $soortinleiding	= get_field('soort_inleiding'); 

      if ( $tipnummer ) {
          $tipnummer = '<span class="tipnummer">' . __( "Tip", 'gebruikercentraal' ) . ' ' . $tipnummer . '</span>';
      }
	}
  
  $nextPost   = get_next_post( false );

  if ($nextPost) {

    if ( ( $nextPost->post_status == 'publish' ) && ( $nextPost->post_password == '' ) ) {
      $tipnummer  = get_field('tip-nummer', $nextPost->ID);
      $nexttitle  = $nextPost->post_title;
  
      if ($tipnummer) {
          $nexttitle = '<strong>Tip ' . $tipnummer . '</strong> ' . $nexttitle;
      }
    }
  }  
  
  $tipnummer      = '';
  $previoustitle  = '';

  $previousPost = get_previous_post( false );
  if ($previousPost) {

    if ( ( $previousPost->post_status == 'publish' ) && ( $previousPost->post_password == '' ) ) {
      $previoustitle = $previousPost->post_title;
  
      $tipnummer  = get_field('tip-nummer', $previousPost->ID);
      if ($tipnummer) {
          $previoustitle = '<strong>Tip ' . $tipnummer . '</strong> ' . $previoustitle;
      }
    }
  }

  if ( $previoustitle || $previoustitle  || $taxonomielist ) {
    echo '<section class="pagination">';
    echo '<h2>' . __('Andere tips', 'gebruikercentraal' ) . '</h2>';

    if ( $previoustitle ) {
      previous_post_link( '<div class="pagination-previous alignleft">%link</div>', $previoustitle );
    }
    if ( $nexttitle ) {
      next_post_link( '<div class="pagination-next alignright">%link</div>', $nexttitle );
    }

    if ( $taxonomielist ) {
      echo '<ul>' . $taxonomielist . '</ul>';
    }    
    
    echo '</section><!-- .prev-next-navigation -->';
  }
  

    
}


function od_tip_custom_content() {
    global $errormessage;
    global $post;
    global $skiplinks;
    global $inlinelinks;
    global $goed_voorbeeld; 
    global $waaromwerktdit; 
    global $nuttigelinks; 
    global $onderzoek; 
    global $contactformulier; 
    global $contactformulier_tonen; 



    $niks 			= '';
    $taxonomie  = get_the_terms( $post->ID, GC_TIPTHEMA );

		if ( $taxonomie && ! is_wp_error( $taxonomie ) ) {
			foreach ( $taxonomie as $term ) {
	
				$classes[$term->term_id] = array();
				$classes[$term->term_id]['name']	= $term->name;
	
			    if ( function_exists( 'get_field' ) ) {
					$themakleur			= get_field('thema-kleur', GC_TIPTHEMA . '_' . $term->term_id ); 
					$themaplaatje		= get_field('thema-logo', GC_TIPTHEMA . '_' . $term->term_id ); 
	
					$classes[$term->term_id]['kleur']	= $themakleur;
					$classes[$term->term_id]['plaatje']	= $themaplaatje;
					 $term_link = get_term_link( $term );
	
					$tipthema = '<div class="' . $themaplaatje . ' tipthema"><span>' . $term->name . '</span></div>';
				}
			}
		}	

    $tipnummer      = ''; 

    if ( function_exists( 'get_field' ) ) {

        $tipnummer      = get_field('tip-nummer'); 
        $soortinleiding	= get_field('soort_inleiding'); 

        if ( $tipnummer ) {
            $tipnummer = __( "Tip", 'gebruikercentraal' ) . ' ' . $tipnummer;
        }
		}
    
    if ( $errormessage ) {
      echo $errormessage;
    }
    
    echo '<header class="onderwerp">';
    
    if ($tipthema) {
        echo $tipthema;
    }
    else {
        echo '<p>' . __( "Deze tip is niet gekoppeld aan een thema", 'gebruikercentraal' ) . '</p>';
    }
    

    echo '<span class="tipnummer">' . $tipnummer . '</span>';
		echo '<h1>' . get_the_title() . '</h1>';
    echo fn_od_wbvb_socialmediabuttons( $post );
	
		if ( post_password_required() ) {
      // niks tonen
		}			
		else {
      if ( $inlinelinks ) {
        echo $inlinelinks;
      }
    }
	    
    echo '</header>';
	

    if ( post_password_required() ) {
      // niks tonen
    }
    else {
      echo '<section role="main" id="' . ID_maincontent . '"><h2>Inleiding</h2>';
      
      //setup thumbnail image args to be used with genesis_get_image();
      $size         = HALFWIDTH; // Change this to whatever add_image_size you want
      $default_attr = array(
        'class' => "attachment-$size $size",
        'alt'   => get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true),
      );

      $enddiv		= '';

      if ( $soortinleiding == 'grotefoto' ) {
      
        $image          = get_field('grote_foto');
        $attachment_id  = $image['ID'];
        
        if ( $image ) {
          
          echo '<div class="halfwidth"><img alt="" src="' . wp_get_attachment_image_url( $attachment_id, HALFWIDTH ) . '" srcset="' . wp_get_attachment_image_srcset( $attachment_id, HALFWIDTH ) . '" sizes="' . wp_get_attachment_image_sizes( $attachment_id, HALFWIDTH ) . ' " /></div>';	        
        
        }
      }
    }
    // sowieso the_content() tonen, want hier zit ook de wachtwoord-check in.
    the_content();
    
    if ( post_password_required() ) {
      // niks tonen
    }
    else {
    
    if ( $soortinleiding == 'opsommingen' ) {
      
      $lijstjes_met_kleine_foto = get_field('lijstjes_met_kleine_foto'); 
      
      foreach( $lijstjes_met_kleine_foto as $field_name => $value ) {
      
        echo '<div class="opsomming">';
        
        $image = $value['bijbehorende_foto'];
        
        if ( $image ) {
          echo '<div><img src="' . $image['sizes'][OPSOMMINGWIDTH] . '" alt="" height="' . $image['sizes'][OPSOMMINGWIDTH . '-height'] . '" width="' . $image['sizes'][OPSOMMINGWIDTH . '-width'] . '" /></div>';
        }
        
        echo '<div><h2>' . $value['titel'] . '</h2>';
        echo $value['lijstje'];
        
        echo '</div></div>';
        
      }
    }

    echo '</section>';

    if ( $goed_voorbeeld ) {
      
      echo '<section class="goedevoorbeelden">';
      
      echo '<h2 id="' . ID_goedvoorbeeld . '">' . __( "Goede voorbeelden", 'gebruikercentraal' ) . '</h2>';
      
      $side = 'rechts';
      
      foreach( $goed_voorbeeld as $field_name => $value ) {
        
        if ( $side == 'rechts' ) {
          $side = 'links';
        }
        else {
          $side = 'rechts';
        }
        
        echo '<section class="goedvoorbeeld ' . $side . '">';
        
        $image          = $value['afbeelding_goed_voorbeeld'];
        
        $visitekaart    = '';
        $archivelink    = '';
        $naam           = $value['voorbeeld-auteur-naam'];
        $functietitel   = $value['voorbeeld-auteur-functie'];
        $experts        = $value[OD_CITAATAUTEUR . '_field'];
        
        if ( $experts && ( $experts[0] > 0 )  ) {
          $xpercounter = 0;              

          foreach ( $experts as $theterm ) {
            //OD_CITAATAUTEUR . '_field'

            $thetermdata    = get_term( $theterm, OD_CITAATAUTEUR );
            $acfid          = $thetermdata->taxonomy . '_' . $thetermdata->term_id;
            $tipgever_foto  = get_field( 'tipgever_foto', $acfid);
            $functietitel   = get_field( 'tipgever_functietitel', $acfid );
            $tipgever_mail  = get_field( 'tipgever_mail', $acfid );
            $tipgever_foon  = get_field( 'tipgever_telefoonnummer', $acfid );
            
            if ( ( ! $image ) && $tipgever_foto ) {
              $image = $tipgever_foto;
            }

            $acfid          = OD_CITAATAUTEUR . '_' . $theterm;
            $image_tag      = '';

            if ( $thetermdata->name ) {
              $naam         = $thetermdata->name;
            }

            // link naar archive als er meer dan 1 tip aan deze tax. hangt
            if ( ( $thetermdata->count > 1 ) && $naam ) {
              $archivelink = ' <a href="' . get_term_link( $thetermdata->term_id ) . '" class="archivelink">' . sprintf( __( 'Meer tips <span class="visuallyhidden">van %s</span>', 'gebruikercentraal' ), $naam ) . '</a>';
            }
            
            if ( $tipgever_mail || $tipgever_foon ) {

              $visitekaart = '<small>' . $naam;

              if ( $functietitel ) {
                $visitekaart .= '<br>' . $functietitel; 
              }
              
              if ( $tipgever_mail ) {
                $visitekaart .= '<br><a href="mailto:' . $tipgever_mail . '">' . $tipgever_mail . '</a>'; 
              }
              
              if ( $tipgever_foon ) {
                $visitekaart .= '<br><a href="tel:' . preg_replace("/[^0-9+]/", "", $tipgever_foon) . '">' . $tipgever_foon . '</a>';
              }
              if ( $archivelink ) {
                $archivelink = '<br>' . $archivelink;
              }
              $visitekaart .= $archivelink . '</small>';
              
              // naam en functietitel wissen zodat ze niet dubbel getoond worden
              $functietitel = '';
              $naam         = '';
              $archivelink  = '';
            }
          }
        }

        if ( ( $image ) && ( isset($image["sizes"] ) ) ) {
          if ( $visitekaart ) {
            $visitekaart = '<div class="visitekaartje"><img src="' . $image['sizes'][OPSOMMINGWIDTH] . '" alt="" height="' . $image['sizes'][OPSOMMINGWIDTH . '-height'] . '" width="' . $image['sizes'][OPSOMMINGWIDTH . '-width'] . '" />' . $visitekaart . '</div>';
          }
          else {
            $visitekaart = '<img src="' . $image['sizes'][OPSOMMINGWIDTH] . '" alt="" height="' . $image['sizes'][OPSOMMINGWIDTH . '-height'] . '" width="' . $image['sizes'][OPSOMMINGWIDTH . '-width'] . '" />';
          }
        }
        
        echo $visitekaart;
        
        echo '<h3>' . $value['titel_goed_voorbeeld'] . '</h3>';
        echo $value['tekst_goed_voorbeeld'];


        // deze waarden zijn alleen gevuld als het visitekaartje NIET getoond is
        if ( $naam && $functietitel ) {
          echo '<small class="auteur">' . $naam . ', ' . $functietitel . ' ' . $archivelink . '</small>';
        }
        else if ( $naam ) {
          echo '<small class="auteur">' . $naam . ' ' . $archivelink . '</small>';
        }
        
        echo '</section>';
        
      }
      
      echo '</section>';

    }
	
	    if ( $waaromwerktdit ) {
  			echo '<section class="waaromwerktdit">';
  			echo '<h2 id="' . ID_waaromwerktdit . '">' . __( "Waarom werkt dit?", 'gebruikercentraal' ) . '</h2>';
  	//		echo '<p>' . $waaromwerktdit . '</p>';
  			echo $waaromwerktdit;
  			echo '</section>';
	    }
	

	    if ( ( $contactformulier ) &&
	    	( $nuttigelinks ) &&
			( $onderzoek ) ) {
		    
	
			$spring_naar_contactformulier_titel	= get_field('spring_naar_contactformulier_titel', 'option');
			$spring_naar_contactformulier_tekst	= get_field('spring_naar_contactformulier_tekst', 'option');
			$spring_naar_contactformulier_cta	= get_field('spring_naar_contactformulier_cta', 'option');
		    
	//		echo '<section class="contactformulierjump hasboxshadow">';
			echo '<section class="nuttigelinks contactformulierjump">';
	
	
			echo '<div>
			<a href="#' . ID_reactieformulier . '" id="jumptosuggestie" class="hasboxshadow jumptosuggestie"><div>';
	
			echo '<h2>';
			if ( $spring_naar_contactformulier_titel )  {
				echo  $spring_naar_contactformulier_titel;
			}
			else {
				echo  __( "Heeft u misschien een aanvulling op deze tip?", 'gebruikercentraal' );
			}
			echo '</h2> ';
	
			if ( $spring_naar_contactformulier_tekst )  {
				echo  $spring_naar_contactformulier_tekst;
			}
			else {
				echo  __( "Heeft u een eigen voorbeeld, eigen case of andere aanvulling waar anderen iets aan hebben? Laat het ons weten. Optimaal Digitaal draait immers om het delen van goede ideeën.", 'gebruikercentraal' );
			}
	
			echo ' <span>';
			if ( $spring_naar_contactformulier_cta )  {
				echo  $spring_naar_contactformulier_cta;
			}
			else {
				echo  __( "Stuur hier in", 'gebruikercentraal' );
			}
			echo '</span>';
			echo '</div></a></div>';
	
			echo '</section>';
	    }
	
	    if ( $onderzoek ) {
	
	        $conclusie      = get_field('inleiding-conclusie'); 
	        $vraag1      	= get_field('inleiding-vraag_1_titel'); 
	
	
			echo '<section class="onderzoek">';
			echo '<h2 id="' . ID_onderzoek . '">' . __( "Onderzoek", 'gebruikercentraal' ) . '</h2>';
//			echo '<p>' . $onderzoek . '</p>';
			echo $onderzoek;
	
			echo '<div id="cijfers">';
			od_get_ondezoeksvraag('vraag_1');
			od_get_ondezoeksvraag('vraag_2');
			od_get_ondezoeksvraag('vraag_3');
			echo '</div>';
			
		    if ( $conclusie ) {
				echo '<div class="conclusie">';
				echo '<h3>' . __( "Conclusie", 'gebruikercentraal' ) . '</h3>';
	
				$conclusie = preg_replace("/<p[^>]*?>/", $niks, $conclusie);
				$conclusie = str_replace("</p>", $niks, $conclusie);
				
				echo '<p>' . $conclusie . '</p></div>';
		    }
			echo '</section>';
	    }
	
	

	
      if ( $nuttigelinks ) {

  			echo '<section class="nuttigelinks">';
  	        
  			echo '<h2 id="' . ID_nuttigelinks . '">' . __( "Nuttige links", 'gebruikercentraal' ) . '</h2>';
  	
  	
        foreach( $nuttigelinks as $post) {
          setup_postdata($post);
          
          $url_nuttige_link             = $post['url'];
          $url_link_titel               = $post['link_titel'];
          $url_link_hreflang            = $post['link_hreflang'];
          $url_link_hreflang_attr       = '';
          if ( $url_link_hreflang ) {
            $url_link_hreflang_attr = ' hreflang="' . $url_link_hreflang . '"';
          }
          $url_link_beschrijving				= $post['link_beschrijving'];
          $url_link_cta                 = $post['link_cta'];
          $link_icoon                   = $post['link_icoon'];
          
          if ( $url_nuttige_link  ) {
  
            $class = "folder";
  
  //          echo '<section>';
            
            if ( $link_icoon != "document" ) {
              $class = "folder";
            }
            else {
              $class = "document";
            }
            
            echo '<a href="' . $url_nuttige_link . '" class="hasboxshadow nuttigelink ' . $class . '"' . $url_link_hreflang_attr . '>';
            echo '<div class="' . $class . '">';
            
            if ( $url_link_titel ) {
              echo '<strong>' . $url_link_titel . '</strong> ';
            }
            
            if ( $url_link_beschrijving ) {
              $url_link_beschrijving = preg_replace("/<p[^>]*?>/", $niks, $url_link_beschrijving);
              $url_link_beschrijving = str_replace("</p>", $niks, $url_link_beschrijving);
              echo $url_link_beschrijving;
            }
            
            if ( $url_link_cta ) {
              echo '<span class="cta">';
              echo $url_link_cta;
              echo '</span>';
            }
            
            if ( ( !$url_link_titel ) && ( !$url_link_beschrijving ) && ( !$url_link_cta ) ) {
              echo '<span class="cta">' . __( "Geen linkbeschrijving ingevoerd", 'gebruikercentraal' ) . '</span>';
            }
            
            echo '</div>';
            echo '</a>';
  //          echo '</section>';
          }
        }
  	
  
      	wp_reset_postdata();

  			echo '</section>'; // .nuttigelinks
  	
  		}

      prev_next_post_nav();

// to do: recaptcha check.
// op dit moment (19 dec 2018) werkt de recaptcha niet goed meer
// CF7 vereist een nieuwe versie voor Google recaptcha (v3 in plaats van v2)
// wegens een spamrun heb ik vandaag (20181219) het contactformulier uberhaupt uitgezet

    if ( $contactformulier && ( $contactformulier_tonen == 'ja' ) ) {
			echo '<section class="suggestie" id="' . ID_reactieformulier . '">';
			echo '<h2>' . __( "Vraag, idee, reactie of suggestie?", 'gebruikercentraal' ) . '</h2>';
			echo do_shortcode('[contact-form-7 id="' . $contactformulier . '" title="Vraag, reactie of suggestie?"]');
			echo '</section>';
		}
		else {
			$user = wp_get_current_user();
			$allowed_roles = array('editor', 'administrator', 'author');
			if( array_intersect($allowed_roles, $user->roles ) ) {  
				echo '<p>' . __( "Selecteer een contactformulier. <br /><strong>Via:</strong> Admin > Options", 'gebruikercentraal' ) . '</p>';
			} 
		}
    }
}



//========================================================================================================

function od_get_ondezoeksvraag($key) {

    global $post;

    $vraag      	= get_field('inleiding-' . $key . '_titel'); 
    $cijfer      	= get_field('inleiding-' . $key . '_-_cijfer'); 
    $antwoord      	= get_field('inleiding-' . $key . '_-_antwoord'); 

	if ( $vraag && $cijfer && $antwoord  ) {
		echo '<p class="onderzoekvraag" id="onderzoek_' . $key . '"><span class="vraag">' . $vraag . '</span>
		<span class="cijfers"><span class="cijfer">' . $cijfer . '</span>
		<span class="antwoord">' . $antwoord . '</span></span></p>';  
	}
}


//========================================================================================================
/**
* Add a link first thing after the body element that will skip to the inner element.
*/

add_action( 'genesis_before_header', 'od_add_skip_link' );

function od_add_skip_link( ) {

    global $skiplinks;

	od_get_field_data();

    echo sprintf( 
        '<ul id="%1$s">%2$s</ul>',
        ID_SKIPLINKS,
        $skiplinks
        
    );
}

//========================================================================================================


function od_get_field_data( ) {

    global $skiplinks;
    global $inlinelinks;
    global $goed_voorbeeld; 
    global $waaromwerktdit; 
    global $nuttigelinks; 
    global $onderzoek; 
    global $contactformulier; 
    global $contactformulier_tonen; 


    if ( function_exists( 'get_field' ) ) {

        $goed_voorbeeld 	= get_field('goed_voorbeeld'); 
        $waaromwerktdit 	= get_field('waarom_werkt_dit_goed_voorbeeld'); 
        $nuttigelinks   	= get_field('nuttige_links'); 
        $tipnummer      	= get_field('tip-nummer'); 
        $onderzoek      	= get_field('inleiding-onderzoek'); 
        $soortinleiding		= get_field('soort_inleiding'); 
    		$contactformulier       = get_field('contactformulier', 'option');
    		$contactformulier_tonen = get_field('contactformulier_tonen', 'option');


        $inlinelinks = '';

        $skiplinks .= '<li><a href="#' . ID_maincontent . '">' . _x('Direct naar de inleiding', 'Skiplinks', 'gebruikercentraal') . '</a></li><li><a href="#' . ID_maincontent . '">' . _x('Direct naar de inleiding', 'Skiplinks', 'gebruikercentraal') . '</a></li>'; 

        if ( $goed_voorbeeld ) {
            $inlinelinks .= '<li><a href="#' . ID_goedvoorbeeld . '">' . __( "Voorbeelden", 'gebruikercentraal' ) . '</a></li>';
            $skiplinks .= '<li><a href="#' . ID_goedvoorbeeld . '">' . _x('Direct naar Goede Voorbeelden', 'Skiplinks', 'gebruikercentraal') . '</a></li>'; 
        }
        if ( $waaromwerktdit ) {
            $inlinelinks .= '<li><a href="#' . ID_waaromwerktdit . '">' . __( "Waarom werkt dit", 'gebruikercentraal' ) . '</a></li>';
            $skiplinks .= '<li><a href="#' . ID_waaromwerktdit . '">' . _x('Direct naar waarom werk dit?', 'Skiplinks', 'gebruikercentraal') . '</a></li>';
        }
        if ( $onderzoek ) {
            $skiplinks .= '<li><a href="#' . ID_onderzoek . '">' . _x('Direct naar onderzoek', 'Skiplinks', 'gebruikercentraal') . '</a></li>';
        }
        if ( $nuttigelinks ) {
            $inlinelinks .= '<li><a href="#' . ID_nuttigelinks . '">' .  __( "Links", 'gebruikercentraal' ) . '</a></li>';
            $skiplinks .= '<li><a href="#' . ID_nuttigelinks . '">' . _x('Direct naar nuttige links', 'Skiplinks', 'gebruikercentraal') . '</a></li>';
        }
        if ( $contactformulier && ( $contactformulier_tonen == 'ja' ) ) {
            $inlinelinks .= '<li><a href="#' . ID_reactieformulier . '">' .  __( "Vraag / reactie / suggestie", 'gebruikercentraal' ) . '</a></li>';
	        $skiplinks .= '<li><a href="#' . ID_reactieformulier . '">' . _x('Direct naar het reactieformulier', 'Skiplinks', 'gebruikercentraal') . '</a></li>'; 
        }



        if ( $inlinelinks ) {
            $inlinelinks = '<nav id="tip_inline_nav" class="menu js-menu"><button id="nav-primary-button"><span class="icon">&nbsp;</span><span class="label">' . __( "Menu", 'gebruikercentraal' ) . '</span></button><ul class="menu js-menu">' . $inlinelinks . '</ul></nav>';
        }
    }
    else {
	    $errormessage .= '<h2>' . __( "Plugin niet actief", 'gebruikercentraal' ) . '</h2><p>' . __( "De advanced custom field plugin (ACF) is niet actief op deze site.", 'gebruikercentraal' ) . '</p>';
    }
}



genesis();

 
