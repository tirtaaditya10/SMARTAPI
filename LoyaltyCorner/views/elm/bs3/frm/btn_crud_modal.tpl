{nocache}
    {if !isset($btnUpd) || $btnUpd eq 1 || $btnUpd eq true}
        {assign "btnUpd" 1}
    {elseif $btnUpd eq 'off' || $btnUpd eq 'false'}
        {assign "btnUpd" 0}
    {/if}

    {if !isset($btnDel) || $btnDel eq 1 || $btnDel eq true}
        {assign "btnDel" 1}
    {elseif $btnDel eq 'off' || $btnDel eq 'false'}
        {assign "btnDel" 0}
    {/if}

    {if !isset($urlClose)}{assign "urlClose" "$mid"}{/if}
    {if !isset($frmDel)}  {assign "frmDel" "dDelete"}{/if}
    {if !isset($pcdClose)}{assign "pcdClose" "dContent"}{/if}
{/nocache}
<div class="form_row" style="margin: 10px 0px 0px;">
    <div class="form-actions" style="margin:10px; padding:0px; background-color:transparent; border-top:none;">
        {if $btnUpd}
            {if $sys.rpc[$sys.req.rid].right.ins || $sys.rpc[$sys.req.rid].right.upd}<button type="submit" formnovalidate class="btn dark_green"><i class="icon-thumbs-up"></i> Save</button>{/if}
        {/if}
        {if $btnDel}
            {if $sys.rpc[$sys.req.rid].right.del}
                {if $iid neq 'new'}<button class="btn red" data-toggle="modal" href="#{$frmDel}">Delete</button>{/if}
            {/if}
        {/if}
        <a href="#" data-dismiss="modal" class="btn yellow pcdClose"><i class="icon-remove"></i> Close</a>
        {include file="form/box_notif.tpl" T=false}
    </div>
</div>
