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
        timeout: 2000, // Set the timeout to two seconds
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

    // ajax loader for reviews
    var loading = false;

    $(window).scroll(function () {
        if ($(window).scrollTop() == ($(document).height() - $(window).height())
            && !loading
        ) {
            
            var items = $('#others-reviews .media').length;

            loading = true;
            $.ajax({
                type: 'post',
                url: '/review/batch',
                dataType: 'html',
                cache: false,               
                data: { itemCount: parseInt(items, 10) }
            }).done( function(data) {
                try {                
                    var $sw = $('.spinner-wrapper');

                    if (data) {
                        $sw.fadeIn(1000, function() {
                            $('.spinner-wrapper').before(data);
                            $('input.rating').rating('refresh');
                        });
                        $sw.fadeOut('fast', function() {
                            loading = false;
                        });
                    }
                } catch(e) {     
                    console.log(e);
                }                   
            });
        }
    });

    // smooth scroll
    $('body').on('click', 'a.smooth-scroll', function() {
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
    $('#others-reviews').on('click', '.collapse-btn', function(e) {
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
        }
    });
    $('#login-btn').on('click', function() {
        var name = $('#login-name').val();

        // if name not empty, it is probably a bot
        if ($("#form-login").valid() && !name) {
            $("#form-login").submit();
        }
    });

    // register validation
    jQuery.validator.addMethod("sum", function(value, element, params) {
        return this.optional(element) 
            || parseInt(value, 10) == params[0] + params[1];
    }, jQuery.validator.format(("Please enter the correct value: {0} + {1}.")));
    $('#form-register').validate({
        rules: {
            'register_username': {
                minlength: 3,
                maxlength: 20,
                required: true,
                remote: {
                    url: "/user/check-username",
                    type: "post"
                }
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
                required: true,
                remote: {
                    url: "/user/check-email",
                    type: "post"
                }
            },
            'register_captcha': {
                required: true,
                sum: function(element) {
                    var text = $(element)
                        .closest('.form-group').find('label').text(),
                        arr = text.split(' ');

                    return [parseInt(arr[0], 10), parseInt(arr[2], 10)];
                }
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
                .removeClass(errorClass).addClass(validClass).hide();
            ;
            $(element).closest('.form-group').removeClass('has-error')
                .addClass('has-success')
            ;
        }
    });
    $('#register-btn').on('click', function() {
        var name = $('#register-name').val();

        // if name not empty, it is probably a bot
        if ($("#form-register").valid() && !name) {
            $("#form-register").submit();
        }
    });

    // change password validation
    $('#form-change-psw').validate({
        rules: {
            'change_psw_current_psw': {
                minlength: 6,
                maxlength: 72,                
                required: true
            },
            'change_psw_psw': {
                minlength: 6,
                maxlength: 72,                
                required: true
            },
            'change_psw_psw2': {
                minlength: 6,
                maxlength: 72,                
                required: true,
                equalTo : "#change-psw-psw"
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
                .removeClass(errorClass).addClass(validClass).hide();
            ;
            $(element).closest('.form-group').removeClass('has-error')
                .addClass('has-success')
            ;
        }
    });
    $('#change-psw-btn').on('click', function() {
        var name = $('#change-psw-name').val();

        // if name not empty, it is probably a bot
        if ($("#form-change-psw").valid() && !name) {
            $("#form-change-psw").submit();
        }
    });

    // forgot validation
    $('#form-forgot').validate({
        rules: {
            'forgot_email': {
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
                    var dataObj = data;
                    $('.spinner-icon').fadeOut(600, 'easeOutExpo', function() {
                        var textClass = (dataObj.status == 'success')
                            ? 'text-success' : 'text-danger';
                        var msg = '<small class="forgot-msg ' + textClass + '">'
                            + dataObj.msg + '</small>';
                        $('.forgot-msg').remove();
                        $('#form-forgot').append(msg);
                        $('#forgot-email').val('');
                        $('#form-forgot').fadeIn(600, 'easeOutExpo');
                    });
                });
            });
        }
    });

    // review validation
    jQuery.validator.addMethod("integer", function(value, element, params) {
        return (value != 0) && (value == parseInt(value, 10));
    }, jQuery.validator.format(("Please enter a non-zero integer.")));    
    $('#form-review').validate({
        rules: {
            'review_review_body': {
                minlength: 5,
                maxlength: 21843,
                required: true
            },
            'review_review_rating': {
                digits: true,
                range: [1, 5],
                integer: true,               
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
    $('#review-btn').on('click', function() {
        var name = $('#review-name').val();

        // if name not empty, it is probably a bot
        if ($("#form-review").valid() && !name) {
            $("#form-review").submit();
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