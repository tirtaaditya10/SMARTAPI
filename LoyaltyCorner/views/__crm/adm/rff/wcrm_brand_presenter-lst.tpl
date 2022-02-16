{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="widget_toolbar_21"}
    <div class="widget-toolbar" id="widget_toolbar_21" style="display:none;">
        <button class="button-icon btn btn-danger" title="Upload to Stage II"><i class="fa fa-gear"></i> Upload to Stage II</button>
    </div>
{/block}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Team Leader" field="wcrm_team_leader"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="BPCODE" field="id_code"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Outlet" field="wcrm_outlet"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Created On" field="created_on"}
{/block}
{block name="td_ext"}
    <td>{$i.wcrm_team_leader}</td>
    <td>{$i.id_code}</td>
    <td>{$i.wcrm_outlet}</td>
    <td>{$i.created_on}</td>
{/block}