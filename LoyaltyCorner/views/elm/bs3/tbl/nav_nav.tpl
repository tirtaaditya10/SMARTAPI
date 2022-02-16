<div class="row">
	<div class="col-md-5 col-sm-12">
		<div class="dataTables_info" role="status" aria-live="polite">
			Total Data: {$sys.rsp.tot}<br />Displaying Page {$sys.nav.pgC}/{$sys.nav.pgT}
			{if isset($msg)}<br/><span class="text-warning">{$msg}</span>{/if}
		</div>
	</div>
	<div class="col-md-7 col-sm-12">
		<div class="dataTables_paginate paging_simple_numbers">
			{if isset($sys.nav) && count($sys.nav.pgS) gte 1}
				<ul class="pagination">
					{if $sys.nav.pgP}
					<li class="paginate_button previous" tabindex="0">
						<a href="javascript:" data-url="#{$sys.req.rid}{if $sys.req.pid}/{$sys.req.pid}{/if}{if $sys.req.fid}/{$sys.req.fid}{/if}{if $sys.req.xid}/{$sys.req.xid}{/if}{if $sys.req.zid}/{$sys.req.zid}{/if}?p={$sys.nav.pgP}&tab=1" data-target="#{$sys.uix.pct}" class="nav_tab"><i class="fa fa-angle-left"></i></a>
					</li>
					{/if}
					{foreach from=$sys.nav.pgS item=p}
						<li class="paginate_button {if $sys.nav.pgC eq $p}active{/if}" tabindex="0">
							<a href="javascript:" data-url="#{$sys.req.rid}{if $sys.req.pid}/{$sys.req.pid}{/if}{if $sys.req.fid}/{$sys.req.fid}{/if}{if $sys.req.xid}/{$sys.req.xid}{/if}{if $sys.req.zid}/{$sys.req.zid}{/if}?p={$p}&tab=1" data-target="#{$sys.uix.pct}" class="nav_tab">{$p}</a>
						</li>
					{/foreach}
					{if $sys.nav.pgN}
					<li class="paginate_button next" tabindex="0">
						<a href="javascript:" data-url="#{$sys.req.rid}{if $sys.req.pid}/{$sys.req.pid}{/if}{if $sys.req.fid}/{$sys.req.fid}{/if}{if $sys.req.xid}/{$sys.req.xid}{/if}{if $sys.req.zid}/{$sys.req.zid}{/if}?p={$sys.nav.pgN}&tab=1" data-target="#{$sys.uix.pct}" class="nav_tab"><i class="fa fa-angle-right"></i></a>
					</li>
					{/if}
				</ul>
			{/if}
		</div>
	</div>
</div>
