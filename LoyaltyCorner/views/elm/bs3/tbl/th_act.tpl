<th class="text-center" data-sort-ignore="true" style="width:55px;">
	{if $sys.prc.sys_aaa.right.ins || $sys.prc.sys_aaa.right.exp}
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="javascript:" class="dropdown-toggle transparent" data-toggle="dropdown" aria-expanded="false" style=" padding: 0 10px"><i class="fa fa-cog"></i> <span class="caret"></span></a>
                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                    {if $sys.prc.sys_aaa.right.ins}
                        <li><a href="javascript:" class="pcdOpen" title="New Data" data-target="#{$target|default:$sys.uix.pcd}" data-url="#{$url|default:$sys.req.rid|cat:'/new'}{block name='th_url'}{/block}"><i class="fa fa-plus txt-color-blue"></i> New Data</a></li>
                    {/if}
                    <li class="divider"></li>
                    {if $sys.prc.sys_aaa.right.exp}
                        <li><a href="javascript:"><i class="fa fa-file-excel-o txt-color-green"></i> Excel</a></li>
                        <li><a href="javascript:"><i class="fa fa-file-pdf-o txt-color-red"></i> PDF</a></li>
                    {/if}
                </ul>
            </li>
        </ul>
	{else}
        <a href="javascript:" title="nothing here"><i class="fa fa-cog"></i></a>
	{/if}
</th>
