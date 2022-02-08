{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Mom's" field="wcrm_account"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Contact" field="phone_number_1"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Adress"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Loyalti Member" field="member_no"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Parenting Club"  break_point="all"}
    {** include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Reward"  break_point="all" **}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CREATED BY" field="aaa_account" break_point="all"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CREATED TIME" field="created_on" break_point="all"}
{/block}
{block name="td_ext"}
    <td>{$i.wcrm_account}</td>
    <td>{if $i.phone_number_1}<i class="fa fa-phone"></i> {$i.phone_number_1|phone_format}{/if}
        {if $i.phone_number_2}<br><i class="fa fa-phone"></i> {$i.phone_number_2|phone_format}{/if}
        {if $i.phone_number_3}<br><i class="fa fa-phone"></i> {$i.phone_number_3|phone_format}{/if}
        {if $i.email}<br><i class="fa fa-inbox"></i> {$i.email}{/if}
    </td>
    <td>{$i.address}
        {if $i.address_2}<br>{$i.address_2}{/if}
        {if $i.address_3}<br>{$i.address_3}{/if}
        {if $i.city}<br>{$i.city}{/if}
    </td>
    <td>{$i.member_no}</td>
    <td><dl class="dl-horizontal">
            <dt style="width:75px;">Join ?</dt><dd style="margin-left:85px;" title="Member"> {if $i.is_member_pc}<i class="fa fa-check"></i>{/if}</dd>
            <dt style="width:75px;">Interest ?</dt><dd style="margin-left:85px;" title="Interest to Join"> {if $i.is_willing_to_pc}<i class="fa fa-check"></i>{/if}</dd>
        </dl>
    </td>
    {** <td>{if $i.wcrm_reward_pref_2_id}
            <ul>
                <li>$i.wcrm_reward_pref_1</li>
                <li>$i.wcrm_reward_pref_2</li>
            </ul>
        {else}
            {$i.wcrm_reward_pref_1}
        {/if}
    </td>
    **}
    <td>{$i.aaa_account}</td>
    <td>{$i.created_on}</td>
{/block}