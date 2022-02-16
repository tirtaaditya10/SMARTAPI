<?php
    // Program to display current page URL.
    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] 
                === 'on' ? "https" : "https") . 
                "://" . $_SERVER['HTTP_HOST'];
?>

<html class="no-js css-menubar" lang="en">
<head>
	<style type="text/css">.swal-icon--error {
			border-color: #f27474;
			-webkit-animation: animateErrorIcon .5s;
			animation: animateErrorIcon .5s
		}

		.swal-icon--error__x-mark {
			position: relative;
			display: block;
			-webkit-animation: animateXMark .5s;
			animation: animateXMark .5s
		}

		.swal-icon--error__line {
			position: absolute;
			height: 5px;
			width: 47px;
			background-color: #f27474;
			display: block;
			top: 37px;
			border-radius: 2px
		}

		.swal-icon--error__line--left {
			-webkit-transform: rotate(45deg);
			transform: rotate(45deg);
			left: 17px
		}

		.swal-icon--error__line--right {
			-webkit-transform: rotate(-45deg);
			transform: rotate(-45deg);
			right: 16px
		}

		@-webkit-keyframes animateErrorIcon {
			0% {
				-webkit-transform: rotateX(100deg);
				transform: rotateX(100deg);
				opacity: 0
			}
			to {
				-webkit-transform: rotateX(0deg);
				transform: rotateX(0deg);
				opacity: 1
			}
		}

		@keyframes animateErrorIcon {
			0% {
				-webkit-transform: rotateX(100deg);
				transform: rotateX(100deg);
				opacity: 0
			}
			to {
				-webkit-transform: rotateX(0deg);
				transform: rotateX(0deg);
				opacity: 1
			}
		}

		@-webkit-keyframes animateXMark {
			0% {
				-webkit-transform: scale(.4);
				transform: scale(.4);
				margin-top: 26px;
				opacity: 0
			}
			50% {
				-webkit-transform: scale(.4);
				transform: scale(.4);
				margin-top: 26px;
				opacity: 0
			}
			80% {
				-webkit-transform: scale(1.15);
				transform: scale(1.15);
				margin-top: -6px
			}
			to {
				-webkit-transform: scale(1);
				transform: scale(1);
				margin-top: 0;
				opacity: 1
			}
		}

		@keyframes animateXMark {
			0% {
				-webkit-transform: scale(.4);
				transform: scale(.4);
				margin-top: 26px;
				opacity: 0
			}
			50% {
				-webkit-transform: scale(.4);
				transform: scale(.4);
				margin-top: 26px;
				opacity: 0
			}
			80% {
				-webkit-transform: scale(1.15);
				transform: scale(1.15);
				margin-top: -6px
			}
			to {
				-webkit-transform: scale(1);
				transform: scale(1);
				margin-top: 0;
				opacity: 1
			}
		}

		.swal-icon--warning {
			border-color: #f8bb86;
			-webkit-animation: pulseWarning .75s infinite alternate;
			animation: pulseWarning .75s infinite alternate
		}

		.swal-icon--warning__body {
			width: 5px;
			height: 47px;
			top: 10px;
			border-radius: 2px;
			margin-left: -2px
		}

		.swal-icon--warning__body, .swal-icon--warning__dot {
			position: absolute;
			left: 50%;
			background-color: #f8bb86
		}

		.swal-icon--warning__dot {
			width: 7px;
			height: 7px;
			border-radius: 50%;
			margin-left: -4px;
			bottom: -11px
		}

		@-webkit-keyframes pulseWarning {
			0% {
				border-color: #f8d486
			}
			to {
				border-color: #f8bb86
			}
		}

		@keyframes pulseWarning {
			0% {
				border-color: #f8d486
			}
			to {
				border-color: #f8bb86
			}
		}

		.swal-icon--success {
			border-color: #a5dc86
		}

		.swal-icon--success:after, .swal-icon--success:before {
			content: "";
			border-radius: 50%;
			position: absolute;
			width: 60px;
			height: 120px;
			background: #fff;
			-webkit-transform: rotate(45deg);
			transform: rotate(45deg)
		}

		.swal-icon--success:before {
			border-radius: 120px 0 0 120px;
			top: -7px;
			left: -33px;
			-webkit-transform: rotate(-45deg);
			transform: rotate(-45deg);
			-webkit-transform-origin: 60px 60px;
			transform-origin: 60px 60px
		}

		.swal-icon--success:after {
			border-radius: 0 120px 120px 0;
			top: -11px;
			left: 30px;
			-webkit-transform: rotate(-45deg);
			transform: rotate(-45deg);
			-webkit-transform-origin: 0 60px;
			transform-origin: 0 60px;
			-webkit-animation: rotatePlaceholder 4.25s ease-in;
			animation: rotatePlaceholder 4.25s ease-in
		}

		.swal-icon--success__ring {
			width: 80px;
			height: 80px;
			border: 4px solid hsla(98, 55%, 69%, .2);
			border-radius: 50%;
			box-sizing: content-box;
			position: absolute;
			left: -4px;
			top: -4px;
			z-index: 2
		}

		.swal-icon--success__hide-corners {
			width: 5px;
			height: 90px;
			background-color: #fff;
			padding: 1px;
			position: absolute;
			left: 28px;
			top: 8px;
			z-index: 1;
			-webkit-transform: rotate(-45deg);
			transform: rotate(-45deg)
		}

		.swal-icon--success__line {
			height: 5px;
			background-color: #a5dc86;
			display: block;
			border-radius: 2px;
			position: absolute;
			z-index: 2
		}

		.swal-icon--success__line--tip {
			width: 25px;
			left: 14px;
			top: 46px;
			-webkit-transform: rotate(45deg);
			transform: rotate(45deg);
			-webkit-animation: animateSuccessTip .75s;
			animation: animateSuccessTip .75s
		}

		.swal-icon--success__line--long {
			width: 47px;
			right: 8px;
			top: 38px;
			-webkit-transform: rotate(-45deg);
			transform: rotate(-45deg);
			-webkit-animation: animateSuccessLong .75s;
			animation: animateSuccessLong .75s
		}

		@-webkit-keyframes rotatePlaceholder {
			0% {
				-webkit-transform: rotate(-45deg);
				transform: rotate(-45deg)
			}
			5% {
				-webkit-transform: rotate(-45deg);
				transform: rotate(-45deg)
			}
			12% {
				-webkit-transform: rotate(-405deg);
				transform: rotate(-405deg)
			}
			to {
				-webkit-transform: rotate(-405deg);
				transform: rotate(-405deg)
			}
		}

		@keyframes rotatePlaceholder {
			0% {
				-webkit-transform: rotate(-45deg);
				transform: rotate(-45deg)
			}
			5% {
				-webkit-transform: rotate(-45deg);
				transform: rotate(-45deg)
			}
			12% {
				-webkit-transform: rotate(-405deg);
				transform: rotate(-405deg)
			}
			to {
				-webkit-transform: rotate(-405deg);
				transform: rotate(-405deg)
			}
		}

		@-webkit-keyframes animateSuccessTip {
			0% {
				width: 0;
				left: 1px;
				top: 19px
			}
			54% {
				width: 0;
				left: 1px;
				top: 19px
			}
			70% {
				width: 50px;
				left: -8px;
				top: 37px
			}
			84% {
				width: 17px;
				left: 21px;
				top: 48px
			}
			to {
				width: 25px;
				left: 14px;
				top: 45px
			}
		}

		@keyframes animateSuccessTip {
			0% {
				width: 0;
				left: 1px;
				top: 19px
			}
			54% {
				width: 0;
				left: 1px;
				top: 19px
			}
			70% {
				width: 50px;
				left: -8px;
				top: 37px
			}
			84% {
				width: 17px;
				left: 21px;
				top: 48px
			}
			to {
				width: 25px;
				left: 14px;
				top: 45px
			}
		}

		@-webkit-keyframes animateSuccessLong {
			0% {
				width: 0;
				right: 46px;
				top: 54px
			}
			65% {
				width: 0;
				right: 46px;
				top: 54px
			}
			84% {
				width: 55px;
				right: 0;
				top: 35px
			}
			to {
				width: 47px;
				right: 8px;
				top: 38px
			}
		}

		@keyframes animateSuccessLong {
			0% {
				width: 0;
				right: 46px;
				top: 54px
			}
			65% {
				width: 0;
				right: 46px;
				top: 54px
			}
			84% {
				width: 55px;
				right: 0;
				top: 35px
			}
			to {
				width: 47px;
				right: 8px;
				top: 38px
			}
		}

		.swal-icon--info {
			border-color: #c9dae1
		}

		.swal-icon--info:before {
			width: 5px;
			height: 29px;
			bottom: 17px;
			border-radius: 2px;
			margin-left: -2px
		}

		.swal-icon--info:after, .swal-icon--info:before {
			content: "";
			position: absolute;
			left: 50%;
			background-color: #c9dae1
		}

		.swal-icon--info:after {
			width: 7px;
			height: 7px;
			border-radius: 50%;
			margin-left: -3px;
			top: 19px
		}

		.swal-icon {
			width: 80px;
			height: 80px;
			border-width: 4px;
			border-style: solid;
			border-radius: 50%;
			padding: 0;
			position: relative;
			box-sizing: content-box;
			margin: 20px auto
		}

		.swal-icon:first-child {
			margin-top: 32px
		}

		.swal-icon--custom {
			width: auto;
			height: auto;
			max-width: 100%;
			border: none;
			border-radius: 0
		}

		.swal-icon img {
			max-width: 100%;
			max-height: 100%
		}

		.swal-title {
			color: rgba(0, 0, 0, .65);
			font-weight: 600;
			text-transform: none;
			position: relative;
			display: block;
			padding: 13px 16px;
			font-size: 27px;
			line-height: normal;
			text-align: center;
			margin-bottom: 0
		}

		.swal-title:first-child {
			margin-top: 26px
		}

		.swal-title:not(:first-child) {
			padding-bottom: 0
		}

		.swal-title:not(:last-child) {
			margin-bottom: 13px
		}

		.swal-text {
			font-size: 16px;
			position: relative;
			float: none;
			line-height: normal;
			vertical-align: top;
			text-align: left;
			display: inline-block;
			margin: 0;
			padding: 0 10px;
			font-weight: 400;
			color: rgba(0, 0, 0, .64);
			max-width: calc(100% - 20px);
			overflow-wrap: break-word;
			box-sizing: border-box
		}

		.swal-text:first-child {
			margin-top: 45px
		}

		.swal-text:last-child {
			margin-bottom: 45px
		}

		.swal-footer {
			text-align: right;
			padding-top: 13px;
			margin-top: 13px;
			padding: 13px 16px;
			border-radius: inherit;
			border-top-left-radius: 0;
			border-top-right-radius: 0
		}

		.swal-button-container {
			margin: 5px;
			display: inline-block;
			position: relative
		}

		.swal-button {
			background-color: #7cd1f9;
			color: #fff;
			border: none;
			box-shadow: none;
			border-radius: 5px;
			font-weight: 600;
			font-size: 14px;
			padding: 10px 24px;
			margin: 0;
			cursor: pointer
		}

		.swal-button[not:disabled

		]
		:hover {
			background-color: #78cbf2
		}

		.swal-button:active {
			background-color: #70bce0
		}

		.swal-button:focus {
			outline: none;
			box-shadow: 0 0 0 1px #fff, 0 0 0 3px rgba(43, 114, 165, .29)
		}

		.swal-button[disabled] {
			opacity: .5;
			cursor: default
		}

		.swal-button::-moz-focus-inner {
			border: 0
		}

		.swal-button--cancel {
			color: #555;
			background-color: #efefef
		}

		.swal-button--cancel[not:disabled

		]
		:hover {
			background-color: #e8e8e8
		}

		.swal-button--cancel:active {
			background-color: #d7d7d7
		}

		.swal-button--cancel:focus {
			box-shadow: 0 0 0 1px #fff, 0 0 0 3px rgba(116, 136, 150, .29)
		}

		.swal-button--danger {
			background-color: #e64942
		}

		.swal-button--danger[not:disabled

		]
		:hover {
			background-color: #df4740
		}

		.swal-button--danger:active {
			background-color: #cf423b
		}

		.swal-button--danger:focus {
			box-shadow: 0 0 0 1px #fff, 0 0 0 3px rgba(165, 43, 43, .29)
		}

		.swal-content {
			padding: 0 20px;
			margin-top: 20px;
			font-size: medium
		}

		.swal-content:last-child {
			margin-bottom: 20px
		}

		.swal-content__input, .swal-content__textarea {
			-webkit-appearance: none;
			background-color: #fff;
			border: none;
			font-size: 14px;
			display: block;
			box-sizing: border-box;
			width: 100%;
			border: 1px solid rgba(0, 0, 0, .14);
			padding: 10px 13px;
			border-radius: 2px;
			transition: border-color .2s
		}

		.swal-content__input:focus, .swal-content__textarea:focus {
			outline: none;
			border-color: #6db8ff
		}

		.swal-content__textarea {
			resize: vertical
		}

		.swal-button--loading {
			color: transparent
		}

		.swal-button--loading ~ .swal-button__loader {
			opacity: 1
		}

		.swal-button__loader {
			position: absolute;
			height: auto;
			width: 43px;
			z-index: 2;
			left: 50%;
			top: 50%;
			-webkit-transform: translateX(-50%) translateY(-50%);
			transform: translateX(-50%) translateY(-50%);
			text-align: center;
			pointer-events: none;
			opacity: 0
		}

		.swal-button__loader div {
			display: inline-block;
			float: none;
			vertical-align: baseline;
			width: 9px;
			height: 9px;
			padding: 0;
			border: none;
			margin: 2px;
			opacity: .4;
			border-radius: 7px;
			background-color: hsla(0, 0%, 100%, .9);
			transition: background .2s;
			-webkit-animation: swal-loading-anim 1s infinite;
			animation: swal-loading-anim 1s infinite
		}

		.swal-button__loader div:nth-child(3n+2) {
			-webkit-animation-delay: .15s;
			animation-delay: .15s
		}

		.swal-button__loader div:nth-child(3n+3) {
			-webkit-animation-delay: .3s;
			animation-delay: .3s
		}

		@-webkit-keyframes swal-loading-anim {
			0% {
				opacity: .4
			}
			20% {
				opacity: .4
			}
			50% {
				opacity: 1
			}
			to {
				opacity: .4
			}
		}

		@keyframes swal-loading-anim {
			0% {
				opacity: .4
			}
			20% {
				opacity: .4
			}
			50% {
				opacity: 1
			}
			to {
				opacity: .4
			}
		}

		.swal-overlay {
			position: fixed;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			text-align: center;
			font-size: 0;
			overflow-y: auto;
			background-color: rgba(0, 0, 0, .4);
			z-index: 10000;
			pointer-events: none;
			opacity: 0;
			transition: opacity .3s
		}

		.swal-overlay:before {
			content: " ";
			display: inline-block;
			vertical-align: middle;
			height: 100%
		}

		.swal-overlay--show-modal {
			opacity: 1;
			pointer-events: auto
		}

		.swal-overlay--show-modal .swal-modal {
			opacity: 1;
			pointer-events: auto;
			box-sizing: border-box;
			-webkit-animation: showSweetAlert .3s;
			animation: showSweetAlert .3s;
			will-change: transform
		}

		.swal-modal {
			width: 478px;
			opacity: 0;
			pointer-events: none;
			background-color: #fff;
			text-align: center;
			border-radius: 5px;
			position: static;
			margin: 20px auto;
			display: inline-block;
			vertical-align: middle;
			-webkit-transform: scale(1);
			transform: scale(1);
			-webkit-transform-origin: 50% 50%;
			transform-origin: 50% 50%;
			z-index: 10001;
			transition: opacity .2s, -webkit-transform .3s;
			transition: transform .3s, opacity .2s;
			transition: transform .3s, opacity .2s, -webkit-transform .3s
		}

		@media (max-width: 500px) {
			.swal-modal {
				width: calc(100% - 20px)
			}
		}

		@-webkit-keyframes showSweetAlert {
			0% {
				-webkit-transform: scale(1);
				transform: scale(1)
			}
			1% {
				-webkit-transform: scale(.5);
				transform: scale(.5)
			}
			45% {
				-webkit-transform: scale(1.05);
				transform: scale(1.05)
			}
			80% {
				-webkit-transform: scale(.95);
				transform: scale(.95)
			}
			to {
				-webkit-transform: scale(1);
				transform: scale(1)
			}
		}

		@keyframes showSweetAlert {
			0% {
				-webkit-transform: scale(1);
				transform: scale(1)
			}
			1% {
				-webkit-transform: scale(.5);
				transform: scale(.5)
			}
			45% {
				-webkit-transform: scale(1.05);
				transform: scale(1.05)
			}
			80% {
				-webkit-transform: scale(.95);
				transform: scale(.95)
			}
			to {
				-webkit-transform: scale(1);
				transform: scale(1)
			}
		}</style>
	<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/pace/pace.js"></script>
	<link rel="stylesheet" type="text/css" media="screen"
		  href="<?=$link;?>/LoyaltyCorner/asset/js/plugin/pace/themes/purple/pace-theme-material.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="WYETH CRM Call Center">
	<meta name="author" content="Nestle Indonesia, Wyeth Nutrition, NDA Solution, Dian Yudha Negara">
	<title>Validate Receipt</title>    <!-- #CSS Links -->

	<link rel="stylesheet" type="text/css" media="screen" href="<?=$link;?>/LoyaltyCorner/asset/js/plugin/wiremonkey/wiremonkey.css">

	<!-- Basic Styles -->
	<link rel="stylesheet" type="text/css" media="screen" href="<?=$link;?>/LoyaltyCorner/asset/css/bootstrap.min.css">

	<!-- #GOOGLE FONT -->
	<link rel="stylesheet" type="text/css" media="screen" href="<?=$link;?>/LoyaltyCorner/asset/css/font-open-sans.css?family=Open+Sans:400italic,700italic,300,400,700">
	<link rel="stylesheet" type="text/css" media="screen" href="<?=$link;?>/LoyaltyCorner/asset/css/font-material-icons.css?family=Material+Icons">

	<link rel="stylesheet" type="text/css" media="screen" href="<?=$link;?>/LoyaltyCorner/asset/css/font-awesome-4.7.min.css">
	<!-- link rel="stylesheet" type="text/css" media="screen" href="<?=$link;?>/LoyaltyCorner/asset/css/font-awesome-5-all.min.css"-->
	<!--link rel="stylesheet" type="text/css" media="screen" href="<?=$link;?>/LoyaltyCorner/asset/css/material-design-iconic-font.min.css"-->
	<link rel="stylesheet" type="text/css" media="screen" href="<?=$link;?>/LoyaltyCorner/asset/css/font-file.css">
	<link rel="stylesheet" type="text/css" media="screen" href="<?=$link;?>/LoyaltyCorner/asset/css/colours.css">

	<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
	<link rel="stylesheet" type="text/css" media="screen"
		  href="<?=$link;?>/LoyaltyCorner/asset/css/smartadmin-production-plugins.min.css">
	<link rel="stylesheet" type="text/css" media="screen"
		  href="<?=$link;?>/LoyaltyCorner/asset/css/smartadmin-production.min.css">
	<link rel="stylesheet" type="text/css" media="screen"
		  href="<?=$link;?>/LoyaltyCorner/asset/css/smartadmin-skins.min.css">
	<link rel="stylesheet" type="text/css" media="screen"
		  href="<?=$link;?>/LoyaltyCorner/asset/js/libs/jquery-ui.theme.min.css">
	<link rel="stylesheet" type="text/css" media="screen"
		  href="<?=$link;?>/LoyaltyCorner/asset/js/plugin/toastr/toastr.min.css">
	<!-- We recommend you use "your_style.css" to override SmartAdmin
     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
 -->
	<link rel="stylesheet" type="text/css" media="screen"
		  href="<?=$link;?>/LoyaltyCorner/asset/css/wyeth_crm.css?1536190999">

	<!-- #FAVICONS -->
	<!--link rel="shortcut icon" type="image/x-icon" href="<?=$link;?>/LoyaltyCorner/asset/img/favicon/favicon.ico">
