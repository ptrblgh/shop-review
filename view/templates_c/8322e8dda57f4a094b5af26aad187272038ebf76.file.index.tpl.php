<?php /* Smarty version Smarty-3.1.21, created on 2015-04-07 12:08:07
         compiled from "view/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3791069155523a3821c5025-39052917%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8322e8dda57f4a094b5af26aad187272038ebf76' => 
    array (
      0 => 'view/templates/index.tpl',
      1 => 1428401285,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3791069155523a3821c5025-39052917',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5523a38222eb98_27512379',
  'variables' => 
  array (
    'logged_in' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5523a38222eb98_27512379')) {function content_5523a38222eb98_27512379($_smarty_tpl) {?><!DOCTYPE html>
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
    <title>Shop review - a project for miniCRM</title>
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

<?php if (isset($_smarty_tpl->tpl_vars['logged_in']->value)) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("partial_form_review.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php } else { ?>
    <?php echo $_smarty_tpl->getSubTemplate ("partial_form_login.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?>

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

<?php if (!isset($_smarty_tpl->tpl_vars['logged_in']->value)) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("partial_modal_service.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?>

    <?php echo '<script'; ?>
 src="js/jquery-1.11.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/jquery.easing.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/isotope.pkgd.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/imagesloaded.pkgd.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/star-rating.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/bootstrap-confirmation.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="http://maps.google.com/maps/api/js?sensor=false"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/custom.js"><?php echo '</script'; ?>
>
</body>
</html><?php }} ?>