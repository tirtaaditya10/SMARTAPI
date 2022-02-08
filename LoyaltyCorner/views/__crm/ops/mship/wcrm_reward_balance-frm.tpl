<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal" role="form">
    <fieldset>
        <legend><i class="fa fa-2x fa-database"></i> <span class="font-lg txt-camo-earth">{$sys.prc.sys_prc.header}</span></legend>

        {include file="{$sys.uix.elm}/frm/dlg_error_form_validation.tpl"}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_pkey.tpl"}
        &ensp;

        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Reward Item:"         name="wcrm_reward" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Warehouse:"           name="wcrm_warehouse" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Quantity Available:"  name="qty_available" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Quantity On Hand:"    name="qty_onhand" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Alert Level:"         name="alert_level" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Created By:"          name="aaa_account" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Updated By:"          name="created_on" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/is_active.tpl"}
        
        <!-- <section class="col-sm-5 col-md-6">
        <a id="dialer_callme" class="pcdOpen btn btn-primary" href="javascript:" data-target="#PCD" data-url="#dialer_dialog">
            <i class="fa fa-edit hovicon tiny effect-8"></i>
        </a>

        <a id="dialer_callme1" class="pcdOpen btn btn-info" href="javascript:" data-target="#PCD" data-url="#dialer_dialog">
            <i class="fa fa-edit hovicon tiny effect-8"></i>
        </a>
        </sections> -->
        <div class="dropdown col-sm-5 col-md-6">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Menu
                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a id="dialer_callme" class="pcdOpen" href="javascript:" data-target="#PCD" data-url="#dialer_dialog">Incoming Stock</a></li>
                <li><a id="dialer_callme1" class="pcdOpen" href="javascript:" data-target="#PCD" data-url="#dialer_dialog">Outgoing Stock</a></li>
            </ul>
        </div>

    </fieldset>
    {include file="{$sys.uix.elm}/frm/btn_crud.tpl"}

</form>

<!-- IN -->
<div id="dialer_dialog" title="Dialer">
    <form class="form-horizontal">
        <div class="form-group">
            <label class="col-md-3 control-label">Type:</label>
            <div class="col-md-4" style="padding-left:0">
                <input type="text" name="wcrm_inv_trans_dir" required>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-3 control-label">Item ID:</label>
            <div class="col-md-4" style="padding-left:0">
                <input type="text" name="wcrm_reward">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Warehouse ID:</label>
            <div class="col-md-4" style="padding-left:0">
                <input type="text" name="wcrm_warehouse">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Trans Category</label>
            <div class="col-md-4" style="padding-left:0">
                <input type="text" name="wcrm_inv_trans_category">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Trans Date:</label>
            <div class="col-md-4" style="padding-left:0">
                <input type="text" name="transacted_on">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Quantity:</label>
            <div class="col-md-4" style="padding-left:0">
                <input type="text" name="qty">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Reference:</label>
            <div class="col-md-4" style="padding-left:0">
                <input type="text" name="reference">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Notes:</label>
            <div class="col-md-4" style="padding-left:0">
                <input type="text" name="notes">
            </div>
        </div>
    </form>
</div>

<!-- OUT -->
<div id="dialer_dialog" title="Dialer">
    <form class="form-horizontal">
        <div class="form-group">
            <label class="col-md-3 control-label">Type:</label>
            <div class="col-md-4" style="padding-left:0">
                <input type="text" name="wcrm_inv_trans_dir">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-3 control-label">Item ID:</label>
            <div class="col-md-4" style="padding-left:0">
                <input type="text" name="wcrm_reward">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Warehouse ID:</label>
            <div class="col-md-4" style="padding-left:0">
                <input type="text" name="wcrm_warehouse">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Trans Category</label>
            <div class="col-md-4" style="padding-left:0">
                <input type="text" name="wcrm_inv_trans_category">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Trans Date:</label>
            <div class="col-md-4" style="padding-left:0">
                <input type="text" name="transacted_on">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Quantity:</label>
            <div class="col-md-4" style="padding-left:0">
                <input type="text" name="qty">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Reference:</label>
            <div class="col-md-4" style="padding-left:0">
                <input type="text" name="reference">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Notes:</label>
            <div class="col-md-4" style="padding-left:0">
                <input type="text" name="notes">
            </div>
        </div>
    </form>
</div>

<script>
    $('#dialer_callme').click(function() {
        $('#dialer_dialog').dialog('open');
        return false;
    });
    $('#dialer_dialog').dialog({
        autoOpen : false,
        width : 600,
        resizable : false,
        modal : true,
        title : "Incoming Stock",
        buttons : [
            {   html : "<i class='fa fa-database'></i>&nbsp; Save Status",
                    "class" : "btn btn-default btn-save display-none",
                    click : function() {
                        // post-something-to-server
                        $(this).dialog('destroy').remove();
                    }
            },
            {   html : "<i class='fa fa-times'></i>&nbsp; Cancel",
                "class" : "btn btn-default",
                click : function() {
                    $(this).dialog('destroy').remove();
                }
            }
        ],
        close: function() {
            $(this).dialog('destroy').remove();
        }
    });
    $('#dialer_button').click(function() {
        $(this).parent().next().removeClass('display-none');
        $('.btn-save').removeClass('display-none');
        $.get('http://10.86.184.20:8085/crondialer.do?task=dial&extension={$sys.usr.phone_ext}&destination=' + $('#phone_number').val(), function (rsp) {
            console.info(rsp);
        })
    });
    $('#dialer_failed').click(function () {
        $(this).prev().hide().next().next().removeClass('display-none');
    })
    $('#dialer_connect').click(function () {
        $(this).html('<i class="fa fa-check"></i> Connected').next().hide();
    })
</script>


<script>
    $('#dialer_callme1').click(function() {
        $('#dialer_dialog').dialog('open');
        return false;
    });
    $('#dialer_dialog').dialog({
        autoOpen : false,
        width : 600,
        resizable : false,
        modal : true,
        title : "Outgoing Stock",
        buttons : [
            {   html : "<i class='fa fa-database'></i>&nbsp; Save Status",
                    "class" : "btn btn-default btn-save display-none",
                    click : function() {
                        // post-something-to-server
                        $(this).dialog('destroy').remove();
                    }
            },
            {   html : "<i class='fa fa-times'></i>&nbsp; Cancel",
                "class" : "btn btn-default",
                click : function() {
                    $(this).dialog('destroy').remove();
                }
            }
        ],
        close: function() {
            $(this).dialog('destroy').remove();
        }
    });
    $('#dialer_button').click(function() {
        $(this).parent().next().removeClass('display-none');
        $('.btn-save').removeClass('display-none');
        $.get('http://10.86.184.20:8085/crondialer.do?task=dial&extension={$sys.usr.phone_ext}&destination=' + $('#phone_number').val(), function (rsp) {
            console.info(rsp);
        })
    });
    $('#dialer_failed').click(function () {
        $(this).prev().hide().next().next().removeClass('display-none');
    })
    $('#dialer_connect').click(function () {
        $(this).html('<i class="fa fa-check"></i> Connected').next().hide();
    })
</script>