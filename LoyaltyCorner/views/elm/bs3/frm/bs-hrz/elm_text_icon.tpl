{assign var=value       value=$sys.rsp.dat.$name|default:''}
{if !isset($grid_0)}    {assign var=grid_0      value=3}{/if}
{if !isset($grid_1)}    {assign var=grid_1      value=9}{/if}

{if !isset($class)}     {assign var=class       value=''}{/if}
{if $class eq 'unique'} {assign var=remote      value={$sys.req.rid}{/if}

{if !isset($class)}     {assign var=class       value=''}{/if}

{if !isset($elm_only)}  {assign var=elm_only    value=0}{/if}

<div class="form-group{$display|default:''}">
	<label class="col-md-{$grid_0} control-label" for="{$name}">{$label} {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{$grid_1}">
		<div class="input-group input-icon">
			<span class="input-group-addon"><i class="{$icon}"></i></span>
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_input.tpl"}
			{if isset($readonly)}<span class="input-group-addon"><i class="fa fa-lock"></i></span>{/if}
			{if isset($msg_helper)}<span class="help-block">{$msg_helper}</span>{/if}
		</div>
	</div>
</div>
