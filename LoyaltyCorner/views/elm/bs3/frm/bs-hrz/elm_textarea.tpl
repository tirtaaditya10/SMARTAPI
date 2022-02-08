{assign var=value       value=$sys.rsp.dat.$name|default:''}

{if !isset($grid_0)}    {assign var=grid_0      value=3}{/if}
{if !isset($grid_1)}    {assign var=grid_1      value=9}{/if}

{if !isset($cfg)}       {assign var=cfg         value=[]}{/if}
{if !isset($cfg.plain)} {$cfg.plain = 0}{/if}
{capture name="elm_textarea"}
    <textarea id="{$name}_{$sys.req.rid}" {if $cfg.ctrl|default:1}name="{$name}"{/if} class="form-control {$cfg.class|default:'autosize'}" rows="{$cfg.row|default:3}"
        {if $cfg.readonly|default:0}readonly{/if}
        {if $cfg.disabled|default:0}disabled{/if}
        {if $cfg.title|default:''}title="{$cfg.title}" placeholder="{$cfg.title}"{/if}
        {if $cfg.required|default:0}data-required="true" required{/if}     {if $cfg.msg_required|default:0}data-msg-required="{$cfg.msg_required}"{/if}
        {if $cfg.minlength|default:0}data-minlength="{$cfg.minlength}"{/if}    {if $cfg.msg_minlength|default:0}data-msg-minlength="{$cfg.msg_minlength}"{/if}
        {if $cfg.maxlength|default:0}data-maxlength="{$cfg.maxlength}" maxlength="{$cfg.maxlength}" {/if}    {if $cfg.msg_maxlength|default:0}data-msg-maxlength="{$cfg.msg_maxlength}"{/if}
        {if $cfg.msg_err|default:0}data-error-container="#{$name}_error"{/if} spellcheck="false">{$sys.rsp.dat.$name|default:''}
    </textarea>
{/capture}
{capture name="elm_group"}
    {if isset($cfg.f_icon) || isset($cfg.l_icon) || isset($cfg.readonly)}
        <div class="input-group">
            {if $cfg.f_icon|default:0}<span class="input-group-addon">
                {if preg_match('/^icon/', $cfg.f_icon)}
                    {if preg_match('/material/')}
                        <i class="materialize-icon">{$cfg.f_icon}</i>
                    {else}
                        <i class="{$cfg.f_icon}"></i></span>
                    {/if}
                {else}
                    {$cfg.f_icon}
                {/if}
            {/if}

            {$smarty.capture.elm_textarea}

            {if $cfg.l_icon|default:0}<span class="input-group-addon">
                {if preg_match('/^icon/', $cfg.l_icon)}
                    {if preg_match('/material/')}
                        <i class="materialize-icon">{$cfg.l_icon}</i>
                    {else}
                        <i class="{$cfg.l_icon}"></i></span>
                    {/if}
                {else}
                    {$cfg.l_icon}
                {/if}
            {/if}
            {if $cfg.readonly|default:0}<span class="input-group-addon"><i class="fa fa-lock"></i></span>{/if}
            {if $cfg.msg_helper|default:0}<span class="help-block">{$cfg.msg_helper}</span>{/if}
            {if $cfg.msg_err|default:''}<div id="{$name}_{$sys.req.rid}_error"></div>{/if}
        </div>
    {else}
        {$smarty.capture.elm_textarea}
        {if $cfg.msg_helper|default:0}<span class="help-block">{$cfg.msg_helper}</span>{/if}
        {if $cfg.msg_err|default:''}<div id="{$name}_{$sys.req.rid}_error"></div>{/if}
    {/if}
{/capture}

{if $cfg.plain}
    {$smarty.capture.elm_textarea}
{else}
    <div id="div_{$name}" class="form-group{$display|default:''}">
        {if isset($label)}
            <label class="col-md-{$grid_0} control-label" for="{$name}">{$label} {if isset($cfg.required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
        {/if}
        <div class="col-md-{$grid_1}">
            {$smarty.capture.elm_group}
        </div>
    </div>
{/if}
