<link type="text/css" rel="stylesheet" href="{$sys.cfg.asset}app/css/splash/styleG.css" />
<!--[if lt IE 10]>
<link rel="stylesheet" type="text/css" href="{$sys.cfg.asset}app/css/splash/styleIE.css" />
<![endif]-->
<div class="sp-container" style="background:#4B77BE url({$sys.cfg.asset}adm/app/img/logos/logo-KF-48-blue.png) no-repeat 95% 90%">
	<div class="sp-content">
		<div class="sp-wrap sp-left">
			<h2>
				<span class="sp-top">Kimia</span>
				<span class="sp-mid">Intranet</span>
				<span class="sp-bottom">Welcome</span>
			</h2>
		</div>
		<div class="sp-wrap sp-right">
			<h2>
				<span class="sp-top">Farma</span>
				<span class="sp-mid">Portal</span>
				<span class="sp-bottom">{$sys.usr.account}</span>
			</h2>
		</div>
	</div>
	<div class="sp-full" style="margin-top:20px">
		<h1 style="color:#FFE6C9">You are in the Administration Page<br /><small style="color:#FFC27C">{$sys.sys_module|default:'Control Panel'} Section</small></h1>
		<a href="{$sys.cfg.host}docs/user_guide.pdf" target="_blank" class="txt-color-yellow-lemon">User Guide</a>
	</div>
</div>
