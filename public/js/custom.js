$( document ).ready( function() {
    // carousel init
    $('.carousel').carousel({
        interval: false,
        keyboard: false
    });

    // async google webfont init
    WebFontConfig = {
        google: { 
            families: [
                'Roboto: 100,300,400,700,900', 
                'Roboto Slab: 100,300,400,700'
            ] 
        },
        active: function() { $('html').trigger('wfactive'); }
    };

    (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                  '://ajax.googleapis.com/ajax/libs/webfont/1.5.6/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    })();

    // initialize Isotope
    var $container = $('#grid-items').isotope({
        itemSelector: '.grid-item',
        layoutMode: 'masonry',
    });

    // layout Isotope again after all images have loaded
    $container.imagesLoaded( function() {
        $container.isotope('layout');
    });

    // trigger Isotope when fonts have loaded
    $('html').on('wfactive', function() {
        $container.isotope('layout');
    });

    // bind filter button click
    $('#filters').on( 'click', 'button', function() {
        var filterValue = $( this ).attr('data-filter');
        $('#filters button').removeClass('active');
        $container.isotope({ filter: filterValue });
    });

    // scrollup button
    $(window).scroll(function () {
        if ( $(this).scrollTop() > 100 ) {
            $('#top-link-block').fadeIn();
        } else {
            $('#top-link-block').fadeOut();
        }
    });
    $('.to-top').on('click', function() {
        $('html,body').animate({ scrollTop: 0 }, 'slow', 'easeOutExpo');
        return false;
    });

    // smooth scroll
    $('a.smooth-scroll').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
            && location.hostname == this.hostname) 
        {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({ scrollTop: target.offset().top - 90 }, 'slow', 'easeOutExpo');
                return false;
            }
        }
    });

    // menu active
    $('#top-menu a').click(function() {
        $('#top-menu a').removeClass('active');
        $(this).addClass('active');
    })

    // collapse
    $('.collapse-btn').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var $collapse = $this.closest('p').find('.collapse-body');
        $collapse.toggle();
        $this.toggle();
    });

    // bootstrap delete confirmation
    $('.btn-confirm').confirmation();

    // login validation
    $('#form-login').validate({
        rules: {
            'login-username': {
                minlength: 3,
                maxlength: 20,
                required: true
            },
            'login-psw': {
                minlength: 6,
                maxlength: 72,                
                required: true
            }
        },
        errorElement: 'small',
        errorClass: 'text-danger',
        highlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').find('small')
                .removeClass(validClass).addClass(errorClass)
            ;
            $(element).closest('.form-group').removeClass('has-success')
                .addClass('has-error')
            ;
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').find('small')
                .removeClass(errorClass).addClass(validClass)
            ;
            $(element).closest('.form-group').removeClass('has-error')
                .addClass('has-success')
            ;
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    $('#login-btn').on('click', function() {
        $("#form-login").valid();
    });

    // register validation
    $('#form-register').validate({
        rules: {
            'register-username': {
                minlength: 3,
                maxlength: 20,
                required: true
            },
            'register-psw': {
                minlength: 6,
                maxlength: 72,                
                required: true
            },
            'register-psw2': {
                minlength: 6,
                maxlength: 72,                
                required: true,
                equalTo : "#register-psw"
            },
            'register-email': {
                email: true,                
                required: true
            }
        },
        errorElement: 'small',
        errorClass: 'text-danger',
        highlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').find('small')
                .removeClass(validClass).addClass(errorClass)
            ;
            $(element).closest('.form-group').removeClass('has-success')
                .addClass('has-error')
            ;
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').find('small')
                .removeClass(errorClass).addClass(validClass)
            ;
            $(element).closest('.form-group').removeClass('has-error')
                .addClass('has-success')
            ;
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    $('#register-btn').on('click', function() {
        $("#form-register").valid();
    });

    // forgot
    var spinnerEl = '<span class="spinner-icon"></span>'
    $('#forgot-btn').click( function(e) {
        var $form = $('#form-forgot');
        var name = $('#forgot-name').val();
        e.preventDefault();
        
        // bot
        if (name) {
            return;
        }

        // not a bot
        $form.fadeOut(600, 'easeOutExpo', function() {
            $('#forgot').append(spinnerEl);
            var url = '/forgot',
                postData = {
                    'method': 'forgot',
                    'params': {
                        'email': $('#login-username').val(),
                    }
                },
                posting = $.post(url, JSON.stringify(postData));
            
            posting.done( function(data) {
                $('.spinner-icon').remove();
                //window.location.href = "/";
            });
        });
    });    

    // google maps lazy load
    var element = $(this);
    var map;

    function initialize(myCenter) {
        var marker = new google.maps.Marker({
            position: myCenter,
            maxWidth: 200,
            maxHeight: 200
        });

        var mapProp = {
            center: myCenter,
            zoom: 18,
            //draggable: false,
            //scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var address = $('.street-address').text(),
            title = $('h1').text(),
            locality = $('.locality-locality').text(),
            region = $('.locality-region').text(),
            postal_code = $('.locality-postal-code').text(),
            info = '<p><strong>'+title+'</strong><p/><p>'+address+', '+locality
                +', '+region+', '+postal_code+'</p>';

        var var_infowindow = new google.maps.InfoWindow({
            content: info
        });

        google.maps.event.addListener(marker, 'click', function() {
          var_infowindow.open(map,marker);
        });

        map = new google.maps.Map(document.getElementById("map-canvas"), mapProp);

        marker.setMap(map);
    };
    $('#shop-modal').on('shown.bs.modal', function(e) {
        var element = $(e.relatedTarget);
        initialize(new google.maps.LatLng(43.7731522, 11.254480400000034));
        google.maps.event.trigger(map, 'resize');
    });
});