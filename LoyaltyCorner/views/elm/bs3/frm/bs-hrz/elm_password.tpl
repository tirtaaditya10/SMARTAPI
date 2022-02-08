{if !isset($display) || $display eq 1 || $display eq true}
	{assign 'display' ''}
{else}
	{assign 'display' ' display-hide'}
{/if}
<div class="form-group{$display}">
	<label for="password" class="col-md-{$WLbl|default:3} control-label">Password <span class="required">*</span></label>
	<div class="col-md-{$WElm|default:9}">
		<div class="input-icon right">
			<i class="fa fa-key"></i>
			<input type="password" id="password" name="password" class="form-control"
			    title="password" placeholder="password"
				data-required="true"
				{if isset($minlength)}data-minlength="{$minlength}"{/if} {if isset($msg_minlength)}data-msg-minlength="{$msg_minlength}"{/if}
				{if isset($maxlength)}data-maxlength="{$maxlength}"{/if} {if isset($msg_maxlength)}data-msg-maxlength="{$msg_maxlength}"{/if}
				style="width:175px;" />
		</div>
		<span class="help-block">Provide your password. Never use your birthday or any easy thing associated with you</span>
	</div>
</div>
{if isset($equalTo)}
<div class="form-group">
	<label for="rpassword" class="col-md-{$WLbl|default:3} control-label">Confirm <span class="required">*</span></label>
	<div class="col-md-{$WElm|default:9}">
		<div class="input-icon right">
			<i class="fa fa-lock"></i>
			<input type="password" id="rpassword" name="rpassword" title="confirm password" placeholder="confirm password" class="form-control"
			       data-required="true" data-rule-equalTo="#password" style="width:175px;" />
		</div>
		<span class="help-block">Confirm your password</span>
	</div>
</div>
{/if}
