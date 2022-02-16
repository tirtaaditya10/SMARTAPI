<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
	{include file="index/head.tpl"}
	<body class="fixed-header fixed-navigation fixed-ribbon fixed-page-footer">
        <div class='wm_container' >
            <div class='bg_color_ball'></div>
            <div class='wm_message_board'><span>Connection Lost</span><span class='icon'></span></div>
        </div>
		{include file="index/body_header.tpl"}
		{include file="index/body_aside.tpl"}
		<div id="main" role="main">
			<div id="ribbon">
                <span class="ribbon-button-alignment">
					<span class="btn-ribbon" data-title="Home" rel="tooltip"><i class="fa-fw fa fa-home txt-color-white"></i></span>
				</span>
				<!-- breadcrumb -->
				<ol class="breadcrumb"></ol>
				<!-- end breadcrumb -->
			</div>
			<div id="content"></div>
		</div>
		{include file="index/body_footer.tpl"}
		{include file="index/body_shortcut.tpl"}
		{include file="index/body_js.tpl"}
	</body>
</html>