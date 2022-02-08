<!DOCTYPE html>
<html lang="en-us" id="extr-page">
	{include file="index/head.tpl"}
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
								<h4 class="paragraph-header">It's a lovely day, but we need you to login first</h4>
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
							<form id="login-form" class="smart-form client-form" action="{$sys.cfg.url}login" method="post">
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
									{if isset($err_login)}
										<div class="alert alert-danger fade in">
											<button class="close" data-dismiss="alert">
												×
											</button>
											<i class="fa-fw fa fa-times"></i>
											<strong>Error!</strong> {$err_login}
										</div>
									{/if}
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
		{include file="index/body_js_lite.tpl"}
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