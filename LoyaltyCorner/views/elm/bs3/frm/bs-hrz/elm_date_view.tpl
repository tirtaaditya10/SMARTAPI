{assign var=value       value=$sys.rsp.dat.$name|default:''}
{if !isset($grid_0)}    {assign var=grid_0      value=3}{/if}
{if !isset($grid_1)}    {assign var=grid_1      value=9}{/if}

{if !isset($format)}    {assign var=format      value="%d-%b-%Y"}{/if}

{if !isset($cfg)}       {assign var=cfg         value=[]}{/if}
{if !isset($cfg.plain)} {$cfg.plain = 0}{/if}

{capture name="elm_date"}
    <div class="input-group date">
        <input type="text" class="form-control" readonly value="{$value|date_format:$format}" />
        <span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span>
    </div>
{/capture}

{if $cfg.plain}
    {$smarty.capture.elm_date}
{else}
    <div class="form-group">
        <label class="col-md-{$grid_0} control-label">{$label}</label>
        <div class="col-md-{$grid_1}">
            {$smarty.capture.elm_date}
        </div>
    </div>
{/if}

