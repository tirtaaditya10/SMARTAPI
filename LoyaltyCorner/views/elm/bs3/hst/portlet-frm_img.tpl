<div class="portlet light margin-bottom-0">
	<div class="portlet-title">
		<div class="caption txt-color-yellow">
			{if $sys.rpc[$sys.req.rid].sys_header}
				{if $sys.rpc[$sys.req.rid].sys_header eq 'sys_rsp_dat_name'}
					<span class="caption-subject txt-color-green-sharp">{$sys.rsp.dat[$sys.bpm.tbl]}</span>
				{else}
					<span class="caption-subject txt-color-green-sharp">{$sys.rpc[$sys.req.rid].sys_header}</span>
				{/if}
			{/if}
		</div>
		<div class="actions">
			{if $sys.uix.btnUpl}
				{if $sys.rpc[$sys.req.rid].meta.doc && $sys.rpc[$sys.req.rid].right.upd && $sys.rpc[$sys.req.rid].right.doc}
					<a class="btn btn-circle btn-icon-only green btn-upl-simple" data-target="#elm_upload" href="#" title="Upload PDF/Doc/Image"><i class="icon-paper-clip"></i></a>
				{/if}
			{/if}
			<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:" title="Max / Min Screen"></a>
			{if $sys.uix.btnCls}
				<a class="btn btn-circle btn-icon-only btn-default pcdClose {if $sys.uix.reload}refresh{/if}" href="javascript:" data-target="#{$sys.uix.pcm}" data-url="#{$sys.uix.reload}" data-original-title="" title="Close"><i class="icon-power"></i></a>
			{/if}
		</div>
	</div>
	<div class="portlet-body">
		{include file="{$sys.uix.tpl}/{$sys.uix.gui}"}
	</div>
</div>
