{if !isset($grid_0)}    {assign var=grid_0  value=3}{/if}
{if !isset($grid_1)}    {assign var=grid_1  value=4}{/if}
{if !isset($grid_2)}    {assign var=grid_2  value=4}{/if}

{if !isset($cfg)}       {assign var=cfg         value=null}{/if}

{if !isset($class)}     {assign var=class   value=''}{/if}

<div class="form-group {$display|default:''}">
    <label class="col-md-{$grid_0} control-label" for="{$name_1}">{$label_1} {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
    <div class="col-md-{$grid_1}">
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_datepicker.tpl"    elm_only=1  label=$label_1  name=$name_1}
    </div>
    <div class="col-md-{$grid_2}">
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_{$dual}.tpl"       elm_only=1  label=$label_2|default:0  name=$name_2}
    </div>
</div>

