{if !isset($pky_type)}
	{assign "pky_type" 'char'}
{/if}
{if !isset($display)}
	{assign "display" ' display-hide'}
{else}
	{assign "display" ''}
{/if}
{if $display eq ' display-hide' && $pky_type neq 'serial'}
	{assign "display" ''}
{/if}
{if !isset($WEml)}
	{if $pky_type eq 'char' || $pky_type eq 'serial'}
		{assign "WEml" 3}
	{else}
		{assign "WEml" 2}
	{/if}
{/if}
<div class="form-group first{$display}">
	<label for="{$pkey|default:'id_{$sys.req.rid}'}" class="col-md-{$WLbl|default:3} control-label">{$label|default:'ID'} <span class="required">*</span></label>
	<div class="col-md-{$WElm|default:3}">
		<input id="act" name="act" value="{if $sys.rsp.dat.id}upd{else}add{/if}" type="hidden" />
		{if $sys.rsp.dat.id}
			<div class="input-group">
				<input type="text" name="id_{$sys.req.rid}" class="form-control" value="{$sys.rsp.dat.id}" readonly required />
				<span class="input-group-addon"><i class="icon-lock"></i></span>
			</div>
		{else}
			{if $pky_type eq 'char'}
				<input type="text" name="id_{$sys.req.rid}" class="form-control unique"
					required data-required="true" data-msg-required="{$msg_required|default:'This Column is Mandatory'}"
					{if isset($minlength)}data-minlength="{$minlength}"{/if}    {if isset($msg_minlength)}data-msg-minlength="{$msg_minlength}"{/if}
					{if isset($maxlength)}data-maxlength="{$maxlength}"{/if}    {if isset($msg_maxlength)}data-msg-maxlength="{$msg_maxlength}"{/if}
					data-remote="{$sys.req.rid}"  data-msg-remote="{$msg_remote|default:'This value is already used'}"
				/>
				{if isset($msg_helper)}<span class="help-block">{$msg_helper}</span>{/if}
			{elseif $pky_type eq 'num'}
				<input type="number" name="id_{$sys.req.rid}" class="form-control numeric unique" data-source="{$sys.req.rid}" step="{$step|default:1}" maxlength="{$maxlength|default:3}"
						required data-required="true"   data-msg-required="{$msg_required|default:'This Column is Mandatory'}"
						data-remote="{$sys.req.rid}"        data-msg-remote="{$msg_remote|default:'This value is already used'}"
				/>
			{elseif $pky_type eq 'serial'}
				<div class="input-group">
					<input type="text" name="id_{$sys.req.rid}" class="form-control" readonly />
					<span class="input-group-addon"><i class="icon-lock"></i></span>
				</div>
				<span class="help-block">Auto-Number</span>
			{/if}
		{/if}
	</div>
</div>
