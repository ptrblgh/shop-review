{if !empty($form_errors)}
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <ul class="">
    {foreach from=$form_errors item=error}
        <li>{$error}</li>
    {/foreach}
    </ul>
</div>
{/if}
