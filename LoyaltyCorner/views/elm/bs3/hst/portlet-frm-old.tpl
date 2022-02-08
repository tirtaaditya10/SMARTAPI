{capture name="portlet"}
	<section id="widget-grid" class="full-screen">
		<!-- row -->
		<div class="row">
			<article class="col-md-12">
				<!-- Widget ID (each widget will need unique ID)-->
				<div class="jarviswidget jarviswidget-color-wyeth" id="PDC_{$sys.req.rid}"
					 data-widget-colorbutton="false"
					 data-widget-editbutton="false"
					 data-widget-togglebutton="false"
					 data-widget-deletebutton="false"
					 data-widget-custombutton="false"
					 data-widget-collapsed="false"
					 data-widget-sortable="false"
				>
					<!-- widget options:
                        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
                        data-widget-colorbutton="false"
                        data-widget-editbutton="false"
                        data-widget-togglebutton="false"
                        data-widget-deletebutton="false"
                        data-widget-fullscreenbutton="false"
                        data-widget-custombutton="false"
                        data-widget-collapsed="true"
                        data-widget-sortable="false"
                    -->
					<header>
						<span class="widget-icon"><i class="{$sys.rpc[$sys.req.rid].sys_icon}"></i></span>
						<h2><strong>
								{if $sys.rpc[$sys.req.rid].sys_header}{$sys.rpc[$sys.req.rid].sys_header}
								{elseif $sys.rpc[$sys.req.rid].sys_title}{$sys.rpc[$sys.req.rid].sys_title}
								{else}{$sys.rpc[$sys.req.rid].sys_process}
								{/if}
							</strong>
						</h2>
						<div class="widget-toolbar">
							<a href="javascript:void(0);" class="button-icon btn-danger fa fa-close pcdClose" title="Close Form" rel="tooltip" data-target="root-PCL"></a>
						</div>
						<div class="widget-toolbar">
							{if $sys.rpc[$sys.req.rid].right.doc}
								<div class="btn-group">
									<button class="button-icon btn btn-danger dropdown-toggle" title="Import Data" rel="tooltip" data-toggle="dropdown">
										Upload File <i class="fa fa-chevron-down"></i>
									</button>
									<div class="dropdown-menu form-login stop-propagation">
										<form class="form-inline" style="padding:15px">
											<div class="form-group form-inline margin-bottom-10">
												<select id="upl_batch_code" name="upl_batch_code" class="form-control input-sm" required>
													<option value="">Select Data to Upload</option>
													{foreach from=$sys.rsp.aux.upl_entity_type item=i}
														<option value="{$i.id}"{if $i.id eq 'wcrm_acq_customer'} checked{/if}>{$i.nm}</option>
													{/foreach}
												</select>
											</div>
											<div class="form-group form-inline pull-right">
												<label for="upl_batch_file" class="pull-right">
													<span class="button-icon btn btn-danger" title="Import via Excel" rel="tooltip" aria-hidden="true"> Select <i class="fi excel-icon txt-color-greenLight"></i></span>
													<input type="file" id="upl_batch_file" data-rid="{$sys.req.rid}" style="display:none">
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
							{/if}
						</div>
					</header>

					<!-- widget div-->
					<div class="">
						<!-- widget content -->
						<div class="widget-body">
							{if isset($sys.uix.nav)}
								{include file="{$sys.uix.tpl}/{$sys.uix.nav}"}
							{else}
								{include file="{$sys.uix.tpl}/{$sys.uix.gui}"}
								<div class="clearfix">
									{include file="{$sys.uix.elm}/misc/div_performance.tpl"}
								</div>
							{/if}
						</div>
						<!-- end widget content -->
					</div>
					<!-- end widget div -->
				</div>
				<!-- end widget -->
			</article>
		</div>
	</section>
{/capture}
{if $sys.uix.asd}
	<div class="row">
		{if $sys.uix.asd.pos eq 'left'}
			<div class="col-sm-3 padding-right-0">{include file="{$sys.uix.elm}/hst/portlet_aside.tpl"}</div>
		{/if}
		<div class="col-sm-9">
			{$smarty.capture.portlet}
		</div>
		{if $sys.uix.asd.pos eq 'right'}
			<div class="col-sm-3 padding-left-0">{include file="{$sys.uix.elm}/hst/portlet_aside.tpl"}</div>
		{/if}
	</div>
{else}
	{$smarty.capture.portlet}
{/if}