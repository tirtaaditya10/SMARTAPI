{assign var=value       value=$sys.rsp.dat.$name|default:''}
{if !isset($grid_0)}    {assign var=grid_0      value=3}{/if}
{if !isset($grid_1)}    {assign var=grid_1      value=9}{/if}

{if !isset($cfg)}       {assign var=cfg         value=[]}{/if}
{if !isset($cfg.plain)} {$cfg.plain = 0}{/if}

{capture name="elm_checkbox"}
    <label class="checkbox-inline">
        <input type="checkbox" id="{$name}_{$sys.req.rid}" name="{$name}" class="checkbox style-0" {if $value}checked="checked"{/if} {if $cfg.disabled|default:0}disabled{/if}>
        <span>&nbsp;</span>
    </label>
    {if $cfg.msg_helper|default:''}<span class="help-block">{$cfg.msg_helper}</span>{/if}
{/capture}

{if $cfg.plain}
    {$smarty.capture.elm_checkbox}
{else}
    <div class="form-group{$cfg.display|default:''}">
        <label class="col-md-{$grid_0} control-label">{$label} {if $cfg.required|default:0}<span class="required">*</span>{/if}</label>
        <div class="col-md-{$grid_1}">
            {$smarty.capture.elm_checkbox}
        </div>
    </div>
{/if}