{if $sys.nav}
	<div class="row divHostNav">
		<div class="col-md-3 col-sm-12">
			<div class="dataTables_info font-sm padding-10" role="status" aria-live="polite" style="font-style: normal">
				Total Data: {$sys.rsp.tot}<br />Displaying Page {$sys.nav.pgC}/{$sys.nav.pgT}
			</div>
		</div>
		<div class="col-md-9 col-sm-12">
			<div class="dataTables_paginate paging_simple_numbers padding-10">
				{if isset($sys.nav) && count($sys.nav.pgS) gte 1}
					<ul class="pagination">
						{if $sys.nav.pgP}
						<li class="paginate_button previous" tabindex="0">
							<a href="javascript:" class="nav_lst" data-paging="{$sys.nav.pgP}"><i class="fa fa-angle-left"></i></a>
						</li>
						{/if}
						{foreach from=$sys.nav.pgS item=p}
							<li class="paginate_button {if $sys.nav.pgC eq $p}active{/if}" tabindex="0">
								<a href="javascript:" class="nav_lst" data-paging="{$p}">{$p}</a>
							</li>
						{/foreach}
						{if $sys.nav.pgN}
						<li class="paginate_button next" tabindex="0">
							<a href="javascript:" class="nav_lst" data-paging="{$sys.nav.pgN}"><i class="fa fa-angle-right"></i></a>
						</li>
						{/if}
					</ul>
				{/if}
			</div>
		</div>
		<div class="col-md-12">
			{include file="{$sys.uix.elm}/misc/div_performance.tpl"}
		</div>
	</div>
	{if isset($msg)}
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<span class="text-warning">{$msg}</span>
		</div>
	</div>
	{/if}
{/if}