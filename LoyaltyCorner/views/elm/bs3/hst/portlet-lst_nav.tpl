{if $sys.uix.nav}
	<div class="portlet light margin-bottom-0">
		<div class="portlet-title">
			<div class="caption">
				{include file="{$sys.uix.elm}/misc/breadcrumbs-lst.tpl"}
			</div>
			<div class="actions">
				<a class="btn btn-sm btn-circle blue-sharp fullscreen" style="height:auto;" href="javascript:" data-original-title="" title="Max / Min Screen"><i class="fa fa-expand"></i></a></a>
			</div>
		</div>
		<div class="portlet-body">
			{if $sys.uix.fsDefault}
				<div id="divSearch_{$sys.req.rid}" class="portlet box bordered grey-cascade divSearch{if $sys.uix.fsHide} display-hide{/if}">
					<div class="portlet-title"><div class="caption" style="padding:15px 20px;"><i class="icon-magnifier"></i> Search Parameters</div></div>
					<div class="portlet-body">{include file="{$sys.uix.elm}/hst/portlet_search.tpl"}</div>
				</div>
			{/if}
			<div class="clearfix">
				{include file="{$sys.uix.tpl}/{$sys.uix.nav}"}
			</div>
		</div>
	</div>
{else}
	{include file="{$sys.uix.elm}/hst/portlet-lst_tab-inner.tpl"}
{/if}
