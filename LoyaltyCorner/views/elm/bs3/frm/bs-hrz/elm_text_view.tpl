{if !isset($grid_0)}    {assign var=grid_0      value=3}{/if}
{if !isset($grid_1)}    {assign var=grid_1      value=9}{/if}
<div class="form-group">
	<label class="col-md-{$grid_0} control-label">{$label}</label>
	<div class="col-md-{$grid_1}">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-lock"></i></span>
			<input type="text" class="form-control" value="{$sys.rsp.dat.$name}" readonly />
		</div>
	</div>
</div>
