<ul class="page-breadcrumb breadcrumb">
	{foreach $sys.rsp.bc as $bc}
		{if $bc@first}
			<li><a href="{$sys.cfg.url}{$sys.cfg.app.id_code}"><i class="icon-home"></i></a></li>
			<li><a>{$bc|replace:'#':' '}</a></li>
		{elseif $bc@last}
			<li><a class="font-blue">{$bc|replace:'#':' '}</a></li>
		{else}
			<li><a>{$bc|replace:'#':' '}</a></li>
		{/if}
	{/foreach}
</ul>
