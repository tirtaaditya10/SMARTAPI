<ul class="page-breadcrumb breadcrumb">
	{foreach $sys.rsp.bc as $bc}
		{if $bc@first}
			<li><a href="{$sys.cfg.url}{$sys.uix.tpl}"><i class="icon-home"></i></a> <span class="divider"> </span></li>
		{elseif $bc@last}
			<li class="active">{$bc|replace:'#':' '}</li>
		{else}
			<li><a>{$bc|replace:'#':' '}</a><span class="divider"> </span></li>
		{/if}
	{/foreach}
</ul>
