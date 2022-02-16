{if !isset($grid)}      {assign var=grid    value=3}{/if}
<div class="form-group {$display|default:''}" {if isset($msg_helper)}style="margin-bottom:0"{/if}>
	<label for="{$name|default:'phone'}" class="col-md-{$grid} control-label">{$label|default:'Phone'} {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{math equation=12-$grid}">
        <div class="input-group input-icon">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
			<input type="tel" pattern="[6][2][8][1-9]{ 2 } [0-9]{ 4 } [0-9]{ 5 }" class="form-control phone" {if isset($disabled)}disabled{/if}
				id="{$name}_{$sys.req.rid}" name="{$name}" value="{$sys.rsp.dat.$name|default:''}"
				{if isset($title)}title="{$title1}" placeholder="{$title}"{/if}
				{if isset($required)}data-required="true" required{/if}     {if isset($msg_required)}data-msg-required="{$msg_required}"{/if}
				{if isset($msg_err)}data-error-container="#{$name1}_error"{/if}
			/>
		</div>
		<span class="help-block">{$msg_helper|default:''}</span>
	</div>
</div>