<div class="widget-toolbar">
    <div class="btn-group">
        <button class="button-icon btn btn-primary btn-jarvis btn-import dropdown-toggle" title="Import Data"
                rel="tooltip" data-toggle="dropdown"><i class="fa fa-search"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right divFSearch stop-propagation" style="width:360px">
            <form id="sForm_{$sys.req.rid}" method="post" action="#{$sys.req.rid}" data-target="#{$sys.uix.pct}"
                  class="smart-form sForm" novalidate>
                <header><h3><i class="fa fa-search"></i> Search Parameters</h3></header>
                <input type="hidden" name="n" value="1" />
                {** <input type="hidden" name="q" value="" /> **}
                <input type="hidden" name="p" value="{$sys.req.p|default:1}"/>
                <input type="hidden" name="s" value="{$sys.req.s}"/>
                <input type="hidden" name="f" value="{$sys.req.f}"/>
                {** <input type="hidden" name="is_active" /> **}
                <fieldset>
                    {foreach from=$sys.rsp.ref key=k item=v}
                        {if isset($v.elm_type) && $v.elm_type eq 'hidden'}
                            <input type="hidden" name="{$v.col_fid}" value="{$v.sp_def}"/>
                        {elseif $v.elm_type eq 'free-search'}
                            <div class="row">
                                <section class="col col-9" style="padding-right:2px;">
                                    <label class="input">
                                        <i class="icon-append fa fa-search"></i>
                                        <input type="text" name="q" value="{$v.sp_def}" placeholder="{$v.elm_label}">
                                    </label>
                                </section>
                            </div>
                        {elseif $v.elm_placement eq 'lst' or $v.elm_placement eq 'both'}
                            {if $v.elm_type eq 'select' or
                                $v.elm_type eq 'select-group' or
                                $v.elm_type eq 'select-group-multi' or
                                $v.elm_type eq 'select-multiple' or
                                $v.elm_type eq 'select-tree' or
                                $v.elm_type eq 'select-limited' or
                                $v.elm_type eq 'select-self'}
                                {include file="{$sys.uix.elm}/frm/bs-smart/fs_select.tpl" rff=$v}
                            {elseif $v.elm_type eq 'date'}
                                {include file="{$sys.uix.elm}/frm/bs-smart/fs_date.tpl"}
                            {elseif $v.elm_type eq 'date-occur'}
                                {include file="{$sys.uix.elm}/frm/bs-smart/fs_date_occur.tpl"}
                            {elseif $v.elm_type eq 'date-range'}
                                {include file="{$sys.uix.elm}/frm/bs-smart/fs_date_range.tpl"}
                            {/if}
                        {/if}
                    {/foreach}
                </fieldset>
                <footer>
                    {if $sys.usr.is_super && $sys.prc.sys_tbl.has.col_active && isset($sys.rsp.ref.is_active)}
                        {include file="{$sys.uix.elm}/frm/bs-smart/fs_is_active.tpl"}
                    {/if}
                    <div class="row">
                        <section class="col col-3">
                            <label class="select">
                                <select name="l" class="form-control input-sm">
                                    <option value="" disabled>Rows/Page</option>
                                    {foreach from=$sys.nav.row item=r}
                                        <option value="{$r}" {if $sys.req.l eq $r}selected{/if}>{$r}</option>
                                    {/foreach}
                                    {if $sys.req.l gte 1000}
                                    <option value="{$sys.req.l}" selected>ALL</option>{/if}
                                </select><i></i>
                        </section>
                        <section class="col col-9">
                            <button class="btn txt-color-green margin-top-0" type="submit">Search <i class="fa fa-search"></i></button>
                        </section>
                    </div>
                </footer>
            </form>
        </div>
    </div>
</div>
<script>
	function getDate( element ) {
		var date;
		try {
			date = $.datepicker.parseDate( 'dd-mm-yy', element.value );
		}
		catch( error ) {
			date = null;
		}

		return date;
	}
	jQuery(function () {
		var dp_start    = $('.date-pair-start'),
			dp_end      = $('.date-pair-end'),
			dt_filter   = $('.date-filter');

		$('#is_active').change(function () {
			var elm = $(this),
                val = elm.prop(':checked') ? 1 : 0;
			elm.parents('form:first').find('input[name="is_active"]').val(val);
		});
		if (dp_start.length) {
			dp_start.datepicker({
				dateFormat: 'dd-mm-yy',
				changeMonth: true,
				changeYear: true,
				showOtherMonths: true,
				selectOtherMonths: true,
				prevText: '<i class="fa fa-chevron-left"></i>',
				nextText: '<i class="fa fa-chevron-right"></i>'
			}).on("change", function () {
				dp_end.datepicker( "option", "minDate", getDate( this ) );
			});

			dp_end.datepicker({
				dateFormat: 'dd-mm-yy',
				changeMonth: true,
				changeYear: true,
				showOtherMonths: true,
				selectOtherMonths: true,
				prevText: '<i class="fa fa-chevron-left"></i>',
				nextText: '<i class="fa fa-chevron-right"></i>'
			}).on("change", function () {
				dp_start.datepicker( "option", "maxDate", getDate( this ) );
			});
		}

		if (dt_filter.length) {
			dt_filter.datepicker({
				dateFormat: 'dd-mm-yy',
				changeMonth: true,
				changeYear: true,
				defaultDate: dt_filter.val(),
				showOtherMonths: true,
				selectOtherMonths: true,
				prevText: '<i class="fa fa-chevron-left"></i>',
				nextText: '<i class="fa fa-chevron-right"></i>'
			});
		}
	})
</script>