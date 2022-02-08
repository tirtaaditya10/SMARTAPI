<style>
.holder1	{ height:460px; margin:20px; padding:20px; background:url({$sys.cfg.asset}app/page/img/warning/bg.png) repeat;
	border-radius:8px;
	-o-border-radius:8px;
	-moz-border-radius:8px;
	-webkit-border-radius:8px;
}
.holder2		{ height:132px; margin:10px;
	border-radius:4px;
	-o-border-radius:4px;
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
}
h3 			{ color: orange; margin:10px; font: 40px Tahoma,Helvetica; text-shadow: 0 2px 3px #555555; }
.warning	{ color: white;   padding:0 10px; font-size: 14px; text-shadow: 0 7px 11px #390; }
.placer		{ display:inline-block; width:120px; height:122px; margin:8px; text-align:center; background:url({$sys.cfg.asset}app/page/img/warning/browser_bg.gif) no-repeat; }
</style>
<div class="holder1">
	<div>
		<h3>Incompatible Browser</h3>
		<p class="warning">
			You are using {$sys.cfg.agent.name} version {$sys.cfg.agent.version} which is not compatible for this application<br />
            This application build based on modern web-technology, sadly not supported by your current browser.<br />
            Please consider using the latest version.
		</p>
	</div>
	<center>
		<div class="holder2">
			<a target="_blank" class="placer" href="https://www.microsoft.com/en-us/download/internet-explorer.aspx"><img src="{$sys.cfg.asset}app/page/img/warning/browser_ie.gif" />Internet Explorer</a>
			<a target="_blank" class="placer" href="https://www.mozilla.org/en-US/firefox/new"><img src="{$sys.cfg.asset}app/page/img/warning/browser_firefox.gif" />Firefox</a>
			<a target="_blank" class="placer" href="https://www.google.com/chrome"><img src="{$sys.cfg.asset}app/page/img/warning/browser_chrome.gif" />Chrome</a>
			<a target="_blank" class="placer" href="http://www.opera.com/download"><img src="{$sys.cfg.asset}app/page/img/warning/browser_opera.gif" />Opera</a>
			<a target="_blank" class="placer" href="https://support.apple.com/downloads/safari"><img src="{$sys.cfg.asset}app/page/img/warning/browser_safari.gif" />Safari</a>
		</div>
	</center>
</div>