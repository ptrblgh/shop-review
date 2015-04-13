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
                <form name="form-review" id="form-review" method="post" action ="/review/add">
                    <div class="form-group">
                        <div class="form-group has-feedback has-feedback-left">
                            <label class="control-label">My review</label>
                            <textarea name="review_review_body" rows="5" class="form-control">{if !empty($logged_in_review->review_body)}{$logged_in_review->review_body}{/if}</textarea>
                            <span class="form-control-feedback glyphicon glyphicon-pencil"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">My rating</label>
                            <input class="rating" name="review_review_rating" value="{if !empty($logged_in_review->review_rating)}{$logged_in_review->review_rating}{/if}" data-min="0" data-max="5" data-step="1" data-size="sm">
                        </div>
                        <div class="name-group">
                            <input type="text" name="review_csrf_token" id="review-csrf-token" value="{if isset($csrf_token)}{$csrf_token}{/if}" />
                            <input type="text" name="review_name" id="review-name" class="form-control" placeholder="E-mail" />
                        </div>
                        <hr />
                        {include file="partial_errors.tpl"}
                        <div class="form-group text-center">
                            <button name="review-btn" id="review-btn" type="button" class="btn btn-primary">{if !empty($logged_in_review)}Update{else}Send{/if} review</button>
                            <a href="/review/del" name="delete-review-btn" id="delete-review-btn" type="button" class="btn btn-danger btn-confirm">Delete review</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>