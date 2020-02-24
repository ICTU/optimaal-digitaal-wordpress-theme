<?php

///
// Optimaal Digitaal - common-functions.php
// ----------------------------------------------------------------------------------
// Gedeelde code tussen gebruiker-centraal en optimaal-digitaal
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 2.11.1
// @desc.   Contactinfo van tipgevers toegevoegd.
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme
///



//* Start the engine
//include_once( get_template_directory() . '/lib/init.php' );

// prepare for translation
load_child_theme_textdomain( 'gebruikercentraal', GC_FOLDER . '/languages' );


$errormessage = '';


//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );


// Geen footer
remove_action( 'genesis_footer', 'genesis_do_footer' );

$siteURL = get_stylesheet_directory_uri();
$siteURL =  preg_replace('|https://|i', '//', $siteURL );
$siteURL =  preg_replace('|http://|i', '//', $siteURL );


define( 'WBVB_THEMEFOLDER', $siteURL );


/**
* Constants
*/

define( 'ID_MAINCONTENT', 'maincontent' );
define( 'ID_MAINNAV', 'mainnav' );
define( 'ID_ZOEKEN', 'zoeken' );
define( 'ID_SKIPLINKS', 'skiplinks' );





//========================================================================================================

$padding = 16;

add_image_size( 'uitgelicht', ( 10 * $padding ), ( 10 * $padding ), false );



//========================================================================================================

add_filter( 'get_search_form', 'od_wbvb_add_id_to_search_form', 21 );


function od_wbvb_add_id_to_search_form( $form ) {

    $form = str_replace("<form", '<form tabindex="-1" id="' . ID_ZOEKEN . '" ', $form);

  return apply_filters( 'genesis_search_form', $form );

}

//========================================================================================================




add_filter( 'genesis_do_nav', 'od_wbvb_override_do_nav', 10, 3 );

function od_wbvb_override_do_nav($nav_output, $nav, $args) {

    if( 'primary' == $args['theme_location'] ) {

        $vind       = 'class="wrap"';
        $vervang    = 'tabindex="-1" id="' . ID_MAINNAV . '"';
        $hooiberg   = $nav_output;
        $nav_output = str_replace($vind, $vervang, $hooiberg);
    
    }

  return apply_filters( 'genesis_nav', $nav_output );
    
}


//========================================================================================================

/**
 * Adds "inner" id to the site-inner content/sidebar wrap element on HTML5 child themes.
 * Using inner, since Genesis uses this id when HTML5 is disabled.
 * @param  array $attributes Array of element attributes
 * @return array             Same array of element attributes with the id added
 */
function od_wbvb_theme_add_content_id( $attributes ) {
    $attributes['id'] = ID_MAINCONTENT;
    $attributes['tabindex'] = "-1";
    return $attributes;
}

add_filter( 'genesis_attr_site-inner', 'od_wbvb_theme_add_content_id', 15 );


//========================================================================================================
function showdebug($file = '', $extra = '') {

  if ( WP_THEME_DEBUG && WP_DEBUG ) {
    
    $break = Explode('/', $file);
    $pfile = $break[count($break) - 1]; 
    
    echo '<hr><span class="debugmessage" title="' . $file . '">' . $pfile;
    if ( $extra ) {
      echo ' - ' . $extra;
    }
    echo '<br/>R: ' . WP_THEME_DEBUG . ' / D: ' .  WP_DEBUG;
    echo '</span>';
  }
}


//========================================================================================================

function od_wbvb_deregister_styles() {
  
  // remove the event manager style sheet
  wp_dequeue_style('events-manager');
  wp_dequeue_style('em_enqueue_styles');
  
  // alle contact form 7 meuk, preventief
  wp_dequeue_style('contact-form-7');
  wp_dequeue_style('contact-form-7-rtl');
  
  // alle Buddypress meuk
  wp_dequeue_style('bp-legacy-css');
  wp_dequeue_style('bp-mentions-css');
  wp_dequeue_style('bp-admin-bar');
  
  // wordpress-social-login
  wp_dequeue_style('wsl-widget');

}

add_action( 'wp_enqueue_scripts', 'od_wbvb_deregister_styles', 100 );

//========================================================================================================

function od_wbvb_login_logo() { 

    if ( in_array( $_SERVER['PHP_SELF'], array( '/wp-login.php', '/wp-register.php' ) ) ){
      wp_enqueue_style( 'google-font-montserrat', '//fonts.googleapis.com/css?family=Montserrat', array(), CHILD_THEME_VERSION );
      wp_enqueue_style( 'login-form', get_stylesheet_directory_uri() . '/css/login-form.css', array(), CHILD_THEME_VERSION );
    }
}

add_action( 'login_enqueue_scripts', 'od_wbvb_login_logo' );


