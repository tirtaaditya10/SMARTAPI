{assign var=value       value=$sys.rsp.dat.$name|default:''}
<input type="{$cfg.type|default:'text'}" class="form-control {$cfg.class|default:''} text-{$cfg.align|default:'left'}"
       id="{$name}_{$sys.req.rid}" {if $cfg.ctrl|default:1}name="{$name}"{/if} value='{$value}' data-value='{$value}'
        {if $cfg.title|default:''}title="{$cfg.title}" placeholder="{$cfg.title}"{/if}
        {if $cfg.class|default:'' eq 'unique'}
            data-rule-unique="{if $value}true{else}false{/if}"
            data-remote="{$sys.req.rid}"
            data-msg-remote="{$cfg.msg_remote|default:'This value is already used'}"
        {/if}
        {if $cfg.disabled|default:0}disabled{/if}
        {if $cfg.readonly|default:0}readonly{/if}
        {if $cfg.required|default:0}required data-rule-required="true" data-msg-required="{$cfg.msg_required|default:'This Column is Mandatory !'}"{/if}
        {if $cfg.minlength|default:0}minlength="{$cfg.minlength}" data-rule-minlength="{$cfg.minlength}" data-msg-minlength='{$cfg.msg_minlength|default:"Min. Length: {$cfg.minlength} chars"}'{/if}
        {if $cfg.maxlength|default:0}maxlength="{$cfg.maxlength}" data-rule-maxlength="{$cfg.maxlength}" data-msg-maxlength='{$cfg.msg_maxlength|default:"Max. Length: {$cfg.maxlength} chars"}'{/if}
        {if $cfg.rule_remote|default:0}data-rule-remote="{$cfg.rule_remote}"{/if}
        {if $cfg.msg_err|default:''}data-error-container="#{$name}_{$sys.req.rid}_error"{/if}
/>