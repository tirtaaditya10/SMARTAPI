<div class="row">
    <section class="col col-6">
        <label class="input">
            <i class="icon-append fa fa-calendar"></i>
            <input type="text" id="{$v.col_fid}_{$sys.req.rid}" class="date-pair-start" name="{$v.col_fid}['start']" value="{$v.sp_def.start|default:''}" placeholder="{$v.elm_label}" />
        </label>
    </section>
    <section class="col col-6">
        <label class="input">
            <i class="icon-append fa fa-calendar"></i>
            <input type="text" id="{$v.col_fid}_{$sys.req.rid}" class="date-pair-end"   name="{$v.col_fid}['end']" value="{$v.sp_def.end|default:''}" placeholder="From ~ Until" >
        </label>
    </section>
</div>