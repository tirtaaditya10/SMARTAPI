<link type="text/css" rel="stylesheet" href="{$sys.cfg.asset}app/page/css/error.min.css">
<div class="top_bar">
	<ul class="breadcrumb">
		<li><a href="{$sys.cfg.host}{$sys.uix.tpl}"><i class="icon-home"></i></a><span class="divider"></span></li>
		<li><span>Error 404</span></li>
	</ul>
</div>
<div class="inner_content">
	<div class="widgets_area" style="height:442px; background: url({$sys.cfg.asset}app/page/img/warning/err_404.png) 510px 0 no-repeat">
		<div class="row-fluid">
            <div class="span12">
                <div class="error_page" style="margin-top:60px;">
                    <div class="error_number"></div>
                    <div class="error_description">
                        <h3>Ops! Wrong turn?</h3>
                        <p>Sorry, the page you are looking for cannot be found.</p><br><br>
                    </div>
                    <div class="clearfix"></div>
                    <div class="buttons">
                        <a href="{$sys.cfg.host}{$sys.uix.tpl}" class="btn blue">Go back to dashboard</a>
                        <a href="#999" class="btn red">Contact support</a>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
