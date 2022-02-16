{if (!$sys.prc.sys_aaa.right.ins && !$sys.prc.sys_aaa.right.upd && !$sys.prc.sys_aaa.right.del) || $sys.req.ro}
    {assign "P" 1}
{/if}
<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            {if !$sys.req.ro}
                {if $sys.req.pid eq 'new'}
	                {if $sys.uix.btnUpd && $sys.prc.sys_aaa.right.ins}
                        <button type="submit" class="btn green" tabindex="199"><i class="fa fa-database do-hvr-spin"></i> {$lbl_submit|default:'Save'}</button>
	                {/if}
                {else}
                    {if $sys.uix.btnUpd && $sys.prc.sys_aaa.right.upd}
                        <button type="submit" class="btn green" tabindex="199"><i class="fa fa-database do-hvr-spin"></i> {$lbl_submit|default:'Save'}</button>
                    {/if}
                {/if}
                {if $sys.uix.btnDel && $sys.prc.sys_aaa.right.del && $sys.req.pid neq 'new'}
                    <a class="btn red frmDel" data-toggle="modal" data-target="#{$sys.uix.pcm}_xxx" title="Delete Data"><i class="fa fa-trash do-hvr-spin"></i> {$lbl_del|default:'Delete'}</a>
                {/if}
                {if $sys.uix.btnCls && !$sys.uix.fwd}
                    <a class="btn btn-warning pcdClose" data-target="#{$targetCls|default:''}" title="Close Form"><i class="fa fa-arrow-circle-o-left"></i> {$lbl_cls|default:'Close'}</a>
                {/if}
            {/if}
            {block name="btnCrud"}{/block}
        </div>
    </div>
    {include file="{$sys.uix.elm}/frm/dlg_crud_notif.tpl"}
</div>
