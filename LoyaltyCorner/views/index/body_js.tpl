<!--================================================== -->
<!--script src="{$sys.cfg.asset}js/plugin/wiremonkey/wiremonkey.js"></script-->
<!-- #PLUGINS -->
<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->

<script src="{$sys.cfg.asset}js/libs/jquery-3.2.1.min.js"></script>
<!--script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	if (!window.jQuery) {
		document.write('<script src="{$sys.cfg.asset}js/libs/jquery-3.2.1.min.js"><\/script>');
	}
</script-->
<script src="{$sys.cfg.asset}js/libs/jquery-ui.min.js"></script>
<!--script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
	if (!window.jQuery.ui) {
		document.write('<script src="{$sys.cfg.asset}js/libs/jquery-ui.min.js"><\/script>');
	}
</script-->

<!-- IMPORTANT: APP CONFIG -->
<script src="{$sys.cfg.asset}js/app/app.config.js"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="{$sys.cfg.asset}js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="{$sys.cfg.asset}js/bootstrap/bootstrap.min.js"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="{$sys.cfg.asset}js/notification/SmartNotification.min.js"></script>

<!-- JARVIS WIDGETS -->
<script src="{$sys.cfg.asset}js/smartwidgets/jarvis.widget.min.js"></script>

<!-- EASY PIE CHARTS -->
<script src="{$sys.cfg.asset}js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

<!-- SPARKLINES -->
<script src="{$sys.cfg.asset}js/plugin/sparkline/jquery.sparkline.min.js"></script>

<!-- JQUERY VALIDATE -->
<script src="{$sys.cfg.asset}js/plugin/jquery-validate/jquery.validate.min.js"></script>

<!-- JQUERY MASKED INPUT -->
<script src="{$sys.cfg.asset}js/plugin/masked-input/jquery.maskedinput.min.js"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="{$sys.cfg.asset}js/plugin/select2/select2.min.js"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src="{$sys.cfg.asset}js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

<!-- browser msie issue fix -->
<script src="{$sys.cfg.asset}js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

<!-- FastClick: For mobile devices: you can disable this in app.js -->
<script src="{$sys.cfg.asset}js/plugin/fastclick/fastclick.min.js"></script>

<script src="{$sys.cfg.asset}js/plugin/toastr/toastr.min.js"></script>
<!--script type="module" src="{$sys.cfg.asset}js/plugin/spin/spin.js"></script-->
<script src="{$sys.cfg.asset}js/plugin/spin/spin.js"></script>
<script src="{$sys.cfg.asset}js/plugin/jquery-form/jquery-form.min.js"></script>

<!--script src="{$sys.cfg.asset}js/plugin/moment/moment.min.js"></script>
<script src="{$sys.cfg.asset}js/plugin/footable/js/footable.js"></script-->

<!--[if IE 8]>
<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
<![endif]-->

<!-- MAIN APP JS FILE -->
<script src="{$sys.cfg.asset}js/app/app.js?{$smarty.now}"></script>
<script src="{$sys.cfg.asset}js/app/app.lib.js"></script>
<script src="{$sys.cfg.asset}js/app/app.event.js?{$smarty.now}"></script>
<script src="{$sys.cfg.asset}js/app/page/home.js"></script>