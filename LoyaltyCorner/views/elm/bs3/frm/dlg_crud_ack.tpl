<script>
<!--
{if $sys.req.ack}
	var tFunc   = 'success',
		tCrud   = { add: 'Data was successfully added.', upd: 'Data was successfully updated.', del: 'Data was successfully deleted.' };
{else}
	var tFunc   = 'error',
		tCrud   = { add: 'Data was unsuccessfully/failed added.', upd: 'Data was unsuccessfully/failed updated.', del: 'Data was unsuccessfully/failed deleted.' };
    {if $sys.req.msg}
        tCrud.{$sys.req.aud} += {$sys.req.aud};
    {/if}
{/if}

jQuery(function() {
	toastr[tFunc]( tCrud.{$sys.req.aud}, 'DATA MODIFICATION');
});
-->
</script>
