<?php

///
// Optimaal Digitaal - page_citaatoverzicht.php
// ----------------------------------------------------------------------------------
// Toont alle citaten en citaatgevers in alle tips
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.1.2
// @desc.   Pagina-templates voor diverse functies toegevoegd.
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme
///

//* Template Name: Pagina met citaten  

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'fn_od_wbvb_tips_archive_cards_home_met_filterx' );

genesis();

//========================================================================================================

function fn_od_wbvb_tips_archive_cards_home_met_filterx() {

    $doetoevoeg = false;
//    $doetoevoeg = true;
    
    $args = array(
      'post_type' 		  => GC_TIP_CPT,
      'post_password'		=>	'',
      'numberposts'	    => -1,
			'posts_per_page' 	=>	-1,
    );

    
 
    
		// The Query
		$the_query = new WP_Query( $args );
		
		// The Loop
		if ( $the_query->have_posts() ) {

      echo '<h1>Alle tips en citaten</h1>';
      echo '<table>';

      $counter = 0;

      echo '<tr id="cell' . $counter . '">';

      echo '<th>ID</th>';
      echo '<th>Tip</th>';
      echo '<th>Citaat</th>';
      echo '<th>Tipgever</th>';
      echo '<th>Auteur</th>';
      echo '<th>Functie</th>';
      echo '</tr>';

			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				
				$tiptitel   = get_the_title();
				$tipid      = get_the_id();
        $tipnummer  = get_field('tip-nummer'); 
				$tiplink    = get_permalink();
        //  goed voorbeeldpermalink


//        if ( $counter > 20 ) {
//          break;
//        }

        if ( function_exists( 'get_field' ) ) {
          
          $goed_voorbeeld 	= get_field('goed_voorbeeld'); 
          $goed_voorbeeldcounter = 0;

          foreach( $goed_voorbeeld as $field_name => $value ) {
            
            $counter++;
            $goed_voorbeeldcounter++;

            $experts = $value[OD_CITAATAUTEUR . '_field'];

            echo '<tr id="cell' . $counter . '">';
            echo '<td>'. $counter . '&nbsp;/&nbsp;' . $goed_voorbeeldcounter . '</td>';
            echo '<td><a href="' . $tiplink . '">Tip ' . $tipnummer . '<br>'. $tiptitel . '</a></td>';
            echo '<td><p><strong>' . wp_strip_all_tags( $value['titel_goed_voorbeeld'] ) . '</strong></p> <p>' . wp_strip_all_tags( $value['tekst_goed_voorbeeld'] ) . '</p>';
            echo '</td>';
            echo '<td>';

            $naam         = sanitize_title( $value['voorbeeld-auteur-naam'] );


            if ( $experts && ( $experts[0] > 0 )  ) {

              $xpercounter = 0;              

              foreach ( $experts as $theterm ) {

                $xpercounter++;

                $thetermdata       = get_term( $theterm, OD_CITAATAUTEUR );

                if ( ! empty( $theterm ) && ! is_wp_error( $theterm ) ){
//                  echo 'neen';
                }
                else {
//                  echo 'ja';
//                  break;
                }

                $acfid          = OD_CITAATAUTEUR . '_' . $theterm;
                $image_tag      = '';
                
                $functietitel   = get_field( 'tipgever_functietitel', $acfid );
                if ( $functietitel ) {
                  $functietitel = '<br>' . $functietitel;
                }
                else {
                  $functietitel = '<br>geen functietitel ingevoerd';
                }
                
                $image  = get_field( 'tipgever_foto', $acfid );

                if ( $image ) {
                  $size   = 'thumbnail';
                  $thumb  = $image['sizes'][ $size ];
                  $width  = $image['sizes'][ $size . '-width' ];
                  $height = $image['sizes'][ $size . '-height' ];
                  $alt    = $image['alt'];
                  $image_tag = '<img src="' . $thumb . '" alt="' . $alt . '" width="' . $width . '" height="' . $height . '" class="alignleft" />';
                }                
                
                $tipgever_mail  = get_field( 'tipgever_mail', $acfid );
                if ( $tipgever_mail ) {
                  $tipgever_mail = '<br>' . $tipgever_mail;
                }
                else {
                  $tipgever_mail = '<br>geen mailadres ingevoerd';
                }
                
                $tipgever_foon  = get_field( 'tipgever_telefoonnummer', $acfid );
                if ( $tipgever_foon ) {
                  $tipgever_foon = '<br>' . $tipgever_foon;
                }
                else {
                  $tipgever_foon = '<br>geen telefoonnummer ingevoerd';
                }

                if ( $xpercounter == 1 ) {
                }
                else {
                  echo ', ';
                }
                
                if ( term_exists( $theterm , OD_CITAATAUTEUR ) ) {

                  $return = wp_set_post_terms( $tipid, $thetermdata->name, OD_CITAATAUTEUR, true );
                  
                  echo '<a href="' . get_term_link( $theterm, OD_CITAATAUTEUR ) . '">';
                  echo $thetermdata->name;
                  echo '</a>' . $functietitel . $tipgever_mail . $tipgever_foon . $image_tag . '</a>';
                }
                else {
                  echo 'Er stond een term genoteerd, maar die bestaaat niet meer: ' . $theterm . '. Deze wordt verwijderd.';
                  delete_sub_field( array( 'goed_voorbeeld', $goed_voorbeeldcounter, OD_CITAATAUTEUR . '_field' ) );
                }
              }              
            }
            else {
              
              // geen tipgevers gevonden voor dit citaat
              echo 'geen&nbsp;subexpert<br>';
              
              $thetermnew   = term_exists( $value['voorbeeld-auteur-naam'] , OD_CITAATAUTEUR );
              
              if ($thetermnew !== 0 && $thetermnew !== null && !is_wp_error( $thetermnew ) ) {
                
                // de tipgever staat wel in het systeem
                
                $theterm = get_term_by( 'slug', $naam, OD_CITAATAUTEUR );

                echo '<a href="' . get_term_link( $theterm->name, OD_CITAATAUTEUR ) . '">' . $theterm->name . '</a>';

                $return = wp_set_post_terms( $tipid, $naam, OD_CITAATAUTEUR, true );

                update_sub_field( array( 'goed_voorbeeld', $goed_voorbeeldcounter, OD_CITAATAUTEUR . '_field' ), $theterm->term_id );                  


              }
              else {
                
                // de tipgever bestaat niet
                echo "Skip: " . $value['voorbeeld-auteur-naam'] . '<br>';
                
                if ( substr( $value['voorbeeld-auteur-naam'], 0, 1 ) === "(" ) {
                  echo "Skip: " . $value['voorbeeld-auteur-naam'] . '<br>';
                }
                else {

                  echo "Bestaat niet: " . $value['voorbeeld-auteur-naam'] . '<br>';
  
                  if ( $doetoevoeg ) {
                    echo "Dus toevoegen<br>";
                                  
                    $args = array(
                      'parent'      => 0,
                      'slug'        => $naam,
                      'description' => '',
                      'alias_of'    => $naam
                    );

                    $return = wp_insert_term( $value['voorbeeld-auteur-naam'], OD_CITAATAUTEUR, $args ) ; 
  
                    if ( ! empty( $return ) && ! is_wp_error( $return ) ){
                      $acfid  = OD_CITAATAUTEUR . '_' . $return['term_id'];
                      $value  = update_field( 'tipgever_functietitel', $value['voorbeeld-auteur-functie'], $acfid );
                      echo 'Term toegevoegd.';
                    }
                  }
                  else {
                    echo "maar niet toevoegen<br>";
                  }
                }
              }
            }
            

            echo '</td>';

    				
    				if ( $value['voorbeeld-auteur-naam'] && $value['voorbeeld-auteur-functie'] ) {
              echo '<td>';
    	    			echo $value['voorbeeld-auteur-naam'] . '</td><td>' . $value['voorbeeld-auteur-functie'];
    				}
    				else if (  $value['voorbeeld-auteur-naam'] ) {
              echo '<td colspan="2">' . $value['voorbeeld-auteur-naam'];
    				}
    				else {
              echo '<td colspan="2">';
    				}
            echo '&nbsp;</td>';

            echo '</tr>';

          }
        }
			}

      echo '</table>';
			
		}
		else {
      echo '<h1>Geen tips gevonden</h1>';
		}
  
  
}

//========================================================================================================

