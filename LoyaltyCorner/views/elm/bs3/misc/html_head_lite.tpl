<!DOCTYPE html>
<!--[if IE 8]><html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]><html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><html lang="en"><!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	{include file="html_meta.tpl"}
	<link rel="stylesheet" type="text/css" href="{$sys.cfg.asset}plugin/_font/opensans.css" />
	<link rel="stylesheet" type="text/css" href="{$sys.cfg.asset}plugin/_font/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="{$sys.cfg.asset}plugin/_font/simple-line-icons/simple-line-icons.min.css" />
	<link rel="stylesheet" type="text/css" href="{$sys.cfg.asset}plugin/bootstrap/css/bootstrap.min.css" />
	{if isset($custom)}<link rel="stylesheet" type="text/css" href="{$sys.cfg.asset}app/page/css/{$custom}.css" />{/if}
	<link rel="stylesheet" type="text/css" href="{$sys.cfg.asset}layout/metronic/global/css/components-md.min.css" />
	<link rel="stylesheet" type="text/css" href="{$sys.cfg.asset}layout/metronic/global/css/plugins-md.min.css" />
	<link rel="stylesheet" type="text/css" href="{$sys.cfg.asset}layout/metronic/layout/css/layout.min.css" />
	<link rel="stylesheet" type="text/css" href="{$sys.cfg.asset}layout/metronic/layout/css/themes/default.min.css" />
	{include file="html_favicon.tpl"}
	<script>
		var AGV = ({

			host: '{$sys.cfg.host}',
			idleTime: 0,
			loading: true,
			xhr: null,
			is_crud: false,
			reminder: false,
			cForm: null,
			cModal: null,
			cTarget: false,
			cErr: false,
			cMid: 0,
			cURL: {
				aud: null,
				aux: null,
				upl: null
			},
			cPRM : {
				aud: [],
				aux: [],
				upl: []
			},
			aDoc: "doc, docx, xls, xlsx, ppt, pptx, pdf, odt, jpg, gif, png, jpeg, zip, rar, tar, gz, z, bz2, b1",
			init: function() {
				this.asset  = this.host + 'asset/';
				this.site   = this.host + '{$sys.cfg.app.id_code}/';
				return this;
			}
		}).init();
	</script>
</head>
