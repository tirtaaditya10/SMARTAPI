<head>
	<script src="{$sys.cfg.asset}js/plugin/pace/pace.js" ></script>
	<link rel="stylesheet" type="text/css" media="screen" href="{$sys.cfg.asset}js/plugin/pace/themes/purple/pace-theme-fill-left.css">
	{include file="index/head_meta.tpl"}
	{include file="index/head_css.tpl"}
	<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices) -->


	<script>
		paceOptions = {
			elements: true
		};

		var AGV = ({
			host: '{$sys.cfg.host}',
			xhr: null,
			form: null,
			target: null,
			url: null,
			aud: {
				url: null,
				prm: []
			},
			aux : {
				url: null,
				prm: []
			},
			upl: {
				url: null,
				prm: []
			},
			error: false,
			aDoc: "doc,docx,xls,xlsx,ppt,pptx,pdf,odt,ods,odp,jpg,gif,png,jpeg,zip,rar,tar,gz,z,bz2,b1",
			idleTime: 0,
			loading: true,
			is_crud: false,
			reminder: false,
			init: function() {
				this.asset  = '{$sys.cfg.asset}';
				this.site   = this.host + '{$sys.cfg.app.cdir}{$sys.cfg.app.ctrl}/';
				this.reset();
				return this;
			},
			reset: function() {
				this.xhr = null;
				this.origin = null;
				this.form = null;
				this.target = null;
				this.url = null;
				this.error = false;
				return this;
			},
			loading: function() {
				if(jQuery.type(this.target) === "string")
					this.target = $(this.target);
				this.target.html("<div class='circleX'></div><div class='circleY'></div>");
			},
			errMsg: function(msg) {
				if(msg)
					this.target.html(msg);
				else
					this.target.html('<h4 class="ajax-loading-error"><i class="fa fa-warning txt-color-orangeDark"></i> Error requesting <span class="txt-color-red">' + AGV.url + '</span>: ' + AGV.xhr.status);
			}
		}).init();
	</script>
</head>