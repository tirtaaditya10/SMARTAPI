{if isset($value)}
{elseif !isset($sys.rsp.dat.$name)}
	{assign 'value' '000C46'}
{else}
	{assign 'value' $sys.rsp.dat.$name}
{/if}

{if !isset($ctrl)}
	{assign 'ctrl' 1}
{/if}
{if !isset($class)}
	{assign 'class' ''}
{elseif $class eq 'unique'}
	{assign 'remote' {$sys.req.rid}
{/if}
{if !isset($display) || $display eq 1 || $display eq true}
	{assign 'display' ''}
{else}
	{assign 'display' ' display-hide'}
{/if}
<div id="div_{$name}" class="form-group{$display}">
	<label class="col-md-{$WLbl|default:3} control-label" for="{$name}">{$label} {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{$WElm|default:9}">
		<div data-color-format="rgba" data-color="{$value}" class="input-group color colorpicker-default">
			<input type="text" class="form-control {$class} align-{$align|default:'left'}"
			       id="{$name}_{$sys.req.rid}" {if $ctrl}name="{$name}"{/if} value='{$value}' data-value='{$value}' readonly />
			<span class="input-group-btn"><button type="button" class="btn default"><i style="background-color: #3865a8;"></i>&nbsp;</button></span>
		</div>
		<span class="help-block">{$msg_helper|default:''}</span>
	</div>
</div>
