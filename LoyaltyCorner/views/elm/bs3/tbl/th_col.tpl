<th class="footable-sortable text-{$align|default:'left'}"
    {if isset($field)}
        data-field="{$field}"
        data-sort-order="{if $sys.req.f eq $field}{$sys.req.s}{/if}"
    {/if}
    {if isset($type)}
        data-type="{$type}"
        {if isset($decimal)}data-decimal-separator="{$decimal}"{/if}
        {if isset($thousand)}data-decimal-thousand="{$thousand}"{/if}
        {if isset($format)}data-format-string="{$format}"{/if}
    {/if}
    {if isset($break)}data-breakpoints="{$break}"{/if}
    {if isset($width)}style="width:{$width}"{/if}
>
    {if isset($icon)}
        {if isset($font) && $font eq 'md'}
            <i class="materialize-icon">{$icon}</i>
        {else}
            <i class="{$icon}"></i>
        {/if}
    {/if}
    {$label|upper}
    {if isset($field)}{if $sys.req.f eq $field}<i class="fa fa-sort-alpha-{$sys.req.s}"></i> {/if}{/if}
    {if isset($field)}<span class="fooicon fooicon-sort"></span>{/if}
</th>