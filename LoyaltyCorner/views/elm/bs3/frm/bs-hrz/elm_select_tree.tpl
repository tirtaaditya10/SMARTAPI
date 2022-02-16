{if !isset($selected)}
    {assign 'selected' $dtx.sp_def}
{/if}
<div class="form-group {$display|default:''}">
    <label for="{$dtx.col_fid}_{$sys.req.rid}"
           class="col-md-{$WLbl|default:3} control-label">{$dtx.elm_label} {if $dtx.is_require}
            <span class="required">*</span>
        {else}&nbsp;{/if}</label>
    <div class="col-md-{$WElm|default:9}">
        <select id="{$dtx.col_fid}_{$sys.req.rid}" name="{$dtx.col_fid}"
                class="form-control bs-select show-tick show-menu-arrow" data-size="{$max_row|default:5}"
                data-style="{$style|default:'btn-inverse'}" data-live-search="true" {if isset($disabled)}disabled{/if}
                title="{$dtx.elm_placeholder|default:$dtx.elm_label}"
                placeholder="{$dtx.elm_placeholder|default:$dtx.elm_label}"
                {if $dtx.is_require}required data-rule-required="true" data-msg-required="{$dtx.msg_required|default:'This column is mandatory !'}"{/if}
        >
            <option value="">Choose {$dtx.elm_placeholder|default:$dtx.elm_label}</option>
            {if isset($dtx.option)}
                {foreach $dtx.option as $k=>$v}
                    <option {if isset($i.ico)}data-icon="{$i.ico}"{/if} class="{$v.ind} {$v.cls}"
                            value="{$v.id}"{if $v.id eq $selected} selected{/if}>{$v.nm}</option>
                {/foreach}
            {/if}
        </select>
        <span class="help-block">{$dtx.msg_helper|default:''}</span>
        <div id="{$dtx.col_fid}_error"></div>
    </div>
</div>
