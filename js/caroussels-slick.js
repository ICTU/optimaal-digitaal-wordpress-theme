
// Optimaal Digitaal caroussels-slick.js
// ----------------------------------------------------------------------------------
// code voor het initialiseren van de caroussel hupseflupsen op de filterpagina
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 2.6.1
// @desc.   Ter beoordeling: caroussel voor tipkaarten op filterpagina
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme



jQuery(document).ready(function( $ ) {

  doSlick(jQuery('#carousel-deel'));
  doSlick(jQuery('#carousel-digitaal-op-orde'));
  doSlick(jQuery('#carousel-draagvlak'));
  doSlick(jQuery('#carousel-goed-proces'));
  doSlick(jQuery('#carousel-kanaalsturing'));
  doSlick(jQuery('#carousel-creeer-intern-draagvlak'));
  doSlick(jQuery('#carousel-deel-en-werk-samen'));


  function doSlick(objectndinges) {
    objectndinges.slick({
  
    speed: 300,
    slidesToShow: 1,
    centerMode: false,
    variableWidth: true,
    infinite: false,
    dots: true,

     responsive: [
        {
          breakpoint: 600,
          settings: {
          dots: false,
          }
        },
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    
    });
    
  }
  
});