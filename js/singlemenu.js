
if ( 22 == 33 ) {

  (function(document, window, undefined) {
  
    'use strict';
    
    // Vars
  //  var header	= document.querySelector('.js-header');
    var menu 		= document.querySelector('ul.js-menu'),
      menuButton 	= document.querySelector('#nav-primary-button');
  
    // Button properties
  //  menuButton.classList.add('menu-button');
  //  menuButton.setAttribute('id', 'menu-button');
    menuButton.setAttribute('aria-label', 'Menu');
    menuButton.setAttribute('aria-expanded', 'false');
    menuButton.setAttribute('aria-controls', 'menu');
  //  menuButton.innerHTML = '<span aria-hidden="true">&#x2261;</span>';
    
    // Menu properties
    menu.setAttribute('aria-hidden', 'true');
    menu.setAttribute('aria-labelledby', 'menu-button');
    
    // Add button to page
  //  header.insertBefore(menuButton, menu);
  
    // Handle button click event
    menuButton.addEventListener('click', function () {
      
      // If active...
      if (menu.classList.contains('active')) {
        // Hide
        menu.classList.remove('active');
        menu.setAttribute('aria-hidden', 'true');
        menuButton.setAttribute('aria-expanded', 'false');
      } else {
        // Show
        menu.classList.add('active');
        menu.setAttribute('aria-hidden', 'false');
        menuButton.setAttribute('aria-expanded', 'true');
  
        // Set focus on first link
        menu.children[0].children[0].focus();
      }
    }, false);
    
  })(document, window);

}
