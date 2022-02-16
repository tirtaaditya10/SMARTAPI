<div class="portlet light margin-bottom-0">
	<div class="portlet-title">
		<div class="caption">
			<span class="caption-subject txt-color-green-sharp">
				<i class="{$sys.rpc[$sys.req.rid].sys_icon}"></i>
				{$sys.rpc[$sys.req.rid].sys_header|default:"{$sys.rpc[$sys.req.rid].sys_process}"}
			</span>
		</div>
		<div class="actions">
			{if $sys.cfg.fs}
				<a href="javascript:" class="btn btn-sm btn-circle blue-sharp btn-toggle btnSearch" data-target="#divSearch_{$sys.req.rid}" title="Search"><i class="glyphicon glyphicon-search"></i></a>
			{/if}
			{if $sys.rpc[$sys.req.rid].right.bat}
				<a href="javascript:" class="btn btn-sm btn-circle blue-sharp btn-toggle" data-target="#divExIm_{$sys.req.rid}" title="Import">
					<i class="glyphicon glyphicon-import"></i></a>
			{/if}
			{if isset($sys.rpc[$sys.req.rid].right) && $sys.rpc[$sys.req.rid].right.exp}
				<div class="btn-group">
					<a href="javascript:" class="btn btn-sm btn-circle blue-sharp" data-toggle="dropdown" aria-expanded="false" title="Download"><i class="glyphicon glyphicon-import"></i></a>
					<ul class="dropdown-menu pull-right">
						<li><a class="export" href="javascript:" data-url="#{$sys.req.rid}/xls"><i class="fa fa-file-excel-o"></i>Format Ms-Excel</a></li>
						<li><a class="export" href="javascript:" data-url="#{$sys.req.rid}/pdf"><i class="fa fa-file-pdf-o"></i>Format PDF</a></li>
					</ul>
				</div>
			{/if}
		</div>
	</div>
	<div class="portlet-body">
		<div id="divSearch_{$sys.req.rid}" class="portlet box bordered grey-cascade divSearch display-hide">
			<div class="portlet-title"><div class="caption" style="padding:15px 20px;"><i class="icon-magnifier"></i> Search Parameters</div></div>
			<div class="portlet-body">{include file="{$sys.uix.elm}/hst/portlet_search.tpl"}</div>
		</div>
		{if $sys.rpc[$sys.req.rid].right.bat && isset($sys.rsp.upl)}
			<div id="divExIm_{$sys.req.rid}" class="portlet box bordered grey-cascade" style="display:none;">
				<div class="portlet-body form">
					<form class="uForm" enctype="multipart/form-data" method="post" action="{$sys.cfg.url}cp/upload/{$sys.rsp.upl|default:0}/{$sys.req.rid}">
						<div class="note note-danger">
							<p> 1. Verifikasi ulang antara data asal dan data terunggah<br />
							    2. Pastikan jumlah baris sama<br />
							    3. Pastikan akumulasi nilai sama<br />
							    4. Perhatikan data dengan warna merah, verifikasi apakah sesuai dengan data asal
							</p>
						</div>
						<div class="row fileupload-buttonbar">
							<div class="col-lg-7">
												<span class="btn green fileinput-button"> <i class="fa fa-plus"></i>
													<span> Add files... </span>
													<input type="file" multiple="" name="files[]">
												</span>
								<button class="btn blue start" type="submit"><i class="fa fa-upload"></i> <span> Start upload </span></button>
								<button class="btn warning cancel" type="reset"><i class="fa fa-ban-circle"></i> <span> Cancel upload </span></button>
								<button class="btn red delete" type="button"><i class="fa fa-trash"></i><span> Delete </span></button>
								<input type="checkbox" class="toggle" />
								<span class="fileupload-process"> </span>
							</div>
							<div class="col-lg-5 fileupload-progress fade">
								<div aria-valuemax="100" aria-valuemin="0" role="progressbar" class="progress progress-striped active">
									<div style="width:0%;" class="progress-bar progress-bar-success"></div>
								</div>
								<div class="progress-extended"></div>
							</div>
						</div>
					</form>
				</div>
			</div>
		{/if}
		<div class="clearfix">
			<div id="{$sys.uix.pct}" class="root-pct dataTables_wrapper no-footer">
				{include file="{$sys.uix.tpl}/{$sys.uix.gui}"}
			</div>
		</div>
	</div>
</div>
{include file="{$sys.uix.elm}/misc/div_pcd.tpl"}