<link rel="icon" type="image/x-icon" href="<?=$link;?>/LoyaltyCorner/asset/img/favicon/favicon.ico" -->
	<link rel="icon" type="image/png" href="<?=$link;?>/LoyaltyCorner/asset/img/favicon/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?=$link;?>/LoyaltyCorner/asset/img/favicon/favicon-16x16.png" sizes="16x16">
	<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices) -->


	<script>
		paceOptions = {
			elements: true
		};

		var AGV = ({
			host: 'http://103.90.251.10/vbe/',
			xhr: null,
			form: null,
			target: null,
			url: null,
			aud: {
				url: null,
				prm: []
			},
			aux: {
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
			init: function () {
				this.ass3t = '<?=$link;?>/LoyaltyCorner/asset/';
				this.site = this.host + 'vbe/';
				this.reset();
				return this;
			},
			reset: function () {
				this.xhr = null;
				this.origin = null;
				this.form = null;
				this.target = null;
				this.url = null;
				this.error = false;
				return this;
			},
			loading: function () {
				if (jQuery.type(this.target) === "string")
					this.target = $(this.target);
				this.target.html("<div class='circleX'></div><div class='circleY'></div>");
			},
			errMsg: function (msg) {
				if (msg)
					this.target.html(msg);
				else
					this.target.html('<h4 class="ajax-loading-error"><i class="fa fa-warning txt-color-orangeDark"></i> Error requesting <span class="txt-color-red">' + AGV.url + '</span>: ' + AGV.xhr.status);
			}
		}).init();
	</script>
	<style type="text/css"></style>
	<style type="text/css">.jqstooltip {
			position: absolute;
			left: 0px;
			top: 0px;
			visibility: hidden;
			background: rgb(0, 0, 0) transparent;
			background-color: rgba(0, 0, 0, 0.6);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
			-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
			color: white;
			font: 10px arial, san serif;
			text-align: left;
			white-space: nowrap;
			padding: 5px;
			border: 1px solid white;
			z-index: 10000;
		}

		.jqsfield {
			color: white;
			font: 10px arial, san serif;
			text-align: left;
		}</style>
</head>
<body class="fixed-header fixed-navigation fixed-ribbon fixed-page-footer pace-running desktop-detected"
	  cz-shortcut-listen="true">
<!-- #HEADER -->
<header id="header">
	<div id="logo-group">
		<!-- PLACE YOUR LOGO HERE -->
				<img src="<?=$link;?>/LoyaltyCorner/asset/img/logo/home_top.png"
																  alt="Wyeth CRM"> </span></a>
		<!-- END LOGO PLACEHOLDER -->
	</div>

	<!-- #TOGGLE LAYOUT BUTTONS -->
	<!-- pulled right: nav area -->
	<div class="pull-right">

		<!-- collapse menu button -->
		<div id="hide-menu" class="btn-header pull-right">
			<span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i
						class="fa fa-reorder"></i></a> </span>
		</div>
		<!-- end collapse menu -->

		<!-- #MOBILE -->
		<!-- Top menu profile link : this shows only when top menu is active -->

		<!-- logout button -->
		<div id="logout" class="btn-header transparent pull-right">
			<span> <a href="logout" title="Sign Out" data-action="userLogout"
					  data-logout-msg="Thank you for your best work today"><i class="fa fa-sign-out"></i></a> </span>
		</div>
		<!-- end logout button -->

		<!-- search mobile button (this is hidden till mobile view port) -->
		<!--div id="search-mobile" class="btn-header transparent pull-right">
            <span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
        </div-->
		<!-- end search mobile button -->

		<!-- #SEARCH -->
		<!-- input: search field -->
		<!--form action="#ajax/search.html" class="header-search pull-right">
            <input id="search-fld" type="text" name="param" placeholder="Find reports and more">
            <button type="submit">
                <i class="fa fa-search"></i>
            </button>
            <a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
        </form-->
		<!-- end input: search field -->

		<!-- fullscreen button -->
		<div id="fullscreen" class="btn-header transparent pull-right">
			<span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i
						class="fa fa-arrows-alt"></i></a> </span>
		</div>
		<!-- end fullscreen button -->

	</div>
	<!-- end pulled right: nav area -->

</header>
<!-- END HEADER -->        <!-- #NAVIGATION -->
<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS/SASS variables -->
<aside id="left-panel">
	<!-- User info -->
	<div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as is -->
            <a href="javascript:" id="show-shortcut" data-action="toggleShortcut">
                <span>Admin</span>
                <i class="fa fa-angle-down"></i>
            </a>
        </span>
	</div>
	<!-- end user info -->

	<!-- NAVIGATION : This navigation is also responsive

    To make this navigation dynamic please make sure to link the node
    (the reference to the nav > ul) after page load. Or the navigation
    will not initialize.
    -->
	<nav>
		<!--
        NOTE: Notice the gaps after each icon usage <i></i>..
        Please note that these links work a bit different than
        traditional href="" links. See documentation for details.
        -->
		<ul>
			<li class="hidden">
				<a href="vbe/splash" title="Splash" baseuri="#"><i class="fa fa-lg fa-fw fa-home"></i><span class="menu-item-parent">Splash</span></a>
			</li>
			<li class="active">
				<a href="vbe/lst" id="M_520001034" class="" title="Validate Receipt">
					<i class="fa fa-eye"></i> Validate Receipt </a>
			</li>
		</ul>
	</nav>
	<span class="minifyme" data-action="minifyMenu" style="bottom:0px;"><i
			class="fa fa-arrow-circle-left hit"></i></span>
</aside>
<!-- END NAVIGATION -->
<div id="main" role="main">
	<div id="ribbon">
                <span class="ribbon-button-alignment">
					<span class="btn-ribbon" data-title="Home" rel="tooltip"><i
							class="fa-fw fa fa-home txt-color-white"></i></span>
				</span>
		<!-- breadcrumb -->
		<ol class="breadcrumb">
			<li>Home</li>
			<li>Validate Receipt</li>
		</ol>
		<!-- end breadcrumb -->
	</div>
	<div id="content" style="opacity: 1;">
		<!-- ==========================CONTENT STARTS HERE ========================== -->
		<!-- MAIN PANEL -->
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<div role="main">
			<!-- MAIN CONTENT -->
			<div>
				<div class="row">
					<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
						<h1 class="page-title txt-color-blueDark"><i class="fa fa-table fa-fw "></i>Validate Receipt
						</h1>
					</div>
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
					</div>
				</div>

				<!-- widget grid -->
				<section id="widget-grid" class="">
					<!-- row -->
					<div class="row">
						<!-- NEW WIDGET START -->
						<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

							<!-- Widget ID (each widget will need unique ID)-->
							<div class="jarviswidget jarviswidget-color-darken" id="wid-id-1"
								 data-widget-editbutton="false">

								<header>
									<span class="widget-icon"> <i class="fa fa-table"></i> </span>
								</header>

								<!-- widget div-->
								<div>

									<!-- widget edit box -->
									<div class="jarviswidget-editbox">
										<!-- This area used as dropdown edit box -->

									</div>
									<!-- end widget edit box -->

									<!-- widget content -->
									<div class="widget-body no-padding">
										<div style="width:100%">

										</div>
									</div>
									<!-- end widget content -->

								</div>
								<!-- end widget div -->

							</div>
							<!-- end widget -->

						</article>
						<!-- WIDGET END -->

						<!-- end row -->

					</div>
				</section>
				<!-- end widget grid -->

			</div>
			<!-- END MAIN CONTENT -->

		</div>
		<!-- END MAIN PANEL -->
		<!-- ==========================CONTENT ENDS HERE ========================== -->

		<!-- PAGE RELATED PLUGIN(S)
		<script src="..."></script>-->
		<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/datatables/jquery.dataTables.min.js"></script>
		<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/datatables/dataTables.colVis.min.js"></script>
		<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/datatables/dataTables.tableTools.min.js"></script>
		<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
		<script
			src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>


		<script>

			var responsiveHelper_dt_basic = undefined;
			var responsiveHelper_datatable_fixed_column = undefined;
			var responsiveHelper_datatable_col_reorder = undefined;
			var responsiveHelper_datatable_tabletools = undefined;

			var breakpointDefinition = {
				tablet: 1024,
				phone: 480
			};

			$('#dt_basic').dataTable({
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
					"t" +
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"autoWidth": true,
				"oLanguage": {
					"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
				},
				"preDrawCallback": function () {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_basic) {
						responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
					}
				},
				"rowCallback": function (nRow) {
					responsiveHelper_dt_basic.createExpandIcon(nRow);
				},
				"drawCallback": function (oSettings) {
					responsiveHelper_dt_basic.respond();
				}
			});

			function sbeFlag(PREV_NUMBER, PREV_ID, ID, FLAG) {
				$.ajax({
					type: "POST",
					data: {
						flag: FLAG,
						prev_id: PREV_ID,
						prev_number: PREV_NUMBER,
						id: ID
					},
					cache: false,
					success: function (response) {
						console.log(response);
						if (response == 'success') {
							swal("Success", "", "success")
								.then((value) => {
									location.reload();
								});
						} else {
							swal("Failed", "", "error");
						}
					}
				});
			}

		</script>
	</div>
