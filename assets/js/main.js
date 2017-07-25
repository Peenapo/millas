window.jQuery = window.$ = jQuery;

var $window = $(window), $body = $('body');

var App = {

    start : function() {

        "use strict";

        this.menus.start();

        this.bind();
        this.imgLoad();
        this.smartResize();

    },

    /*
    * Handles toggling the navigation menu for small screens and enables TAB key
    * navigation support for dropdown menus.
    */
    menus: {

        start: function() {

            var container, button, menu, links, i, len;

        	container = document.getElementById('site-navigation');

        	if ( ! container ) { return; }

        	button = container.getElementsByTagName('button')[0];
        	if ( typeof button === 'undefined' ) { return; }

        	menu = container.getElementsByTagName('ul')[0];

        	// Hide menu toggle button if menu is empty and return early.
        	if ( 'undefined' === typeof menu ) {
        		button.style.display = 'none';
        		return;
        	}

        	menu.setAttribute( 'aria-expanded', 'false' );
        	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
        		menu.className += ' nav-menu';
        	}

        	button.onclick = function() {
        		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
        			container.className = container.className.replace( ' toggled', '' );
        			button.setAttribute( 'aria-expanded', 'false' );
        			menu.setAttribute( 'aria-expanded', 'false' );
        		} else {
        			container.className += ' toggled';
        			button.setAttribute( 'aria-expanded', 'true' );
        			menu.setAttribute( 'aria-expanded', 'true' );
        		}
        	};
        	// Get all the link elements within the menu.
        	links = menu.getElementsByTagName( 'a' );

        	// Each time a menu link is focused or blurred, toggle focus.
        	for ( i = 0, len = links.length; i < len; i++ ) {
        		links[i].addEventListener( 'focus', App.menus.toggleFocus, true );
        		links[i].addEventListener( 'blur', App.menus.toggleFocus, true );
        	}
            App.menus.subMenuAccess( container );
        },

        /**
    	 * Sets or removes .focus class on an element.
    	 */
    	toggleFocus: function() {
            var self = this;
    		// Move up through the ancestors of the current link until we hit .nav-menu.
    		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {
    			// On li elements toggle the class .focus.
    			if ( 'li' === self.tagName.toLowerCase() ) {
    				if ( -1 !== self.className.indexOf( 'focus' ) ) {
    					self.className = self.className.replace( ' focus', '' );
    				} else {
    					self.className += ' focus';
    				}
    			}
    			self = self.parentElement;
    		}
    	},

        subMenuAccess: function( container ) {

            var touchStartFn, i, parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

            if ( 'ontouchstart' in window ) {
                touchStartFn = function( e ) {
                    var menuItem = this.parentNode, i;

                    if ( ! menuItem.classList.contains( 'focus' ) ) {
                        e.preventDefault();
                        for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
                            if ( menuItem === menuItem.parentNode.children[i] ) {
                                continue;
                            }
                            menuItem.parentNode.children[i].classList.remove( 'focus' );
                        }
                        menuItem.classList.add( 'focus' );
                    } else {
                        menuItem.classList.remove( 'focus' );
                    }
                };

                for ( i = 0; i < parentLink.length; ++i ) {
                    parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
                }
            }
        }
    },

    bind: function() {

        "use strict";

        // disable empty url\'s
        $(document).on('click', 'a[href="#"]', function(e) {
            e.preventDefault();
        });

        // share articles popup in a popup
        //if( ! bw_theme_vars.is_mobile ) {
            //$('.bw-add-share').on('click', App.shareSocial);
        //}

        // bind scroll down button
        $(document).on('click', '.bw-scroll-down', App.scrollDown);

    },

    /*shareSocial: function(e) {

        "use strict";

        e.preventDefault();

        var left = ( screen.width - 640 ) / 2;
        var top = ( screen.height - 320 ) / 2.5;

        window.open( $(this).attr('href'), 'social_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no, top=' + top + ', left=' + left );

    },*/

    scrollDown: function() {

        TweenLite.to( window, .6, { scrollTo: $(window).height(), ease: Power3.easeInOut } );

    },

    imgLoad: function() {

        "use strict";

        $(document).imagesLoaded(function() {

            // ..

        });

    },

    smartResize: function() {

        "use strict";

        $(window).bind("debouncedresize", function() {

            // ..

        });

    },

    waypoints: function() {

        "use strict";

        /*$('.bw-example').waypoint( function( direction ) {
            var el = this.element;
            $(el).addClass('bw-animated');
            this.destroy();
        }, { offset: '80%' });*/

    }

};

App.start();