//========================================================================================================
/* image sizes
*/

function od_wbvb_add_defer_to_javascripts( $url )
{
    if ( is_admin() ) {
        return $url;
    }
    else {
        
        $huidigeurl = $_SERVER['REQUEST_URI'];
        
        if ( ( strpos( $huidigeurl, "group-avatar" ) > 0 )
                || ( strpos( $huidigeurl, "customize.php" ) > 0 ) 
                || ( strpos( $huidigeurl, "change-avatar" ) > 0 )  ){
            // vuige hack om te voorkomen dat ik buddypress moet herschrijven.
            // dit gaat om het croppen van een plaatje voor een ava.
            // zie: <buddypress>/bp-core/bp-core-cssjs.php
            // add_action( 'wp_head', 'bp_core_add_cropper_inline_js' );
    
            // geen defer toevoegen als we een avatar uploaden, dus:
            return $url;
        
        }
        else {
            if ( // comment the following line out add 'defer' to all scripts
        //        FALSE === strpos( $url, 'contact-form-7' ) or
                FALSE === strpos( $url, '.js' )
            )
            { // not our file
                return $url;
            }
    
            return "$url' defer='defer";
    
    
        }
    }


}

add_filter( 'clean_url', 'od_wbvb_add_defer_to_javascripts', 11, 1 );



//========================================================================================================
/*
Changing Genesis H1 Post Titles to H2
https://gist.github.com/nairnwebdesign/8157035
*/
 
//add_filter( 'genesis_post_title_output', 'od_wbvb_post_title_output', 15 );
 
function od_wbvb_post_title_output( $title ) {
//    if ( is_home() || is_archive() )

    if ( is_search() || is_archive() ) {
        $title = sprintf( '<h3><a href="' . get_permalink() . '">%s</a></h3>', apply_filters( 'genesis_post_title_text',get_the_title() ) );
    }
    else {
        $title = sprintf( '<h1><a href="' . get_permalink() . '">%s</a></h1>', apply_filters( 'genesis_post_title_text',get_the_title() ) );
    }
    return $title;
}


//========================================================================================================

/*
 * Modifying TinyMCE editor to remove unused items.
*/

function od_wbvb_admin_set_tinymce_options( $settings ) {
    $settings['theme_advanced_blockformats']  = 'p,h2,h3,h4,h5,h6,q,hr';
    $settings['theme_advanced_disable']       = 'underline,spellchecker,forecolor,justifyfull';
    $settings['theme_advanced_buttons2_add']  = 'styleselect';

    // ============
     
    $settings['toolbar1'] = 'italic,|,bullist,numlist,blockquote,|,link,unlink,|,spellchecker,|,formatselect,styleselect,paste,removeformat,cleanup,|,undo,redo,hr,fullscreen';
    $settings['toolbar2'] = '';
//    $settings['block_formats'] = 'Tussenkop niveau 2=h2;Tussenkop niveau 3=h3;Tussenkop niveau 4=h4;Paragraaf=p;Citaat=q';
//    $settings['block_formats'] = 'Header H2 =h2;Header H3=h3;Header H4=h4;Paragraph=p;Quote=q'; 

    $settings['style_formats'] = '[
            {title: "Streamer", block: "aside", classes: "pullquote"},
            {title: "Infoblok", block: "div", classes: "infoblock"},
    ]';

//        {title: "Interviewvraag", inline: "i", classes: "interview"}
    
    return $settings;
}
 
add_filter('tiny_mce_before_init', 'od_wbvb_admin_set_tinymce_options');

//========================================================================================================


//========================================================================================================

/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function od_wbvb_login_redirect( $redirect_to, $request, $user ) {
  //is there a user to check?
  global $user;
  if ( isset( $user->roles ) && is_array( $user->roles ) ) {
    //check for admins
    if ( in_array( 'administrator', $user->roles ) ) {
      // redirect them to the default place
      return $redirect_to;
    } else {
      return home_url();
    }
  } else {
    return $redirect_to;
  }
}

add_filter( 'login_redirect', 'od_wbvb_login_redirect', 10, 3 );
//========================================================================================================


add_filter( 'genesis_after', 'od_wbvb_add_piwik_code', 999 );

