{block name="config"}
    {block name="data"}
        {if !isset($data)}      {assign var="data"      value=$sys.rsp.dat}{/if}
    {/block}
    {block name="crud"}
        {if !isset($crud)}      {assign var="crud"      value=1}{/if}
    {/block}
    {block name="checkbox"}
        {if !isset($checkbox)}  {assign var="checkbox"  value=0}{/if}
    {/block}
    {block name="toobar"}
        {if !isset($toobar)}    {assign var="toobar"    value=0}{/if}
    {/block}
    {block name="custom"}
        {if !isset($custom)}    {assign var="custom"    value=0}{/if}
    {/block}
{/block}
<table id="ft_{$sys.bpm.bpm}_{$sys.req.rid}" class="footable table table-hover table-striped table-condensed" data-cascade="true" data-sorting="false" data-empty="--- data not found ---" data-use-parent-width="true">
    {block name="caption"}{/block}
    <thead>
        {if $custom}
            {block name="th"}{/block}
        {else}
            <tr>{block name="th"}
                    {include file="{$sys.uix.elm}/tbl/th_id.tpl"}
                    {if $sys.prc.sys_tbl.has.col_self}
                        {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Name" field=$sys.prc.sys_tbl.has.col_self}
                    {/if}
                {/block}
                {block name="th_ext"}{/block}
                {block name="th_def"}
                    {if $sys.prc.sys_tbl.has.col_desc}
                        {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Desc"      field=$sys.prc.sys_tbl.has.col_desc break="all"}
                    {/if}
                    {if $sys.prc.sys_tbl.has.col_active}
                        {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Active"    field="is_active"   break="all"}
                    {/if}
                    {if $sys.usr.is_admin && $sys.prc.sys_tbl.has.col_delete}
                        {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Deleted"   field="is_delete"  break="all"}
                    {/if}
                {/block}
                {if $crud}
                    {block name="th_act"}
                        {include file="{$sys.uix.elm}/tbl/th_act.tpl"}
                    {/block}
                {/if}
            </tr>
        {/if}
    </thead>
    <tbody>
        {if $custom}
            {block name="td"}{/block}
        {else}
            {foreach from=$data item=i}
                <tr id="{$sys.req.rid}/{$i.id|default:0}">
                    {block name="td"}
                        <td></td>
                        {if $checkbox}<td><input name="ftcb[{$i.id}]" class="footable_checkbox" type="checkbox"></td>{/if}
                        {if $sys.prc.sys_tbl.has.col_id || $sys.prc.sys_tbl.has_col_id_code}
                            <td>{if $sys.prc.sys_tbl.has.col_code}
                                    {$i.id_code}
                                {elseif $sys.prc.sys_tbl.has.col_id}
                                    {$i.id}
                                {/if}
                            </td>
                        {/if}
                        {if $sys.prc.sys_tbl.has.col_self}
                            <td>{if isset($i.font_icon) && $i.font_icon}<i class="{$i.font_icon}"></i>{/if} {$i[$sys.prc.sys_tbl.has.col_self]}</td>
                        {/if}
                    {/block}
                    {block name="td_ext"}{/block}
                    {if $sys.prc.sys_tbl.has.col_desc}
                        <td>{$i[$sys.prc.sys_tbl.has.col_desc]}</td>
                    {/if}
                    {if $sys.prc.sys_tbl.has.col_active}
                        <td class="text-left">{if $i.is_active}<i class="fa fa-check"></i>{else}<i class="fa fa-times"></i>{/if}</td>
                    {/if}
                    {if $sys.usr.is_admin && $sys.prc.sys_tbl.has.col_delete}
                        <td class="text-left">{if $i.is_deleted}<i class="fa fa-check"></i>{else}<i class="fa fa-times"></i>{/if}</td>
                    {/if}
                    {if $crud}
                        {block name="td_act"}
                            {include file="{$sys.uix.elm}/tbl/td_upd.tpl"}
                        {/block}
                    {/if}
                </tr>
            {foreachelse}
            {/foreach}
        {/if}
    </tbody>
    {block name="tfooter_ext"}{/block}
</table>
{block name="nav"}{include file="{$sys.uix.elm}/tbl/nav_lst.tpl"}{/block}
