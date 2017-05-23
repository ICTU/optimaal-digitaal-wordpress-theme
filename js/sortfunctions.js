
// Optimaal Digitaal sortfunctions.js
// ----------------------------------------------------------------------------------
// dit script zorgt voor de filtering aan de voorkant
// ----------------------------------------------------------------------------------
// @package optimaal-digitaal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 2.6.11
// @desc.   Small bug in JS for filterpage
// @link    https://github.com/ICTU/optimaal-digitaal-wordpress-theme

// ============================================================================================================================================
// http://codepen.io/patrickkunka/pen/KpVPWo
// To keep our code clean and modular, all custom functionality will be contained inside a single object literal called "multiFilter".

// http://www.quirksmode.org/js/cookies.html
function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function eraseCookie(name) {
	createCookie(name,"",-1);
}

var multiFilter = {
  
  // Declare any variables we will need as properties of the object
  
  $filterGroups: null,
  $filterUi: null,
  $resetbutton: null,
  groups: [],
  outputArray: [],
  outputString: '',
  
  // The "init" method will run on document ready and cache any jQuery objects we will need.
  
  init: function(){
    var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "checkboxFilter" object so that we can share methods and properties between all parts of the object.

  self.$filterUi		  = jQuery('#filter_tips');
  self.$filterGroups	= jQuery('.filter-group');
  self.$resetbutton 	= jQuery('.reset');
  self.$container 	  = jQuery('#cardflex_tab1');

  var now = new Date();
  now.setDate( now.getDate() + 1 );
  
  self.$cookieExpiration      = now.toUTCString();
  self.$cookieFilterKeyword   = 'js_keyword';
  self.$cookieCheckboxPrefix  = 'js_checkbox_';
  self.$cookieChecked         = 'js_checkbox_checked';
  

	self.$resetbutton.hide();
    
    self.$filterGroups.each(function(){
      self.groups.push({
        $inputs: jQuery(this).find('input'),
        active: [],
		    tracker: false
      });
    });

	window.addEventListener( 'keydown', function( ev ) {
		self.checkKeyboard(ev);
	});
    
    self.bindHandlers();
  },


  checkSavedSelection: function(){

    var self = this;
    var DoShowPreviousFilter  = false;
    var DoShowExtraFilter     = false;

    var cookieFilterKeyword  = readCookie(self.$cookieFilterKeyword);
    if (  !cookieFilterKeyword ) {
       // no cookie     
    }
    else {
      DoShowPreviousFilter    = true;
      DoShowExtraFilter       = true;
      self.$filterUi.find('input[type="search"]').val( cookieFilterKeyword );
    }

    // loop through each filter group and add active filters to arrays
    for(var i = 0, group; group = self.groups[i]; i++){
      
      group.active = []; // reset arrays
      group.$inputs.each(function(){
        var searchTerm      = '',
            $input			    = jQuery(this),
            theCookieID     = self.$cookieCheckboxPrefix + $input.attr('id'), 
            theCookieState  = readCookie(theCookieID);

        if ( theCookieState == self.$cookieChecked) {
          $input.prop('checked', true);
          $input.parent().addClass('active');
          DoShowPreviousFilter = true;
        }
        else {
          $input.removeAttr('checked');
  				$input.parent().removeClass('active');
        }
      });
    }

    if ( DoShowPreviousFilter ) {
      if ( DoShowExtraFilter ) {
    		jQuery( "#more_filters" ).show();
    		var lObjet = jQuery( "#toggle_more_filters" );
  			lObjet.text('minder filters');
  			lObjet.toggleClass('meer');
  			lObjet.toggleClass('minder');
      }
      self.parseFilters();
    }
  },

  
  // The "bindHandlers" method will listen for whenever a form value changes. 
  
  bindHandlers: function(){
    // console.log('Bind Handlers!');
    var self			    = this,
        typingDelay 	= 300,
        typingTimeout = -1,
        resetTimer 		= function() {
          //'.search'
          clearTimeout(typingTimeout);
          
          typingTimeout = setTimeout(function() {
            self.parseFilters();
          }, typingDelay);
        };
    
    self.$filterGroups
      .filter('.checkboxes')
    	.on('change', function() {
      	self.parseFilters();
    	});

    self.$filterGroups
      .filter('.search')
      .on('keyup change', resetTimer);
    
    self.$resetbutton.on('click', function(e){
  		e.preventDefault();
  		self.clearSelection();
  		self.$filterUi.find('.search').val('');
    });
  },
	checkKeyboard: function (ev) {
    var self = this, 
        currentThingy = jQuery(':focus');

    if( currentThingy.closest("#filter_tips").length > 0 ) {
        // alleen actief checken als we in de filter tips zitten    
      
//      console.log('knopppies drukken? ' + ev.which + ', type of current focus: ' + currentThingy.attr('type') );
      
      if (ev.which === 13) {
        // enter key
        
        if ( currentThingy.attr('type') === 'checkbox' ) {
        
          ev.preventDefault();
          
          if ( currentThingy.attr('type') === 'checkbox' ) {
            self.toggleCheckbox(ev);
          }
          
        }
        else if ( currentThingy.attr('type') === 'search' ) {
          // the input box for keyword filter
          ev.preventDefault();

        }
        else if ( currentThingy.attr('type') === 'button' ) {
        // do not ev.preventDefault();
        }
        else {
        // do not ev.preventDefault();
        }
        
      }
      // esc toets wordt al beluisterd door het menu
//      if (ev.which === 27) {
//        // esc key
//        ev.stopPropagation();
//        ev.preventDefault();
//        self.clearSelection();
//      }
    }

	},
  
  // The parseFilters method checks which filters are active in each group:


  clearSelection: function(){
    var self = this;
      self.$filterUi.find('input[type="search"]').val('');

    eraseCookie(self.$cookieFilterKeyword);

		for(var i = 0, group; group = self.groups[i]; i++){
			group.$inputs.each(function(){
				var $input = jQuery(this);
				
				$input.parent().removeClass('active');
				
				if ($input.is(':checked')) {
					$input.removeAttr('checked');
				}

        eraseCookie(self.$cookieCheckboxPrefix + $input.attr('id'));

			});
		}
    self.parseFilters();
    // focus op eerste checkbox    
    jQuery("#filter_tips input[type=checkbox]:first").focus(); 
	},

	toggleCheckbox: function(ev){
    var self = this,
        currentThingy = jQuery( document.activeElement );

    if ( currentThingy.attr('type') === 'checkbox' ) {
      
      if ( currentThingy.is(':checked') ) {
        currentThingy.prop( "checked", false );
      }
      else {
        currentThingy.prop( "checked", true );
      }
    }
		self.parseFilters();
	},

  
  parseFilters: function(){
    var self = this;
    // console.log("parsing!");
 
    // loop through each filter group and add active filters to arrays
    
    for(var i = 0, group; group = self.groups[i]; i++){
      group.active = []; // reset arrays
      group.$inputs.each(function(){
        var searchTerm		= '',
			$input			= jQuery(this),
			minimumLength	= 3;

			$input.parent().removeClass('active');

      var theCookieID     = self.$cookieCheckboxPrefix + $input.attr('id');
      var theCookieState  = '';
        
			if ($input.is(':checked')) {
        theCookieState  = self.$cookieChecked;
        $input.parent().addClass('active');
        group.active.push(this.value);
			}

      createCookie(theCookieID,theCookieState,1);

        if ($input.is('[type="search"]') && this.value.length >= minimumLength) {
          searchTerm = this.value
            .trim()
            .toLowerCase()
            .replace(' ', '-');
          // console.log("Le search term: " + searchTerm);

          createCookie(self.$cookieFilterKeyword,searchTerm,1);

          group.active[0] = '[data-titel*="' + searchTerm + '"]'; 
        }
        else {

          eraseCookie(self.$cookieFilterKeyword);
          
        }
      });
	    group.active.length && (group.tracker = 0);
    }
    
    self.concatenate();
  },
  
  // The "concatenate" method will crawl through each group, concatenating filters as desired:
  
  concatenate: function(){

    // console.log("concatenating!");

    var self = this,
		cache = '',
		crawled = false,
		checkTrackers = function(){
			var done = 0;
			
			for(var i = 0, group; group = self.groups[i]; i++){
				(group.tracker === false) && done++;
			}
			
			return (done < self.groups.length);
		},
		crawl = function(){
			for(var i = 0, group; group = self.groups[i]; i++){
				group.active[group.tracker] && (cache += group.active[group.tracker]);
				
				if(i === self.groups.length - 1){
					self.outputArray.push(cache);
					cache = '';
					updateTrackers();
				}
			}
		},
		updateTrackers = function(){
			for(var i = self.groups.length - 1; i > -1; i--){
				var group = self.groups[i];
				
				if(group.active[group.tracker + 1]){
					group.tracker++; 
					break;
				}
				else if(i > 0){
					group.tracker && (group.tracker = 0);
				}
				else {
					crawled = true;
				}
			}
		};

	self.outputArray = []; // reset output array
	
	do{
		crawl();
	}
	while(!crawled && checkTrackers());

	self.outputString = self.outputArray.join();
    
    // If the output string is empty, show all rather than none:
    
    if ( !self.outputString.length && (self.outputString = 'all') ) {
  		self.$resetbutton.hide();
    }
    else {
  		self.$resetbutton.show();
    }


    // If the output string is empty, show all rather than none:
    // console.log('outputString: ' + self.outputString); 
    
    // ^ we can check the console here to take a look at the filter string that is produced
    
    // Send the output string to MixItUp via the 'filter' method:
  	if( self.$container.mixItUp('isLoaded') ){
    	// console.log("Is Loaded");
  		self.$container.mixItUp('filter', self.outputString);
  	}
  	else {
    	// console.log("NOT Loaded");
  	}
  }
};


