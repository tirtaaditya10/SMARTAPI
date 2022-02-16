{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="widget_toolbar_21"}
    <div class="widget-toolbar" id="widget_toolbar_21" style="display:none;">
        <button class="button-icon btn btn-danger" title="Upload to Stage II"><i class="fa fa-gear"></i> Upload to Stage II</button>
    </div>
{/block}
{block name="th_ext"}
{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Campaign Type" field="wcrm_campaign_type"}
{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Team " field="wcrm_query"}
{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Target Type" field="target_type"}
{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Param 1" field="param_1"}
{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Param 2" field="param_2"}
{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Param 3" field="param_3"}
{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Param 4" field="param_4"}
{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Dist to" field="dist_to"}
{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Dist to S" field="dist_to_s"}
{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Exec On" field="exec_on"}
{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Created On" field="created_on"}

{/block}
{block name="td_ext"}
<td>{$i.wcrm_campaign_type}</td>
<td>{$i.wcrm_query}</td>
<td>{$i.target_type}</td>
<td>{$i.param_1}</td>
<td>{$i.param_2}</td>
<td>{$i.param_3}</td>
<td>{$i.param_4}</td>
<td>{$i.dist_to}</td>
<td>{$i.dist_to_s}</td>
<td>{$i.exec_on}</td>
<td>{$i.created_on}</td>

{/block}