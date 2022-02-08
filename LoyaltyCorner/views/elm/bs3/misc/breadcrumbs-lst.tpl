<ul class="page-breadcrumb breadcrumb">
	{foreach $sys.rsp.bc as $bc}
		{if $bc@first}
			<li class="first"><a href="{$sys.cfg.url}{$sys.uix.tpl}"><i class="icon-home"></i></a></li>
			<li><a>{$bc|replace:'#':' '}</a></li>
		{elseif $bc@last}
			<li class="last"><a class="font-bold txt-color-blue">{$bc|replace:'#':' '}</a></li>
		{else}
			<li><a>{$bc|replace:'#':' '}</a></li>
		{/if}
	{/foreach}
</ul>
