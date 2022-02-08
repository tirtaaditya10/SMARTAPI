<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}/{$sys.req.fid}" data-target="#{$sys.uix.pcm}" class="cForm form-horizontal" role="form">
	<div class="form-body">
		{include file="{$sys.uix.elm}/frm/bs-hrz/elm_select_multi_grp.tpl"   dtx=$sys.rsp.ref.aaa_acm}
	</div>
	{include file="{$sys.uix.elm}/frm/btn_crud.tpl" btnDel=0}
</form>