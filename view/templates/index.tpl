<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html>
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="stylesheet" type="text/css" media="all" href="css/star-rating.min.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="css/shop-review.css" />
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand text-uppercase to-top" href="#">
                <span class="brand-light">shop</span> <small><span class="glyphicon glyphicon-star color-brand-warning"></span></small> <strong>review</strong>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul id="top-menu" class="nav navbar-nav navbar-right">
                <li><a href="#top" class="to-top active">About</a></li>
                <li><a href="#my-review" class="smooth-scroll">My review</a></li>
                <li><a href="#others-review" class="smooth-scroll">Others' reviews</a></li>
            </ul> 
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="page-header text-center"><small><span class="glyphicon glyphicon-bookmark"></span></small> OFFICINE PANERAI FIRENZE SAN GIOVANNI</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <div id="carousel-shop-pics" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-shop-pics" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-shop-pics" data-slide-to="1"></li>
                    <li data-target="#carousel-shop-pics" data-slide-to="2"></li>
                    <li data-target="#carousel-shop-pics" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="img/slide-01.jpg" alt="Panerai">
                    </div>
                    <div class="item">
                        <img src="img/slide-02.jpg" alt="Panerai">
                    </div>
                    <div class="item">
                        <img src="img/slide-03.jpg" alt="Panerai">
                    </div>
                    <div class="item">
                        <img src="img/slide-04.jpg" alt="Panerai">
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel-shop-pics" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-shop-pics" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
        <div id="shop-details" class="col-xs-12 col-sm-12 col-md-6">
            <h3 class="text-center text-uppercase"><small><span class="glyphicon glyphicon-list"></span></small> Shop details</h3>
            <hr />
            <p class="text-center">
                <span class="glyphicon glyphicon-globe color-brand-warning"></span>
                <span class="format_address">
                    <span class="street-address" property="v:street-address">Piazza San Giovanni 14R</span>, 
                    <span class="locality">
                        <span class="locality-locality" property="v:locality">Italy</span>, 
                        <span class="locality-region" property="v:region">Florance</span> 
                        <span class="locality-postal-code" property="v:postal-code">50129</span>
                    </span> 
                </span>
            </p>
            <hr />
            <p class="text-center">
                <span class="glyphicon glyphicon-time color-brand-warning"></span>
                <span>Monday &mdash; Friday: 08.00 &mdash; 16.00</span>
            </p>
            <hr />
            <p class="text-center">
                <span class="glyphicon glyphicon-earphone color-brand-warning"></span>
                <span>+ (39) 055 904 00 13</span>,
                <span class="glyphicon glyphicon-envelope color-brand-warning"></span>
                <a href="mailto:boutique-panerai.firenze@panerai.com">boutique-panerai.firenze@panerai.com</a>
            </p>
            <hr />
            <p class="text-center">
                <span class="glyphicon glyphicon-map-marker color-brand-warning"></span>
                <span><a href="#shop-modal" data-toggle="modal">Open map</a></span>
            </p>
            <hr />
            <p class="text-center">
                <input class="rating" value="3.5" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="sm">
            </p>
            <hr />
        </div>
    </div>
</div>

