// Expose jQuery to the global object
window.jQuery = window.$ = jQuery;

// main object
var BwAdmin = {
    init: function() {

        BwAdmin.guide.start();

        BwAdmin.ajaxQueue();

        BwAdmin.importDemo.start();

        BwAdmin.bw_gallery_advanced.init();

        BwAdmin.bw_on_off_button();

        BwAdmin.acf_radio_image();

        BwAdmin.acf_number_slider();

        //BwAdmin.on_template_switch();

    },

    guide: {

        start: function() {

            if( ! $('#bwg').length ) { return; }

            BwAdmin.guide.bind();
            BwAdmin.guide.hashActive();

        },

        bind: function() {

            $('#bwg').on( 'click', '.bwg-tabs-list li', BwAdmin.guide.tabClick );
            $('#bwg').on( 'click', '#bwg-do-child', BwAdmin.guide.ajax.child );
            $('#bwg').on( 'click', '#bwg-do-updates_envato', BwAdmin.guide.ajax.updatesEnvato );
            $('#bwg').on( 'click', '#bwg-do-updates_peenapo', BwAdmin.guide.ajax.updatesPeenapo );
            $('#bwg').on( 'click', '#bwg-do-google-key', BwAdmin.guide.ajax.googleKey );
            $('#bwg').on( 'click', '#bwg-do-import', BwAdmin.importDemo.doTheImport );
            $('#bwg').on( 'mouseenter', '.bwg-tabs-list .bwg-dummy', BwAdmin.guide.tabMessageIn );
            $('#bwg').on( 'mouseleave', '.bwg-tabs-list .bwg-dummy', BwAdmin.guide.tabMessageOut );

        },

        tabMessageIn: function() {
            $('#bwg-message-codes').addClass('bwg-visible');
        },

        tabMessageOut: function() {
            $('#bwg-message-codes').removeClass('bwg-visible');
        },

        ajax: {

            import: function(e) {

                e.preventDefault();

            },

            googleKey: function(e) {

                e.preventDefault();

                $.ajax({
                    type: "post", url: bw_admin_vars.ajax,
                    data: {
                        action: '__call_guide_google_key',
                        api_key: $('#bwg-input-google-key-form input[name="api_key"]').val(),
                        security: bw_admin_vars.nonce
                    },
                    beforeSend: function() {
                        $('#bwg').addClass('bwg-ajaxing');
                    },
                    complete: function() {
                        $('#bwg').removeClass('bwg-ajaxing');
                    },
                    success: function( response ) {

                        var $alert = $('#bwg .bwg-tabs-content li.bwg-active .bwg-alert');

                        if( response.data.can_request ) {
                            $alert.addClass('bwg-alert-success');
                        }else{
                            $alert.removeClass('bwg-alert-success');
                        }

                        $alert.find('strong').html( response.data.request_label );

                    }
                });

            },

            updatesEnvato: function(e) {

                e.preventDefault();

                $.ajax({
                    type: "post", url: bw_admin_vars.ajax,
                    data: {
                        action: '__call_guide_updates_envato',
                        token: $('#bwg-input-token-form input[name="token"]').val(),
                        security: bw_admin_vars.nonce
                    },
                    beforeSend: function() {
                        $('#bwg').addClass('bwg-ajaxing');
                    },
                    complete: function() {
                        $('#bwg').removeClass('bwg-ajaxing');
                    },
                    success: function( response ) {

                        var $alert = $('#bwg .bwg-tabs-content li.bwg-active .bwg-alert');

                        if( response.data.can_request ) {
                            $alert.addClass('bwg-alert-success');
                        }else{
                            $alert.removeClass('bwg-alert-success');
                        }

                        $alert.find('strong').html( response.data.request_label );

                    }
                });

            },

            updatesPeenapo: function(e) {

                e.preventDefault();

                $.ajax({
                    type: "post", url: bw_admin_vars.ajax,
                    data: {
                        action: '__call_guide_updates_peenapo',
                        username: $('#bwg-input-token-form input[name="username"]').val(),
                        security: bw_admin_vars.nonce
                    },
                    beforeSend: function() {
                        $('#bwg').addClass('bwg-ajaxing');
                    },
                    complete: function() {
                        $('#bwg').removeClass('bwg-ajaxing');
                    },
                    success: function( response ) {

                        var $alert = $('#bwg .bwg-tabs-content li.bwg-active .bwg-alert');

                        if( response.data.can_request ) {
                            $alert.addClass('bwg-alert-success');
                        }else{
                            $alert.removeClass('bwg-alert-success');
                        }

                        $alert.find('strong').html( response.data.request_label );

                    }
                });

            },

            child: function() {

                var self = $(this);

                $.ajax({
                    type: "post", url: bw_admin_vars.ajax,
                    data: {
                        action: '__call_guide_child',
                    },
                    beforeSend: function() {
                        $('#bwg').addClass('bwg-ajaxing');
                    },
                    complete: function() {
                        $('#bwg').removeClass('bwg-ajaxing');
                    },
                    success: function() {

                        var $alert = $('#bwg .bwg-tabs-content li.bwg-active .bwg-alert');
                        $alert.addClass('bwg-alert-success').find('strong').html( $alert.find('strong').attr('data-complete') );
                        self.removeAttr('id').removeClass('button-primary').attr('disabled', 'disabled').html( self.attr('data-complete') );

                    }
                });

            }

        },

        hashActive: function() {
            var hash = window.location.hash;
            if( hash ) {
                $('#bwg .bwg-tabs-list > li[data-hash="' + hash.replace('#', '') + '"]').trigger('click');
            }
        },

        tabClick: function() {

            var self = $(this);

            if( self.hasClass('bwg-dummy') ) { return; }

            $('#bwg .bwg-tabs-list > li').removeClass('bwg-active');
            self.addClass('bwg-active');

            var index = $('#bwg .bwg-tabs-list > li').index(self);
            $('#bwg .bwg-tabs-content > li').removeClass('bwg-active').eq(index).addClass('bwg-active');

            var hash = self.attr('data-hash');
            if( typeof hash !== 'undefined' ) {
                window.location.hash = hash;
            }

        }

    },

    ajaxQueue: function() {

        if( typeof bw_admin_vars !== 'undefined' ) {
            //this is the ajax queue
            BwAdmin.qInst = $.qjax({
                timeout: 3000,
                ajaxSettings: {
                    //Put any $.ajax options you want here, and they'll inherit to each Queue call, unless they're overridden.
                    type: "POST",
                    url: bw_admin_vars.ajax,
                },
                onStop: function(res) {
                    //stop everything on error
                    BwAdmin.importInfo( 'Finito!' );

                    var $alert = $('#bwg .bwg-tabs-content li.bwg-active .bwg-alert');

                    $alert.addClass('bwg-alert-success');

                    $alert.find('strong').html( $alert.find('strong').attr('data-complete') );

                    $('#bwg-do-import').html( $('#bwg-do-import').attr('data-imported') );

                    $('#bwg-import-results .bwg-palert').remove();
                }
            });
        }

    },

    importDemo: {

        start: function() {

            BwAdmin.importDemo.bind();

        },

        bind: function() {

            $('#bw-import-content').on('click', '.bw-demo-choices li', BwAdmin.importDemo.demoClick);

            $('#bw-import-content').on('click', '.bw-import-posts-result-toggle', function() {
                $(this).closest('li').find('.bw-import-posts-result').toggleClass('bw-visible');
            });

            $('#bwg-do-import').on('click', function(e) {
                e.preventDefault();
            });

        },

        demoClick: function() {

            $('.bw-demo-choices li').removeClass('bw-active');
            $(this).addClass('bw-active');
            $('#bwg-do-import').html( $('#bwg-do-import').attr('data-active') ).removeAttr('disabled');

        },

        doTheImport: function(e) {

            e.preventDefault();

            var $import = $('#bw-import-content');

            if( $('.bw-demo-choices li.bw-active').length == 0 ) {
                alert( $('#bwg-do-import').html() ); return;
            }

            if( typeof $(this).attr('disabled') !== 'undefined' ) { return; }

            $('#bwg-do-import').html( $('#bwg-do-import').attr('data-importing') ).attr('disabled', 'disabled');
            $('#bwg-import-results').removeClass('bwg-hidden');

            BwAdmin.importMessageStop = 0;
            BwAdmin.importInfo('Start importing demo content..');

            var demo_index = $('.bw-demo-choices li').index( $('.bw-demo-choices li.bw-active') ) + 1;

            var importCalls = {
                1 : {'action' : '__call_import_theme_options',      'message' : 'Importing theme options..'},
                2 : {'action' : '__call_import_sample_data_part_1',        'message' : 'Importing posts part 1..<span class="bw-import-posts-result-toggle bw-import-parts_part_1"></span>'},
                3 : {'action' : '__call_import_sample_data_part_2',        'message' : 'Importing posts part 2..<span class="bw-import-posts-result-toggle bw-import-parts_part_2"></span>'},
                4 : {'action' : '__call_import_sample_data_part_3',        'message' : 'Importing posts part 3..<span class="bw-import-posts-result-toggle bw-import-parts_part_3"></span>'},
                5 : {'action' : '__call_import_menus',              'message' : 'Assigning menus..'},
                6 : {'action' : '__call_import_static_pages',       'message' : 'Assigning static pages..'},
                7 : {'action' : '__call_import_permalink_format',   'message' : 'Assigning permalink format..'},
                8 : {'action' : '__call_import_custom_post_meta',   'message' : 'Importing custom post meta..'},
                9 : {'action' : '__call_import_custom_options',     'message' : 'Importing custom options..'},
                10 : {'action' : '__call_import_was_done',          'message' : 'Importing was done..'},
            };

            for ( var key in importCalls ) {
                BwAdmin.qInst.Queue({
                    data: {
                        'action': importCalls[key]['action'],
                        'demo_index': demo_index
                    },
                    beforeSend: function() {

                        BwAdmin.importInfo( importCalls[ BwAdmin.importMessageStop ]['message'] );

                    },
                    complete: function() {

                    },
                    success: function( response ) {

                        if( typeof response.importer_result !== 'undefined' ) {
                            $('.bw-import-posts-result-toggle.bw-import-parts' + response.part).html(' View report.').after('<div class="bw-import-posts-result">' + response.importer_result + '</div>');
                        }

                    }
                });
            }

        }
    },

    importInfo: function( message ) {
        ++BwAdmin.importMessageStop;
        console.log(message);
        $('#bwg-import-results ul').append('<li>' + message + '</li>');
    },

    acf_number_slider: function() {

        $('.acf-slider-wrap').each(function() {

            var self = $(this),
                    $label = $(".acf-slider-label strong", self),
                    $input = $("input", self),
                    $slider = $(".acf-slider", self);

            $(".acf-slider", self).slider({
                range: 'min',
                value: ($input.val() > 0) ? parseInt($input.val()) : 0,
                min: ($input.attr('min') > 0) ? parseInt($input.attr('min')) : 0,
                max: ($input.attr('max') > 0) ? parseInt($input.attr('max')) : 100,
                step: ($input.attr('step') > 0) ? parseInt($input.attr('step')) : 1,
                slide: function(event, ui) {
                    $label.html(ui.value);
                    $input.val(ui.value);
                }
            });
            //$slider.slider( "value", $input.val() );
            $label.html($slider.slider("value"));
            $input.val($slider.slider("value"));

        });

    },

    acf_radio_image: function() {

        $(document).on('click', '.acf-radio-image', function() {
            var $radioList = $(this).closest('.acf-radio-list');
            $('.acf-radio-image', $radioList).removeClass('active');
            $(this).addClass('active');
        });

        $('.acf-radio-image').each(function() {
            self = $(this);
            if (self.find('input[type="radio"]').is(':checked')) {
                self.addClass('active');
            }
        });

    },

    acf_check_radio_image: function() {

        $('.acf-radio-image').each(function() {
            self = $(this);
            if (self.find('input[type="radio"]').is(':checked')) {
                self.addClass('active');
            }
        });

    },

    bw_on_off_button: function() {

        BwAdmin.bw_check_on_off();

        $(document).on("click", ".bw-on-off", function() {

            if ($(this).find('input').is(':checked')) {
                $(this).addClass('checked');
            } else {
                $(this).removeClass('checked');
            }

        });

    },

    bw_check_on_off: function() {

        $(".bw-on-off").each(function() {

            var $label = $(this);

            if ($label.find("input").is(":checked")) {
                $label.addClass("checked");
            }

        });

    },

    bw_gallery_advanced: {

        init: function() {

            BwAdmin.bw_gallery_advanced.create();

            if ($('.bw-gallery-advanced').length > 0) {
                BwAdmin.bw_gallery_advanced.get_preview();
            }

        },

        create: function() {

            var $addItem = $('.bw-gallery-advanced .add-items');

            if ($addItem.length > 0) {

                var frame = wp.media({
                    displaySettings: false,
                    id: 'bwgallery-frame',
                    title: 'BwGallery',
                    filterable: 'uploaded',
                    frame: 'post',
                    state: 'gallery-edit',
                    library: {type: 'image'},
                    multiple: true, // Set to true to allow multiple files to be selected
                    editing: true,
                    selection: BwAdmin.bw_gallery_advanced.select()
                });

                $addItem.on('click', function(e) {

                    e.preventDefault();

                    frame.on('update', function() {

                        var controller = frame.states.get('gallery-edit');
                        var library = controller.get('library');
                        var ids = library.pluck('id');

                        $('.bw-gallery-advanced .gallery-ids').val(ids.join(','));

                        var items = "";

                        for (var i = 0; i < ids.length; i++) {
                            items += "<li><div class='item'>" + ids[i] + "</div></li>";
                        }

                        $('.bw-gallery-advanced .items').html(items);

                        BwAdmin.bw_gallery_advanced.get_preview();

                    });

                    frame.open();

                });
            }
        },

        get_preview: function() {

            var $gallery = $('.bw-gallery-advanced');
            ids = $('.gallery-ids', $gallery).val();

            $('.bw-gallery-advanced').removeClass('loaded');

            $.ajax({
                type: "post", url: bw_admin_vars.ajax,
                data: {
                    action: '__call_gallery_preview',
                    attachments_ids: ids,
                    field_key: $('.gallery-field', $gallery).val(),
                    post_id: $('.gallery-post', $gallery).val(),
                    field_name: $gallery.closest('.field').attr('data-field_name'),
                    enabled_advanced: $('.bw-gallery-advanced').hasClass('enabled-advanced'),
                },
                beforeSend: function() {
                },
                complete: function() {
                },
                success: function(response) {

                    var result = JSON.parse(response);
                    if (result.success) {
                        $('.bw-gallery-advanced .welcome').remove();
                        $('.bw-gallery-advanced .items').html(result.output);
                    }

                    if (!result.success && !$('.bw-gallery-advanced .items li').length) {
                        $('.bw-gallery-advanced').append('<p class="welcome"><i class="bwpb-7s-photo"></i>Create your gallery by clicking the button above "Edit gallery".</p>');
                    }
                    setTimeout(function() {
                        $('.bw-gallery-advanced').addClass('loaded');
                    }, 100);

                }
            });

        },

        select: function() {
            var galleries_ids = $('.bw-gallery-advanced .gallery-ids').val(),
                shortcode = wp.shortcode.next('gallery', '[gallery ids="' + galleries_ids + '"]'),
                defaultPostId = wp.media.gallery.defaults.id,
                attachments, selection;
            // Bail if we didn't match the shortcode or all of the content.
            if (!shortcode)
                return;

            // Ignore the rest of the match object.
            shortcode = shortcode.shortcode;

            // no images, return false
            if ( shortcode.get('ids') == '' ) {
                return;
            }

            if (_.isUndefined(shortcode.get('id')) && !_.isUndefined(defaultPostId))
                shortcode.set('id', defaultPostId);

            attachments = wp.media.gallery.attachments(shortcode);
            selection = new wp.media.model.Selection(attachments.models, {
                props: attachments.props.toJSON(),
                multiple: true
            });

            selection.gallery = attachments.gallery;

            // Fetch the query's attachments, and then break ties from the
            // query to allow for sorting.
            selection.more().done(function() {
                // Break ties with the query.
                selection.props.set({query: false});
                selection.unmirror();
                selection.props.unset('orderby');
            });

            return selection;
        }

    },
};

// call main object on document ready
$(document).ready(function() {
    BwAdmin.init();
});
