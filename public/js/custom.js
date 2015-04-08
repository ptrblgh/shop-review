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
            'login_username': {
                minlength: 3,
                maxlength: 20,
                required: true
            },
            'login_psw': {
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
        if ($("#form-login").valid()) {
            $("#form-login").submit();
        }
    });

    // register validation
    $('#form-register').validate({
        rules: {
            'register_username': {
                minlength: 3,
                maxlength: 20,
                required: true
            },
            'register_psw': {
                minlength: 6,
                maxlength: 72,                
                required: true
            },
            'register_psw2': {
                minlength: 6,
                maxlength: 72,                
                required: true,
                equalTo : "#register-psw"
            },
            'register_email': {
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
        }
    });
    $('#register-btn').on('click', function() {
        if ($("#form-register").valid()) {
            $("#form-register").submit();
        }
    });

    // forgot validation
    $('#form-forgot').validate({
        rules: {
            'forgot-email': {
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
        }
    });
    $('#forgot-btn').on('click', function() {
        var name = $('#forgot-name').val();

        // if name not empty, it is probably a bot
        if ($("#form-forgot").valid() && !name) {
            var spinnerEl = '<span class="spinner-icon"></span>'
            var $form = $('#form-forgot');

            // not a bot
            $form.fadeOut(600, 'easeOutExpo', function() {
                $('#forgot').append(spinnerEl);
                var url = '/user/forgot',
                    postData = {
                        'email': $('#forgot-email').val()
                    },
                    posting = $.post(url, postData);
                
                posting.done( function(data) {
                    $('.spinner-icon').fadeOut(600, 'easeOutExpo', function() {
                        var msg = '<small class="forgot-msg text-success">'
                            + data + '</small>';
                        $('.forgot-msg').remove();
                        $('#form-forgot').append(msg);
                        $('#forgot-email').val('');
                        $('#form-forgot').fadeIn(600, 'easeOutExpo');
                    });
                });
            });
        }
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