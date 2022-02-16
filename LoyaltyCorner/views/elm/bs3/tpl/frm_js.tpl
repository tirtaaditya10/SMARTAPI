{block name="script_page_pre"}{/block}
{block name="script_chart_pre"}{/block}
<script>
	jQuery(function() {
		AGV.site = AGV.host + '{$sys.cfg.app.cdir}{$sys.cfg.app.ctrl}/';
        {if $sys.req.aud}
            toastr.options.escapeHtml = true;
            {if $sys.ack.err}
                toastr.options.positionClass = "toast-top-full-width";
                toastr.options.timeOut = 15000;

                var tFunc   = 'error',
                    tCrud   = {
                    add: 'Data was unsuccessfully/failed added',
                    upd: 'Data was unsuccessfully/failed updated',
                    del: 'Data was unsuccessfully/failed deleted !!!'
                };
                if ($sys.callback.msg)
                    tCrud += '<br/>{$sys.ack.msg}';
            {else}
                toastr.options.positionClass = "toast-top-right";
                toastr.options.timeOut = 5000;

                var tFunc   = 'success',
                    tCrud   = {
                    add: 'Data was successfully added',
                    upd: 'Data was successfully updated',
                    del: 'Data was successfully deleted'
                };
            {/if}
            toastr[tFunc](tCrud.{$sys.req.aud}, 'DATA MODIFICATION');
        {/if}

		page_setup();
		bs3ui.form();

        {block name="jquery_page_ready"}{/block}
        {block name="jquery_chart_ready"}{/block}
	});
</script>
{block name="script_page_pst"}{/block}
{block name="script_chart_pst"}{/block}
{block name="script_external"}{/block}