<div class="section-your-review">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="page-header text-center text-uppercase">
                    <a name="my-review" href="#my-review" class="smooth-scroll">
                        <small><span class="glyphicon glyphicon-comment"></span></small> My review 
                    </a>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <form name="form-login" id="#form-login" method="post" action ="/">
                    <div class="form-group">
                        <div class="form-group has-feedback has-feedback-left">
                            <label class="control-label">My review</label>
                            <textarea rows="5" class="form-control"></textarea>
                            <span class="form-control-feedback glyphicon glyphicon-pencil"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">My rating</label>
                            <input class="rating" value="0" data-min="0" data-max="5" data-step="1" data-size="sm">
                        </div>
                        <hr />
                        <div class="form-group text-center">
                            <button type="button" class="btn btn-primary">Send review</button>
                            <button type="button" class="btn btn-danger btn-confirm">Delete review</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h3 class="page-header text-center text-uppercase">
                    <a name="my-review" href="#my-review" class="smooth-scroll">
                        <small><span class="glyphicon glyphicon-log-in"></span></small> Write a review
                    </a>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h4 class="text-center">
                    You need to log in or register for this service
                </h4>
                <p class="text-center">
                    <button type="button" class="btn btn-primary" href="#service-modal" data-toggle="modal" data-target="#service-modal">Login / Register / Forgot</button>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h3 class="page-header text-center text-uppercase"><a name="others-review" href="#others-review"><small><span class="glyphicon glyphicon-stats"></span></small> Others' reviews</a></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="media">
                <div class="hidden-xs media-left media-top">
                    <span class="glyphicon glyphicon-user"></span>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><a name="username1" href="#username1" class="smooth-scroll">username1</a> <small>@ 2015.01.01. 12:01:01</small></h4>
                    <input class="rating" value="4" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec tempus lorem. Pellentesque vehicula sollicitudin nisi et blandit.<a class="collapse-btn" href="#"> <small class="glyphicon glyphicon-plus"></small> more </a> <span class="collapse-body">Pellentesque mollis libero sodales posuere auctor. Pellentesque fermentum diam quis ipsum maximus sodales. Nulla viverra lacinia ante at ullamcorper. Duis in maximus odio. Nullam rhoncus nulla metus, vitae dictum orci consectetur sed. Vestibulum egestas finibus mi, in sagittis quam aliquam sit amet. Nullam volutpat et neque et porttitor. Cras id venenatis ipsum. In volutpat elit ut mauris tincidunt, quis cursus eros cursus. Morbi ac mauris eget dui consequat tempor ac in mauris. Cras malesuada, ex sed molestie vehicula, felis est suscipit arcu, id congue turpis ligula et nisl. Aliquam accumsan venenatis quam, sit amet finibus nulla varius at.</span></p>
                </div>
            </div>
            <div class="media">
                <div class="hidden-xs media-left media-top">
                    <span class="glyphicon glyphicon-user"></span>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><a name="username2" href="#username2" class="smooth-scroll">username2</a> <small>@ 2015.01.01. 12:01:01</small></h4>
                    <input class="rating" value="2" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec tempus lorem. Pellentesque vehicula sollicitudin nisi et blandit.<a class="collapse-btn" href="#"> <small class="glyphicon glyphicon-plus"></small> more </a> <span class="collapse-body">Pellentesque mollis libero sodales posuere auctor. Pellentesque fermentum diam quis ipsum maximus sodales. Nulla viverra lacinia ante at ullamcorper. Duis in maximus odio. Nullam rhoncus nulla metus, vitae dictum orci consectetur sed. Vestibulum egestas finibus mi, in sagittis quam aliquam sit amet. Nullam volutpat et neque et porttitor. Cras id venenatis ipsum. In volutpat elit ut mauris tincidunt, quis cursus eros cursus. Morbi ac mauris eget dui consequat tempor ac in mauris. Cras malesuada, ex sed molestie vehicula, felis est suscipit arcu, id congue turpis ligula et nisl. Aliquam accumsan venenatis quam, sit amet finibus nulla varius at.</span></p>
                </div>
            </div>
            <div class="media">
                <div class="hidden-xs media-left media-top">
                    <span class="glyphicon glyphicon-user"></span>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><a name="username3" href="#username3" class="smooth-scroll">username3</a> <small>@ 2015.01.01. 12:01:01</small></h4>
                    <input class="rating" value="3" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec tempus lorem. Pellentesque vehicula sollicitudin nisi et blandit.<a class="collapse-btn" href="#"> <small class="glyphicon glyphicon-plus"></small> more </a> <span class="collapse-body">Pellentesque mollis libero sodales posuere auctor. Pellentesque fermentum diam quis ipsum maximus sodales. Nulla viverra lacinia ante at ullamcorper. Duis in maximus odio. Nullam rhoncus nulla metus, vitae dictum orci consectetur sed. Vestibulum egestas finibus mi, in sagittis quam aliquam sit amet. Nullam volutpat et neque et porttitor. Cras id venenatis ipsum. In volutpat elit ut mauris tincidunt, quis cursus eros cursus. Morbi ac mauris eget dui consequat tempor ac in mauris. Cras malesuada, ex sed molestie vehicula, felis est suscipit arcu, id congue turpis ligula et nisl. Aliquam accumsan venenatis quam, sit amet finibus nulla varius at.</span></p>
                </div>
            </div>
            <div class="media">
                <div class="hidden-xs media-left media-top">
                    <span class="glyphicon glyphicon-user"></span>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><a name="username4" href="#username4" class="smooth-scroll">username4</a> <small>@ 2015.01.01. 12:01:01</small></h4>
                    <input class="rating" value="5" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec tempus lorem. Pellentesque vehicula sollicitudin nisi et blandit.<a class="collapse-btn" href="#"> <small class="glyphicon glyphicon-plus"></small> more </a> <span class="collapse-body">Pellentesque mollis libero sodales posuere auctor. Pellentesque fermentum diam quis ipsum maximus sodales. Nulla viverra lacinia ante at ullamcorper. Duis in maximus odio. Nullam rhoncus nulla metus, vitae dictum orci consectetur sed. Vestibulum egestas finibus mi, in sagittis quam aliquam sit amet. Nullam volutpat et neque et porttitor. Cras id venenatis ipsum. In volutpat elit ut mauris tincidunt, quis cursus eros cursus. Morbi ac mauris eget dui consequat tempor ac in mauris. Cras malesuada, ex sed molestie vehicula, felis est suscipit arcu, id congue turpis ligula et nisl. Aliquam accumsan venenatis quam, sit amet finibus nulla varius at.</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-default navbar-bottom" role="navigation">
    <div class="container">
        <p class="navbar-text"><small>&copy; 2015. SHOP <small><span class="glyphicon glyphicon-star color-brand-warning"></span></small> <strong>REVIEW</strong>. All rights reserved!</small></p>
    </div>
