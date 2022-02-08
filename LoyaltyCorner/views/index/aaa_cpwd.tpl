<!DOCTYPE html>
<html lang="en-us" id="extr-page">
	<head>
		<meta charset="utf-8">
		<title>WYETH CRM System</title>
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- #CSS Links -->
		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="asset/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="asset/css/font-awesome-4.min.css">

		<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
		<link rel="stylesheet" type="text/css" media="screen" href="asset/css/smartadmin-production-plugins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="asset/css/smartadmin-production.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="asset/css/smartadmin-skins.min.css">

		<!-- SmartAdmin RTL Support -->
		<link rel="stylesheet" type="text/css" media="screen" href="asset/css/smartadmin-rtl.min.css"> 

		<!-- We recommend you use "your_style.css" to override SmartAdmin
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		<link rel="stylesheet" type="text/css" media="screen" href="asset/css/your_style.css"> -->

		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="asset/css/demo.min.css">

		<!-- #FAVICONS -->
		<link rel="shortcut icon" href="asset/img/favicon/favicon/favicon.ico" type="image/x-icon">
		<link rel="icon" href="asset/img/favicon/favicon/favicon.ico" type="image/x-icon">

		<!-- #GOOGLE FONT -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
	</head>
	
	<body class="animated fadeInDown">
		<header id="header">
			<div id="logo-group">
				<span id="logo"> <img src="asset/img/logo/login_wyeth.png" alt="Wyeth CRM"> </span>
			</div>
		</header>

		<div id="main" role="main">
			<!-- MAIN CONTENT -->
			<div id="content" class="container">

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
						<h1 class="txt-color-red login-header-big">Wyeth CRM System</h1>
						<div class="hero">
							<div class="pull-left login-desc-box-l">
								<h4 class="paragraph-header">It's a lovely Day, but we need you to login first</h4>
							</div>
							<img src="asset/img/logo/login_smart.png" class="pull-right display-image" alt="" style="width:210px">
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<h5 id="quote_author" class="about-heading"></h5>
								<em id="quote_content"></em>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
						<div class="well no-padding">
							<form action="login" id="login-form" class="smart-form client-form">
								<header>Sign In</header>
								<fieldset>
									<section>
										<label class="label">Username</label>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="text" name="username">
											<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter username</b></label>
									</section>
									<section>
										<label class="label">Password</label>
										<label class="input"> <i class="icon-append fa fa-lock"></i>
											<input type="password" name="password">
											<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
									</section>
								</fieldset>
								<footer>
									<button type="submit" class="btn btn-primary">Login</button>
								</footer>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>

		<!--================================================== -->
		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<script src="asset/js/plugin/pace/pace.min.js"></script>

	    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
	    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script> if (!window.jQuery) { document.write('<script src="asset/js/libs/jquery-3.2.1.min.js"><\/script>');} </script>

	    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<script> if (!window.jQuery.ui) { document.write('<script src="asset/js/libs/jquery-ui.min.js"><\/script>');} </script>

		<!-- IMPORTANT: APP CONFIG -->
		<script src="asset/js/app/app.config.js"></script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events 		
		<script src="asset/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

		<!-- BOOTSTRAP JS -->		
		<script src="asset/js/bootstrap/bootstrap.min.js"></script>
		<!-- JQUERY VALIDATE -->
		<script src="asset/js/plugin/jquery-validate/jquery.validate.min.js"></script>
		<!-- JQUERY MASKED INPUT -->
		<script src="asset/js/plugin/masked-input/jquery.maskedinput.min.js"></script>
		
		<!--[if IE 8]>
			<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
		<![endif]-->

		<!-- MAIN APP JS FILE -->
		<script src="asset/js/app/app.default.min.js"></script>

		<script>
			runAllForms();
			$(function() {
				// Validation
				$("#login-form").validate({
					// Rules for form validation
					rules : {
						username : {
							required : true
						},
						password : {
							required : true,
							minlength : 3,
							maxlength : 20
						}
					},

					// Messages for form validation
					messages : {
						username : {
							required : 'Please enter your username',
							username : 'Please enter a VALID username'
						},
						password : {
							required : 'Please enter your password'
						}
					},

					// Do not change code below
					errorPlacement : function(error, element) {
						error.insertAfter(element.parent());
					}
				});

				// https://favqs.com/api/qotd
				$.get('https://talaikis.com/api/quotes/random/', function (rsp) {
					$('#quote_author').html(rsp.author);
					$('#quote_content').html(rsp.quote);
				});
			});
		</script>

	</body>
</html>