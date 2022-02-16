<section>
    <label class="label">{$label}</label>
    <label class="textarea">
        <textarea id="{$name}_{$sys.req.rid}" {if $ctrl|default:1}name="{$name}"{/if} class="custom-scroll" rows="{$row|default:3}"
                {if isset($readonly)}readonly{/if} {if isset($disabled)}disabled{/if}
                {if isset($title)}title="{$title}" placeholder="{$title}"{/if}
                {if isset($required)}data-required="true" required{/if}     {if isset($msg_required)}data-msg-required="{$msg_required}"{/if}
                {if isset($minlength)}data-minlength="{$minlength}"{/if}    {if isset($msg_minlength)}data-msg-minlength="{$msg_minlength}"{/if}
                {if isset($maxlength)}data-maxlength="{$maxlength}" maxlength="{$maxlength}" {/if}    {if isset($msg_maxlength)}data-msg-maxlength="{$msg_maxlength}"{/if}
                {if isset($msg_err)}data-error-container="#{$name}_error"{/if} spellcheck="false">{$sys.rsp.dat.$name|default:''}</textarea>
    </label>
</section>