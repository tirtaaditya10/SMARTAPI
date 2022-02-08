<div class="portlet light margin-bottom-0">
	<div class="portlet-title">
		<div class="caption txt-color-white">
			{include file="{$sys.uix.elm}/misc/breadcrumbs-frm.tpl"}
			{if $sys.rpc[$sys.req.rid].sys_header}<span class="caption-subject txt-color-green-sharp" style="padding-left:44px;">{$sys.rpc[$sys.req.rid].sys_header}</span>{/if}
		</div>
		<div class="actions">
			{if $sys.uix.btnUpl}
				{if $sys.rpc[$sys.req.rid].meta.doc && $sys.rpc[$sys.req.rid].right.upd && $sys.rpc[$sys.req.rid].right.doc}
					<a class="btn btn-circle btn-icon-only green btn-upl-simple" data-target="#elm_upload" href="#" title="Upload PDF/Doc/Image"><i class="icon-paper-clip"></i></a>
				{/if}
			{/if}
			<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:" title="Max / Min Screen"></a>
			{if $sys.uix.btnCls}
				<a class="btn btn-circle red btn-icon-only pcdClose {if $sys.uix.reload}refresh{/if}" href="javascript:" data-target="#{$sys.uix.pcm}" data-url="#{$sys.uix.reload}" data-original-title="" title="Close"><i class="icon-power"></i></a>
			{/if}
		</div>
	</div>
	<div class="portlet-body">
		{if $sys.rsp.dat.id}
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_docs" data-toggle="tab">Data</a></li>
				<li><a href="#tab_task" class="refresh" data-toggle="tab" data-url="#{$sys.uix.callback}/{$sys.wfs.wfs_task_id}">Task</a></li>
				<li><a href="#viewer" data-toggle="tab">Preview</a></li>
			</ul>
			<div class="tab-content" style="padding:0;">
				<div class="tab-pane active" id="tab_docs">{include file="{$sys.uix.tpl}/{$sys.uix.gui}"}</div>
				<div class="tab-pane" id="tab_task"></div>
				<div class="tab-pane" id="viewer">{include file="__ecm/dms/dms_doc_viewer-uxd.tpl"}</div>
			</div>
		{else}
			{include file="{$sys.uix.tpl}/{$sys.uix.gui}"}
		{/if}
	</div>
</div>
