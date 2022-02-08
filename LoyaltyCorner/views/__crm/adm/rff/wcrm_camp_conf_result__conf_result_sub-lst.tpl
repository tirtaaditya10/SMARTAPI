{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="th_ext"}
	 {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CONF RESULT"  name="wcrm_camp_conf_result"        field="wcrm_camp_conf_result"}
	 {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="SUB RESULT"   name="wcrm_camp_conf_result_sub"    field="wcrm_camp_conf_result_sub"}
{/block}
{block name="td_ext"}
    <td>{$i.wcrm_camp_conf_result}</td>
    <td>{$i.wcrm_camp_conf_result_sub}</td>
{/block}