</div>
<div class="page-footer">
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<span class="txt-color-white">WYETH CRM SYSTEM 2.0 © 2018</span>
		</div>

		<div class="col-xs-6 col-sm-6 text-right hidden-xs">
			<div class="txt-color-white inline-block">
				<i class="txt-color-blueLight hidden-mobile">Powered by <strong>leanXcellence &nbsp;</strong> </i>
				<!-- end btn-group-->
			</div>
			<!-- end div-->
		</div>
		<!-- end col -->
	</div>
	<!-- end row -->
</div>
<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/wiremonkey/wiremonkey.js"></script>
<script>
	window.onload = function () {
		WireMonkey.init();
	}
</script>
<!-- #PLUGINS -->
<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->

<script src="<?=$link;?>/LoyaltyCorner/asset/js/libs/jquery-3.2.1.min.js"></script>
<!--script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	if (!window.jQuery) {
		document.write('<script src="<?=$link;?>/LoyaltyCorner/asset/js/libs/jquery-3.2.1.min.js"><\/script>');
	}
</script-->
<script src="<?=$link;?>/LoyaltyCorner/asset/js/libs/jquery-ui.min.js"></script>
<!--script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
	if (!window.jQuery.ui) {
		document.write('<script src="<?=$link;?>/LoyaltyCorner/asset/js/libs/jquery-ui.min.js"><\/script>');
	}