</nav>

<span id="top-link-block" class="to-top">
    <a href="#top" class="well">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </a>
</span><!-- /#top-link-block -->

<div class="modal fade" id="shop-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                 <h4 class="modal-title">Shop location</h4>

            </div>
            <div class="modal-body">
                <div id="map-canvas"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /#shop-modal -->

<div class="modal fade bs-modal-sm" id="service-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="bs-example bs-example-tabs">
                <ul id="myTab" class="nav nav-tabs">
                  <li class="active"><a href="#login" data-toggle="tab">Log In</a></li>
                  <li class=""><a href="#register" data-toggle="tab">Register</a></li>
                  <li class=""><a href="#forgot" data-toggle="tab">Forgot</a></li>
                </ul>
            </div>
            <div class="modal-body">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="login">
                        <form name="form-login" id="#form-login" method="post" action ="/">
                            <div class="form-group">
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="login-username">Username</label>
                                    <input type="text" name="login-username" id="login-username" class="form-control" placeholder="Username" />
                                    <span class="form-control-feedback glyphicon glyphicon-user"></span>
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="login-psw">Password</label>
                                    <input type="password" name="login-psw" id="login-psw" class="form-control" placeholder="Password" />
                                    <span class="form-control-feedback glyphicon glyphicon-lock"></span>
                                </div>
                                <div class="form-group">
                                    <label class="" for="rememberme">
                                        <input type="checkbox" name="rememberme" id="rememberme" value="Remember me"> Remember me
                                    </label>
                                </div>
                                <div class="name-group">
                                    <input type="text" name="login-name" id="login-name" class="form-control" placeholder="E-mail" />
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="button" name="login-btn" id="login-btn" class="btn btn-success">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="register">
                        <form name="form-register" id="#form-register" method="post" action ="/">
                            <div class="form-group">
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="register-username">Username</label>
                                    <input type="text" name="register-username" id="register-username" class="form-control" placeholder="Username" />
                                    <span class="form-control-feedback glyphicon glyphicon-user"></span>
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="register-psw">Password</label>
                                    <input type="password" name="register-psw" id="register-psw" class="form-control" placeholder="Password" />
                                    <span class="form-control-feedback glyphicon glyphicon-lock"></span>
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="register-psw2">Re-enter password</label>
                                    <input type="password" name="register-psw2" id="register-psw2" class="form-control" placeholder="Password" />
                                    <span class="form-control-feedback glyphicon glyphicon-lock"></span>
                                </div>
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="register-email">E-mail</label>
                                    <input type="text" name="register-email" id="register-email" class="form-control" placeholder="E-mail" />
                                    <span class="form-control-feedback glyphicon glyphicon-envelope"></span>
                                </div>
                                <div class="name-group">
                                    <input type="text" name="register-name" id="register-name" class="form-control" placeholder="E-mail" />
                                </div>
                                <div class="form-group text-center">
                                    <button type="button" name="register-btn" id="register-btn" class="btn btn-success">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="forgot">
                        <form name="form-forgot" id="#form-forgot" method="post" action ="/">
                            <div class="form-group">
                                <div class="form-group has-feedback has-feedback-left">
                                    <label class="control-label" for="forgot-email">E-mail</label>
                                    <input type="text" name="forgot-email" id="forgot-email" class="form-control" placeholder="E-mail" />
                                    <span class="form-control-feedback glyphicon glyphicon-envelope"></span>
                                </div>
                                <div class="name-group">
                                    <input type="text" name="forgot-name" id="forgot-name" class="form-control" placeholder="E-mail" />
                                </div>
                                <div class="form-group text-center">
                                    <button type="button" name="forgot-btn" id="forgot-btn" class="btn btn-success">New password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /#service-modal -->

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/star-rating.min.js"></script>
    <script src="js/bootstrap-confirmation.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="js/custom.js"></script>
</body>
</html>
