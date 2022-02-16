{extends file="{$sys.uix.elm}/hst/portlet-mini.tpl"}
{block name="portlet-mini_title"}
    <span class="widget-icon"><i class="{$sys.prc.sys_prc.icon}"></i></span>
    <h2>Roles</h2>
{/block}
{block name="portlet-mini_body"}
<form class="form-compact smart-form form-sibling">
    <div class="row">
        {foreach from=$sys.rsp.ref.aaa_acm.option item=i}
            <div class="col col-md-6">
                <label class="checkbox">
                    <input name="checkbox" {if isset($sys.rsp.dat.aaa_acm_id[$i.id])}checked="checked"{/if} type="checkbox"><i></i>{$i.nm}
                </label>
            </div>
        {/foreach}
    </div>
</form>
{/block}