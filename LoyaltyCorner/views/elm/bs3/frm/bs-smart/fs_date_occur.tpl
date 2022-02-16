{if !isset($selected)}
    {assign 'selected' $rff.sp_def}
{/if}
{capture name="html_elm"}
    <select id="{$rff.col_fid}_{$sys.req.rid}" name="{$rff.col_fid}" title="{$rff.elm_title}" placeholder="{$rff.elm_placeholder}">
        <option value="">Choose for {$rff.elm_placeholder}</option>

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