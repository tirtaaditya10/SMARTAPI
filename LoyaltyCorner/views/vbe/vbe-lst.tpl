<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blueDark jarviswidget-sortable" id="wid-id-0" data-widget-editbutton="false" role="widget">
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
				<header role="heading" class="ui-sortable-handle"><div class="jarviswidget-ctrls" role="menu">   <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand "></i></a> <a href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Delete"><i class="fa fa-times"></i></a></div><div class="widget-toolbar" role="menu"><a data-toggle="dropdown" class="dropdown-toggle color-box selector" href="javascript:void(0);"></a><ul class="dropdown-menu arrow-box-up-right color-select pull-right"><li><span class="bg-color-green" data-widget-setstyle="jarviswidget-color-green" rel="tooltip" data-placement="left" data-original-title="Green Grass"></span></li><li><span class="bg-color-greenDark" data-widget-setstyle="jarviswidget-color-greenDark" rel="tooltip" data-placement="top" data-original-title="Dark Green"></span></li><li><span class="bg-color-greenLight" data-widget-setstyle="jarviswidget-color-greenLight" rel="tooltip" data-placement="top" data-original-title="Light Green"></span></li><li><span class="bg-color-purple" data-widget-setstyle="jarviswidget-color-purple" rel="tooltip" data-placement="top" data-original-title="Purple"></span></li><li><span class="bg-color-magenta" data-widget-setstyle="jarviswidget-color-magenta" rel="tooltip" data-placement="top" data-original-title="Magenta"></span></li><li><span class="bg-color-pink" data-widget-setstyle="jarviswidget-color-pink" rel="tooltip" data-placement="right" data-original-title="Pink"></span></li><li><span class="bg-color-pinkDark" data-widget-setstyle="jarviswidget-color-pinkDark" rel="tooltip" data-placement="left" data-original-title="Fade Pink"></span></li><li><span class="bg-color-blueLight" data-widget-setstyle="jarviswidget-color-blueLight" rel="tooltip" data-placement="top" data-original-title="Light Blue"></span></li><li><span class="bg-color-teal" data-widget-setstyle="jarviswidget-color-teal" rel="tooltip" data-placement="top" data-original-title="Teal"></span></li><li><span class="bg-color-blue" data-widget-setstyle="jarviswidget-color-blue" rel="tooltip" data-placement="top" data-original-title="Ocean Blue"></span></li><li><span class="bg-color-blueDark" data-widget-setstyle="jarviswidget-color-blueDark" rel="tooltip" data-placement="top" data-original-title="Night Sky"></span></li><li><span class="bg-color-darken" data-widget-setstyle="jarviswidget-color-darken" rel="tooltip" data-placement="right" data-original-title="Night"></span></li><li><span class="bg-color-yellow" data-widget-setstyle="jarviswidget-color-yellow" rel="tooltip" data-placement="left" data-original-title="Day Light"></span></li><li><span class="bg-color-orange" data-widget-setstyle="jarviswidget-color-orange" rel="tooltip" data-placement="bottom" data-original-title="Orange"></span></li><li><span class="bg-color-orangeDark" data-widget-setstyle="jarviswidget-color-orangeDark" rel="tooltip" data-placement="bottom" data-original-title="Dark Orange"></span></li><li><span class="bg-color-red" data-widget-setstyle="jarviswidget-color-red" rel="tooltip" data-placement="bottom" data-original-title="Red Rose"></span></li><li><span class="bg-color-redLight" data-widget-setstyle="jarviswidget-color-redLight" rel="tooltip" data-placement="bottom" data-original-title="Light Red"></span></li><li><span class="bg-color-white" data-widget-setstyle="jarviswidget-color-white" rel="tooltip" data-placement="right" data-original-title="Purity"></span></li><li><a href="javascript:void(0);" class="jarviswidget-remove-colors" data-widget-setstyle="" rel="tooltip" data-placement="bottom" data-original-title="Reset widget color to default">Remove</a></li></ul></div>
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Validate Receipt</h2>
					<span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>
				<!-- widget div-->
				<div role="content">
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>#ID</th>
										<th>#RFF</th>
										<th>Customer</th>
										<th>Phone</th>
										<th>Status</th>
										<th>Submitted</th>
										<th>Validated</th>
										<th>Validator</th>
										<th>Source</th>
										<th>Receipt</th>
									</tr>
								</thead>
								<tbody>
									{foreach from=$dat item=i}
										<tr>
											<td>{$i.oid}</td>
											<td>{$i.FK_RCV_ID}</td>
											<td>{$i.custName}</td>
											<td>{$i.phoneNumber1}</td>
											<td>{$i.receipt_status}</td>
											<td>{$i.createdOn|date_format:"%d/%m/%Y %H:%M"}</td>
											<td>{$i.validatedOn}</td>
											<td>{$i.validator}</td>
											<td>{$i.creator}</td>
											<td class="text-center"><a data-target="#imgModal{$i.oid}" data-toggle="modal" href="/vbe/lst/{$i.oid}"><i class="fa fa-image"></i></a></td>
										</tr>
									{/foreach}
								</tbody>
							</table>

						</div>		
								{foreach from=$dat item=i}
									<div class="modal fade" id="imgModal{$i.oid}" tabindex="-1" role="dialog" aria-labelledby="imgModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<form action="vbe/frm" method="post" class="smart-form">
													<header>
														Validate Receipt
													</header>
													<fieldset>
														<img src="" width="100%" />
													</fieldset>
													<fieldset>
														<section>
															<input type="hidden" name="oid" value="{$i.oid}" />
															<label class="label">Status Receipt</label>
															<label class="select">
																<select name="receipt_status_id" class="input-sm">
																	<option value="0">Pending for Review</option>
																	<option value="1">Valid Receipt</option>
																	<option value="2">Invalid Receipt - Bukan Struk Beli Susu</option>
																	<option value="3">Invalid Receipt - Struk Manual</option>
																	<option value="4">Invalid Receipt - Struk Tidak Terbaca</option>
																	<option value="5">Invalid Receipt - Struk Tidak Lengkap</option>
																	<option value="6">Invalid Receipt - Struk Double Upload</option>
																</select> <i></i>
															</label>
														</section>
														<section>
															<label class="label">TRANS_POINT_OID (COPY-PASTE FORM SMART-CRM IF VALID-RECEIPT)</label>
															<label class="input">
																<input type="number" name="FK_RCV_ID" class="input-sm">
															</label>
														</section>
													</fieldset>
													<footer>
														<button type="submit" class="btn btn-primary">
															Submit
														</button>
													</footer>
												</form>

											</div>
										</div>
									</div>
								{/foreach}


					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->
		</article>
		<!-- WIDGET END -->
	</div>
	<!-- end row -->
</section>
