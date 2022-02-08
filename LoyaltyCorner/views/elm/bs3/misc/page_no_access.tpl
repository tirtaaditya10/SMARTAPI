{include file="{$sys.uix.elm}/html_head_lite.tpl" custom="login-soft"}
<body class="login">
    <div class=""><a href="{$sys.cfg.url}"><img src="{$sys.cfg.asset}{$sys.cfg.app.media_logo}" alt="{$sys.cfg.app.sys_app}"/></a></div>
    <div class="menu-toggler sidebar-toggler"></div>
    <div class="content" style="width:500px"></div>
    {include file="{$sys.uix.elm}/copy_right.tpl" class="pull-left"}
    {include file="{$sys.uix.elm}/html_js_lite.tpl" custom="login-soft"}
    <script>
        jQuery(document).ready(function() {
            App.init(); // init metronic core components
            // Layout.init(); // init current layout
            $.backstretch(
                [
                    "{$sys.cfg.asset}app/page/img/warning/err_403.jpg"
                ],
                {   fade: 1000,
                    duration: 8000
                }
            );
        });
    </script>
</body>
</html>
