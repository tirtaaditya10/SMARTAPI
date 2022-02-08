<th style="width:10px;"></th>
{if $checkbox}<th class="text-center"><input name="ftcb_all" type="checkbox"></th>{/if}
{if $sys.prc.sys_tbl.has.col_id || $sys.prc.sys_tbl.has.col_code}
    {if $sys.prc.sys_tbl.has.col_code}
        {assign var="field" value="id_code"}
        {assign var="label" value="#code"}
    {else}
        {assign var="field" value="id"}
        {assign var="label" value="#id"}
    {/if}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label=$label field=$field width="50px" break=$break|default:"lg"}
{/if}