</script-->

<!-- IMPORTANT: APP CONFIG -->
<script src="<?=$link;?>/LoyaltyCorner/asset/js/app/app.config.js"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="<?=$link;?>/LoyaltyCorner/asset/js/bootstrap/bootstrap.min.js"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="<?=$link;?>/LoyaltyCorner/asset/js/notification/SmartNotification.min.js"></script>

<!-- JARVIS WIDGETS -->
<script src="<?=$link;?>/LoyaltyCorner/asset/js/smartwidgets/jarvis.widget.min.js"></script>

<!-- EASY PIE CHARTS -->
<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

<!-- SPARKLINES -->
<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/sparkline/jquery.sparkline.min.js"></script>

<!-- JQUERY VALIDATE -->
<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/jquery-validate/jquery.validate.min.js"></script>

<!-- JQUERY MASKED INPUT -->
<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/select2/select2.min.js"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

<!-- browser msie issue fix -->
<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

<!-- FastClick: For mobile devices: you can disable this in app.js -->
<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/fastclick/fastclick.min.js"></script>

<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/toastr/toastr.min.js"></script>
<!--script type="module" src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/spin/spin.js"></script-->
<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/spin/spin.js"></script>
<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/jquery-form/jquery-form.min.js"></script>

<!--script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/moment/moment.min.js"></script>
<script src="<?=$link;?>/LoyaltyCorner/asset/js/plugin/footable/js/footable.js"></script-->

<!--[if IE 8]>
<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
<![endif]-->

<!-- MAIN APP JS FILE -->
<script src="<?=$link;?>/LoyaltyCorner/asset/js/app/app.js?1536190999"></script>
<script src="<?=$link;?>/LoyaltyCorner/asset/js/app/app.lib.js"></script>
<script src="<?=$link;?>/LoyaltyCorner/asset/js/app/app.event.js?1536190999"></script>
<script src="<?=$link;?>/LoyaltyCorner/asset/js/app/page/vbe.js"></script>
</body>
</html>
