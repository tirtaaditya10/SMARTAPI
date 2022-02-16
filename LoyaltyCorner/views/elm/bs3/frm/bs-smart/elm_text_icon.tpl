{assign 'value' $sys.rsp.dat.$name|default:''}

{if !isset($class)}
    {assign 'class' ''}
{elseif $class eq 'unique'}
    {assign 'remote' {$sys.req.rid}
{/if}

<section>
    <label class="label">{$label}</label>
    <label class="input"> <i class="icon-append {$icon}"></i>
        <input type="text" class="{$class|default:''}"
            id="{$name}_{$sys.req.rid}" {if $ctrl|default:1}name="{$name}"{/if} value='{$value}' data-value='{$value}'
            {if isset($disabled)}disabled{/if}
            {if isset($title)}title="{$title}" placeholder="{$title}"{/if}
            {if $class eq 'unique'}
                data-rule-unique="{if $value}true{else}false{/if}"
                data-remote="{$remote}"
                data-msg-remote="{$msg_remote|default:'This value is already used'}"
            {/if}
            {if isset($required)}required data-rule-required="true" data-msg-required="{$msg_required|default:'This Column is Mandatory !'}"{/if}
            {if isset($minlength)}minlength="{$minlength}" data-rule-minlength="{$minlength}" data-msg-minlength='{$msg_minlength|default:"Min. Length: {$minlength} chars"}'{/if}
            {if isset($maxlength)}maxlength="{$maxlength}" data-rule-maxlength="{$maxlength}" data-msg-maxlength='{$msg_maxlength|default:"Max. Length: {$maxlength} chars"}'{/if}
            {if isset($rule_remote)}data-rule-remote="{$rule_remote}"{/if}
            {if isset($msg_err)}data-error-container="#{$name}_error"{/if}/>
    </label>
</section>