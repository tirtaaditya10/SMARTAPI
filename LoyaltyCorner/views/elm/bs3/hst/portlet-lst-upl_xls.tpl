<div class="widget-toolbar">
    <div class="btn-group">
        <button class="button-icon btn btn-primary btn-jarvis btn-import dropdown-toggle" title="Import Data" rel="tooltip" data-toggle="dropdown"> Upload File <i class="fa fa-chevron-down"></i></button>
        <div class="dropdown-menu dropdown-menu-right form-login stop-propagation">
            <form class="form-inline" style="padding:15px">
                <div class="form-group form-inline margin-bottom-10">
                    <select id="svc_code" name="svc_code" class="form-control input-sm" required>
                        <option value="">Select Data to Upload</option>
                        {foreach from=$sys.rsp.aux.upl_entity_type item=i}
                            <option value="{$i.id}"{if $i.id eq 'wcrm_acq_customer'} checked{/if}>{$i.nm}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group form-inline pull-right">
                    <label for="svc_file" class="pull-right">
                        <span class="button-icon btn btn-primary" title="Import via Excel" rel="tooltip" aria-hidden="true">
                            <i class="fi excel-icon txt-color-greenLight"></i>
                            <span>Select File</span>
                        </span>
                        <input type="file" id="svc_file" data-rid="{$sys.req.rid}" style="display:none">
                    </label>
                </div>
            </form>
            <div class="bar-holder" style="display: none;">
                <div class="progress progress-sm" style="width:100%">
                    <progress id="progress" class="progress-bar bg-color-blue" data-transitiongoal="0" style="font-size:0.8em; line-height:1.5em; width:0%">0%</progress>
                </div>
            </div>
        </div>
    </div>
</div>