{extends file="{$sys.uix.elm}/hst/portlet-frm.tpl"}
{if $sys.req.pid eq 'new' && $sys.req.fid neq 'new'}
	<form id="frm_aaa_account" class="form-horizontal" method="post">
		<div class="form-body">
			<input type="hidden" name="act" value="add" />
			<div class="form-group">
				<label class="col-md-3 control-label">Employee</label>
				<div class="col-md-9">
					<div class="input-group">
						<div class="input-icon">
							<i class="fa fa-user"></i>
							<input id="emplx" class="form-control" type="text">
						</div>
						<span class="input-group-btn">
							<button id="empls" class="btn btn-success" type="button"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</div>
			</div>
			{include file="{$sys.uix.elm}/frm/bs-hrz/elm_select_group.tpl"	dtx=$sys.rsp.ref.aaa_acm}
			<div class="form-group">
				<label class="col-md-3 control-label">Division</label>
				<div class="col-md-9">
					<select id="grpx" class="bs-select show-tick show-menu-arrow" data-size="10" data-style="btn-inverse" data-live-search="true" data-placeholder="Groups" title="Groups">
						<option value=""></option>
					</select>
				</div>
			</div>

			<div id="tblx">
				<table class="footable table toggle-arrow-circle table-hover table-striped">
					<thead>
					<tr class="blue">
						<th data-sort-ignore="true" style="width:32px;"><i class="icon-valid"></i></th>
						<th data-sort-ignore="true">Account</th>
						<th data-sort-ignore="true">Name</th>
						<th data-sort-ignore="true">Email</th>
						<th data-sort-ignore="true">Mobile</th>
						<th data-sort-ignore="true">Direktorat</th>
						<th data-sort-ignore="true">Divisi</th>
					</tr>
					</thead>
					<tbody>
						<tr>
							<td class="align-center"></td>
							<td class="align-center" colspan="6"> --- silakan lakukan pencarian ---</td>
						</tr>
					</tbody>
				</table>

			</div>
			<div class="alert alert-warning fade in" style="margin-top:10px;">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Attention</strong><br />Make sure to set 'User Role(s)' later for each new user !!!</i>
			</div>
			{if !$sys.cfg.online}
				<div class="alert alert-danger fade in" style="margin-top:10px;">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Attention</strong><br />Unable to connect to Active Directory Server</i>
				</div>
			{/if}
		</div>
	</form>
	<script>
	<!--
	jQuery(function($) {
		loading = false;
		var online = navigator.onLine;
		{if $sys.cfg.online}
			$.get(AGV.host+'api/1.0/ad_group.opt', function(opt) {
				$('#grpx').html(opt).selectpicker('refresh');
			});
			$('#grpx').change(function() {
				var v =  $(this).val();
				if(v) {
					$.get(AGV.host+'api/1.0/ad_group_user.html/' + v, function(rsp) {
						$('#tblx').html(rsp);
						$('#tblx > table').footable();
						$('.bs-select').selectpicker({
							iconBase: 'fa',
							tickIcon: 'fa-check'
						});
					});
				}
			});
			$('#empls').click(function () {
				var v =  $('#emplx').val();
				if(v) {
					$.get(AGV.host+'api/1.0/ad_user.html/' + v, function(rsp) {
						$('#tblx').html(rsp);
						$('#tblx > table').footable();
						$('.bs-select').selectpicker({
							iconBase: 'fa',
							tickIcon: 'fa-check'
						});
					});
				}
			});

			$('#frm_aaa_account').submit(function() {
				var f = $(this),
					g = 0,
					p = [ { name:'act', value:'add' } ];
				$('input:checked', f).each(function() {
					var e = $(this),
						x = e.parent().siblings(),
						r = $('#grpr').val();
					g = 1;
					p.push( { name:'aaa_account[]', value:x.eq(0).html() },
							{ name:'account[]', value:x.eq(1).html() },
							{ name:'email[]', value:x.eq(2).html() },
							{ name:'mobile[]', value:x.eq(3).html() },
							{ name:'acm_rbac_id[]', value:r }
					);
				});
				if(g)
					$.post(AGV.site+'{$sys.req.rid}/new', p, function(rst) {
						$('#PCM').html(rst);
						dPage.init();
					});
				return false;
			});
		{/if}
	});
	-->
	</script>
{else}
    {block name="grid"}
        {assign pr 5}
    {/block}
    {block name="form_ext"}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_email.tpl"        label="Email" name="email" required=1 domain=0}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"
        label_1="Phone"  name_1="phone"     cfg_1=[type =>'number', f_icon=>'icon fa fa-phone', class=>'mask_phone']   grid_22=2
        name_2="phone_ext" cfg_2=[type =>'number', l_icon=>'ext']
        }
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"          label="Mobile" name="mobile" cfg=[f_icon =>'icon fa fa-phone', class=>"mask_mobile"]}
        {if $sys.rsp.dat.registered}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_date_view.tpl" label="Registered" name="registered"}
        {/if}
        {if $sys.rsp.dat.revoked}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_date_view.tpl"  label="Revoked" name="revoked"}
        {/if}
        {if $sys.usr.is_admin}
            {if $sys.rsp.dat.aaa_type_id eq 1}
                {include file="{$sys.uix.elm}/frm/bs-hrz/elm_boolean.tpl"   label="Reset Password" name="is_pwd_reset"}
            {/if}
        {/if}
    {/block}
{/if}

