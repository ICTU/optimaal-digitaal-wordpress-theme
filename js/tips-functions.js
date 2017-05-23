
	document.getElementsByClassName = function(cl) {
		var retnode = [];
		var myclass = new RegExp('\\b'+cl+'\\b');
		var elem = this.getElementsByTagName('*');
	
		for (var i = 0; i < elem.length; i++) {
			var classes = elem[i].className;
			if (myclass.test(classes)) {
				retnode.push(elem[i]);
			}
		}
		return retnode;
	};


	function focusOnInput() {
		// zet de focus op het eerste invoerveld
		var jumpto = document.getElementById("your-name");
		jumpto.focus();

	}

	function jumptosuggestie() {
		// check alle links die verwijzen naar #reactieformulier 
		// en zorg dat de focus op het eerste veld daarin wordt gezet
		// als op de link geklikt wordt		
		var els = document.getElementsByTagName("a");
		for (var i = 0, l = els.length; i < l; i++) {
		    var el = els[i];
		    if ( el.href.indexOf('#reactieformulier') > 0 ) {
				el.addEventListener("click", function(event){ event.preventDefault(); });
				el.addEventListener("click", focusOnInput, false);
		    }
		}
	}


	function addLoadEvent(func) {
		var oldonload = window.onload;
		if (typeof window.onload !== 'function') {
			window.onload = func;
		} 
		else {
			window.onload = function() {
				oldonload();
				func();
			};
		}
	}
	addLoadEvent(jumptosuggestie);