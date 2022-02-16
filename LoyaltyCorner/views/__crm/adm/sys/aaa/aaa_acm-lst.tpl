{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl"   label="Clearance"   field="aaa_acm_clearance"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl"   label="Member"  field="member"}
{/block}
{block name="td_ext"}
    <td>{$i.aaa_acm_clearance}</td>
	<td>{$i.member}</td>
{/block}