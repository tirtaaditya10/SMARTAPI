{if $sys.req.pid neq 'new'}
	<div class="portlet light margin-bottom-0">
		<div class="portlet-title">
			<div class="caption txt-color-yellow">{$sys.prc.sys_table}
				{if $sys.rpc[$sys.req.rid].sys_header}<span class="caption-subject txt-color-green-sharp" style="padding-left:44px;">{$sys.rpc[$sys.req.rid].sys_header}</span>{/if}
			</div>
			<div class="actions">
				{if $sys.uix.btnUpl}
					{if $sys.rpc[$sys.req.rid].meta.doc && $sys.rpc[$sys.req.rid].right.upd && $sys.rpc[$sys.req.rid].right.doc}
						<a class="btn btn-circle btn-icon-only green btn-upl-simple" data-target="#elm_upload" href="#" title="Upload PDF/Doc/Image"><i class="icon-paper-clip"></i></a>
					{/if}
				{/if}
				<a class="btn btn-circle btn-default btn-icon-only fullscreen" href="#" title="Max / Min Screen"></a>
				{if $sys.uix.btnCls}
					<a class="btn btn-circle btn-default btn-icon-only pcdClose {if $sys.uix.reload}refresh{/if}" href="javascript:" data-target="#{$sys.uix.pcm}" data-url="#{$sys.uix.reload}" data-original-title="" title="Close"><i class="icon-power"></i></a>
				{/if}
			</div>
		</div>
		<div class="portlet-body form">
			{include file="{$sys.uix.tpl}/{$sys.uix.gui}"}
		</div>
	</div>
	<div id="PCDD" class="root-pcd display-hide"></div>
{else}
	{include file="{$sys.uix.tpl}/{$sys.uix.gui}"}
{/if}
