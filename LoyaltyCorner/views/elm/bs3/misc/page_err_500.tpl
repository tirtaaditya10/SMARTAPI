<div class="top_bar">
	<ul class="breadcrumb">
		<li><a href="{$sys.cfg.url}"><i class="icon-home"></i></a><span class="divider"></span></li>
		<li><span>Error 500</span></li>
	</ul>
</div>
<div class="inner_content">
	<div class="widgets_area">
		<div class="row-fluid">
			<div class="well red">
				<div class="well-header">
					<h5><strong>Ops! There was an internal error on the page.</strong></h5>
				</div>
				<div class="well-content no-search" style="height:400px; background: url({$sys.cfg.asset}app/page/img/warning/err_500.png) 50px 50px no-repeat">
					<form method="post" action="{$sys.cfg.url}err/report" style="padding-left:200px;">
						{foreach from=$msg key=k item=v}
						<div class="form_row control-group">
							<label class="field_name text-right">{$k} :</label>
							<div class="field">
								{$v}
								<input type="hidden" name="{$k}" value="{$v}" />
							</div>
						</div>
						{/foreach}
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
