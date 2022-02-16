{if $sys.req.tab}
	{include file="{$sys.uix.elm}/tpl/tbl_foo.tpl"}
{else}
	<div class="row">
		<div class="col-md-2 col-sm-2 col-xs-2">
			<ul class="nav nav-tabs tabs-left">
				<li class="active"><a class="do-hvr-pulse" href="#tabA" data-toggle="tab"><i class="fa fa-book"></i> Account</a></li>
				<li><a class="do-hvr-pulse refresh" href="#tabB" data-toggle="tab" data-url="#{$sys.req.rid+1}"><i class="fa fa-book"></i> Collectibility</a></li>
				<li><a class="do-hvr-pulse refresh" href="#tabC" data-toggle="tab" data-url="#{$sys.req.rid+2}"><i class="fa fa-book"></i> Facility</a></li>
			</ul>
		</div>
		<div class="col-md-10 col-sm-10 col-xs-10">
			<div class="tab-content no-space">
				<div class="tab-pane active" id="tabA">
					<div id="tabAT">
						{include file="{$sys.uix.elm}/tpl/tbl_foo.tpl"}
					</div>
					<div id="tabAD" class="root-pcd display-hide"></div>
				</div>
				<div class="tab-pane" id="tabB"></div>
				<div class="tab-pane" id="tabC"></div>
				<div class="tab-pane" id="tabD"></div>
				<div class="tab-pane" id="tabE"></div>
				<div class="tab-pane" id="tabF"></div>
				<div class="tab-pane" id="tabG"></div>
				<div class="tab-pane" id="tabH"></div>
				<div class="tab-pane" id="tabI"></div>
			</div>
		</div>
	</div>
{/if}