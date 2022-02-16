{assign var=value       value=$sys.rsp.dat.$name|default:''}

{if !isset($grid_0)}    {assign var=grid_0      value=3}{/if}
{if !isset($grid_1)}    {assign var=grid_1      value=9}{/if}

{if !isset($cfg)}       {assign var=cfg         value=[]}{/if}
{if !isset($cfg.plain)} {$cfg.plain = 0}{/if}

{capture name="elm_text"}
    {if isset($cfg.f_icon) || isset($cfg.l_icon) || isset($cfg.readonly)}
        <div class="input-group">
            {if $cfg.f_icon|default:0}
                <span class="input-group-addon">
                {if preg_match('/^icon/', $cfg.f_icon)}
                    {if preg_match('/material/', $cfg.f_icon)}
                        <i class="materialize-icon">{$cfg.f_icon}</i>
                    {else}
                        <i class="{$cfg.f_icon}"></i>
                    {/if}
                {else}
                     {$cfg.f_icon}
                {/if}
                </span>
            {/if}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_input.tpl"     name=$name      cfg=$cfg}
            {if $cfg.l_icon|default:0}
                <span class="input-group-addon">
                {if preg_match('/^icon/', $cfg.l_icon)}
                    {if preg_match('/material/', $cfg.f_icon)}
                        <i class="materialize-icon">{$cfg.l_icon}</i>
                    {else}
                        <i class="{$cfg.l_icon}"></i>
                    {/if}
                {else}
                    {$cfg.l_icon}
                {/if}
                </span>
            {/if}
            {if $cfg.readonly|default:0}<span class="input-group-addon"><i class="fa fa-lock"></i></span>{/if}
            {if $cfg.msg_helper|default:0}<span class="help-block">{$cfg.msg_helper}</span>{/if}
            {if $cfg.msg_err|default:''}<div id="{$name}_{$sys.req.rid}_error"></div>{/if}
        </div>
    {else}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_input.tpl"         name=$name     cfg=$cfg}
        {if $cfg.msg_helper|default:0}<span class="help-block">{$cfg.msg_helper}</span>{/if}
        {if $cfg.msg_err|default:''}<div id="{$name}_{$sys.req.rid}_error"></div>{/if}
    {/if}
{/capture}

{if $cfg.plain}
    {$smarty.capture.elm_text}
{else}
    <div id="div_{$name}" class="form-group{$display|default:''}">
        {if isset($label)}
        <label class="col-md-{$grid_0} control-label" for="{$name}">{$label} {if isset($cfg.required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
        {/if}
        <div class="col-md-{$grid_1}">
            {$smarty.capture.elm_text}
        </div>
    </div>
{/if}
