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
					<h5><strong>Ops! {$msg.head}</strong></h5>
				</div>
				<div class="well-content no-search">
					<form method="post" action="{$sys.cfg.url}err/report">
						<input class="span8" name="url" value="{$msg.url}" />
						<textarea name="msg">{$msg.msg}</textarea>
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
