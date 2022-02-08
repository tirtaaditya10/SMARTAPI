<th data-sort-ignore="true" style="width:{$span|default:48}px;">
	{if $sys.prc.sys_aaa.right.ins}
		<a href="javascript:" class="pcdOpen do-hvr-pulse txt-color-white" title="New Data" data-target="#{$target|default:$sys.uix.pcd}" data-url="#{$url|default:$sys.req.rid|cat:'/new'}{block name='th_url'}{/block}">[ <i class="fa fa-plus do-hvr-spin"></i> ]</a>
	{else}
		<!-- a href="javascript:" class="font-weight txt-color-white" title="New Data"><i class="fa fa-cogs"></i></a-->
		<a href="javascript:" class="pcdOpen do-hvr-pulse txt-color-white" title="New Data" data-target="#{$target|default:$sys.uix.pcd}" data-url="#{$url|default:$sys.req.rid|cat:'/new'}{block name='th_url'}{/block}">[ <i class="fa fa-plus do-hvr-spin"></i> ]</a>
	{/if}
</th>
