<form class="form-compact smart-form form-sibling">
    <div class="row">
        {foreach from=$sys.rsp.dat item=i}
            <div class="col col-md-4">
                <label class="checkbox">
                    <input name="checkbox" checked="checked" type="checkbox"><i></i>{$i.aaa_account}
                </label>
            </div>
        {/foreach}
    </div>
</form>