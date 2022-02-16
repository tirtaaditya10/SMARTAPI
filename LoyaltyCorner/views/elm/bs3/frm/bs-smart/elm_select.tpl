{if !isset($selected)}
    {assign 'selected' $rff.sp_def}
{/if}
{capture name="html_elm"}
    <select id="{$rff.col_fid}_{$sys.req.rid}" name="{$rff.col_fid}" class="{if $rff.elm_chain} chaining{/if}"
            data-size="{$max_row|default:5}"
            data-style="{$style|default:'btn-inverse'}"
            data-live-search="true" {if isset($disabled)}disabled{/if}
            title="{$rff.elm_title}" placeholder="{$rff.elm_placeholder}"
            {if $rff.elm_chain}
                data-model="{$sys.req.rid}"
                data-source="{$rff.elm_chain.src}"
                data-filter="{$rff.elm_chain.whr}"
                data-target="#{$rff.elm_chain.trg}_{$sys.req.rid}"
            {/if}
            {if $rff.is_require}required data-rule-required="true" data-msg-required="{$rff.msg_required|default:'This column is mandatory !'}"{/if}
    >
        <option value="">Choose for {$rff.elm_placeholder}</option>
        {if $rff.init_flg && $rff.option}
            {foreach from=$rff.option item=i}
                <option value="{$i.id}" {if $i.id eq $selected}selected{/if}
                        {if isset($i.disabled)} disabled{/if}
                        {if isset($i.title)} title="{$i.title}"{/if}
                        {if isset($i.icon)} data-icon="{$i.icon}"{/if}
                        {if isset($i.subtext)} data-subtext="{$i.subtext}"{/if}
                        {if isset($i.content)} data-content="{$i.content}"{/if}
                >{$i.nm}</option>
            {/foreach}
        {/if}
    </select><i></i>
{/capture}
{if isset($plain_html) && $plain_html eq 1}
    {$smarty.capture.html_elm}
{else}
    <section>
        <label for="{$sys.req.rid}_{$rff.col_fid}" class="label">{$rff.elm_label} {if $rff.is_require}<span class="required">*</span>{else}&nbsp;{/if}</label>
        <label class="select">
            {$smarty.capture.html_elm}
        </label>
    </section>
{/if}