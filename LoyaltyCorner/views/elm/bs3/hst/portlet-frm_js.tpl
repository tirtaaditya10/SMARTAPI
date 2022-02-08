{if $sys.cfg.xhr}
	<script>
		jQuery(function() {
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
			{$smarty.capture.jquery_page}
			{$smarty.capture.jquery_chart}
		});
	</script>
    {$smarty.capture.script_page}
    {$smarty.capture.script_chart}
{/if}