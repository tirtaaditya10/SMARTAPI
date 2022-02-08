<div class="tabbable-line">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#tabA"> Profile </a></li>
		{if $sys.rsp.dat.pid}
			<li><a data-toggle="tab" href="#tabB" data-url="#{$sys.req.rid+1}/0/{$sys.rsp.dat.id}"> Channel </a></li>
			<li><a data-toggle="tab" href="#tabC" data-url="#{$sys.req.rid+2}/0/{$sys.rsp.dat.id}" class="refresh"> Config </a></li>
		{/if}
		<li><a data-toggle="tab" href="#tab4"> Upload </a></li>
	</ul>
	<div class="tab-content">
		<div id="tabA" class="tab-pane active"></div>
		{if $sys.rsp.dat.pid}
			<div id="tabB" class="tab-pane"></div>
			<div id="tabC" class="tab-pane"></div>
		{/if}
		<div id="tabD" class="tab-pane"></div>
	</div>
</div>