function od_wbvb_add_piwik_code() {


  if ( 'optimaaldigitaal.gebruikercentraal.nl' == $_SERVER["HTTP_HOST"] || 'www.optimaaldigitaal.nl' == $_SERVER["HTTP_HOST"]  || 'optimaaldigitaal.nl' == $_SERVER["HTTP_HOST"] ) { 
        echo '<!-- Piwik -->
      <script type="text/javascript">
      var _paq = _paq || [];
      _paq.push([\'trackPageView\']);
      _paq.push([\'enableLinkTracking\']);
      (function() {
      var u="//statistiek.rijksoverheid.nl/piwik/";
      _paq.push([\'setTrackerUrl\', u+\'/js/tracker.php\']);
      _paq.push([\'setSiteId\', 519]);
      var d=document, g=d.createElement(\'script\'), s=d.getElementsByTagName(\'script\')[0];
      g.type=\'text/javascript\'; g.async=true; g.defer=true; g.src=u+\'piwik.js\'; s.parentNode.insertBefore(g,s);
      })();
      </script>
      <noscript><p><img src="//statistiek.rijksoverheid.nl/piwik//js/tracker.php?idsite=519" style="border:0;" alt="" /></p></noscript>
      <!-- End Piwik Code -->​​';
    }
    else {
        if ( WP_DEBUG ) {
          echo '<!-- Geen Piwik: ' . $_SERVER["HTTP_HOST"] . '-->';
        }
    }
}


//========================================================================================================

/**
 * Default Category Title
 *
 * @author Bill Erickson
 * @url http://www.billerickson.net/default-category-and-tag-titles
 *
 * @param string $headline
 * @param object $term
 * @return string $headline
 */
function od_wbvb_be_default_category_title( $headline, $term ) {
  if( ( is_category() || is_tag() || is_tax() ) && empty( $headline ) )
    $headline = $term->name;
    
  return $headline;
}
add_filter( 'genesis_term_meta_headline', 'od_wbvb_be_default_category_title', 10, 2 );


//========================================================================================================

// 
/**
 * Get post excerpt by ID
 *
 * @url http://fullrefresh.com/2013/08/02/getting-a-wp-post-excerpt-outside-the-loop-updated/
 *
 * @param string $post_id
 * @param int $excerpt_length
 * @param bool $line_breaks
 * @return string $the_excerpt
 */

function od_wbvb_fr_excerpt_by_id($post_id, $excerpt_length = 35, $line_breaks = TRUE){

    //Gets post ID
    $the_post = get_post($post_id); 

    //Gets post_excerpt or post_content to be used as a basis for the excerpt
    $type           = get_post_type( $post_id );

    if ( 'post' == $type ) {
        $the_excerpt    = $the_post->post_excerpt ? $the_post->post_excerpt : $the_post->post_content; 
    }
    else if ( 'page' == $type ) {

        $the_excerpt    = $the_post->post_content; 
    }


    $the_excerpt    = apply_filters('the_excerpt', $the_excerpt);
    $the_excerpt    = $line_breaks ? strip_tags(strip_shortcodes($the_excerpt), '<p><br>') : strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
    $words          = explode(' ', $the_excerpt, $excerpt_length + 1);
    if ( count($words) > $excerpt_length ) :
        array_pop($words);
        array_push($words, '…');
        $the_excerpt = implode(' ', $words);
        $the_excerpt = $line_breaks ? $the_excerpt . '</p>' : $the_excerpt;
    endif;

    $the_excerpt = trim($the_excerpt);
    
    return $the_excerpt;
}


//========================================================================================================

function od_wbvb_remove_comment_fields($fields) {
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','od_wbvb_remove_comment_fields');

//========================================================================================================

add_filter( 'genesis_title_comments', 'od_wbvb_title_comments' );
function od_wbvb_title_comments() {
  $title = '<h2>' . __('Reacties','gebruikercentraal') . '</h2>';
  return $title;
}
//========================================================================================================

add_filter('cancel_comment_reply_link', 'od_wbvb_remove_cancel_reply_link', 10, 3);

function od_wbvb_remove_cancel_reply_link($formatted_link, $link, $text){
    return '';
}

//========================================================================================================

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'od_wbvb_remove_comment_form_allowed_tags' );

function od_wbvb_remove_comment_form_allowed_tags( $defaults ) {

  $commenter  = wp_get_current_commenter();
  $req        = get_option( 'require_name_email' );
  $aria_req   = ( $req ? ' required aria-required="true"' : '' );
  
  $defaults['title_reply'] = __('Reageer','gebruikercentraal');

  $defaults['comment_field']          = '<p class="comment-form-comment"><label for="comment">' . _x( 'Je reactie:', 'reactieformulier', 'gebruikercentraal' ) .    '</label><textarea id="comment" name="comment" cols="45" rows="8"' . $aria_req . '>' .    '</textarea></p>';

  $defaults['fields'] = array(

        'author' =>
            '<p class="comment author"><label for="author">' . _x( 'Je naam:', 'reactieformulier', 'gebruikercentraal' ) . '</label> ' .
            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
            '" size="30"' . $aria_req . ' /></p>',
        
        'email' =>
            '<p class="comment email"><label for="email">' . _x( 'Je mailadres:', 'reactieformulier', 'gebruikercentraal' ) . '</label> ' .
            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
            '" size="30"' . $aria_req . ' /></p>'
        );

  $defaults['must_log_in']            = '';
  $defaults['comment_notes_after']    = '';
  $defaults['comment_notes_before']   = '';
  $defaults['label_submit']           = __('Plaats reactie','gebruikercentraal');

  return $defaults;

}


//========================================================================================================


function od_wbvb_disable_bar_search() {  
    global $wp_admin_bar;  
    $wp_admin_bar->remove_menu('search');  
}  
add_action( 'wp_before_admin_bar_render', 'od_wbvb_disable_bar_search' );

//========================================================================================================

/**
 * Remove Genesis Page Templates
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/remove-genesis-page-templates
 *
 * @param array $page_templates
 * @return array
 */
function od_wbvb_be_remove_genesis_page_templates( $page_templates ) {

//    echo '<pre>';
//    var_dump($page_templates);
//    echo '</pre>';

  unset( $page_templates['page_archive.php'] );
  unset( $page_templates['page_blog.php'] );
  unset( $page_templates['404.php'] );
  return $page_templates;
}

add_filter( 'theme_page_templates', 'od_wbvb_be_remove_genesis_page_templates' );


//========================================================================================================
// HT: http://joshuadnelson.com/code/remove-genesis-entry-title-link/
add_filter( 'genesis_post_title_output', 'od_wbvb_custom_post_title' );


function od_wbvb_custom_post_title( $title ) {


  if( get_post_type( get_the_ID() ) == 'post' && ( !is_single() ) ) {
    $post_title = get_the_title( get_the_ID() );
    $title = '<h2 class="entry-title" itemprop="headline">' . $post_title . '</h2>';
  }

  return $title;

}


//========================================================================================================

//* Remove the post image (requires HTML5 theme support)

remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

//* Remove the edit link
add_filter ( 'genesis_edit_post_link' , '__return_false' );

//========================================================================================================
//* Display a custom Gravatar
add_filter( 'avatar_defaults', 'sp_gravatar' );
function sp_gravatar ($avatar) {
  $custom_avatar = WBVB_THEMEFOLDER . '/images/gravatar.png';
  $avatar[$custom_avatar] = "Custom Gravatar";
  return $avatar;
}


//========================================================================================================


//* Password reset activation E-mail -> Body
add_filter( 'retrieve_password_message', 'wpse_retrieve_password_message', 10, 2 );
function wpse_retrieve_password_message( $message, $key ){
    $user_data = '';
    // If no value is posted, return false
    if( ! isset( $_POST['user_login'] )  ){
            return '';
    }
    // Fetch user information from user_login
    if ( strpos( $_POST['user_login'], '@' ) ) {

        $user_data = get_user_by( 'email', trim( $_POST['user_login'] ) );
    } else {
        $login = trim($_POST['user_login']);
        $user_data = get_user_by('login', $login);
    }
    if( ! $user_data  ){
        return '';
    }
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    $hostname  = network_site_url();

    // Setting up message for retrieve password
    $message = '<p>' . _x( "Hallo,", 'begroeting inlogmail', 'gebruikercentraal' ) . '</p>';
    $message .= "\n\n";
    $message .= '<p>' . _x( "We kregen via de website het verzoek om een nieuw wachtwoord te sturen voor het account met de inlognaam:", 'inlogmail', 'gebruikercentraal' ) . '<br />';
    $message .= "\n<em>" . $user_login . "</em></p>";
    $message .= "\n\n";
    $message .= '<p>' . _x( "Om je wachtwoord opnieuw in te stellen, klik je op deze link:", 'inlogmail', 'gebruikercentraal' ) . '<br />';
    $message .= '<a href="';
    $message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login');
    $message .= '">';
    $message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login');
    $message .= "</a></p>\n\n";
    
    $message .= '<p>' . _x( "Deze link is maar 1 keer te gebruiken.", 'inlogmail', 'gebruikercentraal' ) . '<br />';
    $message .= "\n";
    $message .= _x( "Als je geen nieuw wachtwoord wilt, hoef je niets te doen.", 'inlogmail', 'gebruikercentraal' );
    $message .= "</p>";
    
    $message .= '<p>' . _x( "Met vriendelijke groet,", 'afsluiting inlogmail', 'gebruikercentraal' ) . "<br />";
    $message .= "\n";
    $message .=  _x( "het Gebruiker Centraal-team", 'afsluiting inlogmail', 'gebruikercentraal' ) . "</p>";
    $message .= "\n\n<a href=\"" . $hostname . "\">" . $_SERVER["HTTP_HOST"] . "</a><br />\n\n" . '<img src="' . $hostname . '/mailingassets/mailondertekening-meisje-gebruiker-centraal.png"/>';

    // Return completed message for retrieve password
    return $message;
    
}  



//========================================================================================================
  