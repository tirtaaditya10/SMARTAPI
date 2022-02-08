{if $sys.cfg.xhr}
    <div class="row">
        <div class="col-md-12">
            <h1 class="txt-color-red login-header-big">Wyeth CRM System</h1>
            <div class="hero">
                <div class="pull-left login-desc-box-l">
                    <h4 class="paragraph-header">It's a lovely day, but you don't have sufficient privilege to access</h4>
                    <small class="txt-color-orangeDark">but, you can dance with me ...</small>
                    <audio autoplay src="/crm/pub/media/imagine-dragons-thunder.mp3"></audio>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div style="height:318px; background:url('/crm/asset/img/warning/err_403_e.jpg') center center no-repeat;"></div>
        </div>
    </div>
{else}
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
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 hidden-xs hidden-sm">
                            <h1 class="txt-color-red login-header-big">Wyeth CRM System</h1>
                            <div class="hero">
                                <div class="pull-left login-desc-box-l">
                                    <h4 class="paragraph-header">It's a lovely day, but you don't have sufficient privilege to access</h4>
                                    <h5 id="quote_author" class="about-heading" style="margin-top: 50px;"></h5>
                                    <em id="quote_content"></em>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                            <div style="height:318px; background:#fff url('/crm/asset/img/warning/err_403_e.jpg') center no-repeat;"></div>
                        </div>
                    </div>
                    <script>
		                $(function () {
			                // https://favqs.com/api/qotd
			                $.get('https://talaikis.com/api/quotes/random/', function (rsp) {
				                $('#quote_author').html(rsp.author);
				                $('#quote_content').html(rsp.quote);
			                });
		                });
                    </script>
                </div>
            </div>
            {include file="index/body_footer.tpl"}
            {include file="index/body_js_lite.tpl"}
            {$smarty.capture.quote}
        </body>
    </html>
{/if}