<div class="top_bar">
	<ul class="breadcrumb">
		<li><a href="{$sys.cfg.url}"><i class="icon-home"></i></a><span class="divider"></span></li>
		<li><span>Error Database</span></li>
	</ul>
</div>
<div class="inner_content">
	<div class="widgets_area">
		<div class="row-fluid">
            <div class="well red">
				<div class="well-header">
					<h5><strong>Ops! A Database Error Occurred</strong></h5>
				</div>
				<div class="well-content no-search" style="height:400px; background: url({$sys.cfg.asset}app/page/img/warning/err_db.png) 50px 50px no-repeat">
					<form method="post" action="{$sys.cfg.url}err/report" style="padding-left:200px;">
						<div class="form_row control-group">
							<label class="field_name text-right">url :</label>
							<div class="field">
								{$msg.url}
								<input type="hidden" name="url" value="{$msg.url}" />
							</div>
						</div>
						<div class="form_row control-group">
							<label class="field_name text-right">message :</label>
							<div class="field">
								{$msg.msg}
								<textarea name="msg" style="display:none">{$msg.msg}</textarea>
							</div>
						</div>
	                    <div class="form_row control-group">
							<div class="field">
								<a href="{$sys.cfg.url}" class="btn blue">Go back to dashboard</a>
								<button class="btn red" type="submit"><i class="icon-remove"></i> Submit Error Report</button>
							</div>
						</div>
					</form>
                </div>
            </div>
        </div>
	</div>
</div>
