{if !isset($grid_11)}   {assign var=grid_11     value=3}{/if}
{if !isset($grid_12)}   {assign var=grid_12     value=3}{/if}
{if !isset($grid_21)}   {assign var=grid_21     value=0}{/if}
{if !isset($grid_22)}   {assign var=grid_22     value=3}{/if}
{if !isset($grid_31)}   {assign var=grid_31     value=0}{/if}
{if !isset($grid_32)}   {assign var=grid_32     value=3}{/if}
{$cfg_1.plain = 1}
{$cfg_2.plain = 1}
{$cfg_3.plain = 1}

<div class="form-group {$display|default:''}">
    <label class="col-md-{$grid_11} control-label" for="{$name_1}">{$label_1} {if isset($cfg_1.required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
    <div class="col-md-{$grid_12}">
        {if preg_match('/(picker|checkbox|radio|date)/', $cfg_1.type)}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_{$cfg_1.type}.tpl" name=$name_1    cfg=$cfg_1}
        {elseif preg_match('/(select)/', $cfg_1.type)}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_{$cfg_1.type}.tpl" rff=$sys.rsp.ref.$name_1    cfg=$cfg_1}
        {else}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"          name=$name_1    cfg=$cfg_1}
        {/if}
    </div>

    {if isset($label_2)}
    <label class="col-md-{$grid_21} control-label" for="{$name_2}">{$label_2} {if isset($cfg_2.required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
    {/if}
    <div class="col-md-{$grid_22}">
        {if preg_match('/(picker|checkbox|radio|date)/', $cfg_3.type)}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_{$cfg_3.type}.tpl" name=$name_3    cfg=$cfg_3}
        {elseif preg_match('/(select)/', $cfg_3.type)}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_{$cfg_3.type}.tpl" name=$name_3    cfg=$cfg_3}
        {else}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"          name=$name_3    cfg=$cfg_3}
        {/if}
    </div>

    {if isset($label_2)}
        <label class="col-md-{$grid_21} control-label" for="{$name_2}">{$label_2} {if isset($cfg_2.required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
    {/if}
    <div class="col-md-{$grid_32}">
        {if preg_match('/(picker|checkbox|radio|date)/', $cfg_3.type)}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_{$cfg_3.type}.tpl" name=$name_3    cfg=$cfg_3}
        {elseif preg_match('/(select)/', $cfg_3.type)}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_{$cfg_3.type}.tpl" name=$name_3    cfg=$cfg_3}
        {else}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"          name=$name_3    cfg=$cfg_3}
        {/if}
    </div>
</div>

