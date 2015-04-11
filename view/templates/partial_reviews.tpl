{if !empty($reviews)}
    {foreach from=$reviews item=review}
        {assign var="review_body" value=$review->review_body}
            <div class="media">
                <div class="hidden-xs media-left media-top">
                    <span class="glyphicon glyphicon-user"></span>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><a name="{$review->username}" href="#{$review->username}" class="smooth-scroll">{$review->username}</a> <small>@ {$review->review_add_date}</small></h4>
                    <input class="rating" value="{$review->review_rating}" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs">
                    <p>
{if strlen($review_body) > $review_lead}
    {nl2br(substr($review_body, 0, strpos($review_body, ' ', $review_lead)))}<a class="collapse-btn" href="#"> <small class="glyphicon glyphicon-plus"></small> more </a> <span class="collapse-body">{nl2br(substr($review_body, strpos($review_body, ' ', $review_lead) + 1))}</span>
{else}
    {nl2br($review_body)}
{/if}
                    </p>
                </div>
            </div>
    {/foreach}
{else}
    <p class="text-center">No other reviews so far. You can be the first one!</p>
{/if}            
