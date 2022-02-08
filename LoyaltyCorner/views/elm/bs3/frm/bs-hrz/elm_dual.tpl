{if !isset($grid_11)}   {assign var=grid_11     value=3}{/if}
{if !isset($grid_12)}   {assign var=grid_12     value=3}{/if}
{if !isset($grid_21)}   {assign var=grid_21     value=3}{/if}
{if !isset($grid_22)}   {assign var=grid_22     value=3}{/if}
{$cfg_1.plain = 1}
{$cfg_2.plain = 1}

<div class="form-group {$display|default:''}">
    <label class="col-md-{$grid_11} control-label" for="{$name_1}">{$label_1} {if isset($cfg_1.required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
    <div class="col-md-{$grid_12}">
        {if preg_match('/(picker|checkbox|radio|date)/',  $cfg_1.type)}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_{$cfg_1.type}.tpl" name=$name_1    cfg=$cfg_1}
        {elseif preg_match('/(select)/', $cfg_1.type)}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_{$cfg_1.type}.tpl" name=$name_1    cfg=$cfg_1}
        {else}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"          name=$name_1    cfg=$cfg_1}
        {/if}
    </div>
    {if isset($label_2)}
    <label class="col-md-{$grid_21} control-label" for="{$name_2}">{$label_2} {if isset($cfg_2.required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
    {/if}
    <div class="col-md-{$grid_22}">
        {if preg_match('/(picker|checkbox|radio|date)/',  $cfg_2.type)}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_{$cfg_2.type}.tpl" name=$name_2    cfg=$cfg_2}
        {elseif preg_match('/(select)/', $cfg_2.type)}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_{$cfg_2.type}.tpl" name=$name_2    cfg=$cfg_2}
        {else}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"          name=$name_2    cfg=$cfg_2}
        {/if}
    </div>
</div>

