{if !isset($display) || $display eq 1 || $display eq true}
	{assign 'display' ''}
{else}
	{assign 'display' ' display-hide'}
{/if}
{assign 'SNType' 'Note'}

<div class="form-group{$display}">
	<label class="col-md-{$WLbl|default:3} control-label" for="{$name}">{$label} {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-9">
		<textarea id="{$name}_{$sys.req.rid}" name="{$name}" class="input-block-level summer{$SNType}">{$sys.rsp.dat.$name}</textarea>
	</div>
</div>
