{if !isset($class)}
    {assign "class" "bs-select"}
{/if}

{if !isset($selected)}
    {assign "selected" $sys.rsp.selected}
{/if}

{if isset($name)}
{elseif isset($sys.rsp.name)}
    {assign "name" $sys.rsp.name}
{else}
    {assign "name" 0}
{/if}

{if isset($id)}
{elseif isset($sys.rsp.id)}
    {assign "id" $sys.rsp.id}
{else}
    {assign "id" 0}
{/if}

{if isset($attr)}
{elseif isset($sys.rsp.attr)}
    {assign "attr" $sys.rsp.attr}
{else}
    {assign "attr" ""}
{/if}

{if isset($title)}
{elseif isset($sys.rsp.title)}
    {assign "title" $sys.rsp.title}
{else}
    {assign "title" ""}
{/if}

{if isset($required)}
    {assign "required" true}
{else}
    {assign "required" 0}
{/if}

{if isset($width)}
    {assign "width" $width}
{elseif isset($sys.rsp.width)}
    {assign "width" $sys.rsp.width}
{else}
    {assign "width" "300px"}
{/if}

{if isset($sys.rsp.type) && $sys.rsp.type eq 'multiple'}
    {if isset($insearch)}
        <select class="{$class}{if isset($sys.rsp.cbl)} chaining{/if}" {if $id}id="{$id}"{/if} {if $name}name="{$name}"{/if} {if $required}required{/if} {$attr} data-placeholder="{$title}" title="{if $typ eq 'list'}Parameter: {/if}{$title}" {if isset($sys.rsp.cbl)}data-target="#{$sys.rsp.cbl}" data-source="{$sys.rsp.src}"{/if} style="width:{$width};">
            <option value=""></option>
            {if $dat}{html_options options=$sys.rsp.option selected=$selected}{/if}
        </select>
    {else}
        <select class="{$class}" multiple {if $id}id="{$id}"{/if} {if $name}name="{$name}[]"{/if} {if $required}required{/if} {$attr} data-placeholder="{$title}" title="{if $typ eq 'list'}Parameter: {/if}{$title}" style="width:{$width};">
            <option value=""></option>
            {if $dat}{html_options options=$sys.rsp.option selected=$selected}{/if}
        </select>
    {/if}
{elseif isset($sys.rsp.type) && $sys.rsp.type eq 'group'}
    <select class="{$class}{if isset($sys.rsp.cbl)} chaining{/if}" {if $id}id="{$id}"{/if} {if $name}name="{$name}"{/if} {if $required}required{/if} {$attr} data-placeholder="{$title}" title="{if $typ eq 'list'}Parameter: {/if}{$title}" {if isset($sys.rsp.cbl)}data-target="#{$sys.rsp.cbl}" data-source="{$sys.rsp.src}"{/if} style="width:{$width};">
        <option value=""></option>
        {if $dat}{html_options options=$sys.rsp.option selected=$selected}{/if}
    </select>
{else}
    <select class="{$class}{if isset($sys.rsp.cbl)} chaining{/if}" {if $id}id="{$id}"{/if} {if $name}name="{$name}"{/if} {if $required}required{/if} {$attr} data-type="btn-primary" data-placeholder="{$title}" title="{if $typ eq 'list'}Parameter: {/if}{$title}" {if isset($sys.rsp.cbl)}data-target="#{$sys.rsp.cbl}" data-source="{$sys.rsp.src}"{/if} style="width:{$width};">
        <option value=""></option>
        {if isset($sys.rsp.option)}{html_options values=$sys.rsp.option.id output=$sys.rsp.option.nm selected=$selected}{/if}
    </select>
{/if}
