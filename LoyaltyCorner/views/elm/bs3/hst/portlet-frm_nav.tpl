<div class="portlet solid light margin-bottom-0 md-shadow-z-{$shadow|default:2}-i">
	<div class="portlet-title">
		<div class="caption txt-color-yellow">
			<span class="caption-subject txt-color-green-sharp">
				<i class="{$sys.rpc[$sys.req.rid].sys_icon}"></i>
				{$sys.rpc[$sys.req.rid].sys_header|default:"{$sys.rpc[$sys.req.rid].sys_process}"}
			</span>
		</div>
		<div class="actions">
			{if $sys.rpc[$sys.req.rid].right.doc && $sys.rpc[$sys.req.rid].right.upd}
				<a class="btn btn-circle btn-icon-only green btn-upl-simple" data-target="#elm_upload" href="#" title="Upload PDF/Doc/Image"><i class="icon-paper-clip"></i></a>
			{/if}
			<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:" title="Max / Min Screen"></a>
			{if $sys.uix.btnCls}
				<a class="btn btn-circle red pcdClose {if $sys.uix.reload}refresh{/if}" href="javascript:" data-target="#{$sys.uix.pcm}" data-url="#{$sys.uix.reload}" data-original-title="" title="Close"><i class="icon-power"></i></a>
			{/if}
		</div>
	</div>
	<div class="portlet-body">
		{if isset($sys.uix.nav)}
			{include file="{$sys.uix.tpl}/{$sys.uix.nav}"}
		{else}
			{include file="{$sys.uix.tpl}/{$sys.uix.gui}"}
		{/if}
		<div class="clearfix">
			{include file="{$sys.uix.elm}/misc/div_performance.tpl"}
		</div>
	</div>
</div>
