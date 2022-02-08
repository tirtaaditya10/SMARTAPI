<div class="portlet light margin-bottom-10">
	<div class="portlet-title">
		<div class="caption txt-color-white">{include file="{$sys.uix.elm}/breadcrumbs-frm.tpl"}</div>
		<div class="actions">
			<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:" title="Max / Min Screen"></a>
			{if $sys.uix.btnCls}
				<a class="btn btn-circle red btn-icon-only pcdClose {if $sys.uix.reload}refresh{/if}" href="javascript:" data-target="#{$sys.uix.pcm}" data-url="#{$sys.uix.reload}" data-original-title="" title="Close"><i class="icon-power"></i></a>
			{/if}
		</div>
	</div>
	<div class="portlet-body form">
		{if isset($sys.bpm.ext.dms_catalog_id) && isset($sys.rsp.dat.dms_media_viewer_id) && $sys.rsp.dat.dms_media_viewer_id}
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_docs" data-toggle="tab">Data</a></li>
				<li><a href="#viewer" data-toggle="tab">Preview</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_docs">
					{include file="{$sys.uix.tpl}/{$sys.uix.gui}"}
				</div>
				<div class="tab-pane" id="viewer">
					{include file="__dms/_dms/doc_mime_dat-uxd.tpl"}
				</div>
			</div>
		{else}
			{include file="{$sys.uix.tpl}/{$sys.uix.gui}"}
		{/if}
		<div class="clearfix">
			{include file="{$sys.uix.elm}/misc/div_performance.tpl"}
		</div>
	</div>
</div>
