{if !isset($selected)}
    {assign 'selected' $rff.sp_def}
{/if}
<section>
    <label class="select">
        <select id="fs_{$rff.col_fid}_{$sys.req.rid}" name="{$rff.col_fid}" class="{if $rff.elm_chain} chaining{/if}"
            {if $rff.elm_type eq 'select-multiple'}multiple{/if}
            {if $rff.elm_chain}
                data-model="{$sys.req.rid}"
                data-target="#fs_{$rff.elm_chain.trg}_{$sys.req.rid}"
                data-filter="{$rff.elm_chain.whr}"
                data-source="{$rff.elm_chain.src}"
            {/if}
        >
            <option value="">filter by {$rff.elm_label}</option>
            {if $rff.option}
                {if $rff.elm_type eq 'select-multiple'}
                    {foreach from=$rff.option item=i}
                        <option {if isset($i.ico)}data-icon="{$i.ico}"{/if} value="{$i.id}" {if in_array($i.id, $selected)}selected{/if}>{$i.nm}</option>
                    {/foreach}
                {elseif $rff.elm_type eq 'select-group'}
                    {foreach from=$rff.option key=grp item=pid}
                        {if $grp && $pid}
                            <optgroup label="{$grp}">
                                {foreach from=$pid item=i}
                                    <option {if isset($i.ico)}data-icon="{$i.ico}"{/if} value="{$i.id}" {if $i.id eq $selected}selected{/if}>{$i.nm}</option>
                                {/foreach}
                            </optgroup>
                        {/if}
                    {/foreach}
                {elseif $rff.elm_type eq 'select-tree'}
                    {foreach $rff.option as $k=>$v}
                        <option {if isset($i.ico)}data-icon="{$i.ico}"{/if} class="{$v.ind} {$v.cls}" value="{$v.id}"{if $v.id eq $selected} selected{/if}>{$v.nm}</option>
                    {/foreach}
                {else}
                    {foreach from=$rff.option item=i}
                        <option {if isset($i.ico)}data-icon="{$i.ico}"{/if} value="{$i.id}" {if $i.id eq $selected}selected{/if}>{$i.nm}</option>
                    {/foreach}
                {/if}
            {/if}
        </select><i></i>
    </label>
</section>