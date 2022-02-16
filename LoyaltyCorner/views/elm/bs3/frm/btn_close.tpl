<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            {if $sys.uix.btnCls && !$sys.uix.fwd}
                <a class="btn btn-warning pcdClose" data-target="#{$targetCls|default:''}" title="Close Form"><i class="fa fa-arrow-circle-o-left"></i> {$lbl_cls|default:'Close'}</a>
            {/if}
        </div>
    </div>
</div>
