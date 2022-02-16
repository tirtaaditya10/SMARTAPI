<table id="dg" class="easyui-datagrid" title="Mass Upload" style="width:100%; height:450px;"
       url="asset/vendor/easyui/demo/datagrid/datagrid_data1.json" method="get"
       fit="true" fitColumn="true" singleSelect="true" multiSort="true" pagination="true" clientPaging="false"
       rownumbers="true" remoteFilter="true" toolbar="#tbar"
>
	<thead>
		<tr>
			<th data-options="field:'itemid',width:80">Item ID</th>
			<th data-options="field:'productid'">Product</th>
			<th data-options="field:'listprice',width:80,align:'right'">List Price</th>
			<th data-options="field:'unitcost',width:80,align:'right'">Unit Cost</th>
			<th data-options="field:'attr1'">Attribute</th>
			<th data-options="field:'status',width:60,align:'center'">Status</th>
		</tr>
	</thead>
</table>
<div id="tbar">
    <a href="javascript:" class="easyui-linkbutton" iconCls="icon-add"    plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
    <a href="javascript:" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Destroy</a>
    <a href="javascript:" class="easyui-linkbutton" iconCls="icon-save"   plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
    <a href="javascript:" class="easyui-linkbutton" iconCls="icon-undo"   plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
</div>
<script type="text/javascript">
$(function() {
    var dg = $('#dg').datagrid({
        url: 'dp/mu/load_data'
    });
    dg.datagrid('enableFilter', [{
        field:'listprice',
        type:'numberbox',
        options:{ precision:1 },
        op:['less','greater']
    },{
        field:'unitcost',
        type:'numberbox',
        options:{ precision:1 },
        op:['less','greater']
    }]);
})
</script>