{include file="html_head.tpl"}
<body class="corporate page-md page-sidebar-closed-hide-logo page-header-fixed page-footer-fixed">
	{include file="{$sys.uix.tpl}/section_header.tpl"}
	<div class="main page-container">
		<div class="page-content-wrapper">
			<div style="margin:50px; height:400px; background:#ccc url('{$sys.cfg.asset}app/page/img/warning/err_referrer.png') right center no-repeat;">
				<div style="padding:75px;">
					<blockquote>
						I found you come to this page without proper referrer.<br />
						<a href="{$sys.cfg.url}">Go here</a>, visit your app and then come again from valid menu.
						<small><cite title="Author">Administrator</cite></small>
					</blockquote>
				</div>
			</div>
		</div>
	</div>
	{include file="{$sys.uix.tpl}/section_footer.tpl"}
	{include file="{$sys.uix.tpl}/body_js.tpl"}
</body>
</html>
