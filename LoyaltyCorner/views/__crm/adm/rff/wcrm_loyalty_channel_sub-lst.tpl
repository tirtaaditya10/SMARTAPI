{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Channel "  field="wcrm_loyalty_channel"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Notes "    field="notes"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Created On "    field="created_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Updated On "    field="updated_on"}
{/block}
{block name="td_ext"}
    <td>{$i.wcrm_loyalty_channel}</td>
    <td>{$i.notes}</td>
    <td>{$i.created_on}</td>
    <td>{$i.updated_on}</td>


{/block}