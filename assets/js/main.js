window.jQuery = window.$ = jQuery;

var $window = $(window), $body = $('body');

var App = {

    start : function() {

        "use strict";

        this.menus.start();

        this.bind();
        this.img_load();
        this.smart_resize();
        this.megamenu.start();
        this.header.start();
        this.masonry();

    },

    masonry: function() {

        $('.bw-masonry').imagesLoaded(function () {

            var $masonry = $( this.elements ).isotope({
                itemSelector: '.bw-masonry-item',
                isInitLayout: false,
                layoutMode: 'fitRows',
                masonry: {
                    columnWidth: '.bw-masonry-sizer',
                },
            });

            $masonry.isotope( 'on', 'layoutComplete', function( elements ) {

                $('.bw-masonry .bw-masonry-item:not(.bw-animate)').each(function(i) {
                    var self = $(this);
                    setTimeout(function() {
                        self.addClass('bw-animate');
                    }, i * 130 );
                });

            });

            $masonry.isotope();

            var $filter = $('.bw-filter');
            if( $filter ) {
                $filter.on('click', 'li', function() {
                    var self = $(this);
                    $('.bw-filter li').removeClass('bw-active');
                    self.addClass('bw-active');
                    $masonry.isotope({ filter: self.attr('data-filter') });
                });
            }

            // load more
            $(document).on('click', '.bw-load-more .bw-load-more-button', function(e) {

                e.preventDefault();

    			var $button = $(this).closest('.bw-load-more'),
    				$elements = $('.bw-masonry'),
    				url = $button.find('a').attr('href');

    			if( $button.hasClass('bw-ajaxing') || typeof url == 'undefined' ) { return; }

    			$button.addClass('bw-ajaxing');

    			$.get( url, function( response ) {

                    var $primary = $( response ).find('#primary'),
    					$_elements = $primary.find('.bw-masonry').children(),
    					$pagination = $primary.find('.bw-load-more');

                    $primary.find('.bw-masonry-item-large').removeClass('bw-masonry-item-large');

    				$_elements.imagesLoaded( function () {
    					$elements.isotope( 'insert', $_elements );
                        if( $pagination.find('a').length ) {
    					    $button.html( $pagination.html() );
                        }else{
    					    $button.html( '<span class="bw-load-more-empty">' + $pagination.attr('data-text-empty') + '</span>' );
                        }
    				});

    				//window.history.pushState( null, '', url );

                    $button.removeClass('bw-ajaxing');

    			});

    		});

            // re layout
            $(document).on('click', '.bw-view li', function() {

                var self = $(this), cols = self.attr('data-layout');

                $('.bw-view li').removeClass('bw-active');
                self.addClass('bw-active');

                $masonry.removeClass(function (index, className) {
                    return ( className.match (/(^|\s)bw-masonry-cols-\S+/g) || [] ).join(' ');
                }).addClass( cols );

                $masonry.isotope('layout');
                setTimeout(function() {
                    $masonry.isotope('layout');
                }, 160);

            });

        });

    },

    header: {

        position_offset: 0,

        start: function() {

            this.sticky();

        },

        sticky: function() {

            if( ! $body.hasClass('bw-is-header-sticky') ) { return; }

            if( $body.hasClass('pl-is-header-light') ) {
                if( $('#pl-outer .pl-row').length ) {
                    App.header.position_offset = $('#pl-outer .pl-row:first').outerHeight() - $('#masthead').outerHeight();
                }else if( $('.bw-page-header').length ) {
                    App.header.position_offset = $('.bw-page-header').outerHeight() - $('#masthead').outerHeight();
                }
            }

            App.header.sticky_calc( App.header.position_offset );
            $window.on('scroll', function() {
                App.header.sticky_calc( App.header.position_offset );
            });

        },

        sticky_calc: function( position_offset ) {

            var position = $window.scrollTop();

            if( position > position_offset ) {
                $body.addClass('bw-stick-header');
            }else{
                $body.removeClass('bw-stick-header');
            }

        }

    },

    megamenu: {

        timeout_hide_menu: [],

        start: function() {

            if( ! $('.bw-is-megamenu').length ) { return; }

            $('.bw-is-megamenu > a').on('mouseenter', function() {
                var $mega = $(this).closest('.bw-is-megamenu');
                var index = $('.bw-is-megamenu').index( $mega );
                $('.bw-is-megamenu').removeClass('bw-expand-megamenu');
                clearTimeout( App.megamenu.timeout_hide_menu[ index ] );
                $mega.addClass('bw-expand-megamenu');
                TweenLite.to( $mega.find('.bw-megamenu-outer:first'), .2, { height: $mega.find('.bw-megamenu:first').outerHeight(), ease: Power2.easeInOut } );
            });

            $('.bw-is-megamenu').on('mouseenter', function() {
                var index = $('.bw-is-megamenu').index( $(this) );
                clearTimeout( App.megamenu.timeout_hide_menu[ index ] );
            }).on('mouseleave', function() {
                var self = $(this);
                var index = $('.bw-is-megamenu').index( self );
                App.megamenu.timeout_hide_menu[ index ] = setTimeout(function() {
                    self.removeClass('bw-expand-megamenu');
                    TweenLite.to( self.find('.bw-megamenu-outer:first'), .2, { height: 0, ease: Power2.easeInOut } );
                }, 100);

            });;

        }



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

        // expand comments
        $('.bw-comment-toggle').on('click', function() {
            $('.bw-comment-inner').toggleClass('bw-visible');
        });

        // bind scroll back to the top button
        $(document).on('click', '.bw-back-top-outer', App.back_top);
        // bind scroll down button
        $(document).on('click', '.bw-scroll-down', App.scroll_down);

    },

    /*shareSocial: function(e) {

        "use strict";

        e.preventDefault();

        var left = ( screen.width - 640 ) / 2;
        var top = ( screen.height - 320 ) / 2.5;

        window.open( $(this).attr('href'), 'social_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no, top=' + top + ', left=' + left );

    },*/

    back_top: function() {

        TweenLite.to( window, .6, { scrollTo: 0, ease: Power3.easeInOut } );

    },

    scroll_down: function() {

        TweenLite.to( window, .6, { scrollTo: $(window).height(), ease: Power3.easeInOut } );

    },

    img_load: function() {

        "use strict";

        $(document).imagesLoaded(function() {

            // ..

        });

    },

    smart_resize: function() {

        "use strict";

        $(window).bind("debouncedresize", function() {

            App.header.position_offset = 0;

            if( $body.hasClass('pl-is-header-light') ) {
                App.header.position_offset = $('#pl-outer .pl-row:first').outerHeight() - $('#masthead').outerHeight();
            }

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
