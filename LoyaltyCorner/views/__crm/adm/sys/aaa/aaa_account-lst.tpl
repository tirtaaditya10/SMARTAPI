{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="User"      field="aaa_account"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Email"     field="email"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Phone"     field="phone"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Ext"       field="phone_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Role"      field="aaa_acm"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Registered" field="registered"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Revoke"    field="revoked"}
{/block}
{block name="td_ext"}
    <td>{$i.aaa_account}</td>
    <td>{$i.email}</td>
    <td>{$i.phone}</td>
    <td>{$i.phone_ext}</td>
    <td>{$i.aaa_acm}</td>
    <td>{$i.registered}</td>
    <td>{$i.revoked}</td>
{/block}
