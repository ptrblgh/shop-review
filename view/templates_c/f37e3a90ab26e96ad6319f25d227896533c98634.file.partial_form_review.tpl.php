<?php /* Smarty version Smarty-3.1.21, created on 2015-04-07 12:07:52
         compiled from "view/templates/partial_form_review.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8318235855523ac78c17a07-58238976%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f37e3a90ab26e96ad6319f25d227896533c98634' => 
    array (
      0 => 'view/templates/partial_form_review.tpl',
      1 => 1428399210,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8318235855523ac78c17a07-58238976',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5523ac78c4efa0_05865222',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5523ac78c4efa0_05865222')) {function content_5523ac78c4efa0_05865222($_smarty_tpl) {?><div class="section-your-review">
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
    </div>
</div><?php }} ?>