// On document ready, initialise our code.

jQuery(function(){


	jQuery( "#more_filters" ).toggle();

	
	jQuery( "#toggle_more_filters" ).click( function() {
		jQuery( "#more_filters" ).toggle();
		var lObjet = jQuery( "#toggle_more_filters" );

		if ( lObjet.text() === 'minder filters' ) {
			lObjet.text('meer filters');
			lObjet.toggleClass('meer');
			lObjet.toggleClass('minder');
		}
		else {
			lObjet.text('minder filters');
			lObjet.toggleClass('meer');
			lObjet.toggleClass('minder');
		}

	});

      
  // Initialize multiFilter code
  multiFilter.init();

	var theLabelTekst = jQuery('.filtercounter').text();

      
  jQuery('#cardflex_tab1').mixItUp({
    controls: {
      enable: false // we won't be needing these
    },
    selectors: {
      target: 'div.containstip'
    },
    animation: {
      duration: 400,
      effects: 'translateZ(-360px) stagger(34ms) fade',
      easing: 'ease'
    },
    callbacks: {
      onMixStart: function(state, futureState){
        jQuery('.filtercounter').text('');
        jQuery('.filtertotal').text('');
        jQuery('.reset').hide();
        multiFilter.checkSavedSelection();
      },
      onMixEnd: function(state){
        if ( state.totalShow !== state.totalTargets ) {
          jQuery('.filtercounter').text(theLabelTekst + ' ' + state.totalShow + ' van ' + state.totalTargets);
          jQuery('.reset').show();
        }
      }	
    }
  });    
});
